<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php  
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title Of The Food.">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description Of The Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input data-type="currency" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                        <?php 
                            // Creat PHP Code To Display Category From Databsae
                            // 1. Creat SQL To Get All Active Category From Database
                            $sql = "SELECT * FROM tb_category WHERE active='Yes'";

                            // Execute Query
                            $res = mysqli_query($conn, $sql);

                            // Count Rows To Check Whether We Have Category Or Not
                            $count = mysqli_num_rows($res);

                            // If Count Is Greater Than Zero, We Have Categories Else We Do not Have
                            if($count>0)
                            {
                                // We Have Categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    // Get The Details Of Categories
                                    $id = $row['id'];
                                    $title = $row['title'];

                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    
                                    <?php
                                }
                            }
                            else
                            {
                                // We Do Not Have Categories
                                ?>

                                <option value="0">No Category Found</option>

                                <?php
                            }

                            // 2. Display On Dropdown
                        ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
            // Check Whether The Button Is Clicked Or Not
            if(isset($_POST['submit']))
            {
                // Add The Food In Database
                // echo "Clicked";

                // 1. Get The Data From Form 
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // Check Whether Radio Button For Featured And Active Are Checked Or Not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; // Setting The Default Value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; // Setting Default Value
                }

                // 2. Upload The Image If Selected
                // Check Whether The Select Image Is Clicked Or Not And Upload The Image Only If The Image Is Selected
                if(isset($_FILES['image']['name']))
                {
                    // Get The Details Of The Selected Image
                    $image_name = $_FILES['image']['name'];

                    // Check Whether The Image Is Selected Or Not And Upload Image Only If Selected
                    if($image_name !="")
                    {
                        // Image Is Selected
                        // A. Rename The Image
                        // Get The Extension Of Selected Image (jpg, png, gif, etc.) "Nour-keswani.jpg"
                        $ext = end(explode('.', $image_name));

                        // Create New Name For Image
                        $image_name = "Food-Name".rand(0000, 9999).".".$ext; // New Image Name May Be "Foo-Name-568.jpg" 

                        // B. Upload The Image
                        // Get The Src Path And Destination Path

                        // Source Path Is The Current Location Of The Image
                        $src = $_FILES['image']['tmp_name'];

                        // Destination Path For The Image To Be Uploaded
                        $dst = "../images/food/".$image_name;

                        // Finally Upload The Food Image
                        $upload = move_uploaded_file($src, $dst);

                        // Check Whether Image Uploaded Or Not
                        if($upload==false)
                        {
                            // Failed To Upload The Image
                            // Redirect To Add Food Page With Error Message
                            $_SESSION['upload'] = "<div class='error'>Failed To Upload Image</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            // Stop The Process
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = ""; // Setting Default Value As Blank
                }

                // 3. Insert Into Database

                // Create a SQL Query To Save Or Add Food
                // For Numerical Value We Do Not Need To Pass The Value Inside '' But For String It Is Compulsory To Add Quotes ''
                $sql2 = "INSERT INTO tb_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                // Execute The Query 
                $res2 = mysqli_query($conn, $sql2);

                //Check Whether Data Inserted Or Not
                if($res2==true)
                {
                    // Data Inserted Successfully
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manege-food.php');
                }
                else
                {
                    // Failed To Insert Data 
                    $_SESSION['add'] = "<div class='error'>Failed To Add Food..</div>";
                    header('location:'.SITEURL.'admin/manege-food.php');
                }

                // 4. Redirect With Message To Manege Food Page
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>