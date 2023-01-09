<?php
    session_start();
    $varia = 0;
    if(isset($_POST['email'])){
    $server="localhost";
    $username='root';
    $password="";
    $con =mysqli_connect($server,$username,$password);
    mysqli_select_db($con,'Items');
    if(!$con){
        die("connection failed".mysqli_connect_error());
    }
    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql= "select * from `Items`.`users` where email='$email' and password='$password'";
    $result=mysqli_query($con,$sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        $_SESSION['username']=$email;
        $varia = 1;
        header("location:home2.php");
       
        //echo $_SESSION['username'];
    }
    else{
        header("location:login1.php");
        echo "Invalid credentials";
    }
    $con->close();
}
?>