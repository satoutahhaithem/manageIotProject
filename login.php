<?php
include "config/db_connection.php";
session_start();
$message = "";
if (count($_POST) > 0) {
    $sql_login = "SELECT * FROM iot.user WHERE email='" . $_POST["email"] . "' and password = '" . $_POST["password"] . "'";
    $statement_login = $connection->prepare($sql_login);
    $statement_login->execute();
    $result = $statement_login->fetch();
    if (is_array($result)) {
        $_SESSION["email"] = $result['email'];
        $_SESSION["password"] = $result['password'];
        echo $result['email'];
        echo $result['password'];
    } else {
        $message = "Invalid Username or Password!";
    }
}
if (isset($_SESSION["email"]) && isset($_SESSION["password"])) {
    header("Location: index.php");
}
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
    <div class="login">
        <div class="container">
            <form action="login.php" method="post">
                <h3>Login</h3>
                <label for="email"></label>
                <input type="email" placeholder="Entrer votre email" name="email">
                <label for="password"></label>
                <input type="password" placeholder="Entrer votre mot de pass" name="password">
                <label id="email-error" class="errors" for="nom"><?php if ($message != "") {
                                                                        echo $message;
                                                                    } ?></label>
                <input type="submit" value="Login" class="login-btn">
            </form>

        </div>
    </div>
</body>

</html>