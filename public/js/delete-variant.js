let deleteButton = document.getElementById("delete-btn");

deleteButton.addEventListener("click", function() {
  let xhr = new XMLHttpRequest();

  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const itemId = urlParams.get('item_id');

  xhr.onreadystatechange = function() { 
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log(itemId);
        location.href = 'dashboard-admin.php';
      }
    }
    url = "js/ajax/delete-variant.php?item_id=" + itemId;

    xhr.open("GET", url, true);
    xhr.send();

  });

  