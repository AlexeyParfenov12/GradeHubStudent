<?php

    include "../function/connect.php";

    $sql = sprintf("DELETE FROM `groups` WHERE `group_id` = '%s'", $_GET['id']);

    if (!$connect -> query($sql)){
        echo "Ошибка удаления!";
    }

    header("Location: ../add_group_course/index.php");
    exit;

?>