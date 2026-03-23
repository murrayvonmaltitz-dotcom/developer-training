<?php

//classes usually in on files this is just for learning 
//class are used to define and store data and functionality for reusability and structure

//simple class old method of defining properties to classes
// class Product {
//     public string $name;
//     public int $price;
    
//     //constructor actions that run when creating new product 
//     public function __construct($name, $price) {
//         //assigning the public $name & $price a value, $this refferece to current product instance  
//         $this->name = $name;
//         $this->price = $price;
//     }
// }

//new way of defining properties to classes inside constructor (> php 8)
class ProductSimple {
    public function __construct(
        public string $name,
        public int $price
    )
    {
    }

    //class function
    public function isExpensive() : bool 
    {
        return $this->price > 100;
    }
}

//instantiate class (create an object of a class) with name of 'laptop' and price of 1000 (from constructor function)
$product = new ProductSimple('laptop', 1000);
var_dump($product);

//access properties of class
echo $product->name;

//call class method on $product
var_dump($product->isExpensive());

//public methods can be run anywhere, 
//protected can be used within the same class and extended classes, 
//private can only be accessed from specific product

var_dump("////////////////////////");

class Product
{
    public function __construct(
    public string $name,
    public float $price
    ) {}
    
    public function hasDiscount(): bool 
    {
        return $this->price < 100;
    }

    public function getDescription(): string 
    {
        return "{$this->name} costs {$this->price}€";
    }

}

//inherit from Products class (extending a class), eg use $product->getDescription() where $product = new DigitalProduct('app', 1200);
class DigitalProduct extends Product
{
    public function getLink(): string 
    {
        return 'app-link';
    }
}

$product = new DigitalProduct('app', 1200);
var_dump($product->getDescription());