<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require('connection.php');

$pk = $_SESSION['pk-event-update'];
$name = $_POST['event-name'];
$description = $_POST['event-description'];
$people_number = $_POST['event-people-number'];

$sql = "SELECT * FROM Events WHERE pkEvent = '$pk'";
$stmt = $connection->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $sql = "UPDATE Events SET EventName = '$name', EventDescription = '$description', PeopleNumber = '$people_number' WHERE pkEvent = '$pk'";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
} else {
    echo "No events with the following identifier were found: " . $pk;
}

header('Location: index.php');
exit();

?>