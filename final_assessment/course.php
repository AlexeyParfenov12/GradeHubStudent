<?php
session_start();
$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
if (file_exists($configPath)) {
    require_once $configPath;
}

include "../header/index.php";
include "../function/function.php";

$group_id = isset($_GET['group_id']) ? $_GET['group_id'] : null;
$name_group = isset($_GET['name_group']) ? $_GET['name_group'] : null;

if (!$group_id || !$name_group) {
    // Если параметры не переданы, перенаправляем на главную страницу студентов
    header("Location: index.php");
    exit;
}
?>
<h2 class="groupe" style="font-size: 20px;"><? echo htmlspecialchars($name_group)?></h2>
<h2 class="groupe" style="font-size: 16px;">Выбор предмета</h2>
<div class="positionListGroup">
  <ul class="listGroup">
    <?php
          echo fnAddCoursesAssessment($group_id, $name_group);
        ?>
  </ul>
</div>



</script>

</html>