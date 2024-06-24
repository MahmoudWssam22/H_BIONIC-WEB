<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <title>H-Bionic</title>
    <link rel="stylesheet" href="Login.css">
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
    <aside><img src="../image/H-Bionic Logo Design-02.png" alt="" class="prosthetic-hand"></aside>  
    <!-- to change between login and Regester  -->
    <div class="Sing">
        <label for="chk" class="Log" aria-hidden= "true">Login</label>
        <label for="chk" class="Reg" aria-hidden= "true" >
            <a href="../Regester/Register.php">Register</a></label>
    </div>
    <!-- the Login form -->
    <div class="main">
        <div class="login">
            <form class="login_form" method="POST" action="Login.php" name="form" onsubmit="return validate()">
                <label for="chk" >Email Address</label>
                <input type="email" name="email" placeholder="     Enter your Email Address" required="">

                <label for="chk">Password</label>
                <input type="Password" name="pswd" placeholder="     Enter your Password" required="">
                
                <button type="submit" class="btn-Log" name="LogBtn">Login</button>
                <span class="OR">-OR-</span>
                <button class="btn-sing-Log"><i class="fa-brands fa-google fa-2xl" style="padding: 5px;"> </i>  Login with Google</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php

    $conn = mysqli_connect('HOSTNAME','USERNAME','PASSWORD','DATABASE NAME') or die('connection failed');;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        # create new student
        // var_dump($_REQUEST);
        $email = $_REQUEST['email'];
        $input_password = $_REQUEST['pswd'];

        # chek if user already exists
        $SQL = "SELECT * FROM `accounts`WHERE email ='$email'";
        $result = $conn->query($SQL);
        if($result->num_rows>0){
            $user_db = $result->fetch_assoc();
            $db_PASSWORD = $user_db['password'];
            
            if($input_password == $db_PASSWORD){
                // if the password is correct then contenu in the market
                echo "<script>window.location.href='../Market/Products.php';</script>";
            }else{
                // if the password is not correct then ReEnter the password
                echo "<script>alert('Login Faild');</script>";
                echo "<script>window.location.href='./Login.php';</script>";
            }
        }
    }else{
        echo "Login";
    }
?>
