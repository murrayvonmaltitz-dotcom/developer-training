<?php

//data types
$int = 404;
$float = 404.4;
$string = "404";
$boolean = true;

// appending strings
$text = "Not found";
$status = "404" . $text;

//casting: converting types
$status = (int) "404";
$status = (string) 404;
$status = (int) true;

//php will convert types for certain actions
$status = "404" + 4; // 408
$status = "404" . 4; // "4044"

//outputs the variable and type
var_dump($status);