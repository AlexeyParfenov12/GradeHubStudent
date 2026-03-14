<?php   
$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
    if(file_exists($configPath))
        require_once $configPath;

    session_start();

    include BASE_PATH . "/header/index.php";
    include BASE_PATH . "/function/function.php";
    

    if (isset($_GET['course_id'])) {
  $_SESSION['course_id'] = $_GET['course_id'];
    }
  
    if(!isset($_SESSION['username'])){
  header("Location:" . BASE_URL . "final_assessment/");
  exit;

}



?>



<h1 class="title">Список тестов</h1>
<h2 class="addGroup">Добавить тест</h2>
<form action="<?= BASE_URL ?>controllers/add_test.php" method="post">
  <div class="addGroupeInputButton">
    <input class="addGroupeInput" type="text" name="test_name" />
    <input type="submit" class="addGroupButton" value="Добавить">
  </div>
</form>
<ol class="studentList">
  <? echo fnTestItems($_SESSION['course_id']); ?>
</ol>

<div class="modal" id="modalEdit">
  <p style="color:#0056b3; text-align: center;">Изменить имя теста</p>
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
      let hidden = currentForm.querySelector('input[name="test_name"]');
      if (!hidden) {
        hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'test_name';
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