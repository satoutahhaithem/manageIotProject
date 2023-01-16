$(document).ready(function () {
  // Send Search Text to the server
  $("#btn-search").on("click", function () {
    let searchText = $("#filter").val();
    console.log(seachText);
    let searchText1 = $("#filter1").val();
    if (searchText != "" || searchText1 != "") {
      $.ajax({
        url: "action_all.php",
        method: "post",
        data: {
          query: searchText,
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

  // $("#filter1").on("change", function () {
  //   let searchText1 = $(this).val();
  //   if (searchText1 != "") {
  //     $.ajax({
  //       url: "action_all.php",
  //       method: "post",
  //       data: {
  //         query1: searchText1,
  //       },
  //       success: function (response) {
  //         $(".boxes").html(response);
  //       },
  //     });
  //   } else {
  //     $("#boxes").html("<h1>No result</h1>");
  //   }
  // });
  // Set searched text in input field on click of search button
});
