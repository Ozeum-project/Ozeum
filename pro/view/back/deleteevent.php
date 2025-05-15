<?php
include '../../controller/eventcontroller.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $eventController = new EventController();
    $eventController->deleteEvent($id);
}

header('Location: eventList.php');
exit();
?>