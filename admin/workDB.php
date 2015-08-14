<?php

class WorkDB
{
    private $localhost;
    private $name;
    private $password;
    private $database;

    private $queryForSelectAll = "SELECT product.id, book.book, author.author, genre.genre, product.description, product.price
                  FROM (genre INNER JOIN ((book INNER JOIN (author INNER JOIN bookauthor ON author.id = bookauthor.id_author) ON book.id = bookauthor.id_book)
                  INNER JOIN bookgenre ON book.id = bookgenre.id_book) ON genre.id = bookgenre.id_genre)
                  INNER JOIN product ON product.id=bookauthor.id WHERE  bookauthor.id=bookgenre.id";

    public function __construct($localhost,$name,$password,$database)
    {
        $this->localhost=$localhost;
        $this->name=$name;
        $this->password=$password;
        $this->database=$database;
    }

    public function addBook($nameBook,$genre,$author,$description,$price)
    {
        $link = $this->connectToBase();
        mysqli_query($link,"INSERT INTO book VALUES(NULL,'$nameBook')");
        $id_book = mysqli_fetch_assoc(mysqli_query($link,"SELECT id FROM book WHERE book='$nameBook'"))['id'];
        mysqli_query($link,"INSERT INTO genre VALUES(NULL,'$genre')");
        $id_genre = mysqli_fetch_assoc(mysqli_query($link,"SELECT id FROM genre WHERE genre='$genre'"))['id'];
        mysqli_query($link,"INSERT INTO author VALUES(NULL,'$author')");
        $id_author = mysqli_fetch_assoc(mysqli_query($link,"SELECT id FROM author WHERE author='$author'"))['id'];
        mysqli_query($link,"INSERT INTO bookauthor VALUES(NULL,'$id_book','$id_author')");
        mysqli_query($link,"INSERT INTO bookgenre VALUES (NULL,'$id_book','$id_genre')");
        mysqli_query($link,"INSERT INTO product VALUES(NULL,'$description','$price')");
        mysqli_close($link);
    }

    public function connectToBase()
    {
        $link = mysqli_connect($this->localhost, $this->name, $this->password);
        if (mysqli_connect_errno()) {
            printf("Error connect: %s\n", mysqli_connect_error());
            exit();
        }
        mysqli_select_db($link, $this->database);
        return $link;
    }

    public function searchCriteria($criteria)
    {
        $link = $this->connectToBase();
        $query = "SELECT DISTINCT $criteria
                  FROM (genre INNER JOIN ((book INNER JOIN (author INNER JOIN bookauthor ON author.id = bookauthor.id_author) ON book.id = bookauthor.id_book)
                  INNER JOIN bookgenre ON book.id = bookgenre.id_book) ON genre.id = bookgenre.id_genre)
                  INNER JOIN product ON product.id=bookauthor.id WHERE  bookauthor.id=bookgenre.id";
        $data = mysqli_query($link,$query);
        mysqli_close($link);
        return $data;
    }

    function selectID($id)
    {
        $link = $this->connectToBase();
        $data = mysqli_query($link, $this->queryForSelectAll." AND product.id='$id'");
        mysqli_close($link);
        return $data;
    }

    public function selectAll()
    {
        $link = $this->connectToBase();
        $data = mysqli_query($link,$this->queryForSelectAll);
        mysqli_close($link);
        return $data;
    }

    public function updateBook($id,$description,$price)
    {
        $flag = true;
        $link = $this->connectToBase();
        $query = "UPDATE product SET product.description ='$description', product.price='$price'  WHERE (((product.id)=$id))";
        mysqli_query($link,$query) or $flag = false;
        mysqli_close($link);
        return $flag;
    }

    public function loadBooks($key,$value)
    {
        $link = $this->connectToBase();
        $data = mysqli_query($link,$this->queryForSelectAll." AND $key.$key='$value'");
        mysqli_close($link);
        return $data;
    }

    public function delete($id)
    {
        $link = $this->connectToBase();
        mysqli_query($link,"DELETE FROM product WHERE id=$id");
        mysqli_query($link,"DELETE FROM bookauthor WHERE id=$id");
        mysqli_query($link,"DELETE FROM bookgenre WHERE id=$id");
        mysqli_close($link);
    }

    function __destruct()
    {
        unset($this->localhost);
        unset($this->name);
        unset($this->password);
        unset($this->database);
        unset($this->queryForSelectAll);
    }
}

?>