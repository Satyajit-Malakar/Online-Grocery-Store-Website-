<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   //=====================================
   //$p_validation = $_POST['p_ava'];
   $p_validation = isset($_POST['p_ava']) ? filter_var($_POST['p_ava'], FILTER_VALIDATE_BOOLEAN) : false;
   
   if (!filter_var($p_price, FILTER_VALIDATE_FLOAT)) {
       $message[] = 'Invalid price format!';
   } else {
       $p_price = number_format((float)$p_price, 2, '.', '');
       $p_image = $_POST['p_image'];
       $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

       $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
       $check_wishlist_numbers->execute([$p_name, $user_id]);

       $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
       $check_cart_numbers->execute([$p_name, $user_id]);

       if($check_wishlist_numbers->rowCount() > 0){
          $message[] = 'Already added to wishlist.';
       }elseif($check_cart_numbers->rowCount() > 0){
          $message[] = 'Already added to cart.';
       }else{
          $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image, is_available) VALUES(?,?,?,?,?,?)");
          $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image, $p_validation ]);
          $message[] = 'Added to wishlist.';
       }
   }
}

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_validation = isset($_POST['p_ava']) ? filter_var($_POST['p_ava'], FILTER_VALIDATE_BOOLEAN) : false;
   if (!filter_var($p_price, FILTER_VALIDATE_FLOAT)) {
       $message[] = 'Invalid price format!';
   } else {
       $p_price = number_format((float)$p_price, 2, '.', '');
       $p_image = $_POST['p_image'];
       $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
       $p_qty = $_POST['p_qty'];
       $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

       $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
       $check_cart_numbers->execute([$p_name, $user_id]);

       if($check_cart_numbers->rowCount() > 0){
          $message[] = 'Already added to cart.';
       }else{

          $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
          $check_wishlist_numbers->execute([$p_name, $user_id]);

          if($check_wishlist_numbers->rowCount() > 0){
             $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
             $delete_wishlist->execute([$p_name, $user_id]);
          }

          $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
          $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
          $message[] = 'Added to cart.';
       }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="css/style.css">

   <style>

      .availability {
         color: green;
         font-weight: bold;
      }

      .not-available {
         color: red;
      }

      .qty {
         display: block;
         width: 100%;
         margin-bottom: 10px;
         padding: 10px;
      }


      .btn {
         background-color: green; 
         color: white;
         transition: background-color 0.9s ease;
      }

      .disabled-btn {
         background-color: grey; /* Disabled state color */
         color: darkgray;
      }

      /* Hover effects */
      .btn:not(.disabled-btn):hover {
         background-color: #0f3d0f; /* Hover effect for enabled button */
      }

      .disabled-btn:hover {
         background-color: darkgrey; /* Hover effect for disabled button */
      }

   </style>

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="p-category">

   <a href="category.php?category=fruits">fruits</a>
   <a href="category.php?category=vegitables">vegitables</a>
   <a href="category.php?category=fish">fish</a>
   <a href="category.php?category=meat">meat</a>

</section>

<section class="products">

   <h1 class="title">all products</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">$<span><?= number_format($fetch_products['price'], 2); ?></span>/-</div>
      <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <?php if ($fetch_products['is_available']): ?>
         <p class="availability" style="font-size: 1.8rem;">In Stock</p>
      <?php else: ?>
         <p class="availability not-available" style="font-size: 1.8rem;">Out of Stock</p>
      <?php endif; ?>
      <input type="hidden" name="p_price" value="<?= number_format($fetch_products['price'], 2); ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <!-- ========================================================================== -->
      <input type="hidden" name="p_ava" value="<?= $fetch_products['is_available']; ?>">
      <!-- ========================================================================== -->
      <input type="number" min="1" value="1" name="p_qty" class="qty" <?php if(!$fetch_products['is_available']) echo 'disabled'; ?>>
      <div style="text-align: center;">
         <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist" style="display: block; width: 80%; margin: 10px auto;">
         <!-- <input type="submit" value="add to cart" class="btn" name="add_to_cart" style="display: block; width: 80%; margin: 10px auto; font-size: 1.8rem;"> -->
         <input type="submit" value="Add to Cart" class="btn <?php if(!$fetch_products['is_available']) echo 'disabled-btn'; ?>" name="add_to_cart" style="display: block; width: 80%; margin: 10px auto; font-size: 1.8rem;" <?php if(!$fetch_products['is_available']) echo 'disabled'; ?>>
      </div>
   </form>
   <?php
         }
      } else {
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
   $('.add-to-cart-form').submit(function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      $.ajax({
         url: 'add_to_cart.php',
         type: 'POST',
         data: formData,
         success: function(response) {
            alert("Product added to cart");
            
         }
      });
   });
});
</script>

</body>
</html>

