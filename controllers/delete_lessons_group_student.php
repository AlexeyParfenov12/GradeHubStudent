<?php

include "../function/connect.php";


$sql = sprintf("DELETE FROM `lessons_group` WHERE `lessons_group_id` = '%s'", $_POST['lessons_group_id']);

if (!$connect->query($sql)) {
    echo "Ошибка удаления!";
}

header("Location: ../lessons/index.php");
exit;