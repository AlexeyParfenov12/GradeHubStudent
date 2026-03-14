<?php

include "../function/connect.php";



$sql = sprintf("UPDATE `tests` SET `test_name` = '%s' WHERE `test_id` = '%s'", $_POST['test_name'], $_POST['test_id']);



if (!$connect->query($sql)) {
    echo "Ошибка изменения!";
}

header("Location: ../../add_course_content/add_test/test.php");
exit;

?>