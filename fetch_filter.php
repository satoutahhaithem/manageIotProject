<?php
include "config/db_connection.php";
include "header.php";
if (isset($_POST["req"])) {
    $requestt = $_POST["req"];
    $sql = "SELECT * FROM iot.composant WHERE date_achat like '%$requestt%'";
    $statement_get = $connection->prepare($sql);
    $statement_get->execute();
    $composants = $statement_get->fetchAll(PDO::FETCH_OBJ);

    $count = $statement_get->rowCount();

}

?>
<div class="container">
      <?php
          foreach ($composants as $composant):
      ?>
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
        <a class="supprimer" onclick="return confirm('Voulez vous vraiment supprimer ce composant ?')" href="delete.php?id=<?=$composant->id_composant?>">Supprimer</a>
        <a class="modifier" href="update.php?id=<?=$composant->id_composant?>">Modifier</a>
      </div>
    </div>
  </div>
            <?php endforeach;?>
    </div>