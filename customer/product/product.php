<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
error_reporting(E_ERROR | E_PARSE);
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	$sid =$_GET['edit'];
	$result=mysqli_query($conn,"SELECT * FROM cregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	$shop=mysqli_query($conn,"SELECT sname FROM sregister WHERE no=$sid");
	$shoprow = mysqli_fetch_assoc($shop);
	$shopname=$shoprow['sname'];
	$select=mysqli_query($conn,"SELECT * FROM products WHERE shop_id=$sid");
	$selectt=mysqli_query($conn,"SELECT id FROM products WHERE shop_id=$sid");
	$roowo=mysqli_fetch_assoc($selectt);
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
  <title>shop</title>
  <link rel="stylesheet" href="product.css">
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
		   <li><a href="\DE\Customer\signin\update.php"><i><img src="\DE\Logos\profile.png" title="update" width="40" height="40"></i></a></li>
		   <li><a href="/DE/customer/wishlist/wish.php?wish=<?php echo $sid;?>"><i><img title="whislist" src="\DE\Logos\wish.png"width="40" height="40"></i></a></li>
		   <?php $cart= $_SESSION['cart'];
			$count=0;
			foreach($cart as $key=>$value){
				if($value['shop_id']==$sid){
					//echo $key.":".$value['quantity'].":".$value['shop_id']."<br>";
					$selectcart=mysqli_query($conn,"SELECT * FROM products WHERE id=$key");
					$cartroow=mysqli_fetch_assoc($selectcart);	
					//$count= mysqli_num_rows($selectcart);
					$count++;
					
					
			}
			}
			?>
		    <li><a href="/DE/customer/cart/cart.php?it=<?php echo $sid;?>"><?php echo $count ?><i><img title="cart items" src="\DE\Logos\cart.png"width="40" height="40"></i></a></li>
		   <li><i><a href="\DE\Customer\signin\logout.php"><img src="\DE\Logos\logout.png" title="logout" width="40" height="40"></a></i></li> 
		</ul>
      </div>
	    <div class="main">
		 
	 <div class="main-board">
	  <div class="card-board"><br>
	  
	  <?php
		
			while($roow=mysqli_fetch_assoc($select)){
			
		?>
	  
				<div class="card" style="text-align:center;width: 20rem; height:15rem;">
					  <img src="<?php echo"/DE/shopkeeper/product/upload_product/".$roow['photo'];?>" class="card-img-top" alt="...">
					  <div class="card-body">
						<h5 class="card-title"><?php echo $roow['name']; ?></h5>
						<p class="card-text"><?php echo $roow['price']; ?> RS.</p>
						<a href="/DE/customer/cart/cart.php?edit=<?php echo $roow['id'];?>" class="btn btn-info">add to cart</a>
						<a href="product_detail.php?edit=<?php echo $roow['id'];?>" class="btn btn-secondary">view more</a>
					  </div>
				</div>
				
		<?php
			}
		?>
			</div>
		
	  
	  </div>
	  </body>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</html>