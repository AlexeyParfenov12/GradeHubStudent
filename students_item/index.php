<?php

$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
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


if (isset($_GET['group_id'])) {
  $_SESSION['group_id'] = $_GET['group_id'];
}

$_SESSION['name_group'] = $_GET['name_group'];

?>

<h1 class="groupe"><? echo $_SESSION['name_course']?></h1>
<h2 class="groupe" style="font-size: 16px;"><? echo $_GET['name_group']?></h2>
<h2 class="title" style="font-size: 14px;">Список студентов</h2>
<ol class="studentList">
  <? echo fnStudent($_SESSION['group_id'], $_SESSION['group_id'], $_GET['name_group'], $_SESSION['course_id'], $_SESSION['name_course']); ?>
</ol>



</body>

</html>