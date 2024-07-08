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
				$checkname=$_POST['name'];
				$checknumber=$_POST['number'];
				$checkmail=$_POST['email'];
				$checkaddress=$_POST['address'];
				
				
				$updatecheckout="UPDATE  ckeckout SET name='$checkname',pno='$checknumber',email='$checkmail',address='$checkaddress' WHERE id= $checkid";
				 
				$upload=mysqli_query($conn,$updatecheckout);
				if($upload){
					header('Location:/DE/customer/account/account.php?edit='.$sid);
			
				}
				else{
					$message[]='could not add the product';
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
  <title>update checkout details</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> 
  <link rel="stylesheet" href="cart.css">
  
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  
</head>
<body style="background: linear-gradient(135deg, #71b7e6, #9b59b6);">
<div class="container text-white">

    <section id="content">
		<div class="content-blog">
					<div class="page_header text-center  py-5">
						<h2>Update Address</h2>
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
							<input class="form-control" placeholder="name" name="name" value="<?php echo $checkoutrow['name']?>" type="text">
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-6">
									<label>Phone number </label>
									<input class="form-control" name="number" placeholder="" value="<?php echo  $checkoutrow['pno']?>" type="number">
								</div>
								<div class="col-md-6">
									<label>Email </label>
									<input class="form-control" name="email" placeholder="" value="<?php echo  $checkoutrow['email']?>" type="text">
								</div>
							</div>
							<div class="clearfix space20"></div>
							<label>Address </label>
							<input class="form-control" placeholder="Street address" name="address" value="<?php echo  $checkoutrow['address']?>" type="text">
							<div class="clearfix space20"></div>
							
						
					</div>
				</div>
			</div>
			
			
		
			
        <div class="clearfix space30"></div><br><br>
        <div class="row">
            <div class="col-md-12 text-center">
                <input type="submit" name="submit" value="update" class="btn btn-info">

            </div>
        </div>
		</div>
	</section>
	</form>
</div>
</body>
</html> 