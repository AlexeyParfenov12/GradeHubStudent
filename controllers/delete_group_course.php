<?php

    include "../function/connect.php";

    $sql = sprintf("DELETE FROM `courses_group` WHERE `courses_group_id` = '%s'", $_GET['id']);

    if (!$connect -> query($sql)){
        echo "Ошибка удаления!";
    }

    header("Location: ../groups/index.php");
    exit;

?>