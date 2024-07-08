<?php

require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	$result=mysqli_query($conn,"SELECT * FROM cregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	$view=mysqli_query($conn,"SELECT shop_id FROM follow WHERE customer_id='$no'");
	 
	
	if(isset($_POST["add"])){
	$code=$_POST["code"];
	$cresult=mysqli_query($conn,"SELECT * FROM sregister WHERE no='$code' ");
	$roow=mysqli_fetch_assoc($cresult);
	$check=mysqli_query($conn,"SELECT * FROM follow WHERE customer_id='$no' && shop_id='$code' ");
	$checkrow=mysqli_fetch_assoc($check);
	if(mysqli_num_rows($cresult) >0 ){
		if(mysqli_num_rows($check) >0){
		
		echo"<script>
				alert('you are already join');
				</script>";
		
	}
		else{
			$query="INSERT INTO follow(`customer_id`,`shop_id`) VALUES('$no','$code')";
			mysqli_query($conn,$query);
			echo"<script>
			alert('add sucessfully');
		</script>";
		header("Refresh:0");
		}
	}
	else{
		echo"<script>
			alert('code is wrong');
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
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width==device-width,initial-scale=1.0">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3YwScVb3ZcuHtOA93W35dYTsvhLPVnYs9eStHfGJv0vKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <title>customer Dashboard</title>
  <link rel="stylesheet" href="style(daskcust).css">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script>
     $(document).ready(function(){
	    $('.showprompt').click(function(){
		   $('.pop_box').css({
		      "opacity":"1","pointer-events":"auto"
		   });
		});
		$('.btn1').click(function(){
		   $('.pop_box').css({
		        "opacity":"0","pointer-events":"auto" 
				
		   });
	    });
		
		$('.btn2').click(function(){
		   $('.pop_box').css({
		        "location.href":"D:\D2D\sem-4\DE\protocol\Shopkeeper\dashboard\index.html"
		   });
	    });
		
		$('.btn3').click(function(){
		   $('.pop_box').css({
		          "opacity":"0","pointer-events":"auto" 
		   });
	    });
	 });
  </script>
</head>
<body>
   <div class="wrapper">
      <div class="sidebar">
        <ul>
		    <li class="active"><i><img src="\DE\Logos\first.png" title="dashboard" width="40" height="40"></i></li>
		   <li><i><a href="\DE\customer\signin\update.php"><img src="\DE\Logos\profile.png" title="profile" width="40" height="40"></a></i></li>
		   <li><i><img class="showprompt" title="add shop" src="\DE\Logos\add.jpg" width="40" height="40"></i></li>
		   <div class="pop_box">
		   <form method="post" action="#">
		      <h1>please enter code:</h1>
			  <input type="text" name="code"style="text-align:center;"placeholder="enter shop code">
			  <div class="btns">
				<input type="submit" class="btn1"name="add">
			    <!--<a  style="text-decoration: none;" name="add" class="btn1">add</a>-->
				<a href="#" style="text-decoration: none;" class="btn3">cancel</a>
			   </div></form>
			  
		   </div>
		   
		   <li><i><a href="/DE/customer/signin/logout.php"><img src="\DE\Logos\logout.png" title="logout" width="40" height="40"></a></i></li> 
		</ul>
      </div>
	    <div class="main">
		 <div class="head">
		  <div class="head-title">
		    <h2 style="color:white;"><?php echo $row["fname"];?></h2>
			
			<!--<img src="<php echo"/DE/customer/signin/profile/".$row['profile'];?>" alt="profile">-->
			
			<h2 style="color:white;">Dashboard</h2>
			<span></span>
		  </div>
		   
	 </div>
	 <div class="main-board">
	  <div class="card-board">
	  
	  <?php
	  while ($viewrow = mysqli_fetch_assoc($view)) {
		 $shop_id = $viewrow['shop_id'];
		 
		 $take=mysqli_query($conn,"SELECT no,slogo,name,sname FROM sregister WHERE no='$shop_id'");
		 while($takeroww = mysqli_fetch_assoc($take)){
		 $take_no=$takeroww['no'];
		 $take_name=$takeroww['name'];
		 $take_sname=$takeroww['sname'];
		 $take_slogo=$takeroww['slogo'];
		 
		 
	  ?>
	  
	    <div class="card"><a href="/DE/customer/open_shop/shop.php?edit=<?php echo $take_no;?>" style="text-decoration: none;">
		    <div class="card-icon">
			   <i><img src="<?php echo"/DE/shopkeeper/register/upload/".$take_slogo;?>"width="40" height="40"></i>
			    <i><img src="https://cdn2.iconfinder.com/data/icons/neutro-essential/32/more-vertical-512.png"width="40" height="40"></i>
			</div>
			<span><?php echo $take_name;?></span>
			<h5><?php echo $take_sname;?></h5></a>
		</div>
		
		
		<?php
	  }
	  }
		?>
		
		 
	
	  </div>
	  
	</body>
	</html>
	