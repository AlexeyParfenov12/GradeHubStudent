<?php

    session_start();
    include "../function/connect.php";

    $sql = sprintf("INSERT INTO `courses_group` (`group_id`, `course_id`) VALUE ('%s','%s')", 
    $_GET['id'],
    $_SESSION['course_id']
);

if (!$connect -> query($sql)){
        echo "Ошибка добавления данных!";
    }


    header("Location: ../groups/index.php");
    exit;

?>