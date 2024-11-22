<?php

require_once '../config/Database.php';
require_once '../app/models/Event.php';

class EventController {
    private $eventModel;

    public function __construct() {
        $this->eventModel = new Event(); // Appel à la méthode Singleton de Database via Event

    }

    public function index() {
        $events = $this->eventModel->getAllEvents();
        require '../app/views/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $name = $_POST['name'];
            $date = $_POST['date'];
            $description = $_POST['description'];
    
            // Ajouter l'événement dans la base de données
            $this->eventModel->addEvent($name, $date, $description);
    
            // Redirection après l'ajout de l'événement
            header('Location: /POO_PHP/event-manager/public/index.php?page=index'); // Redirige vers la page d'accueil (ou liste des événements)
            exit(); // Assure-toi d'arrêter le script ici pour éviter toute exécution supplémentaire
        }
    
        // Si la méthode n'est pas POST, afficher le formulaire
        require_once '../app/views/create.php';
    }

    public function edit($id) {
        // Récupérer l'événement à modifier
        $event = $this->eventModel->getEventById($id);
    
        if ($event) {
            // Passer les données de l'événement à la vue
            require_once '../app/views/edit.php';
        } else {
            echo "Événement non trouvé.";
        }
    }
        public function update($id) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'] ?? '';
                $date = $_POST['date'] ?? '';
                $description = $_POST['description'] ?? '';
        
                // Valider les données
                if (!empty($name) && !empty($date) && !empty($description)) {
                    // Appeler la méthode de modèle pour mettre à jour l'événement
                    $updateStatus = $this->eventModel->updateEvent($id, $name, $date, $description);
                    
                    if ($updateStatus) {
                        // Rediriger vers la page d'affichage des événements
                        header('Location: /POO_PHP/event-manager/public/index.php?page=index');
                        exit;
                    } else {
                        echo "Erreur lors de la mise à jour de l'événement.";
                    }
                } else {
                    echo "Tous les champs sont requis.";
                }
            } else {
                echo "Méthode non autorisée.";
            }
        }

        public function delete($id) {
            $eventModel = new Event();
            $eventModel->delete($id);  // Appel de la méthode delete du modèle Event
    
            // Rediriger vers la page d'index après la suppression
            header('Location: index.php?page=index');
            exit();
        }
    }

