<?php

require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
error_reporting(E_ERROR | E_PARSE);
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	$id =$_GET['edit'];
	$result=mysqli_query($conn,"SELECT * FROM cregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	$shop=mysqli_query($conn,"SELECT no,sname FROM sregister WHERE no=$id");
	$shoprow = mysqli_fetch_assoc($shop);
	$shopno=$shoprow['no'];
	$shopname=$shoprow['sname'];
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
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3YwScVb3ZcuHtOA93W35dYTsvhLPVnYs9eStHfGJv0vKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <title>shop</title>
  <link rel="stylesheet" href="styleopen.css">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script>
     $(document).ready(function(){
	    $('.showprompt').click(function(){
		   $('.pop_box').css({
		      "opacity":"1","pointer-events":"auto"
		   });
		});
		$('.btn1').click(function(){
		   $('.pop_box').css({
		        "opacity":"0","pointer-events":"auto" 
				
		   });
	    });
		
		$('.btn2').click(function(){
		   $('.pop_box').css({
		        "location.href":"D:\D2D\sem-4\DE\protocol\Shopkeeper\dashboard\index.html"
		   });
	    });
		
		$('.btn3').click(function(){
		   $('.pop_box').css({
		          "opacity":"0","pointer-events":"auto" 
		   });
	    });
	 });
  </script>
</head>
<body>
   <div class="wrapper">
      <div class="sidebar">
        <ul>
		   <li><a href="\DE\Customer\dashboard\dash.php"><i><img src="\DE\Logos\first.png" title="dashboard" width="40" height="40"></a></i></li>
		   <li class="active"><i><img src="\DE\Logos\in_shop.jpg" title="shop" width="40" height="40"></i></li>
		   <li><a href="\DE\Customer\signin\update.php"><i><img src="\DE\Logos\profile.png" title="profile" width="40" height="40"></i></a></li>
		   
		   <li><a href="/DE/customer/wishlist/wish.php?wish=<?php echo $shopno;?>"><i><img src="\DE\Logos\wish.png" title="wishlist" width="40" height="40"></i></a></li>
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
			<li><a href="/DE/customer/cart/cart.php?it=<?php echo $id;?>"><?php echo $count ?><i><img title="cart items" src="\DE\Logos\cart.png"width="40" height="40"></i></a></li>
			<li><a href="/DE/customer/open_shop/shopinfo.php?it=<?php echo $id;?>"><i><img title="cart items" src="\DE\Logos\info.png"width="40" height="40"></i></a></li>
		    <li><i><a href="\DE\Customer\signin\logout.php"><img src="\DE\Logos\logout.png" title="logout" width="40" height="40"></a></i></li> 
		</ul>
      </div>
	    <div class="main">
		 <div class="head">
		  <div class="head-title">
		    <h2 style="color:white;">Shop Name:<?php echo $shopname;?></h2>
			<span>user name: <?php echo $row["fname"];?></span>
		  </div>
		   
	 </div>
	 <div class="main-board">
	  <div class="card-board"><br><br>
	    <div class="card"><a href="/DE/customer/product/product.php?edit=<?php echo $shopno;?>" style="text-decoration: none;">
		    <div class="card-icon">
			   <i><img src="\DE\Logos\cproduct.png"width="60" height="50"></i>
			   <!-- <i><img src="https://cdn2.iconfinder.com/data/icons/neutro-essential/32/more-vertical-512.png"width="40" height="40"></i>-->
			</div>
			<span></span>
			<h5>product</h5></a>
		</div>
		 <div class="card"><a href="/DE/customer/feedback/feedback.php?edit=<?php echo $shopno;?>" style="text-decoration: none;">
		    <div class="card-icon">
			   <i><img src="\DE\Logos\cfeedback.jpg"width="40" height="40"></i>
			     <!-- <i><img src="https://cdn2.iconfinder.com/data/icons/neutro-essential/32/more-vertical-512.png"width="40" height="40"></i>-->
			</div>
			<span></span>
			<h5>Feedback</h5></a>
		</div>
		 <div class="card"><a href="/DE/customer/rating/rating.php?edit=<?php echo $shopno;?>" style="text-decoration: none;">
		    <div class="card-icon">
			   <i><img src="\DE\Logos\crating.jpg"width="60" height="40"></i>
			     <!--<i><img src="https://cdn2.iconfinder.com/data/icons/neutro-essential/32/more-vertical-512.png"width="40" height="40"></i>-->
			</div>
			<span></span>
			<h5>Rating</h5>
		</div>
		<div class="card"><a href="/DE/customer/account/account.php?edit=<?php echo $shopno;?>" style="text-decoration: none;">
		    <div class="card-icon">
			   <i><img src="\DE\Logos\bill.png"width="40" height="40" text-align:center;></i>
			     <!-- <i><img src="https://cdn2.iconfinder.com/data/icons/neutro-essential/32/more-vertical-512.png"width="40" height="40"></i>-->
			</div>
			<span></span>
			<h5>Orders</h5></a>
		</div>
	  </div>
	  </body>
	
</html>