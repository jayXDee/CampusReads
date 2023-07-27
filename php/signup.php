<?php
require_once('config.php');
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the username or email already exists in the database
$check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
$check_result = mysqli_query($connection, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // Username or email already exists, show error message
    echo "Error: Username or email already exists.";
} else {
    // Insert new user into the database
    $insert_query = "INSERT INTO users VALUES ('$username', '$email', '$password')";
    if (mysqli_query($connection, $insert_query)) {
        session_start();
        $_SESSION['auth'] = "OKAY";
        $_SESSION['user'] = $username;
        echo "<h3>Registration successful!</h3><br>";
        // Redirect the user to php/explore.php after successful signup
        header('Location: explore.php');
        exit;
    } else {
        echo "Error: Registration failed. Please try again.";
    }
}
// Close the database connection
mysqli_close($connection);
?>
