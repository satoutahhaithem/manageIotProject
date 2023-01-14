$(document).ready(function () {
  // Send Search Text to the server
  $("#filter").on("change", function () {
    let searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: "action_date.php",
        method: "post",
        data: {
          query: searchText,
        },
        success: function (response) {
          $(".boxes").html(response);
        },
      });
    } else {
      $("#boxes").html("<h1>No result</h1>");
    }
  });

  $("#filter1").on("change", function () {
    let searchText1 = $(this).val();
    if (searchText1 != "") {
      $.ajax({
        url: "action_etat.php",
        method: "post",
        data: {
          query1: searchText1,
        },
        success: function (response) {
          $(".boxes").html(response);
        },
      });
    } else {
      $("#boxes").html("<h1>No result</h1>");
    }
  });
  // Set searched text in input field on click of search button
});
<<<<<<< HEAD
=======

// Get first n elements

// var composants = [];

>>>>>>> 20f3bca596211154078c13231222d34652f1784d
