<?php
session_start();
include 'config.php';

if(isset($_POST['order_id']) && isset($_SESSION['user_id'])) {
    $order_id = $_POST['order_id']; 
    $user_id = $_SESSION['user_id']; 

    //echo $order_id . ' ' . $user_id;

    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE `id` = ? AND `user_id` = ?");
    $delete_order->execute([$order_id, $user_id]);

    if($delete_order->rowCount() > 0){
        echo "<script>alert('Order cancelled successfully.'); window.location.href='orders.php';</script>";
    } else {
        echo "<script>alert('Error cancelling order.'); window.location.href='orders.php';</script>";
    }
} else {
    header('location:home.php');
}
?>
