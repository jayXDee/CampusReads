<?php
require_once('config.php');
if ($_FILES["cover-image"]["error"] == UPLOAD_ERR_NO_FILE) {
    echo "<p>Please select a cover image to upload.</p>";
}
else {
    // Get file details
    session_start();
    $username = $_SESSION['user'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $fileName = $_FILES["cover-image"]["name"];
    $fileTmpName = $_FILES["cover-image"]["tmp_name"];
    $fileSize = $_FILES["cover-image"]["size"];
    $fileType = $_FILES["cover-image"]["type"];
    $fileError = $_FILES["cover-image"]["error"];

    // Generate a unique file name to prevent overwriting existing files
    $uniqueFileName = uniqid() . "_" . $fileName;

    // Define the target directory to store the uploaded files
    $targetDir = "../img/";
    if ($fileError === UPLOAD_ERR_OK) {
        if (move_uploaded_file($fileTmpName, $targetDir . $uniqueFileName)) {
            $sql = "INSERT INTO books VALUES ('NULL', '$username', '$title', '$author', '$description', '$price', '$targetDir$uniqueFileName', '$quantity')";
            if ($connection->query($sql) === TRUE) {
                header('Location: explore.php');
                echo "<script>alert('File uploaded and data stored successfully')</script>";
            } else {
                echo '<script>alert(Error: ' . $sql . '<br>' . $connection->$error. ')</script>';
                header('Location: explore.php');
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
            header('Location: explore.php');
        }
    } else {
        echo "<script>alert('File upload error. Error code: $fileError')</script>";
        header('Location: explore.php');
    }
}

$connection->close();
?>
