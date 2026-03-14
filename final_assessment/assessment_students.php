<?php
session_start();


$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
if (file_exists($configPath)) {
    require_once $configPath;
}


// Получаем данные из GET-параметров
$course_id = isset($_GET['course_id']) ? $_GET['course_id'] : null;
$name_course = isset($_GET['name_course']) ? $_GET['name_course'] : null;
$group_id = isset($_GET['group_id']) ? $_GET['group_id'] : null;
$name_group = isset($_GET['name_group']) ? $_GET['name_group'] : null;
 
// Проверяем, что все необходимые параметры переданы
if (!$course_id || !$name_course || !$group_id || !$name_group) {
    // Если параметры не переданы, перенаправляем на главную страницу студентов
    header("Location: index.php");
    exit;
}

include BASE_PATH . "/header/index.php";
include BASE_PATH . "/function/function.php";
?>

<h1 class="groupe"><? echo htmlspecialchars($name_course)?></h1>
<h2 class="groupe" style="font-size: 16px;"><? echo htmlspecialchars($name_group)?></h2>
<h2 class="title" style="font-size: 16px;">Оценки</h2>
    <table class="tableStudentsExercise">
        <td class="tdHeaderExercise">
            ФИО
        </td>
        <td class="tdHeaderExercise">
           Задания. Оценка (% выполнено)
        </td>
        <td class="tdHeaderExercise">
            Тесты. Оценка (% выполнено)
        </td>
        <td class="tdHeaderExercise">
            Посещения
        </td>
        <td class="tdHeaderExercise">
            Итоговая оценка
        </td>
        
        <? echo fnAssessmentStudent($group_id, $course_id, $name_course, $name_group) ?>

    </table>