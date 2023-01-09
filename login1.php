<?php
    if(isset($_POST['email'])){
    $server="localhost";
    $username='root';
    $password="";
    $con =mysqli_connect($server,$username,$password);
    mysqli_select_db($con,'xchange');
    if(!$con){  
        die("connection failed".mysqli_connect_error());
    }
    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql= "select * from `xchange`.`users` where email='$email' and password='$password'";
    $result=mysqli_query($con,$sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        $_SESSION['user']=$email;
        header("location:homepage.php");
    }
    else{
        header("location:login.html");
    }
    $con->close();
}
?>
<!DOCTYPE HTML>
<HTML>

<HEAD>
  <meta charset="utf-8" />
  <meta name="google-signin-client_id" content="816113890648-6q8kj55n8v70vk8tv48ljjk33119ob7i.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <TITLE>LOG IN</TITLE>
<link rel="stylesheet" href="./../css/login.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/ecb3b10b27.js" crossorigin="anonymous"></script>
  <script defer src="login.js"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      ;

    }

    body {
      background: url(../css/img/bms.jpg) no-repeat center center fixed;
      background-size: cover;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    .container {
      display: flex;
      position: absolute;
      top: 17%;
      left: 34%;
      flex-direction: column;
    }

    .container h1 {
      font-size: 40px;
      border-bottom: 4px solid #595336;
      margin-bottom: 10px;
      padding: 10px;
      background-color: #9fab9d85;
    }

    .box {
      background-color: #9da99d45;
      width: 93%;
      margin-top: 10px;
      padding: 10px;
      margin-right: 10px;
      overflow: none;
      border-bottom: 2px solid #595336;
    }

    .box input {
      background: none;
      width: 85%;
      border: none;
      outline: none;
      font-size: 20px;
      color: black;
      float: right;
    }

    .btn {
      color: black;
      font-size: 16px;
      background: none;
      cursor: pointer;
      outline: none;
      left: 20%;
      width: 25%;
      margin: 9px;
      padding: 7px;
      border-bottom: 2px solid #595336;
      border-radius: 10px;
      font-weight: lighter;
    }

    .btn:hover {
      font-weight: bolder;
      font-size: 18px;
      background-color: #e7e7e7;
    }

    label {
      margin: 10px;
      font-size: 20px;
      font-weight: bold;
    }

    #or {
      display: block;
      text-align: center;
      font-weight: bold;
      font-size: large;
    }

    .psw {
      padding-top: 10px;
      float: right;
      text-decoration: none;
      font-weight: bold;
    }

    .psw1 {
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</HEAD>
<BODY background="../css/img/bms.jpg" id="background">
  <form id='lform' name="lform" action='' method="POST">    
    <div class="container">
      <h1>Sign In to BMS Xchange</h1>
      <div class="box">
        <label for="email"><i class="fas fa-envelope"></i></label>
        <input type="email" required name="email" id="email" placeholder="Enter your email">
      </div>
      <div class="box">
        <label for="password"><i class="fas fa-key"></i></label>
        <input type="password" required name="password" id="password" placeholder="Enter your password">
      </div>
      <div>
        <button type="submit" class="btn">Sign In</a></button>
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div>
      <span class="psw1">New User?<a href="signup.php">Signup here</a></span>
      <p id="or">Or</p>
      <div class="g-signin2" data-onsuccess="onSignIn"><a href="./homepage.php"></a></div>
      <div id="content"></div>
      <a href="#" onclick="signOut();">Sign out</a>
    </div>  
  </form>
</BODY>
<script>
  function onSignIn(googleUser){
    console.log("user is "+JSON.stringify(googleUser.getBasicProfile()))
    var element=document.querySelector('#content');
    element.innerText=googleUser.getBasicProfile().getName();
    var image=document.createElement('img');
    image.setAttribute('src',googleUser.getBasicProfile().getImageUrl());
    element.append(image)
  }
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>
</HTML>
