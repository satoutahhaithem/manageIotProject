<?php
$host = 'mysql:host = localhost ; dbname = iot';
$login = 'root';
$password = '';
try {
    $connection = new PDO($host, $login, $password);
    // $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "error in connecting" . $e->getMessage();
}
