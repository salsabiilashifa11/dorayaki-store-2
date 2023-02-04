var current_items_count = 0;

window.onload = function() {
  let xhr = new XMLHttpRequest();

  xhr.timeout = 3000;
  xhr.onload = function() {
    let result = JSON.parse(xhr.responseText);
    result[0] = JSON.parse(result[0]);

    console.log(result[0]);
    
    updatePage(result[0], result[1]);
    cartItemsListener();
  }

  const url = `./js/ajax/cart.php`;

  xhr.open('GET', url, true);
  xhr.send();
}

shortPoll();

function cartItemsListener() {  
  let all_input_qty = document.querySelectorAll('.order-amount-box');
  console.log(document);

  all_input_qty.forEach((input_qty, index) => {
    input_qty.addEventListener('change', function() {
      let new_amount = parseInt(input_qty.value);
      if (new_amount < 0) {
        return;
      }

      let xhr = new XMLHttpRequest();

      url = './js/ajax/change-cart-item.php';
      xhr.open('POST', url, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      
      xhr.onreadystatechange = function() {
        if( xhr.readyState == 4 && xhr.status == 200 ) {
          updateQty();
        }
      }

      xhr.send(`order_cart=${index}&amount=${new_amount}`);
    })
  })

  let all_delete_btn = document.querySelectorAll('.delete-item');

  all_delete_btn.forEach((input_qty, index) => {
    input_qty.addEventListener('click', function() {
      let new_amount = parseInt(input_qty.value);
      if (new_amount < 0) {
        return;
      }

      let xhr = new XMLHttpRequest();

      url = './js/ajax/remove-cart-item.php';
      xhr.open('POST', url, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      
      xhr.onreadystatechange = function() {
        if( xhr.readyState == 4 && xhr.status == 200 ) {
          updateQty();
        }
      }

      xhr.send(`order_cart=${index}&remove=true`);
    })
  })
}


function shortPoll() {
  let xhr = new XMLHttpRequest();

  xhr.timeout = 3000;
  xhr.onload = function() {
    let result = JSON.parse(xhr.responseText);
    result[0] = JSON.parse(result[0]);
    
    updatePage(result[0], result[1]);

    docReady(cartItemsListener());
  }

  const url = `./js/ajax/cart.php`;

  xhr.open('GET', url, true);
  xhr.send();

  setTimeout(shortPoll, 3000);
}

function updateQty() {
  let xhr = new XMLHttpRequest();

  xhr.timeout = 3000;
  xhr.onload = function() {
    let result = JSON.parse(xhr.responseText);
    result[0] = JSON.parse(result[0]);
    if (current_items_count !== result[0].length) {
      console.log(result[0].length);
    }
    
    updatePage(result[0], result[1]);

    docReady(cartItemsListener());
  }

  const url = `./js/ajax/cart.php`;

  xhr.open('GET', url, true);
  xhr.send();
}

function updatePage(items, result) {
  let items_container = document.querySelector('.items-container');
  current_items_count = items.length;
  console.log(items.length);

  if (result !== '') {
    items_container.innerHTML = result;

    totals = calculateTotalCost(items);
    document.getElementById('total-cost').innerHTML = `<p>${totals.totalCost}</p>`;
    document.getElementById('total-items').innerHTML = `<p>${totals.totalQty}</p>`;

  } else {
    items_container.innerHTML = '<h2>Cart is empty. Go buy some dorayaki!</h2>';
  }
}

function calculateTotalCost(items) {
  let totalCost = 0;
  let totalQty = 0;

  for (const item of items) {
    // console.log(item.price);
    totalCost += (parseInt(item.quantity) * parseInt(item.price));
    totalQty += parseInt(item.quantity);
  }

  return {totalCost, totalQty};
}

function docReady(fn) {
  // see if DOM is already available
  if (document.readyState === "complete" || document.readyState === "interactive") {
      // call on next available tick
      setTimeout(fn, 1);
  } else {
      document.addEventListener("DOMContentLoaded", fn);
  }
}    