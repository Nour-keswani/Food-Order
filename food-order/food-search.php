<?php include('partials-front/menu.php'); ?> 

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php
            // Get The Search Keyword
            // $search = $_POST['search']; v1
            $search = mysqli_real_escape_string($conn, $_POST['search']);
        ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                // SQL Query To Get Foods Based On Search Keyword
                // $search = 'burger'
                // "SELECT * FROM tb_food WHERE title LIKE '%%' OR Description LIKE '%%'";
                $sql = "SELECT * FROM tb_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                // Execute The Query
                $res = mysqli_query($conn, $sql);

                // Count Rows
                $count = mysqli_num_rows($res);

                // Check Whether Food Available Or Not
                if($count>0)
                {
                    // Food Available 
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // Get The Data
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    // Check Whether Image name Is Available Or Not
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

                                <a href="#" class="btn btn-primary">Order Now</a>
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

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?> 