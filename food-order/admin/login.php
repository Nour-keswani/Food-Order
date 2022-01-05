<?php include('../config/constants.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset ($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset ($_SESSION['no-login-message']);
            }
        ?>

        <br><br>

        <!-- Login Form Start -->

        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"> <br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"> <br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>

        <!-- Login Form End -->

        <p class="text-center">Created By - <a href="www.NourKeswani.com">Noureddin Alkeswani</a></p>
    </div>

</body>
</html>

<?php 

    // Check Whether The Submit Button Is Clicked Or Not
    if(isset($_POST['submit']))
    {
        // Process For Login
        // 1. Get The Data From Login Form
        // $username = $_POST['username']; : V1
        // $password = md5($_POST['password']); : V1
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        // 2. SQL To Check Whether The User With Username And Password Exists Or Not
        $sql = "SELECT * FROM tb_admin WHERE username = '$username' AND password = '$password'";

        // 3. Excute The Query 
        $res = mysqli_query($conn, $sql);

        // 4. Count Rows To Check Whether The User Exists Or Not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // User Available And Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; // To Check Whether The User Is Logged In Or Not And Logout Will Unset It
            // Redirect To Home Page/DashBoard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            // User Not Available And Loin Failed
            $_SESSION['login'] = "<div class='error text-center'>Username Or Password Did Not Match.</div>";
            // Redirect To Home Page/DashBoard
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>