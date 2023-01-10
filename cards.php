<?php
include "config/db_connection.php";
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
<div class="container">
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
        <?php endforeach; ?>
      </div>
