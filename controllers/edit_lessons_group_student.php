<?php

    session_start();



    include "../function/connect.php";

    $sql = sprintf("UPDATE `lessons_group_student` SET `student_grade`='%s' WHERE `lessons_group_student_id` = '%s'",
    $_GET['student_grade'],
    $_GET['lessons_group_student_id']
);

if (!$connect -> query($sql)){
    echo "Ошибка добавления данных!";
}

header("Location: ../lessons/index.php");
exit;

?>
