<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/about-img-1.png" alt="">
         <h3>why choose us?</h3>
         <p> We understand that time is your most valuable asset. Our platform is designed for ease of use, allowing you to shop for groceries from anywhere, at any time. Say goodbye to long lines and crowded supermarkets; with us, your grocery shopping is just a few clicks away.</p>
         <a href="contact.php" class="btn" style="font-size: 1.8rem;">contact us</a>
      </div>

      <div class="box">
         <img src="images/about-img-2.png" alt="">
         <h3>what we provide?</h3>
         <p>Our extensive selection includes fresh fruits and vegetables, meat and fish, and much more.Choose a delivery slot that suits your schedule. We offer same-day delivery, next-day delivery at a convenient location.</p>
         <a href="shop.php" class="btn" style="font-size: 1.8rem;">our shop</a>
      </div>

   </div>

</section>


<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>