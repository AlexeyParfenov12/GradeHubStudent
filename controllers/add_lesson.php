<?php

    session_start();

    include "../function/connect.php";

    $sql = sprintf("INSERT INTO `lessons` (`lesson_id`, `lesson_name`, `course_id`) VALUES (NULL, '%s', '%s')",
    $_POST['lesson_name'],
    $_SESSION['course_id']
);

if (!$connect -> query($sql)){
    echo "Ошибка добавления данных!";
}


header("Location: ../../add_course_content/add_lesson/lesson.php");
exit;

?>