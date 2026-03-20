<?php

use Core\Validator;
use Core\App;

$email = $_POST['email'];
$password = $_POST['password'];

//validate from inputs
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please prove a password between 7 and 255 characters';
}

if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve('Core\Database');

$user = $db->query("SELECT * FROM users WHERE email = :email", [
    ':email' => $email
])->find();

if ($user) {
    header('location: /');
    exit();
} else {
    $db->query("INSERT INTO users (email, password) VALUES (:email, :password)", [
        ":email" => $email,
        ":password" => password_hash($password, PASSWORD_BCRYPT)
    ]);

    $_SESSION['user'] = [
    "email" => $email
    ];

    header('location: /');
    exit();
}

