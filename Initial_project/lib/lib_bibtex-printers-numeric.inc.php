<?php
require_once($Path['lib-bibtex'] . 'lib_bibtex-printers.inc.php');

//////////////////////////////////////////////////////////////////////////////
// class NumericPrinter
//////////////////////////////////////////////////////////////////////////////
class NumericPrinter extends BasePrinter {
	// Name of this Printer
	function GetPrinterName() { return 'numeric'; }

	// Gives the string of a parenthesised reference to a citation in the bibliography
	function ListRefStr($entry, $usage) {
		
		// nice idea, but trying to do this a bit more web 2.0
		//$str = '<a href="" onMouseOver=javascript:highlight("'. $entry['key'] . '") onMouseOut=javascript:dehighlight("'. $entry['key'] . '")><span class="bibtex-ref">';
		
		$str = '<span class="bibtex-ref bibtex-key-'.$entry['key'].'">';
		$str .= ($usage['ref'] === false ? $this->UnknownRefStr() : $usage['ref']+1);
		$str .= '</span>';
		return $str;
	}
}

?>