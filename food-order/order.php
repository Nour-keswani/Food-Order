<?php include('partials-front/menu.php'); ?> 

    <?php 
        // Check Wether Food id Is Set Or Not
        if(isset($_GET['food_id']))
        {
            // Get The Food id And Details Of The Selected Food
            $food_id = $_GET['food_id'];

            // Get The Details Of The Selected Food
            $sql = "SELECT * FROM tb_food WHERE id=$food_id";

            // Execute The Query 
            $res = mysqli_query($conn, $sql);

            // Count The Rows
            $count = mysqli_num_rows($res);

            // Check Whether The Data Is Available Or Not
            if($count>0)
            {
                // We Have Data
                // Get The Data From Database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                // Food Not Available
                // Redirect To Homepage
                header('location:'.SITEURL);
            }
        }
        else
        {
            // Redirect To Home Page
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset style="background-color: #eccc68;">
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            // Check Whether The Image Is Available Or Not
                            if($image_name=="")
                            {
                                // Image Is Not Available
                                echo "<div class='error'>Image Not Available.</div>";
                            }
                            else
                            {
                                // Image Is Available 
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">€<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset style="background-color: #eccc68;">
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Nour Alkeswani" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0614xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. unknown@hotmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

                // Check Whether Submit Button Is Clicked 
                if(isset($_POST['submit']))
                {
                    // Get All The Details From The Form
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // total = price x qty

                    $order_date = date("Y-m-d h:i:sa"); // Order Date

                    $status = "ordered"; // Ordered, On Delivery, Delivered, Cancelled

                    $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                    $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
                    $customer_email = $_POST['email'];
                    $customer_address = mysqli_real_escape_string($conn, $_POST['address']);


                    // Save The Order In Database
                    // Create SQL To Save The Data
                    $sql2 = "INSERT INTO tb_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    // echo $sql2; die();

                    // Execute The Query
                    $res2 = mysqli_query($conn, $sql2);

                    // Check Whether Query Executed Successfully Or Not
                    if($res2==true)
                    {
                        // Query Executed And Order Saved 
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        // Failed To Save Order
                        $_SESSION['order'] = "<div class='error text-center'>Failed To Order Food.</div>";
                        header('location:'.SITEURL);
                    }

                }
                else
                {
                    
                }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?> 