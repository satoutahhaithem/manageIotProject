$(document).ready(function () {
  var currentcount = 0;
  var newcount = 6;
  // Send Search Text to the server
  $("#next").on("click", function () {
    currentcount = newcount;
    newcount += 6;
    $("#boxes").load("get_tranche_next.php", {
      currentcount: currentcount,
      newcount: newcount,
    });
    $(".result p").html(currentcount + " - " + newcount);
  });
  $("#previous").on("click", function () {
    currentcount -= 6;
    newcount -= 6;
    if (currentcount < 0 || newcount < 0) {
      newcount = 6;
      currentcount = 0;
    }
    $("#boxes").load("get_tranche_previous.php", {
      currentcount: currentcount,
      newcount: newcount,
    });
    $(".result p").html(currentcount + " - " + newcount);
  });
});
