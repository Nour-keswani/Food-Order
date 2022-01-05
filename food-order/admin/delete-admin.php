<?php 
    // Include Constants.php file Here
    include('../config/constants.php');

    // 1. Get The Id Of Admin To Be Deleted
    $id = $_GET['id'];

    // 2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM tb_admin WHERE id=$id";

    // 3. Redirect To Manege Admin Page With Message (Success/Error)
    $res = mysqli_query($conn, $sql);

    // Check Whether The Query Excuted Succssesfully Or Not 
    if($res==true)
    {
        // Query Excuted Successfully And Admin Deleted
        // echo "Admin Deleted";
        //  Create Session Variable To Display Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Succssesfully.</div>";
        // Redirect To Manege Admin Page
        header('location:'.SITEURL.'admin/manege-admin.php');
    }
    else{
        // Faild To Delete Admin
        // echo "Faild To Delete Admin";
        $_SESSION['delete'] = "<div class='error'>Failed To Delete Admin. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manege-admin.php');
    }

    // Redirect To Manege Admin Page With Message (Success/Error)
?>