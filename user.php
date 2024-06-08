<?php

include 'connect.php';

if(isset($_POST['submit'])){
    $name= $_POST['name'];
    $email= $_POST['email'];
    $password= $_POST['password'];

    $sql= "insert into register (name, email, password) values('$name','$email','$password')";
    $result = mysqli_query($con, $sql);
    if($result){
        echo "Data inserted successfully";
    }
    else{
        die(mysqli_error($con));
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to ER-HUB</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h2 class= "logo"> Logo </h2>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
            <button class="btnLogin-popup"> Login </button>
        
        </nav>
    </header>
    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close"></ion-icon> </span>
        
        <div class="form-box forgot">
            <h2> Reset Password </h2>
            <form action="#" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" required>
                    <label>Email</label>
                </div>

                <button type="submit" class="reset-btn" name="send-link">Send Link </button>

                <div class="forgot-register">
                    <p> Create new account >
                    <a href="#" class="create-link">Register</a></p>
                </div>
           
            </form>
        </div>
        
        <div class="form-box login">
            <h2>Login </h2>
            <form action="#" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" required>
                    <label>Email</label>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">Remember me</label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>
                <button type="submit" class="btn">Login</button>

                <div class="login-register">
                    <p>Don't have an account?
                    <a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>


        <div class="form-box register">
            <h2> Registration </h2>
            <form action="#" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="name" required>
                    <label> Username </label>
                </div>
                
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">Agree to Terms & Conditions </label>
                </div>
                <button type="submit" class="btn" name="submit">Register</button>
                <div class="login-register">
                    <p>Already have an account?
                    <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

