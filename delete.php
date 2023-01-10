<?php
include "config/db_connection.php";
// get element
$id = $_GET['id'];
 $sql_delete = "DELETE FROM iot.composant WHERE id_composant=:id";
 $statement_delete = $connection->prepare($sql_delete);
 if ($statement_delete->execute([':id'=>$id])) {
    header("Location:index.php");
 }


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