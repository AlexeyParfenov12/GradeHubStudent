<?php

$configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
if (file_exists($configPath)) {
    require_once $configPath;
}

include "connect.php";



function fnAddCourses()
{

    global $connect;

    $sql = "SELECT `course_id`, `name_course` FROM `courses`";




    if (!$resultLesson = $connect->query($sql)) {
        echo "Ошибка плучения данных!";
    }

    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf('
                <a class="aList" href="../groups/index.php?id=%s&name_course=%s">
                    <li class="listItem">%s</li>
                </a>
            ', $rowLesson['course_id'], $rowLesson['name_course'], $rowLesson['name_course']);
    }

    return $data;
}

function fnDeleteCourses()
{

    global $connect;

    $sql = "SELECT `course_id`, `name_course` FROM `courses`";




    if (!$resultLesson = $connect->query($sql)) {
        echo "Ошибка плучения данных!";
    }

    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf('
                <a class="aList" href="">
                    <li class="listItem">%s</li>
                    <form class="formBtnDelete" method="get" action="../controllers/delete_course.php">
                        <input type="hidden" name="id" value="%s">
                        <button onclick="showModal(event)" type="button" class="btnDelete"></button>
                    </form>
                </a>
            ', $rowLesson['name_course'], $rowLesson['course_id']);
    }

    return $data;
}




function fnAddGroupe($id)
{

    global $connect;


    $sql = sprintf("SELECT `groups`.`group_id`, `courses_group_id`, `name_group` FROM `groups` INNER JOIN `courses_group` ON `courses_group`.`group_id` = `groups`.`group_id` WHERE '%s' = `courses_group`.`course_id`", $id);




    if (!$resultLesson = $connect->query($sql)) {
        echo "Ошибка плучения данных!";
    }


    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf('
                 <a class="aList" href="../students_item/index.php?group_id=%s&name_group=%s">
                    <li class="listItem">%s</li>
                    <form class="formBtnDelete" method="get" action="../controllers/delete_group_course.php">
                        <input type="hidden" name="id" value="%s">
                        <button onclick="showModal(event)" type="button" class="btnDelete"></button>
                    </form>
                </a>
                
                
            ', $rowLesson['group_id'], $rowLesson['name_group'], $rowLesson['name_group'], $rowLesson['courses_group_id']);
    }

    return $data;
}


function fnAddGroupeItems($id)
{

    global $connect;

    $sql = sprintf("SELECT * FROM `groups` WHERE `group_id` NOT IN (
    SELECT `group_id`
    FROM `courses_group`
    WHERE `course_id` = '%s')", $id);




    if (!$resultLesson = $connect->query($sql)) {
        echo "Ошибка плучения данных!";
    }

    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf('
                 <a class="aList" href="../controllers/group_course.php?id=%s"><li class="listItem">%s</li></a>
            ', $rowLesson['group_id'], $rowLesson['name_group']);
    }

    return $data;
}

function fnGroup()
{

    global $connect;


    $sql = sprintf("SELECT `group_id`, `name_group` FROM `groups`");




    if (!$resultLesson = $connect->query($sql)) {
        echo "Ошибка плучения данных!";
    }

    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf('
                  <a class="aList" href="">
                    <li class="listItem">%s</li>
                    <form class="formBtnDelete" method="get" action="../controllers/delete_group.php">
                        <input type="hidden" name="id" value="%s">
                        <button onclick="showModal(event)" type="button" class="btnDelete"></button>
                    </form>
                </a>
            ', $rowLesson['name_group'], $rowLesson['group_id']);
    }

    return $data;
}


function fnStudentItems($id)
{


    global $connect;

    $sql = sprintf("SELECT `student_id`, `full_name` FROM `students` WHERE '%s' = `group_id`", $id);

    if (!$resultLesson = $connect->query($sql)) {
        die('Ошибка добавления студентов!');
    }



    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf(
            '<div class="liStudents">
                <li>%s</li>
                <div class="flexButtonsStudents">
                    <form  method="post" action="../../controllers/edit_student.php">
                        <input type="hidden" name="student_id" value="%s">
                        <button onclick="showModalEdit(event)" type="button" class="editStudent" data-name="%s">Редактировать</button>
                    </form>
                    <form  method="get" action="../../controllers/delete_student.php">
                        <input type="hidden" name="id" value="%s">
                        <button onclick="showModal(event)" type="button" class="deleteStudent">Удалить</button>
                    </form>
                </div>
            </div>',
            $rowLesson['full_name'],
            $rowLesson['student_id'],
            $rowLesson['full_name'],
            $rowLesson['student_id']
        );
    }

    return $data;
}

