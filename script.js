$(document).ready(function () {
  // Send Search Text to the server
  $("#search").keyup(function () {
    let searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: "action.php",
        method: "post",
        data: {
          query: searchText,
        },
        success: function (response) {
          $(".boxes").html(response);
        },
      });
    } else {
      $("#show-list").html("<h1>haiuthe</h1>");
    }
  });
  // Set searched text in input field on click of search button
  $(document).on("click", "a", function () {
    $("#search").val($(this).text());
    $("#show-list").html("");
  });
});
