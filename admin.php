<?php
include 'signed.php';
if(isset($_POST['add_product'])){
    $p_name = $_POST['product_name'];
    $p_price = $_POST['product_price'];
    $p_image = $_FILES['product_image']['name'];
    $p_descr = $_POST['product_descr'];
    $p_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $p_image_folder = 'img/'.$p_image;
 
    $insert_query = mysqli_query($con, "INSERT INTO `products`(name, image, price, descr) VALUES('$p_name', '$p_image', '$p_price', '$p_descr')") or die('query failed');
 
    if($insert_query){
       move_uploaded_file($p_image_tmp_name, $p_image_folder);
    }
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($con, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
    if($delete_query){
       header('location:admin.php');
       $message[] = 'product has been deleted';
    }else{
       header('location:admin.php');
       $message[] = 'product could not be deleted';
    };
 };

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_descr = $_POST['update_p_descr'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'img/'.$update_p_image;

   $update_query = mysqli_query($con, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image', descr = '$update_p_descr' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:admin.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:admin.php');
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
        <h1 class="headtext">Додати новий товар:</h1>
            <form action="" method="post" enctype="multipart/form-data">
            <div>
            <input type="text" name="product_name" class="email" placeholder="Ім'я продукту..." required>
            </div>
            <div>
            <input type="number" name="product_price" class="email" placeholder="Ціна продукту..." required>
            </div>
            <input type="file" name="product_image" accept="image/png, image/jpg, image/jpeg" class="email" placeholder="Зображення..." required>
            <div>
            </div>
            <input type="text" name="product_descr" class="email" placeholder="Опис продукту..." required>
            <div>
                <input type="submit" name="add_product" class="mbutton" href="admin.php" value="Додати товар!">
            </div>    
        </form>
        <h1 class="headtext">Список товарів:</h1>
        <section class="display-product-table">

   <table class="admin_t">

      <thead>
         <th class="admin_t1">Зображення продукту</th>
         <th class="admin_t1">Назва продукту</th>
         <th class="admin_t1">Ціна продукту</th>
         <th class="admin_t1">Дія</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($con, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
            <td class="admin_t1"><img src="img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td class="admin_t1"><?php echo $row['name']; ?></td>
            <td class="admin_t1"><?php echo $row['price']; ?>$</td>
            <td class="admin_t1">
               <div>
               <a class="mbutton1" href="admin.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> Видалити </a>
               </div>
               <a id="upd" class="mbutton1" href="admin.php?edit=<?php echo $row['id']; ?>"> <i class="fas fa-edit"></i> Оновити </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>Ви поки що не додали нових продуктів до платформи!</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($con, "SELECT * FROM `products` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <h1 class="headtext">Оновлення товару:</h1>
   <form action="" method="post" enctype="multipart/form-data">
      <img src="img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <div>
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
      </div>
      <input type="text" class="email" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
      <input type="number" min="0" class="email" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
      <input type="file" class="email" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="text" class="email" required name="update_p_descr" value="<?php echo $fetch_edit['descr']; ?>">
      <input type="submit" value="Оновити продукт!" name="update_product" class="mbutton">
      <input type="reset" value="Закрити!" id="close-edit" class="mbutton1">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>
        </div>
    </div>
    <?php include 'footer.php';?>
</body>
<script src="js/script.js"></script>
<script>
document.querySelector('#close-edit').onclick = () =>{
   document.querySelector('.edit-form').style.display = 'none';
   window.location.href = 'admin.php';
};
</script>
</html>