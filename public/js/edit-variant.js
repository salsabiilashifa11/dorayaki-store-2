window.onload = function() {
  let xhr = new XMLHttpRequest();

  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const itemId = urlParams.get('item_id');

  xhr.onreadystatechange = function() { 
    if (xhr.readyState == 4 && xhr.status == 200) {
      let result = JSON.parse(xhr.responseText);

      updatePage(result);
    }
  }
    url = "js/ajax/detail.php?item_id=" + itemId;

    xhr.open("GET", url, true);
    xhr.send();
}

function updatePage(result) {
  document.getElementById('item-id').value = result.id;
  document.getElementsByName('name')[0].value = result.name;
  document.getElementsByName('detail')[0].value = result.description;
  document.getElementsByName('price')[0].value = result.price;
  document.getElementById('picture').src = `./img/${result.img}`;
}
  