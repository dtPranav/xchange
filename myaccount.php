<?php
session_start();
include('login.php');
if(!isset($_SESSION['username'])){
   header("Location:login1.php");
}
$server = "localhost";
$username = "root";
$password = "";

$con = mysqli_connect($server, $username, $password);
if(!$con){
    die("Connection to this database failed due to " . mysqli_connect_error());
}
$useremail = $_SESSION['username'];
$sql1 = "select Username,email,usn from `Items`.`users` where email = '$useremail';";
$sql2 = "select Item_name from `Items`.`Seller` where email = '$useremail';";
$res=mysqli_query($con,$sql1);
$count=mysqli_num_rows($res);
$res2=mysqli_query($con,$sql2);
$count2=mysqli_num_rows($res2);
if($count>=1){
$row = mysqli_fetch_assoc($res);
$name = $row['Username'];
$email = $row['email'];
$usn = $row['usn'];
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>my account</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Handlee&display=swap" rel="stylesheet">

	<style>
      *{
      	margin: 0px;
      	padding: 0px;
      }
		header{
			/*background-image: url("https://cdn.student.com/bundles/microapp-static-pages/images/public/about/about-us-hero-image-t.jpg");*/
			background-color: rgb(255, 255, 255);
			background-repeat: no-repeat;
			background-size: cover;
			height: 150px;
		}
		a{
           padding: 10px;
           margin: 15px;
           color: black;
           
           text-align: center;
		}
		a:hover{
          text-decoration: none;
		}
		h2 {
			float: left; color: red; text-shadow: 0px 5px 5px 5px; font-weight: bold;
		}

	</style>
</head>
<body>
	<header>
	<img  style="position: relative; float: left;"src="https://upload.wikimedia.org/wikipedia/en/thumb/8/87/BMS_College_of_Engineering.svg/150px-BMS_College_of_Engineering.svg.png" >
	<h1>BMS COLLEGE OF ENGINEERING</h1>
	<h2>BMSCE Xchange System</h2>


	</header>
	<div>
	<div style="height: 30px; width: 100%; background-color: #add8e6;">
		<div style="float: right;">
		<a href="home2.php">home</a> |  <a href="categorie.php">find your item</a>  |  <a href="#" style="font-weight: bold;">My account </a>  |  <a href="contact.html" >contact us</a>
	</div>

	</div>
	<div class="jumbotron jumbotron-fluid">
  <!-- <div class="container"> -->
    <!-- <h1 class="display-4">Fluid jumbotron</h1> -->
    <div class="container">
    	<h3>Account details: </h3>
	<div style="font-size: 1.5em; color: blue; position: relative; left: 100px; font-family: 'Handlee', cursive;">
		NAME: <?php echo $name?><br>
		USN: <?php echo $usn?><br>
		EMAIL:<?php echo $email?> <br>
	<?php	if($count2>0){
        echo "THINGS SOLD:";
	while($row2 = mysqli_fetch_assoc($res2)){
	$item_sold = $row2['Item_name'];

		 echo "<li>".$item_sold."</li>";
	}
}?>
	</div>
</div>

    <!-- <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
 <!--  </div> -->
</div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
	</body>