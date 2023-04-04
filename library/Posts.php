<?php
include('Connection.php');

class Posts {
    private $_connection;

    function __construct() {
        $connectionClass = new Connection();
        $this->_connection = $connectionClass->connect();

    }

    public function insert($argument) 
    {
        $columns = '';
        $values = '';

        foreach($argument['values'] as $column_name => $column_value) {
            $columns .= "`". $column_name . "`,";
            $values .= "'". $column_value . "',";
        }

        $sql = "INSERT INTO " . $argument['table'] . " (";
        $sql .= rtrim($columns, ',') . ") ";
        $sql .= "VALUES (" . rtrim($values, ',') . ")";

        $this->_connection->exec($sql);
        //echo $sql;
        //json_encode($argument);
        

    }
}
$id = $_POST['id'];
$title = $_POST['title'];
$posts = $_POST['posts'];
$user_id = $_POST['user_id'];



$dal = new Posts();
$dal->insert([
    'table' => 'posts',
    'values' => [
        'id' => $id,
        'title' => $title,
        'posts' => $posts,
        'users_id' => $user_id,
        
    ]
]);
