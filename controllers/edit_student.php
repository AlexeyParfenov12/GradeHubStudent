<?php

    include "../function/connect.php";



    $sql = sprintf("UPDATE `students` SET `full_name` = '%s' WHERE `student_id` = '%s'", $_POST['full_name'], $_POST['student_id'] );



    if (!$connect -> query($sql)){
        echo "Ошибка удаления!";
    }

    header("Location: ../add_course_content/add_students/students.php");
    exit;


?>