<?php

    $conn = mysqli_connect('HOSTNAME','USERNAME','PASSWORD','DATABASE NAME') or die('connection failed');;

        if(isset($_POST['add_to_cart'])){

            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];

            $select_cart = mysqli_query($conn, "SELECT * FROM `card` WHERE name = '$product_name'");

            if(mysqli_num_rows($select_cart) > 0){
                // $message[] = 'product already added to cart';
            }else{
                $insert_product = mysqli_query($conn, "INSERT INTO `card`(name, price, image) VALUES('$product_name', '$product_price', '$product_image')");
                // $message[] = 'product added to cart succesfully';
            }

        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodects</title>
    <link rel="stylesheet" href="Prodects.css">
</head>
<body>
    <div class="rectangle"></div>
    <a href="./index.html"><img class="Logo" src="H-Bionic Logo Design-01.jpg"></a>
    <?php
            // to get the number of elemints on the card tabul
            $select_rows = mysqli_query($conn, "SELECT * FROM `card`") or die('query failed');
            $row_count = mysqli_num_rows($select_rows);
    ?>
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

            <!-- desplay the card on the navbar and the number of items on the card -->
            <a href="./cart.php" class="cart">CART <span><?php echo $row_count; ?></span></a>    
        </div>
    </nav>
    </div>
        <?php
            // desplay the massege when addingg an item to the card
            if(isset($message)){
            foreach($message as $message){
                echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
            };
            };
        ?>
    </nav>
    <div class="container">
        <section class="products">
        <h1 class="heading">latest products</h1>
        <div class="box-container">
            <?php
            // get the items from the prodacts tabul
            $select_products = mysqli_query($conn, "SELECT * FROM `prodects`");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
            ?>

            <form action="" method="post">
                <div class="box">
                    <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
                    <h3><?php echo $fetch_product['name'];?></h3>
                    <div class="price">EGP <?php echo $fetch_product['price']; ?></div>
                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                    <input type="submit" class="btn" value="Add To Cart" name="add_to_cart">
                </div>
            </form>

            <?php
            // clase the tage of the if and while 
                };
            };
            ?>

        </div>

        </section>

    </div>
    <script src="script.js"></script>

</body>
</html>
