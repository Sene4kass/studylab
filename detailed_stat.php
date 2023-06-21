<?php
if(!PagesNavigation::isAdmin()){
    PagesNavigation::redirectUser("template.php?action=profile.php");
}
?>


            <div class="block_content">

                <div class="wrapper_detailed_progress">
                    <h1 class="name_progress_bar">Выполнение программы</h1>
                    <div class="area_details">

                        <div class="part_diagramm">
                            <div class="part_progress">
                                <div class="test_wrapper_progress bigger" style="margin-top: 30px;">
                                    <div class="progress_status bigger_">
                                      <h2>67%</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="line_explanations">
                                <div class="solved"><div class="mark_color_solved"></div><p>Завершено</p></div>
                                <div class="unsolved"><div class="mark_color_unsolved"></div><p>Не выполнено</p></div>
                            </div>
                        </div>
                        
                        <div class="detalisation_part_course_progres">
                            <div class="line_det">
                                <h3>Модуль</h3>
                                <h3>Просмотров</h3>
                            </div>
                            <div class="line_det">
                                <p>Технология Ethernet</p>
                                <p class="highlight">54</p>
                            </div>
                            <div class="line_det">
                                <p>Сети TCP/IP</p>
                                <p class="highlight">36</p>
                            </div>
                            <div class="line_det">
                                <p>Основы сетей передачи данных</p>
                                <p class="highlight">24</p>
                            </div>
                            <div class="line_det">
                                <p>Беспроводная передача данных</p>
                                <p class="highlight">22</p>
                            </div>
                            <div class="line_det">
                                <p>Сетевые информационные службы</p>
                                <p class="highlight">18</p>
                            </div>
                            <div class="line_det">
                                <p>Безопасность компьютерных сетей</p>
                                <p class="highlight">0</p>
                            </div>
                            <div class="line_det">
                                <p>Администрирование вычислительной сети</p>
                                <p class="highlight">0</p>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="wrapper_detailed_progress">
                    <h1 class="name_progress_bar">Результативность</h1>
                    <div class="area_details">

                        <div class="part_diagramm">
                            <div class="part_progress">
                                <div class="test_wrapper_progress test_spec bigger" style="margin-top: 30px;">
                                    <div class="progress_status testing_stat bigger_">
                                      <h2>67%</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="line_explanations">
                                <div class="solved"><div class="mark_color_solved _2"></div><p>Завершено</p></div>
                                <div class="unsolved"><div class="mark_color_unsolved"></div><p>Не выполнено</p></div>
                            </div>
                        </div>
                        
                        <div class="detalisation_part_course_progres">
                            <div class="line_det">
                                <h3>Модуль</h3>
                                <h3>Отметка</h3>
                            </div>
                            <div class="line_det">
                                <p>Технология Ethernet</p>
                                <p class="highlight">9,6</p>
                            </div>
                            <div class="line_det">
                                <p>Сети TCP/IP</p>
                                <p class="highlight">9,4</p>
                            </div>
                            <div class="line_det">
                                <p>Основы сетей передачи данных</p>
                                <p class="highlight">8,8</p>
                            </div>
                            <div class="line_det">
                                <p>Беспроводная передача данных</p>
                                <p class="highlight">9,0</p>
                            </div>
                            <div class="line_det">
                                <p>Сетевые информационные службы</p>
                                <p class="highlight">9,1</p>
                            </div>
                            <div class="line_det">
                                <p>Безопасность компьютерных сетей</p>
                                <p class="highlight">8,9</p>
                            </div>
                            <div class="line_det">
                                <p>Администрирование вычислительной сети</p>
                                <p class="highlight">8,8</p>
                            </div>
                        </div>

                    </div>
                </div>


                <table>
                    <tr class="first_line_table">
                        <th class="t_1">Тема занятия</th>
                        <th class="t_2">Просмотров</th>
                        <th class="t_3">Порог усвоения</th>
                        <th class="t_4">#5</th>
                        <th class="t_5">#4</th>
                        <th class="t_6">#3</th>
                        <th class="t_7">#2</th>
                        <th class="t_8">#1</th>
                        <th class="t_9">Результат</th>
                    </tr>

                    <tr>
                        <td class="t_1">Названиме темы</td>
                        <td class="t_2">2</td>
                        <td class="t_3">8,6</td>
                        <td class="t_hash">7,9</td>
                        <td class="t_hash">9,3</td>
                        <td class="t_hash">7,8</td>
                        <td class="t_hash">7.8</td>
                        <td class="t_hash">7,8</td>
                        <td class="t_9 highlighted_tabe">Сдано</td>
                    </tr>
                    <tr>
                        <td class="t_1">Названиме темы</td>
                        <td class="t_2">2</td>
                        <td class="t_3">8,5</td>
                        <td class="t_hash">3,0</td>
                        <td class="t_hash">4,3</td>
                        <td class="t_hash">4,0</td>
                        <td class="t_hash">4,5</td>
                        <td class="t_hash">6,5</td>
                        <td class="t_9">Не сдано</td>
                    </tr>
                    <tr>
                        <td class="t_1">Названиме темы</td>
                        <td class="t_2">2</td>
                        <td class="t_3">7,5</td>
                        <td class="t_hash">8,4</td>
                        <td class="t_hash">8,1</td>
                        <td class="t_hash">7,8</td>
                        <td class="t_hash">9,2</td>
                        <td class="t_hash">7,8</td>
                        <td class="t_9 highlighted_tabe">Сдано</td>
                    </tr>
                    <tr>
                        <td class="t_1">Названиме темы</td>
                        <td class="t_2">2</td>
                        <td class="t_3">9,3</td>
                        <td class="t_hash">5,2</td>
                        <td class="t_hash">7,8</td>
                        <td class="t_hash">9,3</td>
                        <td class="t_hash">5,3</td>
                        <td class="t_hash">6,1</td>
                        <td class="t_9">Не сдано</td>
                    </tr>
                </table>
                
                                            
            </div>
        </div>

        <script>

            function onEntry(entry) {
                    entry.forEach(change => {
                    if (change.isIntersecting) {
                     change.target.classList.add('main_content_part_show');
                    }
                  });
                }
                
                options_ = {
                  threshold: [0.3]
                };
                observer = new IntersectionObserver(onEntry, options);
                elements = document.querySelectorAll('.main_content_part');
                
                for (let elm of elements) {
                  observer.observe(elm);
                }





                var toggleButton = document.getElementById('toggle-button');
                var menuWindow = document.getElementById('window');

                toggleButton.addEventListener('click', function() {
                    if (menuWindow.style.display === 'none') {
                      menuWindow.style.display = 'flex';
                      positionWindow();
                      setTimeout(function() {
                        menuWindow.style.opacity = '1';
                      }, 10);
                    } else {
                      menuWindow.style.opacity = '0';
                      setTimeout(function() {
                        menuWindow.style.display = 'none';
                      }, 300);
                    }
                });

                function positionWindow() {
                  var buttonRect = toggleButton.getBoundingClientRect();
                //   menuWindow.style.left = buttonRect.left + 'px';
                }




                function toggleDropdown() {
                    var dropdownList = document.getElementById("dropdownList");
                    dropdownList.classList.toggle("show");
                }

        </script>
    </div>