<?php

    session_start();

    include "../function/connect.php";

    $sql = sprintf("INSERT INTO `lessons_group_student` (`lessons_group_student_id`, `lessons_group_id`, `student_id`, `student_grade`) VALUE (NULL, '%s', '%s', '%s')",
                    $_GET['lessons_group_id'],
                    $_SESSION['student_id'],
                    $_GET['student_grade']
                );
    
    if(!$connect->query($sql)){
        echo "ошибка добавления данных!";
    }

    header("location: ../lessons/index.php");
    exit;
?>

