<?php
  session_start();


include "function/function.php";


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

<h2 class="addGroup">Авторизация</h2>

<form class="auth-form" action="/controllers/login.php" method="POST">
    <!-- Блок с логином -->
    <div class="authInputButton" style="display: flex; display: flex; flex-direction: column; align-items: center; justify-content: space-between; align-content: space-between;">
        <?php
            if (isset($_GET['login'])) {
                echo "<p style='color: red;'>" . htmlspecialchars($_GET['login'], ENT_QUOTES, 'UTF-8') . "</p>";
            }
        ?>
        <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 10px;">
        <label style="display: block; color: #0056b3;" for="username">Логин</label>
        <input 
            class="authInput" 
            type="text" 
            id="username" 
            name="username" 
            required
        >
        </div>

    <!-- Блок с паролем -->
    <div style="display: flex;flex-direction: column; align-items: center; margin-bottom: 10px;">
        <label style="display: block; color: #0056b3;" for="password">Пароль</label>
        <input 
            class="authInput" 
            type="password" 
            id="password" 
            name="password" 
            required
        >
    </div>
    </div>

    <!-- Кнопка отправки -->
    <div class="authInputButton" style="display: flex;display: flex;flex-direction: row;align-items: center;justify-content: center;align-content: center;flex-wrap: wrap;">
    <input style="margin:10px;" type="submit" class="addGroupButton" value="Авторизоваться">
    <a href="final_assessment/index.php" style="text-decoration: none; color: white; background-color: #dc3545; margin: 10px;" class="addGroupButton">Я студент</a>
        </div>
</form>
     
  </body>
</html>

