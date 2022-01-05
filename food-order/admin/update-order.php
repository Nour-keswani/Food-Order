<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php 
        
            // Check Whether id Is Set Or Not
            if(isset($_GET['id']))
            {
                // Get The Order Detalis
                $id = $_GET['id'];

                // Get All The Detalis Bassed On This id
                // SQL Query To Get The Order Detalis
                $sql = "SELECT * FROM tb_order WHERE id=$id";

                // Execute The Query
                $res = mysqli_query($conn, $sql);

                // Count Rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    // Detalis Available
                    $row = mysqli_fetch_assoc($res);

                    $food               = $row['food'];
                    $price              = $row['price'];
                    $qty                = $row['qty'];
                    $status             = $row['status'];
                    $customer_name      = $row['customer_name'];
                    $customer_contact   = $row['customer_contact'];
                    $customer_email     = $row['customer_email'];
                    $customer_address   = $row['customer_address'];
                }
                else
                {
                    // Detalis Not Available
                    // Redirect To Manege Order Page
                    header('location:'.SITEURL.'admin/manege-order.php');
                }
            }
            else
            {
                // Redirect To Manege Order Page
                header('location:'.SITEURL.'admin/manege-order.php');
            }
        
        ?>

        <form action="" method="POST">

            <table class="tbl-30">

                <tr>
                    <td>Food Name: </td>
                    <td><b> <?php echo $food; ?> </b></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><b> € <?php echo $price; ?> </b></td>
                </tr>

                <tr>
                    <td>QTY: </td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "On Delivery";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "Delivered";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "Cancelled";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea type="text" name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php
            // Check Whether Update Button Is Clicked Or Not
            if(isset($_POST['submit']))
            {
                // echo "Clicked";
                // Get All The Values From Form
                $id                 = $_POST['id'];
                $price              = $_POST['price'];
                $qty                = $_POST['qty'];

                $total              = $price * $qty;

                $status             = $_POST['status'];
                $customer_name      = mysqli_real_escape_string($conn, $_POST['customer_name']);
                $customer_contact   = mysqli_real_escape_string($conn, $_POST['customer_contact']);
                $customer_email     = mysqli_real_escape_string($conn, $_POST['customer_email']);
                $customer_address   = mysqli_real_escape_string($conn, $_POST['customer_address']);

                //  Update The Value
                $sql2 = "UPDATE tb_order SET
                    qty                 = $qty,
                    total               = $total,
                    status              = '$status',
                    customer_name       = '$customer_name',
                    customer_contact    = '$customer_contact',
                    customer_email      = '$customer_email',
                    customer_address    = '$customer_address'
                    WHERE id = $id
                ";

                // Execute The Query
                $res2 = mysqli_query($conn, $sql2);

                // Check Whether Update Or Not
                // Redirect To Manege Order With Message
                if($res2==true)
                {
                    // Updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    // Redirect To Manege Order With Message
                    header('location:'.SITEURL.'admin/manege-order.php');
                }
                else
                {
                    // Failed To Updated
                    $_SESSION['update'] = "<div class='error'>Failed To Update Order.</div>";
                    // Redirect To Manege Order With Message
                    header('location:'.SITEURL.'admin/manege-order.php');
                }               
            }
        ?>

    </div>
</div>



<?php include('partials/footer.php'); ?>