<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_SESSION["no"])) {
        $no = $_SESSION["no"];
        $id = $_GET['edit'];
        $result = mysqli_query($conn, "SELECT * FROM cregister WHERE no=$no");
        $row = mysqli_fetch_assoc($result);
		$name = $row['fname'];
        $shop = mysqli_query($conn, "SELECT sname FROM sregister WHERE no=$id");
        $shoprow = mysqli_fetch_assoc($shop);
        $shopname = $shoprow['sname'];
        // Get the rating and feedback from the form
        $rating = $_POST['rating'];
		 $feedback = $_POST['feedback'];
        
        
        // Insert the rating into the database
		$duplicate=mysqli_query($conn,"SELECT * FROM rating WHERE customer_id ='$no'&& shop_id='$id'");
			if(mysqli_num_rows($duplicate) > 0){
				$updaterate="UPDATE  rating SET rating='$rating',feedback='$feedback' WHERE customer_id= $no && shop_id='$id'";
				 
				$uploadrate=mysqli_query($conn,$updaterate);
				if($updaterate){
					 header("Location:/DE/customer/open_shop/shop.php?edit=".$id);
					// header('Location:/DE/customer/account/account.php?edit='.$id);
			
				}
			}
			else{
        $insert = "INSERT INTO rating (customer_id, shop_id, rating,feedback) VALUES ('$no', '$id', '$rating','$feedback')";
        $upload = mysqli_query($conn, $insert);
        
        if ($upload) {
            echo "<script>
                alert('Feedback sent successfully');
                </script>";
            header("Location:/DE/customer/dashboard/dash.php");
        } else {
            echo "<script>
                alert('Failed to send feedback');
                </script>";
        }
    } 
	}
	else {
        header("Location:/DE/login/login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Star Rating Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
        }
        
        .container {
            width: 400px;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .container h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .rating {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }
        
        .rating input {
            display: none;
        }
        
        .rating label {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .rating label:before {
            content: '\2606';
        }
        
        .rating input:checked ~ label:before,
        .rating label:hover:before,
        .rating label:hover ~ label:before {
            content: '\2605';
            color: #ff9f43;
        }
        
        .feedback textarea {
            width: 100%;
            height: 100px;
            border: 1px solid #ddd;
            padding: 10px;
            resize: none;
        }
        
        .submit-btn {
            text-align: center;
        }
        
        .submit-btn button {
            padding: 10px 20px;
            border: none;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .submit-btn button:hover {
            background-color: #ff7f00;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Rate Your Experience</h2>
        <form action="#" method="post">
            <div class="rating">
                <input type="radio" name="rating" id="star5" value="5">
                <label for="star5"></label>
                <input type="radio" name="rating" id="star4" value="4">
                <label for="star4"></label>
                <input type="radio" name="rating" id="star3" value="3">
                <label for="star3"></label>
                <input type="radio" name="rating" id="star2" value="2">
                <label for="star2"></label>
                <input type="radio" name="rating" id="star1" value="1">
                <label for="star1"></label>
            </div>
            <div class="feedback">
                <textarea name="feedback" placeholder="Write your feedback..."></textarea>
            </div>
            <div class="submit-btn">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>