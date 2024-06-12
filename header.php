<?php 
$loged=0;
include 'signed.php';
        if(!isset($_SESSION['username'])){
          $loged=1;
        }

        if(isset($_POST['update_update_btn'])){
          $update_value = $_POST['update_quantity'];
          $update_id = $_POST['update_quantity_id'];
          $update_quantity_query = mysqli_query($con, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
          if($update_quantity_query){
             header('location:index.php');
          };
       };
?>

<?php
      
      $select_rows = mysqli_query($con, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

?>

<?php 
          if(isset($_GET['remove'])){
            $remove_id = $_GET['remove'];
            mysqli_query($con, "DELETE FROM `cart` WHERE id = '$remove_id'");
            header('location:index.php');
         };
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Main Page</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
      <div class="wnav">
        <div class="top">
        <?php 
        if($loged){
          echo '<a href="login.php" class="account"><img src="https://static.vecteezy.com/system/resources/previews/021/079/672/non_2x/user-account-icon-for-your-design-only-free-png.png" width="30"> Увійти/Зареєструватися</a>';
        }
        ?>
        <?php 
        if($loged){
          echo "";
        }else{
          echo '<a href="account.php" class="account"><img src="https://static.vecteezy.com/system/resources/previews/021/079/672/non_2x/user-account-icon-for-your-design-only-free-png.png" width="30">  Ваш профіль</a>';
          echo '<a>Ласкаво просимо, ';
          echo $_SESSION['username'];
          echo '</a>';
        } 
        ?>
        <i class='nav-link' id="cart-button"><span class="quantity"><?php echo $row_count; ?></span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAN9JREFUSEvNlMsRAiEQRN9moploJnrVINQg9LpmoploJrptQRX7g1lWLOcK9KPnV1E4qsL6/BTwcm6ewBU4fcNd6MADvO4auM+FDKVoA9ROXJBZMQRYAA+nOtvFWJHlQE5yQ3Vc6vEYIHSRA0kCJHpr6rDKUW/eHH0XxubAFzuHofTIRXTQctOkGdr6X6Um+eDsTnEhcUE+kQLkuGhppgBTi91Kj8WB7qiT1FGW6A2mxYGELbXQ3uqtFivA8vvBO1bAGdgBF2DfUYqdJbvIa4WrvPup2JkZUNxB8Rr8L+ANp9smGcc+RUkAAAAASUVORK5CYII=" width="30"> Кошик</i>
        </div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Logo</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Головна сторінка</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="about_us.php">Про нас</a>
                  </li>
                </ul>
            </div>
            </div>
          </nav>
        <div class="cart">
            <h2>Ваш кошик:</h2>
            <div class="cart-content">
              <?php 
                       $select_cart = mysqli_query($con, "SELECT * FROM `cart`");
                       $grand_total = 0;
                       if(mysqli_num_rows($select_cart) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($select_cart)){
              ?>
                <div class="cart-box">
                    <img src="img/<?php echo $fetch_cart['image']; ?>" height="100" class="cart-img" width=100px>
                    <div class="detail-box">
                        <div class="cart-product-title"><?php echo $fetch_cart['name']; ?></div>
                        <div class="cart-price"><?php echo $fetch_cart['price']; ?>$</div>
                        <form action="" method="post">
                          <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                          <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                          <input type="submit" value="update" name="update_update_btn">
                        </form> 
                    </div>
                    <div><?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity']; ?></div>
                    <a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class='bx bxs-trash-alt cart-remove'>Видалити</a>
                </div>
                <?php 
                $grand_total += $sub_total; 
                        };
                      };
                ?>
            </div>
            <div class="total">
                <div class="total-title">УСЬОГО:</div>
                <div class="total-price"><?php echo $grand_total; ?>$</div>
            </div>
            <a href="payment.php" class="mbutton">Оплатити</a>
            <i class='bx bx-x' id="close-cart">X</i>
        </div>
      </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            let cartButton = document.querySelector("#cart-button");
            let cart = document.querySelector(".cart");
            let closeCart = document.querySelector("#close-cart");

            cartButton.onclick = () => {
              cart.classList.add("active");
            };

            closeCart.onclick = () => {
              cart.classList.remove("active");
            };

            if (document.readyState == "loading") {
  document.addEventListener("DOMContentLoaded", ready);
} else {
  ready();
}

function ready(){
  var removeCartButtons = document.getElementsByClassName('cart-remove')
  console.log(removeCartButtons)
  for (var i = 0; i < removeCartButtons.length; i++){
    var button = removeCartButtons[i];
    button.addEventListener('click', removeCartItem);
  }
  var quantityInputs = document.getElementsByClassName('cart-quantity')
  for (var i = 0; i < quantityInputs.length; i++){
    var input = quantityInputs[i];
    input.addEventListener("change", quantityChanged);
  }
  var addCart = document.getElementsByClassName("cart-icon");
  for (var i = 0; i < addCart.length; i++) {
    var button = addCart[i];
    button.addEventListener("click", addCartClicked);
  }
  updateTotal();
}

function addCartClicked(event){
    var button = event.target;
    var shopProducts = button.parentElement;
    var title = shopProducts.getElementsByClassName('product-title')[0].innerText;
    var price = shopProducts.getElementsByClassName("price")[0].innerText;
    var productImg = shopProducts.getElementsByClassName("product-img")[0].src;
    addProductToCart(title, price, productImg);
    updateTotal();
}

function addProductToCart(title, price, productImg) {
    var cartShopBox = document.createElement('div');
    cartShopBox.classList.add('cart-box');
    var cartItems = document.getElementsByClassName("cart-content")[0];
    var cartItemsNames = cartItems.getElementsByClassName("cart-product-title");
    for (var i = 0; i < cartItemsNames.length; i++) {
        alert("Ви вже додали цей товар у кошик!");
        return;
    }
}

var cartBoxContent = `  <img src="img/Кофемашини/1.jpeg" width=200px>
                        <h5>Кофемашина De Longhi ESAM 2200 S Б/У</h5>
                        <div class="pd2">
                        <span class="price">5800 грн</span>
                        <i class="add" id="cart-icon"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAPFJREFUSEvNlMsRwjAMRDedQCfQCVyhCKAIuIZOoBPoBLKMNeM4lqWJMYOuVvZp9UmHxtE11sdPAa/g5gngCuD0DXexAwGI7hrAvRaSa9EGQB/ECamKHGAB4BFUq11oQ6YDOpkbnOOSH2uA2MUciAmg6G2Yw0pRl8LSxZD0o2xh6Q5k2DmGBWB76KJ4aLk2aQXFTnhDW6nKuuTDkEi7Vn4MoDghn7AA2rBLLRppWgBt2Bpg1B6PA+Zwk7hRnpgcpscBhdNZ5GD8b01+LV6Ap/psjhdwBrADcAGwT5RKb+YWiVa8hmlRpTc3oLmD5jP4X8AbhMAsGbcojrsAAAAASUVORK5CYII="/>Додати в кошик</i>`;
cartShopBox.innerHTML = cartBoxContent;
cartItems.append(cartShopBox);
cartShopBox
  .getElementsByClassName("cart-remove")[0]
  .addEventListener("click", removeCartItem);
cartShopBox
  .getElementsByClassName("cart-quantity")[0]
  .addEventListener("change", quantityChanged);

function quantityChanged(event){
    var input = event.target;
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    updateTotal();
}

function removeCartItem(event){
  var buttonClicked = event.target;
  buttonClicked.parentElement.remove();
  updateTotal();
}

function updateTotal(){
    var cartContent = document.getElementsByClassName('cart-content')[0];
    var cartBoxes = cartContent.getElementsByClassName('cart-box');
    var total = 0;
    for (var i = 0; i < cartBoxes.length; i++) {
        var cartBox = cartBoxes[i];
        var priceElement = cartBox.getElementsByClassName("cart-price")[0];
        var quantityElement = cartBox.getElementsByClassName("cart-quantity")[0];
        var quantity = quantityElement.value;
        var price = parseFloat(priceElement.innerText.replace("грн", ""));
        total = total + (price * quantity);

        document.getElementsByClassName('total-price')[0].innerText = total + " грн";
    }
}
        </script>
    </body>
</html>