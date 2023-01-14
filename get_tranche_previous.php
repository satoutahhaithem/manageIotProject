<?php
include "config/db_connection.php";
$currentcount = $_POST["currentcount"];
$newcount = $_POST["newcount"];
$sql_get_all = "SELECT * FROM iot.composant LIMIT $currentcount,6";
$statement_get = $connection->prepare($sql_get_all);
$statement_get->execute();
$composants = $statement_get->fetchAll(PDO::FETCH_OBJ);
$count = $statement_get->rowCount();

// echo "current:" . $currentcount;
// echo "</br>";
// echo "new" . $newcount;
if ($count > 0) {
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
<?php endforeach;
} else
    echo "<h3>Aucune element est trouvee</h3>";
?>