function fnLessonItems($id)
{


    global $connect;

    $sql = sprintf("SELECT `lesson_id`, `lesson_name` FROM `lessons` WHERE '%s' = `course_id`", $id);

    if (!$resultLesson = $connect->query($sql)) {
        die('Ошибка добавления заданий!');
    }



    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf(
            '<a style="text-decoration:none; color:#0056b3" href="../../add_course_content/add_lesson/lesson.php">
    <div class="liStudents">
    <li>%s</li>
    <div class="flexButtonsStudents">
        <form  method="post" action="../../controllers/edit_lesson.php">
            <input type="hidden" name="lesson_id" value="%s">
            <button onclick="showModalEdit(event)" type="button" class="editStudent" data-name="%s">Редактировать</button>
        </form>
        <form  method="get" action="../../controllers/delete_lesson.php">
            <input type="hidden" name="id" value="%s">
            <button onclick="showModal(event)" type="button" class="deleteStudent">Удалить</button>
        </form>
    </div>
  </div></a>',
            $rowLesson['lesson_name'],
            $rowLesson['lesson_id'],
            $rowLesson['lesson_name'],
            $rowLesson['lesson_id']
        );
    }

    return $data;
}


function fnAddLesson()
{

    global $connect;

    $sql = "SELECT `course_id`, `name_course` FROM `courses`";
    // $sql = sprintf("SELECT `group_id`, `name_group` FROM `groups` WHERE");




    if (!$resultLesson = $connect->query($sql)) {
        echo "Ошибка плучения данных!";
    }

    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf('
                <a class="aListLessonsTests" href="/../add_course_content/add_lesson/lesson.php?course_id=%s">
                    <li class="listItem">%s</li>
                </a>
            ', $rowLesson['course_id'], $rowLesson['name_course']);
    }

    return $data;
}


function fnAddLessonsGroup($id, $groupId)
{


    global $connect;

    $sql = sprintf("SELECT * FROM lessons WHERE lesson_id NOT IN ( 
        SELECT lesson_id 
        FROM lessons_group 
        WHERE group_id = '%s' ) 
    AND course_id = %s;", $groupId, $id);





    if (!$resultLesson = $connect->query($sql)) {
        echo "Ошибка плучения данных!";
    }

    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf('
                 <a style="text-decoration:none; color:#0056b3" href="../controllers/add_lessons_groups.php?id=%s">
                 <div class="liLessons">
                 <li>%s</li>
                 </div>
                 </a>
            ', $rowLesson['lesson_id'], $rowLesson['lesson_name']);
    }

    return $data;
}

