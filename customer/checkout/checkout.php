<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
error_reporting(E_ERROR | E_PARSE);
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	$sid=$_GET['edit'];
	$result=mysqli_query($conn,"SELECT * FROM cregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	/*$select=mysqli_query($conn,"SELECT * FROM products WHERE id=$id");
	$roow=mysqli_fetch_assoc($select);	
	$sid=$roow['shop_id'];*/
	$shop=mysqli_query($conn,"SELECT sname,no,addr,mno,aname,ano,online FROM sregister WHERE no=$sid");
	$shoprow = mysqli_fetch_assoc($shop);
	$shopno=$shoprow['no'];
	$shopname=$shoprow['sname'];
	$shopadd=$shoprow['addr'];
	$shopmno=$shoprow['mno'];
	$shopaccname=$shoprow['aname'];
	$shopaccno=$shoprow['ano'];
	$shoponline=$shoprow['online'];
	//var_dump($_SESSION['cart']);echo"<br>";
	//echo'<pre>';
	//print_r($_POST);
	//echo'</pre>';
	
	
	$cart=$_SESSION['cart'];
if(isset($_SESSION['cart'])){
			$total=0;
			foreach($cart as $key=>$value){
				if($value['shop_id']==$sid){
					//echo $key.":".$value['quantity'].":".$value['shop_id']."<br>";
					$selectcart=mysqli_query($conn,"SELECT * FROM products WHERE id=$key");
					$cartroow=mysqli_fetch_assoc($selectcart);	
					$total = $total + ($value['quantity']*$cartroow['price']);
				}
			}
}
	if(isset($_POST['submit'])){
		if($_POST['agree']=='true'){
				$checkname=$_POST['name'];
				$checknumber=$_POST['number'];
				$checkmail=$_POST['email'];
				$checkaddress=$_POST['address'];
				$checkpay=$_POST['payment'];
				$checkagree=$_POST['agree'];
				$checktaking=$_POST['taking'];
				$ckeckouttable="INSERT INTO ckeckout (userid,shopid,name,pno,email,address,price,order_status,servicetype,paymentmode) VALUES('$no','$sid','$checkname','$checknumber','$checkmail','$checkaddress','$total','order placed','$checktaking','$checkpay')";
				//$ckeckouttablerow=mysqli_query($conn,$ckeckouttable);
				if(mysqli_query($conn,$ckeckouttable)){
					$checkoutid=mysqli_insert_id($conn);	
	
					foreach($cart as $key=>$value){
					if($value['shop_id']==$sid){
					$selectcart=mysqli_query($conn,"SELECT * FROM products WHERE id=$key");
					$cartroow=mysqli_fetch_assoc($selectcart);	
					$quanti=$value['quantity'];
					$pprice=$cartroow['price'];
					$orderedtable="INSERT INTO ordered (orderid,product_id,quantity,price) VALUES('$checkoutid','$key','$quanti','$pprice')";
					$orderedtablerow=mysqli_query($conn,$orderedtable);
					
						}
					}
				
				}if($orderedtable){
						//echo 'insert in both table';
						header('Location:/DE/customer/account/account.php?edit='.$sid);
						unset($_SESSION['cart']);
						
					}
				
		
		}
		else{
			echo 'agreen to terms and condition';
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3YwScVb3ZcuHtOA93W35dYTsvhLPVnYs9eStHfGJv0vKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <title>checkout</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> 
  <link rel="stylesheet" href="cart.css">
  
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  
</head>
<body style="background: linear-gradient(135deg, #71b7e6, #9b59b6);">
<div class="container text-white">

    <section id="content">
		<div class="content-blog">
					<div class="page_header text-center  py-5">
						<h2>Shop - Checkout</h2>
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
						<h3 class="uppercase">Billing Details</h3>
						<div class="space30"></div>
						
							<label class="">Customer name </label>
							<input class="form-control" placeholder="name" name="name" value="<?php echo $row['fname']?>" type="text" required>
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-6">
									<label>Phone number </label>
									<input class="form-control" name="number" placeholder="" value="<?php echo $row['pno']?>" type="number" required>
								</div>
								<div class="col-md-6">
									<label>Email </label>
									<input class="form-control" name="email" placeholder="" value="<?php echo $row['email']?>" type="text" required>
								</div>
							</div>
							<div class="clearfix space20"></div>
							<label>Address </label>
							<input class="form-control" placeholder="Street address" name="address" value="<?php echo $row['addr']?>" type="text" required>
							<div class="clearfix space20"></div>
							
						
					</div>
				</div>
			</div>
			<div class="clearfix space30"></div>
			<h4 class="heading">Your order</h4>
			
			<table class="table table-bordered extra-padding bg-white text-dark">
				<tbody>
					<tr>
						<th>Cart Subtotal</th>
						<td><span class="amount"><?php echo $total?> RS.</span></td>
					</tr>
					<tr>
						<th>Shipping and Handling</th>
						<td>
							Free Shipping				
						</td>
					</tr>
					<tr>
						<th>Order Total</th>
						<td><strong><span class="amount"><?php echo $total?>/-</span></strong> </td>
					</tr>
				</tbody>
			</table>
			
			
			<div class="clearfix space30"></div>
			<h4 class="heading">taking Method</h4>
			<div class="clearfix space20"></div>
			<div class="payment-method mt-5">
              
				<div class="row d-flex">
				
						<div class="col-md-4">
							<input name="taking" value="collecting" id="radio1" class="mr-2 css-checkbox" type="radio"><span>collecting</span>
							<p>you can pick up your order when the order status is <b><span style="color:red;">packed.</span></b></p>
							<div class="space20"></div>
						</div>
						<div class="col-md-4">
							<input name="taking" value="home delivery" id="radio2" class="mr-2 css-checkbox" type="radio" checked="checked"><span>home delivery</span>
							<div class="space20"></div>
							
						</div>
						
				
                </div>
           
				
			</div><br>
			
			<div class="space30"></div>
			<div class="clearfix space30"></div>
			<h4 class="heading">Payment Method</h4>
			<div class="clearfix space20"></div>
			
			<div class="payment-method mt-5">
              
				<div class="row d-flex">
				
						<div class="col-md-4">
							<input name="payment" value="cod" id="radio1" class="mr-2 css-checkbox" type="radio" checked="checked"><span>cash on delivery</span>
							<div class="space20"></div>
							<p>For cash on delivery, please ensure that you have the exact amount ready for payment upon delivery. Our delivery personnel will collect the payment at your doorstep. Kindly note that we only accept cash for cash on delivery orders.</p>
						</div>
						<div class="col-md-4">
							<input name="payment" value="cheque" id="radio2" class="mr-2 css-checkbox" type="radio"><span>Cheque Payment</span>
							<div class="space20"></div>
							<p>Please send your cheque to BLVCK Fashion House, Oatland Rood, UK, LS71JR</p>
							<p>ACCOUNT NAME: <b><span style="color:red;"><?php  echo $shopaccname?></span></b></p>
							<p>ACCOUNT NUMBER: <b><span style="color:red;"><?php  echo $shopaccno?></span></b></p>
						</div>
						<div class="col-md-4">
							<input name="payment" value="paypal" id="radio3" class="mr-2 css-checkbox" type="radio"><span>Paypal</span>
							<div class="space20"></div>
							<p>Pay via PayPal; you can pay with your credit card if you don't have a PayPal account</p>
							<p>ONLINE PAYMENT NUMBER: <b><span style="color:red;"><?php  echo $shoponline?></span></b></p>
						</div>
				
                </div>
            
				<div class="space30"></div>
				
					<input name="agree" id="checkboxG2" value="true" class="mr-2 css-checkbox" type="checkbox"><span>I've read and accept the <a href="#">terms &amp; conditions</a></span>
				
				<div class="space30"></div>
				
			</div>
        </div>		
        
        <div class="row">
            <div class="col-md-12 text-center">
                <input type="submit" name="submit" value="PAY NOW" class="btn btn-info">
				<a href="/DE/customer/cart/cart.php?it=<?php echo $sid;?>" class="btn btn-info">go back</a>
            </div>
        </div><br><br>
		</div>
	</section>
	</form>
</div>
</body>
</html>