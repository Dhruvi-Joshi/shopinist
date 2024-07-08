<?php
error_reporting(E_ERROR | E_PARSE);
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["noo"])){
	$no=$_SESSION["noo"];
	$result=mysqli_query($conn,"SELECT * FROM sregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	$checkid=$_GET['id'];
	
	if(isset($_POST['submit'])){
				
		$checkorderid=$_POST['orderid'];
		$checkstatus=$_POST['status'];
				 
				
			$updatestatus="UPDATE ckeckout SET order_status='$checkstatus' WHERE id= $checkid";
			if(mysqli_query($conn,$updatestatus)){
				header('Location:/DE/shopkeeper/orders/orders.php');
			}
			
			///$updatestatusrow=mysqli_query($conn,$updatestatus);
			//header('Location:/DE/customer/account/account.php?edit='.$sid);
		
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
  <title>order status</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> 
  <link rel="stylesheet" href="cart.css">
  
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  
</head>
<body style="background: linear-gradient(135deg, #71b7e6, #9b59b6);">
<div class="container text-white">

    <section id="content">
		<div class="content-blog">
					<div class="page_header text-center  py-5">
						<h2>order status</h2>
					</div>

<form method="post">


<div class="container">
			<div class="row">
				<div class="offset-md-2 col-md-8">
					<div class="billing-details">
						<h3 class="uppercase"></h3>
						<div class="space30"></div>
						
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
				
				$checkout=mysqli_query($conn,"SELECT * FROM ckeckout WHERE id=$checkid && shopid=$no");
				$checkoutrow = mysqli_fetch_assoc($checkout);
						$order=mysqli_query($conn,"SELECT * FROM ordered WHERE orderid=$checkid");
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
							
							<?php echo $productroow['name'] ?>
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

						
							
							<div class="clearfix space20"></div>
							<label>Change Status:</label>
							<select class="form-control" name="status">
								<option value="order placed">order placed</option> 
								<option value="In process">In process</option> 
								<option value="Dispatched">Dispatched</option>
								<option value="Delivered">Delivered</option>
								<option value="packed">packed</option>
							</select>
							<div class="clearfix space20"></div>
							
						
					</div>
				</div>
			</div>
			
			
		
			
        <div class="clearfix space30"></div><br><br>
        <div class="row">
            <div class="col-md-12 text-center">
			<input type="hidden" name="orderid" value="<?php echo $checkid?>">
                <input type="submit" name="submit" value="change status" class="btn btn-info">

            </div>
        </div>
		</div>
	</section>
	</form>
</div>
</body>
</html> 