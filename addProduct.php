<?php
require_once 'include/App_Config.php';
require_once 'include/DB_Functions.php';
$product_name = $_POST['name'];
$product_price = $_POST['price'];
$db = new DB_Functions();


$app_config = new App_Config();
$domain = $app_config->localhost;

if( isset($_POST) && isset($_FILES) && strlen($product_name)>0 && strlen($product_price)>0 ){
    //create directory if it doesn't exist
    if (!file_exists('uploads/')) {
        mkdir('uploads/', 0777, true);
    }

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $image_file = "http://".$domain.$target_file;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
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
    if ($_FILES["file"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
       && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $db->addProduct($product_name ,$product_price, $image_file);
            echo "Product successfully added";
        } else {
            echo "sorry couldn't add product";
        }
    }

}


?>
