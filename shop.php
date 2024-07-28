<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width==device-width, initial-scale=1.0">
    <title> MasterCraft Hardware Tools</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    .welcome{
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
    transition: 0.3s ease;
  }
  </style>
</head>

<body>
  <?php
          include('./includes/connect.php');
          include('./functions/common_functions.php');
          session_start();
  ?>
    <section id="header">
        <a href="index.php"><img src="./images/8-jMiXnr4rQoN1haw.png"  class="logo1"></a>
        <?php 
                  if(!isset($_SESSION['username'])){
                    echo "<a href='#' class='welcome'>Welcome Guest</a>";
                  }else{
                    echo "<a href='#' class='welcome'>Welcome ".$_SESSION['username']."</a>";
                  }
                ?>
        <form class="d-flex" action="search_product.php" method="GET">
          <input class="form-control me-2" type="search" placeholder="Search" name="search_data">
          <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
        </form>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a class="active" href="shop.php">Shop</a></li>
                
                <li><a href="contact.html">Contact</a></li>
                <?php 
                  if(!isset($_SESSION['username'])){
                    echo "<li><a href='./users_area/user_login.php'>Log In</a></li>";
                  }else{
                    echo "<li><a href='./users_area/user_logout.php'>Log out</a></li>";
                  }
                ?>
                <li id="lg-bag"><a href="cart.php"><i class="fa fa-shopping-bag"></i><sup><?php cart_item(); ?></sup></a></li>
                <a href="#" id="close"><i class=" fas fa-cut"></i></a>
            </ul>
        </div>
        <div id="mobile">
          <a href="cart.html"><i class="fa fa-shopping-bag"></i></a>
          <i id="bar" class="fas fa-outdent "></i>
          
        </div>
    </section>
    <section id="page-header">
        
        <h2>#stayhome</h2>
        
        <p style="font-size: larger;">Save more with coupons & up to 70% off!</p>
        
    </section>

    <section id="product1" class="section-p1">
        <div class="pro-container">
          <?php 

          get_all_products();
          search_product();
          ?> 
        </div>
  </section>

<hr>

  <footer class="section-p1">
      <div class="col">
        <img src="images/LOGO.jpeg" class="logo1">
        <h4>Contact</h4>
        <p><strong>Address :</strong> 562 R.P.D Road, Street 42, Belgavi</p>
        <p><strong>Phone :</strong> +91 9108581584</p>
        <p><strong>Hours :</strong> 10:00 - 18:00, Mon - Sat </p>
        <div class="follow">
          <h4>FollowUs</h4>
          <div class="icon">
            <i class="fab fa-facebook"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-pinterest-p"></i>
            <i class="fab fa-youtube"></i>
          </div>
        </div>
      </div>
      <div class="col">
          <h4>About</h4>
          <a href="#">About-Us</a>
          <a href="#">Delivery Information</a>
          <a href="#">Privacy policy</a>
          <a href="#">Terms & Conditions</a>
          <a href="#">Contact-Us</a>
      </div>
      <div class="col">
        <h4>My Account</h4>
        <a href="#">Sign-In</a>
        <a href="#">View Cart</a>
        <a href="#">My Wishlist</a>
        <a href="#">Track my order</a>
        <a href="#">Help</a>
    </div>
    <div class="copyright">
      <p>@ 2024, Mush2 etc - PROJECT 150 Marks</p>
    </div>
  </footer>
    <script src="./script.js"></script>
</body>
</html>