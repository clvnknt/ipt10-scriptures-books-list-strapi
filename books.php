<?php

require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = 'e511509e467ffb0429a6f49a929be83defcb98063059b5a716c0b25fe518d9ff821b48bd633f777e83f3b3cc8bd6fac2fb52cb8b7dd421bd7557446c6f03de5e8d07c4caa9ed1d95982ef95afc077db858bfe59dc58468a6656cbb6cc2a92546411dd35eee1142dbeb9e60a7ac82fea10b9a0b1e0bfc1482bee0c0e94a4511b5';

    $client = new Client([
        'base_uri' => 'http://localhost:1337/api/',
    ]);

    $headers = [
        'Authorization' => 'Bearer ' . $token,        
        'Accept'        => 'application/json',
    ];

    $response = $client->request('GET', 'books?pagination[pageSize]=66', [
        'headers' => $headers
    ]);

    $body = $response->getBody();
    $decoded_response = json_decode($body);
    return $decoded_response;
}

$books = getBooks();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <title>Scriptures Books List from Strapi</title>

</head>
<body>
    <div class="container">
        <h1>Scriptures Books List from Strapi</h1>
        <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Author</th>
                        <th scope="col">Category</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($books->data as $bookData){ 
                    $book = $bookData->attributes;?>
                    <tr>
                        <th scope="row"><?php echo $bookData->id?></th>
                        <td><?php echo $book->name ?></td>
                        <td><?php echo $book->author?></td>
                        <td><?php echo $book->category?></td>
                    </tr>
                    <?php }?>
                </tbody>
        </table>
    </div>
</body>
</html>