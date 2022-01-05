<?php include('config/constants.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css" />
    
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>" title="Logo">
                    <img src="images/vista.png" alt="Restaurant Logo" class="navbar-brand">
                </a>
            </div>

            <button 
                class="navbar-toggler" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navmenu"
            >

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto text-right">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITEURL; ?>">Home
                            <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITEURL; ?>contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar Section Ends Here -->