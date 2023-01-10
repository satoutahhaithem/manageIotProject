<?php
include "config/db_connection.php";
include "header.php";
// get element
$id = $_GET['id'];
 $sql_get = "SELECT * FROM iot.composant WHERE id_composant=:id";
 $statement_get = $connection->prepare($sql_get);
 $statement_get->execute([':id'=>$id]);
$composant = $statement_get->fetch(PDO::FETCH_OBJ);


//update composant
if (isset($_POST["name"]) && isset($_POST["qte"])&& isset($_POST["etat"])&& isset($_POST["date"])) {
  $nom = $_POST["name"];
  $qte = $_POST["qte"];
  $etat = $_POST["etat"];
  $datee = $_POST["date"];
  $sql_update = "UPDATE iot.composant SET nom=:nom, quantite=:qte, etat=:etat, date_achat=:datee WHERE id_composant=:id";
  $statement_update = $connection->prepare($sql_update);
  if ($statement_update->execute([':nom' => $nom, ':qte' => $qte, ':etat' => $etat, ':datee' => $datee,':id' => $id])) {
        header("Location:index.php");
  };
}

?>
    <section class="content">
      <!-- modal that contains add form -->
    
      <div class="container">
    <div>
        <form method="post">
                <label for="name">Nom de Composant</label>
                <input
                  type="text"
                  id="name"
                  name="name"
                  value="<?php echo $composant->nom?>"
                  placeholder="Entrer le nom du composant, ex:souris .."
                />

                <label for="qte">Quantite</label>
                <input
                  type="text"
                  id="qte"
                  name="qte"
                  value="<?php echo $composant->quantite?>"
                  placeholder="Specifier la quantite du composant, ex 18 .."
                />
                

                <label for="etat">Etat</label>
                <select id="etat" name="etat">
                  <option value="disponible">Disponible</option>
                  <option value="en-pane">En pane</option>
                  <option value="perdu">Perdu</option>
                </select>
                <label for="qte">Date d'Achat</label>
                <input
                  type="date"
                  id="date"
                  name="date"
                  value="<?php echo $composant->date_achat?>"
                />
                <input type="submit" value="Ajouter" />
              </form>
    </div>
      </div>
    </section>
    <?php
    include "footer.php";
    ?>