function fnAddLessonsGroupItems($groupId, $courseId, $studentId)
{


    global $connect;

    $studentGrade = sprintf(
        "SELECT `lessons_group`.`lessons_group_id`, `lessons_group`.`lesson_id`, `lessons_group_student_id`, `student_grade`, `lesson_name` 
                            FROM `lessons` 
                            INNER JOIN `lessons_group` 
                                    ON `lessons`.`lesson_id` = `lessons_group`. `lesson_id` 
                            LEFT JOIN `lessons_group_student` 
                                    ON `lessons_group`.`lessons_group_id` = `lessons_group_student`.`lessons_group_id`
                                    AND `lessons_group_student`.`student_id` = '%s' 
                            WHERE 
                                    `group_id` = '%s' 
                                    AND `course_id` = '%s'
                            ORDER BY `lesson_name`",
        $studentId,
        $groupId,
        $courseId,
    );



    if (!$resultLessonStudentGrade = $connect->query($studentGrade)) {
        echo "Ошибка получения данных студента!";
    }

    $data = '';



    while ($rowLessonStudentGrade = $resultLessonStudentGrade->fetch_assoc() ?? []) {
        $checked = ($rowLessonStudentGrade["student_grade"] ?? null) == 1 ? 'checked' : '';
        if (isset($rowLessonStudentGrade["student_grade"])) {
            if ($rowLessonStudentGrade['student_grade'] = 1)
                $checkedData = 0;
            else
                $checkedData = 1;
            $data .= sprintf('
                  <a style="text-decoration:none; color:#0056b3" href="">
                     <div class="liLessons">
                     <div class="checkbox-container">
                         <form id="editForm_%s" class="formBtnDeleteLesson" method="get" action="../ajax/edit_lessons_group_student.php">
                             <input type="hidden" name="lessons_group_student_id" value="%s">
                             <input type="hidden" name="student_grade" value="%s">
                             <input name="student_grade" value="%s" class="checkboxLesson" type="checkbox" %s>
                         </form>
                         </div>
                         <div class="lesson-content">
                         <li>%s</li>
                     </div>
                     <div class="delete-button-container">
                         <form method="post" action="../controllers/delete_lessons_group_student.php">
                             <input type="hidden" name="lessons_group_id" value="%s">
                             <button type="submit" class="deleteStudent">Удалить</button>
                         </form>
                     </div>
                     </div>
                  </a>
             ', $rowLessonStudentGrade['lessons_group_student_id'], $rowLessonStudentGrade['lessons_group_student_id'], $checkedData, $rowLessonStudentGrade['student_grade'], $checked, $rowLessonStudentGrade['lesson_name'], $rowLessonStudentGrade['lessons_group_id']);
        } else {
            $data .= sprintf('
                  <a style="text-decoration:none; color:#0056b3" href="">
                     <div class="liLessons">
                     <div class="checkbox-container">
                         <form id="addForm_%s" class="formBtnDeleteLesson" method="get" action="../ajax/add_lessons_group_student.php">
                             <input type="hidden" name="lessons_group_id" value="%s">
                             <input name="student_grade" value="1" class="checkboxLesson" type="checkbox" %s>
                         </form>
                         </div>
                         <div class="lesson-content">
                         <li>%s</li>
                     </div>
                     <div class="delete-button-container">
                         <form method="post" action="../controllers/delete_lessons_group_student.php">
                             <input type="hidden" name="lessons_group_id" value="%s">
                             <button type="submit" class="deleteStudent">Удалить</button>
                         </form>
                     </div>
                     </div>
                  </a>
             ', $rowLessonStudentGrade['lessons_group_id'], $rowLessonStudentGrade['lessons_group_id'], $checked, $rowLessonStudentGrade['lesson_name'], $rowLessonStudentGrade['lessons_group_id']);
        }
    }

    return $data;
}




function fnAddGroupInCourse()
{

    global $connect;


    $sql = sprintf("SELECT `group_id`, `name_group` FROM `groups`");




    if (!$resultLesson = $connect->query($sql)) {
        echo "Ошибка плучения данных!";
    }


    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf('
                <a class="aList" href="/add_course_content/add_students/students.php?group_id=%s">
                    <li class="listItem">%s</li>
                    </form>
                </a>
                
                
            ', $rowLesson['group_id'], $rowLesson['name_group']);
    }

    return $data;
}


function fnStudent($id, $groupId, $groupName, $courseId, $courseName)
{


    global $connect;

    $sql = sprintf("SELECT `student_id`, `full_name` FROM `students` WHERE '%s' = `group_id`", $id);

    if (!$resultLesson = $connect->query($sql)) {
        die('Ошибка добавления студентов!');
    }



    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf(
            '<a style="text-decoration:none; color:#0056b3" href="../student/index.php?student_id=%s&name_student=%s&course_id=%s&name_course=%s&group_id=%s&name_group=%s">
                <div class="liStudents" style=" width: 70wh; height: 30px;">
                    <li>%s</li>
                </div>
            </a>',
            $rowLesson['student_id'],
            $rowLesson['full_name'],
            $courseId,
            $courseName,
            $groupId,
            $groupName,
            $rowLesson['full_name']
        );
    }

    return $data;
}


function fnGroupInStudents()
{

    global $connect;


    $sql = sprintf("SELECT `group_id`, `name_group` FROM `groups`");




    if (!$resultLesson = $connect->query($sql)) {
        echo "Ошибка плучения данных!";
    }


    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
       $data .= sprintf('
                <a class="aList" href="course.php?group_id=%s&name_group=%s">
                    <li class="listItem">%s</li>
                </a>
            ', $rowLesson['group_id'], $rowLesson['name_group'], $rowLesson['name_group']);
    }

    return $data;
}


function fnAssessmentStudent($groupId, $courseId, $name_course, $name_group)
{

    global $connect;

    $sql = sprintf("SELECT `full_name`, `student_id` FROM `students` WHERE `group_id` = '%s'", $groupId);

    function fnAsStudentLesson($studentId, $groupId, $courseId)
    {

        global $connect;

        $assessmentStudentCountLesson = sprintf("SELECT COUNT(*) AS `student_grade` FROM `lessons_group_student` INNER JOIN `lessons_group` ON `lessons_group`.`lessons_group_id` = `lessons_group_student`.`lessons_group_id` INNER JOIN `lessons` ON `lessons_group`.`lesson_id` = `lessons`.`lesson_id` WHERE `student_id` = '%s' AND `student_grade` = '%s' AND `course_id` = '%s'", $studentId, 1, $courseId);
        $resultLessonCount = $connect->query($assessmentStudentCountLesson);
        $rowLessonCount = $resultLessonCount->fetch_assoc();

        $assessmentStudentCountLessonAll = sprintf("SELECT COUNT(*) `lesson_name` FROM `lessons` INNER JOIN `lessons_group` ON `lessons`.`lesson_id` = `lessons_group`. `lesson_id` WHERE `group_id` = '%s' AND `course_id` = '%s'", $groupId, $courseId);
        $resultLessonAll = $connect->query($assessmentStudentCountLessonAll);
        $rowLessonAll = $resultLessonAll->fetch_assoc();

        if ($rowLessonAll['lesson_name'] == 0) {
            $resultLessonSN = 'Нет заданий';
        } else {
            $resultLessonSN = round(($rowLessonCount['student_grade'] / $rowLessonAll['lesson_name']) * 100);
        }


        return $resultLessonSN;
    };

    function fnAsStudentTest($studentId, $groupId, $courseId)
    {

        global $connect;

        $assessmentStudentCountTest = sprintf("SELECT COUNT(*) AS `student_grade` FROM `tests_group_student` INNER JOIN `tests_group` ON `tests_group`.`tests_group_id` = `tests_group_student`.`tests_group_id` INNER JOIN `tests` ON `tests_group`.`test_id` = `tests`.`test_id` WHERE `student_id` = '%s' AND `student_grade` = '%s' AND `course_id` = '%s'", $studentId, 1, $courseId);
        $resultTestCount = $connect->query($assessmentStudentCountTest);
        $rowTestCount = $resultTestCount->fetch_assoc();

        $assessmentStudentCountTestAll = sprintf("SELECT COUNT(*) `test_name` FROM `tests` INNER JOIN `tests_group` ON `tests`.`test_id` = `tests_group`. `test_id` WHERE `group_id` = '%s' AND `course_id` = '%s'", $groupId, $courseId);
        $resultTestAll = $connect->query($assessmentStudentCountTestAll);
        $rowTestAll = $resultTestAll->fetch_assoc();

        if ($rowTestAll['test_name'] == 0) {
            $resultTestSN = 'Нет тестов';
        } else {
            $resultTestSN = round(($rowTestCount['student_grade'] / $rowTestAll['test_name']) * 100);
        }



        return $resultTestSN;
    };
    
    function fnAsStudentVisit($studentId, $groupId, $courseId)
    {

        global $connect;

        $assessmentStudentCountVisit = sprintf("SELECT COUNT(*) AS `student_grade` FROM `visits_group_student` INNER JOIN `visits` ON `visits`.`visit_id` = `visits_group_student`.`visit_id` WHERE `student_id` = '%s' AND `student_grade` = '%s' AND `course_id` = '%s'", $studentId, 1, $courseId);
        $resultVisitCount = $connect->query($assessmentStudentCountVisit);
        $rowVisitCount = $resultVisitCount->fetch_assoc();

        $assessmentStudentCountVisitAll = sprintf("SELECT COUNT(*) `visit_name` FROM `visits` WHERE `group_id` = '%s' AND `course_id` = '%s'", $groupId, $courseId);
        $resultVisitAll = $connect->query($assessmentStudentCountVisitAll);
        $rowVisitAll = $resultVisitAll->fetch_assoc();

        if ($rowVisitAll['visit_name'] == 0) {
            $resultVisitSN = 'Нет посещаемости';
        } else {
            $resultVisitSN = round(($rowVisitCount['student_grade'] / $rowVisitAll['visit_name']) * 100);
        }



        return $resultVisitSN;
    };
    
    

    $assessmentSystem = "SELECT * FROM `assessment_system`";

    if (!$resultAssessmentSystem = $connect->query($assessmentSystem)) {
        echo "Ошибка получения данных";
    }

    $percentage = [];
    $evaluation = [];
    while ($rowAssessmentSystem = $resultAssessmentSystem->fetch_assoc()) {
        $percentage[] = $rowAssessmentSystem['percentage'];
        $evaluation[] = $rowAssessmentSystem['evaluation'];
    }


    if (!$result = $connect->query($sql)) {
        echo "Ошибка получения данных!";
    }

    $data = '';

    while ($row = $result->fetch_assoc()) {
        $resultLessonSN = fnAsStudentLesson($row['student_id'], $groupId, $courseId);
        $resultTestSN = fnAsStudentTest($row['student_id'], $groupId, $courseId);
        $resultVisitSN = fnAsStudentVisit($row['student_id'], $groupId, $courseId);

        $arrayResultSN = [];

        if ($resultLessonSN === 'Нет заданий') {
            $resultLessonAssessmentSN = '';
        } elseif ($resultLessonSN < $percentage[0]) {
            $resultLessonAssessmentSN = $evaluation[0];
            $arrayResultSN[] = $evaluation[0];
        } elseif ($resultLessonSN < $percentage[1]) {
            $resultLessonAssessmentSN = $evaluation[1];
            $arrayResultSN[] = $evaluation[1];
        } elseif ($resultLessonSN < $percentage[2]) {
            $resultLessonAssessmentSN = $evaluation[2];
            $arrayResultSN[] = $evaluation[2];
        } else {
            $resultLessonAssessmentSN = $evaluation[3];
            $arrayResultSN[] = $evaluation[3];
        }


        if ($resultTestSN === 'Нет тестов') {
            $resultTestAssessmentSN = '';
        } elseif ($resultTestSN < $percentage[0]) {
            $resultTestAssessmentSN = $evaluation[0];
            $arrayResultSN[] = $evaluation[0];
        } elseif ($resultTestSN < $percentage[1]) {
            $resultTestAssessmentSN = $evaluation[1];
            $arrayResultSN[] = $evaluation[1];
        } elseif ($resultTestSN < $percentage[2]) {
            $resultTestAssessmentSN = $evaluation[2];
            $arrayResultSN[] = $evaluation[2];
        } else {
            $resultTestAssessmentSN = $evaluation[3];
            $arrayResultSN[] = $evaluation[3];
        }
        
        
        if ($resultVisitSN === 'Нет посещаемости') {
            $resultVisitAssessmentSN = '';
        } elseif ($resultVisitSN < $percentage[0]) {
            $resultVisitAssessmentSN = $evaluation[0];
            $arrayResultSN[] = $evaluation[0];
        } elseif ($resultVisitSN < $percentage[1]) {
            $resultVisitAssessmentSN = $evaluation[1];
            $arrayResultSN[] = $evaluation[1];
        } elseif ($resultVisitSN < $percentage[2]) {
            $resultVisitAssessmentSN = $evaluation[2];
            $arrayResultSN[] = $evaluation[2];
        } else {
            $resultVisitAssessmentSN = $evaluation[3];
            $arrayResultSN[] = $evaluation[3];
        }

        if ($resultLessonAssessmentSN == 2) {
            $average = 2;
        } else {
            $average = (count($arrayResultSN) && array_sum($arrayResultSN)) ?
                round(array_sum($arrayResultSN) / count($arrayResultSN)) : 'Нет оценки';
        }


        $data .= sprintf('
       <tr>
        <td style="text-align: start;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: nowrap;">
                <p>%s</p>
                <a href="../arrears/index.php?studentId=%s&name_student=%s&course_id=%s&name_course=%s&group_id=%s&name_group=%s" style="">
                    <img src="../assets/img/IAT-ExternalLink-Icon.png" height="15px";>
                </a>
            </div>
        </td>
        <td>
            <p>%s (%s)</p>
        </td>
        <td>
            <p>%s (%s)</p>
        </td>
        <td>
            <p>%s (%s)</p>
        </td>
        <td>
            <p>%s</p>
        </td>
        </tr>', $row['full_name'], $row['student_id'], $row['full_name'], $courseId, $name_course, $groupId, $name_group, $resultLessonAssessmentSN, $resultLessonSN, $resultTestAssessmentSN, $resultTestSN, $resultVisitAssessmentSN, $resultVisitSN, $average);
    }

    return $data;
}


function fnAddCoursesAssessment($groupId, $groupName)
{

    global $connect;

    $sql = sprintf("SELECT `courses`.`course_id`, `name_course` FROM `courses` INNER JOIN `courses_group` ON `courses`.`course_id` = `courses_group`.`course_id` WHERE `group_id` = '%s'", $groupId);


    if (!$resultLesson = $connect->query($sql)) {
        echo "Ошибка плучения данных!";
    }

    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf('
                <a class="aList" href="assessment_students.php?course_id=%s&name_course=%s&group_id=%s&name_group=%s">
                    <li class="listItem">%s</li>
                </a>
            ', $rowLesson['course_id'], $rowLesson['name_course'], $groupId, $groupName, $rowLesson['name_course']);
    }

    return $data;
}

function fnAddTest()
{

    global $connect;

    $sql = "SELECT `course_id`, `name_course` FROM `courses`";




    if (!$resultLesson = $connect->query($sql)) {
        echo "Ошибка плучения данных!";
    }

    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf('
                <a class="aListLessonsTests" href="/../add_course_content/add_test/test.php?course_id=%s">
                    <li class="listItem">%s</li>
                </a>
            ', $rowLesson['course_id'], $rowLesson['name_course']);
    }

    return $data;
}



function fnAddTestGroup($id, $groupId)
{


    global $connect;

    $sql = sprintf("SELECT * FROM tests WHERE test_id NOT IN ( 
        SELECT test_id 
        FROM tests_group 
        WHERE group_id = '%s' ) 
    AND course_id = %s;", $groupId, $id);





    if (!$resultLesson = $connect->query($sql)) {
        echo "Ошибка плучения данных!";
    }

    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf('
                 <a style="text-decoration:none; color:#0056b3" href="../controllers/add_test_groups.php?id=%s">
                 <div class="liLessons">
                 <li>%s</li>
                 </div>
                 </a>
            ', $rowLesson['test_id'], $rowLesson['test_name']);
    }

    return $data;
}

function fnAddTestGroupItems($groupId, $courseId, $studentId)
{


    global $connect;

    $studentGrade = sprintf(
        "SELECT `tests_group`.`tests_group_id`, `tests_group`.`test_id`, `tests_group_student_id`, `student_grade`, `test_name`  
                                FROM `tests` 
                                INNER JOIN `tests_group` 
                                    ON `tests`.`test_id` = `tests_group`. `test_id` 
                                LEFT JOIN `tests_group_student` 
                                    ON `tests_group`.`tests_group_id` = `tests_group_student`.`tests_group_id` 
                                    AND `tests_group_student`.`student_id` = '%s'
                                WHERE 
                                    `group_id` = '%s' AND `course_id` = '%s'
                                ORDER BY `test_name`",
        $studentId,
        $groupId,
        $courseId
    );



    if (!$resultLessonStudentGrade = $connect->query($studentGrade)) {
        echo "Ошибка получения данных студента!";
    }

    $data = '';



    while ($rowLessonStudentGrade = $resultLessonStudentGrade->fetch_assoc() ?? []) {
        $checked = ($rowLessonStudentGrade["student_grade"] ?? null) == 1 ? 'checked' : '';
        if (isset($rowLessonStudentGrade["student_grade"])) {
            if ($rowLessonStudentGrade['student_grade'] = 1)
                $checkedData = 0;
            else
                $checkedData = 1;
            $data .= sprintf('
                 <a style="text-decoration:none; color:#0056b3" href="">
                    <div class="liLessons">
                    <div class="checkbox-container">
                        <form id="myForm" class="formBtnDeleteLesson" method="get" action="../ajax/edit_tests_group_student.php">
                            <input type="hidden" name="tests_group_student_id" value="%s">
                            <input type="hidden" name="student_grade" value="%s">
                            <input name="student_grade" value="%s" class="checkboxLesson" type="checkbox" %s>
                        </form>
                        </div>
                        <div class="lesson-content">
                        <li>%s</li>
                    </div>
                    <div class="delete-button-container">
                        <form method="post" action="../controllers/delete_tests_group_student.php">
                            <input type="hidden" name="tests_group_id" value="%s">
                            <button type="submit" class="deleteStudent">Удалить</button>
                        </form>
                    </div>
                    </div>
                 </a>
            ', $rowLessonStudentGrade['tests_group_student_id'], $checkedData, $rowLessonStudentGrade['student_grade'], $checked, $rowLessonStudentGrade['test_name'], $rowLessonStudentGrade['tests_group_id']);
        } else {
            $data .= sprintf('
                 <a style="text-decoration:none; color:#0056b3" href="">
                    <div class="liLessons">
                        <div class="checkbox-container">
                        <form id="myForm" class="formBtnDeleteLesson" method="get" action="../ajax/add_tests_group_student.php">
                            <input type="hidden" name="tests_group_id" value="%s">
                            <input name="student_grade" value="1" class="checkboxLesson" type="checkbox" %s>
                        </form>
                        </div>
                        <div class="lesson-content">
                        <li>%s</li>
                    </div>
                    <div class="delete-button-container">
                        <form method="post" action="../controllers/delete_test_group_student.php">
                            <input type="hidden" name="tests_group_id" value="%s">
                            <button type="submit" class="deleteStudent">Удалить</button>
                        </form>
                    </div>
                    </div>
                 </a>
            ', $rowLessonStudentGrade['tests_group_id'], $checked, $rowLessonStudentGrade['test_name'], $rowLessonStudentGrade['tests_group_id']);
        }
    }

    return $data;
}


function fnTestItems($id)
{


    global $connect;

    $sql = sprintf("SELECT `test_id`, `test_name` FROM `tests` WHERE '%s' = `course_id`", $id);

    if (!$resultLesson = $connect->query($sql)) {
        die('Ошибка добавления заданий!');
    }



    $data = '';

    while ($rowLesson = $resultLesson->fetch_assoc()) {
        $data .= sprintf(
            '<a style="text-decoration:none; color:#0056b3" href="../../add_course_content/add_test/test.php">
    <div class="liStudents">
    <li>%s</li>
    <div class="flexButtonsStudents">
        <form  method="post" action="../../controllers/edit_test.php">
            <input type="hidden" name="test_id" value="%s">
            <button onclick="showModalEdit(event)" type="button" class="editStudent" data-name="%s">Редактировать</button>
        </form>
        <form  method="get" action="../../controllers/delete_test.php">
            <input type="hidden" name="id" value="%s">
            <button onclick="showModal(event)" type="button" class="deleteStudent">Удалить</button>
        </form>
    </div>
  </div></a>',
            $rowLesson['test_name'],
            $rowLesson['test_id'],
            $rowLesson['test_name'],
            $rowLesson['test_id']
        );
    }

    return $data;
}

function fnVisitsItems($courseId, $groupId, $studentId)
{


    global $connect;

    $studentGrade = sprintf(
        "SELECT `group_id`, `visits`.`visit_id`, `visits_group_student_id`, `student_grade`, `visit_name`
                            FROM `visits`
                            LEFT JOIN `visits_group_student`
                                ON `visits`.`visit_id` = `visits_group_student`.`visit_id`
                                AND `visits_group_student`.`student_id` = '%s'
                            WHERE
                                `group_id` = '%s'
                                AND `course_id` = '%s'
                            ORDER BY `visit_name`",
        $studentId,
        $groupId,
        $courseId
    );

    if (!$resultVisitStudentGrade = $connect->query($studentGrade)) {
        echo "Ошибка получения данных!";
    }



    $data = '';

    while ($rowVisitStudentGrade = $resultVisitStudentGrade->fetch_assoc() ?? []) {
        $checked = ($rowVisitStudentGrade["student_grade"] ?? null) == 1 ? 'checked' : '';
        if (isset($rowVisitStudentGrade["student_grade"])) {
            if ($rowVisitStudentGrade['student_grade'] = 1)
                $checkedData = 0;
            else
                $checkedData = 1;
            $data .= sprintf('
                 <a style="text-decoration:none; color:#0056b3" href="">
                    <div class="liLessons">
                    <div class="checkbox-container">
                        <form id="myForm" class="formBtnDeleteLesson" method="get" action="../ajax/edit_visits_group_student.php">
                            <input type="hidden" name="visits_group_student_id" value="%s">
                            <input type="hidden" name="student_grade" value="%s">
                            <input name="student_grade" value="%s" class="checkboxLesson" type="checkbox" %s>
                        </form>
                        </div>
                        <div class="lesson-content">
                        <li>%s</li>
                    </div>
                    <div class="delete-button-container">
                        <form  method="post" action="../controllers/edit_visit.php">
                            <input type="hidden" name="visit_id" value="%s">
                            <button onclick="showModalEdit(event)" type="button" class="editStudent" data-name="%s">Редактировать</button>
                        </form>
                        <form  method="get" action="../controllers/delete_visit.php">
                            <input type="hidden" name="id" value="%s">
                            <button onclick="showModal(event)" type="button" class="deleteStudent">Удалить</button>
                        </form>
                    </div>
                    </div>
                 </a>
            ', $rowVisitStudentGrade['visits_group_student_id'], $checkedData, $rowVisitStudentGrade['student_grade'], $checked, $rowVisitStudentGrade['visit_name'], $rowVisitStudentGrade['visit_id'], $rowVisitStudentGrade['visit_name'], $rowVisitStudentGrade['visit_id']);
        } else {
            $data .= sprintf('
                 <a style="text-decoration:none; color:#0056b3" href="">
                    <div class="liLessons">
                    <div class="checkbox-container">
                        <form id="myForm" class="formBtnDeleteLesson" method="get" action="../ajax/add_visits_group_student.php">
                            <input type="hidden" name="visit_id" value="%s">
                            <input name="student_grade" value="1" class="checkboxLesson" type="checkbox" %s>
                        </form>
                        </div>
                        <div class="lesson-content">
                        <li>%s</li>
                    </div>
                    <div class="delete-button-container">
                        <form  method="post" action="../controllers/edit_visit.php">
                            <input type="hidden" name="visit_id" value="%s">
                                <button onclick="showModalEdit(event)" type="button" class="editStudent" data-name="%s">Редактировать</button>
                        </form>
                        <form  method="get" action="../controllers/delete_visit.php">
                            <input type="hidden" name="id" value="%s">
                            <button onclick="showModal(event)" type="button" class="deleteStudent">Удалить</button>
                        </form>
                    </div>
                    </div>
                 </a>
            ', $rowVisitStudentGrade['visit_id'], $checked, $rowVisitStudentGrade['visit_name'], $rowVisitStudentGrade['visit_id'], $rowVisitStudentGrade['visit_name'], $rowVisitStudentGrade['visit_id']);
        }
    }

    return $data;
}

function fnLessonStudentArrears($studentId, $courseId, $groupId)
{


    global $connect;

    $studentGradeLessons = sprintf(
        "SELECT `lessons_group`.`lessons_group_id`, `lessons_group`.`lesson_id`, `lessons_group_student_id`, `student_grade`, `lesson_name` 
                            FROM `lessons` 
                            INNER JOIN `lessons_group` 
                                    ON `lessons`.`lesson_id` = `lessons_group`. `lesson_id` 
                            LEFT JOIN `lessons_group_student` 
                                    ON `lessons_group`.`lessons_group_id` = `lessons_group_student`.`lessons_group_id`
                                    AND `lessons_group_student`.`student_id` = '%s' 
                            WHERE 
                                    `group_id` = '%s' 
                                    AND `course_id` = '%s'
                            ORDER BY `lesson_name`",
        $studentId,
        $groupId,
        $courseId,
    );



    if (!$resultLessonStudentGrade = $connect->query($studentGradeLessons)) {
        echo "Ошибка получения данных студента!";
    }

    $data = '';



    while ($rowLessonStudentGrade = $resultLessonStudentGrade->fetch_assoc()) {
        $checked = $rowLessonStudentGrade["student_grade"] == 1 ? 'checked' : '';
            $data .= sprintf('
                    <div class="liLessons">
                        <div class="lesson-content">
                            <li>%s</li>
                        </div>
                        <div class="checkbox-container">
                            <input name="student_grade" class="checkboxLesson" type="checkbox" %s disabled>
                        </div>
                    </div>
                 </a>
            ', $rowLessonStudentGrade['lesson_name'], $checked);
        
    }

    return $data;
}


function fnTestsStudentArrears($studentId, $courseId, $groupId)
{


    global $connect;

    $studentGradeTests = sprintf(
        "SELECT `tests_group`.`tests_group_id`, `tests_group`.`test_id`, `tests_group_student_id`, `student_grade`, `test_name` 
                            FROM `tests` 
                            INNER JOIN `tests_group` 
                                    ON `tests`.`test_id` = `tests_group`. `test_id` 
                            LEFT JOIN `tests_group_student` 
                                    ON `tests_group`.`tests_group_id` = `tests_group_student`.`tests_group_id`
                                    AND `tests_group_student`.`student_id` = '%s' 
                            WHERE 
                                    `group_id` = '%s' 
                                    AND `course_id` = '%s'
                            ORDER BY `test_name`",
        $studentId,
        $groupId,
        $courseId,
    );



    if (!$resultTestsStudentGrade = $connect->query($studentGradeTests)) {
        echo "Ошибка получения данных студента!";
    }

    $data = '';



    while ($rowTestsStudentGrade = $resultTestsStudentGrade->fetch_assoc()) {
        $checked = $rowTestsStudentGrade["student_grade"] == 1 ? 'checked' : '';
            $data .= sprintf('
                    <div class="liLessons">
                        <div class="lesson-content">
                            <li>%s</li>
                        </div>
                        <div class="checkbox-container">
                            <input name="student_grade" class="checkboxLesson" type="checkbox" %s disabled>
                        </div>
                    </div>
                 </a>
            ', $rowTestsStudentGrade['test_name'], $checked);
        
    }

    return $data;
}

function fnVisitsStudentArrears($studentId, $courseId, $groupId)
{


    global $connect;

    $studentGrade = sprintf(
        "SELECT `group_id`, `visits`.`visit_id`, `visits_group_student_id`, `student_grade`, `visit_name`
                            FROM `visits`
                            LEFT JOIN `visits_group_student`
                                ON `visits`.`visit_id` = `visits_group_student`.`visit_id`
                                AND `visits_group_student`.`student_id` = '%s'
                            WHERE
                                `group_id` = '%s'
                                AND `course_id` = '%s'
                            ORDER BY `visit_name`",
        $studentId,
        $groupId,
        $courseId
    );



    if (!$resultVisitsStudentGrade = $connect->query($studentGrade)) {
        echo "Ошибка получения данных студента!";
    }

    $data = '';



    while ($rowVisitsStudentGrade = $resultVisitsStudentGrade->fetch_assoc()) {
        $checked = $rowVisitsStudentGrade["student_grade"] == 1 ? 'checked' : '';
            $data .= sprintf('
                    <div class="liLessons">
                        <div class="lesson-content">
                            <li>%s</li>
                        </div>
                        <div class="checkbox-container">
                            <input name="student_grade" class="checkboxLesson" type="checkbox" %s disabled>
                        </div>
                    </div>
                 </a>
            ', $rowVisitsStudentGrade['visit_name'], $checked);
        
    }

    return $data;
}

