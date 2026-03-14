<?php
session_start();


$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
if (file_exists($configPath)) {
    require_once $configPath;
}



include BASE_PATH . "/header/index.php";
include BASE_PATH . "/function/function.php";

?>

<h2 class="groupe">Выбор группы</h2>
<div class="positionListGroup">
  <ul class="listGroup">
    <?php echo fnGroupInStudents(); ?>
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
