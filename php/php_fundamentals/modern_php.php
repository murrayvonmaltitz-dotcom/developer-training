<?php

class User {
	
    public function __construct(
        public readonly string $name,
	    public readonly string $email,
    ) 
    {
    }
}

$user = new User("murray", "test@test.com");
// below won't work because name is readonly
$user->name = "Tom";

//switch statement (same as js)
$status = 200;

switch ($status) {
    case 200:
        $result = 'success';
        break;
    case 404:
        $result = 'not found';
        break;
    case 500:
        $result = 'server error';
        break;
    default:
        $result = 'unknown status';
}

echo $result;

//updated match where we can directly get result
$status = 200;

$result = match ($status) {
    200 => 'success',
    404 => 'not found',
    500 => 'server error',
    default => 'unknown status'
};

echo $result;

class Address {
    public function getCountry() {
        return "South Africa";
    }
}

class Order {
    public function getAddress() {
        return null;
    }
}

$order = new Order();


//return country if address not null (inefficient way)
$country = null;

if ($order->getAddress()) {
    $country = $order->getAddress()->getCountry();
}

//better way ? applies code after if not null (null safe operator)
$country = $order->getAddress()?->getCountry();

var_dump($country);

// ? on float allows values to be null
class Product {
	
    public function __construct(
        public string $name,
	    public ?float $price = null,
	    public ?float $beforePrice = null,
	    public ?float $afterPrice = null,
    ) 
    {
    }
}

//set products with some values as null (default)
$product = new Product(
    'laptop', 
    null,
    null,
    100
);

//better way with named arguments, can remove optional values
$product = new Product(
    name: 'laptop', 
    afterPrice: 100
);

var_dump($product);