<?php

//foreach loop

$colors = ['red', 'blue', 'green'];

foreach($colors as $color) {
    var_dump($color);
}

//optional access to keys in loop
foreach($colors as $key=>$color) {
    var_dump($key);
}


//example of use case, getting total of all prices in array
$invoiceItems = [
['item' => 'Laptop', 'price' => 1200],
['item' => 'Mouse', 'price' => 75],
['item' => 'Keyboard', 'price' => 100]
];

$totals = 0;

foreach($invoiceItems as $item) {
    $totals += $item['price'];
}

var_dump($totals);

//for loop, more control over interation (initial value; condition; incrementation)
for ($i = 0; $i < 5; $i++) {
    var_dump($i);
}

//while loop: runs on a condition usually while condition = true
$count = 0;
while ($count < 5) {
    var_dump($count);
    $count ++;
}

//do while loop will run at least once even if while condition is false
$count = 50;

do {
    var_dump($count);
    $count ++;
    }
while ($count < 5);

//continue keyword tells loop to run next iteration and end current iteration
$users = [
    ['name' => 'John', 'newsletter' => true],
    ['name' => 'Jane', 'newsletter' => false],
    ['name' => 'Bob', 'newsletter' => true]
    ];
    
    foreach($users as $user) {
        if (! $user['newsletter']){
            continue;
            }
            var_dump("send NL to " . $user['name']);
            }
            
//break keyword tells loop to stop current and future iterations 
$users = [
['name' => 'John', 'newsletter' => true],
['name' => 'Jane', 'newsletter' => false],
['name' => 'Bob', 'newsletter' => true]
];

foreach($users as $user) {
    if (! $user['newsletter']){
        break;
    }
    var_dump("send NL to " . $user['name']);
}
    
    
