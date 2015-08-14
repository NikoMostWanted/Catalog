<?php

class Catalog
{
    private $nameBook;
    private $description;
    private $price;
    private $author;
    private $genre;
    private $object;

    function __construct($localhost, $name, $password, $database)
    {
        include_once('workDB.php');
        $this->object = new WorkDB($localhost,$name,$password,$database);
    }

    function initialBooksFields($nameBook, $description, $price, $author, $genre)
    {
        $this->nameBook = $nameBook;
        $this->description = $description;
        $this->price = $price;
        $this->author = $author;
        $this->genre = $genre;
    }

    function searchCriteria($criteria)
    {
        $data = $this->object->searchCriteria($criteria);
        while ($row = mysqli_fetch_assoc($data)) {
            $criteria_val[] = $row[$criteria];
        }
        return @$criteria_val;
    }

    function order($to, $subject, $message)
    {
        mail($to, $subject, $message);
    }

    function selectMore($id)
    {
        $data = $this->object->selectID($id);
        $num = mysqli_num_fields($data);
        while ($row = mysqli_fetch_assoc($data)) {
            $text = array();
            $j = 1;
            while ($j < $num) {
                $text[mysqli_fetch_field_direct($data, $j)->name] = $row[mysqli_fetch_field_direct($data, $j)->name];
                $j++;
            }
        }
        return $text;
    }

    function loadTable()
    {
        $data = $this->object->selectAll();
        $num = mysqli_num_fields($data);
        $i = 0;
        $result = array();
        while ($row = mysqli_fetch_assoc($data)) {
            $j = 0;
            while ($j < $num) {
                $result[$i][$j] = $row[mysqli_fetch_field_direct($data, $j)->name];
                $j++;
            }
            $i++;
        }
        return $result;
    }

    function loadBooks($key, $value)
    {
        $data = $this->object->loadBooks($key,$value);
        $num = mysqli_num_fields($data);
        $result = array();
        $i = 0;
        while ($row = mysqli_fetch_assoc($data)) {
            $result[$i][] = $row[mysqli_fetch_field_direct($data, 0)->name];
            $text = "";
            $j = 1;
            while ($j < $num) {
                $text .= $row[mysqli_fetch_field_direct($data, $j)->name] . ' ';
                $j++;
            }
            $result[$i][] = $text;
            $i++;
        }
        return $result;
    }

    function loadFieldFromTable($data)
    {
        $num = mysqli_num_fields($data);
        $result = array();
        while ($row = mysqli_fetch_assoc($data)) {
            $j = 0;
            while ($j < $num) {
                $value = $row[mysqli_fetch_field_direct($data, $j)->name];
                $field = mysqli_fetch_field_direct($data, $j)->name;
                $result[$field] = $value;
                $j++;
            }
        }
        return $result;
    }

    function addBook()
    {
        $data = array();
        $link = $this->object->connectToBase();
        if ($this->validationFields($this->author, $this->genre)) {
            $this->object->addBook($this->nameBook,$this->genre, $this->author, $this->description, $this->price);
        }
        mysqli_close($link);
        return $data;
    }

    function validationFields($author, $genre)
    {
        $flag = true;
        if (!preg_match('/^[a-zA-Zа-яА-Я\s]+$/u', $author)) {
            echo "Неверное название автора! В авторе должны быть только буквы!<br/>";
            $flag = false;
        }
        if (!preg_match('/^[a-zA-Zа-яА-Я\s]+$/u', $genre)) {
            echo "Неверное название жанра! В жанре должны быть только буквы!<br/>";
            $flag = false;
        }
        return $flag;
    }

    function updateBook($id)
    {
        $flag = $this->object->updateBook($id,$this->description,$this->price);
        return $flag;
    }

    function __destruct()
    {
        unset($this->nameBook);
        unset($this->description);
        unset($this->price);
        unset($this->author);
        unset($this->genre);
        unset($this->object);
    }
}