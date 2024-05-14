<?php

// show image from images folder and execute php code from image

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (empty($_GET['file'])) {
        echo "Pas de fichier renseigné";
        return;
    }
    $file = $_GET['file'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($file);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    //     && $imageFileType != "gif") {
    //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //     return;
    // }
    echo "<img src='$target_file' alt='uploaded image' />";
}