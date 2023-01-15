$(document).ready(function (e) {
  $("#upload").click(function (e) {
    e.preventDefault();
    var file = $("#image").prop("files")[0];
    var form = new FormData();
    form.append("image", file);
    var name = $("#name").val();
    var quantite = $("#qte").val();
    var date = $("#date").val();
    var etat = $("#etat").val();
    console.log(name);
    console.log(quantite);
    console.log(date);
    console.log(etat);
    $.ajax({
      type: "POST",
      url: "add.php",
      data: {
        name: name,
        quantite: quantite,
        etat: etat,
        date: date,
      },
      //   processData: false,
      //   contentType: false,
      //   cache: false,
      success: function (data, status) {
        console.log(status);
        console.log(data);
      },
      //   error: function (xhr, status, error) {
      //     console.error(xhr);
      //   },
    });
  });
});

// $("#imageButton").change(function () {
//   // Making the image file object
//   var file = $("#image").prop("files")[0];

//   // Making the form object
//   var form = new FormData();

//   // Adding the image to the form
//   form.append("image", file);

//   // The AJAX call
//   $.ajax({
//     url: "upload.php",
//     type: "POST",
//     data: form,
//     contentType: false,
//     processData: false,
//     success: function (result) {
//       document.write(result);
//     },
//   });
// });
