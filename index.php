<?php

use src\DB;
use src\Entity\Task;
use src\Repository\TaskRepository;

spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);
    require_once __DIR__ . '/' . $class . '.php';
});

$db = new DB();

$taskRepository = new TaskRepository($db);

// Supprimer une tâche
if (isset($_GET["id"])) {
    try {
        $taskRepository->delete($_GET["id"]);
        header("Location: index.php");
    } catch (Exception $e) {
        echo "Erreur :" . $e->getMessage();
    }
}

$tasks = $taskRepository->findAll();
$messageAdding = [];

// Ajouter une tâche
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["task"]) && !empty($_POST["task"])) {
        echo "Task corrrect";

        $taskName = strip_tags($_POST["task"]);
        $taskAdded = new Task();
        $taskAdded->setName($taskName);
       // $taskAdded->setState(0); // false : tâche pas encore faite

        $taskRepository->save($taskAdded);

        header("Location: index.php");
    }

    if (empty($_POST["task"])) {
        $messageAdding[] = "tâche vide non ajouté";
    }
}

// Mettre à jour une task

if (isset($_GET["data-id"])) {
    echo "data-id défini";
    try {
        $taskRepository->updateState(intval($_GET["data-id"]));
        header("Location: index.php");
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

?>

<?php include "./inc/header.php"; ?>
<main>
    <h2>TODO LIST</h2>
    <?php include "messages.php" ?>
    <ul id="liste">
        <?php foreach ($tasks as $task) : ?>
            <li>
                <a href=<?= "/?data-id=" . $task->getId(); ?>><span class=<?= $task->getState() ? "finished" : "" ?>><?= $task; ?></span></a>
                <a href=<?= "?id=" . $task->getId(); ?>><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
            </li>
        <?php endforeach; ?>
    </ul>
    <button id="botonAdd">+ Ajouter</button>
    <div class="formAddTask cacher">
        <form action="" method="POST">
            <label for="task">Nouvelle tache: </label>
            <input type="text" id="task" name="task">
            <input class="button buttonAdd" type="submit" value="Ajouter">
        </form>
        <button class="button buttonCancel">Annuler</button>
    </div>
</main>
<?php include "./inc/footer.php"; ?>