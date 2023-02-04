var current_url = '';

window.onload = function() {

  let xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function() { 
    if( xhr.readyState == 4 && xhr.status == 200 ) {
      updatePage(xhr);
    }
  }

  // Set URL query
  const urlPar = new URLSearchParams(window.location.search);
  const search = urlPar.get('search') ? urlPar.get('search') : '';
  const page = urlPar.get('page') ? urlPar.get('page') : 1;

  url = "./js/ajax/search.php?" + "search=" + search + "&page=" + page;
  current_url = url;

  xhr.open("GET", url, true);
  xhr.send();
}

shortPoll();

function shortPoll() {
  let xhr = new XMLHttpRequest();

  xhr.timeout = 3000;
  xhr.onload = function() {
    if( xhr.readyState == 4 && xhr.status == 200 ) {
      updatePagePoll(xhr);
    }
  }

  xhr.open("GET", current_url, true);
  xhr.send();

  setTimeout(shortPoll, 3000);
}

function updatePagePoll(xhr) {
  let card_container = document.querySelector('.card_container');
  let pagination = document.querySelector('.pagination');

  let result = JSON.parse(xhr.responseText);

  card_container.innerHTML = "<h2>Tidak menemukan hasil pencarian</h2>";
  pagination.innerHTML = "";
  if (result[0] !== "") {
    card_container.innerHTML = result[0];
    pagination.innerHTML = result[1];
  }

  generatePaginationPoll();
}

function updatePage(xhr) {
  let card_container = document.querySelector('.card_container');
  let pagination = document.querySelector('.pagination');

  let result = JSON.parse(xhr.responseText);

  card_container.innerHTML = "<h2>Tidak menemukan hasil pencarian</h2>";
  document.getElementById('search-input').value = result[2];
  pagination.innerHTML = "";
  if (result[0] !== "") {
    card_container.innerHTML = result[0];
    pagination.innerHTML = result[1];
  }

  generatePagination();
}

function generatePagination() {
  let page_total = document.querySelectorAll('.page');
  page_total.forEach((p) => {
    
    p.addEventListener('click', function() {

      let xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() { 
        if( xhr.readyState == 4 && xhr.status == 200 ) {

          let card_container = document.querySelector('.card_container');

          let pagination = document.querySelector('.pagination');

          let result = JSON.parse(xhr.responseText);

          card_container.innerHTML = result[0];
          pagination.innerHTML = result[1];
          document.getElementById('search-input').value = result[2];

          generatePagination();
        }
      }

      const urlPar = new URLSearchParams(window.location.search);
      const search = urlPar.get('search') ? urlPar.get('search') : '';
      const page = p.getAttribute('page');

      url = "./js/ajax/search.php?" + "search=" + search + "&page=" + page;
      current_url = url;

      xhr.open("GET", current_url, true);
      xhr.send();
    });
  });
}


function generatePaginationPoll() {
  let page_total = document.querySelectorAll('.page');
  page_total.forEach((p) => {
    
    p.addEventListener('click', function() {

      let xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() { 
        if( xhr.readyState == 4 && xhr.status == 200 ) {

          let card_container = document.querySelector('.card_container');

          let pagination = document.querySelector('.pagination');

          let result = JSON.parse(xhr.responseText);

          card_container.innerHTML = result[0];
          pagination.innerHTML = result[1];

          generatePaginationPoll();
        }
      }

      const urlPar = new URLSearchParams(window.location.search);
      const search = urlPar.get('search') ? urlPar.get('search') : '';
      const page = p.getAttribute('page');

      url = "./js/ajax/search.php?" + "search=" + search + "&page=" + page;
      current_url = url;

      xhr.open("GET", current_url, true);
      xhr.send();
    });
  });
}