<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }else{
         $_SESSION['error'] = 'User not found!';
        header('location:login.php');
        exit;
      }

   }else{
      $_SESSION['error'] = 'Incorrect E-mail or Password!';
        header('location:login.php');
        exit;
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/components.css">

</head>
<body>

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
   
   <section class="form-container">
   <form action="" method="POST" id="loginForm">
      <h3>login</h3>
      <input type="email" name="email" id="emailField" class="box" placeholder="Enter your E-mail" required>
      <input type="password" name="pass" id="passwordField" class="box" placeholder="Enter your Password" required>
      <input type="submit" value="login now" class="btn" name="submit">
      <p>Don't have an account? <a href="register.php">Register Now</a></p>
   </form>
   </section>

   <script>
   document.getElementById('loginForm').addEventListener('submit', function(event) {
      var email = document.getElementById('emailField').value;
      var password = document.getElementById('passwordField').value;
      var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

      if (!email || !password) {
         alert("Both email and password fields are required.");
         event.preventDefault(); // Prevent form submission
         return false;
      }

      if (!email.match(emailPattern)) {
         alert("Please enter a valid email address.");
         event.preventDefault(); // Prevent form submission
         return false;
      }
      return true;
   });
   </script>

   <script>
      <?php if (isset($_SESSION['error'])): ?>
         window.onload = function() {
            var errorMessage = "<?php echo $_SESSION['error']; ?>";
            if (errorMessage) {
                  alert(errorMessage);  
                  <?php unset($_SESSION['error']); ?>
            }
         }
      <?php endif; ?>
   </script>


</body>
</html>