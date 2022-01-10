function AccountLockNotification() {
  alert("Your account is currently locked, please contact support to get more information.");
}
function addCart(id) {
  $.post("CartProcess.php?",{'productID':id}, function(data, status){
    var result = data.split("-");

    $("#cart_amount").text(result[0]);
  });
  $('.toast').toast({delay:1500});
  $('.toast').toast('show');
}

function removeItem(id) {
  $.post("CartProcess.php?",{'removeID':id}, function(data, status){ 
  });

  $('.toast').toast({delay:1500});
  $('.toast').toast('show');
  window.open('cart.php','_self')
}

var total = 0;
var itemPrice = document.getElementsByClassName('iprice');
var itemQuantity = document.getElementsByClassName('iquantity');
var itemGroupTotal = document.getElementsByClassName('itotal');
var productID = document.getElementsByClassName('pID');
var grandTotal = document.getElementById('total');

var btndecrease = document.getElementsByClassName('btn-dec');
var btnincrease = document.getElementsByClassName('btn-inc');

function subTotal() {
  total = 0;
  for(i = 0; i<itemPrice.length; i++) {
    var nSubtotal = (itemPrice[i].value)*(itemQuantity[i].value);
    itemGroupTotal[i].innerText = new Intl.NumberFormat().format(nSubtotal);
    total = total + nSubtotal;
    $.post("CartProcess.php?",{'updateID':productID[i].value, 'quantity':itemQuantity[i].value}, function(data, status){
      document.getElementById('cart_amount').innerText = data;
    });
  }
  grandTotal.innerText=new Intl.NumberFormat().format(total);
}

for (let i = 0; i < btnincrease.length; i++) {
  btnincrease[i].addEventListener("click", function() {
    increase(i);
  }, false);
}
for (let i = 0; i < btndecrease.length; i++) {
  btndecrease[i].addEventListener("click", function() {
    decrease(i);
  }, false);
}

function increase(i) {
  var num = parseInt(itemQuantity[i].value);
  num++;
  itemQuantity[i].value = num;
  subTotal();
}
function decrease(i) {
  var num = parseInt(itemQuantity[i].value);
  num--;
  if(num == 0) {
    itemQuantity[i].value = 1;
  }
  else {
    itemQuantity[i].value = num;
  }
  subTotal();
}

