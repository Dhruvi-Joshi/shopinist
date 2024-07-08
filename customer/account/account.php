<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	$sid=$_GET['edit'];
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
  <title>Account</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> 
  <link rel="stylesheet" href="cart.css">
  
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  
</head>
<body style="background: linear-gradient(135deg, #71b7e6, #9b59b6);">

<div class="container text-white">
    <h2 class='text-center text-white'>My Account</h2>

    <section id="content">
		<div class="content-blog content-account">
			<div class="container">
				<div class="row">
				 
					<div class="col-md-12">

			<h3>Recent Orders</h3>
			<br>
			<table class="cart-table account-table table table-bordered bg-white text-dark text-center">
				<thead>
					<tr>
						<th>order no</th>
						<th>total price</th>
						<th>service type</th>
						<th>order status</th>
						<th>payment mode</th>
						<th>date</th>
						<th colspan="2">action</th>
					</tr>
				</thead>
				<tbody>
				
				<?php
						$order=mysqli_query($conn,"SELECT * FROM ckeckout WHERE userid=$no && shopid=$sid ORDER BY id DESC" );
						if(mysqli_num_rows($order)>0)
						{
							while($orderrow = mysqli_fetch_assoc($order)){
								//echo "id".$orderrow['id']."userid".$orderrow['userid']."shopid".$orderrow['shopid']."name".$orderrow['name']."phone".$orderrow['pno']."<br>";
				?>
				
					<tr>
						<td>
							<?php echo$orderrow['id'] ?>
						</td>
						<td>
							<?php echo$orderrow['price'] ?>/-
						</td>
						<td>
							<?php echo$orderrow['servicetype'] ?>
						</td>
						<td>
							<?php echo$orderrow['order_status'] ?>
						</td>
						<td>
							<?php echo $orderrow['paymentmode'] ?>			
						</td>
						<td>
							<?php echo $orderrow['time'] ?>				
						</td>
						<td>
							<a href="vieworder.php?id=<?php echo $orderrow['id']?>&& edit=<?php echo $sid?>">View</a>
						</td>
						<td>
						<?php if($orderrow['order_status'] != 'cancelled'){ ?>
							<a href="cancelorder.php?id=<?php echo $orderrow['id']?>&& edit=<?php echo $sid?>" style="color:red;">Cancel</a>
						<?php } ?>
						</td>
					</tr>
				
				<?php
							}
						}
						else{
							echo "0 results";
						}
	
				?>
				
						
				</tbody>
			</table>		

		 

			<center><a href="/DE/customer/open_shop/shop.php?edit=<?php echo $sid;?>" class="btn btn-info">go back to shop</a></center>



			</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	
 
</div>


</body>
</html>