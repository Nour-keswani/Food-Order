<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 
            // 1. Get The ID Of Selected Admin
            $id = $_GET['id'];

            // 2. Create SQL Query To Get The Detalis
            $sql = "SELECT * FROM tb_admin WHERE id=$id";

            // 3. Excute The Query
            $res = mysqli_query($conn, $sql);

            // 4. Check Whether The Query Is Excuted Or Not 
            if($res==true)
            {
                // Check Whether The Data Is Available Or Not 
                $count = mysqli_num_rows($res);
                // Check Whether We Have Admin Data Or Not
                if($count==1)
                {
                    // Get The Details
                    // echo "Admin Available";
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    // Redirect To Damin Manege Page
                    header('location:'.SITEURL.'admin/manege-admin.php');
                }
            }
        
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input class="btn-secondary" type="submit" name="submit" value="Update Admin">
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
        // echo "Button Clicked";
        // Get All The Values From Form To Update 
        $id = $_POST['id'];
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);

        // Create a SQL Query To Update Admin
        $sql = "UPDATE tb_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id = '$id'
        ";

        // Excute The Query
        $res = mysqli_query($conn, $sql);

        // Check Whether The Query Excuted Successfully Or Not
        if($res==true)
        {
            // Query Excuted And Admin Updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            // Redirect To Manege Admin Page
            header('location:'.SITEURL.'admin/manege-admin.php');
        }
        else
        {
            // Failed To Update Admin
            $_SESSION['update'] = "<div class='error'>Faild To Update Admin.</div>";
            // Redirect To Manege Admin Page
            header('location:'.SITEURL.'admin/manege-admin.php');
        }
    }

?>

<?php include('partials/footer.php'); ?>