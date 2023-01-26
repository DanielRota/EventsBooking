<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require('connection.php');

$name = $_REQUEST['event-name'];
$description = $_REQUEST['event-description'];
$people_number = $_REQUEST['event-people-number'];

$sql = "SELECT * FROM Events WHERE EventName = '$name'";
$stmt = $connection->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $sql = "UPDATE Events SET PeopleNumber = PeopleNumber + '$people_number' WHERE EventName = '$name'";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
} else {
    $sql = "INSERT INTO Events (EventName, EventDescription, PeopleNumber) VALUES ('$name', '$description', '$people_number')";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
}

header('Location: index.php');
exit();

?>