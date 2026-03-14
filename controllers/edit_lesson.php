<?php

include "../function/connect.php";



$sql = sprintf("UPDATE `lessons` SET `lesson_name` = '%s' WHERE `lesson_id` = '%s'", $_POST['lesson_name'], $_POST['lesson_id']);



if (!$connect->query($sql)) {
    echo "Ошибка изменения!";
}

header("Location: ../../add_course_content/add_lesson/lesson.php");
exit;

?>