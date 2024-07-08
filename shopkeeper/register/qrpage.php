<?php
require_once($_SERVER['DOCUMENT_ROOT']."/DE/phpqrcode/qrlib.php");
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["noo"])){
	$no=$_SESSION["noo"];
	$result=mysqli_query($conn,"SELECT * FROM sregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	
	/*$path='qrcode/';
	$qrcode=$path.time().".png";
	$qrimage=time().".png";
	QRcode ::png("$name",$qrcode,'H',4,4);
			echo "<img src='".$qrcode."'>";*/
	
}
else{
	header("Location:/DE/login/login.php");
}

?>
<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="stylecs.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   
	
<body>

  <div class="container">
    <div class="title">customer Registration</div>
    <div class="content" style="align-items:center;">
	
     <form action="" method="post" enctype="multipart/form-data">
	
        <div class="user-details">
		
		<div class="input-box">
            <span class="details">shop Name</span>
            <center><input type="text" value="<?php echo"{$row['sname']}" ?>" name="name" placeholder="Enter your name" required></center>
          </div>
		  
		  <div class="input-box">
            <span class="details">shop code</span>
            <center><input type="text" value="<?php echo"{$row['no']}" ?>" name="name" placeholder="Enter your name" required></center>
          </div>
          
		 <center><img src="<?php echo"/DE/shopkeeper/register/qrcode/".$row['qrimage'];?>" height="500px" width="500px"id="image" alt="profile"></center>
          
         
        
		          

      </form>
    </div>
  </div>
 

</body>
</html>