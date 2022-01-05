<?php 
    // Include Constants Page
    include('../config/constants.php');
    // echo "Delete Food-Page";

    if(isset($_GET['id']) && isset($_GET['image_name'])) // Either Use '&&' Or 'AND'
    {
        // Process To Delete
        // 1. Get ID And Image Name 
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // 2.Remove The Image If Available
        // Check Whether The Image Is Available Or Not And Delete Only If Available
        if($image_name != "")
        {
            // It Has Image And Need To Remove From Folder
            // Get The Image Path
            $path = "../images/food/".$image_name;

            // Remove Image File From Folder
            $remove = unlink($path);

            // Check Whether The Image Is Remove Or Not
            if($remove==false)
            {
                // Failed To Remove Image
                $_SESSION['upload'] = "<div class='error'>Failed To Remove Image</div>";
                // Redirect To Manege Food
                header('location:'.SITEURL.'admin/manege-food.php');
                // Stop Process Of Deleting Food
                die();
            }
        }

        // 3. Delete Food From Database
        $sql = "DELETE FROM tb_food WHERE id=$id";

        // Execute The Query
        $res = mysqli_query($conn, $sql);

        // Check Whether The Query Execute Or Not And Set The Session Message Respectively
        if($res==true)
        {
            // Food Deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manege-food.php');
        }
        else
        {
            // Failed To Delete Food
            $_SESSION['delete'] = "<div class='error'>Failed To Delete Food.</div>";
            header('location:'.SITEURL.'admin/manege-food.php');
        }


    }
    else
    {
        // Redirect To Manege Food Page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manege-food.php');
    }
?>