<?php
//////////////////////////////////////////////////////////////////////////////
// class BasePrinter
//////////////////////////////////////////////////////////////////////////////

abstract class BasePrinter {
	var $icons = array('impl' => 'icon_block_16x16.png');
	var $paperDir = './';
	
	// Name of this Printer
	abstract function GetPrinterName();
	
	//////////////////////////////////////////////////////////////////////////////
	// Get/Set
	//////////////////////////////////////////////////////////////////////////////
	
	function GetPaperDirectory() {
		return $this->paperDir;
	}

	function SetPaperDirectory($dir) {
		$this->paperDir = $dir;
	}

	//////////////////////////////////////////////////////////////////////////////
	// Functions to dress up a list of references, e.g., [1,2,3]
	//////////////////////////////////////////////////////////////////////////////
	
	// Gives the string of the full citation, for use in the bibliography, so with ref/key if needed
	function BibliographyEntryStr($entry, $usage) {
		$str = $this->StartBibliographyEntryStr($entry);
		$str .= $this->StartBibliographyRefStr();
		$str .= $this->StartListStr() . $this->ListRefStr($entry, $usage) . $this->EndListStr();
		$str .= $this->EndBibliographyRefStr();
		$str .= $this->StartBibliographyCitationStr();
		$str .= $this->CitationStr($entry);
		$str .= $this->EndBibliographyCitationStr();
		$str .= $this->EndBibliographyEntryStr();
		return $str;
	}
	
	function StartCiteStr() {
		return '<span class="bibtex-cite">';
	}
	function EndCiteStr() {
		return '</span>';
	}
	
	function StartBibliographyEntryStr($entry) {
		$str = "\t" .'<tr id="' . $entry['key'] . '" class="bibtex-entry bibtex-'.$this->GetPrinterName().'">' . "\n";
		return $str;
	}
	function EndBibliographyEntryStr() {
		$str = "\t" .'</tr>' . "\n";
		return $str;
	}

	function StartBibliographyRefStr() {
		return "\t" . "\t" .'<td class="bibtex-reference bibtex-'.$this->GetPrinterName().'">';
	}
	function EndBibliographyRefStr() {
		return '</td>' . "\n";
	}


	function StartBibliographyCitationStr() {
		return "\t" . "\t" .'<td class="bibtex-citation">';
	}
	function EndBibliographyCitationStr() {
		return '</td>' . "\n";
	}

	function RemoveTag($line) {
		$pattern = "/\<span(.*)\'\>|\<\/span\>/i";
		return preg_replace($pattern, '', $line);
	}

	// Gives the string of the full citation, like for in a list
	function CitationStr($entry) {
		global $Path;
		$str = $this->StartCitationStr($entry);
		$fullnames = $this->AuthorsStr($entry);
		$str .= '<span class="bibtex-author">' . ($fullnames[strlen($fullnames)-1] == '.' ? substr($fullnames, 0, -1) : $fullnames) . '.</span> ';
		$str .= '<span class="bibtex-title"><a href="'.(!isset($entry['paperurl']) ? 'http://www.google.com/search?q=' . $this->RemoveTag($entry['title']) : $this->paperDir . $entry['paperurl'] ). '">' . $entry['title'] . '</a></span>. ';
		$str .= (isset($entry['booktitle']) ? 'In <span class="bibtex-booktitle">' . $entry['booktitle'] . '</span>' : '');
		$str .= (isset($entry['journal'])?' <span class="bibtex-jname">' . $entry['journal'] . '</span>':'');
		$str .= (isset($entry['volume'])?', <span class="bibtex-volume">'.$entry['volume'].'</span>':'');
		$str .= ((isset($entry['volume']) && isset($entry['number'])) ? '<span class="bibtex-number">('.$entry['number'].')</span>':'');
		$str .= (isset($entry['pages']) ? (isset($entry['number']) || isset($entry['volume']) ? '' : ', ') .'<span class="bibtex-pages">'.(isset($entry['volume'])?':':'pages ').'' . $this->PagesStr($entry) . '</span>' : '');
		$str .=	(isset($entry['publisher']) ? ((isset($entry['booktitle']) || (isset($entry['journal']) || isset($entry['volume'])) ? ', ' : '') . '<span class="bibtex-publisher">' . $entry['publisher'] . '</span>'):'');
		$str .= (isset($entry['year']) ? ', <span class="bibtex-year">' .$entry['year'] . '</span>.' : '' );
		$str .= $this->CitationNoteStr($entry);
		$str .= $this->CitationImplementUrlStr($entry);
		$str .= $this->EndCitationStr();
		return $str;
	}
	function CitationNoteStr($entry) {
		$str = (isset($entry['note']) ? ', <span class="bibtex-note">(' .$entry['note'] . ')</span>.' : '' );
		return $str;
	}
	function CitationImplementUrlStr($entry) {
		global $Path;
		//$str = (isset($entry['implementurl']) ? ' <a href="' . $entry['implementurl'] . '" class="bibtex-implement-url">(Implementation)</a>' : '' );
		$str = (isset($entry['implementurl']) ? ' <a href="' . $entry['implementurl'] . '" class="bibtex-implement-url"><img src="'.$Path['img-icons'].$this->icons['impl'].'" alt="implementation" /></a>' : '' );
		return $str;
	}

