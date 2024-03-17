<?php
use src\DB;
use src\Repository\TaskRepository;

spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);
    require_once __DIR__ . '/' . $class . '.php';
});

$db = new DB();

$taskRepository = new TaskRepository($db);


if(isset($_GET["id"])){
    try{
        $taskRepository->delete($_GET["id"]);
    }catch(Exception $e){
        echo "Erreur :" . $e->getMessage();
    }
}

$tasks = $taskRepository->findAll();

?>

<?php include "./inc/header.php"; ?>
    <main>
        <h2>TODO LIST</h2>
        <ul id="liste">
            <?php foreach($tasks as $task):?>
                <li>
                <span><?= $task;?></span>
                <a href=<?= "?id=".$task->getId(); ?>><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <button id="botonAdd" >+ Ajouter</button>
    </main>
<?php include "./inc/footer.php"; ?>