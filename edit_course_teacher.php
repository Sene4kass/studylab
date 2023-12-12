<?php
if(!PagesNavigation::isAdmin()){
    PagesNavigation::redirectUser("template.php?action=profile.php");
}

if(!empty($_POST) and $_POST["action"] == "create_course") {
    global $user;
    isset($_POST["futureCourse"]) ? $future = 0 : $future = 1;
    if(!$user->createCourse($_POST["courseName"], $_POST["shortDesk"], $_POST["fullDesk"], $future)){
        echo "Ошибка в создании курса";
    }
}

if(!empty($_POST) and $_POST["action"] == "edit_course") {
    global $user;
    $user->updateCourse($_POST["course_name"], $_POST["course_desc"], $_POST["course_fulldesc"], $_POST["course_id"]);
}

if(!empty($_POST) and $_POST["action"] == "delete") {
    global $db;
    $course_list = User::GetCourseList();
    $delete_courses_list = array();
//    for($courseNumber = 0;$courseNumber <= count($course_list); $courseNumber++){
//        for($checkboxValues = 0; $checkboxValues <= count($_POST)-1; $checkboxValues++){
//            if($course_list[$courseNumber][0] == $_POST[strval($checkboxValues)]){
//                array_push($delete_courses_list, $checkboxValues);
//            }
//        }
//    }
    for($value = 0; $value <= max(array_column($course_list, 0)); $value++){
        //print(max(array_column($course_list, 0)));
        if($_POST[strval($value)] == "on"){
            array_push($delete_courses_list,$value);
        }
    }
    //print_r($_POST);
    //print_r($delete_courses_list);
    for($items = 0; $items <= count($delete_courses_list)-1; $items++){
        //$db->query("alter table `subject` nocheck constraint all");
        $query = $db->prepare("DELETE FROM `subject` WHERE `id_Subject` = ?");
        $query2 = $db->prepare("DELETE FROM `subject_user` WHERE `id_Subject` = ?");
        if($query) {
            $intval = intval($delete_courses_list[$items]);
            $query->bind_param("i", $intval);
            $query2->bind_param("i", $intval);
            $query2->execute();
            $query->execute();
        }
        //$db->query("alter table `subject` check constraint all");
        if($db->error){
            echo $db->error;
        }
    }
}
?>

            <div class="block_content content_flx_edit_page">
                <div class="mini_nav_teacher">
                    <a href=""><img class="link_teacher" src="inc/img/clipboard_default.png" alt=""></a>
                    <a href=""><img class="link_teacher l_t_2" src="inc/img/book_default.png" alt=""></a>
                    <a href=""><img class="link_teacher l_t_3" src="inc/img/group_default.png" alt=""></a>
                    <a href=""><img class="link_teacher l_t_4" src="inc/img/add_users_active.png" alt=""></a>
                </div>
                <div class="wrapper_edit_users">
                    <table>
                        <tr class="first_line_table">
                            <th class="checkbox_t">
                                <label class="custom-checkbox_dark">
                                    <input type="checkbox" id="masterCheckbox" onclick="toggleCheckboxes()">
                                    <span class="checkmark_dark"></span>
                                </label>
                            </th>
                            <th class="t_module">Курсы</th>
                            <th class="t_numb_lessons">Описание</th>
                            <th class="t_position">Изображение</th>
                        </tr>
                        <!--<form action="template.php?action=edit_module_teacher" method="post">-->
                        <form action="template.php?action=edit_course_teacher.php" method="post">
                            <input type="hidden" name="action" value="delete">
                        <?php
                        $courseList = User::GetCourseList();
                        for($courseNumber = 0;$courseNumber < count($courseList);$courseNumber++){
                            echo '
                            <tr class="tr_modules">
                            <td class="checkbox_t">
                                <label class="custom-checkbox_dark">
                                    <input type="checkbox" id="checkbox1" name="'.$courseList[$courseNumber][0].'">
                                    <span class="checkmark_dark"></span>
                                </label>
                            </td>
                            <td class="t_module">'.$courseList[$courseNumber][1].'</td>
                            <td class="t_numb_lessons">'.$courseList[$courseNumber][2].'</td>
                            <td class="t_position"><div class="position_list_wrapper"><p>'.$courseList[$courseNumber][5].'</p><div class="wrapper_action"><button class="edit" onclick="toggleBlockEditCourse(\''.$courseList[$courseNumber][1].'\',\''.$courseList[$courseNumber][2].'\',\''.$courseList[$courseNumber][3].'\',\''.$courseList[$courseNumber][0].'\')">Изменить</button></div></div></td>
                        </tr>
                            ';
                        }

                        ?>


                    </table>
                    <div class="wrapper_add_del">
                        <button class="wrapper_add" onclick="toggleBlockAdd()" type="button">
                            <img src="inc/img/add_icon.png" alt="" class="add_icon">
                            Создать новый курс
                        </button>

                        <a class="wrapper_del">
                            <button type="submit" style="background: none; border: none;">
                                <img src="inc/img/trash.png" alt="" class="trash_icon">
                                Удалить выбранных
                            </button>
                        </a>
                    </div>
                </form>

                    <div id="myBlock" class="hidden_block">
                        <form action="" method="POST">
                            <input type="hidden" name="action" value="edit_course">
                            <input type="hidden" name="course_id" value="none" id="id_course_input">
                            <h2 class="name_red">Редактирование</h2>
                            <div class="wrapper_flex_inp_">
                                <h3 class="small_name_module_inp">Название курса</h3>
                                <input class="inp_add_module" type="text" name="course_name" id="input_name">
                            </div>
                            <div class="wrapper_flex_inp_">
                                <h3 class="small_name_module_inp">Описание</h3>
                                <input class="inp_add_module _sm" type="text" name="course_desc" id="input_desc">
                            </div>
                            <div class="wrapper_flex_inp_">
                                <h3 class="small_name_module_inp">Полное писание</h3>
                                <input class="inp_add_module _sm" type="text" name="course_fulldesc" id="input_fulldesc">
                            </div>
                            <div class="wrapper_buttons_select _edit_inp">
                                <button class="filled_btn big" style="color: #ffffff;" type="submit">Изменить</button>
                                <button class="unfilled_bgtn big _ed_btn" style="margin-left: 20px; width: 140px;" type="button">Отмена</button>
                            </div>
                        </form>
                    </div>
                    <form action="template.php?action=edit_course_teacher.php" method="POST" enctype="multipart/form-data">
                        <div id="myBlockAdd" class="hidden_block">
                            <input type="hidden" name="action" value="create_course">
                            <h2 class="name_red">Создание учебного курса</h2>
                            <div class="wrapper_flex_inp_">
                                <h3 class="small_name_module_inp">Название курса</h3>
                                <input class="inp_add_module" type="text" name="courseName" id="">
                            </div>
                            <div class="wrapper_flex_inp_">
                                <h3 class="small_name_module_inp">Краткое описание курса</h3>
                                <input class="inp_add_module" type="text" name="shortDesk" id="">
                            </div>
                            <div class="wrapper_flex_inp_">
                                <h3 class="small_name_module_inp">Полное описание курса</h3>
                                <textarea class="inp_add_module" type="text" rows="5" name="fullDesk" id=""></textarea>
                            </div>
                            <div class="wrapper_flex_inp_ _ext">
                                <!--<h3 class="small_name_module_inp">Изображение</h3>
                                <input type="file" id="file-input" style="display: none;">
                                <input type="text" id="selected-file" class="inp_add_module" readonly>
                                <button id="select-file-btn" class="unfilled_bgtn big _ch_file_btn">Выбрать файл</button>-->

                        <script>
                            document.getElementById('select-file-btn').addEventListener('click', function() {
                                document.getElementById('file-input').click();
                            });

                            document.getElementById('file-input').addEventListener('change', function() {
                                var selectedFile = this.files[0];
                                document.getElementById('selected-file').value = selectedFile.name;
                            });
                        </script>
                            </div>
                            <div class="wrapper_radio_future_course">
                                <p>Предстоящий курс</p>
                                <label class="custom-checkbox course_checkbox">

                                    <input type="checkbox" id="checkbox1" name="futureCourse">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="wrapper_buttons_select _edit_inp">
                                <button type="submit" class="filled_btn big _ed_btn" style="color: #ffffff;">Создать курс</button>
                                <button class="unfilled_bgtn big _ed_btn" style="margin-left: 20px; width: 140px;">Отмена</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</body>
</html>