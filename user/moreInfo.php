<?php
session_start();
include_once('../admin/catalog.php');
include_once('../admin/config.php');
$object = new Catalog(LOCALHOST, NAME, PASSWORD, DATABASE);
$text = $object->selectMore($_GET['id']);
$_SESSION['text'] = $text;
$nameBook = $text['book'];
$description = $text['description'];
$price = $text['price'];
$author = $text['author'];
unset($object);
include "moreInfo.htm";
?>