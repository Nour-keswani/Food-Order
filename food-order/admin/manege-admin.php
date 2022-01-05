<?php include('partials/menu.php'); ?>


    <!-- Main Content Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manege-Admin</h1>
            <br />

            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; // Displaying Session Message
                    unset($_SESSION['add']); // Removing Session Message
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset ($_SESSION['delete']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                }
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset ($_SESSION['user-not-found']);
                }
                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];
                    unset ($_SESSION['pwd-not-match']);
                }
                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];
                    unset ($_SESSION['change-pwd']);
                }
            ?>
            <br /><br /><br />

            <!-- Button to Add Admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>

            <br /><br /><br />
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    // Query To Get All Admin
                    $sql = "SELECT * FROM tb_admin";

                    // Excute The Query 
                    $res = mysqli_query($conn, $sql);
                    
                    // Check Whether The Query Is Excuted Or Not
                    if($res==TRUE)
                    {
                        // Count Rows To Check Whether We Have Data In Database Or Not
                        $count = mysqli_num_rows($res); // Function To Get All Rows In Database

                        $sn = 1; // Create a Variable And Assign The Value
                    
                        //Check The Num Of Rows
                        if($count>0) 
                        {
                            // We Have Data In Database
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                // Using Whil Loop To Get All The Data From Database
                                // And While Loop Will Run As Lond As We Have Data In Dtatbase

                                // Get Individual Dat
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];

                                // Display The Value In Our Table
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else 
                        {
                            // We Dont Have Data In Database
                        }
                    }
                ?>

            </table>
        </div>
    </div>
    <!-- Main Content Section End -->

<?php include('partials/footer.php'); ?>