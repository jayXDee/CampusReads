<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Sell | CampusReads</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="../css/index.css" rel="stylesheet">
    <link href="../css/upload.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
        session_start();
        $username = $_SESSION['user'];
        if(!isset($_SESSION['auth']))
            {
                echo "<script>alert('Kindly login first')</script>";
                flush();
                sleep(1);
                header("Location: ../index.html");
            }
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
                        <a class="nav-link" href="explore.php" rel="nofollow" target="_self">Start Exploring</a>
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
                </ul>
            </div>
        </div>
    </nav>
    <div class="sticky-top hidden-spacer w-100"> </div>
    <!-- Animated navbar End -->
    <main>
        <form method="post" action="upload.php" enctype="multipart/form-data">
            <div class="form-body">
                <div class="left">
                    <div class="form-group upload-section">
                        <label for="cover-image">Cover Image:</label>
                        <div class="image-preview">
                        <img id="cover-image-preview" src="#">
                        </div>
                        <div class="upload-input">
                        <input type="file" id="cover-image" name="cover-image" accept="image/*" required>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required>
                    </div><br>
                    <div class="form-group">
                        <label for="author">Author:</label>
                        <input type="text" id="author" name="author" required>
                    </div><br>
                    <div class="form-group">
                        <label for="description">Description (optional):</label>
                        <textarea id="description" name="description"></textarea>
                    </div><br>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="text" id="quantity" name="quantity" required>
                        
                    </div><br>
                    <div class="form-group">
                        <label for="price">Selling Price:</label>
                        <input type="text" id="price" name="price" required>
                    </div><br>
                    <div class="upl"><button class="my-5" type="submit">Upload</button></div>
                </div>
            </div>
        </form>
    </main>
<script src="../js/upload.js"></script>
</body>
</html>