<?php

    include "../function/connect.php";


    $sql = sprintf("DELETE FROM `students` WHERE `student_id` = '%s'", $_GET['id']);

    if (!$connect -> query($sql)){
        echo "Ошибка удаления!";
    }

    header("Location: ../add_course_content/add_students/students.php");
    exit;


?>