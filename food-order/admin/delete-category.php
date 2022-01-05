<?php 
    // Include Constants File
    include('../config/constants.php');

    // echo "Delete Page";
    // Check Whether The id And image_name Value Is Set Or Not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get The Value And Delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove The Physical Image File Is Available
        if($image_name != "")
        {
            // Image Is Available. So Remov it
            $path = "../images/category/".$image_name;
            //Remove The Image
            $remove = unlink($path);

            // If Failed To Remove Image Then Add An Error Message And Stop The Process
            if($remove==false)
            {
                // Set The Session Message
                $_SESSION['remove'] = "<div class='error'>Failed To Remove Category Image.</div>";
                // Redirect To Manege Category Page
                header('location:'.SITEURL.'admin/manege-category.php');
                // Stop The Prosecc
                die();
            }
        }

        // Delete Data From Database
        // SQL Query Delete Data From Database
        $sql = "DELETE FROM tb_category WHERE id=$id";

        // Execute The Query
        $res = mysqli_query($conn, $sql);

        // Check Whether The Data Is Delete From Database Or Not
        if($res==true)
        {
            // Set Success Message And Redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            // Redirect To Manege Category
            header('location:'.SITEURL.'admin/manege-category.php');
        }
        else
        {
            // Set Failed Message And Redirect
            $_SESSION['delete'] = "<div class='error'>Failed To Delete The Category.</div>";
            // Redirect To Manege Category
            header('location:'.SITEURL.'admin/manege-category.php');
        }
    }
    else
    {
        // Redirect To Manege Category Page
        header('location:'.SITEURL.'admin/manege-category.php');
    }
?>