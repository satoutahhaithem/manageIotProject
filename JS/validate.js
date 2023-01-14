var error1 = $(".errors").text();

if (error1 != "") {
  $(".errors").css("display", "block");
}

function logout() {
  window.location.href = "logout.php";
}
