<?php

require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["noo"])){
	$no=$_SESSION["noo"];
	$result=mysqli_query($conn,"SELECT * FROM sregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	$select=mysqli_query($conn,"SELECT * FROM products WHERE shop_id=$no");
	if(isset($_GET['delete'])){
		$id=$_GET['delete'];
		mysqli_query($conn,"DELETE FROM products WHERE id=$id");
		header('location:product.php');
	}
	if(isset($_POST["add_product"])){
		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_details = $_POST['product_details'];
		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp_name = $_FILES['product_image']['tmp_name'];
		$product_image_folder='upload_product/'.$product_image;
		
		if(empty($product_name)||empty($product_price)||empty($product_image)||empty($product_details)){
			$message[]='please fill out all';
		}
		else{
			$insert="INSERT INTO products (shop_id,name,price,photo,details) VALUES('$no','$product_name','$product_price','$product_image','$product_details')";
			$upload=mysqli_query($conn,$insert);
			if($upload){
				move_uploaded_file($product_image_tmp_name,$product_image_folder);
				echo"<script>
				alert('add product');
				</script>";
				header("Refresh:0");
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
	<title>add product</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="pstyle.css">
	
</head>
<body>
<?php
if(isset($message)){
	foreach($message as $message){
		echo'<span class="message">'.$message.'</span>';
	}
}
?>
<div class="container">
	<div class="admin-product-form-container">
		<form action="" method="post" enctype="multipart/form-data">
			<h3>Add New Product</h3>
			<input type="text" placeholder="enter product name" name="product_name" class="box">
			<input type="number" placeholder="enter product price" name="product_price" class="box">
			<input type="file" name="product_image" accept=".jpg,.jpeg,.png" class="box">
			<!--<input type="textarea"  placeholder="enter product details" name="product_details" class="box">-->
			<textarea name="product_details" cols="68" class="box" placeholder="enter product details"></textarea>
			<input type="submit" class="btn" name="add_product" value="add product">
		</form>		
	</div><br>
	
	<div class="admin-product-form-container">
	<form>
	<a href="/DE/shopkeeper/dashboard/dashboard.php" class="btn1" >back to dashboard</a>
	</form></div>
	
	<div class="product-display">
	
		<table class="product-display-table">
		
			<thead>
				<tr>
					<th>Product Image</th>
					<th>Product Name</th>
					<th>Product Price</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>
		
		<?php
		
			while($roow=mysqli_fetch_assoc($select)){
			
		?>
		
				<tr>
					<td><img src="upload_product/<?php echo $roow['photo'];?>" height="100" alt=""></td>
					<td><?php echo $roow['name'];?></td>
					<td><?php echo $roow['price'];?></td>
					<td>
					<a href="pro_update.php?edit=<?php echo $roow['id'];?>" class="btn"><i class="fas fa-edit"></i>edit</a>
					<a href="product.php?delete=<?php echo $roow['id'];?>" class="btn"><i class="fas fa-trash"></i>delete</a>
					</td>
				</tr>
		
		<?php
			}
		?>
		
		</table>
	
	</div>
</div>

</body>
</html>
