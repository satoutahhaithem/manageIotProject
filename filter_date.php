<?php
include "config/db_connection.php";
include "header.php";
$message = "";
if (isset($_POST["name"]) && isset($_POST["qte"]) && isset($_POST["etat"]) && isset($_POST["date"])) {
  $nom = $_POST["name"];
  $qte = $_POST["qte"];
  $etat = $_POST["etat"];
  $datee = $_POST["date"];
  $sql_add = "INSERT INTO iot.composant(nom,quantite,etat,date_achat) VALUES(:nom,:qte,:etat,:datee)";
  $statement_add = $connection->prepare($sql_add);
  if ($statement_add->execute([':nom' => $nom, ':qte' => $qte, ':etat' => $etat, ':datee' => $datee])) {
    $message = "data inserted successfuly";
  };
}

// Get all composants
$sql_get_all = "SELECT * FROM iot.composant";
$statement_get = $connection->prepare($sql_get_all);
$statement_get->execute();
$composants = $statement_get->fetchAll(PDO::FETCH_OBJ);

?>
<!-- Content -->
<section class="content">
  <!-- modal that contains add form -->
  <!-- search -->
  <div class="container">
    <h2>Date filter</h2>

    <!--surround the select box with a "custom-select" DIV element. Remember to set the width:-->
    <div class="custom-select" style="width:200px;">
      <select name="filter" id="filter">
        <option value="2023">2023</option>
        <option value="2022">2022</option>
        <option value="2021">2021</option>
        <option value="2020">2020</option>
        <option value="2019">2019</option>
        <option value="2018">2018</option>
        <option value="2017">2017</option>
        <option value="2016">2016</option>
        <option value="2015">2015</option>
        <option value="2014">2014</option>
      </select>
    </div>
  </div>
  <div class="container">
    <?php
    if (!empty($message)) {
      include "alert_success.php";
    }
    ?>
  </div>
  <!-- affichage du composants dans la page -->
  <div class="container boxes">
    <?php foreach ($composants as $composant) : ?>
      <div class="box">
        <div class="image">
          <img src="images/souris.jpg" alt="" />
        </div>
        <div class="imformation">
          <div class="nom">
            <h3>Nom</h3>
            <p><?= $composant->nom; ?></p>
          </div>
          <div class="quantite">
            <h3>Quantite</h3>
            <p><?= $composant->quantite; ?></p>
          </div>
          <div class="etat">
            <h3>Etat</h3>
            <p><?= $composant->etat; ?></p>
          </div>
          <div class="date">
            <h3>Date d'achat</h3>
            <p><?= $composant->date_achat; ?></p>
          </div>
          <div class="buttons">
            <a class="supprimer" onclick="return confirm('Voulez vous vraiment supprimer ce composant ?')" href="delete.php?id=<?= $composant->id_composant ?>">Supprimer</a>
            <a class="modifier" href="update.php?id=<?= $composant->id_composant ?>">Modifier</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php
include "footer.php";
?>

<!-- <script>
  $(document).ready(function() {
    $("#filter").on("change", function() {
      var value = $(this).val();
      alert(value);

      $.ajax({
        url: "fetch_filter.php",
        type: "POST",
        data: "req=" + value,
        beforeSend: function() {
          $(".conatainer").html("<span>Fetching ...</span>");
        },
        success: function(data) {
          $(".conatainer").html(data);
        }
      })
    })
  })
</script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="script.js"></script>