<?php

require_once '../vendor/autoload.php';
$images_path = '../images';
$images = scandir($images_path);
$images = array_diff($images, ['.', '..']);

$loader = new Twig\Loader\FilesystemLoader('../templates');
$twig = new Twig\Environment($loader, [
    'cache' => '../cache',
    'debug' => false,
]);

echo $twig -> render('index.html.twig', ['images' => $images, 'images_path' => $images_path]);

$servername = "127.0.0.1";
$database = "local";
$username = "root";
$password = "root";
$link = mysqli_connect($servername, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "Ошибка подключения: \n" . mysqli_connect_error();
    exit();
} else {
    foreach ($images as $image) {
        $query = mysqli_query($link, "INSERT INTO images (id, image_path, title) VALUES (NULL, $images_path/$image, $image)");
        echo $query;
    }
}
mysqli_close($link);
