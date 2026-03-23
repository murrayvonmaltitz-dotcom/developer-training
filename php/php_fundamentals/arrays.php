<?php

//simple array
$colors = ['red', 'green', 'blue'];
//add value to the end of an array
$colors[] = 'yellow';

//assosiative arrays (named keys), can mix types
$user = [
    'name' => 'Murray',
    'age' => 40
];

//nested arrays can contain other arrays 
$blogPost = [
    'title' => 'Getting Started with PHP',
    'author' => [
        'name' => 'John',
        'role' => 'editor'
],
'comments' => [
    ['user' => 'Jane', 'text' => 'Great article!'],
    ['user' => 'Bob', 'text' => 'Thanks for sharing']
]
];

//access single value with numbered index key 0 based
var_dump($colors);

//access single value with named key
var_dump($user['name']);

//accessing arrays within nested array by linkng keys
var_dump($blogPost['comments'][0]['user']);

//view number of items within an array, good for looping 
var_dump(count($colors));

//check if a variable is set
if (isset($colors)) {
    echo "true";
}

//remove an array value by index (red)
unset($colors[0]);
var_dump($colors);




