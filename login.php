<?php
$login=0;
$invalid=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'signed.php';
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="Select * from `registration` where username='$username' and password='$password'";

    $result=mysqli_query($con,$sql);

    if($result){
        $num=mysqli_num_rows($result);
        $row=mysqli_fetch_array($result, MYSQLI_ASSOC); 
        $hash_password = $row['password'];
        if($num>0 || password_verify($password, $hash_password)){
            $login=1;
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
            session_start();
            $_SESSION['username']=$username;
            $_SESSION['full_name']=$full_name;
            header('location:account.php');
        }else{
            $invalid=1;
        }
    }
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
            <h1 class="headtext">Увійти в свій аккаунт:</h1>
            <?php
            if($invalid){
                echo '<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Помилка!</h4><p>Вибачте, однак, нікнейм користувача, який ви ввели, вже існує в іншого користувача платформи! Будь ласка, змініть своє нікнейм і спробуйте ще раз зареєструватися!</p></div>';
            }
            if($login){
                echo '<div class="alert alert-success" role="alert"><h4 class="alert-heading">Ваш обліковий запис створен!</h4><p>Вибачте, однак, нікнейм користувача, який ви ввели, вже існує в іншого користувача платформи! Будь ласка, змініть своє нікнейм і спробуйте ще раз зареєструватися!</p></div>';
            }
            ?> 
            <form action="login.php" method="post">
                <div>
                    <input type="name" name="username" class="email" placeholder="Нікнейм..." required>
                </div>
                <div>
                    <input type="password" name="password" class="email" placeholder="Пароль..." required>
                </div>
                <div>
                    <button class="mbutton">Увійти</button>
                </div>
                <div>
                    <a href="signup.php">Немає облікового запису? Зареєструйтесь тут!</a>
                </div>
            </form>
        </div>
        </div>
        <?php include 'footer.php';?>
    </body>
    <script type="text/javascript" src="js/script.js"></script>
</html>