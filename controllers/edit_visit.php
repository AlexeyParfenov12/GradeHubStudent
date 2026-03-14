<?php

include "../function/connect.php";

// Проверяем наличие необходимых параметров
if (!isset($_POST['visit_name']) || !isset($_POST['visit_id'])) {
    echo "Отсутствуют необходимые параметры!";
    exit;
}

$sql = sprintf("UPDATE `visits` SET `visit_name` = '%s' WHERE `visit_id` = '%s'", $_POST['visit_name'], $_POST['visit_id']);

if (!$connect->query($sql)) {
    echo "Ошибка изменения!";
}

// Перенаправляем обратно на страницу посещений, передавая все необходимые параметры
$redirect_url = "../visits/index.php?" . http_build_query([
    'student_id' => $_POST['student_id'] ?? '',
    'name_student' => $_POST['name_student'] ?? '',
    'course_id' => $_POST['course_id'] ?? '',
    'name_course' => $_POST['name_course'] ?? '',
    'group_id' => $_POST['group_id'] ?? '',
    'name_group' => $_POST['name_group'] ?? ''
]);

header("Location: " . $redirect_url);
exit;

?>