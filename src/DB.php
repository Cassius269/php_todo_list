<?php

// Créer une classe qui fait la connexion avec la BDD qui porte le même nom que le fichier
namespace src; // espace virtuel où se trouve la classe DB

class DB
{
    private string $dbname = 'todo';
    private string $host = '127.0.01:3306';
    private string $username = 'root';
    private string $password = 'connexion_2024&';

    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);

            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
        }
    }

    /**
     * Fonction personnalisée qui permet de faire une requête SQL préparée
     */
    public function query(string $sql, array $data = []): array
    {
        $request = $this->pdo->prepare($sql);
        $request->execute($data);

        return $request->fetchAll(\PDO::FETCH_ASSOC);
    }
}
