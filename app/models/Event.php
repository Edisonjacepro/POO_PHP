<?php

class Event
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance(); // Utiliser la méthode getInstance pour obtenir la connexion PDO
    }


    public function getAllEvents()
    {
        $stmt = $this->db->query("SELECT * FROM events");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEventById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addEvent($name, $date, $description)
{
    try {
        $sql = "INSERT INTO events (name, date, description) VALUES (:name, :date, :description)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':description', $description);
        
        // Exécution de la requête
        if ($stmt->execute()) {
            echo "Événement ajouté avec succès!";
            return true;
        } else {
            echo "Erreur lors de l'ajout de l'événement.";
            return false;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return false;
    }
}

public function updateEvent($id, $name, $date, $description) {
    $query = "UPDATE events SET name = :name, date = :date, description = :description WHERE id = :id";
    $stmt = $this->db->prepare($query);
    
    // Lier les paramètres
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':description', $description);
    
    // Exécuter la requête
    return $stmt->execute();
}

public function delete($id) {
    $query = "DELETE FROM events WHERE id = :id";  // Requête SQL pour supprimer un événement
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

    public function testModel()
{
    require_once '../app/models/Event.php';

    // Connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=event_manager;charset=utf8', 'root', '');
    $eventModel = new Event($db);

    // Récupérer tous les événements
    $events = $eventModel->getAllEvents();

    echo "<pre>";
    print_r($events);
    echo "</pre>";
}

}
