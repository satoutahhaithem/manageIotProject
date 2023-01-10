
<?php
require_once 'config/db_connection.php';

if (isset($_POST['query'])) {
  $inpText = $_POST['query'];
  $sql = 'SELECT 	* FROM iot.composant WHERE nom LIKE :searchedName';
  $stmt = $connection->prepare($sql);
  $stmt->execute(['searchedName' => '%' . $inpText . '%']);
  $result = $stmt->fetchAll();

  if ($result) {
    echo '<script>
    $(".boxes").hide();
    </script>';
    foreach ($result as $row) {
      echo "
      <div class='box'>
      <div class='image'>
        <img src='images/souris.jpg' alt='' />
      </div>
      <div class='imformation'>
        <div class='nom'>
          <h3>Nom</h3>
          <p>" . $row['nom'] . "</p>
        </div>
        <div class='quantite'>
          <h3>Quantite</h3>
          <p>" . $row['quantite'] . "</p>
        </div>
        <div class='etat'>
          <h3>Etat</h3>
          <p>" . $row['etat'] . "</p>
        </div>
        <div class='date'>
          <h3>Date d'achat</h3>
          <p>" . $row['date_achat'] . "</p>
        </div>
        <div class='buttons'>
          <a class='supprimer' onclick='return confirm('Voulez vous vraiment supprimer ce composant ?')' href='delete.php?id='>Supprimer</a>
          <a class='modifier' href='update.php?id='>Modifier</a>
        </div>
      </div>
    </div>
      ";
    }
  } else {
    echo '<script>
    $(".boxes").hide();
    </script>';
    echo '<p class="list-group-item border-1">No Record</p>';
  }
}
?>