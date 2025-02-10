<head>
<style>
    .success-message {
        color: white; 
        background-color: #4CAF50; 
        padding: 10px; 
        margin: 10px 0; 
        border-radius: 5px; 
        text-align: center; 
        position: relative; 
        font-size: 25px; 
    }

    .close-btn {
        position: absolute; 
        top: 0;
        right: 0;
        padding: 5px 10px;
        background-color: red;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px; 
    }

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
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   //=====================================
   $p_validation = isset($_POST['p_ava']) ? filter_var($_POST['p_ava'], FILTER_VALIDATE_BOOLEAN) : false;
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'Already added to wishlist.';
      foreach ($message as $msg) {
         echo "<div class='success-message'>{$msg} <button class='close-btn' onclick='redirectToPage()'>X</button></div>";
      }
      unset($message);

   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'Already added to Cart.';
      foreach ($message as $msg) {
         echo "<div class='success-message'>{$msg} <button class='close-btn' onclick='redirectToPage()'>X</button></div>";
      }unset($message);

   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image, is_available) VALUES(?,?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image, $p_validation ]);
      $message[] = 'Added to wishlist.';
      foreach ($message as $msg) {
         echo "<div class='success-message'>{$msg} <button class='close-btn' onclick='redirectToPage()'>X</button></div>";
      }
      unset($message);
   }

}

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 5){
      $message[] = 'Already added to Cart.';
      foreach ($message as $msg) {
         echo "<div class='success-message'>{$msg} <button class='close-btn' onclick='redirectToPage()'>X</button></div>";
      }
      unset($message);

   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'Added to Cart.';
      foreach ($message as $msg) {
         echo "<div class='success-message'>{$msg} <button class='close-btn' onclick='redirectToPage()'>X</button></div>";
      }
      unset($message);
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home Page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <br><br><br><br><br><br><br><br>
         <span>Don't panic, Go organic.</span>
         <h3>Reach For A Healthier You With Organic Foods</h3>
         <p>Your satisfaction is our top priority. We strive to provide exceptional customer service, ensuring a smooth and enjoyable shopping experience.</p>
         <a href="about.php" class="btn" style="font-size: 1.8rem;">About Us</a>
      </div>

   </section>

</div>

<section class="home-category">

   <h1 class="title">shop by category</h1>

   <div class="box-container" style="display: flex; justify-content: center; align-items: stretch;">
      <div class="box" style="flex: 1; margin: 10px; box-sizing: border-box;">
         <a href="category.php?category=fruits">
            <img src="images/cat-1.png" alt="">
         </a>
         <h3>fruits</h3>
         <p>
            Our commitment is to bring you the freshest fruits, ripe and ready to eat. We ensure that every bite is as delicious as it is nutritious, bringing you the natural goodness you deserve.
         </p>
         <a href="category.php?category=fruits" class="btn" style="font-size: 1.8rem;">fruits</a>
      </div>
      <div class="box" style="flex: 1; margin: 10px; box-sizing: border-box;">
         <a href="category.php?category=meat">
            <img src="images/cat-2.png" alt="">
         </a>
         <h3>meat</h3>
         <p>
            We pride ourselves on sourcing only the finest meats, characterized by their marbling, texture, and flavor. Our selection includes grass-fed beef, organic chicken, heritage pork, and more, ensuring that every cut meets our strict standards of quality and freshness.
         </p>
         <a href="category.php?category=meat" class="btn" style="font-size: 1.8rem;">meat</a>
      </div>
      <div class="box" style="flex: 1; margin: 10px; box-sizing: border-box;">
         <a href="category.php?category=vegitables">
            <img src="images/cat-3.png" alt="">
         </a>
         <h3>vegitables</h3>
         <p>
            Quality and freshness are our top priorities. We partner with local farmers and trusted growers to bring you vegetables that are harvested at their peak of freshness and flavor. From soil to store, we ensure every step is taken to preserve the natural goodness of our produce.
         </p>
         <a href="category.php?category=vegitables" class="btn" style="font-size: 1.8rem;">vegitables</a>
      </div>
      <div class="box" style="flex: 1; margin: 10px; box-sizing: border-box;">
         <a href="category.php?category=fish">
            <img src="images/cat-4.png" alt="">
         </a>
         <h3>fish</h3>
         <p>
            Explore our curated selection of fish and seafood, and let every meal be an adventure over the waves. Whether baked, grilled, or pan-seared, our fish are a canvas for your culinary creativity.
         </p>
         <a href="category.php?category=fish" class="btn" style="font-size: 1.8rem;">fish</a>
      </div>
   </div>


</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
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
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <!-- ========================================================================== -->
      <input type="hidden" name="p_ava" value="<?= $fetch_products['is_available']; ?>">
      <!-- ========================================================================== -->
      <input type="number" min="1" value="1" name="p_qty" class="qty" <?php if(!$fetch_products['is_available']) echo 'disabled'; ?>>
      <div style="text-align: center;">
         <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist" style="display: block; width: 80%; margin: 10px auto;">
         <!-- <input type="submit" value="add to cart" class="btn"  name="add_to_cart" style="display: block; width: 80%; margin: 10px auto; font-size: 1.8rem; " <?php if(!$fetch_products['is_available']) echo 'disabled'; ?>> -->
      <input type="submit" 
         value="add to cart" 
         class="btn <?php if(!$fetch_products['is_available']) echo 'disabled-btn'; ?>"  
         name="add_to_cart" 
         style="display: block; 
               width: 80%; 
               margin: 10px auto; 
               font-size: 1.8rem;
               background-color: <?php echo $fetch_products['is_available'] ? 'green' : 'grey'; ?>;
               color: <?php echo $fetch_products['is_available'] ? 'white' : 'darkgray'; ?>;
               transition: background-color 0.9s ease;"
         <?php if(!$fetch_products['is_available']) echo 'disabled'; ?>
      >

      </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

<script>
   function redirectToPage() {
      window.location.href = 'home.php'; 
   }
</script>

</body>
</html>