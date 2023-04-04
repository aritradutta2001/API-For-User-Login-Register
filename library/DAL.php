<?php
include('Connection.php');

class DAL {
    private $_connection;

    function __construct() {
        $connectionClass = new Connection();
        $this->_connection = $connectionClass->connect();

    }

    public function insert($argument) 
    {
        $columns = '';
        $values = '';
        $c='';

        foreach($argument['values'] as $column_name => $column_value) 
        {
            $columns .= "`". $column_name . "`,";
            $values .= "'". $column_value . "',";
        }
        foreach($argument['where'] as $c_name => $c_value) 
        {
            $c.="`".$c_name."`= "."'".$c_value."'";
        }
        $sql1 = "SELECT * FROM " . $argument['table'] ;
        $sql1.= " WHERE ".$c;
		//echo $sql1;
		
        $result=$this->_connection->prepare($sql1);
        $result->execute();

        if($result->rowCount()>0)
        {
            echo "Email Already Exists";
        }
        else
        {
            $sql = "INSERT INTO " . $argument['table'] . " (";
            $sql .= rtrim($columns, ',') . ") ";
            $sql .= "VALUES (" . rtrim($values, ',') . ")";

            $this->_connection->exec($sql);
        }
        //echo $sql;

    }
}
$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = md5($_POST['password']);


$dal = new DAL();
$dal->insert([
    'table' => 'users',
    'values' => [
        'id' => $id,
        'fname' => $fname,
        'lname' => $lname,
        'email' => $email,
        'password'=>$password,
    ],
    'where' => [
        'email'=> $email,
    ],
]);
