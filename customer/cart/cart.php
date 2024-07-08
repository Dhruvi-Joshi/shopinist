<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
error_reporting(E_ERROR | E_PARSE);
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	if(isset($_GET['edit'])){
	$id=$_GET['edit'];
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
	if(isset($_POST['cart']))
	{
		$quantity=$_POST['quantity'];
		
	}
	else{
		$quantity=1;
	}
	//echo $quantity;
	$_SESSION['cart'][$id]=array('quantity' =>$quantity,'shop_id'=>$sid);
	
	/*echo'<pre>';
	print_r($_SESSION['cart']);
	echo '</pre>';*/
	$cart=$_SESSION['cart'];
	}
	else{
			$sid=$_GET['it'];
			$cart=$_SESSION['cart'];
			$shop=mysqli_query($conn,"SELECT sname,no,addr,mno FROM sregister WHERE no=$sid");
	$shoprow = mysqli_fetch_assoc($shop);
	$shopno=$shoprow['no'];
	$shopname=$shoprow['sname'];
	$shopadd=$shoprow['addr'];
	$shopmno=$shoprow['mno'];
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
  <title>cart items</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> 
  <link rel="stylesheet" href="cart.css">
  
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  
</head>
<body>
<form>
   <div class="wrapper">
      <div class="sidebar">
        <ul>
		   <li><a href="\DE\Customer\dashboard\dash.php"><i><img src="\DE\Logos\first.png" title="dashboard" width="40" height="40"></a></i></li>
		   <li><a href="/DE/customer/open_shop/shop.php?edit=<?php echo $sid;?>"><i><img src="\DE\Logos\in_shop.jpg" title="shop" width="40" height="40"></i></a></li>
		   <li><a href="\DE\Customer\signin\update.php"><i><img src="\DE\Logos\profile.png" title="profile" width="40" height="40"></i></a></li>
		   <li><a href="/DE/customer/wishlist/wish.php?wish=<?php echo $sid;?>"><i><img title="wishlist" src="\DE\Logos\wish.png"width="40" height="40"></i></a></li>
		    <li class="active"><i><img src="\DE\Logos\cart.png" title="cart items" width="40" height="40"></i></li>
		   <li><a href="\DE\Customer\signin\logout.php"><i><img src="\DE\Logos\logout.png" title="logout" width="40" height="40"></i></a></li> 
		</ul>
      </div>
	    <div class="main">
		 <div class="head">
		 
	 </div>
	 
	  
	   <div class="head">
		  <div class="head-title">
		    <h2 style="color:white;">Cart Items</h2>
			
	 </div>
	 
	 </div>
	 
	<div class="balance">
	  <div class="balance-details">
	   
	  
	
		<table class="table">
		
			<thead>
				<tr style="text-align:center;">
					<th>shop id</th>
					<th>Image</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>total peice</th>
					<th>Action</th>
				</tr>
			</thead>
		
		<?php
			$total=0;
			foreach($cart as $key=>$value){
				if($value['shop_id']==$sid){
					//echo $key.":".$value['quantity'].":".$value['shop_id']."<br>";
					$selectcart=mysqli_query($conn,"SELECT * FROM products WHERE id=$key");
					$cartroow=mysqli_fetch_assoc($selectcart);	
				
		?>
		
				<tr style="text-align:center;">
					<td><?php echo $sid;?></td>
					<td><img height="100px" width="100px" src="<?php echo "/DE/shopkeeper/product/upload_product/".$cartroow['photo'];?>" class="card-img-top" alt="..."></td>
					<td><a href="/DE/customer/product/product_detail.php?edit=<?php echo $key;?>"><?php echo $cartroow['name'];?></a></td>
					<td><?php echo $cartroow['price'];?></td>
					<td><?php echo $value['quantity'];?></td>
					<td><?php echo $value['quantity']*$cartroow['price'];?></td>
					<td><a href="/DE/customer/cart/deletecart.php?id=<?php echo $key;?>" class="btn btn-danger"><i class="fas fa-trash"></i> remove</a></td>
					<!--<div class="model-box">
						<form method="post" action="#">
						  <h2>Enter Your replay:</h2>
						  <input type="text" name="code"style="text-align:center;"placeholder="REPLAY....">
						  <div class="buttons">
							<button class="close-btn">cancle</button>
							<input type="submit" class="btn1" name="add">
							
						   </div></form>
					</div>-->
					
				</tr>
		
		<?php
		
		$total = $total + ($value['quantity']*$cartroow['price']);
				}
			
			}
		?>
		
		</table>
  
	</div>	 
   </div><br>
   
   
   <div class="balance">
	  <div class="balance-details">
		<div class="text-left">
			<a href="/DE/customer/checkout/checkout.php?edit=<?php echo $shopno;?>" class="btn btn-info" style="background:linear-gradient(135deg, #71b7e6, #9b59b6);color:black;">checkout</a>
			<br><br>
			<a href="/DE/customer/product/product.php?edit=<?php echo $shopno;?>" class="btn btn-info" style="background:linear-gradient(135deg, #71b7e6, #9b59b6);color:black;">more shopping</a>
		</div>
		<div class="card" style="background:linear-gradient(135deg, #71b7e6, #9b59b6);">
			<div class="card-header" style="color:white;">Total Amount:
				<b><?php echo $total ?></b> RS.
			</div>
		</div>
	</div>
	</div><br>
</div>
</form>

   </body>
   </html>
