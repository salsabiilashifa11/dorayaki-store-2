
// let addVariantButton = document.getElementById("submit");
// let feedbackMessage = document.getElementById("add-message");

window.onload = function() {
  let xhr = new XMLHttpRequest();

  xhr.timeout = 3000;
  xhr.onload = function() {
    // console.log(xhr.responseText);
    let result = JSON.parse(xhr.responseText);
    result[0] = JSON.parse(result[0]);

    console.log(result[0]);
    
    updatePage(result[0], result[1]);
  }

  const url = `./js/ajax/new-add-variant.php`;

  xhr.open('GET', url, true);
  xhr.send();
}

function updatePage(items, result) {
  let items_container = document.querySelector('.items-container');
  current_items_count = items.length;
  console.log(items.length);

  if (result !== '') {
    items_container.innerHTML = result;
  } else {
    items_container.innerHTML = '<h2>No options</h2>';
  }
}



// addVariantButton.addEventListener("click", function() {
//   let xhr = new XMLHttpRequest();

//   xhr.onreadystatechange = function() { 
//     if (xhr.readyState == 4 && xhr.status == 200) {
//       if (xhr.responseText === "true") {
//         feedbackMessage.style.color = "#00FF00";
//         feedbackMessage.innerHTML = "Variant successfully added!";
//       } else {
//         feedbackMessage.style.color = "#FF0000";
//         feedbackMessage.innerHTML = "Failed to add variant";
//       }

//     }
//   }

//   let formResult = document.getElementById("add-variant-form");
//   let variantName = formResult.elements[1].value;
//   let variantDetail = formResult.elements[2].value;
//   let variantPrice = formResult.elements[3].value;
//   let variantStock = formResult.elements[4].value;
//   let variantImage = formResult.elements[6].value;
//   //1, 2, 3, 4, 6

//   url = "js/ajax/add-variant.php";

//   console.log(variantImage);
//   xhr.open("POST", url, true);
//   xhr.send("name=" + variantName + "&description=" + variantDetail + 
//   "&price=" + variantPrice + "&available_qty=" + variantStock + "&img=/" + variantImage);
// });

