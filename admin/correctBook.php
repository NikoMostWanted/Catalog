<?php
include_once('catalog.php');
include_once('config.php');
$object = new Catalog(LOCALHOST,NAME,PASSWORD,DATABASE);
$base = new WorkDB(LOCALHOST,NAME,PASSWORD,DATABASE);
$result = $object->loadTable();
if (@$_POST['update']) {
    $key = key($_POST['update']);
    $id = $_POST["ID"][$key];
    session_start();
    $_SESSION['ID'] = $id;
    header("Location: updateBook.php");
}
if (@$_POST['delete']) {
    $key = key($_POST['delete']);
    $id = $_POST["ID"][$key];
    $base->delete($id);
    header("Location: correctBook.php");
}
unset($object);
unset($base);
include "correctBook.htm";
?>
