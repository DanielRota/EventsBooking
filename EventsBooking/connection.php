<?php

$hostname = "localhost:3307";
$username = "root";
$password = "";
$dbname = "eventsbooking";

try {
    $connection = new PDO("mysql:host=$hostname;dbname=", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db = file_get_contents("Data/db.sql");
    $connection->exec($db);
} catch (PDOException $e) {
    echo "Connection failed..." . $e->getMessage();
}

$sql = 'SELECT * FROM Events';
$stmt = $connection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$stmt->execute();

if ($stmt->rowCount() == 0) {
    $data = file_get_contents("Data/data.sql");
    $connection->exec($data);
}

?>