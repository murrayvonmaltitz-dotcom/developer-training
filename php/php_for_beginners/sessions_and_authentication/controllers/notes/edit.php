<?php

use Core\App;

$db = App::resolve('Core\Database');

$currentUserId = 1;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [  
    ':id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view("notes/edit.view.php", [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note
]);



