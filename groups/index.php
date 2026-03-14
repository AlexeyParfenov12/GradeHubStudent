<?php

$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
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


if (isset($_GET['id'])) {
  $_SESSION['course_id'] = $_GET['id'];
}

$_SESSION['name_course'] = $_GET['name_course'];

?>

<h1 class="groupe"><? echo $_GET['name_course']?></h1>
<h2 class="groupe">Выбор группы</h2>
<div class="positionListGroup">
  <ul class="listGroup">
    <?php echo fnAddGroupe($_SESSION['course_id']); ?>
    <button class="aList" onclick="showModalAddGroup()"><li class="listItem"><img src="<?= BASE_URL ?>assets/img/icons8-plus-96.png" height="40px" alt=""></li></button>
    </a>
  </ul>
</div>


<div class="modal" id="modal">
  <p style="color:#0056b3; text-align: center;">Вы действительно хотите удалить?</p>
  <div class="modalFlex">
    <input style="background-color: #dc3545;" type="button" class="addGroupButton" value="Удалить" onclick="confirmDelete()">
    <input type="button" class="addGroupButton" value="Отмена" onclick="closeModal()">
  </div>
</div>

<div class="modal" id="modalAddGroup">
  <p style="color:#0056b3; text-align: center;">Выберете группы из списка</p>
  <div class="positionListGroup">
    <ul class="listGroup">
      <?php echo fnAddGroupeItems($_SESSION['course_id']); ?>
      
    </ul>
    <input type="button" class="addGroupButton" value="Отмена" onclick="closeModalAddGroup()">
  </div>
</div>

<script>

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

  function showModalAddGroup(event) {
    const modal = document.getElementById('modalAddGroup');
    modal.style.display = 'block';
  }

  function closeModalAddGroup() {
    const modal = document.getElementById('modalAddGroup');
    modal.style.display = 'none';
  }

  


</script>

</body>



</html>