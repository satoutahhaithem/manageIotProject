<?php
include "config/db_connection.php";
include "header.php";
session_start();
if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["promo"]) && isset($_POST["adress"]) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['whyWantProduct']) && isset($_POST['composant'])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $promo = $_POST["promo"];
    $adress = $_POST["adress"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $whyWantProduct = $_POST["whyWantProduct"];
    $composant = $_POST["composant"];
    echo "hello1";
    $sql_add = "INSERT INTO iot.reservation(firstName,lastName,promo,adress,email,phone,whyWantProduct,composant) VALUES(:firstName,:lastName,:promo,:adress,:email,:phone,:whyWantProduct,:composant)";
    $statement_add = $connection->prepare($sql_add);
    echo "helo";
    if ($statement_add->execute([':firstName' => $firstName, ':lastName' => $lastName, ':promo' => $promo, ':adress' => $adress, ':email' => $email, ':phone' => $phone, ':whyWantProduct' => $whyWantProduct, ':composant' => $composant])) {
        $message = "data inserted successfuly";
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['promo'] = $promo;
        $_SESSION['adress'] = $adress;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['whyWantProduct'] = $whyWantProduct;
        $_SESSION['composant'] = $composant;
        header("Location:rapport.php");
    } else {
        echo "data doesn't inserted";
    }
}

// Get all composants
$sql_get_all = "SELECT nom FROM iot.composant";
$statement_get = $connection->prepare($sql_get_all);
$statement_get->execute();
$composants = $statement_get->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        function goToRapport() {
            window.location.href = 'rapport.php';
        }
    </script>
    <form method="post">
        <!-- 2 column grid layout with text inputs for the first and last names -->
        <div class="row mb-4">
            <div class="col">
                <div class="form-outline">
                    <input type="text" id="firstName" name="firstName" class="form-control" />
                    <label class="form-label" for="firstName">First name</label>
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="text" id="lastName" name="lastName" class="form-control" />
                    <label class="form-label" for="lastName">Last name</label>
                </div>
            </div>
        </div>


        <div class="form-outline mb-4">
            <input type="text" id="promo" name="promo" class="form-control" />
            <label class="form-label" for="promo">Promo</label>
        </div>

        <div class="form-outline mb-4">
            <input type="text" name="adress" id="adress" class="form-control" />
            <label class="form-label" for="adress">Address</label>
        </div>

        <div class="form-outline mb-4">
            <input type="email" id="email" name="email" class="form-control" />
            <label class="form-label" for="email">Email</label>
        </div>

        <select name="composant" id="composant">
            <option value="" disabled>Choisir votre etat</option>
            <?php foreach ($composants as $composant) : ?>
                <option value=<?= $composant->nom; ?>>
                    <?= $composant->nom; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div class="form-outline mb-4">
            <input type="number" id="phone" name="phone" class="form-control" />
            <label class="form-label" for="phone">Phone</label>
        </div>
        <div class="form-outline mb-4">
            <textarea class="form-control" id="whyWantProduct" rows="4" name="whyWantProduct"></textarea>
            <label class="form-label" for="whyWantProduct">why do you want this product </label>
        </div>
        <!-- Submit button -->
        <button type="submit" onclick="goToRapport()">submit</button>
    </form>
    <div>
        <p id="exportContent">

        </p>
        <button onclick="Export2Word('exportContent');" id="btnAfficher" style="display: none;">Export as .doc</button>
    </div>
    <button id="btn">afficher le rapport</button>
</body>


<!-- <button onclick="Export2Word('exportContent', 'word-content');">Export as .doc</button>
<button onclick="Export2Word('exportContent', 'word-content.docx');">Export as .docx</button> -->

</html>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<!-- <script src="FileSaver.js"></script> -->
<!-- <script src="jquery.wordexport.js"></script> -->

<script>
    $('#btn').on('click', function() {
        $('#exportContent').text('Hello, my name is ' + $('#firstName').val() + ' ' +
            $('#lastName').val() + ' ' +
            $('#promo').val() + ' ' +
            $('#adress').val() + ' ' +
            $('#email').val() + ' ' +
            $('#phone').val() + ' ' +
            $('#whyWantProduct').val() + ' '
        );
        $("#btnAfficher").show()
    });

    function Export2Word(element, filename = '') {
        var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
        var postHtml = "</body></html>";
        var html = preHtml + document.getElementById(element).innerHTML + postHtml;

        var blob = new Blob(['\ufeff', html], {
            type: 'application/msword'
        });

        // Specify link url
        var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);

        // Specify file name
        filename = filename ? filename + '.doc' : 'document.doc';

        // Create download link element
        var downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = url;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }

        document.body.removeChild(downloadLink);
    }
</script>