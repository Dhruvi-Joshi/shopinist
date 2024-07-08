<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(!empty($_SESSION["no"])){
	$no=$_SESSION["no"];
	$id=$_GET['id'];
	$result=mysqli_query($conn,"SELECT * FROM cregister WHERE no=$no");
	$row = mysqli_fetch_assoc($result);
	$select=mysqli_query($conn,"SELECT * FROM products WHERE id=$id");
	$roow=mysqli_fetch_assoc($select);	
	$sid=$roow['shop_id'];
	$shop=mysqli_query($conn,"SELECT sname,no,addr,mno FROM sregister WHERE no=$sid");
	$shoprow = mysqli_fetch_assoc($shop);
	$shopno=$shoprow['no'];
	$shopname=$shoprow['sname'];
	$shopadd=$shoprow['addr'];
	$shopmno=$shoprow['mno'];
	
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		echo $id."<br>";
		var_dump($_SESSION['cart']);echo"<br>";
		$cart = $_SESSION['cart'];
		 $pro = $cart[$id];
		unset($_SESSION['cart'][$id]);	
		header("Location: /DE/customer/product/product.php?edit=" . urlencode($sid));
	}
	
	/*if(isset($_GET['id'])&& isset($_GET['cart'])){
		$pid=$_GET['id'];
		$cart = $_SESSION['cart'];
		$serializedCart = urlencode(serialize($cart));
		echo $pid."<br>";
		var_dump($cart);
		unset($cart[$pid]);
		$_SESSION['cart'] = $cart;
		//unset($_SESSION['cart'][$pid]);
		header("Location: cart.php?edit=" . urlencode($pid));
		//header("location:cart.php?edit=<?php echo $roow['id'];>");
	}*/
}
	
	else{
	header("Location:/DE/login/login.php");
}
?>