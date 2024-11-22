<?php

// Charger automatiquement les classes
spl_autoload_register(function ($class) {
    $path = __DIR__ . '/../app/';
    $file = $path . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Vérifier les paramètres de l'URL
$page = $_GET['page'] ?? 'index';  // Valeur par défaut 'index'

// Contrôleur principal
require_once '../app/controllers/EventController.php';
$controller = new EventController();

// Gestion des différentes actions en fonction de l'URL
switch ($page) {
    case 'index':
        if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
            $eventId = $_GET['id'];
            $controller->delete($eventId);  // Appel de la méthode delete
        } else {
            $controller->index();  // Afficher la liste des événements
        }
        break;

    case 'create':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ajout d'un événement
            $controller->create();
        } else {
            // Afficher le formulaire de création
            require_once '../app/views/create.php';
        }
        break;
        case 'edit':
            // Vérifier si un ID d'événement est passé
            if (isset($_GET['id'])) {
                $eventId = $_GET['id'];
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Mettre à jour l'événement dans la base de données
                    $controller->update($eventId);
                } else {
                    // Afficher le formulaire d'édition avec les données de l'événement
                    $controller->edit($eventId);
                }
            } else {
                echo "Aucun événement à modifier.";
            }
            break;
    // Ajoute d'autres routes pour modification/suppression ici
    default:
        echo "Page non trouvée.";
        break;
}
