<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	$sid=$_GET['edit'];
	$checkid=$_GET['id'];
	$result=mysqli_query($conn,"SELECT * FROM cregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	/*$select=mysqli_query($conn,"SELECT * FROM products WHERE id=$id");
	$roow=mysqli_fetch_assoc($select);	
	$sid=$roow['shop_id'];*/
	$shop=mysqli_query($conn,"SELECT sname,no,addr,mno FROM sregister WHERE no=$sid");
	$shoprow = mysqli_fetch_assoc($shop);
	$shopno=$shoprow['no'];
	$shopname=$shoprow['sname'];
	$shopadd=$shoprow['addr'];
	$shopmno=$shoprow['mno'];
	$checkout=mysqli_query($conn,"SELECT * FROM ckeckout WHERE id=$checkid");
	$checkoutrow = mysqli_fetch_assoc($checkout);
	//var_dump($_SESSION['cart']);echo"<br>";
	//echo'<pre>';
	//print_r($_POST);
	//echo'</pre>';
	
	
	
	if(isset($_POST['submit'])){
				$checkreason=$_POST['reason'];
				$checkorderid=$_POST['orderid'];
				$checkstatus='cancelled';
				 
				$insertcancel="INSERT INTO cancelorder (orderid,reason,status) VALUES('$checkorderid','$checkreason','$checkstatus')";
				if(mysqli_query($conn,$insertcancel)){
					$updatestatus="UPDATE  ckeckout SET order_status='cancelled' WHERE id= $checkorderid";
					$updatestatusrow=mysqli_query($conn,$updatestatus);
					header('Location:/DE/customer/account/account.php?edit='.$sid);
				}
	}
}
	//header('Location:/DE/customer/account/account.php?edit='.$sid);
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
  <title>cancel order</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> 
  <link rel="stylesheet" href="cart.css">
  
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  
</head>
<body style="background: linear-gradient(135deg, #71b7e6, #9b59b6);">
<div class="container text-white">

    <section id="content">
		<div class="content-blog">
					<div class="page_header text-center  py-5">
						<h2>cancel order</h2>
					</div>

<form method="post">

<?php
/*echo "<pre>";
print_r($_SESSION['cart']);
echo "</pre>";*/

?>

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
				
				$checkout=mysqli_query($conn,"SELECT * FROM ckeckout WHERE id=$checkid && userid=$no");
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

						
							
							<div class="clearfix space20"></div>
							<label>Reason </label>
							<textarea class="form-control" name="reason" cols="30" rows="10"></textarea>
							<div class="clearfix space20"></div>
							
						
					</div>
				</div>
			</div>
			
			
		
			
        <div class="clearfix space30"></div><br><br>
        <div class="row">
            <div class="col-md-12 text-center">
			<input type="hidden" name="orderid" value="<?php echo $checkid?>">
                <input type="submit" name="submit" value="cancel order" class="btn btn-info">

            </div>
        </div>
		</div>
	</section>
	</form>
</div>
</body>
</html> 