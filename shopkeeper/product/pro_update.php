<?php

require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["noo"])){
	$no=$_SESSION["noo"];
	$result=mysqli_query($conn,"SELECT * FROM sregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	
	$id =$_GET['edit'];
	$select=mysqli_query($conn,"SELECT * FROM products WHERE id=$id");
	if(isset($_POST["update_product"])){
		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_details = $_POST['product_details'];
		
		
		if(empty($product_name)||empty($product_price)||empty($product_details)){
			$message[]='please fill out all';
		}
		else{
			$update="UPDATE  products SET name='$product_name',price='$product_price',details='$product_details' WHERE id= $id";
			$upload=mysqli_query($conn,$update);
			if($upload){
				header("Location:/DE/shopkeeper/product/product.php");
		
			}
			else{
				$message[]='could not add the product';
			}
		}
	}
}
else{
	header("Location:/DE/login/login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>update product</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="pstyle.css">
	
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

<?php
if(isset($message)){
	foreach($message as $message){
		echo'<span class="message">'.$message.'</span>';
	}
}
?>

<div class="container">
	<div class="admin-product-form-container centered">
	
	
	<?php

		while($roow=mysqli_fetch_assoc($select)){
			
	?>
	
		<form action="" method="post" enctype="multipart/form-data">
		<h3>update Product</h3>
				<div class="upload">
				<img src="<?php echo"/DE/shopkeeper/product/upload_product/".$roow['photo'];?>" id="image" alt="photo">
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
			
			<input type="text" placeholder="enter product name" value="<?php echo"{$roow['name']}" ?>" name="product_name" class="box">
			<input type="number" placeholder="enter product price" value="<?php echo"{$roow['price']}" ?>" name="product_price" class="box">
			<input type="text" placeholder="enter product details" value="<?php echo"{$roow['details']}"?>" name="product_details" class="box">
			<input type="submit" class="btn" name="update_product" value="update product">
			<a href="product.php" class="btn" >back</a>
		
					
		</form>	

			<?php
			}
		?>
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
		$target="./upload_product/".$imagename;
		move_uploaded_file($src,$target);
		$query="UPDATE products SET photo='$imagename' WHERE id=$id";
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
</body>
</html>
