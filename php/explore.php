<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Explore | CampusReads</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="../css/index.css" rel="stylesheet">
    <link href="../css/explore.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
    require_once('config.php');
    session_start();
    error_reporting(0);
    $username = $_SESSION['user'];
    $sql = "SELECT * FROM books WHERE quantity > 0";
    $result = mysqli_query($connection, $sql);
    ?>
    <!-- Animated navbar Start-->
    <nav class="navbar navbar-expand-sm fixed-top navbar-scroll">
        <div class="container-fluid">
            <button class="navbar-toggler ps-0" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="d-flex justify-content-start align-items-center">
                    <i class="fas fa-bars"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="navbar-brand fs-3 head" aria-current="page" href="">CampusReads</a>
                    </li>
                </ul>

                <ul class="navbar-nav flex-row js-signin-modal-trigger">
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="sell.php" rel="nofollow" target="_self">Sell Oldies</a>
                    </li>
                    <!-- <li class="nav-item mx-3">
                        <a class="nav-link" href="" data-toggle="modal" data-target="#loginModal">Login</a>
                    </li> -->
                    <?php
                    // Check if the user is logged in
                    if (isset($_SESSION['user'])) {
                        echo '<li class="nav-item mx-3"><form method="post" action="logout.php">
                        <button type="submit" name="logout" class="btn nav-link" style= "background-color: transparent;">Logout</button>
                    </form></li>';
                    } else {
                        echo '<li class="nav-item mx-3"><a class="nav-link" href="" data-toggle="modal" data-target="#loginModal">Login</a></li>';
                    }
                    ?>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="" data-toggle="modal" data-target="#cartModal"><i class="fa-solid fa-cart-shopping fa-lg"></i>
                        <?php
                        // Show the number of items in the cart
                        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                            $username = $_SESSION['user'];
                            $cartCountQuery = "SELECT SUM(quantity) AS total_items FROM cart WHERE user_id = '$username'";
                            $cartCountResult = mysqli_query($connection, $cartCountQuery);
                            $cartCountRow = mysqli_fetch_assoc($cartCountResult);
                            $totalItemsInCart = $cartCountRow['total_items'];
                            echo '<span class="cart-count-container badge bg-danger">' . $totalItemsInCart . '</span>';
                        } else {
                            echo '<span class="cart-count-container badge bg-danger">0</span>';
                        }
                        ?></a>
                </ul>
            </div>
        </div>
    </nav>
    <div class="sticky-top hidden-spacer w-100"> </div>
    <!-- Animated navbar End -->
    <div class='d-flex'>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="card m-5" style="width: 13rem;">';
                echo '<img src="' . $row['cover_image'] . '"class="card-img-top" alt="' .$row['description']. '">';
                echo '<div class="card-body">';
                echo '<div style="width: 75%; float:left;"><p class="card-title">' .$row['title'] . '</p></div><div style = "width: 20%; float:right; text-align: right;"> &#8377;' . $row['price'] . '</div>';
                echo '<div style="width: 100%; float:left;" ><p class="card-text my-0"><small><em>' . $row['author'] . '</small></em></p></div></div>';
                echo '<div class="card-footer"><button class="btn btn-primary w-100 btn-add" data-book-id="' . $row['book_id'] . '">Add to Cart</button></div></div>';
            }
        }
        // Close the database connection
        mysqli_close($connection);
        ?>        
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" name="loginModal" style = 'background-color: #10111e !important;'>
                <div class="modal-header border-bottom-0">
                </div>
                <div class="modal-body">
                <div class="form-title text-center">
                    <h4>Login</h4>
                </div><br>
                <div class="d-flex flex-column text-center">
                    <form method="post" action="login.php">
                        <div class="form-group">
                            <input type="email" class="form-control my-3" style = 'background-color: #10111e !important; color: aliceblue;' id="email1" name = "email" placeholder="Your email address...">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control my-3" style = 'background-color: #10111e !important; color: aliceblue;' id="password1" name = "password" placeholder="Your password...">
                        </div>
                    <button type="submit" class="btn btn-info btn-block btn-round my-3">Login</button>
                    </form>
                    
                    <div class="text-center text-muted delimiter">or use a social network</div><br>
                    <div class="d-flex justify-content-center social-buttons">
                        <button type="button" class="btn btn-secondary btn-round mx-1" data-toggle="tooltip" data-placement="top" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button type="button" class="btn btn-secondary btn-round mx-1" data-toggle="tooltip" data-placement="top" title="Facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button type="button" class="btn btn-secondary btn-round mx-1" data-toggle="tooltip" data-placement="top" title="Linkedin">
                            <i class="fab fa-linkedin"></i>
                        </button>
                    </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="signup-section">Not a member yet? <a href="" data-toggle="modal" data-target="#signupModal" data-dismiss="modal" class="text-info">Sign Up</a>.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="signupModal" name="signupModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style = 'background-color: #10111e !important;'>
                <div class="modal-header border-bottom-0">
                </div>
                <div class="modal-body">
                <div class="form-title text-center">
                    <h4>Sign-Up</h4>
                </div><br>
                <div class="d-flex flex-column text-center">
                    <form method="post" action="signup.php">
                        <div class="form-group">
                            <input type="text" class="form-control my-3" style = 'background-color: #10111e !important; color: aliceblue;' id="username1" name = "username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control my-3" style = 'background-color: #10111e !important; color: aliceblue;' id="email1" name = "email" placeholder="Your email address...">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control my-3" style = 'background-color: #10111e !important; color: aliceblue;' id="password1" name = "password" placeholder="Your password...">
                        </div>
                    <button type="submit" class="btn btn-info btn-block btn-round my-3">Sign Up</button>
                    </form>
                    
                    <div class="text-center text-muted delimiter">or use a social network</div><br>
                    <div class="d-flex justify-content-center social-buttons">
                        <button type="button" class="btn btn-secondary btn-round mx-1" data-toggle="tooltip" data-placement="top" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button type="button" class="btn btn-secondary btn-round mx-1" data-toggle="tooltip" data-placement="top" title="Facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button type="button" class="btn btn-secondary btn-round mx-1" data-toggle="tooltip" data-placement="top" title="Linkedin">
                            <i class="fab fa-linkedin"></i>
                        </button>
                    </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="signup-section">Already a member? <a href="" data-toggle="modal" data-target="#loginModal" data-dismiss="modal" class="text-info">Login</a>.</div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="cartModal" name="cartModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style = 'background-color: #10111e !important;'>
                <div class="modal-header border-bottom-0">
                </div>
                <div class="modal-body">
                <div class="form-title text-center">
                    <h4>Cart</h4>
                </div><br>
                <div class="d-flex flex-column text-center">
                <?php
                //require_once('config.php');
                //session_start();
                $username = $_SESSION['user'];
                $q1 = "SELECT * FROM cart WHERE user_id ='$username'";
                $con = mysqli_connect('localhost', 'root', '', 'campusreads');
                $r = mysqli_query($con, $q1);
                $total = 0;
                echo '<div class="custom-card" style="width: 90%;">';
                echo '<div class="custom-card-body">';
                echo '<div style="width: 70%; float:left; text-align: center;"><p class="custom-card-title">Title</p></div>';
                echo '<div style="width: 30%; float:left; text-align: center;">Price</div>';
                echo '<p class="custom-card-quantity" style="text-align: center;">Quantity</p>';
                echo '</div>';
                echo '</div><br>';
                if (mysqli_num_rows($r) > 0) {
                    while ($row = mysqli_fetch_assoc($r)) {
                        $book_id = $row['book_id'];
                        $q2 = "SELECT * FROM books WHERE book_id ='$book_id'";
                        $r2 = mysqli_query($con, $q2);
                        $row2 = mysqli_fetch_assoc($r2);
                        echo '<div class="custom-card" style="width: 90%;">';
                        echo '<div class="custom-card-body">';
                        echo '<div style="width: 70%; float:left; text-align: left;"><p class="custom-card-title">' . $row2['title'] . '</p></div>';
                        echo '<div style="width: 30%; float:left; text-align: left;">&#8377;' . $row2['price'] . '</div>';
                        echo '<p class="custom-card-quantity" style="text-align: center;">' . $row['quantity'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                        $total = $total + $row2['price']*$row['quantity'];
                    }
                    $_SESSION['total'] = $total;
                    echo "<br><div class = 'm-2'><form method='post' action='buy.php'><button type='submit' class='btn btn-info btn-block btn-round my-3'>Buy now for &#8377; " . $total . "</button></form></div>";
                }
                ?>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="signup-section">Need to change stuff? <a href="" data-toggle="modal" data-dismiss="modal" class="text-info">Go Back</a>.</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
    <script>
        function updateCartCount() {
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Set up the request
            xhr.open("GET", "get_cart_count.php", true);

            // Set up a callback function to handle the response
            xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Update the cart count with the new value received from the server
                document.getElementById("cart-count-container").innerHTML = xhr.responseText;
            }
            };

            // Send the request
            xhr.send();
        }

        // Call the updateCartCount function every second
        setInterval(updateCartCount, 1000);

        $(document).ready(function() {
            $(".btn-add").click(function() {
                var bookId = $(this).data('book-id');
                $.ajax({
                    type: "POST",
                    url: "cart.php", // Create this PHP file to handle adding items to the cart
                    data: { bookId: bookId },
                    success: function(response) {
                        if (response === "Item added to cart") {
                            alert("Item added to cart.");
                            location.reload();
                        }
                        else {
                            alert(response);
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>