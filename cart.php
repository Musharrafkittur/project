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
    .cart_img{
    width: 80px;
    height: 80px;
    object-fit:contain;
    }
    .container1{
      margin:50px;
    }
    table{
      margin:0 0; 
    }

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
        
        <div>
            <ul id="navbar">
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="contact.php">Contact</a></li>
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
          <a href="cart.php"><i class="fa fa-shopping-bag"></i></a>
          <i id="bar" class="fas fa-outdent "></i>
          
        </div>
    </section>

    <div class="container1">
        <div class="row">
          <form action="" method="post">
            <table class="table table-bordered text-center">
                
                <tbody>
                <!--- php code--->
                <?php

                $get_ip_add = getIPAddress(); 
                $total_price=0;
                $cart_query="Select * from `cart_details` where ip_address='$get_ip_add'";
                $result=mysqli_query($conn,$cart_query);
                $result_count=mysqli_num_rows($result);
                if($result_count>0){
                echo "<thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Remove</th>
                        <th colspan='2'>Operations</th>
                    </tr>
                </thead>";
                
                  while($row=mysqli_fetch_array($result)){
                    $product_id=$row['product_id'];
                    $select_products="Select * from `products` where product_id='$product_id'";
                    $result_products=mysqli_query($conn,$select_products);
            
                  while($row_product_price=mysqli_fetch_array($result_products)){
                      $product_price=array($row_product_price['product_price']);
                      $price_table=$row_product_price['product_price'];
                      $product_title=$row_product_price['product_title'];
                      $product_image=$row_product_price['product_image'];
                      $product_values=array_sum($product_price);
                      $total_price+=$product_values;
                  
                ?>
                    <tr>
                        <td><?php echo $product_title?></td>
                        <td><img src="./images/<?php echo $product_image?>" alt="" class="cart_img"></td>
                        <td><input type="text" name="qty"  class="form-input w-50"></td>
                        <?php 
                          $get_ip_add = getIPAddress();
                          if(isset($_POST['update_cart'])){
                            $quantities=$_POST['qty'];
                            $update_cart="update `cart_details` set quantity=$quantities where ip_address='$get_ip_add'";
                            $result_quantity=mysqli_query($conn,$update_cart); 
                            $total_price=$total_price*$quantities;
                          }
                        ?>
                        <td><?php echo  $price_table?>/-</td>
                        <td><input type="checkbox" name="removeitems[]" value="<?php echo $product_id ?>"></td>
                        <td>
                            <!---<button class="bg-info px-3 py-2 border-0 mx-3">Update</button>-->
                            <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
 
                            <input type="submit" value="Remove Cart" class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">
                        </td>
                    </tr>
                    <?php 
                    }
                }
              }
              else{
                echo "<h2 class='text-center text-danger'>Cart is Empty</h2>";
              }
                ?>
                </tbody>
            </table>
            <div class="d-flex mb-3">
              <?php
              $get_ip_add = getIPAddress(); 
              $cart_query="Select * from `cart_details` where ip_address='$get_ip_add'";
              $result=mysqli_query($conn,$cart_query);
              $result_count=mysqli_num_rows($result);
              if($result_count>0){
                echo "<h4 class='px-3'>Subtotal:<strong class='text-info'>  $total_price/-</strong></h4>
                <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
                <button class='bg-secondary px-3 py-2 border-0 '><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>";
              }
              else{
                echo "<input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>";
              }
              if(isset($_POST['continue_shopping'])){
                echo "<script>window.open('shop.php','_self')</script>";
              }
              
              ?>
                
            </div>
        </div>
    </div>
    </form>
    <!--- function to remove-->
    <?php
      function remove_cart_item(){
        global $conn;
        if(isset($_POST['remove_cart'])){
          foreach($_POST['removeitems'] as $remove_id){
            echo $remove_id;
            $delete_query="Delete from `cart_details` where product_id=$remove_id";
            $run_delete=mysqli_query($conn,$delete_query);
            if($run_delete){
              echo "<script>window.open('cart.php','_self')</script>";
            }
          }
        }
      }
      echo $remove_item=remove_cart_item();
    ?>
    <?php
     cart();
    ?>


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