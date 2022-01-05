<?php include('partials-front/menu.php'); ?> 

<?php
    // Check Whether id Is Passed Or Not
    // if(isset($_POST['submit']))
    // {   
    //     // Contact id Is Set And Get id
    //     $username = $_POST['username'];
    //     $mailFrom = $_POST['mail'];
    //     $phone = $_POST['phone'];
    //     $subject = $message;
    //     $message = $_POST['message'];

    //     $mailTo = "nourkeswane2010@msn.com";
    //     $headers = "From: ".$mailFrom;
    //     $txt = "You have received an e-mail from ".$username.".\n\n".$message;

    //     mail($mailTo, $subject, $txt, $headers);
    //     header('location:'.SITEURL);
    // }

?>

<section class="food-search">
        <div class="container">
            <form action="" method="POST" enctype="multipart/form-data" class="contact">
                
                    <fieldset class="tbl-30">
                        <legend>Contact Form</legend>
                        <div class="order-label">Full Name</div>
                        <input type="text" name="username" value="" class="input-responsive" required>

                        <div class="order-label">Email</div>
                        <input type="email" name="email" placeholder="E.g. unknown@hotmail.com" class="input-responsive" required>
                        
                        <div class="order-label">Phone Number</div>
                        <input type="number" name="phone" placeholder="E.g. 0614....." class="input-responsive" required>

                        <div class="order-label">Subject</div>
                        <input type="text" name="subject" placeholder="" class="input-responsive" required>
                        

                        <div class="order-label">Contatct Message</div>
                        <textarea name="message" cols="30" rows="5" class="input-responsive" required></textarea>

                        <input type="submit" name="submit" value="Send Message" class="btn btn-primary">
                    </fieldset>
                
            </form>
        </div>
    </section>




<?php include('partials-front/footer.php'); ?>