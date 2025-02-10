<!DOCTYPE html>
<html>
<head>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        #user-btn {
            display: inline-block; 
            vertical-align: middle; 
            margin-right: 10px; 
            cursor: pointer;
        }
        #user-btn:hover {
            color: #4CAF50; /* Change the color to whatever you like */
        }
    </style>
</head>
</html>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<header class="header">

   <div class="flex">

   <a href="home.php"><img src="logo.png" alt="" style="width:120px;height:100px;"></a> 

      <nav class="navbar">
         <a href="home.php" style="text-decoration: none;">HOME</a>
         
         <a href="orders.php" style="text-decoration: none;">ORDERS</a>
         <a href="about.php" style="text-decoration: none;">ABOUT</a>
         <a href="contact.php" style="text-decoration: none;">CONTACT</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
         ?>
         <div style="white-space: nowrap;">
            <div id="user-btn" class="fas fa-user" style="display: inline-block; vertical-align: middle; margin-right: 10px; cursor: pointer;"></div>
            
            <a href="wishlist.php" style="display: inline-block; vertical-align: middle; margin-right: 10px;"><i class="fas fa-heart"></i><span>(<?= $count_wishlist_items->rowCount(); ?>)</span></a>
            <a href="cart.php" style="display: inline-block; vertical-align: middle;"><i class="fas fa-shopping-cart"></i><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
         </div>

      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name']; ?></p>
         <div style="text-align: center;">
            <a href="user_profile_update.php" class="btn" style="display: inline-block; width: 80%; margin: 10px auto; font-size: 1.8rem; text-decoration: none; color: white; background-color: #007bff; padding: 10px 0; border-radius: 5px;">Update Profile</a>
            <a href="logout.php" class="delete-btn" style="display: inline-block; width: 80%; margin: 10px auto; font-size: 1.8rem; text-decoration: none; color: white; background-color: #f44336; padding: 10px 0; border-radius: 5px;">Logout</a>
         </div>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">Register</a>
         </div>
      </div>

   </div>

</header>