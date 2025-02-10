
<!DOCTYPE html>
<html>
<head>
  <title>Image Upload</title>
 
</head>
<body>
<?php



$DataBase="";

$image=$Upload=" ";



$Img_Err = " ";

//-----------------------------Image Upload-------------------------------
if (isset($_POST['create'])) 
  {
    $permited  = array('jpg', 'jpeg', 'png');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));

    //$f=int(095273);
    //$number = 095273;
    $stringValue = "095273";
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
//-----------------------------------------------------------------------




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
    $specific_id = 32; 

//----------------------------Data Insert (User)------------------------
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

<!-- Regisration.php -->
  <div align="center">
    <?php
      if (empty($DataBase)) 
      {
        # code...
      }
      else
        echo '<script type="text/javascript">window.location.href="ID.php";</script>';
       // include 'ID.php';
     ?>
    <div align="center"  class="ex1">
          <div  class="pad_All">
          <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
            
            
            <fieldset align="left" class="width750_height780_Dvr_Rep">
              
              <legend align="center" class="color_blue"><b>Image Upload</b></legend>
                

                  

                <div class="float_right_width200">
                  <div class="pad5px">
                      <svg width="8em" height="8em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor"   xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                      </svg>
                  </div>
                  <div class="pad5px">
                      <input type="file" value="<!-- <?php $file_name ?> -->" name="image" > 
                  </div>
                  <div>
                    <?php echo $Img_Err; ?>
                  </div>
                </div>

                
                </fieldset>
                

            </fieldset>
            <div class="pad_top20">
              <input type="submit" name="create">
              <input type="reset" value="Reset">
            </div>

             <div class="pad_top20">
              <?php echo $DataBase; ?>
            </div>
            </fieldset>
          </form>
        </div>  
    </div>
  </div>




</body>
</html>

