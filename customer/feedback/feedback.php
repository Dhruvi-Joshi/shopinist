<?php

require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	$id =$_GET['edit'];
	$result=mysqli_query($conn,"SELECT * FROM cregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	$shop=mysqli_query($conn,"SELECT sname FROM sregister WHERE no=$id");
	$shoprow = mysqli_fetch_assoc($shop);
	$shopname=$shoprow['sname'];
	if(isset($_POST["submit"])){
		$feed_name=$_POST['name'];
		$feed_back=$_POST['feedback'];
		$insert="INSERT INTO feedback (customer_id,shop_id,feed_name,feedback) VALUES('$no','$id','$feed_name','$feed_back')";
		$upload=mysqli_query($conn,$insert);
		if($upload){
			echo"<script>
			alert('feedback send successfully');
			</script>";
			header("Location:/DE/customer/open_shop/shop.php?edit=".$id);
			
		}
		else{
			echo"<script>
			alert('feedback not send');
			</script>";
		}
		
	}
}
	
	else{
	header("Location:/DE/login/login.php");
}


?>
<html>
<head>
   <title>feedback</title>
   <link rel="stylesheet" type="text/css" href="stylefeedback.css">
   
</head>
<body>
<section></section>
  <div class="container">
  <!--<h2>Shop Name:?php echo $id;?></h2>
			<span>user name: ?php echo $no;?></span>-->
  <form method="post"> 
    <h1>FEEDBACK FOR <br><h1><?php echo $shopname;?></h1></h1>
	<div class="id">
	   <input type="text" placeholder="full name" name="name" value="<?php echo $row["fname"];?>" required>
	  
	</div>
	<textarea cols="15" rows="5" name="feedback" placeholder="your feedback:" required></textarea>	
	<button name="submit">Done</button>
	
	 <button formaction="/DE/customer/open_shop/shop.php?edit=<?php echo $id;?>">Back</button>
  </form>
  </div>
 </body>
</html>
