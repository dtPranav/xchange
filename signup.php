<?php
    $exists=false;
    $sub=false;
    if(isset($_POST['name'])){
    session_start();
    $server="localhost";
    $username='root';
    $password="";
    $con =mysqli_connect($server,$username,$password);
    mysqli_select_db($con,'Items');
    if(!$con){
        die("connection failed".mysqli_connect_error());
    }
    $username=$_POST['name'];
    $email=$_POST['email'];
    $usn = $_POST['usn'];
    $password=$_POST['password1'];
    $sql= "select * from `Items`.`users` where email='$email';";
    $result=mysqli_query($con,$sql);
    $num=mysqli_num_rows($result);
    if($num>=1){
        $exists=true;
        echo "User already exists";


    }
    else{
        $reg="insert into `Items`.`users` values('$email','$username','$password','$usn');";
        if($con->query($reg)=="TRUE"){
            $sub = true;
        }
        //mysqli_query($con,$reg);

        
    }
    $con->close();
}
?>
<!DOCTYPE HTML>


<HEAD>
    <meta charset="utf-8" />
    <TITLE>Sign Up</TITLE>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ecb3b10b27.js" crossorigin="anonymous"></script>
<style>
    *{
    margin: 0;
    padding : 0;
    font-family: 'Poppins', sans-serif;;

}
body{
    background: url(../css/img/bms.jpg) no-repeat center center fixed;
    background-size: cover;
}
form{
    display: flex;
    flex-direction: column;
    flex-flow: column;
}
.container{
    display:flex;
    position: absolute;
    top: 16%;
    left: 36%;
    flex-direction: column;
}
.container h1{
    font-size: 40px;
    border-bottom:4px solid #595336 ;
    margin-bottom: 10px;
    padding:10px;
    background-color: #9fab9d85;
}
.box {
    background-color:#9da99d45;
    width: 98%;
    margin-top: 10px;
    padding: 10px;
    margin-right: 10px;
    overflow: none ;
    border-bottom: 2px solid #595336;
}
.box input{
    background:none;
    width: 55%;
    border:none;
    outline: none;
    font-size:20px;
    color:black;    
    float:right;
}
.btn{
    color:black ;
    font-size: 16px;
    background: none;
    cursor: pointer;
    outline: none;
    left: 20%;
    width:25%;
    margin:9px;
    padding: 7px;
    border-bottom: 2px solid #595336 ;
    border-radius:10px;
    font-weight: lighter;
}
.btn:hover{
    font-weight: bolder;
    font-size:18px;
}
label{
    margin:8px;
    font-size: 16px;
    font-weight: bold;
}
span{
    font-weight: bold;
}
p{
    font-weight: bold;
    margin:auto;
}
.submes{
    align-items: center;
    color:red;
}
</style>
</HEAD>

<BODY style = "background-image: url(https://bmsce.ac.in/assets/img/Library/Library-10.jpg);" id="background">
    <form onsubmit="return validateform()" id='sform' name="sform" action='signup.php' method="POST">
        <div class="container">
            <h1>Sign Up</h1>
        <?php 
            if($sub==true){
            echo "<p class='submes'> Registered Successfully </p>";
                $sub=false;
        }
            if ($exists==true){
            echo "<p class='submes'> User Already Exists </p>";
            $exists=false;
            }
        ?>
            <div class="box">
                <label for="name">User Name</label>
                <input type="text" name="name" id="name" required placeholder="Enter your name">
            </div>
            <div class="box">
                <label for="email">User id :</label>
                <input type="email" name="email" id="email" required placeholder="Enter your email">       </div>
                <div class="box">
                <label for="email">USN :</label>
                <input type="text" name="usn" id="usn" pattern = "1BM1[7-9][A-Z]{2}[0-9]{3}" required placeholder="Enter usn">       </div>
            <div class="box">
                <label for="password1">Password :</label>
                <input type="password" name="password1" id="password1" required placeholder="Enter your password">
            </div>
            <div class="box">
                <label for="password2">Confirm Password :</label>
                <input type="password" name="password2" id="password2" required placeholder="Enter your password">
            </div>
            <div>
                <input type="checkbox" name="confirm" required id="confirm"><span> I agree to all terms and conditions</span>
            </div>
            <div>
                <button type="submit" class="btn">Sign Up</button>
            </div>
            <span class="error"></span>
        </form>
            <div>
                <p>
                    Already have an Account? <a href="login1.php">Log In</a>
                </p>
            </div>              
        </div>
</BODY>
<script>
    function validate(id,error){
        element=document.getElementById(id);
        element=document.getElementsByClassName("error").innerText=error;
        // return false;
    }
    function validateform(){
        element=document.getElementsByClassName("error").innerHTML="byeee";
        var returnval=false;
        var email=document.getElementById("email".value);
        var p1=document.getElementById("password1");
        var p2=document.getElementById("password2");
        var conf=document.getElementById("confirm")
        if(p1.value!=p2.value){
            alert("password is not matching");
            returnval=false;
        }
        if(p1.value.length<8){
            returnval=false;
            validate("password1","too short password");
        }
        if(email.length>15){
            validate("email","too long email");
            returnval=false;
        }
        return returnval;
    }
</script>
</HTML>