<?php
if(!isset($Path['lib-bibtex']))
	$Path['lib-bibtex'] = "../lib/";
	
require_once $Path['lib-bibtex'] . 'lib_bibtex-db.inc.php';
require_once $Path['lib-bibtex'] . 'lib_bibtex-printers.inc.php';

class Bibtex {
	var $bibarr = array();
	
	var $refPrinter; 
	var $order;
	
	var $scanning = false;
	var $scanned = false;
	var $used = array();
	var $usedCnt = 0;
	

	//////////////////////////////////////////////////////////////////////////////
	// Constructor
	//////////////////////////////////////////////////////////////////////////////
	function __construct() {
		$num_args = func_num_args();
		$args = func_get_args();

		$this->SetBibliographyStyle($this->GetDefaultStyle());
		$this->SetBibliographyOrder($this->GetDefaultOrder());
		
		if($num_args > 0)
			$this->ParseFiles($args);
	}

	//////////////////////////////////////////////////////////////////////////////
	// Get/Set
	//////////////////////////////////////////////////////////////////////////////

	// bib-style = numeric 		cite(..)   [1,2]
	//                        citet(..)  Vreeken & van Leeuwen [1]; Vreeken et al. [2]
	//           = abbrv			           [VvL12,VvlS07]
	//                                   Vreeken & van Leeuwen [VvL12]; Vreeken et al. [VvlS07]
	//           = natbib			           (Vreeken & van Leeuwen, 2012); (Vreeken et al., 2007)
	//                                   Vreeken & van Leeuwen (2012); Vreeken et al. (2007)
	function SetBibliographyStyle($style) {
		if($style == 'abbrv') {
			$this->refPrinter = new AbbrvPrinter();
		} else if($style == 'natbib') {
			$this->refPrinter = new NatbibPrinter();
		} else if($style == 'numeric') {
			$this->refPrinter = new NumericPrinter();
		}	else
			die('unknown style');
	}
	function GetDefaultStyle() {
		return 'numeric';
	}
	
	// bib-order = alphabetic			
	//           = usage
	function SetBibliographyOrder($order) {
		if($order == 'alphabetic') {
			$order = array('author' => 'asc', 'year' => 'asc', 'title' => 'asc', 'usage' => 'asc');
		} else if(is_string($order)) {
			$pu = strpos($order, '_');
			$fd = ($pu != false ? substr($order, 0, $pu) : $order);
			$sd = ($pu != false ? substr($order, $pu+1) : 'asc');  // default to ascending
			$order = array($fd => $sd);
		}
		// normalize 'asc' to 'a', and 'desc' to 'd'
		foreach($order as $f => $d)
			if($d == 'asc') $order[$f] = 'a';
			else if($d == 'desc') $order[$f] = 'd';

		$this->order = $order;
	}
	// 'asc' or 'a' for ascending (default), 'desc' or 'd' for descending
	function GetDefaultOrder() {
		return array('usage' => 'asc', 'author' => 'asc', 'year' => 'asc', 'title' => 'asc');
	}	
	
	// sets the base directory from which pdfs -- as identified using paperurl = {..} keys -- will have be retrieved
	function SetPaperDirectory($dir) {
		$this->refPrinter->SetPaperDirectory($dir);
	}

	//////////////////////////////////////////////////////////////////////////////
	// Load Citation Database
	//////////////////////////////////////////////////////////////////////////////
	
	function ParseFiles($files) {
		foreach($files as $file) {
			if(is_string($file)) {
				$fname = ( stripos($file, ".bib")!=false ? $file : $file . '.bib' );
				if(file_exists($fname)) {
					$this->Parse( $fname );
				}
			}
		}
	}

