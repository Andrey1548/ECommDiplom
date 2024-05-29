$(function(){
  $("#includeHeader").load("header_copy.html");
  $("#includeFooter").load("footer.html");
});

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