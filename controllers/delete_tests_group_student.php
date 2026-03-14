<?php

include "../function/connect.php";


$sql = sprintf("DELETE FROM `tests_group` WHERE `tests_group_id` = '%s'", $_POST['tests_group_id']);

if (!$connect->query($sql)) {
    echo "Ошибка удаления!";
}


header("Location: ../tests/index.php");
exit;