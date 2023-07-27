<?php
require_once('config.php');
session_start();
if (isset($_POST['bookId']) && !empty($_POST['bookId']) && isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $bookId = $_POST['bookId'];
    $username = $_SESSION['user'];

    // Check if the item is already in the cart for the user
    $checkQuery = "SELECT * FROM cart WHERE user_id = '$username' AND book_id = $bookId";
    $checkResult = mysqli_query($connection, $checkQuery);
    // Check how many books are available
    $checkQuantity = "SELECT * FROM books WHERE book_id = $bookId";
    $availability = mysqli_query($connection, $checkQuantity);
    if (mysqli_num_rows($availability) > 0) {
        $avl = mysqli_fetch_assoc($availability);
        $available = $avl['quantity'];
    }
    else {$available = 0;}

    if (mysqli_num_rows($checkResult) > 0) {
        while ($row = mysqli_fetch_assoc($checkResult)) {
            $quantity = $row['quantity'];
            if ($quantity > $available){
                echo "Sorry, No books are available from this vendor";
            }
            else {
                // For simplicity, let's assume we only increment the quantity by 1 here
                $qtt = $quantity - 1;
                $updateQuery = "UPDATE cart SET quantity = $qtt WHERE user_id = '$username' AND book_id = $bookId";
                mysqli_query($connection, $updateQuery);

                $avail = $available - 1;
                $changeqt = "UPDATE books SET quantity = $avail WHERE book_id = $bookId";
                mysqli_query($connection, $changeqt);
                echo "Item added to cart";
            }
        }
    } else {
        // Item not in the cart, add it as a new entry
        $insertQuery = "INSERT INTO cart (user_id, book_id, quantity) VALUES ('$username', $bookId, 1)";
        mysqli_query($connection, $insertQuery);

        $avail = $available - 1;
        $changeqt = "UPDATE books SET quantity = $avail WHERE book_id = $bookId";
        
        mysqli_query($connection, $changeqt);
        echo "Item added to cart";

    }
} else {
    echo "Login not found, please login and try again";
}
?>
