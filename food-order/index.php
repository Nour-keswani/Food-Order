<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset ($_SESSION['order']);
        }
    ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                // Create SQL Query To Display Category From Database
                $sql = "SELECT * FROM tb_category WHERE active='Yes' AND featured='Yes' LIMIT 4";

                // Execute The Query 
                $res= mysqli_query($conn, $sql);

                // Count Rows To Check Whether The Category Is Available Or Not
                $count = mysqli_num_rows($res);
                
                if($count>0)
                {
                    // Categories Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // Get The Value Like id, Title , image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    // Check Whether Image Is Available Or Not
                                    if($image_name=="")
                                    {
                                        // Display Message
                                        echo "<div class='error'>Image Not Available.</div>";
                                    }
                                    else
                                    {
                                        // Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve img-hg">
                                        <?php
                                    }
                                ?>

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    // Categories Not Available
                    echo "<div class='error'>Category Not Added.</div>";
                }
            ?>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

            // Getting Foods From Database That Are Active And Featured 
            // SQL Query
            $sql2 = "SELECT * FROM tb_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            // Execute The Query
            $res2 = mysqli_query($conn, $sql2);

            // Count Rows
            $count2 = mysqli_num_rows($res2);
            
            // Check Whether Food Available Or Not
            if($count2>0)
            {
                // Food Available
                while($row=mysqli_fetch_assoc($res2))
                {
                    // Get All The Values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                // Check Whether Image Available Or Not
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
                // Food Not Available
                echo "<div class='error'>Food Not Available.</div>";
            }

            ?>

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php?food_id=<?php echo $id; ?>" class="btn btn-primary">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->



<?php include('partials-front/footer.php'); ?>   