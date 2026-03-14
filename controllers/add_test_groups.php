<?php

    session_start();
    include "../function/connect.php";

    $sql = sprintf("INSERT INTO `tests_group`(`tests_group_id`, `test_id`, `group_id`) VALUES (NULL,'%s','%s')", 
    $_GET['id'],
    $_SESSION['group_id']
);

if (!$connect -> query($sql)){
        echo "Ошибка добавления данных!";
    }


    header("Location: ../tests/index.php");
    exit;

?>