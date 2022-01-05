<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <!-- Add Category Form Start -->
        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Category Title">
                </td>
            </tr>

            <tr>
                <td>Select Image</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Featured</td>
                <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active</td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>
        <!-- Add Category Form End -->

        <?php 
        
        // Check Whether The Submit Button Is Clicked Or Not
        if(isset($_POST['submit']))
        {
            // echo "Clicked";

            // 1. Get The Value From Category Form
            $title = $_POST['title'];

            // For Radio Input, We Need To Check Whether The Button Is Selected Or Not
            if(isset($_POST['featured']))
            {
                // Get The Value From Form
                $featured = $_POST['featured'];
            }
            else
            {
                // Set The Default Value
                $featured = "No";
            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }

            // Check Whether The Image Is Selected Or Not And Set The Value For Image Name Accoridingly
            // print_r($_FILES['image']);

            // die(); // Break The Code Here

            if(isset($_FILES['image']['name']))
            {
                // Upload The Image
                // To Upload The Image We Need The Image Name, Source Path And Destination Path
                $image_name = $_FILES['image']['name'];

                // Upload Image Only If Image Is Selected
                if($image_name != "")
                {
                    // Auto Rename Our Image
                    // Get The Extension Of Our Image (jpg, png, gif, etc) e.g. "specialood1.jpg"
                    $ext = end(explode('.', $image_name));

                    // Rename The Image
                    $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // e.g. Food_Category_545.jpg
                    

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/".$image_name;

                    // Finally Upload The Image 
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check Whether The Image Is Uploaded Or Not
                    // And If The Image Is Not Uploaded Then We Will Stop The Process And Redirect With Error Message
                    if($upload==false)
                    {
                        // Set Message
                        $_SESSION['upload'] = "<div class='error'>Failed To Upload Image</div>";
                        // Redirect To Add Category Page
                        header('location:'.SITEURL.'admin/add-category.php');
                        // Stop The Process
                        die();
                    }
                }
            }
            else
            {
                // Don't Upload Image And Set The image_name Value As Blank
                $image_name = "";
            }

            // 2. Create SQL Query To Insert Category Into Database
            $sql = "INSERT INTO tb_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
            ";
            // 3. Execute The Query And Save In Database
            $res = mysqli_query($conn, $sql);

            // 4. Check Whether The Query Executed Or Not And Data Added Or Not
            if($res==true)
            {
                // Query Execute And Category Added
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                // Redirect To Manege Category Page
                header('location:'.SITEURL.'admin/manege-category.php');
            }
            else
            {
                // Failed To Add Category
                $_SESSION['add'] = "<div class='error'>Failed To Add Categoryy.</div>";
                // Redirect To Manege Category Page
                header('location:'.SITEURL.'admin/add-category.php');
            }
        }
        
        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>