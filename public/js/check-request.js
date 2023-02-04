var current_items_count = 0;

window.onload = function() {
  let xhr = new XMLHttpRequest();

  xhr.timeout = 3000;
  xhr.onload = function() {
    // console.log(xhr.response);
    let result = JSON.parse(xhr.responseText);
    result[0] = JSON.parse(result[0]);

    console.log(result[0]);
    
    updatePage(result[0], result[1]);
  }

  const url = `./js/ajax/check-request.php`;

  xhr.open('GET', url, true);
  xhr.send();
}

shortPoll();

function shortPoll() {
  let xhr = new XMLHttpRequest();

  xhr.timeout = 3000;
  xhr.onload = function() {
    let result = JSON.parse(xhr.responseText);
    result[0] = JSON.parse(result[0]);
    
    updatePage(result[0], result[1]);
  }

  const url = `./js/ajax/check-request.php`;

  xhr.open('GET', url, true);
  xhr.send();

  setTimeout(shortPoll, 3000);
}

function updatePage(items, result) {
  let items_container = document.querySelector('.items-container');
  current_items_count = items.length;
  console.log(items.length);

  if (result !== '') {
    items_container.innerHTML = result;
  } else {
    items_container.innerHTML = '<h2>You have no requests</h2>';
  }
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