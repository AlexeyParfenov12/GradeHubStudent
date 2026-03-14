<?php

    include "../function/connect.php";

    // Проверяем наличие необходимых параметров
    if (!isset($_GET['tests_group_student_id']) || !isset($_GET['student_grade'])) {
        echo "Отсутствуют необходимые параметры!";
        exit;
    }

    $sql = sprintf("UPDATE `tests_group_student` SET `student_grade`='%s' WHERE `tests_group_student_id` = '%s'",
    $_GET['student_grade'],
    $_GET['tests_group_student_id']
);

if (!$connect -> query($sql)){
    echo "Ошибка добавления данных!";
}

// Перенаправляем обратно на страницу тестов, передавая все необходимые параметры
$redirect_url = "../tests/index.php?" . http_build_query([
    'student_id' => $_GET['student_id'] ?? '',
    'name_student' => $_GET['name_student'] ?? '',
    'course_id' => $_GET['course_id'] ?? '',
    'name_course' => $_GET['name_course'] ?? '',
    'group_id' => $_GET['group_id'] ?? '',
    'name_group' => $_GET['name_group'] ?? ''
]);

header("Location: " . $redirect_url);
exit;

?>