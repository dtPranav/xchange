<?php
session_start();

include('login.php');
if(!isset($_SESSION['username'])){
   header("Location:login1.php");
}
$_SESSION['it_no'] = $_POST['fname'];

$server = "localhost";
$username = "root";
$password = "";
$con = mysqli_connect($server, $username, $password);
if(!$con){
    die("Connection to this database failed due to " . mysqli_connect_error());
}
$sql = "select Item_name,Seller_name,Item_desc from `Items`.`Seller` where item_id = $_SESSION[it_no];";
$res=mysqli_query($con,$sql);
$count=mysqli_num_rows($res);
if($count>0){
    $row = mysqli_fetch_assoc($res);
    $item_name = $row['Item_name'];
    $seller_name = $row['Seller_name'];
    $item_desc = $row['Item_desc'];
}
$sql1 = "select Username from `Items`.`users` where email = '$_SESSION[username]';";
$res1=mysqli_query($con,$sql1);

$row1 = mysqli_fetch_assoc($res1);
$buyer_name = $row1['Username'];



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background: url(../Images/xchange_bg.jpeg) no-repeat center center fixed;
            background-size: cover;
            overflow: hidden;
        }

        img {
            height: 200px;
            width: 200px;
            border-radius: 10px;
        }

        .cont {
            display: flex;
            background-color: #91b8c66e;
            /* background: url(../css/img/1.jpg) no-repeat center center fixed; */
            background-size: cover;
            /* opacity: 0.7; */
            margin: 25px 0px;
            height: 500px;
            width: 100vw;
            border-radius: 10px;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        .item {
            display: flex;
            flex-direction: row;
            width: 200px;
            height: 200px;
            margin: 2px;
            padding: 2px;
            opacity: 1;
        }

        #item1img {
            height: 250px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            background: none;
            border-bottom-right-radius: 5px;
            border-top-right-radius: 5px;
        }

        #item2img {
            opacity: 1;

            height: 250px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            background: none;
            border-bottom-left-radius: 5px;
            border-top-left-radius: 5px;
        }

        #item1des {
            background-color: #c1bdffdb;
            border-radius: 10px;
            display: flex;
            flex-direction:column;
            opacity: 1;
            z-index: 10;
        }

        #confirm {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #item2des {
            background-color: #c1bdffdb;
            border-radius: 10px;
            display: flex;
            flex-direction:column;
            opacity: 1;

        }

        #confirm button {
            height: 70px;
            width: 180px;
            border-radius: 40px;
        }

        #profile {
            display: inline;
            background-color: white;
            margin: 6px;
            height: 60px;
            width: 60px;
        }

        nav {
            background-color: #91b8c66e;
            ;
            height: 42px;
            padding: 10px 0px;
        }

        button:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        nav p {
            font-size: 40px;
            font-weight: bold;
            display: inline-block;
            left: 33%;
            position: fixed;
        }

        h1 {
            font-size: 20px;
        }

        .previous {
            background-color: #f1f1f1;
            color: black;
        }

        #back {
            text-decoration: none;
            display: inline-block;
            padding: 8px 16px;
            margin: 7px;
        }

        #back:hover {
            background-color: #ddd;
            color: black;
        }

        .round {
            border-radius: 50%;
        }

        #profileicon {
            display: block;
            position: relative;
            left: 94%;
            color: black;
            top: -81%;
        }

        #con {
            display: none;
            padding: 10px;
            flex-flow: column;
            background-color: #079ed46e;
            top: 10px;
            border-radius: 10px;

        }

        #Conf {
            display: none;
            padding: 10 10 20 20;
            margin: 20;
            align-items: center;
            justify-content: center;
            align-self: center;
            font-size: 35px;
            color: #0f7f1e;
            /* position:relative; */
        }

        .container {
            display: flex;
            flex-flow: column;

        }

        #tick {
            display: inline;
            align-self: center;
            height: 50px;
            width: 50px;
        }

        .pro {
            display: flex;
            flex-direction: row;
            background-color: #079dd4f1;
            border-radius:15px;
            width:200px
        }

        .name {
            display: inline-block;
            margin: auto auto;
            font-size: 20px;
            overflow-x: auto;
        }
        .desc{
            display:inline-block;
            
        }
    </style>
    <script src="https://kit.fontawesome.com/ecb3b10b27.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav>
        <a href="Homepage.html" id="back" class="previous round">&#8249;</a>
        <p>
            Welcome to Items Portal
        </p>
        <a href="myaccount.html"><i class="fas fa-user-circle" id="profileicon"></i></a>
    </nav>
    <div class="container">
        <div id="con">
            <img id="tick" src="../tick.png" alt="">
            <p id="Conf">Confirmed !</p>
        </div>
        <div class="cont">
            <div class="item" id="item1img">
                <div class="pro">
                    <img id="profile" src="../css/img/profilepic.webp" alt="">
                     <span class="name"><?php echo $buyer_name ?></span>
                    </div>
                <img class="img-magnifier-container" id="book1" src=""  alt="image">
                </div>
            <div class="item" id="item1des">
            <p class="desc">Name :    </t>No item</p>
            <!-- </br>
            <p class="desc">Category : </t></t>  </p> -->
            </br>
            <p class="desc">Desc :    </p>
            </br>

            </div>
            <div class="item" id="confirm"><button onclick=change()>confirm</button></div>
            <div class="item" id="item2des">
            <p class="desc">Name :    </t><?php echo $item_name ?></p>
            <!-- </br>
            <p class="desc">Category : </t></t></p> -->
            </br>
            <p class="desc">Desc :    <?php echo $item_desc ?></p>
            </br>

            </div>
            <div class="item" id="item2img">
                <div class="pro">
                    <img id="profile" src="../css/img/profilepic.webp" alt="">
                    <span class="name"> <?php echo $seller_name ?></span>
                    </div>
                    <img id="book2" class="img-magnifier-container" src=" echo $row_i1["i_pic"];" alt="">
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var a1 = "false";
    function change() {
        var c1 = document.getElementById("Conf");
        if (a1 == "false") {
            c1.style.display = "block";
            document.getElementById("book1").style.background = "green";
            document.getElementById("con").style.display = "flex";
            a1 = "true";
        }
        else {
            c1.style.display = "none";
            document.getElementById("book1").style.background = "none";
            document.getElementById("con").style.display = "none";
            a1 = "false";
        }
    }
</script>

</html>

