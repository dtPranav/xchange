<?php
session_start();
include('login.php');
if(!isset($_SESSION['username'])){
   header("Location:login1.php");
}
if(isset($_POST['item'])){
$server = "localhost";
$username = "root";
$password = "";

$con = mysqli_connect($server, $username, $password);
if(!$con){
    die("Connection to this database failed due to " . mysqli_connect_error());
}

//session_start();
//include('login.php');
$useremail = $_SESSION['username'];
$sql1 = "select Username,email,usn from `Items`.`users` where email = '$useremail';";
$res=mysqli_query($con,$sql1);
$count=mysqli_num_rows($res);
if($count>=1){
$row = mysqli_fetch_assoc($res);
$seller_name = $row['Username'];
$email = $row['email'];
$usn = $row['usn'];
}
$item = $_POST['item'];
$desc = $_POST['desc'];


$phone = $_POST['phone'];

$sql = "insert into `Items`.`Seller` values ('$item','$desc','$seller_name','$usn','$email','$phone',NULL);";

if ($con->query($sql)=="TRUE"){
   $sub = true;
}
else{
    echo "error: $sql $con->error";
}
$con->close();


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell item</title>
    <style>
    *{
        margin: 0px;
        padding: 0px;
    }
    .container{
        max-width: 100%;
        padding: 32px;
        margin: auto;
        
    }
    .container>h2{
     text-align: center;
     

    }
form{
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
}
    form> input,textarea{
     width: 60%;
     padding: 20px;
    margin-top: 20px;
    border-radius: 10px;

    }

    .btn{
        cursor: pointer;
    margin: 12px;
    padding: 10px;
    border-radius: 10px;
    }
    img{
        width: 100%;
        max-height: 100%;
        position: absolute;
        z-index: -1;
        opacity: 0.7;
        
    }
    .container>h3{
        color: green;
        text-align: center;
    }
    </style>
</head>
<body>
    <img src = "https://bmsce.ac.in/assets/img/Library/Library-10.jpg" alt="bms-college">
<div class = "container">
<h2>Fill the details to sell your item</h2>
<?php
if($sub == true){
echo "<h3>Submitted<h3>";
}
?>
<form action="add.php" method="POST">

    <input type="text" name="item" id = "item" required placeholder="Enter you item you want to sell">
    <!-- <input type="text" name = "seller_name" id="seller_name" required placeholder = "Enter your name"> -->
    <!-- <input type="text" name="usn" id="usn" pattern = "1BM1[7-9][A-Z]{2}[0-9]{3}" required placeholder="Enter usn"> -->
    <!-- <input type = "email" name = "email" id = "email" required placeholder = "Enter your email"> -->
    <input type="tel" id="phone" name="phone" max-length = 10 required placeholder="1234567890">
    <textarea name="desc" id = "desc" cols="30" rows="10" required placeholder="Enter description of your item"></textarea>
    <button class = "btn">Submit</button>
</form>

</div>

</body>
</html>