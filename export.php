<?php
//export.php  
include "config/db_connection.php";
$output = '';
if (isset($_POST["export"])) {
    $query = "SELECT * FROM iot.composant";
    $statement_export = $connection->prepare($query);
    $statement_export->execute();
    $composants = $statement_export->fetchAll(PDO::FETCH_OBJ);
    $row = $statement_export->rowCount();
    // 
    if (!empty($row)) {
        $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>id_Composant</th>  
                         <th>Nom de composant</th>  
                         <th>Quantite</th>  
                         <th>Etat</th>  
                         <th>Date d\'achat</th>  
                    </tr>
  ';
        foreach ($composants as $composant) :
            $output .= '
    <tr>  
                         <td>' . $composant->id_composant . '</td>  
                         <td>' . $composant->nom . '</td>  
                         <td>' . $composant->quantite . '</td>  
                         <td>' . $composant->etat . '</td>  
                         <td>' . $composant->date_achat . '</td>
                    </tr>
   ';
        endforeach;

        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=download.xls');
        echo $output;
    }
}
