
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
</style>
</head>

<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = ''. $_POST['flat'] .' '. $_POST['street'] .' '. $_POST['city'] .' '. $_POST['state'] .' '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   if($cart_query->rowCount() > 0){
      while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
         $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      };
   };

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
   $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);

   if($cart_total == 0){
      $message[] = 'Your cart is empty';
   }elseif($order_query->rowCount() > 0){
      $message[] = 'Order placed already!';
   }else{
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);
      //$message[] = 'Order placed successfully!';

      $message = [];
      $message[] = 'Order placed successfully. You will receive a confirmation mail shortly.';
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
   <title>Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header_2.php'; ?>

<section class="display-orders">

   <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if($select_cart_items->rowCount() > 0){
         while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
   ?>
   <p> <?= $fetch_cart_items['name']; ?> <span>(<?= '$'.$fetch_cart_items['price'].'/- x '. $fetch_cart_items['quantity']; ?>)</span> </p>
   <?php
    }
   }else{
      echo '<p class="empty">your cart is empty!</p>';
   }
   ?>
   <div class="grand-total">In Total : <span>$<?= $cart_grand_total; ?>/-</span></div>
</section>

<section class="checkout-orders">

   <form action="" method="POST">

      <h3>place your order</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Name:</span><span style="color: red;">*</span>
            <input type="text" name="name" placeholder="Enter your name" class="box" required>
         </div>
         <div class="inputBox">
            <span>Number:</span><span style="color: red;">*</span>
            <input type="text" name="number" placeholder="Enter your number" class="box" required pattern="\d{10}" title="Number must be exactly 10 digits">

         </div>
         <div class="inputBox">
            <span>E-mail Address:</span><span style="color: red;">*</span>
            <input type="email" name="email" placeholder="Enter your E-mail address" class="box" required>
         </div>
         <div class="inputBox">
            <span>Payment Method:</span><span style="color: red;">*</span>
            <select name="method" class="box" required>
               <option value="cash on delivery">Cash on Delivery</option>
               <option value="credit card">Credit Card</option>
               <option value="paytm">Paytm</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Address Line 01:</span><span style="color: red;">*</span>
            <input type="text" name="flat" placeholder="e.g. Unit Number" class="box" required>
         </div>
         <div class="inputBox">
            <span>Address line 02:</span>
            <input type="text" name="street" placeholder="e.g. Street Name" class="box">
         </div>
         <div class="inputBox">
            <span>City/Suburb:</span><span style="color: red;">*</span>
            <input type="text" name="city" placeholder="e.g. Sydney" class="box" required>
         </div>
         <div class="inputBox">
            <span>State:</span><span style="color: red;">*</span>
            <input type="text" name="state" placeholder="e.g. NSW" class="box" required>
         </div>
         <div class="inputBox">
            <span>Country:</span><span style="color: red;">*</span>
            <input type="text" name="country" placeholder="e.g. Australia" class="box" required>
         </div>
         <div class="inputBox">
            <span>Postcode :</span><span style="color: red;">*</span>
            <input type="number" min="0" name="pin_code" placeholder="e.g. 4215" class="box" required>
         </div>
      </div>

      <div style="text-align: center;"> 
         <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="place order" style="font-size: 20px; display: block; margin: 0 auto;">
      </div>


   </form>

</section>


<?php include 'footer_2.php'; ?>

<script src="js/script.js"></script>


<script>
   function redirectToPage() {
      window.location.href = 'home.php'; 
   }
</script>

</body>
</html>