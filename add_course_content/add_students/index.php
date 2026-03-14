<?php

$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
if (file_exists($configPath)) {
    require_once $configPath;
}

session_start();

include BASE_PATH . "/header/index.php";
include BASE_PATH . "/function/function.php";

if(!isset($_SESSION['username'])){
  header("Location:" . BASE_URL . "final_assessment/");
  exit;
}


if (isset($_GET['id'])) {
  $_SESSION['course_id'] = $_GET['id'];
}

?>

<h2 class="groupe">Выбор группы</h2>
<div class="positionListGroup">
  <ul class="listGroup">
    <?php echo fnAddGroupInCourse($_SESSION['course_id']); ?>
    </a>
  </ul>
</div>

<!-- <h2 class="groupe">Добавить группу из списка</h2>
<div class="positionListGroup">
  <ul class="listGroup">
  </ul>
</div> -->




</body>



</html>