<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(isset($_POST["customer"])){
		$cuser=$_POST['cuser'];
		$cpass=$_POST['cpass'];
		$cresult=mysqli_query($conn,"SELECT * FROM cregister WHERE user='$cuser' ");
		$row=mysqli_fetch_assoc($cresult);
		if(mysqli_num_rows($cresult) >0){
			if($cpass == $row["pass"]){
				$_SESSION["login"] =true;
				$_SESSION["no"] =$row["no"];
				header("Location:/DE/customer/dashboard/dash.php");
			}
			else{
				echo"<script>
				alert('wrong password');
				</script>";
			}
		}
		else{
			echo"<script>
				alert('user not register');
				</script>";
		}
}


if(isset($_POST["shop"])){
		$suser=$_POST['suser'];
		$spass=$_POST['spass'];
		$scpass=$_POST['scpass'];
		$result=mysqli_query($conn,"SELECT * FROM sregister WHERE user='$suser' ");
		$roww=mysqli_fetch_assoc($result);
		if($spass == $scpass){
		if(mysqli_num_rows($result) >0){
			if($spass == $roww["pass"]){
				$_SESSION["slogin"] =true;
				$_SESSION["noo"] =$roww["no"];
				header("Location:/DE/shopkeeper/dashboard/dashboard.php");
			}
			else{
				echo"<script>
				alert('wrong password');
				</script>";
			}
		}
		else{
			echo"<script>
				alert('user not register');
				</script>";
		}
		}
		else{
			echo"<script>
			alert('password does not match');
		</script>";
		}
}

?>
<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login</title>
      <link rel="stylesheet" href="style(login).css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
      <div class="wrapper">
         <div class="title-text">
            <div class="title login">
               Login for
            </div>
            <div class="title signup">
               Login for
            </div>
         </div>
         <div class="form-container">
            <div class="slide-controls">
               <input type="radio" name="slide" id="login" checked>
               <input type="radio" name="slide" id="signup">
               <label for="login" class="slide login">Customer</label>
               <label for="signup" class="slide signup">Shopkeeper</label>
               <div class="slider-tab"></div>
            </div>
            <div class="form-inner" >
               <form method="post" class="login">
                  <div class="field">
                     <input type="text" name="cuser" placeholder="username" required>
                  </div>
                  <div class="field">
                     <input type="password" name="cpass" placeholder="Password" required>
                  </div>
                  <!--<div class="pass-link">
                     <a href="#">Forgot password?</a>
                  </div>-->
				
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" value="Login" name="customer"></a>
                  </div>
                  <div class="signup-link">
                     Not a member? <a href="/DE/customer/signin/signin.php">Signup now</a>
                  </div>
               </form>
               <form method="post" class="signup" >
                  <div class="field">
                     <input type="text" name="suser" placeholder="username">
                  </div>
                  <div class="field">
                     <input type="password" name="spass" placeholder="Password">
                  </div>
                  <div class="field">
                     <input type="password" name="scpass" placeholder="Confirm password">
                  </div>
				  
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" value="Login" name="shop">
                  </div>
				
				  <div class="signup-link">
                     Not a member? <a href="/DE/shopkeeper/register/signin.php">Signup now</a>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <script>

         const loginText = document.querySelector(".title-text .login");
         const loginForm = document.querySelector("form.login");
         const loginBtn = document.querySelector("label.login");
         const signupBtn = document.querySelector("label.signup");
         const signupLink = document.querySelector("form .signup-link a");
         signupBtn.onclick = (()=>{
           loginForm.style.marginLeft = "-50%";
           loginText.style.marginLeft = "-50%";
         });
         loginBtn.onclick = (()=>{
           loginForm.style.marginLeft = "0%";
           loginText.style.marginLeft = "0%";
         });
		
        <!-- signupLink.onclick = (()=>{ -->
         <!--  signupBtn.click();  -->
        <!--   return false;  -->
        <!-- }); -->
      </script>
   </body>
</html>