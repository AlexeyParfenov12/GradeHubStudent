<?php

include "../function/connect.php";


$sql = sprintf("DELETE FROM `visits` WHERE `visit_id` = '%s'", $_GET['id']);

if (!$connect->query($sql)) {
    echo "Ошибка удаления!";
}

header("Location: ../visits/index.php");
exit;