<?php
include_once('catalog.php');
session_start();
include_once('config.php');
$object = new Catalog(LOCALHOST,NAME,PASSWORD,DATABASE);
$base = new WorkDB(LOCALHOST,NAME,PASSWORD,DATABASE);
$id = $_SESSION['ID'];
$data = $base->selectID($id);
$result = $object->loadFieldFromTable($data);
if (@$_POST['update']) {
    $object->initialBooksFields(NULL, $_POST['description'], $_POST['price'], NULL, NULL);
    if($object->updateBook($_POST['ID'])) {
        unset($object);
        header("Location: correctBook.php");
    }
}
unset($object);
unset($base);
include "updateBook.htm";
?>