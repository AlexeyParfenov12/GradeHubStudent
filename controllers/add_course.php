<?php

$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
    if(file_exists($configPath))
        require_once $configPath;

    session_start();

    include BASE_PATH . "/function/connect.php";

    

    $sql = sprintf("INSERT INTO `courses` (`course_id`, `name_course`) VALUES (NULL, '%s')",
    $_POST['name']
);

if (!$connect -> query($sql)){
    echo "Ошибка добавления данных!";
}

header("Location: ../add_group_course/index.php");
exit;

?>