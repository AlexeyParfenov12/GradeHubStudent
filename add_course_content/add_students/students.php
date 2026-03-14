<?php

$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
if (file_exists($configPath)) {
    require_once $configPath;
}

session_start();
include BASE_PATH . "/header/index.php";

include BASE_PATH . "/function/function.php";

if(!isset($_SESSION['username'])){
  header("Location:" . BASE_URL . "final_assessment/");
  exit;
}



if (isset($_GET['group_id'])) {
  $_SESSION['group_id'] = $_GET['group_id'];
}

?>

<h1 class="title">Список студентов</h1>
<h2 class="addGroup">Добавить студента</h2>
<form action="<?= BASE_URL ?>controllers/student_items.php" method="post">
  <div class="addGroupeInputButton">
    <input class="addGroupeInput" type="text" name="full_name" />
    <input type="submit" class="addGroupButton" value="Добавить">
  </div>
</form>
<ol class="studentList">
  <? echo fnStudentItems($_SESSION['group_id']); ?>
</ol>


<div class="modal" id="modalEdit">
  <p style="color:#0056b3; text-align: center;">Изменить имя студента</p>
  <div class="modalFlex" style="margin-bottom: 10px;">
    <input class="addGroupeInput" type="text" id="editFullNameInput" placeholder="Новое имя">
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
    const modalEdit = document.getElementById('modal');
    modal.style.display = 'none';
    currentForm = null;
  }

  function confirmDelete() {
    if (currentForm) {
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
      // Ensure form has hidden full_name with modal value
      const input = document.getElementById('editFullNameInput');
      const newName = input.value;
      let hidden = currentForm.querySelector('input[name="full_name"]');
      if (!hidden) {
        hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'full_name';
        currentForm.appendChild(hidden);
      }
      hidden.value = newName;
      // Force POST method for edit
      currentForm.method = 'post';
      currentForm.submit();
    }
    closeModal();
  }
</script>
</body>

</html>