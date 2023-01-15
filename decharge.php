<?php
include "config/db_connection.php";
include "header.php";
if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["promo"]) && isset($_POST["adress"]) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['whyWantProduct']) && isset($_POST["subPorduct"])) {

  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $promo = $_POST["promo"];
  $adress = $_POST["adress"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $whyWantProduct = $_POST["whyWantProduct"];
  $composant = $_POST['prod'];
  $cmp = "";
  foreach ($composant as $cmp1) {
    echo $cmp1;
    $cmp .= $cmp1 . ",";
  }
  // $composant = $_POST["composant"];
  echo "hello1";
  $sql_add = "INSERT INTO iot.reservation(firstName,lastName,promo,adress,email,phone,whyWantProduct,composant) VALUES(:firstName,:lastName,:promo,:adress,:email,:phone,:whyWantProduct,:composant)";
  $statement_add = $connection->prepare($sql_add);
  echo "helo";
  if ($statement_add->execute([':firstName' => $firstName, ':lastName' => $lastName, ':promo' => $promo, ':adress' => $adress, ':email' => $email, ':phone' => $phone, ':whyWantProduct' => $whyWantProduct, ':composant' => $cmp])) {
    $message = "data inserted successfuly";
    echo $message;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['promo'] = $promo;
    $_SESSION['adress'] = $adress;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;
    $_SESSION['whyWantProduct'] = $whyWantProduct;
    $_SESSION['composant'] = $cmp;
    header("Location:rapport.php");
  } else {
    echo "data doesn't inserted";
  }
}



// if (isset($_POST["subPorduct"])) {
//   $composant = $_POST['prod'];
//   $cmp = "";
//   foreach ($composant as $cmp1) {
//     echo $cmp1;
//     $cmp .= $cmp1 . ",";
//   }
//   $sql_addCmp = "INSERT INTO iot.reservation(composant) VALUES(:composant)";
//   $statement_addCmp = $connection->prepare($sql_addCmp);
//   if ($statement_addCmp->execute([':composant' => $cmp])) {
//     $message = "composant inserted successfuly";
//     echo $message;
//     $_SESSION['firstName'] = $firstName;
//     $_SESSION['lastName'] = $lastName;
//     $_SESSION['promo'] = $promo;
//     $_SESSION['adress'] = $adress;
//     $_SESSION['email'] = $email;
//     $_SESSION['phone'] = $phone;
//     $_SESSION['whyWantProduct'] = $whyWantProduct;
//     $_SESSION['composant'] = $cmp;
//     header("Location:rapport.php");
//   } else {
//     $message = "composant doesnt inserted successfuly";
//     echo $message;
//   }
// }


// Get all composants
$sql_get_all = "SELECT nom FROM iot.composant";
$statement_get = $connection->prepare($sql_get_all);
$statement_get->execute();
$composants = $statement_get->fetchAll(PDO::FETCH_OBJ);
?>
<section class="content">
  <!-- modal that contains add form -->
  <div class="update decharge">
    <div class="container">
      <h3>Decharge </h3>
      <div>
        <!-- form reel -->
        <form method="post" id="myform">
          <label for="firstName">Prenom</label>
          <input type="text" id="firstName" name="firstName" />

          <label for="lastName">Nom</label>
          <input type="text" id="lastName" name="lastName" />


          <!-- <div>
            <input type="file" name="uploadfile" />
          </div> -->

          <label class="form-label" for="promo">Promo</label>
          <input type="text" id="promo" name="promo" class="form-control" />

          <label class="form-label" for="adress">Address</label>
          <input type="text" name="adress" id="adress" class="form-control" />

          <label class="form-label" for="email">Email</label>
          <input type="email" id="email" name="email" class="form-control" />

          <label for="composant">Choisir le composant</label>
          <!-- <select name="composant" id="composant">
            <option value="" disabled>Choisir votre etat</option>
            <?php foreach ($composants as $composant) : ?>
              <option value=<?= $composant->nom; ?>>
                <?= $composant->nom; ?>
              </option>
            <?php endforeach; ?>
          </select> -->

          <!-- <form method="post"> -->
          <div class="multiselect">
            <div class="selectBox" onclick="showCheckboxes()">
              <select>
                <option>Choisir un composant</option>
              </select>
              <div class="overSelect"></div>
            </div>
            <div id="checkboxes">
              <?php foreach ($composants as $composant) : ?>
                <label for=<?= $composant->nom; ?>>
                  <input type="checkbox" id=<?= $composant->nom; ?> name="prod[]" value=<?= $composant->nom; ?> />
                  <?= $composant->nom; ?>
                </label>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- </form> -->

          <label class="form-label" for="phone">Phone</label>
          <input type="number" id="phone" name="phone" class="form-control" />

          <label for="whyWantProduct">Motif de reservation</label>
          <textarea id="whyWantProduct" rows="4" name="whyWantProduct"></textarea>

          <input type="submit" value="ajouter composant" name="subPorduct">
          <!-- <input type="submit" value="Reserver"> -->

        </form>

      </div>
    </div>
  </div>
  <script>
    let input = document.getElementById("inputTag");
    let imageName = document.getElementById("imageName")
    $(document).ready(function() {
      $('#ingredients').multiselect();
    });
    input.addEventListener("change", () => {
      let inputImage = document.querySelector("input[type=file]").files[0];

      imageName.innerText = inputImage.name;
    })


    // reservation

    $('#btn').on('click', function() {
      $('#exportContent').text('Hello, my name is ' + $('#firstName').val() + ' ' +
        $('#lastName').val() + ' ' +
        $('#promo').val() + ' ' +
        $('#adress').val() + ' ' +
        $('#email').val() + ' ' +
        $('#phone').val() + ' ' +
        $('#whyWantProduct').val() + ' '
      );
      $("#btnAfficher").show()
    });

    function Export2Word(element, filename = '') {
      var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
      var postHtml = "</body></html>";
      var html = preHtml + document.getElementById(element).innerHTML + postHtml;

      var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
      });

      // Specify link url
      var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);

      // Specify file name
      filename = filename ? filename + '.doc' : 'document.doc';

      // Create download link element
      var downloadLink = document.createElement("a");

      document.body.appendChild(downloadLink);

      if (navigator.msSaveOrOpenBlob) {
        navigator.msSaveOrOpenBlob(blob, filename);
      } else {
        // Create a link to the file
        downloadLink.href = url;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
      }

      document.body.removeChild(downloadLink);
    }
    var expanded = false;

    function showCheckboxes() {
      var checkboxes = document.getElementById("checkboxes");
      if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
      } else {
        checkboxes.style.display = "none";
        expanded = false;
      }
    }
  </script>
</section>
<?php
include "footer.php";
?>