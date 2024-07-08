<?php
require_once($_SERVER['DOCUMENT_ROOT']."/DE/phpqrcode/qrlib.php");
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["noo"])){
	$no=$_SESSION["noo"];
	$result=mysqli_query($conn,"SELECT * FROM sregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	$product=mysqli_query($conn,"SELECT * FROM products WHERE shop_id=$no");
	$feedback=mysqli_query($conn,"SELECT * FROM feedback WHERE shop_id=$no");
	$customer=mysqli_query($conn,"SELECT * FROM follow WHERE shop_id=$no");
	$ratingselect = "SELECT * FROM rating WHERE shop_id=$no";
  $ratingrow = mysqli_query($conn, $ratingselect);

  // Calculate average rating
  $ratingCount = mysqli_num_rows($ratingrow);
  $totalRating = 0;
  while ($rating = mysqli_fetch_assoc($ratingrow)) {
    $totalRating += $rating['rating'];
  }
  $averageRating = $ratingCount > 0 ? round($totalRating / $ratingCount) : 0;
	$orders=mysqli_query($conn,"SELECT * FROM checkout WHERE shopid=$no");
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
<html>
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width==device-width,initial-scale=1.0">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3YwScVb3ZcuHtOA93W35dYTsvhLPVnYs9eStHfGJv0vKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <title>shopkepeer Dashboard</title>
  <link rel="stylesheet" href="style(dashboard).css">
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
<form>
   <div class="wrapper">
      <div class="sidebar">
        <ul>
		   
		   <li class="active"><i><img src="\DE\Logos\first.png" title="dashboard" width="40" height="40"></i></li>
		   <li><i><a href="/DE/shopkeeper/register/update.php"><img src="\DE\Logos\profile.png" title="profile" width="40" height="40"></i></a></li>
		   <!--<li><i><img src="\DE\Logos\shop.png"width="40" height="40"></i></li>-->
		   <li><i><a href="/DE/shopkeeper/register/qrpage.php"><img src="\DE\Logos\share.png" title="QR page" width="40" height="40"></i></a></li>
		   
		   <li><i><a href="/DE/shopkeeper/register/logout.php"><img src="\DE\Logos\logout.png" title="logout" width="40" height="40"></a></i></li> 
		</ul>
      </div>
	    <div class="main">
		 <div class="head">
		  <div class="head-title">
		  <h2 style="color:white;"><?php echo $row["name"];?></h2>
			
		
		    <h2 style="color:white;">Dashboard</h2>
			<span></span>
		  </div>
		   
	 </div>
	 <div class="main-board">
	  <div class="card-board">
	  
	   <?php
		 $countproduct=mysqli_num_rows($product);
	  ?>
	  
	    <div class="card"><a href="/DE/shopkeeper/product/product.php" style="text-decoration: none;">
		    <div class="card-icon">
			   <i><img src="\DE\Logos\product.png"width="40" height="40"></i>
			    <i><img src="https://cdn2.iconfinder.com/data/icons/neutro-essential/32/more-vertical-512.png"width="40" height="40"></i>
			</div>
			<span>product details</span>
			<h5><?php echo $countproduct;?> products</h5></a>
		</div>
		
		
		 <div class="card"><a href="/DE/shopkeeper/rating/showrating.php" style="text-decoration: none;">
		    <div class="card-icon">
			   <i><img src="\DE\Logos\rating.jpg" width="40" height="40"></i>
			      <i><img src="https://cdn2.iconfinder.com/data/icons/neutro-essential/32/more-vertical-512.png"width="40" height="40"></i>
			</div>
			<span>Rating</span>
			<h5>avg: <?php echo $averageRating;?></h5></a>
		</div>
		
		<?php
		 $countcustomer=mysqli_num_rows($customer);
	  ?>
		
		 <div class="card"><a href="/DE/shopkeeper/customer/onlinecustomer.php" style="text-decoration: none;">
		    <div class="card-icon">
			   <i><img src="\DE\Logos\customer.png"width="40" height="40"></i>
			     <i><img src="https://cdn2.iconfinder.com/data/icons/neutro-essential/32/more-vertical-512.png"width="40" height="40"></i>
			</div>
			<span>online customer</span>
			<h5><?php echo $countcustomer;?> customer</h5></a>
		</div>
		
		<?php
		 $countfeedback=mysqli_num_rows($feedback);
	  ?>
		<div class="card"><a href="/DE/shopkeeper/feedback/show_feedback.php" style="text-decoration: none;">
		    <div class="card-icon">
			   <i><img src="\DE\Logos\feedback.png"width="40" height="40"></i>
			      <i><img src="https://cdn2.iconfinder.com/data/icons/neutro-essential/32/more-vertical-512.png"width="40" height="40"></i>
			</div>
			<span>feedbacks details</span>
			<h5><?php echo $countfeedback;?> feedbacks</h5></a>
		</div>
		
		
		<div class="card"><a href="/DE/shopkeeper/orders/orders.php" style="text-decoration: none;">
		    <div class="card-icon">
			   <i><img src="\DE\Logos\orders.jpg"width="40" height="40"></i>
			      <i><img src="https://cdn2.iconfinder.com/data/icons/neutro-essential/32/more-vertical-512.png"width="40" height="40"></i>
			</div>
			<span>orders details</span>
			<h5> new orders</h5></a>
		</div>
	  </div>
	  
	  
	 
	 </div>
	
   </div>
   
   </div><br>

   </body>
</html>