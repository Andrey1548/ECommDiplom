<?php 
include 'signed.php';
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <?php include 'header.php';?>
        <div class="wrapper">
        <div id="mainbody">
            <h1 class="headtext">Форма оформлення оплати:</h1>
            <div class="pay_css">
                <form class="paym_form">
                    <div>
                        <h5>ПІБ:</h5>
                        <input type="name" name="name" id="name" class="email" placeholder="Михайло Михайлович Михайлов" required>
                        <div class="error_text">
                        <small class="text-danger name"></small>
                        </div>
                    </div>
                    <div>
                        <h5>Адреса:</h5>
                        <input type="text" name="address" id="address" class="email" placeholder="вул. Київскька ..." required>
                        <div class="error_text">
                        <small class="text-danger address"></small>
                        </div>
                    </div>
                    <div>
                        <h5>Місто:</h5>
                        <input type="name" name="city" id="city" class="email" placeholder="наприклад: Київ" required>
                        <div class="error_text">
                        <small class="text-danger city"></small>
                        </div>
                    </div>
                    <div>
                        <h5>Електронна адреса:</h5>
                        <input type="email" name="email" id="email" class="email" placeholder="Email..." required>
                        <div class="error_text">
                        <small class="text-danger email"></small>
                        </div>
                    </div>
                    <div>
                        <h5>Область:</h5>
                        <input type="text" name="region" id="region" class="email" placeholder="Київскька область" required>
                        <div class="error_text">
                        <small class="text-danger region"></small>
                        </div>
                        <h5>Поштовий індекс:</h5>
                        <input type="text" name="index" id="index" class="email" placeholder="12345" required>
                        <div class="error_text">
                        <small class="text-danger index"></small>
                        </div>
                    </div>
                </form>
                <div>
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
                    <div id="paypal-button-container"></div>
                    <p id="result-message"></p>
                </div>
            </div>
        </div>
        </div>
        </div>
        <?php include 'footer.php';?>
    </body>
    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AZ8U0sMvx1A0v6IBH3uGnDV12jZDOoM10-fcxb9wGXA8f-kH3SHOu8ELvFkBaQgYMGeSI4D_M0kuOqoj"></script>
    <script>
window.paypal
  .Buttons({
    style: {
      shape: "rect",
      layout: "vertical",
      color: "gold",
      label: "paypal",
    },
    onClick(){
        var name = $('#name').val();
        var address = $('#address').val();
        var city = $('#city').val();
        var email = $('#email').val();
        var region = $('#region').val();
        var index = $('#index').val();
    },

    createOrder: (data, actions) => {
        return actions.order.create({
            purchase_units: [{
              amount: {
                value: '<?= $grand_total ?>'
              }
            }]
        })
      },
      onApprove: (data, actions) => {
        return actions.order.capture().then(function(orderData) {
        //console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
        console.log(orderData);
        const transaction = orderData.purchase_units[0].payments.captures[0];
        
        var name = $('#name').val();
        var address = $('#address').val();
        var city = $('#city').val();
        var email = $('#email').val();
        var region = $('#region').val();
        var index = $('#index').val();

        var data = {
          'name': name,
          'address': address,
          'city': city,
          'email': email,
          'region': region,
          'index': index,
          'payment_mode': "Paid by PayPal",
          'payment_id': transaction.id,
        };
        
        $.ajax({
          method: "POST",
          url: "payment.php",
          data: data,
          success: function(response){
            console.log(response);
            console.log(data);
          }
        });
        alert(`Транзакція ${transaction.status}: ${transaction.id}\n\nТранзакцію було проведено успішно!`);
        });
      }
    }).render("#paypal-button-container"); 
    </script>
    </html>