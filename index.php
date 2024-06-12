<?php

include 'signed.php';

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($con, "INSERT INTO `cart`(name, image, price, quantity) VALUES('$product_name', '$product_image', '$product_price', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
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
            <section>
                <h2>Shop Products</h2>
                <div class="shop-content">
                <?php
      
      $select_products = mysqli_query($con, "SELECT * FROM `products`");
      if(mysqli_num_rows($select_products) > 0){
        while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="product">
            <img src="img/<?php echo $fetch_product['image']; ?>" alt="" width=200px>
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price"><?php echo $fetch_product['price']; ?>$</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <div class="pd2">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            </div>
            <input type="submit" class="add" id="cart-icon" value="Додати в кошик" name="add_to_cart">
         </div>
      </form>
      <?php
         };
      };
      ?>
                </div>
            </section>
        <p face="helvetica" class="hidtext">asdsa укеукеsad sad bdd sfjjhkj sfsfs skjfhsk as dsad asdsadsd a asd asd asdsa sadsadsadsad sadasdasd sa asdsad asdsad sasadsadsadsa sadsad @2024 Kosobutsky Andrey from KPI.</p>
        </div>
        </div>
        <div>
        <?php include 'footer.php';?>
        </div>
    </body>
    <script src="js/script.js"></script>
</html>