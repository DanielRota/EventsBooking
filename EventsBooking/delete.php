<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require('connection.php');

$pk = $_POST['action'];

$sql = "DELETE FROM Events WHERE pkEvent = '$pk'";
$stmt = $connection->prepare($sql);
$stmt->execute();

header('Location: index.php');
exit();

?>