<?php

    include "../function/connect.php";

    // Проверяем наличие необходимых параметров
    if (!isset($_GET['visit_id']) || !isset($_GET['student_grade']) || !isset($_GET['student_id'])) {
        echo "Отсутствуют необходимые параметры!";
        exit;
    }

    $sql = sprintf("INSERT INTO `visits_group_student` (`visits_group_student_id`, `visit_id`, `student_id`, `student_grade`) VALUE (NULL, '%s', '%s', '%s')",
                    $_GET['visit_id'],
                    $_GET['student_id'],
                    $_GET['student_grade']
                );
    
    if(!$connect->query($sql)){
        echo "ошибка добавления данных!";
    }

    // Перенаправляем обратно на страницу посещений, передавая все необходимые параметры
    $redirect_url = "../visits/index.php?" . http_build_query([
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