	function Parse($pathname) {
		$file = file($pathname);
		$rawblock = '';
		$inblock = false;
		
		foreach($file as $line) {
			$line = str_replace('\\textsc','', $line);
			$line = str_replace('\\textit','', $line);
			
			$pattern = "/\\$(.*)\\$/i";
			$replacement = '<span class=\'bibtex-mathmode\'>${1}</span>';
			$line = preg_replace($pattern, $replacement, $line);

			$pattern = "/\{\\\'(\w+)\}/";
			$replacement = '&${1}acute;';	// for: á
			$line = preg_replace($pattern, $replacement, $line);
			$pattern = "/\\\'\{(\w+)\}/";
			$line = preg_replace($pattern, $replacement, $line);
			
			$pattern = "/\{\\\`(\w+)\}/";
			$replacement = '&${1}grave;';	// for: à
			$line = preg_replace($pattern, $replacement, $line);

			$pattern = "/\{\\\^(\w+)\}/";
			$replacement = '&${1}circ;';	// for: â		-- needs to be re-checked, somehow, doesnt always work  (jv, 2015-11-12)
			$line = preg_replace($pattern, $replacement, $line);
			
			$pattern = '/\{\\\"(\w+)\}/';
			$replacement = '&${1}uml;';		// for: ü
			$line = preg_replace($pattern, $replacement, $line);
			$pattern = '/\\\"\{[\\\]?(\w+)\}/';
			$line = preg_replace($pattern, $replacement, $line);
						
			$replacement = '&ccedil;';		// for: ç
			$line = str_replace('\cc', $replacement, $line);
			$line = preg_replace($pattern, $replacement, $line);
			$pattern = '/\\\c\{c\}/';
			$line = preg_replace($pattern, $replacement, $line);

			$pattern = "/\{\\\\[o]{1}\}/";
			$replacement = '&oslash;';	// for: ø
			$line = preg_replace($pattern, $replacement, $line);

			$pattern = "/\{\\\\[O]{1}\}/";
			$replacement = '&Oslash;';	// for: Ø
			$line = preg_replace($pattern, $replacement, $line);

			$pattern = '/\{\\\noopsort\{\w+\}\}/';	// remove meta-tag 'noopsort' (currently not supported)
			$line = preg_replace($pattern, '', $line);
			
			$pattern = '/=\s*"/';	// change '= "..."' into '= {...}'
			$line = preg_replace($pattern, '= {', $line);
			$line = str_replace('"','}', $line);

			$line = str_replace('\\delta','&delta;', $line); // for: delta
			$line = str_replace('$','', $line); // remove math-mode

			$seg = $line;

			// check if starts with @ ...
			$segT = trim($seg);
			if(strlen($segT) > 0 && $segT[0] == '}') {
				$rawblock .= ' '.trim(substr($seg,0,strpos($seg,'%%') == false ? strlen($seg) : strpos($seg,'%%')), " \n\r");
				$this->ParseEntry($rawblock);
				$rawblock = '';
				$inblock = false;
			} else if(strlen($segT) > 0 && $segT[0] == '@') {
				// starts something new
				$this->ParseEntry($rawblock);
				$rawblock = '';
				$inblock = true;
			}
			
			$pc = strpos($seg,'%%') == false ? strlen($seg) : strpos($seg,'%%');
			if($inblock === true)
				$rawblock .= ' '.trim(substr($seg,0,$pc), " \n\r");
		}
		
		if($rawblock != '')
			$this->ParseEntry($rawblock);
	}
	
