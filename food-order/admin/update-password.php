<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Passowrd</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php 

            // Check Whether The Submit Button Is Clicked Or Not
            if(isset($_POST['submit']))
            {
                // echo "Clicked";
                // 1. Get The Data From Form
                $id = $_POST['id'];
                
                // $current_password = md5($_POST['current_password']);
                $current_password = md5($_POST['current_password']);
                $password = mysqli_real_escape_string($conn, $current_password);

                // $new_password = md5($_POST['new_password']);
                $new_password = md5($_POST['new_password']);
                $password = mysqli_real_escape_string($conn, $new_password);

                // $confirm_password = md5($_POST['confirm_password']); 
                $confirm_password = md5($_POST['confirm_password']);
                $password = mysqli_real_escape_string($conn, $confirm_password);

                // 2. Check Whether The User With Current ID And Current Password Exists Or Not
                $sql = "SELECT * FROM tb_admin WHERE id = $id AND password = '$current_password'";

                // Excute The Query 
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    // Check Whether Data Is Available Or Not
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        // User Exists And Password Can Be Change
                        // echo "User Found";

                        // Check Whether The New Password And Confirm Match Or Not
                        if($new_password==$confirm_password)
                        {
                            // Update The Password
                            // echo "Password Match";
                            $sql2 = "UPDATE tb_admin SET
                                password = '$new_password'
                                WHERE id = $id
                            ";

                            // Excute The Query
                            $res2 = mysqli_query($conn, $sql2);

                            // Chech Whether The Query Excuted Or Not
                            if($res2==true)
                            {
                                // Display Success Message
                                // Redirect To Manege Admin Page With Success Message
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                                // Redirect The User
                                header('location:'.SITEURL.'admin/manege-admin.php');
                            }
                            else
                            {
                                // Display Error Message
                                // Redirect To Manege Admin Page With Error Message
                                $_SESSION['change-pwd'] = "<div class='error'>Failed To Change Password. </div>";
                                // Redirect The User
                                header('location:'.SITEURL.'admin/manege-admin.php');
                            }

                        }
                        else
                        {
                            // Redirect To Manege Admin Page With Error Message
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Match. </div>";
                            // Redirect The User
                            header('location:'.SITEURL.'admin/manege-admin.php');
                        }
                    }
                    else
                    {
                        // User Does Not Exists Set Message And Redirect
                        $_SESSION['user-not-found'] = "<div class='error'>User Not Found. Or Password Did Not Match </div>";
                        // Redirect The User
                        header('location:'.SITEURL.'admin/manege-admin.php');
                    }
                }

                // 3. Check Whether The New Password And Confirm Password Match Or Not 

                // 4. Change Password If All Above Is True
            }

?>

<?php include('partials/footer.php'); ?>