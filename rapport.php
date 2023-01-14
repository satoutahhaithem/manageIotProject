<?php
include "style.php";
session_start();
?>
<div class="let" id="exportContent">
    <div class="container">
        <div class="lettre">
            <h3>Ticket de decharge</h3>
            <div class="flex-message">
                <div class=".contact-left">
                    <h4>Nom : <?php echo $_SESSION['lastName'] ?></h4>
                    <h4>Prenom : <?php echo $_SESSION['firstName'] ?></h4>
                    <h4>Telephone : <?php echo $_SESSION['phone'] ?></h4>
                </div>
                <div class=".contact-right">
                    <h4>Email : <?php echo $_SESSION['email'] ?></h4>
                    <h4>Promo : <?php echo $_SESSION['promo'] ?></h4>
                    <h4>Adresse : <?php echo $_SESSION['adress'] ?></h4>
                </div>
            </div>
            <div class="message">
                <p>
                    Je soussigné(e) nom et prenom que je vais emprunter le composant :
                    "<?php echo $_SESSION['composant'] ?>" a pour but de <span> <?php echo $_SESSION['whyWantProduct'] ?>.</span>
                </p>
            </div>
        </div>
    </div>
</div>
<button onclick="Export2Word('exportContent');" id="btnAfficher">Export as .doc</button>
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="FileSaver.js"></script>
<script src="jquery.wordexport.js"></script>