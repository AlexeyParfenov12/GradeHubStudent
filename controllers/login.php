<?php

session_start();

include "../function/connect.php";



$sql = sprintf("SELECT * FROM `users` WHERE `login` = '%s' AND `password` = '%s'",
    $_POST['username'],
    $_POST['password']
);



if (!$result = $connect->query($sql)) {
    echo "Ошибка изменения!";
}

if ($row = $result->fetch_assoc()){

    $_SESSION['username'] = $row['role'];

    header("Location: ../courses/index.php");
    exit;

}
else{
    header("Location: ../index.php?login=Неверный логин или пароль!");
    exit;
}
