<?php 

include 'Connection.php';

class Authentication
{
    private $_connection;

    function __construct() 
    {
        $connectionClass = new Connection();
        $this->_connection = $connectionClass->connect();

    }

    public function login($email, $password)
    {
        $password = md5($password);
        

	    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        

	    $result = $this->_connection->prepare($sql);

        $result->execute();

        if($result->rowCount()>0) 
        {
            echo "Exist";
        }
        else
        {
            echo "Not Exist";
        }

    }
}

	/*=  // assignment
    == // check value
    === // check value and data type*/
	