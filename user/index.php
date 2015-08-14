<?php
include_once('../admin/catalog.php');
include_once('../admin/config.php');
$object = new Catalog(LOCALHOST, NAME, PASSWORD, DATABASE);
$genre = $object->searchCriteria('genre');
$author = $object->searchCriteria('author');
unset($object);
include "index.htm";
?>
