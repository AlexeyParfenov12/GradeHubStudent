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
// visit_id - ID посещения, student_grade - оценка студента (1 или 0), student_id - ID студента
if (!isset($_GET['visit_id']) || !isset($_GET['student_grade']) || !isset($_GET['student_id'])) {
    // Если параметры отсутствуют, возвращаем JSON с ошибкой
    echo json_encode(['success' => false, 'message' => 'Отсутствуют необходимые параметры']);
    exit; // Прекращаем выполнение скрипта
}

// Формируем SQL-запрос для вставки данных в таблицу visits_group_student
// visits_group_student_id - автоинкрементное поле, поэтому указываем NULL
// visit_id - ID посещения из параметра
// student_id - ID студента из параметра запроса
// student_grade - оценка студента из параметра
$sql = sprintf("INSERT INTO `visits_group_student` (`visits_group_student_id`, `visit_id`, `student_id`, `student_grade`) VALUE (NULL, '%s', '%s', '%s')",
                $_GET['visit_id'],      // ID посещения
                $_GET['student_id'],            // ID студента из параметра запроса
                $_GET['student_grade']          // Оценка студента (1 или 0)
            );

// Выполняем SQL-запрос
if(!$connect->query($sql)){
    // Если запрос не выполнен, возвращаем JSON с ошибкой
    echo json_encode(['success' => false, 'message' => 'Ошибка добавления данных!']);
    exit; // Прекращаем выполнение скрипта
}

// Если все прошло успешно, возвращаем JSON с сообщением об успехе
echo json_encode(['success' => true, 'message' => 'Данные успешно добавлены']);
exit; // Прекращаем выполнение скрипта
?>