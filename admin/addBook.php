<?php
if(@$_POST['add']) {
    include_once('catalog.php');
    include_once('config.php');
    $object = new Catalog(LOCALHOST,NAME,PASSWORD,DATABASE);
    $object->initialBooksFields($_POST['nameBook'],$_POST['description'],$_POST['price'],$_POST['author'],$_POST['genre']);
    $data = $object->addBook();
    unset($object);
}
include "addBook.htm";
?>
