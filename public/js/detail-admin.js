shortPoll();


function shortPoll() {
  let xhr = new XMLHttpRequest();

  xhr.timeout = 3000;
  xhr.onload = function() {
    let result = JSON.parse(xhr.responseText);
    
    updatePage(result);
  }

  const urlParams = new URLSearchParams(window.location.search);
  const itemId = urlParams.get('item_id');
  
  const url = `./js/ajax/detail.php?item_id=${itemId}`;

  xhr.open('GET', url, true);
  xhr.send();

  setTimeout(shortPoll, 10000);
}


function updatePage(result) {
  document.getElementById('product-title').innerHTML = result.name;
  document.getElementById('product-sold').innerHTML = `Sold: ${result.sold_qty} items | Stock: ${result.available_qty}`;
  document.getElementById('product-price').innerHTML = result.price;
  document.getElementById('product-availability').innerHTML = '<strong>Availability:</strong> ' + result.availability;
  document.getElementById('product-id').innerHTML = "<strong>Product ID:</strong> #" + result.id;
  document.getElementById('product-desc').innerHTML = result.description;
}