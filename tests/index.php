<?php
session_start();

if(!isset($_SESSION['username'])){
  header("Location:" . BASE_URL . "final_assessment/");
  exit;
}
$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
if (file_exists($configPath)) {
  require_once $configPath;
}

include BASE_PATH . "/header/index.php";
include BASE_PATH . "/function/function.php";

// Получаем данные из GET-параметров
$student_id = isset($_GET['student_id']) ? $_GET['student_id'] : null;
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

<h1 class="groupe"><? echo htmlspecialchars($name_course)?></h1>
<h2 class="groupe" style="font-size: 16px;"><? echo htmlspecialchars($name_group)?></h2>
<h2 class="groupe" style="font-size: 14px; margin:10px"><? echo htmlspecialchars($name_student)?></h2>
<h2 class="groupe" style="font-size: 20px; margin-top:50px">Тесты группы</h2>
<div class="positionListGroup">
  <ol class="lessonList">
    <?php echo fnAddTestGroupItems($group_id, $course_id, $student_id); ?>
  </ol>
</div>

<h2 class="groupe">Добавить из существующих</h2>
<div class="positionListGroup">
  <ol class="lessonList">
    
  </ol>
</div>

<div class="positionListGroup">
    <ol class="lessonList">
        <li class="dropdown">
            <a style="text-decoration:none; color:#0056b3" href="javascript:void(0)">
                <div class="liLessons">
                    <p style="grid-column: 1;margin-left: 3%; align-items:center;">Добавьте тест в группу</p>
                    <img height="25px" style="grid-column: 2;" src="../assets/img/arrow-angle-down-circle.svg">
                </div>
            </a>
            <div class="dropdown-content">
                <ol class="lessonListItems">
                    <?php echo fnAddTestGroup($course_id, $group_id); ?>
                </ol>
            </div>
        </li>
    </ol>
</div>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    const dropdownItems = document.querySelectorAll('.dropdown');

    dropdownItems.forEach((dropdown) => {
      dropdown.addEventListener('click', function(e) {
        e.stopPropagation();

        // Close all other dropdowns
        document.querySelectorAll('.dropdown-content').forEach((contentEl) => {
          if (contentEl !== dropdown.querySelector('.dropdown-content')) {
            contentEl.style.display = 'none';
          }
        });

        // Toggle current dropdown
        const content = this.querySelector('.dropdown-content');
        content.style.display = content.style.display === 'block' ? 'none' : 'block';
      });

      // Prevent clicks inside content from closing immediately via document handler
      const content = dropdown.querySelector('.dropdown-content');
      if (content) {
        content.addEventListener('click', function(e) {
          e.stopPropagation();
        });
      }
    });

    // Hide dropdowns on outside click
    document.addEventListener('click', function() {
      document.querySelectorAll('.dropdown-content').forEach((contentEl) => {
        contentEl.style.display = 'none';
      });
    });
});


document.addEventListener('DOMContentLoaded', function() {
  const checkboxes = document.querySelectorAll('.checkboxLesson');
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      // Получаем данные из формы
      const form = this.closest('form');
      const formData = new FormData(form);
      // Получаем все параметры из формы
      const params = new URLSearchParams(formData);
      
      // Явно устанавливаем значение student_grade в зависимости от состояния чекбокса
      params.set('student_grade', this.checked ? '1' : '0');
      
      // Добавляем все необходимые параметры к запросу, если их нет в форме
      if (!params.has('student_id')) {
        params.append('student_id', '<?php echo $student_id; ?>');
      }
      if (!params.has('course_id')) {
        params.append('course_id', '<?php echo $course_id; ?>');
      }
      if (!params.has('group_id')) {
        params.append('group_id', '<?php echo $group_id; ?>');
      }
      
      // Определяем URL для AJAX-запроса
      const action = form.getAttribute('action');
      const url = action + '?' + params.toString();
      
      // Выполняем AJAX-запрос
      fetch(url)
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            console.log('Данные успешно обновлены');
            // Можно добавить уведомление об успешном обновлении
          } else {
            console.error('Ошибка при обновлении данных:', data.message);
            // Отменяем изменение чекбокса в случае ошибки
            checkbox.checked = !checkbox.checked;
            // Можно добавить уведомление об ошибке
          }
        })
        .catch(error => {
          console.error('Ошибка при выполнении запроса:', error);
          // Отменяем изменение чекбокса в случае ошибки
          checkbox.checked = !checkbox.checked;
          // Можно добавить уведомление об ошибке
        });
    });
  });
});

</script>

</body>