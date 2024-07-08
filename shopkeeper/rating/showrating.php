<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");

if (!empty($_SESSION["noo"])) {
  $no = $_SESSION["noo"];
  $result = mysqli_query($conn, "SELECT * FROM sregister WHERE no=$no");
  $row = mysqli_fetch_assoc($result);
  $select = mysqli_query($conn, "SELECT * FROM feedback WHERE shop_id=$no");
  $ratingselect = "SELECT * FROM rating WHERE shop_id=$no";
  $ratingrow = mysqli_query($conn, $ratingselect);

  // Calculate average rating
  $ratingCount = mysqli_num_rows($ratingrow);
  $totalRating = 0;
  while ($rating = mysqli_fetch_assoc($ratingrow)) {
    $totalRating += $rating['rating'];
  }
  $averageRating = $ratingCount > 0 ? round($totalRating / $ratingCount) : 0;
} else {
  header("Location:/DE/login/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <title>Show Rating</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    .wrapper {
      display: flex;
    }

    .sidebar {
      background: #fff;
      padding: 20px;
      border-right: 1px solid #ddd;
    }

    .sidebar ul {
      list-style: none;
    }

    .sidebar ul li {
      margin-bottom: 10px;
    }

    .main {
      flex-grow: 1;
      padding: 20px;
    }

    .head {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .head-title {
      display: flex;
      align-items: center;
    }

    .head-title h2 {
      color: white;
      margin-left: 10px;
    }

    .main-board {
      background: #fff;
      padding: 20px;
      border-radius: 5px;
    }

    .star-widget {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .star-widget input {
      display: none;
    }

    .star-widget label {
      font-size: 30px;
      color: #ccc;
      cursor: pointer;
      transition: color 0.3s;
    }

    .star-widget label:before {
      content: '\2606';
    }

    .star-widget input:checked ~ label:before,
    .star-widget label:hover:before,
    .star-widget label:hover ~ label:before {
      content: '\2605';
      color: #ff9f43;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table th,
    .table td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
  </style>
</head>
<body>
  <div class="wrapper">
   <div class="sidebar">
        <ul>
		   
		   <li><i><a href="/DE/shopkeeper/dashboard/dashboard.php"><img src="\DE\Logos\first.png" title="dashboard" width="40" height="40"></a></i></li>
		   <li><i><a href="/DE/shopkeeper/register/update.php"><img src="\DE\Logos\profile.png" title="profile" width="40" height="40"></a></i></li>
		  
		   <li><a href="/DE/shopkeeper/register/qrpage.php"><i><img src="\DE\Logos\share.png" title="QR page" width="40" height="40"></i></a></li>
		   
		   <li><i><a href="/DE/shopkeeper/register/logout.php"><img src="\DE\Logos\logout.png" title="logout" width="40" height="40"></a></i></li> 
		</ul>
      </div>
    <div class="main">
      <div class="head">
        <div class="head-title">
          <h2 style="color: white;">Shop Rating</h2>
          <span></span>
        </div>
        <br><br>






      </div>
	  <div class="star-widget" style="text-align: center;">
  <?php
  // Display average rating in stars
  for ($i = 1; $i <= 5; $i++) {
    if ($i <= $averageRating) {
      echo "<label for='rate-$i' class='fas fa-star' style='color: #ff9f43; font-size: 80px;'></label>";
    } else {
      echo "<label for='rate-$i' class='far fa-star' style='font-size: 80px;'></label>";
    }
  }
  echo "<br><span style='color: #ff9f43; font-size: 40px;'>($averageRating)</span>";
  ?>
</div>
      <div class="main-board">
        <div class="head">
          <div class="head-title">
            <h2 style="color: white;">Rating</h2>
          </div>
        </div>
        <div class="balance">
          <div class="balance-details">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Experience</th>
                  <th>Rating</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 1;
                mysqli_data_seek($ratingrow, 0); // Reset the pointer to the beginning
                while ($rating = mysqli_fetch_assoc($ratingrow)) {
                  $experience = $rating['feedback'];
                  $ratingValue = $rating['rating'];
                  echo "<tr>";
                  echo "<td>$count</td>";
                  echo "<td>$experience</td>";
                  echo "<td>";
                  for ($i = 1; $i <= $ratingValue; $i++) {
                    echo "<i class='fas fa-star'style='color: #ff9f43;'></i>";
                  }
                  echo "</td>";
                  echo "</tr>";

                 

                  $count++;
                }
                ?>
              </tbody>
            </
