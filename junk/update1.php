<?php
include "config/db_connection.php";
$id = $_GET['id'];
$sql_get = "SELECT * FROM iot.composant WHERE id_composant=:id";
$statement_get = $connection->prepare($sql_get);
$statement_get->execute([':id' => $id]);
$composant = $statement_get->fetch(PDO::FETCH_OBJ);
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

    $sql_update = "UPDATE iot.composant SET nom=:nom, quantite=:qte, etat=:etat, date_achat=:datee image=:filename WHERE id_composant=:id";
    // $sql_add = "INSERT INTO iot.composant(nom,image,quantite,etat,date_achat) VALUES(:nom,:filename,:qte,:etat,:datee)";
    $statement_update = $connection->prepare($sql_update);

    if ($statement_update->execute([':nom' => $nom, ':qte' => $qte, ':filename' => $filename, ':etat' => $etat, ':datee' => $datee, ':id' => $id])) {
        if (move_uploaded_file($tempname,  $folder)) {
            header('Location: ' . $_SERVER['REQUEST_URI']);
        }
    }
}



?>

<div class="modale">
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Modal Header</h2>
            </div>
            <div class="modal-body">
                <form action="index.php" method="post" enctype="multipart/form-data" id="myform">
                    <label for="name">Nom de Composant</label>
                    <input type="text" id="name" name="name" placeholder="Entrer le nom du composant, ex:souris .." />
                    <label id="email-error" class="errors" for="nom"><?php echo $errors['nom'] ?></label>

                    <label for="qte">Quantite</label>
                    <input type="text" id="qte" name="qte" placeholder="Specifier la quantite du composant, ex 18 .." />
                    <label id="email-error" class="errors" for="qte"><?php echo $errors['qte'] ?></label>


                    <label for="etat">Etat</label>
                    <!-- Upload Image -->
                    <div class="form-group">
                        <input type="file" name="uploadfile" />
                    </div>
                    <!-- <div class="form-group">
              <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
            </div> -->
                    <!-- Upload Image -->
                    <select id="etat" name="etat">
                        <option value="disponible">Disponible</option>
                        <option value="en-pane">En pane</option>
                        <option value="perdu">Perdu</option>
                    </select>
                    <label for="qte">Date d'Achat</label>
                    <input type="date" id="date" name="date" />
                    <input type="submit" value="Ajouter" name="upload" class="addd" />
                </form>
            </div>
            <div class="modal-footer">
                <h3>Modal Footer</h3>
            </div>
        </div>
    </div>
</div>