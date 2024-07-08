<?php

require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["noo"])){
	$no=$_SESSION["noo"];
	$result=mysqli_query($conn,"SELECT * FROM sregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	$select=mysqli_query($conn,"SELECT customer_id FROM follow WHERE shop_id=$no");
	
	
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
  <title>show customer</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> 
  <link rel="stylesheet" href="showfeed.css">
  
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  
</head>
<body>
<form>
   <div class="wrapper">
      <div class="sidebar">
        <ul>
		   
		   <li><i><a href="/DE/shopkeeper/dashboard/dashboard.php"><img src="\DE\Logos\first.png" title="dashboard" width="40" height="40"></a></i></li>
		   <li><i><a href="/DE/shopkeeper/register/update.php"><img src="\DE\Logos\profile.png" title="profile" width="40" height="40"></a></i></li>
		   <li class="active"><i><img src="\DE\Logos\shop.png" title="shop" width="40" height="40"></i></li>
		   
		   <li><a href="/DE/shopkeeper/register/qrpage.php"><i><img src="\DE\Logos\share.png" title="QR page" width="40" height="40"></i></a></li>
		   
		   <li><i><a href="/DE/shopkeeper/register/logout.php"><img src="\DE\Logos\logout.png" title="logout" width="40" height="40"></a></i></li> 
		</ul>
      </div>
	    <div class="main">
		 <div class="head">
		 
	 </div>
	 
	  
	   <div class="head">
		  <div class="head-title">
		    <h2 style="color:white;">Online Cutomers</h2>
			
	 </div>
	 
	 </div>
	 
	<div class="balance">
	  <div class="balance-details">
	   
	  
	
		<table class="table">
		
			<thead>
				<tr>
					<th>Photo</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone no</th>
					<th>Address</th>
					<!--<th>Action</th>-->
				</tr>
			</thead>
		
		<?php
		
			while( $selectrow = mysqli_fetch_assoc($select)){
				$customerno=$selectrow['customer_id'];
				$selectcusto=mysqli_query($conn,"SELECT profile,fname,email,pno,addr FROM cregister WHERE no=$customerno");
				$selectcustomer =mysqli_fetch_assoc($selectcusto);
			
		?>
		
				<tr>
					<td><img src="<?php echo"/DE/customer/signin/profile/".$selectcustomer['profile'];?>" height="100px" width="100px" alt="photo"></td>
					<td><?php echo $selectcustomer['fname'];?></td>
					<td><?php echo $selectcustomer['email'];?></td>
					<td><?php echo $selectcustomer['pno'];?></td>
					<td><?php echo $selectcustomer['addr'];?></td>
					<!--<td><button class="show-model">Replay</button></td>
					<div class="model-box">
						<form method="post" action="#">
						  <h2>Enter Your replay:</h2>
						  <input type="text" name="code"style="text-align:center;"placeholder="REPLAY....">
						  <div class="buttons">
							<button class="close-btn">cancle</button>
							<input type="submit" class="btn1" name="add">
							
						   </div></form>
					</div>-->
					
				</tr>
		
		<?php
			}
		?>
		
		</table>
		

  
	</div>	 
   </div>
</div>
</form>

<script>

	const balance=document.querySelector(".table"),
	showbtn = document.querySelector(".show-model"),
	closebn=document.querySelector(".close-btn");
	
	showbtn.addEventListener("click",() => balance.classList.add("active"));
	
</script>
   </body>
   </html>