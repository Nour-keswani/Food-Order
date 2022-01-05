<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br /><br />

        <?php 
                if(isset($_SESSION['add'])){    // Checking Whether The Session Is Set Or Not
                    echo $_SESSION['add'];      // Displaying Session Message
                    unset($_SESSION['add']);    // Removing Session Message
                }
            ?>

        <form action="" method="POST">
            <table  class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="btn-secondary" type="submit" name="submit" value="Add Admin">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 

    // Process The Value From Form And Save It In Database
    // Check Whether The Button Is Clicked Or Not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        // echo "Button Clicked";
        // 1. Get The Data From Form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Password Encryption With MD5

        // 2. SQL Query To Save The Data Into Database
        $sql = "INSERT INTO tb_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";
        
        // 3. Executing Query And Saving Data Into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. Check Whether The (Query Is Executed) Data Is Inserted Or Not And Display Appropriate Message
        if($res==TRUE) {
            // Data Inserted
            // echo "Data Inserted";
            // Create a Session Variable To Display Message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfuly</div>";
            // Redirect Page To Manege Admin
            header("location:".SITEURL.'admin/manege-admin.php');
        }
        else {
            // Failed To Insert Data
            // echo "Faile To Insert Data";
            // Create a Session Variable To Display Message
            $_SESSION['add'] = "<div class='error'>Failed To Add Admin</div>";
            // Redirect Page To Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }

?>