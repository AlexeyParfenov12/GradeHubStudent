<?php

    session_start();

    include "../function/connect.php";

    $sql = sprintf("INSERT INTO `tests` (`test_id`, `test_name`, `course_id`) VALUES (NULL, '%s', '%s')",
    $_POST['test_name'],
    $_SESSION['course_id']
);

if (!$connect -> query($sql)){
    echo "Ошибка добавления данных!";
}


header("Location: ../../add_course_content/add_test/test.php");
exit;

?>