	function ParseEntry($rb) {
		$rb = trim($rb);
		if($rb == '')
			return;
		
		$entry = array();
		
		$pa = strpos($rb, '{');
		// old
		//$pc = strpos($rb, ',') === false ? strlen($rb) : strpos($rb, ',');
		//$ps = strpos($rb, ' ') === false ? strlen($rb) : strpos($rb, ' ');
		//$pz = min($pc,$ps);
		// new 
		$pz = strpos($rb, ',') === false ? strlen($rb) : strpos($rb, ',');
		if($pa == false) {
			return;
		}

		$entry['type'] = strtolower(substr($rb, 1, $pa-1));
		if($entry['type'] == 'preamble')
			return;
		$entry['key'] = Bibtex::NormalizeKey(substr($rb, $pa+1, $pz-$pa-1));
		
		$rb = substr($rb, $pz+1, -1);
		
		$rawfields = array();

		if($entry['type'] == 'string') {
			$rb = 'val ' . $rb;
		} 
		$start = 0;
		$nest = 0;
		for($i=0; $i < strlen($rb); $i++) {
			if($rb[$i] == ',' && $nest == 0) {
				// lets see if its a reference (brute hack, this!) (2014-10-03 by JV)
				$lb = trim(substr($rb, $start, $i-$start));
				$pe = strpos($lb, '= ');
				if($pe != false && $this->HasEntry(trim(substr($lb, $pe+2)))) {
					$entr = $this->GetEntry(trim(substr($lb, $pe+2)));
					$nr = substr($lb, 0, $pe) . '= {' . $entr['val'] . "}";
					$rb = substr($rb, 0, $start+1) . $nr . substr($rb, $i);
					$i = $start;
				} else
					$start = $i+1;
			} 
			if($rb[$i] == '{' || ($rb[$i] == '"' && ($i+1 < strlen($rb) && ($rb[$i+1] != ',' && $rb[$i+1] != "\n")))) {
				$nest++;				
			} else if($rb[$i] == '}' || ($rb[$i] == '"' && (	($i+1 < strlen($rb) && ($rb[$i+1] == ',' || $rb[$i+1] == "\n" || $rb[$i+1] == "\r")))
																												||
																												($i+1==strlen($rb)))
																											) {
				$nest--;
				
				if($nest == 0) {
					$rawfields[] = trim(substr($rb, $start, $i-$start+1));
					$start = $i+1;					
				}
			}			
		}
		foreach($rawfields as $field) {
			$fieldname = strtolower(trim(substr($field, 0, strpos($field, '='))));
			$fieldval = substr(trim(substr($field, strpos($field, '=')+1)),1,-1);
			$entry[$fieldname] = $fieldval;
		}
		
		// pre-handle author array
		if(isset($entry['author'])) {
			$entry['author'] = Bibtex::NormalizeAuthorStr($entry['author']);
		}
		
		// pre-handle editor array
		if(isset($entry['editor'])) {
			$entry['editor'] = Bibtex::NormalizeAuthorStr($entry['editor']);
		}

		// pre-handle pagefrom/to
		if(isset($entry['pages'])) {
			$pattern = '/^([0-9]+)[^0-9]+([0-9]+)$/';
			if(preg_match($pattern, $entry['pages'], $match))
				$entry['pages'] = $match[1] . '-' . $match[2];
		}
		
		// pre-handle booktitle
		if(isset($entry['booktitle'])) {
			$entry['booktitle'] = str_replace('{','', str_replace('}','',str_replace('`', '\'', $entry['booktitle'])));
		}
		
		// filter out {'s
		foreach($entry as $field => $val) {
			$val = str_replace('{', '', $val);
			$val = str_replace('}', '', $val);
			$entry[$field] = $val;
		}		
		
		$this->bibarr[$entry['key']] = $entry;
	}	
	
	//////////////////////////////////////////////////////////////////////////////
	// Helper-methods
	//////////////////////////////////////////////////////////////////////////////
	function NormalizeKey($key) {
		// old
		//return str_replace('/', '_', str_replace(':', '_', trim($key)));
		// new
		return str_replace("/: \r\n\t",'__',$key);
	}
	function NormalizeAuthorStr($authorstr) {
		$aarr = explode(' and ', $authorstr);
		$aarr = array_map('trim', $aarr);
		for($i=0; $i < count($aarr); $i++) {
			if(strpos($aarr[$i], ',') == false) {
				// no first/lastname indicator, let's do that ourselves
				$pa = strpos($aarr[$i], '{') != false && (strpos($aarr[$i],'{') == 0 || $aarr[$i][strpos($aarr[$i],'{')-1] == ' ' || $aarr[$i][strpos($aarr[$i],'{')-1] == '.') ? strpos($aarr[$i], '{') : false;
				$pl = ($pa == true) ? strpos($aarr[$i], '{') : strrpos($aarr[$i], ' ');
				
				$lastname = trim(substr($aarr[$i], $pl+1, ($pa && strpos($aarr[$i], '}', $pl) != false ? strpos($aarr[$i], '}', $pl) - $pl : strlen($aarr[$i])-$pl)-1) );
				
				$firstname = trim(substr($aarr[$i], 0, $pl));
				$fn = explode(' ', str_replace('.', '', str_replace('-', ' ', $firstname)));
				$fn2 = '';
				for($j=0; $j < count($fn); $j++) {
					if(strlen($fn[$j]) > 0)
						$fn2 .= $fn[$j][0] . '.';
				}
				
				$aarr[$i] = $lastname . ', ' . $fn2;
			} else {
				$na = explode(',', $aarr[$i]);
				$fn = explode(' ', str_replace('.', '', str_replace('-', ' ', trim($na[1]))));
				$fn2 = '';
				for($j=0; $j < count($fn); $j++) {
					if(strlen($fn[$j]) > 0)
						$fn2 .= $fn[$j][0] . '.';
				}
				$aarr[$i] = $na[0] . ', ' . $fn2;
			}
		}
		return implode(' and ', $aarr);
	}
	

