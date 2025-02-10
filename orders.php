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
   <title>Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .cancel-btn {
         background-color: red;
         color: white;
         padding: 5px 10px;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         font-size: 18px;
         }

   </style>

</head>
<body>
   
<?php include 'header_2.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed Orders</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <p>Order placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> Name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> Number : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> E-mail : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> Address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> Payment method : <span><?= $fetch_orders['method']; ?></span> </p>
      <p> Your orders : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> Total price : <span>$<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> Payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
      <div class="box">
         <form action="cancel_order.php" method="post">
            <?php $_SESSION['order_id'] = $fetch_orders['id']; ?>
            <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
            <button type="submit" class="cancel-btn" onclick="return confirmCancellation();">Cancel Order</button>
         </form>
      </div>
      
      <script>
      function confirmCancellation() {
         return confirm('Are you sure you want to cancel this order?');
      }
      </script>

   <?php
      }
   }else{
      echo '<p class="empty">no orders placed yet!</p>';
   }
   ?>

   </div>

</section>

<?php include 'footer_2.php'; ?>

<script src="js/script.js"></script>

</body>
</html>