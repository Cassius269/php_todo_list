<?php

namespace src\Repository;

use src\DB;
use src\Entity\Task;

class TaskRepository
{
    private $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $tasks = $this->db->query('SELECT * FROM tasks');

        $results = [];
        foreach ($tasks as $task) {
            $results[] = Task::hydrate($task);
        }

        return $results;
    }


    // Ajouter une tache
    public function save(Task $task): void
    {
        $this->db->query(
            'INSERT INTO tasks(name,state) VALUES(?,?)',
            [
                $task->getName(),
                intval($task->getState())
            ]
        );
    }

    // supprimer une tache
    public function delete(int $id): void
    {
        if ($this->findById($id) !== null) {
            $this->db->query('DELETE FROM tasks WHERE id = ?', [$id]);
        };
    }

    public function findById(int $id): ?Task
    {
        $tasks = $this->db->query('SELECT * FROM tasks WHERE id = ?', [$id]);

        return Task::hydrate($tasks[0]) ?? null;
    }


    // Modifier l'état d'une tâche
    public function updateState(int $id): void
    {
        $task = $this->findById($id);

        if ($task === null) { // dans le cas aucune donnée trouvée, arrêter l'execution de la fonction
            return;
        }
/*
        $state = $task->getState();

        if ($state === 0) {
            $state = 1;
        } else if ($state === 1) {
            $state = 0;
        }
*/
        $this->db->query(
            'UPDATE tasks SET state = :state WHERE id = :id',
            [
                //"state" => $state,
                "state" => intval(!$task->getState()),
                "id" => $id,
            ]
        );
    }
}