	//////////////////////////////////////////////////////////////////////////////
	// Save Citation Database
	//////////////////////////////////////////////////////////////////////////////
	
	// ...later...


	//////////////////////////////////////////////////////////////////////////////
	// Interact with Citation Database
	//////////////////////////////////////////////////////////////////////////////

	/// Impl for BibArray	
	function HasEntry($key) {
		$key = Bibtex::NormalizeKey($key);
		return isset($this->bibarr[$key]);
	}
	function GetEntry($key) {
		$key = Bibtex::NormalizeKey($key);
		return isset($this->bibarr[$key]) ? $this->bibarr[$key] : false;
	}
	
	
	//////////////////////////////////////////////////////////////////////////////
	// Cite-variants, for in-line selection of entries
	//////////////////////////////////////////////////////////////////////////////
	function Citep() {
		$args = func_get_args();
		CiteRefs('p', $args);
	}
	function Citet() {
		$args = func_get_args();
		CiteRefs('t', $args);
	}
	function CiteRefs($style, $args) {
		$style = $style == 't' ? 't' : 'p';
		$num_args = count($args);
		
		for($i=0; $i < $num_args; $i++) {
			if(is_object($args[$i]))
				continue;
			if(!isset($this->used[$args[$i]])) {
				$entry = $this->GetEntry($args[$i]);
				if($entry === false) {
					$this->used[$args[$i]] = array('key' => $args[$i], 'ref' => false, 'cited' => true, 'selected' => false, 'entry' => $entry);
				} else {
					$this->used[$args[$i]] = array('key' => $args[$i], 'ref' => $this->usedCnt, 'usg' => $this->usedCnt++, 'cited' => true, 'selected' => false, 'entry' => $entry);
				}
			}
		}		
		if($this->scanning === false) {
			echo $this->refPrinter->StartCiteStr();
			echo ($style == 'p') ? $this->refPrinter->StartListStr() : '';
			for($i=0; $i < $num_args-1; $i++) {
				$entry = $this->GetEntry($args[$i]);
				$usage = $this->used[$args[$i]];
				echo ($style == 'p') ? $this->refPrinter->ListRefStr($entry, $usage) : $this->refPrinter->TextualRefStr($entry, $usage);
				echo $this->refPrinter->SepListStr();
			}
			$entry = $this->GetEntry($args[$num_args-1]);
			$usage = $this->used[$args[$num_args-1]];
			echo ($style == 'p') ? $this->refPrinter->ListRefStr($entry, $usage) : $this->refPrinter->TextualRefStr($entry, $usage);
			echo ($style == 'p') ? $this->refPrinter->EndListStr() : '';
			echo $this->refPrinter->EndCiteStr();
		}
	}
	function UnCite() {
		$args = func_get_args();
		$num_args = count($args);

		$biboff = 0;
		$bibarr = ($num_args > $biboff && is_array($args[$biboff]) ? true : false);
		$bibargs = ($bibarr == true ? $args[$biboff] : array_slice($args, $biboff));
		$numbibs = count($bibargs);
		
		for($i=0; $i < $numbibs; $i++) {
			if(!isset($this->used[$bibargs[$i]])) {
				//echo 'This should not have happened.';
				continue;
			}
			$this->used[$bibargs[$i]]['cited'] = false;
		}		
	}


