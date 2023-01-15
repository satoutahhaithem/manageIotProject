$(document).ready(function () {
  $.datepicker.setDefaults({
    dateFormat: "yy-mm-dd",
  });
  $(function () {
    $("#fromDate").datepicker();
    $("#toDate").datepicker();
  });
  $("#filter1").click(function () {
    console.log("la valeur");
    var fromDate = $("#fromDate").val();
    var toDate = $("#toDate").val();
    console.log("la valeur" + from);
    console.log(to);
    if (from != "" && to != "") {
      $.ajax({
        url: "action.php",
        method: "POST",
        data: { from: from, to: to },
        success: function (data) {
          $("#boxes").html(data);
        },
      });
    } else {
      alert("HELLO");
    }
  });
});
