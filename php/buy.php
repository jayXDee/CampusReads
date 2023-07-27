<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require_once('config.php');
session_start();
$username = $_SESSION['user'];
$q1 = "DELETE FROM cart WHERE user_id ='$username'";
$con = mysqli_connect('localhost', 'root', '', 'campusreads');
$r = mysqli_query($con, $q1);
if (!$r) {
    die("Query error: " . mysqli_error($con));
}
mysqli_close($connection);
echo "<script>alert('Thanks for buying at CampusReads!')</script>";
flush();
//header("Location: ../index.html");
?>
<script>
        // Redirect to the index.html page after a delay of 5 seconds
        setTimeout(function() {
            window.location.href = "../index.html";
        }, 1000);
    </script>
</body>
</html>

