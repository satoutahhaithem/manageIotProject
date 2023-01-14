<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,300&display=swap" rel="stylesheet" />
  <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="css/normalize.css" />
  <!-- test -->
  <title>Document</title>
</head>

<body>
  <!-- Header -->
  <div class="header">
    <div class="container">
      <a href="index.php"><img src="images/logo.png" alt="" class="logo" /></a>
      <div class="links">
        <ul>
          <li><a href="#" id="myBtn">Ajouter composant</a></li>
          <li><a href="filter_date.php" id="myBtn">Filter par date</a></li>
          <li><a href="filter_etat.php" id="myBtn2">Filter par etat</a></li>
          <li><a href="index.php">Composants</a></li>
          <li><a href="decharge.php">Decharge</a></li>
          <li><button onclick="logout()">Logout</button></li>
        </ul>
      </div>
    </div>
  </div>
  <script>
    function logout() {
      window.location.href = 'logout.php';
    }
  </script>