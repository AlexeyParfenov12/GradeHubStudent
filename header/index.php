<?php

      $configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
      if (file_exists($configPath)) { require_once $configPath; }

      $data = '';
 
      if(isset($_SESSION['username'])){
        // Проверяем, является ли пользователь студентом
        // Предполагаем, что студенты имеют роль 'student' или другую специфическую роль
        if (!$_SESSION['username'] === 'Admin') {
          // Для студента
          $data .= '<li><a href="' . BASE_URL . 'final_assessment/index.php" class="backLink">Оценки студентов</a></li>
                    <li><a href="javascript:history.go(-1)" title="Вернуться на предыдущую страницу">Назад</a></li>
                    <li><a href="' . BASE_URL . 'controllers/logout.php" class="backLink" style="color: red;">Выход</a></li>';
        } else {
          // Для администратора и других ролей
          $data .= '<li><a href="' . BASE_URL . 'courses/index.php" class="backLink">Предметы</a></li>
                    <li><a href="' . BASE_URL . 'final_assessment/index.php" class="backLink">Оценки студентов</a></li>
                    <li><a href="' . BASE_URL . 'admin/index.php" class="backLink" style="color: red;">Админ-панель</a></li>
                    <li><a href="javascript:history.go(-1)" title="Вернуться на предыдущую страницу">Назад</a></li>
                    <li><a href="' . BASE_URL . 'controllers/logout.php" class="backLink" style="color: red;">Выход</a></li>';
        }
      }else{
        $data .= '<li><a href="' . BASE_URL . 'final_assessment/index.php" class="backLink">Оценки студентов</a></li>
                  <li><a href="javascript:history.go(-1)" title="Вернуться на предыдущую страницу">Назад</a></li>';
      }

    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../assets/img/unnamed.png" type="image/png">
    <!-- <link rel="stylesheet" href="../style.css" /> -->
    <link rel="stylesheet" href="<?php echo (defined('BASE_URL') ? BASE_URL : '/'); ?>style.css" />
    <title>Учет успеваемости</title>
  </head>
  <body>
    <input type="checkbox" id="navToggle" style="display:none;" />
    <div class="buttonNav">
      <label for="navToggle" aria-label="Открыть меню">
        <!-- burger icon: 3 horizontal lines -->
        <svg viewBox="0 0 28 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 5h22" stroke-width="3" stroke-linecap="round"/>
          <path d="M3 12h22" stroke-width="3" stroke-linecap="round"/>
          <path d="M3 19h22" stroke-width="3" stroke-linecap="round"/>
        </svg>
      </label>
    </div>
    <header class="header">
      <ul>
        <? echo $data ?>        
      </ul>

    </header>
    <script>
      // Close mobile menu after clicking a link
      document.addEventListener('click', function(e) {
        var link = e.target.closest('header a');
        if (link) {
          var toggle = document.getElementById('navToggle');
          if (toggle) toggle.checked = false;
        }
      });
    </script>