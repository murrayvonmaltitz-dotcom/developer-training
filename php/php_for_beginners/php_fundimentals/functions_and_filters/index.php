<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        body {
            display: grid;
            place-items: center;
            height: 100vh;
            margin: 0;
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <?php
       $books = [
            [
                'name' => 'Do Androids Dream of Electric Sheep',
                'author' => 'Philip K. Dick',
                'releaseYear' => 1968,
                'purchaseUrl' => 'http://example.com'
            ],
            [
                'name' => 'Hail Mary',
                'author' => 'Andy Weir',
                'releaseYear' => 2021,
                'purchaseUrl' => 'http://example.com'
            ],
            [
                'name' => 'The Martian',
                'author' => 'Andy Weir',
                'releaseYear' => 2011,
                'purchaseUrl' => 'http://example.com'
            ],
       ];

       function filterByAuthor($books, $author) {
              $filteredBooks = [];

              foreach ($books as $book) {
                if ($book['author'] === $author) {
                    $filteredBooks[] = $book;
                }
              }
              
              return $filteredBooks;
       }

    ?>

    <ul>
        <?php 
            foreach (filterByAuthor($books, "Andy Weir") as $book) : ?> 
                <li>
                    <a href="<?= $book['purchaseUrl']?>">
                        <?=$book['name']?> (<?= $book['releaseYear'] ?>) - By <?= $book['author'] ?>
                    </a>    
                </li>
        <?php endforeach; ?> 
    </ul>

</body>
</html>