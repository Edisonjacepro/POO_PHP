<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'event_manager';
    private $username = 'root';
    private $password = '';
    private $connection;
    private static $instance = null; // Déclare une instance statique

    // Méthode pour obtenir l'instance de la connexion
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }

    // Constructeur privé pour empêcher l'instanciation directe
    private function __construct() {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}
