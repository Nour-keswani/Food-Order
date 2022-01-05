<?php include('partials/menu.php'); ?>

<?php 
    // Check Whether id Is Set Or Not
    if(isset($_GET['id']))
    {
        // Get All The Details
        $id = $_GET['id'];

        // SQL Query To Get The Selected Food
        $sql2 = "SELECT * FROM tb_food WHERE id=$id";
        // Execute The Query
        $res2 = mysqli_query($conn, $sql2);

        // Get The Value Based On Query Executed
        $row2 = mysqli_fetch_assoc($res2);

        // Get The Individual Values Of Selected Food
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else
    {
        // Redirect To Manege Food
        header('location:'.SITEURL.'admin/manege-food.php');
    }


?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input data-type="currency" name="price" value="<?php echo $price; ?>" >€
                </td>
            </tr>

            <tr>
                <td>Curent Image: </td>
                <td>
                    <?php
                        if($current_image == "")
                        {
                            // Image Not Available
                            echo "<div class='error'>Image Not Available.</div>";
                        }
                        else
                        {
                            // Image Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">

                        <?php 
                            // Query To Get Active Category
                            $sql = "SELECT * FROM tb_category WHERE active='Yes'";
                            // Execute The Query
                            $res = mysqli_query($conn, $sql);
                            // Count Rows
                            $count = mysqli_num_rows($res);

                            // Check Whether Category Available Or Not
                            if($count>0)
                            {
                                // Category Available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if($current_category==$category_id) {echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                // Category Not Available
                                echo "<option value='0'>Category Not Available.</option>";
                            }
                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured</td>
                <td>
                    <input <?php if($featured=="Yes") {echo "Checked";} ?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured=="No") {echo "Checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>
            
            <tr>
                <td>Active</td>
                <td>
                    <input <?php if($active=="Yes") {echo "Checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=="No") {echo "Checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo "$current_image"; ?>">

                    <input type="submit" name="submit" value="Updata Food" class="btn-secondary">
                </td>
            </tr>

        </table>

        </form>

        <?php

            if(isset($_POST['submit']))
            {
                // echo "Button Clicked";
                // 1. Get All The Detalis From The Form 
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // 2. Upload The Image If Selected

                // Check Whether Upload Button Is Clicked Or Not 
                if(isset($_FILES['image']['name']))
                {
                    // Upload Button Clicked
                    $image_name = $_FILES['image']['name']; // New Image Name

                    // Check Whether The File Is Available Or Not
                    if($image_name!="")
                    {
                        // Image Is Available
                        // A. Upload New Image

                        // Rename The Image
                        $ext = end(explode('.', $image_name)); // Get The Extension Of The Image

                        $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext; // This Will Rename Image
                        
                        // Get The Source Path And Destination Path
                        $src_path = $_FILES['image']['tmp_name']; // Source Path
                        $dest_path = "../images/food/".$image_name; // Destination Path

                        // Upload The Image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        // Check Whether The Image Is Uploaded Or Not
                        if($upload==false)
                        {
                            // Failed To Upload 
                            $_SESSION['upload'] = "<div class='error'>Failed To Upload New Image.</div>";
                            // Redirect To Manege Food
                            header('location:'.SITEURL.'admin/manege-food.php'); 
                            // Stop The Process
                            die();
                        }
                        // 3. Remove The Image If New Image Is Uploaded And Current Image Exists
                        // B. Remove Current Image If Available
                        if($current_image!="")
                        {
                            // Current Image Is Available
                            // Remove The Image
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            // Check Whether The Image Is Removed Or Not
                            if($remove==false)
                            {
                                // Failed To Remove Current Image 
                                $_SESSION['remove-failed'] = "<div class='error'>Failed To Remove Current Image.</div>";
                                // redirect To Manege Food 
                                header('location:'.SITEURL.'admin/manege-food.php');
                                // Stop The Process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; // Default Image When Image Not Selected
                    }
                }
                else
                {
                    $image_name = $current_image; // Default Image When Button Is Not Clicked
                }
                

                // 4. Update The Food In Database
                $sql3 = "UPDATE tb_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = '$category',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id
                ";

                // Execute The SQL Query 
                $res3 = mysqli_query($conn, $sql3);

                // Check Whether The Query Is Executed Or Not
                if($res3==true)
                {
                    // Query Executed And Food Updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manege-food.php');
                }
                else
                {
                    // Failed To Update Food
                    $_SESSION['update'] = "<div class='error'>Failed To Update Food.</div>";
                    header('location:'.SITEURL.'admin/manege-food.php');
                }

            }

        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>