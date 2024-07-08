<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	$id =$_GET['it'];
	$result=mysqli_query($conn,"SELECT * FROM cregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	$select=mysqli_query($conn,"SELECT * FROM products WHERE id=$id");
	$roow=mysqli_fetch_assoc($select);	

	
	$shop=mysqli_query($conn,"SELECT name,mail,mno,sname,no,addr,mno,slogo,sphoto,type,smail,sdescr,ano,aname,online,qrimage FROM sregister WHERE no=$id");
	$shoprow = mysqli_fetch_assoc($shop);
	$shopphoto=$shoprow['sphoto'];
	$shoplogo=$shoprow['slogo'];
	$shopno=$shoprow['no'];
	$shopname=$shoprow['sname'];
	$shopadd=$shoprow['addr'];
	$shopmno=$shoprow['mno'];
	$shoptype=$shoprow['type'];
	$shopmail=$shoprow['smail'];
	$shopdescr=$shoprow['sdescr'];
	$shopaccno=$shoprow['ano'];
	$shopaccname=$shoprow['aname'];
	$shoponline=$shoprow['online'];
	$shopqr=$shoprow['qrimage'];
	$shopkeepername=$shoprow['name'];
	$shopkeeperno=$shoprow['mail'];
	$shopkeepermail=$shoprow['mno'];
	
	
	

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
  <title>shop detail</title>
  <link rel="stylesheet" href="product.css">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>
<body>


<div class="container">
<br><br>
<h2>shop details</h2>
<br><br>
<img src="<?php echo"/DE/shopkeeper/register/upload/".$shoplogo;?>" style="width:80px;height:80px;">
		


		<br><br>
<div class="row">
	<div class="col-md-5">
		<img src="<?php echo"/DE/shopkeeper/register/upload/".$shopphoto;?>" style="width:100%;"><br>
		<img src="<?php echo"/DE/shopkeeper/register/qrcode/".$shopqr;?>" style="width:100%;">
		<center><p class="card-text" style="font-size:20px;">Shop code: <b><?php echo $shopno; ?></b></p></center>
	</div>
	<div class="col-md-7">
	
	<h3><center>shop details</h3>
		<p class="card-text" style="font-size:20px;">Shop Name: <b><?php echo $shopname; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop Type: <b><?php echo $shoptype; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop Address: <b><?php echo $shopadd; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop phone no: <b><?php echo $shopmno; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop Email: <b><?php echo $shopmail; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop Description: <b><?php echo $shopdescr; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop Account Name: <b><?php echo $shopaccname; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop Account Number: <b><?php echo $shopaccno; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop Online Payment: <b><?php echo $shoponline; ?></b></p>
		<hr style="height:2px;border-width:0;color:white;background-color:white">
		<h3><center>shopkeeper details</h3>
		<p class="card-text" style="font-size:20px;">Shop Keeper Name: <b><?php echo $shopkeepername; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop Keeper Mno: <b><?php echo $shopkeeperno; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop Keeper Email: <b><?php echo $shopkeepermail; ?></b></p>
		
		
	</div>
</div>
<br><br>

</div>
  
<!--<div class="col-md-7">
		<center><h2 style="color:white;font-size:50px;">?php echo $roow['name']; ?></h2></center>
		<p class="card-text" style="font-size:25px;">Product Price: <b>?php echo $roow['price']; ?> RS.</b></p>
		<p class="card-text" style="font-size:20px;">product Details: <b>?php echo'<pre>'.$roow['details'].'</pre>'; ?></b></p>
		<p class="card-text" style="font-size:20px;">product quantity:  <input type="number" name="quantity" min="1" max="5" value="1"></p>
		<br>
		<a href="/DE/customer/product/product.php?edit=?php echo $shopno;?>" class="btn btn-secondary">Go Back</a>
		<a href="/DE/customer/cart/cart.php?edit=?php echo $roow['id'];?>" class="btn btn-info">add to cart</a>
		<hr style="height:2px;border-width:0;color:white;background-color:white">
		<h3><center>shop details</h3>
		<p class="card-text" style="font-size:20px;">Shop Name: <b>?php echo $shopname; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop Address: <b>?php echo $shopadd; ?></b></p>
		<p class="card-text" style="font-size:20px;">Shop phone no: <b>?php echo $shopmno; ?></b></p>
		
	</div>
	
	-->
</body>
</html>
