<!-- Same as User controller but with events
        instead of log in, register and log out 
        here we need like CRUD (create, read, update and delete)-->

<?php
session_start();
require 'db_connection.php';

$event = new EventController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['createEvent'])) {
        $event->createEvent();
    } else if (isset($_POST['updateEvent'])) {
        $event->updateEvent();
    } else if (isset($_POST['deleteEvent'])) {
        $event->deleteEvent();
    } else if (isset($_POST['getEvents'])) {
        $event->getEvents();
    } else if (isset($_POST['getEventById'])) {
        $event->getEventById();
    }
}
class EventController
{
    public $conn;

    public function createEvent()
    {

    }
    public function updateEvent()
    {

    }
    public function deleteEvent()
    {

    }
    public function getEvents()
    {
        $sql = "SELECT * FROM events";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $events = array();
            while ($row = $result->fetch_assoc()) {
                $events[] = $row;
            }
            echo json_encode($events);
        } else {
            echo json_encode(array());
        }
    }
    public function getEventById()
    {
        $eventId = $_POST['eventId'];
        $sql = "SELECT * FROM events WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $event = $result->fetch_assoc();
            echo json_encode($event);
        } else {
            echo json_encode(array());
        }
    }
}