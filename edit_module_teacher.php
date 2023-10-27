<?php
if(!PagesNavigation::isAdmin()){
    PagesNavigation::redirectUser("template.php?action=profile.php");
}

if(isset($_POST) and $_POST["action"] == "create_module") {
    global $user;
    $user->createModule($_POST["course_name"], $_POST["course_description"], $_POST["course_image"]);
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
    
                        <tr class="tr_modules">
                            <td class="checkbox_t">
                                <label class="custom-checkbox_dark">
                                    <input type="checkbox" id="checkbox1">
                                    <span class="checkmark_dark"></span>
                                </label>
                            </td>
                            <td class="t_module">Сети TCP/IP</td>
                            <td class="t_numb_lessons">10</td>
                            <td class="t_position">3 <div class="wrapper_action"><button class="edit" onclick="toggleBlockEdit()">Изменить</button></div></td>
                        </tr>

                        <tr class="tr_modules">
                            <td class="checkbox_t">
                                <label class="custom-checkbox_dark">
                                    <input type="checkbox" id="checkbox1">
                                    <span class="checkmark_dark"></span>
                                </label>
                            </td>
                            <td class="t_module">Технология Ethernet</td>
                            <td class="t_numb_lessons">8</td>
                            <td class="t_position">2 <div class="wrapper_action"><button class="edit" onclick="toggleBlockEdit()">Изменить</button></div></td>
                        </tr>
                        
                        <tr class="tr_modules">
                            <td class="checkbox_t">
                                <label class="custom-checkbox_dark">
                                    <input type="checkbox" id="checkbox1">
                                    <span class="checkmark_dark"></span>
                                </label>
                            </td>
                            <td class="t_module">Основы сетей передачи данных</td>
                            <td class="t_numb_lessons">12</td>
                            <td class="t_position">1 <div class="wrapper_action"><button class="edit" onclick="toggleBlockEdit()">Изменить</button></div></td>
                        </tr>

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
                        <div class="wrapper_flex_inp_">
                            <h3 class="small_name_module_inp">Название модуля</h3>
                            <input class="inp_add_module" type="text" name="" id="">
                        </div>
                        <div class="wrapper_flex_inp_">
                            <h3 class="small_name_module_inp">Позиция в списке</h3>
                            <input class="inp_add_module _sm" type="number" name="" id="">
                        </div>
                        <div class="wrapper_buttons_select _edit_inp">
                            <button class="filled_btn big" style="color: #ffffff;">Узнать больше</button>
                            <button class="unfilled_bgtn big _ed_btn" style="margin-left: 20px; width: 140px;">Отмена</button>
                        </div>
                    </div>

                    <div id="myBlockAdd" class="hidden_block">
                        <h2 class="name_red">Редактирование</h2>
                        <div class="wrapper_flex_inp_">
                            <h3 class="small_name_module_inp">Название модуля</h3>
                            <input class="inp_add_module" type="text" name="" id="">
                        </div>
                        <div class="wrapper_flex_inp_">
                            <h3 class="small_name_module_inp">Позиция в списке</h3>
                            <input class="inp_add_module" type="text" name="" id="">
                        </div>
                        <div class="wrapper_buttons_select _edit_inp">
                            <button class="filled_btn big _ed_btn" style="color: #ffffff;">Сохранить</button>
                            <button class="unfilled_bgtn big _ed_btn" style="margin-left: 20px; width: 140px;">Отмена</button>
                        </div>
                        <br>
                    </div>

                </div>
            </div>
        </div>


    </div>
</body>
</html>