<?php

    session_start();
    include "../function/connect.php";

    $sql = sprintf("INSERT INTO `lessons_group`(`lessons_group_id`, `lesson_id`, `group_id`) VALUES (NULL,'%s','%s')", 
    $_GET['id'],
    $_SESSION['group_id']
);

if (!$connect -> query($sql)){
        echo "Ошибка добавления данных!";
    }


    header("Location: ../lessons/index.php");
    exit;

?>