<?php
include "config/db_connection.php";
// include "header.php";
if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["promo"]) && isset($_POST["adress"]) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['whyWantProduct'])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $promo = $_POST["promo"];
    $adress = $_POST["adress"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $whyWantProduct = $_POST["whyWantProduct"];

    echo "hello1";
    $sql_add = "INSERT INTO iot.reservation(firstName,lastName,promo,adress,email,phone,whyWantProduct) VALUES(:firstName,:lastName,:promo,:adress,:email,:phone,:whyWantProduct)";
    $statement_add = $connection->prepare($sql_add);
    echo "helo";
    if ($statement_add->execute([':firstName' => $firstName, ':lastName' => $lastName, ':promo' => $promo, ':adress' => $adress, ':email' => $email, ':phone' => $phone, ':whyWantProduct' => $whyWantProduct])) {
        $message = "data inserted successfuly";
        echo $message;
    } else {
        echo "data doesn't inserted";
    }
}


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


        <div class="form-outline mb-4">
            <input type="number" id="phone" name="phone" class="form-control" />
            <label class="form-label" for="phone">Phone</label>
        </div>
        <div class="form-outline mb-4">
            <textarea class="form-control" id="whyWantProduct" rows="4" name="whyWantProduct"></textarea>
            <label class="form-label" for="whyWantProduct">why do you want this product </label>
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Place order</button>
    </form>
    <div>
        <p id="exportContent">

        </p>
        Your content here
    </div>
</body>
<button id="btn">submit</button>
<button onclick="Export2Word('exportContent');">Export as .doc</button>
<!-- <button onclick="Export2Word('exportContent', 'word-content');">Export as .doc</button>
<button onclick="Export2Word('exportContent', 'word-content.docx');">Export as .docx</button> -->

</html>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="FileSaver.js"></script>
<script src="jquery.wordexport.js"></script>
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