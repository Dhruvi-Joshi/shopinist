
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/DE/phpqrcode/qrlib.php");
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
if(isset($_POST["submit"])){
	$name=$_POST["name"];
	$bdate=$_POST["bdate"];
	$email=$_POST["email"];
	$mno=$_POST["mno"];
	$gender=$_POST["gender"];
	$type=$_POST["type"];
	$sname=$_POST["sname"];
	$autho=$_FILES["autho"]["name"];
	$smail=$_POST["smail"];
	$logo=$_FILES["logo"]["name"];
	$photo=$_FILES["photo"]["name"];
	$sdescr=$_POST["sdescr"];
	$nation=$_POST["nation"];
	$state=$_POST["state"];
	$dist=$_POST["dist"];
	$city=$_POST["city"];
	$addr=$_POST["addr"];
	$pin=$_POST["pin"];
	$accname=$_POST["accname"];
	$accno=$_POST["accno"];
	$onlineno=$_POST["onlineno"];
	$user=$_POST["user"];
	$pass=$_POST["pass"];
	$cpass=$_POST["cpass"];
	$path='qrcode/';
	
	
	
	$duplicate=mysqli_query($conn,"SELECT * FROM sregister WHERE user ='$user'");
	if(mysqli_num_rows($duplicate) > 0){
		echo"<script>
			alert('username is already exits');
		</script>";
	}
	else{
		if($pass == $cpass){
			
			
			$query="INSERT INTO sregister(`name`,`bdate`, `mail`, `mno`,`gender`,`type`,`sname`,`autho`,`smail`,`slogo`,`sphoto`,`sdescr`,`nation`,`state`,`dist`,`city`,`addr`,`pin`,`aname`,`ano`,`online`, `user`, `pass`, `cpass`) VALUES('$name','$bdate','$email','$mno','$gender','$type','$sname','$autho','$smail','$logo','$photo','$sdescr','$nation','$state','$dist','$city','$addr','$pin','$accname','$accno','$onlineno','$user','$pass','$cpass')";
			if(mysqli_query($conn,$query)){
			move_uploaded_file($_FILES["autho"]["tmp_name"],"upload/".$_FILES["autho"]["name"]);
			move_uploaded_file($_FILES["logo"]["tmp_name"],"upload/".$_FILES["logo"]["name"]);
			move_uploaded_file($_FILES["photo"]["tmp_name"],"upload/".$_FILES["photo"]["name"]);
			
		$_SESSION["slogin"] =true;
		//$_SESSION["noo"] =$row["no"];
		
					$qrid=mysqli_insert_id($conn);
					$_SESSION["slogin"] =true;
					$_SESSION["noo"] =$qrid;
					
					
					$qrcode=$path.time().".png";
					$qrimage=time().".png";
					QRcode ::png("$qrid",$qrcode,'H',4,4);
					echo "<img src='".$qrcode."'>";
					$qeqerey="UPDATE sregister SET qrimage = '$qrimage' WHERE no = $qrid";
					mysqli_query($conn,$qeqerey);
					header("Location:/DE/shopkeeper/dashboard/dashboard.php");
		
		}
		else{
			echo"qr not generate";
		}
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
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Responsive Regisration Form </title> 
</head>
<body style="background: linear-gradient(135deg, #71b7e6, #9b59b6);">
    <div class="container">
        <header>Registration</header>

        <form action="#" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Personal Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Full Name</label>
                            <input type="text" name="name" placeholder="Enter your name" required>
                        </div>

                        <div class="input-field">
                            <label>Date of Birth</label>
                            <input type="date" name="bdate" placeholder="Enter birth date" required>
                        </div>

                        <div class="input-field">
                            <label>Email</label>
                            <input type="text" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="input-field">
                            <label>Mobile Number</label>
                            <input type="number" name="mno" placeholder="Enter mobile number" required>
                        </div>

                        <div class="input-field">
                            <label>Gender</label>
                            <select name="gender" required>
                                <option disabled selected>Select gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Others</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Type Of Shop</label>
                            <input type="text" name="type" placeholder="Enter your ocupation" required>
                        </div>
                    </div>
                </div>

                <div class="details ID">
                    <span class="title">Shop Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Shop Name</label>
                            <input type="text" name="sname" placeholder="Enter shop name" required>
                        </div>

                        <div class="input-field">
                            <label>Issued Authority</label>
                            <input type="file" accept=".jpg, .jpeg,.png" name="autho" placeholder="select" required>
                        </div>

                        <div class="input-field">
                            <label>Shop Email</label>
                            <input type="text" name="smail" placeholder="Enter Shop Email address" required>
                        </div>

                        <div class="input-field">
                            <label>Shop Logo</label>
                            <input type="file" accept=".jpg, .jpeg,.png" name="logo" placeholder="select logo" required>
                        </div>

                        <div class="input-field">
                            <label>Shop Photo</label>
                            <input type="file" accept=".jpg, .jpeg,.png" name="photo" placeholder="select photo" required>
                        </div>

                        <div class="input-field">
                            <label>Shop Description</label>
                            <input type="text" name="sdescr" placeholder="Enter shp description" required>
                        </div>
                    </div>

                    <button class="nextBtn" style="background: linear-gradient(135deg, #71b7e6, #9b59b6);" >
                        <span class="btnText">Next</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div> 
            </div>

            <div class="form second">
                <div class="details address">
                    <span class="title">Address Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Nationality</label>
                            <input type="text" name="nation" placeholder="Nationality" required>
                        </div>

                        <div class="input-field">
                            <label>state</label>
                            <input type="text" name="state" placeholder="Enter your state" required>
                        </div>

                        <div class="input-field">
                            <label>District</label>
                            <input type="text" name="dist" placeholder="Enter your district" required>
                        </div>

                        <div class="input-field">
                            <label>city</label>
                            <input type="text" name="city" placeholder="Enter your city" required>
                        </div>

                        <div class="input-field">
                            <label>Address</label>
                            <input type="text" name="addr" placeholder="Enter your address" required>
                        </div>

                        <div class="input-field">
                            <label>Pincode</label>
                            <input type="number" name="pin" placeholder="Enter pincode" required>
                        </div>
                    </div>
                </div>

                <div class="details family">
                    <span class="title">Account Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Account Name</label>
                            <input type="text" name="accname" placeholder="Enter your Account name" required>
                        </div>

                        <div class="input-field">
                            <label>Account Number</label>
                            <input type="number" name="accno" placeholder="Enter account number" required>
                        </div>

                        <div class="input-field">
                            <label>Paytm number</label>
                            <input type="number" name="onlineno" placeholder="Enter online platform detail" required>
                        </div>

                        <div class="input-field">
                            <label>Username</label>
                            <input type="text" name="user" placeholder="Enter username" required>
                        </div>

                        <div class="input-field">
                            <label>Password</label>
                            <input type="password" name="pass" placeholder="password" required>
                        </div>

                        <div class="input-field">
                            <label>confirm password</label>
                            <input type="password" name="cpass" placeholder="enter password again" required>
                        </div>
                    </div>

                    <div class="buttons">
                        <div class="backBtn" style="background: linear-gradient(135deg, #71b7e6, #9b59b6);">
                            <i class="uil uil-navigator"></i>
                            <span class="btnText">Back</span>
                        </div>
                        
                        <button class="sumbit" name="submit" style="background: linear-gradient(135deg, #71b7e6, #9b59b6);">
                            <span class="btnText">Submit</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                    </div>
                </div> 
            </div>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>