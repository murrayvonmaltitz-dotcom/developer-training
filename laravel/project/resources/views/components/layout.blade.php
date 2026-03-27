@props([
    'title' => 'Laracast' 
])

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        nav > a {
            color: blue;
        }
    </style>
</head>
<body class="">
<x-nav />
    <main class="max-w-3xl mx-auto mt-6">
        {{ $slot }}
    </main>
</body>
</html>