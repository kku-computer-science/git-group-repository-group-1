<?php 
$k = $key;
$bb->Select(array('key' => $k ));
$bb->SetBibliographyStyle('natbib');
$bb->PrintBibliographySelectedOnly();
?>
