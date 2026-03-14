<?php

include "../function/connect.php";


$sql = sprintf("DELETE FROM `lessons` WHERE `lesson_id` = '%s'", $_GET['id']);

if (!$connect->query($sql)) {
    echo "Ошибка удаления!";
}

header("Location: ../../add_course_content/add_lesson/lesson.php");
exit;
