<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	$sid=$_GET['edit'];
	$o_id=$_GET['id'];
	$result=mysqli_query($conn,"SELECT * FROM cregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	/*$select=mysqli_query($conn,"SELECT * FROM products WHERE id=$id");
	$roow=mysqli_fetch_assoc($select);	
	$sid=$roow['shop_id'];*/
	
	//echo'<pre>';
	//print_r($_POST);
	//echo'</pre>';
	

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
  <title>Order</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> 
  <link rel="stylesheet" href="cart.css">
  
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  
</head>
<body style="background: linear-gradient(135deg, #71b7e6, #9b59b6);">

<div class="container text-white">
    <h2 class='text-center text-white'>My Order</h2>

    <section id="content">
		<div class="content-blog content-account">
			<div class="container">
				<div class="row">
				 
					<div class="col-md-12">

			<h3>Recent Orders</h3>
			<br>
			<table class="cart-table account-table table table-bordered bg-white text-dark">
				<thead>
					<tr>
						<th>product</th>
						<th>quantity</th>
						<th>price</th>
						<th>total price </th>
						
					</tr>
				</thead>
				<tbody>
				
				<?php
				
				$checkout=mysqli_query($conn,"SELECT * FROM ckeckout WHERE id=$o_id && userid=$no");
				$checkoutrow = mysqli_fetch_assoc($checkout);
						$order=mysqli_query($conn,"SELECT * FROM ordered WHERE orderid=$o_id");
						if(mysqli_num_rows($order)>0)
						{
							while($orderrow = mysqli_fetch_assoc($order)){
								$product_id=$orderrow['product_id'];
								//echo "id".$orderrow['id']."userid".$orderrow['userid']."shopid".$orderrow['shopid']."name".$orderrow['name']."phone".$orderrow['pno']."<br>";
				?>
				
					<tr>
						<td>
						
							<?php
								$selectproduct=mysqli_query($conn,"SELECT * FROM products WHERE id=$product_id");
								$productroow=mysqli_fetch_assoc($selectproduct);
								
								
							?>
							<a href="/DE/customer/product/product_detail.php?edit=<?php echo $productroow['id'];?>">
							<?php echo $productroow['name'] ?></a>
						</td>
						<td>
							<?php echo $orderrow['quantity'] ?>
						</td>
						<td>
							<?php echo $orderrow['price'] ?>			
						</td>
						<td>
							<?php echo $orderrow['quantity'] * $orderrow['price']?>				
						</td>
						
							<!--<td><a href="vieworder.php?id=?php echo $orderrow['id']?>&& edit=?php echo $sid?>">View</a></td>-->
						
					</tr>
				
				<?php
							}
						}
						else{
							echo "0 results";
						}
	
				?>
				
				</tbody>
				
				<tfooer>
					<tr>
						
						<th></th>
						<th></th>
						<th>total price </th>
						<th><?php echo $checkoutrow['price']?></th>
					</tr>
					
					<tr>
						
						<th></th>
						<th></th>
						<th>order status </th>
						<th><?php echo $checkoutrow['order_status']?></th>
					</tr>
					
					<tr>
						
						<th></th>
						<th></th>
						<th>date </th>
						<th><?php echo $checkoutrow['time']?></th>
					</tr>
					
					<tr>
						
						<th></th>
						<th></th>
						<th>service type </th>
						<th><?php echo $checkoutrow['servicetype']?></th>
					</tr>
				</tfooer>
			</table>		

		 

			<div class="ma-address">
						<h3>My Addresses</h3>
						<p>The following addresses will be used on the checkout page by default.</p>

			<div class="row  bg-white text-dark px-5 py-3">
				<div class="col-md-6">
				<?php
					$order=mysqli_query($conn,"SELECT * FROM ckeckout WHERE userid=$no && shopid=$sid && id=$o_id");
					$orderrow = mysqli_fetch_assoc($order);
				?>
								<h4>Billing Address <a href="/DE/customer/checkout/ckeckoutupdate.php?edit=<?php echo $sid ?>&& id=<?php echo $orderrow['id']?>">Edit</a></h4>
					<p>
						
						<?php echo $orderrow['address'] ?>
					</p>
				</div>

				
			</div>



			</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	
 
</div>


</body>
</html>