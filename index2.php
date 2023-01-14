<?php
include "config/db_connection.php";
include "header.php";

// Get all composants
?>
<!-- Content -->
<?php if ($_SESSION["email"]) { ?>
  <section class="content">
    <script>
      $(document).ready(function() {
        var currentcount = 0;
        var newcount = 6;
        // Send Search Text to the server
        $("#next").on("click", function() {
          currentcount = newcount;
          newcount += 6;
          $("#boxes").load("get_tranche_next.php", {
            currentcount: currentcount,
            newcount: newcount
          })

        });
        $("#previous").on("click", function() {
          currentcount -= 6;
          newcount -= 6;
          if (currentcount < 0 || newcount) {
            newcount = 6;
            currentcount = 0;
          }
          $("#boxes").load("get_tranche_previous.php", {
            currentcount: currentcount,
            newcount: newcount
          })

        });


      });
    </script>
    <!-- modal that contains add form -->
    <?php
    include "add.php";

    ?>
    <div class="export">
      <div class="container">
        <br />
        <form method="post" action="export.php" style="text-align:center;">
          <input type="submit" name="export" class="export" style="width: 100%;" value="Export Excel" />
          <input type="button" value="Next" id="next">
          <input type="button" value="previous" id="previous">
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
    <div class="container boxes" id="boxes">
      <?php
      $sql_get_all = "SELECT * FROM iot.composant LIMIT 6";
      $statement_get = $connection->prepare($sql_get_all);
      $statement_get->execute();
      $composants = $statement_get->fetchAll(PDO::FETCH_OBJ);



      foreach ($composants as $composant) : ?>
        <div class="box" id="box">
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