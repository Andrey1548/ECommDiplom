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
            <img src="img/Кофемашини/1.jpeg" width=400px height=400px>
            <div class="product_right">
            <h2>Кофемашина De Longhi ESAM 2200 S</h2>
            <hr>
            <span class="price">5800 грн</span>
            <div class="btn_page">
            <i class="add" id="cart-icon"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAPFJREFUSEvNlMsRwjAMRDedQCfQCVyhCKAIuIZOoBPoBLKMNeM4lqWJMYOuVvZp9UmHxtE11sdPAa/g5gngCuD0DXexAwGI7hrAvRaSa9EGQB/ECamKHGAB4BFUq11oQ6YDOpkbnOOSH2uA2MUciAmg6G2Yw0pRl8LSxZD0o2xh6Q5k2DmGBWB76KJ4aLk2aQXFTnhDW6nKuuTDkEi7Vn4MoDghn7AA2rBLLRppWgBt2Bpg1B6PA+Zwk7hRnpgcpscBhdNZ5GD8b01+LV6Ap/psjhdwBrADcAGwT5RKb+YWiVa8hmlRpTc3oLmD5jP4X8AbhMAsGbcojrsAAAAASUVORK5CYII="/>Додати в кошик</i>
            </div>
            <div class="product_desc">
                <h2>Опис:</h2>
                <hr>
                <p>Повністю автоматична кавоварка DeLonghi Magnifica ESAM 2200S (Делонги Магніфіка) готує не тільки гарні кавові напої, але й забезпечена всіма необхідними функціями для комфортного використання.  Серед інших моделей кавоварки виділяється рядом особливостей. Блок заварювання у кавоварки знімний - це сприяє його легкому очищенню при обслуговуванні.   Система збивання молока є капучинатором, який поєднує в собі пару, молоко і повітря для приготування молочної піни.  Якісний помел кавових зерен гарантує кавомолка з 14 градаціями ступеня помелу. Крім цього, кавоварка може готувати еспресо і з попередньо меленої кави. Для підтримки постійної температури посуду кофемашина оснащена платформою для зберігання чашок з пасивним підігрівом.   Нова безшумна кавомолка з 13-ма ступенями помелу. Змінний ступінь помелу. Кількість води, що змінюється в каві. Електронний контроль температури. Попереднє замочування кави. Автоматичне вимкнення.   Індикатор наповнення води та кави. Резервуар для води (1.8 л.). Підігрів чашок. Знімний піддон. Новий запатентований термоблок. Зроблено в Італії.</p>
            </div>    
            </div>
        </div>
        <div class="comment_box">
            <h4 class="vidguk">Залиште свій відгук:</h4>
            <hr>
            <form class="comment_form">
                <div class="comment-session">
                <div class="comment-list">
                <img class="avatar" src="img/avatar_img.png" width=100px height=100px>
                <div class="flex">
                    <div class="user">
                    <div class="user-meta">
                    <?php 
                    if($loged){
                        echo '<h2>User</h2>';
                    } ?>
                    </div>
                    </div>
                </div>
                </div>
                <textarea cols="50" rows="10" placeholder="Write a Comment..."></textarea>
                <button class="comment_btn" type="submit">Post</button>
            </form>
        </div>
        <div class="comment_box">
            <h2>Коментарі:</h2>
            <hr>
            <div class="comment_profile">
                <img class="avatar" src="img/avatar_img.png" width=100px height=100px>
            </div>
        </div>
        </div>
        </div>
        <?php include 'footer.php';?>
    </body>
    <script src="js/script.js"></script>
</html>