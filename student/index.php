<?php
session_start();
// Включение буферизации вывода для предотвращения ошибок с заголовками
ob_start();
$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
if (file_exists($configPath)) {
    require_once $configPath;
}

// Получаем данные из GET-параметров
// Проверка на существование переменной Student_id (с большой буквы)
// Это может решить проблему "Undefined variable Student_id"
if (!isset($Student_id)) {
    $Student_id = isset($student_id) ? $student_id : null;
}

$student_id = isset($_GET['student_id']) ? $_GET['student_id'] : null;
$name_student = isset($_GET['name_student']) ? $_GET['name_student'] : null;
$course_id = isset($_GET['course_id']) ? $_GET['course_id'] : null;
$name_course = isset($_GET['name_course']) ? $_GET['name_course'] : null;
$group_id = isset($_GET['group_id']) ? $_GET['group_id'] : null;
$name_group = isset($_GET['name_group']) ? $_GET['name_group'] : null;

// Проверяем, что все необходимые параметры переданы
if (!$student_id || !$name_student || !$course_id || !$name_course || !$group_id || !$name_group) {
    // Если параметры не переданы, перенаправляем на главную страницу студентов
    header("Location: " . BASE_URL . "final_assessment/index.php");
    exit;
}
 
// Очистка буфера вывода перед отправкой заголовков
ob_end_clean();

if(!isset($_SESSION['username'])){
  header("Location:" . BASE_URL . "final_assessment/");
  exit;
}

include BASE_PATH . "/header/index.php";
include BASE_PATH . "/function/function.php";
?>

<h1 class="groupe"><? echo htmlspecialchars($name_course)?></h1>
<h2 class="groupe" style="font-size: 16px;"><? echo htmlspecialchars($name_group)?></h2>
<h2 class="groupe" style="font-size: 14px; margin:50px"><? echo htmlspecialchars($name_student)?></h2>
<div class="positionListStudent">
    <ul class="listStudent">
            <a class="aList" href="<?= BASE_URL ?>lessons/index.php?student_id=<?= $student_id ?>&name_student=<?= urlencode($name_student) ?>&course_id=<?= $course_id ?>&name_course=<?= urlencode($name_course) ?>&group_id=<?= $group_id ?>&name_group=<?= urlencode($name_group) ?>">
                <li class="listItem">Задания</li>
            </a>
            <a class="aList" href="<?= BASE_URL ?>tests/index.php?student_id=<?= $student_id ?>&name_student=<?= urlencode($name_student) ?>&course_id=<?= $course_id ?>&name_course=<?= urlencode($name_course) ?>&group_id=<?= $group_id ?>&name_group=<?= urlencode($name_group) ?>">
                <li class="listItem">Тесты</li>
            </a>
            <a class="aList" href="<?= BASE_URL ?>visits/index.php?student_id=<?= $student_id ?>&name_student=<?= urlencode($name_student) ?>&course_id=<?= $course_id ?>&name_course=<?= urlencode($name_course) ?>&group_id=<?= $group_id ?>&name_group=<?= urlencode($name_group) ?>">
                <li class="listItem">Посещения</li>
            </a>
            <a class="aList" href="<?= BASE_URL ?>arrears/index.php?student_id=<?= $student_id ?>&name_student=<?= urlencode($name_student) ?>&course_id=<?= $course_id ?>&name_course=<?= urlencode($name_course) ?>&group_id=<?= $group_id ?>&name_group=<?= urlencode($name_group) ?>">
                <li class="listItem">Задолжености</li>
            </a>
    </ul>
</div>