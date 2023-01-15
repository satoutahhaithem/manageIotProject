<?php
include "config/db_connection.php";
include "header.php";
// get element
$message_update = "";
$id = $_GET['id'];
$sql_get = "SELECT * FROM iot.composant WHERE id_composant=:id";
$statement_get = $connection->prepare($sql_get);
$statement_get->execute([':id' => $id]);
$composant = $statement_get->fetch(PDO::FETCH_OBJ);


//update composant
// if (isset($_POST["name"]) && isset($_POST["qte"]) && isset($_POST["etat"]) && isset($_POST["date"])) {
//   $nom = $_POST["name"];
//   $qte = $_POST["qte"];
//   $etat = $_POST["etat"];
//   $datee = $_POST["date"];
//   $sql_update = "UPDATE iot.composant SET nom=:nom, quantite=:qte, etat=:etat, date_achat=:datee WHERE id_composant=:id";
//   $statement_update = $connection->prepare($sql_update);
//   if ($statement_update->execute([':nom' => $nom, ':qte' => $qte, ':etat' => $etat, ':datee' => $datee, ':id' => $id])) {
//     header("Location:index.php");
//   };
// }
if (isset($_POST['upload'])) {

  // conditions of insertion verification
  // nom

  $nom = $_POST["name"];
  $qte = $_POST["qte"];
  $etat = $_POST["etat"];
  $datee = $_POST["date"];
  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];

  $folder = "image/" . $filename;

  $sql_update = "UPDATE iot.composant SET nom=:nom, quantite=:qte, etat=:etat, date_achat=:datee, image=:filename WHERE id_composant=:id";
  // $sql_add = "INSERT INTO iot.composant(nom,image,quantite,etat,date_achat) VALUES(:nom,:filename,:qte,:etat,:datee)";
  $statement_update = $connection->prepare($sql_update);
  move_uploaded_file($tempname,  $folder);
  if ($statement_update->execute([':nom' => $nom, ':qte' => $qte, ':filename' => $filename, ':etat' => $etat, ':datee' => $datee, ':id' => $id])) {
    $message_update = "updated successfully";
    echo $message_update;
    header("Location:index.php");
  }
}


?>
<section class="content">
  <!-- modal that contains add form -->
  <div class="update">
    <div class="container">
      <h3>Mise a jour d'un element </h3>
      <div>
        <!-- form reel -->
        <form method="post" enctype="multipart/form-data" id="myform" name="foo">
          <label for="name">Nom de Composant</label>
          <input type="text" id="name" name="name" value="<?php echo $composant->nom ?>" placeholder="Entrer le nom du composant, ex:souris .." />

          <label for="qte">Quantite</label>
          <input type="text" id="qte" name="qte" value="<?php echo $composant->quantite ?>" placeholder="Specifier la quantite du composant, ex 18 .." />

          <!-- <div>
            <input type="file" name="uploadfile" />
          </div> -->

          <div class="imgg">
            <label for="inputTag">
              Select Image <br />
              <input id="inputTag" type="file" name="uploadfile" value="C:/xampp/htdocs/project2023/image/attest.PNG" />
              <br />
              <span id="imageName"></span>
            </label>
          </div>
          <label for="etat">Etat</label>
          <select id="etat" name="etat">
            <option value="disponible">Disponible</option>
            <option value="en-pane">En pane</option>
            <option value="perdu">Perdu</option>
          </select>
          <label for="qte">Date d'Achat</label>
          <input type="date" id="date" name="date" value="<?php echo $composant->date_achat ?>" />
          <input type="submit" value="Modifier" name="upload" id="upd" />
        </form>
      </div>
    </div>
  </div>
  <script>
    let input = document.getElementById("inputTag");
    let imageName = document.getElementById("imageName")

    input.addEventListener("change", () => {
      let inputImage = document.querySelector("input[type=file]").files[0];

      imageName.innerText = inputImage.name;
    })
  </script>
</section>
<?php
include "footer.php";
?>