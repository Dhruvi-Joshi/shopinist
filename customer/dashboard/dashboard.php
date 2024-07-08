<?php

require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	$result=mysqli_query($conn,"SELECT * FROM creg WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
}
else{
	header("Location:/DE/login/login.php");
}

?>

<html>
<head>
<title>
	dashboard
</title>
</head>
<body>
<h1>welcome <?php echo $row["fname"];?></h1>
<a href="/DE/customer/signin/logout.php">logout</a>
</body>
</html>