	function StartCitationStr($entry) {
		$str = '<span class="bibtex-' . $entry['type'] . '">';
		return $str;
	}
	function EndCitationStr() {
		return '</span>';
	}

	function AuthorsStr($entry) {
		if(($entry['type'] == 'proceedings' || $entry['type'] == 'collection' || $entry['type'] == 'book') && isset($entry['editor'])) {
			return $this->FullNamesStr($entry['editor']) . ' (eds)';
		} else if(isset($entry['author'])) {
			return $this->FullNamesStr($entry['author']);
		} else {
			return '?';
		}
	}
	function FullNamesStr($author, $maxnum=-1) {
		$name_arr = explode(' and ', $author);
		$num_names = count($name_arr);
		if($maxnum > 0 && $num_names > $maxnum) {
			return substr($name_arr[0], 0, strpos($name_arr[0], ',')) . ' et al.';
		} else {
			$str = '';
			$str .= $name_arr[0];
			for($i=1; $i < $num_names-1; $i++) {
				$str .= ', ' . $name_arr[$i];
			}
			if($num_names > 1) {
				$str .=  ' &amp; ' . $name_arr[$num_names-1];
			}
		}
		return $str;
	}
	function PagesStr($entry) {
		return str_replace('--', '-', $entry['pages']);
	}

	//////////////////////////////////////////////////////////////////////////////
	// Functions to dress up in-text references, e.g., Vreeken et al. [1]
	//////////////////////////////////////////////////////////////////////////////

	// Gives the string of a textual reference to a citation in the bibliography
	function TextualRefStr($entry, $usage) {
		return $this->LastNamesStr($entry, 2) . ' ' . $this->ListStartStr() . $this->ListRefStr($entry, $usage) . $this->ListEndStr();
	}
	function LastNamesStr($entry, $maxnum=-1) {
		$name_arr = explode(' and ', $entry['author']);
		$num_names = count($name_arr);
		if($maxnum > 0 && $num_names > $maxnum) {
			return substr($name_arr[0], 0, strpos($name_arr[0], ',')) . ' et al.';
		} else {
			$str = '';
			$str .= substr($name_arr[0], 0, strpos($name_arr[0], ','));
			for($i=1; $i < $num_names-1; $i++) {
				$str .=  ', ' . substr($name_arr[$i], 0, strpos($name_arr[$i], ','));
			}
			if($num_names > 1)
				$str .=  ' &amp; ' . substr($name_arr[$num_names-1], 0, strpos($name_arr[$num_names-1], ','));
		}
		return $str;
	}


	//////////////////////////////////////////////////////////////////////////////
	// Functions to dress up a list of references, e.g., [1,2,3]
	//////////////////////////////////////////////////////////////////////////////

	// Gives the string of a parenthesised reference to a citation in the bibliography
	abstract function ListRefStr($entry, $usage);

	function StartListStr() {
		$str = '<span class="bibtex-list bibtex-'.$this->GetPrinterName().'">';;
		$str .= '<span class="bibtex-list-start">';
		$str .= $this->ListStartStr();
		$str .= '</span>';
		return $str;
	}
	function EndListStr() {
		$str = '<span class="bibtex-list-end">';
		$str .= $this->ListEndStr();
		$str .= '</span>';
		$str .= '</span>';
		return $str;
	}
	function SepListStr() {
		$str = '<span class="bibtex-list-sep">';
		$str .= $this->ListSepStr();
		$str .= '</span>';
		return $str;
	}
	
	// base ListStartStr()
	function ListStartStr() {
		return '[';
	}
	// base ListEndStr()
	function ListEndStr() {
		return ']';
	}
	// base ListSepStr()
	function ListSepStr() {
		return ',';
	}
	// base BaseUnknownRefStr()
	function UnknownRefStr() {
		return '?';
	}

}

require_once($Path['lib-bibtex'] . 'lib_bibtex-printers-abbrv.inc.php');
require_once($Path['lib-bibtex'] . 'lib_bibtex-printers-natbib.inc.php');
require_once($Path['lib-bibtex'] . 'lib_bibtex-printers-numeric.inc.php');
?>