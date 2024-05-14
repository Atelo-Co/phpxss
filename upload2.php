<?php
// upload file image to images folder

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_FILES['file'])) {
        echo "Pas de fichier renseigné";
        return;
    }
    $file = $_FILES['file'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // rename extension file to .php to execute php code from image

    //$target_file = str_replace($imageFileType, "php", $target_file);
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($file["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($file["name"])) . " has been uploaded.";
            echo "<img src='$target_file' alt='uploaded image' />";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}