function usersinfo() {
  let username = document.getElementById("name").value;
  let password = document.getElementById("password").value;
  let email = document.getElementById("password").value;

  let isValid = true;

  if (username === "") {
    document.getElementById("nameErr").textContent = "Username is required.";
    isValid = false;
  } else {
    document.getElementById("nameErr").textContent = "";
  }

  if (email === "") {
    document.getElementById("emailErr").textContent = "Email is required.";
    isValid = false;
  } else {
    document.getElementById("emailErr").textContent = "";
  }

  if (password === "") {
    document.getElementById("passErr").textContent = "Password is required.";
    isValid = false;
  } else if (password.length < 6) {
    document.getElementById("passErr").textContent =
      "Password must be at least 6 characters long.";
    isValid = false;
  } else {
    document.getElementById("passErr").textContent = "";
  }

  return isValid;
}

