<?php

//basic function creation with parameter and defualt value
function greet($name= 'you') {
    echo "hello $name";
}

//call a function with a parameter value
greet("Murray");
//call a function using the default value
greet();

//funtion that returns a output with specific parameter types and return type
function add(int $num1, int $num2) : int 
{
    return $num1 + $num2;
}

echo add(11,3);

//can store function in a varable, no function name needed
$greet = function($name = 'you') {
    echo "hello $name";
};

//call function saved as variable
$greet();

