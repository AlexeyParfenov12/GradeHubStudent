<?php

session_start();
$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
if (file_exists($configPath))
  require_once $configPath;

include BASE_PATH . "/header/index.php";
include BASE_PATH . "/function/function.php";

if(!isset($_SESSION['username'])){
  header("Location:" . BASE_URL . "final_assessment/");
  exit;
}

?>


<section>
  <h1 class="titleSection">Добавление и удаление предмета</h1>
<h2 class="addGroup">Добавить предмет</h2>
<form action="<?= BASE_URL ?>controllers/add_course.php" method="post">
  <div class="addGroupeInputButton">
    <input class="addGroupeInput" type="text" name="name" />
    <input type="submit" class="addGroupButton" value="Добавить" />
  </div>
</form>

<h2 class="groupe">Удалить предмет</h2>
<div class="positionListGroup">
  <ul class="listGroup">
    <?php
      echo fnDeleteCourses();
    ?>
  </ul>
</div>

</section>

<section>
  <h1 class="titleSection">Добавление и удаление групп</h1>
<h2 class="addGroup">Добавить группу</h2>
<form action="<?= BASE_URL ?>controllers/add_group.php" method="post">
  <div class="addGroupeInputButton">
    <input class="addGroupeInput" type="text" name="name_group" />
    <input type="submit" class="addGroupButton" value="Добавить">
  </div>
</form>

<div></div>

<h2 class="groupe">Удалить группы</h2>
<div class="positionListGroup">
  <ul class="listGroup">
    <?php echo fnGroup(); ?>
  </ul>
</div>

</section>

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
    currentForm.submit();
  }
  closeModal();
}
</script>