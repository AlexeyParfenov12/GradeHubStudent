<?php

    session_start();
    include "../function/connect.php";

    $sql = sprintf("INSERT INTO `students` (`student_id`, `full_name`, `group_id`) VALUE (NULL, '%s', '%s')",
        $_POST['full_name'],
        $_SESSION['group_id']);

    if(!$connect->query($sql)){
        die ("Ошибка добавления студента!");
    }


    header("Location: ../add_course_content/add_students/students.php");
    exit;


?>




