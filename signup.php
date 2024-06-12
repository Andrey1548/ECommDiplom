<?php
$success=0;
$user=0;

session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'signed.php';
    $username=filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $full_name=filter_var($_POST['full_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $age=filter_var($_POST['age'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender=filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email=filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password=filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cpassword=filter_var($_POST['cpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $role=filter_var($_POST['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $sql="Select * from `registration` where username='$username'";
    $result=mysqli_query($con,$sql);

    //$statement = $con->prepare("SELECT * FROM `registration` WHERE username='$username'");
    //$statement->execute();
    //$resultSet = $statement->get_result();
    //$res = $resultSet->fetchAll(PDO::FETCH_ASSOC);
    //$get_username = $res->rowcount();

    if($result){
        $num=mysqli_num_rows($result);
        if($num>0){
            $user=1;
        }else{
            $sql="insert into `registration`(username, full_name, age, gender, email, password, cpassword, role)
            values('$username','$full_name','$age','$gender','$email','$hash_password','$hash_password','$role')";
            $result=mysqli_query($con,$sql);
            if($result){
                $success=1;
            }else{
                die(mysqli_error($con));
            }
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
            <h1 class="headtext">Створення вашого аккаунту:</h1>
            <?php
            if($user){
                echo '<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Помилка!</h4><p>Вибачте, однак, нікнейм користувача, який ви ввели, вже існує в іншого користувача платформи! Будь ласка, змініть своє нікнейм і спробуйте ще раз зареєструватися!</p></div>';
            }
            if($success){
                echo '<div class="alert alert-success" role="alert"><h4 class="alert-heading">Ваш обліковий запис створен!</h4><p>Тепер ви можете увійти до свого облікового запису на сторінці входу. Вдалої вам покупки!</p></div>';
            }
            ?>    
            <form action="signup.php" method="post">
                    <div> 
                        <h5>Ім'я користувача:</h5>
                        <input type="name" name="username" class="email" placeholder="Ім'я користувача..." required>
                    </div>
                    <div>
                        <h5>ПІБ:</h5>
                        <input type="name" name="full_name" class="email" placeholder="ПІБ..." required>
                    </div>
                    <div>
                        <h5>Вік:</h5>
                        <input type="number" name="age" class="email">
                    </div>
                    <div>
                        <h5>Стать:</h5>
                        <input type="radio" name="gender" class="form-radio" required>Чоловік
                        <div>
                        <input type="radio" name="gender" class="form-radio" required>Жінка
                        </div>
                    </div>
                    <div>
                        <h5>Email:</h5>
                        <input type="email" name="email" class="email" placeholder="Email..." required>
                    </div>
                    <div>
                        <h5>Пароль:</h5>
                        <input type="password" name="password" class="email" placeholder="Пароль..." required>
                        <div>
                        <input type="password" name="cpassword" class="email" placeholder="Повторити пароль..." required>
                        </div>
                        <input type="hidden" class="hide" name="role" value="user">
                    </div>
                    <div>
                        <input type="submit" class="mbutton" href="index.html" value="Зареєструватися!">
                    </div>
                </form>
            </div>
        </div>
        </div>
        <?php include 'footer.php';?>
    </body>
    <script type="text/javascript" src="js/script.js"></script>
</html>