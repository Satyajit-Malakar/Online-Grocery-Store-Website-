
<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
</head>
<body>
<?php


$DataBase="";
$image=$Upload=" ";
$Img_Err = " ";

//-----------------------------Image Upload-------------------------------
if (isset($_POST['create'])) 
  {

    $specific_id = $_POST["id"];
    $stringValue = $_POST["id2"];

    $permited  = array('jpg', 'jpeg', 'png');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $intValue = intval($stringValue);
    //$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $unique_image = $intValue.'.'.$file_ext;
    $uploaded_image = "uploaded_img/".$unique_image;

    if (empty($file_name)) 
    {
      $Img_Err = "Please Select an Image !";
    }
    elseif ($file_size > 1048576) 
    {
      $Img_Err = "Image Size should be less then 1MB!";
    } 
    elseif (in_array($file_ext, $permited) === false) 
    {
      $Img_Err = "You can upload only:-".implode(', ', $permited) ;
    } 
    else
    {
      // move_uploaded_file($file_temp, $uploaded_image);
    }
  } 
//------------------------Database-----------------------------------------------
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "shop_db";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) 
	{
	    die("Connection failed: " . $conn->connect_error);
	}

//----------------------------Data Insert------------------------
if(isset(($_POST['create'])))
{
    $sql2 = "UPDATE products SET image = '$unique_image' WHERE id = $specific_id";
    if ($conn->query($sql2) === TRUE) 
    {
      move_uploaded_file($file_temp, $uploaded_image);
    } 
    else 
    {
      $DataBase= "Error: " . $sql2 . "<br>" . $conn->error;
    }
    $conn->close();
  }
?>

<!-- ================================================================================================================== -->
  <div style="display: flex; justify-content: center; align-items: center; height: 100vh; font-family: Arial, sans-serif;">
    <div style="box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); border-radius: 10px; padding: 20px; width: 90%; max-width: 500px;">
      <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
        
        <h2 style="text-align: center; color: #333;">Product Image Upload</h2>
        
        <label style="display: block; margin-top: 20px;">Enter Product ID:</label>
        <input type="text" name="id" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required>
        
        <label style="display: block; margin-top: 20px;">Enter Image Name:</label>
        <input type="text" name="id2" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required>
        
        <label style="display: block; margin-top: 20px;">Select Image to Upload:</label>
        <input type="file" name="image" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required>
        <!-- <span style="color: red;"><?php echo $Img_Err; ?></span> -->
        
        <div style="text-align: center; margin-top: 30px;">
          <input type="submit" name="create" value="Upload Image" style="cursor: pointer; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px;">
          <input type="reset" value="Reset" style="cursor: pointer; padding: 10px 20px; background-color: #f44336; color: white; border: none; border-radius: 5px;">
        </div>
        
        <div style="text-align: center; margin-top: 20px;">
          <input type="button" value="Logout" onclick="location.href='logout.php';" style="cursor: pointer; padding: 10px 20px; background-color: #555; color: white; border: none; border-radius: 5px;">
        </div>
        
        <?php if (!empty($DataBase)) : ?>
        <div style="color: green; text-align: center; margin-top: 20px;">
          <?php echo $DataBase; ?>
        </div>
        <?php endif; ?>
        
      </form>
    </div>
  </div>
</body>
</html>

<?php
// Check if the logout button has been clicked
if(isset($_POST['logout'])) {
    header("Location: logout.php");
}
?>