<?php

$conn = mysqli_connect('HOSTNAME','USERNAME','PASSWORD','DATABASE NAME') or die('connection failed');;

        // handel the remove of one item
        if(isset($_GET['remove'])){
            $remove_id = $_GET['remove'];
            mysqli_query($conn, "DELETE FROM `card` WHERE id = '$remove_id'");
            header('location:cart.php');
        };

        //handel the remove of all the items
        if(isset($_GET['delete_all'])){
            mysqli_query($conn, "DELETE FROM `card`");
            header('location:cart.php');
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="cart.css">
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
            <a href="../Market/Products.php">Products</a>
            <a href="../ChatBot/ChatBot.html">Contact US</a>
        </div>
    </nav>
    <!-- desplay the items in the card -->
    <div class="container">
        <section class="shopping-cart">
            <h1 class="heading">shopping cart</h1>
            <table>
                <thead class="table-top">
                    <th>image</th>
                    <th>name</th>
                    <th colspan="">price</th>
                    <th>action</th>
                </thead>
                <tbody>
                    <?php             
                        // get the items from the card tabul   
                        $select_cart = mysqli_query($conn, "SELECT * FROM `card`");
                        $grand_total = 0;
                        if(mysqli_num_rows($select_cart) > 0){
                            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    ?>
                    <tr>
                        <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                        <td><?php echo $fetch_cart['name']; ?></td>
                        <td colspan="">EGP <?php echo $sub_total = $fetch_cart['price']; ?></td>
                        <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from card?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
                    </tr>
                    <?php
                        // set the total price of the items 
                        $grand_total += $sub_total;  
                            };
                        };
                    ?>
                    <tr class="table-bottom">
                        <td><a href="./Products.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
                        <td>grand total</td>
                        <td colspan="">EGP <?php echo $grand_total; ?></td>
                        <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
                    </tr>
                </tbody>
            </table>

            <div class="checkout-btn">
                <a href="./CheckOut.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
            </div>

        </section>

    </div>
    <script src="script.js"></script>

</body>
</html>
