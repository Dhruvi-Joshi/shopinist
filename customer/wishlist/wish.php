<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
error_reporting(E_ERROR | E_PARSE);
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	$id =$_GET['wish'];
	$result=mysqli_query($conn,"SELECT * FROM cregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	$shop=mysqli_query($conn,"SELECT * FROM sregister WHERE no=$id");
	$shoprow = mysqli_fetch_assoc($shop);
	$wish=mysqli_query($conn,"SELECT product_id,no FROM wishlist WHERE customer_id=$no && shop_id=$id");
	
	if(isset($_GET['delete'])){
		$wishdelete=$_GET['delete'];
		
		mysqli_query($conn,"DELETE FROM wishlist WHERE no=$wishdelete");
		header("Location: /DE/customer/wishlist/wish.php?wish=" . urlencode($id));
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3YwScVb3ZcuHtOA93W35dYTsvhLPVnYs9eStHfGJv0vKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <title>Wishlist</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> 
  <link rel="stylesheet" href="wish.css">
  
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  
</head>
<body>
<form>
   <div class="wrapper">
      <<div class="sidebar">
	  
        <ul>
		   <li><a href="\DE\Customer\dashboard\dash.php"><i><img src="\DE\Logos\first.png" title="dashboard" width="40" height="40"></a></i></li>
		   <li><a href="/DE/customer/open_shop/shop.php?edit=<?php echo $id;?>"><i><img src="\DE\Logos\in_shop.jpg" title="shop" width="40" height="40"></i></a></li>
		   <li><a href="\DE\Customer\signin\update.php"><i><img src="\DE\Logos\profile.png" title="profile" width="40" height="40"></i></a></li>
		   <li class="active"><i><img src="https://cdn3.iconfinder.com/data/icons/sales-and-delivery-1/128/favourite_item-256.png" title="wishlist" width="40" height="40"></i></li>
		   <?php $cart= $_SESSION['cart'];
			$count=0;
			foreach($cart as $key=>$value){
				if($value['shop_id']==$id){
					//echo $key.":".$value['quantity'].":".$value['shop_id']."<br>";
					$selectcart=mysqli_query($conn,"SELECT * FROM products WHERE id=$key");
					$cartroow=mysqli_fetch_assoc($selectcart);	
					//$count= mysqli_num_rows($selectcart);
					$count++;
					
					
			}
			}
			?>
		    <li><a href="/DE/customer/cart/cart.php?it=<?php echo $id;?>"><?php echo $count ?><i><img title="cart items" src="https://www.pngplay.com/wp-content/uploads/1/Online-Shopping-Cart-PNG-Background-Image.png"width="40" height="40"></i></a></li>
		   <li><i><a href="\DE\Customer\signin\logout.php"><img src="\DE\Logos\logout.png" title="logout" width="40" height="40"></a></i></li> 
		</ul>
      </div>
	    <div class="main">
		 <div class="head">
		 
	 </div>
	 
	  
	   <div class="head">
		  <div class="head-title">
		    <h2 style="color:white;">your wishlist</h2>
			
	 </div>
	 
	 </div>
	 
	<div class="balance">
	  <div class="balance-details">
	   
	  
	
		<table class="table">
		
			<thead>
				<tr>
					<th>photo</th>
					<th>name</th>
					<th>price</th>
					<th>action</th>
					<!--<th>Action</th>-->
				</tr>
			</thead>
		
		<?php
		
			while($wishrow = mysqli_fetch_assoc($wish)){
				$proid=$wishrow['product_id'];
				$wishid=$wishrow['no'];
				$product=mysqli_query($conn,"SELECT * FROM products WHERE id=$proid");
				$productrow = mysqli_fetch_assoc($product);
				
			
		?>
		
				<tr>
					<td><img height="100px" width="100px" src="<?php echo"/DE/shopkeeper/product/upload_product/".$productrow['photo'];?>" class="card-img-top" alt="..."></td>
					<td><a href="/DE/customer/product/product_detail.php?edit=<?php echo $proid;?>"><?php echo $productrow['name'];?></a></td>
					<td><?php echo $productrow['price'];?></td>
					<td><a href="wish.php?delete=<?php echo $wishid;?>&wish=<?php echo $id;?>" class="btn"><i class="fas fa-trash"></i>delete</a></td>
					
					
				</tr>
		
		<?php
			}
		?>
		
		</table>
		

  
	</div>	 
   </div>
</div>
</form>

<script>

	const balance=document.querySelector(".table"),
	showbtn = document.querySelector(".show-model"),
	closebn=document.querySelector(".close-btn");
	
	showbtn.addEventListener("click",() => balance.classList.add("active"));
	
</script>
   </body>
   </html>
   
   
