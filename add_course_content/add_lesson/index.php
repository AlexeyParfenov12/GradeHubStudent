<?php

session_start();
$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
if (file_exists($configPath)) {
    require_once $configPath;
}

include BASE_PATH . "/header/index.php";
include BASE_PATH . "/function/function.php";

if(!isset($_SESSION['username'])){
  header("Location:" . BASE_URL . "final_assessment/");
  exit;
}

?>

<h2>Добавить задание</h2>

<div class="positionListStudent">
    <ul class="listAddlessonsTests">
        <?php echo fnAddLesson(); ?>
    </ul>
</div>