	//////////////////////////////////////////////////////////////////////////////
	// Pre-scanning of Cites, required for non-usage Bibliography orders
	//////////////////////////////////////////////////////////////////////////////
	function IncludeBibContent($pathname, $bib = false) {
		if($bib != false)
			eval ('global '.$bib.';');
		Bibtex::ScanContentForCites($pathname, $bib);
		include $pathname;
	}
	function ScanContentForCites($pathname, $bib) {
		if($bib != false)
			eval ('global '.$bib.';');

		$this->ResetBibliography();
		$this->scanning = true;
		
		ob_start();
		include $pathname;
		ob_end_clean();
		
		$this->OrderBibliography();	

		$this->scanning = false;
		$this->scanned = true;
	}
	function ResetBibliography() {
		$this->scanning = false;
		$this->scanned = false;
		$this->used = array();
		$this->usedCnt = 0;
	}

	//////////////////////////////////////////////////////////////////////////////
	// Order Bibliography
	//////////////////////////////////////////////////////////////////////////////
	
	// impl for Bibarray
	function OrderBibliography() {
		if(is_string($this->order))					// this shouldn't happen, don't set order yourself.
			SetBibliographyOrder($this->order);
		if(!is_array($this->order)) {				// this definitely shouldn't happen
			echo "Error ordering bibliography: incorrect order specified";
			return;
		}
		
		$order = $this->order;
		
		// only order on usage, already added in right order, so nothing to order!
		if(count($order) == 1 && isset($order['usage']) && $order['usage'] == 'a' && $this->scanned == false) {
			return;
		}

		$arr = array();
		$numCited = 0;
		$numSelected = 0;
		$numCitedAndSelected = 0;
		foreach($this->used as $key => $val) {
			if($val['ref'] === false)
				continue;
			else {
				$arr[] = $key;
				$numSelected += $val['selected'] == true ? 1 : 0;
				$numCited += $val['cited'] == true ? 1 : 0;
				$numCitedAndSelected += $val['cited'] == true && $val['selected'] == true ? 1 : 0;
			}
		}

		// for each entry $i to be in reference list
		for($i=0; $i< count($arr)-1; $i++) {
			// for each other entry $j
			for($j=$i+1; $j< count($arr); $j++) {
				// check whether $i < $j
				$k = $this->CmpRefs($this->used[$arr[$i]], $this->used[$arr[$j]]);
				if($k == 1) {
					$tmp = $arr[$j];
					$arr[$j] = $arr[$i];
					$arr[$i] = $tmp;
				}
			}
		}
		
		$c = 0;
		$newUsed = array();
		foreach($arr as $a) {
			$newUsed[$a] = $this->used[$a];
			$newUsed[$a]['ref'] = $c++;
		}
		foreach($this->used as $k => $v) {
			if($this->used[$k]['ref'] === false)
				$newUsed[$k] = $this->used[$k];
		}
		$this->used = $newUsed;
	}
	
	function CmpRefs($i, $j) {
		$order = $this->order;
		$k = 0;
		foreach($order as $f => $d) {
			if($f == 'usage') {
				$k = Bibtex::CmpVal($i['usg'], $j['usg'], $d);
			} else if($f == 'cited') {
				$k = Bibtex::CmpVal($i['cited'],$j['cited'],$d);
			} else {
				$a = $i['entry'];
				$b = $j['entry'];
				if(($a === false && $b !== false) || ($a !== false && $b !== false && (!isset($a[$f]) || $a[$f] === NULL) && (isset($b[$f]) && $b[$f] !== NULL)))
					return -1;
				else if(($a !== false && $b === false) || ($a !== false && $b !== false && (isset($a[$f]) && $a[$f] !== NULL) && (!isset($b[$f]) || $b[$f] === NULL)))
					return 1;
				else if((isset($a[$f]) && $a[$f] !== NULL) && (isset($b[$f]) && $b[$f] !== NULL))
					$k = Bibtex::CmpString($a[$f], $b[$f], $d);
			}
			if($k !== 0)
				return $k;
		}
		return 0;
	}
	
