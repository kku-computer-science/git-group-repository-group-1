<?php
require_once($Path['lib-bibtex'] . 'lib_bibtex.inc.php');

function _sqliteRegexp($pattern, $string) {
   return preg_match('/'.$pattern.'/i', $string);
}

class DBibtex extends Bibtex {
	var $bibdb = false;
	
	function __construct() {
		parent::__construct();
		
		$num_args = func_num_args();
		$args = func_get_args();
		
		// first argument will be the database
		if($num_args > 0) {
			$this->bibdb = $args[0];
			$this->bibdb->sqliteCreateFunction('regexp', '_sqliteRegexp', 2);	
		}
		
		// second to n'th argument will be bib files, we potentially have to re-parse
		if($num_args > 1) {

			// get information of provided files
			$afiles = array();
			$fnames = array();
			for($i=1; $i < $num_args; $i++) {
				if(is_string($args[$i])) {
					$afname = stripos($args[$i], '.bib') === false ? $args[$i] . '.bib' : $args[$i];
					if(file_exists($afname)) {
						$fnames[] = $afname;
						$afdate = (string) filemtime($afname);
						$afiles[$afname] = $afdate;
					}
				} else if(is_array($args[$i])) {
					foreach($args[$i] as $file) {
						$afname = stripos($file, '.bib') === false ? $file . '.bib' : $file;
						if(file_exists($afname)) {
							$fnames[] = $afname;
							$afdate = (string) filemtime($afname);
							$afiles[$afname] = $afdate;
						}
					}
				}
			}
			
			// get information of files in database
			$res = $this->bibdb->query("SELECT * FROM bibmeta;");
			$res = $res !== false ? $res->fetchAll(PDO::FETCH_ASSOC) : array();
			$dfiles = array();
			foreach($res as $row)
				$dfiles[$row['fname']] = $row['fdate'];
			
			// check whether any changes have been made
			$changed = false;
			foreach($afiles as $afname => $adate) {
				if(!isset($dfiles[$afname]) || $dfiles[$afname] != $adate) {
					$changed = true;
					break;
				} else {
					unset($dfiles[$afname]);
				}
			}
			
			// something has changed, so we need to rescan
			if(count($dfiles) > 0 || $changed == true) {
				// 1) parse
				$this->ParseFiles($fnames);
				
				// 2) clean
				$sql = "BEGIN TRANSACTION;";
				$this->bibdb->query($sql);
				$sql = "DELETE FROM bibmeta;";
				$this->bibdb->query($sql);
				$sql = "DELETE FROM bibdata;";
				$this->bibdb->query($sql);
				$sql = "COMMIT TRANSACTION;";
				$this->bibdb->query($sql);
				
			
				// 3) store
				$sql = "BEGIN TRANSACTION;";
				$this->bibdb->query($sql);
				foreach($afiles as $afname => $afdate) {
					$sql = "INSERT INTO bibmeta (fname, fdate) VALUES ('".$afname."','".$afdate."');";
					$this->bibdb->query($sql);
				}
				$sql = "COMMIT TRANSACTION;";
				$this->bibdb->query($sql);

				$sql = "BEGIN TRANSACTION;";
				$this->bibdb->query($sql);
				foreach($this->bibarr as $entry) {
					$sql = "INSERT INTO bibdata";
					$isql = "key";
					$dsql = "'".$entry['key']."'";
					$field = "type";              if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "author";            if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "title";             if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "pages";             if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "publisher";         if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "year";              if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "booktitle";         if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "editor";            if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "journal";           if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "volume";            if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "number";            if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "note";              if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "implementationurl"; if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "paperurl";          if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$field = "tags";              if(isset($entry[$field])) { $isql .= ", ".$field; $dsql .= ", '".DBEscape($this->bibdb, $entry[$field])."'"; }
					$sql .= " (" . $isql . ") VALUES (" . $dsql . ");";
					$res = $this->bibdb->query($sql);
				}
				$sql = "COMMIT TRANSACTION;";
				$this->bibdb->query($sql);
			}
			
			// database ready for use
		}
	}

	//////////////////////////////////////////////////////////////////////////////
	// Interact with Citation Database
	//////////////////////////////////////////////////////////////////////////////
	function HasEntry($key) {
		$key = $this->NormalizeKey($key);
		$sql = "SELECT COUNT() FROM bibdata WHERE key='".$key."';";
		$res = $this->bibdb->query($sql);
		return $res !== false ? $res->fetchColumn() : false;
	}
	function GetEntry($key) {
		$key = $this->NormalizeKey($key);
		$sql = "SELECT * FROM bibdata WHERE key='".$key."';";
		$res = $this->bibdb->query($sql);
		$res = $res->fetch(PDO::FETCH_ASSOC);
		return $res !== false ? $res : false;
	}

	//////////////////////////////////////////////////////////////////////////////
	// Query-based Selection
	//////////////////////////////////////////////////////////////////////////////

	// takes an array, where key => value identifies the key for which the value should match what value (done through preg_match)
	// array('field' => 'val')
	// array('field' => array('OR', 'val1', 'val2')) // nested values defaults to OR
	// array('field' => ..., 'field2' => ...) // default to AND
	function Select($queryArray, $regex=false) {
		if($this->scanning == true)
			return;
		
		$ssql = "SELECT * FROM bibdata";
		$wsql = "";

		$glue = count($queryArray) > 0 && isset($queryArray[0]) && ($queryArray[0] == 'AND' || $queryArray[0] == 'OR') ? $queryArray[0] : "AND";
		$conds = array();
		foreach($queryArray as $field => $cond) {
			if($cond == "AND" || $cond == "OR")
				continue;
			$csql = "";
			if(is_array($cond) && count($cond) > 0 && isset($cond[0]) ) {
				$nglue = $cond[0] == "AND" || $cond[0] == "OR" ? $cond[0] : "OR";
				$nconds = array();
				foreach($cond as $c) {
					if($c != "AND" && $c != "OR")
						$nconds[] = $field . " LIKE '%".DBEscape($this->bibdb, $c)."%'";
				}
				$csql .= trim(count($nconds) > 0 ? '(' . implode(" ".$nglue." ", $nconds) . ')' : '');
			} else {
				if ($regex){
					$csql .= $field . " REGEXP '".DBEscape($this->bibdb, (string) $cond)."'";
				}	else {	
					$csql .= $field . " LIKE '%".DBEscape($this->bibdb, (string) $cond)."%'";
				}
			}
			$csql .= "";
			$conds[] = $csql;
		}
		$wsql = count($conds) > 0 ? " WHERE " . trim(implode(' '.$glue.' ', $conds)) : '';
		$sql = $ssql . $wsql;
		$res = $this->bibdb->query($sql);
		$res = $res->fetchAll(PDO::FETCH_ASSOC);
		foreach($res as $entry) {
			$this->SelectEntry($entry['key'], $entry);
		}
	}
}

function DBEscape($db, $text) {
	$text = $db->quote($text);
	return substr($text, 1, strlen($text)-2);
}
?>
