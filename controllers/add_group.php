<?php

    session_start();

    include "../function/connect.php";

    $sql = sprintf("INSERT INTO `groups` (`group_id`, `name_group`) VALUE (NULL, '%s')",
    $_POST['name_group']);


    if (!$connect -> query($sql)){
        echo "Ошибка добавления данных!";
    }

    header("Location: ../add_group_course/index.php");
    exit;

?>