	//////////////////////////////////////////////////////////////////////////////
	// Ordering Helper-methods	
	//////////////////////////////////////////////////////////////////////////////
	function CmpVal($a, $b, $d) {
		if($a < $b)
			return ($d == 'a' ? -1 : 1);
		else if ($a > $b)
			return ($d == 'a' ? 1 : -1);
		else
			return 0;
	}
	function CmpEntriesYear($a, $b, $d) {
		if($a['year'] < $b['year'])
			return ($d == 'a' ? -1 : 1);
		else if($a['year'] > $b['year'])
			return ($d == 'a' ? 1 : -1);
		else
			return 0;
	}	
	function CmpString($a, $b, $d) {
		return strcmp(($d == 'a' ? strtolower($a) : strtolower($b)), ($d == 'a' ? strtolower($b) : strtolower($a)));
	}
	function CmpEntriesAuthors($a, $b, $d) {
		return Bibtex::CmpString($a['author'], $b['author'], $d);
	}
	function CmpEntriesTitles($a, $b, $d) {
		return Bibtex::CmpString($a['title'], $b['title'], $d);
	}
	function CmpEntriesCited($a, $b, $d) {
		if($a['sel'] == true && $b['sel'] == true)
			return 0;
		else if($s['sel'] == true)
			return ($d == 'a' ? 1 : 0);
		else 
			return ($d == 'a' ? -1 : 0);
	}
	
	

	//////////////////////////////////////////////////////////////////////////////
	// Query-based Selection
	//////////////////////////////////////////////////////////////////////////////

	// takes an array, where key => valye identifies the key for which the value should match what value (done through preg_match)
	// impl for BibArray
	function Select($queryArray) {
		if($this->scanning == true)
			return;
			
		foreach($this->bibarr as $entry) {
			$sel = true;
			foreach($queryArray as $field => $val) {
				if($field[0]>='0' && $field[0]<='9')		// jv says: don't really see the point of this?
					$field=substr($field,1);				
				if(is_array($val)) {
					$psel = false;
					foreach($val as $v) {
						if(isset($entry[$field])) {
						if($field == 'key')
								$v = Bibtex::NormalizeKey($v);
							if(stripos($entry[$field], $v) !== false) {
								$psel = true;
								break;
							}
						} 
					}
					$sel = $psel;
				} else if( !isset($entry[$field]) || ($field == 'key' && $entry['key'] != Bibtex::NormalizeKey($val)) || (stripos($entry[$field], (string) $val) === false)) {
					$sel = false;
				}
			}
			
			if($sel == true) {
				$this->SelectEntry($entry['key'], $entry);
			} 
		}
	}
	function SelectEntry($key, $entry = false) {
		if(!isset($this->used[$key])) {
			$this->used[$key]['ref'] = $this->usedCnt++;
			$this->used[$key]['selected'] = true;
			$this->used[$key]['cited'] = false;
			$this->used[$key]['entry'] = $entry;
		} else {
			$this->used[$key]['selected'] = true;
			$this->used[$key]['entry'] = $this->used[$key]['entry'] === false ? $entry : $this->used[$key]['entry'];
		}
	}
	function SelectEntries() {
		$args = func_get_args();
		$num_args = count($args);

		$biboff = 0;
		$bibarr = ($num_args > $biboff && is_array($args[$biboff]) ? true : false);
		$bibargs = ($bibarr == true ? $args[$biboff] : array_slice($args, $biboff));
		
		foreach($bibargs as $key) {
			$this->SelectEntry($key);
		}
	}
	
	
	//////////////////////////////////////////////////////////////////////////////
	// Print Bibliography
	//////////////////////////////////////////////////////////////////////////////
	
