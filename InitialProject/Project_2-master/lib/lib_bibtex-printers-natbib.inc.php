<?php
require_once($Path['lib-bibtex'] . 'lib_bibtex-printers.inc.php');

//////////////////////////////////////////////////////////////////////////////
// class NatbibPrinter
//////////////////////////////////////////////////////////////////////////////
class NatbibPrinter extends BasePrinter {
	// Name of this Printer
	function GetPrinterName() { return 'natbib'; }

	// Gives the string of the full citation, for use in the bibliography, so with ref/key if needed
	function BibliographyEntryStr($entry, $usage) {
		$str = $this->StartBibliographyEntryStr($entry);
		$str .= $this->StartBibliographyCitationStr();
		$str .= $this->CitationStr($entry);
		$str .= $this->EndBibliographyCitationStr();
		$str .= $this->EndBibliographyEntryStr();
		return $str;
	}

	// Gives the string of the full citation, like for in the bibliography
	function CitationStr($entry) {
		$str = $this->StartCitationStr($entry);
		$fullnames = $this->AuthorsStr($entry);
		$str .= '<span class="bibtex-author">' . ($fullnames[strlen($fullnames)-1] == '.' ? substr($fullnames, 0, -1) : $fullnames) . '.</span> ';
		$str .= '(<span class="bibtex-year">' .$entry['year'] . '</span>)';
		$str .= ' <span class="bibtex-title"><a href="'.(!isset($entry['paperurl']) ? 'http://www.google.com/search?q=' . $this->RemoveTag($entry['title']) : $entry['paperurl'] ). '">' . $entry['title'] . '</a></span>. ';
		$str .= (isset($entry['booktitle']) ? 'In <span class="bibtex-booktitle">' . $entry['booktitle'] . '</span>' : '');
		$str .= (isset($entry['journal'])?' <span class="bibtex-jname">' . $entry['journal'] . '</span>':'');
		$str .= (isset($entry['volume'])?', <span class="bibtex-volume">'.$entry['volume'].'</span>':'');
		$str .= (isset($entry['number'])?'<span class="bibtex-number">('.$entry['number'].')</span>':'');
		$str .= (isset($entry['pages']) ? (isset($entry['number']) || isset($entry['volume']) ? '' : ', ') .'<span class="bibtex-pages">'.(isset($entry['volume'])?':':'pages ').'' . $this->PagesStr($entry) . '</span>' : '');
		$str .=	(isset($entry['publisher']) ? ', <span class="bibtex-publisher">' . $entry['publisher'] . '</span>':'');
		$str .= (isset($entry['note']) ? ', <span class="bibtex-note">' .$entry['note'] . '</span>.' : '' );
		$str .= $this->CitationNoteStr($entry);
		$str .= $this->CitationImplementUrlStr($entry);
		$str .= $this->EndCitationStr();
		return $str;
	}

	// Gives the string of a textual reference to a citation in the bibliography
	function TextualRefStr($entry, $usage) {
		return $this->LastNamesStr($entry, 2) . ' ' . $this->ListStartStr() . $entry['year'] . $this->ListEndStr();
	}

	// Gives the string of a parenthesised reference to a citation in the bibliography
	function ListRefStr($entry, $usage) {
		
		$str = '<span class="bibtex-ref bibtex-key-'.$entry['key'].'">';
		$str .= ($usage['ref'] === false ? $this->UnknownRefStr() : $this->LastNamesStr($entry, 2) . ', ' . $entry['year']);
		$str .= '</span>';
		return $str;
	}
	function ListStartStr() {
		return '(';
	}
	function ListEndStr() {
		return ')';
	}
	function ListSepStr() {
		return '; ';
	}
}
?>