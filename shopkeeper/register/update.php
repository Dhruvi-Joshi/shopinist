<?php

require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["noo"])){
	$no=$_SESSION["noo"];
	$result=mysqli_query($conn,"SELECT * FROM sregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	if(isset($_POST['update']))
	{
		$changename=$_POST['name'];
		$changemail=$_POST['email'];
		$changephone=$_POST['phone'];
		$changesmail=$_POST['smail'];
		$changeshopdesc=$_POST['shopdesc'];
		$changeaddress=$_POST['address'];
		$changeaccname=$_POST['accname'];
		$changeaccno=$_POST['accno'];
		$changeonline=$_POST['online'];
		
		$sql="UPDATE sregister SET name='$changename',mail='$changemail',mno='$changephone',smail='$changesmail',sdescr='$changeshopdesc',addr='$changeaddress',aname='$changeaccname',ano='$changeaccno',online='$changeonline' WHERE no='$no'";
		$result2=mysqli_query($conn,$sql);
		if($result2)
		{
			echo "update success";
			header("Location:/DE/shopkeeper/dashboard/dashboard.php");
		}
	}
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
   
	 <style media="screen">
		.upload{
			width:140px;
			position:relative;
			margin:auto;
			text-align:center;
		}
		.upload img{
			border-radius:50%;
			border:8px solid #DCDCDC;
			width:125px;
			height:125px;
		}
		.upload .rightround{
			position:absolute;
			bottom:0;
			right:0;
			background:#00B4FF;
			width:32px;
			height:32px;
			line-height:32px;
			text-align:center;
			border-radius:50%;
			overflow:hidden;
			cursor:pointer;
		}
		
		.upload .leftround{
			position:absolute;
			bottom:0;
			left:0;
			background:red;
			width:32px;
			height:32px;
			line-height:32px;
			text-align:center;
			border-radius:50%;
			overflow:hidden;
			cursor:pointer;
		}
		
		.upload .fa{
			color:white;
		}
		.upload input{
			position:absolute;
			transform:scale(2);
			opacity:0;
		}
		.upload input::-webkit-file-upload-button, .upload input[type=submit]{
			cursor:pointer;
		}
	 </style>
<body>

  <div class="container">
    <div class="title">UPDATE SHOP DETAILS</div>
    <div class="content">
	
     <form action="" method="post" enctype="multipart/form-data">
	 <div class="upload">
	 <img src="<?php echo "/DE/shopkeeper/register/upload/".$row['sphoto'];?>" id="image" alt="photo">
	    <div class="rightround" id="upload">
			<input type="file" name="fileimage" id="fileimage" accept=".jpg,.jpeg,.png">
			<i class="fa fa-camera"></i>
		</div>
		
		<div class="leftround" id="cancle" style="display:none;">
			<i class="fa fa-times"></i>
		</div>
		
		<div class="rightround" id="confirm" style="display:none;">
			<input type="submit" name="submit" id="submit" value="ok">
			<i class="fa fa-check"></i>
		</div>
		</div>	
        <div class="user-details">
		
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" value="<?php echo"{$row['name']}" ?>" name="name" placeholder="Enter your name" required>
          </div>
          
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" value="<?php echo"{$row['mail']}" ?>" name="email" placeholder="Enter your email" required >
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="number" value="<?php echo"{$row['mno']}" ?>" name="phone" placeholder="Enter your number"  required>
          </div>
		  
		 <div class="input-box">
            <span class="details">Shop Email</span>
            <input type="text" value="<?php echo"{$row['smail']}" ?>" name="smail" placeholder="Enter your shop email"  required>
          </div>
		  
		  <div class="input-box">
            <span class="details">Shop Description</span>
            <input type="text" value="<?php echo"{$row['sdescr']}" ?>" name="shopdesc" placeholder="change shop desciption"  required>
          </div>
         
		  <div class="input-box">
            <span class="details">Address</span>
            <input cols="15" value="<?php echo"{$row['addr']}" ?>" rows="50"type="textarea" placeholder="address" name="address"  required>
          </div>
		  
		  <div class="input-box">
            <span class="details">Account Name</span>
            <input value="<?php echo"{$row['aname']}" ?>" type="text" placeholder="account name" name="accname"  required>
          </div>
		  
		  <div class="input-box">
            <span class="details">Account Number</span>
            <input value="<?php echo"{$row['ano']}" ?>" type="number" placeholder="account number" name="accno"  required>
          </div>
		  
		  <div class="input-box">
            <span class="details">Online payment details</span>
            <input value="<?php echo"{$row['online']}" ?>" type="text" placeholder="paytm user name" name="online"  required>
          </div>
        </div>
        
		          
       <div class="button" >
          <input type="submit" value="UPDATE" name="update">
        </div>
      </form>
    </div>
  </div>
  <script type="text/javascript">
		document.getElementById("fileimage").onchange=function(){
			document.getElementById("image").src=URL.createObjectURL(fileimage.files[0]);
			
			document.getElementById("cancle").style.display="block";
			document.getElementById("confirm").style.display="block";
			
			document.getElementById("upload").style.display="none";
		}
		var userimg =document.getElementById('image').src;
		document.getElementById("cancle").onclick=function(){
			document.getElementById("image").src=userimg;
			
			document.getElementById("cancle").style.display="none";
			document.getElementById("confirm").style.display="none";
			
			document.getElementById("upload").style.display="block";
		}
		document.getElementById("confirm").onclick=function(){
			
			
			document.getElementById("cancle").style.display="none";
			document.getElementById("confirm").style.display="none";
			
			document.getElementById("upload").style.display="block";
		}
  </script>
  
  <?php
  if (isset($_POST['submit'])) {
	if(isset($_FILES["fileimage"]["name"])){
		$no=$_SESSION["noo"];
		$src=$_FILES["fileimage"]["tmp_name"];
		$imagename=uniqid().$_FILES["fileimage"]["name"];
		$target="./upload/".$imagename;
		move_uploaded_file($src,$target);
		$query="UPDATE sregister SET sphoto='$imagename' WHERE no=$no";
		if(mysqli_query($conn,$query))
		{
			
			echo"<script>
			alert('update photo');
		</script>";
	
		}
		else{
			echo"<script>
			alert('try again');
		</script>";
		}
		
	}
  }
  ?>
<!--<script> formaction="D:\D2D\sem-4\DE\protocol\Customer\daskboard(customer)\dashboard.html"
function myOnClickFn(){
document.location.href="D:\D2D\sem-4\DE\protocol\Shopkeeper\dashboard\index.html"
</script>-->
</body>
</html>