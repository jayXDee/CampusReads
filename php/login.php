<?php
require_once('config.php');
// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the email and password match a user in the database
$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    
    // Login successful
    session_start();
    $_SESSION['user'] = $row['username'];
    $_SESSION['auth'] = "OKAY";
    header('Location: explore.php');
    exit;
} else {
    // Login failed
    echo "Error: Invalid email or password.";
}


// Close the database connection
mysqli_close($connection);
?>

