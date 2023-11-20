<?php
if(!PagesNavigation::isAdmin()){
    PagesNavigation::redirectUser("template.php?action=profile.php");
}

if(isset($_POST) and $_POST["action"] == "create_module") {
    global $user;
    isset($_POST["module_view"]) ? $module_view = 1 : $module_view = 0;
    isset($_POST["module_access"]) ? $module_access = 1 : $module_access = 0;
    $user->createModule($_POST["module_name"], $_POST["module_position"], $module_view, $module_access);
}
if(isset($_POST) and $_POST["action"] == "update_module") {
    global $user;
    isset($_POST["module_view"]) ? $module_view = 1 : $module_view = 0;
    isset($_POST["module_access"]) ? $module_access = 1 : $module_access = 0;
    $user->updateModule($_POST["module_name"], $_POST["module_position"], $module_view, $module_access, $_POST["module_id"]);
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
                            <th class="t_module">Модуль</th>
                            <th class="t_numb_lessons">Количество занятий</th>
                            <th class="t_position">Позиция в списке</th>
                        </tr>
                        <?
                        if(isset($_GET)) {
                            isset($_GET["course"]) ? $modulesList = $user->getModulesByCourse($_GET["course"]) : $modulesList = null;
                        }
                        if($modulesList != null) {
                            for($i=0;$i<count($modulesList);$i++){
                                echo '
                            <tr class="tr_modules">
                                <td class="checkbox_t">
                                    <label class="custom-checkbox_dark">
                                        <input type="checkbox" id="checkbox1">
                                        <span class="checkmark_dark"></span>
                                    </label>
                                </td>
                                <td class="t_module">'.$modulesList[$i][1].'</td>
                                <td class="t_numb_lessons">'.$user->getLessonsByModule($modulesList[$i][0])[0].'</td>
                                <td class="rd_position"><div class="position_list_wrapper"><p>'.$modulesList[$i][2].'</p><div class="wrapper_action"><button class="edit" onclick="toggleBlockEdit(\''.$modulesList[$i][1].'\','.$modulesList[$i][2].','.$modulesList[$i][0].')">Изменить</button></div></div></td>
                            </tr>
                           '; } }?>

                    </table>
                    <div class="wrapper_add_del">
                        <button class="wrapper_add" onclick="toggleBlockAdd()">
                            <img src="inc/img/add_icon.png" alt="" class="add_icon">
                            Создать новый модуль
                        </button>

                        <a class="wrapper_del">
                            <img src="inc/img/trash.png" alt="" class="trash_icon">
                            Удалить выбранных
                        </a>
                    </div>

                    <div id="myBlock" class="hidden_block">
                        <h2 class="name_red">Редактирование</h2>
                        <form action="" method="POST">
                            <input type="hidden" name="action" value="update_module">
                            <input type="hidden" name="module_id" value="none" id="id_module_input">
                            <div class="wrapper_flex_inp_">
                                <h3 class="small_name_module_inp">Название модуля</h3>
                                <input class="inp_add_module" type="text" name="module_name" id="input_name">
                            </div>
                            <div class="wrapper_flex_inp_">
                                <h3 class="small_name_module_inp">Позиция в списке</h3>
                                <input class="inp_add_module" type="text" name="module_position" id="input_position">
                            </div>
                            <div class="wrapper_radio_future_course">
                                <p>Показать модуль</p>
                                <label class="custom-checkbox course_checkbox">

                                    <input type="checkbox" id="checkbox1" name="module_view" id="view_module">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="wrapper_radio_future_course">
                                <p>Модуль доступен</p>
                                <label class="custom-checkbox course_checkbox">

                                    <input type="checkbox" id="checkbox1" name="module_access" id="access_module">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <input type="hidden" name="id_Subject" value="">
                            <div class="wrapper_buttons_select _edit_inp">
                                <button class="filled_btn big _ed_btn" style="color: #ffffff;" type="submit">Сохранить</button>
                                <button class="unfilled_bgtn big _ed_btn" style="margin-left: 20px; width: 140px;">Отмена</button>
                            </div>
                        </form>

                    </div>

                    <div id="myBlockAdd" class="hidden_block">
                        <h2 class="name_red">Создание модуля</h2>
                        <form action="" method="POST">
                            <input type="hidden" name="action" value="create_module">
                        <div class="wrapper_flex_inp_">
                            <h3 class="small_name_module_inp">Название модуля</h3>
                            <input class="inp_add_module" type="text" name="module_name" id="">
                        </div>
                        <div class="wrapper_flex_inp_">
                            <h3 class="small_name_module_inp">Позиция в списке</h3>
                            <input class="inp_add_module" type="text" name="module_position" id="">
                        </div>
                        <div class="wrapper_radio_future_course">
                            <p>Показать модуль</p>
                            <label class="custom-checkbox course_checkbox">

                                <input type="checkbox" id="checkbox1" name="module_view">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="wrapper_radio_future_course">
                            <p>Модуль доступен</p>
                            <label class="custom-checkbox course_checkbox">

                                <input type="checkbox" id="checkbox1" name="module_access">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                            <input type="hidden" name="id_Subject" value="">
                        <div class="wrapper_buttons_select _edit_inp">
                            <button class="filled_btn big _ed_btn" style="color: #ffffff;" type="submit">Создать</button>
                            <button class="unfilled_bgtn big _ed_btn" style="margin-left: 20px; width: 140px;">Отмена</button>
                        </div>
                        </form>
                        <br>

                    </div>

                </div>
            </div>
        </div>


    </div>
</body>
</html>