	// Prints elements in $this->used, in the order of $this->used.
	//  If other order is desired, use SetBibliographyOrder(..) in advance.
	function PrintBibliography() {
		if($this->scanning === true) return;
		echo '<table class="bibtex-biblio">' . "\n";
		$this->OrderBibliography();	
		foreach($this->used as $key => $info) {
			if($info['ref'] === false)
				continue;
			$entry = isset($info['entry']) ? $info['entry'] : $this->GetEntry($key);
			echo $this->refPrinter->BibliographyEntryStr($entry, $this->used[$key]);
		}
		echo '</table>' . "\n";
	}
	function PrintBibliographyCitedOnly() {
		if($this->scanning === true) return;
		echo '<table class="bibtex-biblio">' . "\n";
		$this->OrderBibliography();	
		foreach($this->used as $key => $info) {
			if($info['ref'] === false || (isset($info['selected']) && $info['selected'] === true) || (isset($info['cited']) && $info['cited'] === false)) {
			//if($info['ref'] === false || (isset($info['cited']) && $info['cited'] === false)) {
				continue;
			}
			$entry = isset($info['entry']) ? $info['entry'] : $this->GetEntry($key);
			echo $this->refPrinter->BibliographyEntryStr($entry, $this->used[$key]);
		}
		echo '</table>' . "\n";
	}
	function PrintBibliographySelectedOnly() {
		if($this->scanning === true) return;
		echo '<table class="bibtex-biblio">' . "\n";
		$this->OrderBibliography();	
		foreach($this->used as $key => $info) {
			//if($info['ref'] === false || (isset($info['selected']) && $info['selected'] === false) || (isset($info['cited']) && $info['cited'] === true))
			if($info['ref'] === false || (isset($info['selected']) && $info['selected'] === false))
				continue;
			$entry = isset($info['entry']) ? $info['entry'] : $this->GetEntry($key);
			echo $this->refPrinter->BibliographyEntryStr($entry, $this->used[$key]);
		}
		echo '</table>' . "\n";
	}
}


function cite() {
	global $Site;
	$num_args = func_num_args();
	$args = func_get_args();
	
	$bibarg = ($num_args > 0 && is_object($args[0]) ? true : false);
	$bibobj = ($bibarg == true ? $args[0] : ((isset($Site) && isset($Site['bibtex']) && is_object($Site['bibtex'])) ? $Site['bibtex'] : false));
	$biboff = ($bibarg == true ? 1 : 0);
	$bibarr = ($num_args > $biboff && is_array($args[$biboff]) ? true : false);
	$bibargs = ($bibarr == true ? $args[$biboff] : array_slice($args, $biboff));
	if($bibobj != false)
		$bibobj->CiteRefs('p', $bibargs);
}

function citep() {
	global $Site;
	$num_args = func_num_args();
	$args = func_get_args();
	
	$bibarg = ($num_args > 0 && is_object($args[0]) ? true : false);
	$bibobj = ($bibarg == true ? $args[0] : ((isset($Site) && isset($Site['bibtex']) && is_object($Site['bibtex'])) ? $Site['bibtex'] : false));
	$biboff = ($bibarg == true ? 1 : 0);
	$bibarr = ($num_args > $biboff && is_array($args[$biboff]) ? true : false);
	$bibargs = ($bibarr == true ? $args[$biboff] : array_slice($args, $biboff));
	if($bibobj != false)
		$bibobj->CiteRefs('p', $bibargs);
}

function citet() {
	global $Site;
	$num_args = func_num_args();
	$args = func_get_args();
	
	$bibarg = ($num_args > 0 && is_object($args[0]) ? true : false);
	$bibobj = ($bibarg == true ? $args[0] : ((isset($Site) && isset($Site['bibtex']) && is_object($Site['bibtex'])) ? $Site['bibtex'] : false));
	$biboff = ($bibarg == true ? 1 : 0);
	$bibarr = ($num_args > $biboff && is_array($args[$biboff]) ? true : false);
	$bibargs = ($bibarr == true ? $args[$biboff] : array_slice($args, $biboff));
	if($bibobj != false)
		$bibobj->CiteRefs('t', $bibargs);
}

?>