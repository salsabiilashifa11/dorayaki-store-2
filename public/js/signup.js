
let usernameInput = document.getElementById("username");
let usernameError = document.getElementById("username-error");

usernameInput.addEventListener("change", function() {
  let xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function() { 
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText === "true") {
        usernameInput.style.backgroundColor = "#A5FFD4";
        usernameError.innerHTML = "";
      } else {
        usernameInput.style.backgroundColor = "#FFB4C7";
        usernameError.innerHTML = "Username already taken";
      }

      let usernameRegex = /^[a-zA-Z0-9_]+$/;
      if (!usernameRegex.test(usernameInput.value)) {
        usernameInput.style.backgroundColor = "#FFB4C7";
        usernameError.innerHTML = "Username can only contain letters, numbers, and '_'";
      }
    }
  }

  url = "js/ajax/signup.php?username=" + usernameInput.value;

  xhr.open("GET", url, true);
  xhr.send();
});

let emailInput = document.getElementById("email");
let emailError = document.getElementById("email-error");

emailInput.addEventListener("change", function() {
  let xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function() {
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(emailInput.value)) {
        emailInput.style.backgroundColor = "#FFB4C7";
        emailError.innerHTML = "Invalid email address";
      } else {
        emailInput.style.backgroundColor = "#A5FFD4";
        emailError.innerHTML = "";
      }
  }
  url = "js/ajax/signup.php?email=" + emailInput.value;

  xhr.open("GET", url, true);
  xhr.send();
});