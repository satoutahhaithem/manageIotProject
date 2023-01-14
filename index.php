<?php
include "config/db_connection.php";
include "header.php";

// Get all composants
$sql_get_all = "SELECT * FROM iot.composant";
$statement_get = $connection->prepare($sql_get_all);
$statement_get->execute();
$composants = $statement_get->fetchAll(PDO::FETCH_OBJ);

?>
<!-- Content -->
<?php if ($_SESSION["email"]) { ?>
  <section class="content">
    <!-- modal that contains add form -->
    <?php
    include "add.php";

    ?>
    <div class="export">
      <div class="container">
        <br />
        <form method="post" action="export.php" style="text-align:center;">
          <input type="submit" name="export" class="export" style="width: 100%;" value="Export Excel" />
        </form>
      </div>
    </div>
    <div class="container">
      <?php
      if (!empty($valideMessage)) {
        include "alert_fail.php";
      }
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
            <img src="./image/<?php echo $composant->image; ?>">
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="script.js"></script>
<?php } else header("Location: login.php"); ?>