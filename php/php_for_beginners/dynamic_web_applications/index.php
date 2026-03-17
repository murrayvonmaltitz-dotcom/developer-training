<?php
require 'functions.php';
// require 'router.php';

//connect to our MySQL database.
$dsn = "mysql:host=localhost:3306;dbname=dev_training_demo;charset=utf8mb4;password=secret";

$pdo = new PDO($dsn, 'user');

$statement = $pdo->prepare("SELECT * FROM posts");

$statement->execute();

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) {
    echo "<li>" . $post["title"] . "</li>";
}