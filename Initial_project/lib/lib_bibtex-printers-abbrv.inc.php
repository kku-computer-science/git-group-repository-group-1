<?php
require_once($Path['lib-bibtex'] . 'lib_bibtex-printers.inc.php');

//////////////////////////////////////////////////////////////////////////////
// class AbbrvPrinter
//////////////////////////////////////////////////////////////////////////////
class AbbrvPrinter extends BasePrinter {
	// Name of this Printer
	function GetPrinterName() { return 'abbrv'; }

	// Gives the string of a parenthesised reference to a citation in the bibliography
	function ListRefStr($entry, $usage) {
		
		// nice idea, but trying to do this a bit more web 2.0
		//$str = '<a href="" onMouseOver=javascript:highlight("'. $entry['key'] . '") onMouseOut=javascript:dehighlight("'. $entry['key'] . '")><span class="bibtex-ref">';
		
		$str = '<span class="bibtex-ref bibtex-key-'.$entry['key'].'">';
		if($usage['ref'] === false)
			$str .= $this->UnknownRefStr();
		else {
			$str .= $this->AbbrvNamesStr($entry);
			$str .= substr($entry['year'],-2);				
		}
		$str .= '</span>';
		return $str;
	}

	function AbbrvNamesStr($entry, $num = 3) {
		$names = explode(' and ', $entry['author']); 
		$str = '';
		$num = $num == -1 || count($names) < $num ? count($names) : $num;
		for($i=0; $i < $num; $i++) {
			$str .= $names[$i][0];
			if(strtolower($names[$i][0]) == $names[$i][0] && strpos($names[$i],' ') != false) {
				$str .= substr($names[$i], strpos($names[$i],' ')+1,1);
			}
		}
		if(count($names) > $num)
			$str .= '+';
		return $str;
	}
}

?>