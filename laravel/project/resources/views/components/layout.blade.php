@props([
    'title' => 'Laracast' 
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        nav > a {
            color: blue;
        }
    </style>
</head>
<body class="bg-gray-700 p-6 max-w-xl mx-auto text-white">
    <main>
        {{ $slot }}
    </main>
</body>
</html>