<?php
// Подключаем файл для соединения с базой данных
include "../function/connect.php";

// Проверяем, что запрос пришел методом GET
// Это необходимо для безопасности, чтобы убедиться, что данные передаются правильно
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    // Если метод не GET, возвращаем JSON с ошибкой
    echo json_encode(['success' => false, 'message' => 'Неверный метод запроса']);
    exit; // Прекращаем выполнение скрипта
}

// Проверяем наличие необходимых параметров в GET-запросе
// visits_group_student_id - ID записи в таблице visits_group_student
// student_grade - новая оценка студента (1 или 0)
if (!isset($_GET['visits_group_student_id']) || !isset($_GET['student_grade'])) {
    // Если параметры отсутствуют, возвращаем JSON с ошибкой
    echo json_encode(['success' => false, 'message' => 'Отсутствуют необходимые параметры']);
    exit; // Прекращаем выполнение скрипта
}

// Формируем SQL-запрос для обновления данных в таблице visits_group_student
// Обновляем поле student_grade для записи с указанным visits_group_student_id
$sql = sprintf("UPDATE `visits_group_student` SET `student_grade`='%s' WHERE `visits_group_student_id` = '%s'",
    $_GET['student_grade'],             // Новая оценка студента (1 или 0)
    $_GET['visits_group_student_id']   // ID записи в таблице visits_group_student
);

// Выполняем SQL-запрос
if (!$connect -> query($sql)){
    // Если запрос не выполнен, возвращаем JSON с ошибкой
    echo json_encode(['success' => false, 'message' => 'Ошибка обновления данных!']);
    exit; // Прекращаем выполнение скрипта
}

// Если все прошло успешно, возвращаем JSON с сообщением об успехе
echo json_encode(['success' => true, 'message' => 'Данные успешно обновлены']);
exit; // Прекращаем выполнение скрипта
?>