<?php

//connect to our MySQL database and execute a query.
class Database {

    public $connection;

    public function __construct() 
    {
        $dsn = "mysql:host=localhost:3306;dbname=dev_training_demo;charset=utf8mb4;user=user;password=secret";
        
        $this->connection = new PDO($dsn);
    }

    public function query($query)
    {
       
        $statement = $this->connection->prepare($query);

        $statement->execute();

        return $statement;
    }
}
