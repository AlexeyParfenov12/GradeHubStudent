<?php
session_start();

if(!isset($_SESSION['username'])){
  header("Location:" . BASE_URL . "final_assessment/");
  exit;
}

$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
    if(file_exists($configPath))
        require_once $configPath;

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

<h1 class="groupe"><? echo htmlspecialchars($name_course) ?></h1>
<h2 class="groupe" style="font-size: 16px;"><? echo htmlspecialchars($name_group) ?></h2>
<h2 class="groupe" style="font-size: 14px; margin:10px"><? echo htmlspecialchars($name_student) ?></h2>
<h1 class="title" style="font-size: 20px; margin-top:50px">Посещения</h1>
<form action="<?= BASE_URL ?>controllers/add_visit.php" method="post">
  <div class="addGroupeInputButton">
    <input class="addGroupeInputDate" type="date" name="visit_name" />
    <!-- Передаем все необходимые параметры в скрытых полях -->
    <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>">
    <input type="hidden" name="name_student" value="<?php echo htmlspecialchars($name_student); ?>">
    <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>">
    <input type="hidden" name="name_course" value="<?php echo htmlspecialchars($name_course); ?>">
    <input type="hidden" name="group_id" value="<?php echo htmlspecialchars($group_id); ?>">
    <input type="hidden" name="name_group" value="<?php echo htmlspecialchars($name_group); ?>">
    <input type="submit" class="addGroupButton" value="Добавить">
  </div>
</form>
<ol style="margin-left: 20%; margin-right: 20%;" class="studentList">
  <? echo fnVisitsItems($course_id, $group_id, $student_id); ?>
</ol>

<div class="modal" id="modalEdit">
  <p style="color:#0056b3; text-align: center;">Изменить дату</p>
  <div class="modalFlex" style="margin-bottom: 10px;">
    <input class="addGroupeInput" type="date" id="editFullNameInput" placeholder="Новое имя">
  </div>
  <div class="modalFlex">
    <input type="button" class="addGroupButton" value="Изменить" onclick="confirmEdit()">
    <input type="button" class="addGroupButton" value="Отмена" onclick="closeModalEdit()">
  </div>
</div>

<div class="modal" id="modal">
  <p style="color:#0056b3; text-align: center;">Вы действительно хотите удалить?</p>
  <div class="modalFlex">
    <input style="background-color: #dc3545;" type="button" class="addGroupButton" value="Удалить" onclick="confirmDelete()">
    <input type="button" class="addGroupButton" value="Отмена" onclick="closeModal()">
  </div>
</div>

<script>
  let currentForm = null;

  function showModal(event) {
    event.preventDefault();
    currentForm = event.target.closest('form');
    const modal = document.getElementById('modal');
    modal.style.display = 'block';
  }

  function closeModal() {
    const modal = document.getElementById('modal');
    modal.style.display = 'none';
    currentForm = null;
  }

  function confirmDelete() {
    if (currentForm) {
      // Добавляем скрытые поля с параметрами в форму
      const hiddenInputs = `
        <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>">
        <input type="hidden" name="name_student" value="<?php echo htmlspecialchars($name_student); ?>">
        <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>">
        <input type="hidden" name="name_course" value="<?php echo htmlspecialchars($name_course); ?>">
        <input type="hidden" name="group_id" value="<?php echo htmlspecialchars($group_id); ?>">
        <input type="hidden" name="name_group" value="<?php echo htmlspecialchars($name_group); ?>">
      `;
      
      // Добавляем скрытые поля в форму
      currentForm.insertAdjacentHTML('beforeend', hiddenInputs);
      
      currentForm.submit();
    }
    closeModal();
  }

  function showModalEdit(event) {
    event.preventDefault();
    currentForm = event.target.closest('form');
    const modal = document.getElementById('modalEdit');
    const input = document.getElementById('editFullNameInput');
    modal.style.display = 'block';
  }

  function closeModalEdit() {
    const modal = document.getElementById('modalEdit');
    modal.style.display = 'none';
  }

  function confirmEdit() {
    if (currentForm) {
      const input = document.getElementById('editFullNameInput');
      const newName = input.value;
      let hidden = currentForm.querySelector('input[name="visit_name"]');
      if (!hidden) {
        hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'visit_name';
        currentForm.appendChild(hidden);
      }
      hidden.value = newName;
      
      // Добавляем скрытые поля с параметрами в форму
      const hiddenInputs = `
        <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>">
        <input type="hidden" name="name_student" value="<?php echo htmlspecialchars($name_student); ?>">
        <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>">
        <input type="hidden" name="name_course" value="<?php echo htmlspecialchars($name_course); ?>">
        <input type="hidden" name="group_id" value="<?php echo htmlspecialchars($group_id); ?>">
        <input type="hidden" name="name_group" value="<?php echo htmlspecialchars($name_group); ?>">
      `;
      
      // Добавляем скрытые поля в форму
      currentForm.insertAdjacentHTML('beforeend', hiddenInputs);
      
      currentForm.method = 'post';
      currentForm.submit();
    }
    closeModal();
  }

  document.addEventListener('DOMContentLoaded', function() {
    const dropdownItems = document.querySelectorAll('.dropdown');

    dropdownItems.forEach((dropdown) => {
      dropdown.addEventListener('click', function(e) {
        e.stopPropagation();

        document.querySelectorAll('.dropdown-content').forEach((contentEl) => {
          if (contentEl !== dropdown.querySelector('.dropdown-content')) {
            contentEl.style.display = 'none';
          }
        });

        const content = this.querySelector('.dropdown-content');
        content.style.display = content.style.display === 'block' ? 'none' : 'block';
      });

      const content = dropdown.querySelector('.dropdown-content');
      if (content) {
        content.addEventListener('click', function(e) {
          e.stopPropagation();
        });
      }
    });

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