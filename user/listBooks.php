<?php
include_once('../admin/catalog.php');
include_once('../admin/config.php');
$object = new Catalog(LOCALHOST, NAME, PASSWORD, DATABASE);
session_start();
if (@empty($_GET)) {
    $_GET[$_SESSION['key']] = $_SESSION['value'];
}
$result = $object->loadBooks(key($_GET), current($_GET));
$_SESSION['key'] = key($_GET);
$_SESSION['value'] = current($_GET);
unset($object);
include "listBooks.htm";
?>
