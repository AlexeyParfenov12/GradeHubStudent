<?php 
    session_start();
      $configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
      if (file_exists($configPath)) { require_once $configPath; }
      
      include BASE_PATH . "/header/index.php";
      include BASE_PATH . "/function/function.php";
      
    if (!isset($_SESSION['username'])) {
      header("Location:" . BASE_URL . "final_assessment/");
      exit;
    }
?>


    <div class="positionListStudent">
    <ul class="listStudent">
            <a class="aList" href="<?= BASE_URL ?>add_group_course/index.php">
                <li class="listItem">Добавить группу или курс</li>
            </a>
            <a class="aList" href="<?= BASE_URL ?>add_course_content/add_lesson/index.php">
                <li class="listItem">Редактор заданий</li>
            </a>
            <a class="aList" href="<?= BASE_URL ?>add_course_content/add_test/index.php">
                <li class="listItem">Редактор тестов</li>
            </a>
            <a class="aList" href="<?= BASE_URL ?>add_course_content/add_students/index.php">
                <li class="listItem">Добавить студента</li>
            </a>
    </ul>
</div>