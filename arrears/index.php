<?php
session_start();



$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
if (file_exists($configPath)) {
  require_once $configPath;
}


include BASE_PATH . "/header/index.php";
include BASE_PATH . "/function/function.php";

// Получаем данные из GET-параметров
$student_id = isset($_GET['studentId']) ? $_GET['studentId'] : null;
$name_student = isset($_GET['name_student']) ? $_GET['name_student'] : null;
$course_id = isset($_GET['course_id']) ? $_GET['course_id'] : null;
$name_course = isset($_GET['name_course']) ? $_GET['name_course'] : null;
$group_id = isset($_GET['group_id']) ? $_GET['group_id'] : null;
$name_group = isset($_GET['name_group']) ? $_GET['name_group'] : null;

// Проверяем, что все необходимые параметры переданы
if (!$student_id || !$name_student || !$course_id || !$name_course || !$group_id || !$name_group) {
  // Если параметры не переданы, перенаправляем на главную страницу студентов
  header("Location: " . BASE_URL . "final_assessment/index.php");
  exit;
}

?>
<h1 class="groupe"><? echo htmlspecialchars($name_course) ?></h1>
<h2 class="groupe" style="font-size: 16px;"><? echo htmlspecialchars($name_group) ?></h2>
<h2 class="groupe" style="font-size: 14px; margin:10px"><? echo htmlspecialchars($name_student) ?></h2>
<h2 class="groupe" style="text-align: justify; margin-left:5%" onclick="toggleContent('tasks')">Задания <span class="toggle-icon" style="font-size: 12px; vertical-align: middle; color: #5f5f5f;">Раскрыть</span></h2>
<div class="positionListLesson" id="tasks" style="display: none;">
  <ol class="lessonList">
    <?php echo fnLessonStudentArrears($student_id, $course_id, $group_id); ?>
  </ol>
</div>

<h2 class="groupe" style="text-align: justify; margin-left:5%" onclick="toggleContent('tests')">Тесты <span class="toggle-icon" style="font-size: 12px; vertical-align: middle; color: #5f5f5f;">Раскрыть</span></h2>
<div class="positionListTest" id="tests" style="display: none;">
  <ol class="lessonList">
    <?php echo fnTestsStudentArrears($student_id, $course_id, $group_id); ?>
  </ol>
</div>

<h2 class="groupe" style="text-align: justify; margin-left:5%" onclick="toggleContent('visits')">Посещения <span class="toggle-icon" style="font-size: 12px; vertical-align: middle; color: #5f5f5f;">Раскрыть</span></h2>
<div class="positionListvisit" id="visits" style="display: none;">
  <ol class="lessonList">
    <?php echo fnVisitsStudentArrears($student_id, $course_id, $group_id); ?>
  </ol>
</div>

<script>
  function toggleContent(elementId) {
    var element = document.getElementById(elementId);
    var icon = document.querySelector(`.groupe[onclick*="${elementId}"] .toggle-icon`);

    if (element.style.display === 'none' || element.style.display === '') {
      element.style.display = 'block';
      icon.innerHTML = 'Закрыть';
    } else {
      element.style.display = 'none';
      icon.innerHTML = 'Раскрыть';
    }
  }
</script>