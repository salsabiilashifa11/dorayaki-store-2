
let addVariantButton = document.getElementById("submit");
let feedbackMessage = document.getElementById("add-message");

addVariantButton.addEventListener("click", function() {
  let xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function() { 
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText === "true") {
        feedbackMessage.style.color = "#00FF00";
        feedbackMessage.innerHTML = "Variant successfully added!";
      } else {
        feedbackMessage.style.color = "#FF0000";
        feedbackMessage.innerHTML = "Failed to add variant";
      }

    }
  }

  let formResult = document.getElementById("add-variant-form");
  let variantName = formResult.elements[1].value;
  let variantDetail = formResult.elements[2].value;
  let variantPrice = formResult.elements[3].value;
  let variantStock = formResult.elements[4].value;
  let variantImage = formResult.elements[6].value;
  //1, 2, 3, 4, 6

  url = "js/ajax/add-variant.php";

  console.log(variantImage);
  xhr.open("POST", url, true);
  xhr.send("name=" + variantName + "&description=" + variantDetail + 
  "&price=" + variantPrice + "&available_qty=" + variantStock + "&img=/" + variantImage);
});

