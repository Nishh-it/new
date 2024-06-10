<?php
session_start();
require("connect.php");
// error_reporting(0);

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Registration
    if (isset($_POST['submit'])) {
        if (isset($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $username = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST['password'];

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO register (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);
            
            if ($stmt->execute()) {
                echo "<script>alert('Registered successfully');</script>";
            } else {
                echo "<script>alert('Error!');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Error!');</script>";
        }
    }

    // Login
    if (isset($_POST['login'])) {
        if (isset($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST["email"];
            $password = $_POST['password'];

            $stmt = $conn->prepare("SELECT email, password FROM register WHERE email = ? AND password = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                echo "<script>alert('Login successful!');</script>";
            } else {
                $error = "Invalid Username & Password";
            }

            $stmt->close();
        } 
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to ER-HUB</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <header>
        <h2 class="logo">Logo</h2>
        <nav class="navigation">
            <a href="#" class="line">Home</a>
            <a href="#" class="line">About</a>
            <a href="#" class="line">Services</a>
            <a href="#" class="line">Contact</a>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <a href="user.php?logout=true"><button class="btnLogout">Logout</button></a>
            <?php else: ?>
                <button class="btnLogin-popup">Login</button>
            <?php endif; ?>
        </nav>
    </header>
    <div class="wrapper <?php if (!empty($error)) echo 'active-popup'; ?>">
        <span class="icon-close"><ion-icon name="close"></ion-icon></span>
        
        <div class="form-box forgot">
            <h2>Reset Password</h2>
            <form action="#" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" required>
                    <label>Email</label>
                </div>

                <button type="submit" class="reset-btn" name="send-link">Send Link</button>

                <div class="forgot-register">
                    <p>Create new account>
                    <a href="#" class="create-link">Register</a></p>
                </div>
            </form>
        </div>
        
        <div class="form-box login">
            <h2>Login</h2>
            <?php if (!empty($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="user.php" method="post">
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
                    <label><input type="checkbox">Remember me</label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>
                <button type="submit" class="btn" name="login">Login</button>

                <div class="login-register">
                    <p>Don't have an account?
                    <a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>

        <div class="form-box register">
            <h2>Registration</h2>
            <form action="user.php" method="post">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="name" required>
                    <label>Username</label>
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
                    <label><input type="checkbox">Agree to Terms & Conditions</label>
                </div>
                <button type="submit" class="btn" name="submit">Register</button>
                <div class="login-register">
                    <p>Already have an account?
                    <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        const wrapper = document.querySelector('.wrapper');
        const loginLink = document.querySelector('.login-link');
        const registerLink = document.querySelector('.register-link');
        const createLink = document.querySelector('.create-link');
        const btnPopup = document.querySelector('.btnLogin-popup');
        const iconClose = document.querySelector('.icon-close');
        const forgotLink = document.querySelector('.forgot-link');

        registerLink.addEventListener('click',()=>{
            wrapper.classList.add('active');
            wrapper.classList.remove('set');
        });

        createLink.addEventListener('click',()=>{
            wrapper.classList.add('active');
            wrapper.classList.remove('set');
        });

        loginLink.addEventListener('click',()=>{
            wrapper.classList.remove('active','set');
        });

        forgotLink.addEventListener('click',()=>{
            wrapper.classList.add('set');
        });

        btnPopup.addEventListener('click',()=>{
            wrapper.classList.add('active-popup');
        });

        iconClose.addEventListener('click',()=>{
            wrapper.classList.remove('active-popup','active','set');
        });

        <?php if (!empty($error)): ?>
            wrapper.classList.add('active-popup');
        <?php endif; ?>
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
