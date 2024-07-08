<?php

require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["noo"])){
	$no=$_SESSION["noo"];
	$result=mysqli_query($conn,"SELECT * FROM sregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	$select=mysqli_query($conn,"SELECT * FROM feedback WHERE shop_id=$no");
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
<br>	
<div class="container">

<div class="card">
<div class="card-header">All orders </div>
<div class="card-body">
<section id="content mt-5">
	<div class="content-blog  bg-white">
		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr> 
						<th>Order no</th>
						<th>customer Name</th>
						<th>total price</th>
						<th>order status</th>
						<th>service type</th>
						<th>payment mode</th>
						<th>order placed on</th>
						<th>operations</th>
						
					</tr>
				</thead>
				<tbody>

                <?php
    $order = "SELECT * FROM ckeckout WHERE shopid='$no' ORDER BY id DESC";
    $orderrow = mysqli_query($conn, $order);

    if (mysqli_num_rows($orderrow) > 0) {
        // output data of each row
        while($roow = mysqli_fetch_assoc($orderrow)) {
			$pro_id=$roow["id"];
            ?>
      
        <tr>
			<td><?php echo $roow["id"] ?></td>
            <td><a href="ordercustomer.php?cid=<?php echo $roow["id"] ?>"><?php echo $roow["name"] ?></a></td>
            <td><?php echo $roow["price"] ?></td>
            <td><?php echo $roow["order_status"] ?></td>
			<td><?php echo $roow["servicetype"] ?></td>			
			<td><?php echo $roow["paymentmode"] ?></td> 
			<td><?php echo $roow["time"] ?></td> 
			
            <td><?php if($roow['order_status'] != 'cancelled' && $roow['order_status'] != 'Delivered'){ ?><a href='orderprocess.php?id=<?php echo $pro_id ?>'>Change status</a> <?php }?>
            </td>
        </tr>

        
        <?php
        }
      } else {
        echo "0 results";
      }


?>

			 
				</tbody>
			</table>
			
			<center><a href="/DE/shopkeeper/dashboard/dashboard.php" class="btn btn-info">go back to shop</a></center>

		</div>
	</div>

</section>
</div>
</div>


</div>


</body>
</html>