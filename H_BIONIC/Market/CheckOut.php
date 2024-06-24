<?php

$conn = mysqli_connect('HOSTNAME','USERNAME','PASSWORD','DATABASE NAME') or die('connection failed');;

   if(isset($_POST['order_btn'])){

      $name = $_POST['name'];
      $number = $_POST['number'];
      $email = $_POST['email'];
      $flat = $_POST['flat'];

      // get the items from the card tabul
      $cart_query = mysqli_query($conn, "SELECT * FROM `card`");
      // set the initial price
      $price_total = 0;
      // desplay the items from the card
      if(mysqli_num_rows($cart_query) > 0){
         while($product_item = mysqli_fetch_assoc($cart_query)){
            $product_name[] = $product_item['name'];
            $product_price = $product_item['price'];
            $price_total += $product_price;
         };
      };

      // desplay all the prodects name
      $total_product = implode(', ',$product_name);
      // insert the data of the user in the order tabul 
      $detail_query = mysqli_query($conn, "INSERT INTO `ordar`(name, email , phone , address , total_products, total_price) VALUES('$name','$number','$email','$flat','$total_product','$price_total')") or die('query failed');

      // desplay the order data 
      if($cart_query && $detail_query){
         echo "
         <div class='order-message-container'>
         <div class='message-container'>
            <h3>thank you for shopping!</h3>
            <div class='order-detail'>
               <span>".$total_product."</span>
               <span class='total'> total : EGP".$price_total."</span>
            </div>
            <div class='customer-details'>
               <p> your name : <span>".$name."</span> </p>
               <p> your number : <span>".$number."</span> </p>
               <p> your email : <span>".$email."</span> </p>
               <p> your address : <span>".$flat."</span> </p>
            </div>
               <a href='./products.php'>
                  <button style='display: block;
                                 width: 100%;
                                 text-align: center;
                                 background-color: #469FD1;
                                 color:#333;
                                 font-size: 2rem;
                                 padding:1rem 3rem;
                                 border-radius: .5rem;
                                 cursor: pointer;
                                 margin-top: 1rem;
                                 text-decoration: none;'>
                  continue shopping</button>
               </a>
            </div>
         </div>
         ";
      }

   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <link rel="stylesheet" href="./CheckOut.css">
</head>
<body>
    <div class="rectangle"></div>
    <a href="../Home/index.html"><img class="Logo" src="../image/H-Bionic Logo Design-01.jpg"></a>
    <nav>
         <!-- to handel the navbar when the secren is decresing in size -->
        <input type="checkbox" id="sidebar-active">
        <label for="sidebar-active" class="open-sidebar-button">
        <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
        </label>
        <label id="overlay" for="sidebar-active"></label>
        <div class="links-container">
            <label for="sidebar-active" class="close-sidebar-button">
                <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
            </label>

            <a href="../Home/index.html">Home</a> 
            <a href="../About/Abuot.html">About</a> 
            <a href="./Products.php">Products</a>
            <a href="../ChatBot/ChatBot.html">Contact US</a>
        </div>
    </nav>
<!--  -->
   <section class="checkout-form">

      <h1 class="heading">complete your order</h1>
      <form action="" method="post">

         <div class="display-order">
            <?php
            // get the name of the items in the card tabul
            $select_cart = mysqli_query($conn, "SELECT * FROM `card`");
            $total = 0;
            $grand_total = 0;
            if(mysqli_num_rows($select_cart) > 0){
               while($fetch_cart = mysqli_fetch_assoc($select_cart)){
               $total_price = $fetch_cart['price'];
               $grand_total = $total += $total_price;
            ?>
            <span><?= $fetch_cart['name']; ?></span>
            <?php
               }
            }else{
               echo "<div class='display-order'><span>your cart is empty!</span></div>";
            }
            ?>
            <!-- set the general price of all the prodects in the card -->
            <span class="grand-total"> grand total : EGP<?= $grand_total; ?></span>
         </div>
         <!-- enter the data of the user  -->
         <div class="flex">
               <span>Enter your Name</span>
               <input type="text" placeholder="enter your name" name="name" required><br>

               <span>Enter your Number</span>
               <input type="number" placeholder="enter your number" name="number" required><br>

               <span>Enter your Email</span>
               <input type="email" placeholder="enter your email" name="email" required><br>

               <span>Enter your Address</span>
               <input type="text" placeholder="e.g. flat no." name="flat" required>
         </div>
         <input type="submit" value="order now" name="order_btn" class="btn">
      </form>
   </section>
       <script src="script.js"></script>
</body>
</html>
