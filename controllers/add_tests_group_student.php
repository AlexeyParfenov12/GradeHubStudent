<?php

    include "../function/connect.php";

    // Проверяем наличие необходимых параметров
    if (!isset($_GET['tests_group_id']) || !isset($_GET['student_grade']) || !isset($_GET['student_id'])) {
        echo "Отсутствуют необходимые параметры!";
        exit;
    }

    $sql = sprintf("INSERT INTO `tests_group_student` (`tests_group_student_id`, `tests_group_id`, `student_id`, `student_grade`) VALUE (NULL, '%s', '%s', '%s')",
                    $_GET['tests_group_id'],
                    $_GET['student_id'],
                    $_GET['student_grade']
                );
    
    if(!$connect->query($sql)){
        echo "ошибка добавления данных!";
    }

    // Перенаправляем обратно на страницу тестов, передавая все необходимые параметры
    $redirect_url = "../tests/index.php?" . http_build_query([
        'student_id' => $_GET['student_id'],
        'name_student' => $_GET['name_student'] ?? '',
        'course_id' => $_GET['course_id'] ?? '',
        'name_course' => $_GET['name_course'] ?? '',
        'group_id' => $_GET['group_id'] ?? '',
        'name_group' => $_GET['name_group'] ?? ''
    ]);
    
    header("location: " . $redirect_url);
    exit;
?>
