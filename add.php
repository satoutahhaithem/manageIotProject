<?php
$message = "";
$valideMessage = "";
$nom = $qte = $etat = $datee  = $tempname = '';

$errors = array('nom' => '', 'qte' => '', 'etat' => '', 'date' => '', 'file' => '');
if (isset($_POST['upload'])) {

    // conditions of insertion verification
    // nom
    if (empty($_POST['name'])) {
        $errors['nom'] = 'nom est exigee <br/>';
    } else {
        $nom = $_POST["name"];
        if (!preg_match('/^[A-Za-z][A-Za-z0-9_]{0,29}$/', $nom)) {
            $errors['nom'] = 'le nom est invalide';
        }
    }
    // nom
    if (empty($_POST['qte'])) {
        $errors['qte'] = 'La quantite est exigee <br/>';
    } else {
        $qte = $_POST["qte"];
        if (!preg_match('/^[0-9]+$/', $qte)) {
            $errors['qte'] = 'La quantite est invalide';
        }
    }
    if (array_filter($errors)) {
        // print_r($errors);
        $valideMessage = "form is not valide";
    } else {
        $nom = $_POST["name"];
        $qte = $_POST["qte"];
        $etat = $_POST["etat"];
        $datee = $_POST["date"];
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];

        $folder = "image/" . $filename;

        $sql_add = "INSERT INTO iot.composant(nom,image,quantite,etat,date_achat) VALUES(:nom,:filename,:qte,:etat,:datee)";
        $statement_add = $connection->prepare($sql_add);

        if ($statement_add->execute([':nom' => $nom, ':filename' => $filename, ':qte' => $qte, ':etat' => $etat, ':datee' => $datee])) {
            if (move_uploaded_file($tempname,  $folder)) {
                header('Location: ' . $_SERVER['REQUEST_URI']);
            }
        } else {
            echo $valideMessage;
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
                <h2>Ajouter un composant IOT</h2>
            </div>
            <div class="modal-body">
                <form action="index.php" method="post" enctype="multipart/form-data" id="myform">
                    <label for="name">Nom de Composant</label>
                    <input type="text" id="name" name="name" placeholder="Entrer le nom du composant, ex:souris .." required title="This field should not be left blank." />
                    <label id="email-error" class="errors" for="nom"><?php echo $errors['nom'] ?></label>

                    <label for="qte">Quantite</label>
                    <input type="text" id="qte" name="qte" placeholder="Specifier la quantite du composant, ex 18 .." required title="This field should not be left blank." />
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
                    <select id="etat" name="etat" required>
                        <option value="disponible">Disponible</option>
                        <option value="en-pane">En pane</option>
                        <option value="perdu">Perdu</option>
                    </select>
                    <label for="qte">Date d'Achat</label>
                    <input type="date" id="date" name="date" required />
                    <input type="submit" value="Ajouter" name="upload" class="addd" />
                </form>
            </div>
            <div class="modal-footer">
                <h3>Ajouter un composant IOT</h3>
            </div>
        </div>
    </div>
</div>