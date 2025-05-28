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

    public function __construct(){
        global $conn; // Asegúrate de que $conn esté definido en db_connection.php
        $this->conn = $conn;
    }
    // Métodos para manejar eventos
    // Crear, actualizar, eliminar y obtener eventos

    // Crear un evento
    public function createEvent()
    {
         $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $date = $_POST['date'] ?? '';
        $location = $_POST['location'] ?? '';

        $sql = "INSERT INTO events (name, description, date, location) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $description, $date, $location);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Evento creado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al crear el evento']);
        }
    }

    // Actualizar un evento
    public function updateEvent()
    {
        $id = $_POST['id'] ?? '';
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $date = $_POST['date'] ?? '';
        $location = $_POST['location'] ?? '';

        $sql = "UPDATE events SET name = ?, description = ?, date = ?, location = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $description, $date, $location, $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Evento actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el evento']);
        }
    }

    // Eliminar un evento
    public function deleteEvent()
    {
         $id = $_POST['id'] ?? '';

        $sql = "DELETE FROM events WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Evento eliminado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el evento']);
        }
    }

    // Obtener eventos
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

    // Obtener un evento por ID
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