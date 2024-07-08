<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	$id =$_GET['edit'];
	$result=mysqli_query($conn,"SELECT * FROM cregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	$select=mysqli_query($conn,"SELECT * FROM products WHERE id=$id");
	$roow=mysqli_fetch_assoc($select);	
	$sid=$roow['shop_id'];
	$shop=mysqli_query($conn,"SELECT sname,no,addr,mno FROM sregister WHERE no=$sid");
	$shoprow = mysqli_fetch_assoc($shop);
	$shopno=$shoprow['no'];
	$shopname=$shoprow['sname'];
	$shopadd=$shoprow['addr'];
	$shopmno=$shoprow['mno'];
	
	
	
	if(isset($_POST["wish"])){
	$duplicate=mysqli_query($conn,"SELECT * FROM wishlist WHERE customer_id ='$no' && product_id='$id'");
	if(mysqli_num_rows($duplicate) > 0){
		echo"<script>
			alert('use already add as a wishlist');
		</script>";
	}
	else{
			$insert="INSERT INTO wishlist (customer_id,product_id,shop_id) VALUES('$no','$id','$sid')";
			$upload=mysqli_query($conn,$insert);
			if($upload){
				echo"<script>
				alert('select successfully');
				</script>";
				
			}
			else{
				echo"<script>
				alert('not select');
				</script>";
			}
	}
	}
}
	
	else{
	header("Location:/DE/login/login.php");
}
?>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width==device-width,initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3YwScVb3ZcuHtOA93W35dYTsvhLPVnYs9eStHfGJv0vKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <title>product detail</title>
  <link rel="stylesheet" href="product.css">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>
<body>


<div class="container">
<br><br>
<h2>product details</h2>
<br><br>



		
<div class="row">
	<div class="col-md-5">
		<img src="<?php echo"/DE/shopkeeper/product/upload_product/".$roow['photo'];?>" style="width:100%;">
	</div>
	<div class="col-md-7">
	<form action="/DE/customer/cart/cart.php?edit=<?php echo $roow['id'];?>" method="post">
		<center><h2 style="color:white;font-size:50px;"><?php echo $roow['name']; ?></h2></center>
		<p class="card-text" style="font-size:25px;">Product Price: <b><?php echo $roow['price']; ?> RS.</b></p>
		<p class="card-text" style="font-size:20px;">product Details: <b><?php echo'<pre>'.$roow['details'].'</pre>'; ?></b></p>
		<p class="card-text" style="font-size:20px;">product quantity:  <input type="number" name="quantity" min="1" max="5" value="1"></p>
		<br>
		<a href="/DE/customer/product/product.php?edit=<?php echo $shopno;?>" class="btn btn-secondary">Go Back</a>
		<!--<input type="hidden" name="pid" value="?php echo $roow['id']; ?>"> 
		<input type="hidden" name="sid" value="?php echo $sid; ?>"> 
		<input type="hidden" name="pname" value="?php echo $roow['name']; ?>"> 
		<input type="hidden" name="pprice" value="?php echo $roow['price']; ?>"> -->
		<input type="submit" value="add to cart" name="cart" class="btn btn-info">
		
		</form><br>
		<form method="post"><button name="wish" class="btn btn-info">add to wishlist</button></form>
		<hr style="height:2px;border-width:0;color:white;background-color:white">
		<h3><center>shop details</h3>
		<p class="card-text" style="font-size:20px;">Shop Name: <b><?php echo $shopname; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop Address: <b><?php echo $shopadd; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop phone no: <b><?php echo $shopmno; ?></b></p>
		
	</div>
</div>


</div>
  
<!--<div class="col-md-7">
		<center><h2 style="color:white;font-size:50px;">?php echo $roow['name']; ?></h2></center>
		<p class="card-text" style="font-size:25px;">Product Price: <b>?php echo $roow['price']; ?> RS.</b></p>
		<p class="card-text" style="font-size:20px;">product Details: <b>?php echo'<pre>'.$roow['details'].'</pre>'; ?></b></p>
		<p class="card-text" style="font-size:20px;">product quantity:  <input type="number" name="quantity" min="1" max="5" value="1"></p>
		<br>
		<a href="/DE/customer/product/product.php?edit=?php echo $shopno;?>" class="btn btn-secondary">Go Back</a>
		<a href="/DE/customer/cart/cart.php?edit=?php echo $roow['id'];?>" class="btn btn-info">add to cart</a>
		<hr style="height:2px;border-width:0;color:white;background-color:white">
		<h3><center>shop details</h3>
		<p class="card-text" style="font-size:20px;">Shop Name: <b>?php echo $shopname; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop Address: <b>?php echo $shopadd; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop phone no: <b>?php echo $shopmno; ?></b></p>
		
	</div>
	
	-->
</body>
</html>
