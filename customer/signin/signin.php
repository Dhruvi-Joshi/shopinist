<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(isset($_POST["submit"])){
	$name=$_POST["name"];
	$email=$_POST["email"];
	$pno=$_POST["phone"];
	$user=$_POST["username"];
	$pass=$_POST["password"];
	$cpass=$_POST["cpassword"];
	$add=$_POST["address"];
	$gender=$_POST["gender"];
	$duplicate=mysqli_query($conn,"SELECT * FROM cregister WHERE user ='$user'");
	if(mysqli_num_rows($duplicate) > 0){
		echo"<script>
			alert('username is already exits');
		</script>";
	}
	else{
		if($pass == $cpass){
			$query="INSERT INTO cregister(`profile`,`fname`, `email`, `pno`, `user`, `pass`, `cpass`, `addr`, `gender`) VALUES('fix.png','$name','$email','$pno','$user','$pass','$cpass','$add','$gender')";
			mysqli_query($conn,$query);
			echo"<script>
			alert('register sucessfully');
		</script>";
		$_SESSION["login"] =true;
				$_SESSION["no"] =$row["no"];
				header("Location:/DE/customer/dashboard/dashboard.php");
		}
		else{
			echo"<script>
			alert('password does not match');
		</script>";
		}
	}
}

?>
<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="stylecs.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">customer Registration</div>
    <div class="content">
	
     <form action="" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" name="name" placeholder="Enter your name" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="username" placeholder="Enter your username" required >
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text"name="email" placeholder="Enter your email" required >
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="phone" placeholder="Enter your number"  required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="password" placeholder="Enter your password" required >
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" name="cpassword" placeholder="Confirm your password" required >
          </div>
		  <div class="input-box">
            <span class="details">Address</span>
            <input cols="15" rows="50"type="textarea" placeholder="address" name="address"  required>
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="gender" value="male" id="dot-1">
          <input type="radio" name="gender" value="female" id="dot-2">
          <input type="radio" name="gender" value="not to say" id="dot-3" checked >
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>
		          
       <div class="button" >
          <input type="submit" value="Register" name="submit">
        </div>
      </form>
    </div>
  </div>
<!--<script> formaction="D:\D2D\sem-4\DE\protocol\Customer\daskboard(customer)\dashboard.html"
function myOnClickFn(){
document.location.href="D:\D2D\sem-4\DE\protocol\Shopkeeper\dashboard\index.html"
</script>-->
</body>
</html>
