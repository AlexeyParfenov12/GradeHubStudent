<?php

  session_start();
include "../header/index.php";
include "../function/function.php";


if(!isset($_SESSION['username'])){
  header("Location:" . BASE_URL . "final_assessment/");
  exit;
}
?>
<h2 class="groupe">Выбор предмета</h2>
<div class="positionListGroup">
  <ul class="listGroup">
    <?php
      echo fnAddCourses();
    ?>
  </ul>
</div>




</script>

</html>