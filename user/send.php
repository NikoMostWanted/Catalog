<?php
    session_start();
    include_once('../admin/catalog.php');
    include_once('../admin/config.php');
    $object = new Catalog(LOCALHOST, NAME, PASSWORD, DATABASE);
    $author = $_SESSION['text']['author'];
    $nameBook = $_SESSION['text']['book'];
    $price = $_SESSION['text']['price'];
    $text = 'Адрес: ' . $_POST['address'] . ' ФИО: ' . $_POST['fio'] . ' Название книги: ' . $nameBook . ' Автор: ' . $author . ' Цена: ' . $price . ' грн Количество экземпляров: ' . $_POST['count'];
    $object->order(EMAIL, 'order', $text);
    unset($object);
    session_unset();
    session_destroy();
    include "send.htm";
?>
