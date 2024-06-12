<?php 
include 'signed.php';
$login=0;
$select_user = mysqli_query($con, "SELECT * FROM `registration`");
        session_start();
        if(!isset($_SESSION['username'])){
          header('location:login.php');
        }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Main Page</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <?php include 'header.php';?>
        <div class="wrapper">
        <div id="mainbody">
        <div class="product_body">
            <img src="img/avatar_img.png" width=300px height=300px>
            <div class="product_right">
            <h2><?php echo $_SESSION['username']; ?></h2>
            <hr>
            <div class="product_desc">
            <div>
                <h5>ПІБ:</h5>
                <h2><?php echo $_SESSION['full_name']; ?></h2>
            </div>
            <div>
            <a href="admin.php">Панель адміна</a>
            </div>
            <a href="logout.php">Вийти з аккаунту</a>
            </div>    
            </div>
        </div>
        </div>
        </div>
        <?php include 'footer.php';?>
    </body>
    <script src="js/script.js"></script>
</html>