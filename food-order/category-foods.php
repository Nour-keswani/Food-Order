<?php include('partials-front/menu.php'); ?> 

<?php
    // Check Whether id Is Passed Or Not
    if(isset($_GET['category_id']))
    {
        // Category id Is Set And Get id
        $category_id = $_GET['category_id'];
        // Get The Gategory Title Passed On Category id
        $sql = "SELECT title FROM tb_category WHERE id=$category_id";
        
        // Execute The Query
        $res = mysqli_query($conn, $sql);

        // Get The Value From Database
        $row = mysqli_fetch_assoc($res);

        // Get The Title
        $category_title = $row['title'];
    }
    else
    {
        // Category Not Passed
        // Redirect To Home Page
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                // Create SQL Query To Get Foods Bassed On SElected Category
                $sql2 = "SELECT * FROM tb_food WHERE category_id=$category_id";
                
                // Execute The Query 
                $res2 = mysqli_query($conn, $sql2);

                // Count Rows
                $count2 = mysqli_num_rows($res2);

                // Check Whether Food Is Available Or Not
                if($count2>0)
                {
                    // Food Is Available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name=="")
                                    {
                                        // Image Not Available
                                        echo "<div class='error'>Image Not Available.</div>";
                                    }
                                    else
                                    {
                                        // Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">€<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }

                }
                else
                {
                    // Food Is Not Available
                    echo "<div class='error'>Food Is Not Available.</div>";
                }
            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?> 