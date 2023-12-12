<?php
    session_start();

    include_once "User.php";
    include_once "PagesNavigation.php";

    function showNotification($text) {
        echo "<script>alert('".$text."')</script>";
    }
    // ----------  REGISTRATION
    if(isset($_POST['action']) and $_POST['action'] == "register") {
        if($_POST['password'] == $_POST['passwordRepeat'] and
            $_POST['password'] == $_POST['passwordConfirm'] and
            $_POST['login'] == $_POST['loginConfirm'] and
            $_POST['email'] == $_POST['emailConfirm'])
        {
            $User = new User();
            $register = $User->registerUser($_POST['login'], $_POST['password'],$_POST['email'], $_POST['name'], $_POST['surname'], $_POST['father_name']);
            showNotification($register);
        }
        else showNotification('Неправильный ввод данных');
    }
    // ------------- login -----------------
    if(isset($_POST["action"]) and $_POST["action"] == "login") {
        $user = new User();
        $login = $user->loginUser($_POST["login"],$_POST["password"]);
        if($login) {
            showNotification("Авторизация прошла успешно!");
            if($_SESSION["role"] == 2) {
                header("Location: template.php?action=profile_teacher.php");
            }
            else{
                header("Location: template.php?action=profile.php");
            }
        }
        else {
            showNotification("Упс! Авторизация не удалась: перепроверьте введенные данные");
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная - StudyLab</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body id="body">  
    <header>
        <div id="window_log_in_wrapper">
            <div class="dialog_window_log_in">
                <div class="window_line_1">
                    <img src="inc/img/logo_small.png" class="small_logo" alt="">
                    <h3 class="modal_logo">StudyLab</h3>
                </div>
                <div class="window_line_2">
                    <button class="close_window_btn"onclick="document.getElementById('window_log_in_wrapper').style.display = 'none'; document.getElementById('body').style.overflowY = 'auto';">&#10006;</button>
                    <h1 class="log__in">Вход</h1>
                </div>
                <form action="index.php" method="POST">
                    <input type="hidden" name="action" value="login">
                    <div class="window_line_3">
                        <div class="input-container">
                            <span class="icon">
                              <img src="inc/img/placeholder_human.png" alt="">
                            </span>
                            <input type="text" placeholder="Логин" name="login">
                        </div>
                        <div class="input-container">
                            <span class="icon">
                              <img src="inc/img/palceholder_password.png" alt="">
                            </span>
                            <input type="password" placeholder="Пароль" name="password">
                        </div>
                    </div>
                    <div class="window_line_4">
                        <button type="submit" class="enter">Войти</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="top_header_nav">
                <div class="wrapper_small_logo_header">
                    <a href="">
                        <img class="small_logo" src="inc/img/logo_small.png">
                        <h2 class="name_logo">StudyLab</h2>
                    </a>
                </div>
                <div class="wrapper_button_header_def">
                    <?
                    if(!empty($_SESSION) and $_SESSION["isAuth"] != 0) {
                        echo '<a href="template.php?action=profile.php"><button class="log_in">В личный кабинет</button></a>';
                    }
                    else echo '
                    <button class="reg_small" onclick="myworks(\'#reg\')">Зарегистрироваться</button>
                    <button class="log_in_small" onclick="document.getElementById(\'window_log_in_wrapper\').style.display = \'flex\';document.getElementById(\'body\').style.overflow = \'hidden\';"><img class="enter_img" src="inc/img/enter_img.png">Войти</button>
                    ';
                    ?>
                </div>
            </div>
            <div class="header_main_part">
                <div class="line_1">
                    <img src="inc/img/logo.png" alt="" class="main_logo">
                    <h1 class="logo_text">StudyLab</h1>
                </div>
                <div class="line_2">
                    <p>Образование через интернет</p>
                </div>
                <div class="line_3">
                    <?
                    if(!empty($_SESSION) and $_SESSION["isAuth"] != 0) {
                        echo '<a href="template.php?action=profile.php"><button class="log_in">В личный кабинет</button></a>';
                    }
                    else echo '
                    <button class="reg" onclick="myworks(\'#reg\')">Зарегистрироваться</button>
                    <button class="log_in" onclick="document.getElementById(\'window_log_in_wrapper\').style.display = \'flex\';document.getElementById(\'body\').style.overflow = \'hidden\';">Войти</button>
                    ';
                    ?>
                </div>
            </div>
        </div>
    </header>
    <script>
        // do for every recorded object
        function onEntry(entry) {
                entry.forEach(change => {
                    if (change.isIntersecting) {
                        change.target.classList.add('header_main_part_show');
                    }
                });
            }

            // settings
            let options = {
                root: null, // parent block
                rootMargin: '0px', // without margin
                threshold: 0.35 // procent of scrolled object
            };

            // creating observer
            let observer = new IntersectionObserver(onEntry, options);
            let elements = document.querySelectorAll('.header_main_part');
            
            // tracking class on page
            for (let elm of elements) {
                observer.observe(elm); // visor
            }
    </script>

    <div class="container">
        <div class="part_2">
            <div class="left_part_cont_2">
                <h1>Проявите креатив<br>с помощью <span style="color: #A400BE;">StudyLab</span></h1>
            </div>
            <div class="right_part_cont_2">
                <div class="wrapper_inf_part_2">
                    <img src="inc/img/check.png" class="check_img">
                    <h2 class="inf_cont_part_2">Научитесь творческим навыкам для достижения личных и профессиональных целей.</h2>
                </div>
                <div class="wrapper_inf_part_2">
                    <img src="inc/img/check.png" class="check_img">
                    <h2 class="inf_cont_part_2">Закрепляйте знания посредством практикума и тестового контроля.</h2>
                </div>
                <div class="wrapper_inf_part_2">
                    <img src="inc/img/check.png" class="check_img">
                    <h2 class="inf_cont_part_2">Настройтесь и повышайте уровень в своём собственном темпе.</h2>
                </div>
                <div class="wrapper_inf_part_2">
                    <img src="inc/img/check.png" class="check_img">
                    <h2 class="inf_cont_part_2">Делитесь современными знаниями с остальными.</h2>
                </div>
            </div>
        </div>
        <script>
            function onEntry(entry) {
                entry.forEach(change => {
                if (change.isIntersecting) {
                 change.target.classList.add('part_2_show');
                }
              });
            }
            
            options_ = {
              threshold: [0.3]
            };
            observer = new IntersectionObserver(onEntry, options);
            elements = document.querySelectorAll('.part_2');
            
            for (let elm of elements) {
              observer.observe(elm);
            }
        </script>
    </div>
    <div class="part_3 part_3_show">
        <div class="container">
            <h1 class="part_3_name" id="hiw">Как это работает?</h1>
            <div class="wrapper_hiw_blocks">
                <div class="block_hiw">
                    <img src="inc/img/Step_1.png" alt="" class="step_img">
                    <h2>Пройдите регистрацию</h2>
                    <p>Заполните личный профиль <br> и дождитесь подтверждения <br>со стороны преподавателя</p>
                </div>
                <div class="block_hiw">
                    <img src="inc/img/Step_2.png" alt="" class="step_img">
                    <h2>Изучите материал</h2>
                    <p>Прочтите учебные материалы <br>в каждом разделе и выполните контрольные задания</p>
                </div>
                <div class="block_hiw">
                    <img src="inc/img/Step_3.png" alt="" class="step_img">
                    <h2>Получите сертификат</h2>
                    <p>Выполните программу курса <br>и получите сертификат, подтверждающий ваши знания</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function onEntry(entry) {
                entry.forEach(change => {
                if (change.isIntersecting) {
                 change.target.classList.add('wrapper_hiw_blocks_show');
                }
              });
            }
            
            options_ = {
              threshold: [0.3]
            };
            observer = new IntersectionObserver(onEntry, options);
            elements = document.querySelectorAll('.wrapper_hiw_blocks');
            
            for (let elm of elements) {
              observer.observe(elm);
            }
    </script>


    <div class="container">
        <div class="part_4" id="programm_courses">
            <div class="line_1_part_4">
                <h1>Программа курсов</h1>
            </div>
            <div class="line_2_part_4">
                <div class="left_part_4">
                    
                    <ul class="topmenu">
                        <li><a href="" class="submenu-link">Компьютерные сети <div class="arrow main_m_arr"></div></a>
                            <ul class="submenu">
                                <li><a class="link_name_course" href="">UX/UI дизайн</a></li>
                                <li><a class="link_name_course" href="">3D моделирование</a></li>
                                <li><a class="link_name_course" href="">Бизнес логика</a></li>
                            </ul>
                        </li>
                    </ul>
                    <button class="view_course_text"><h3>Модуль 1 | Основы сетей передачи данных</h3></button>
                    <button class="view_course_text"><h3 class="highlight">Модуль 2 | Технология Ethernet</h3></button>
                    <button class="view_course_text"><h3>Модуль 3 | Сети TCP/IP</h3></button>
                    <button class="view_course_text"><h3>Модуль 4 | Беспроводная передача данных</h3></button>
                    <button class="view_course_text"><h3>Модуль 5 | Сетевые информационные службы</h3></button>
                    <button class="view_course_text"><h3>Модуль 6 | Безопасность компьютеров в сети</h3></button>
                    <button class="view_course_text"><h3>Модуль 7 | Администрирование вычислительной сети</h3></button>
                </div>
                <div class="right_part_4">
                    <div class="more_inf_module">
                        <h2 class="name_module">Модуль 2 | Технология Ethernet</h2>
                        <br>
                        <ol class="options_ol">
                            <li>Ethernet на разделяемой среде. Коммутируемый Ethernet. Скоростные версии Ethernet</li>
                            <li>Изучение базовых функций Cisco IOS. Настройка коммутатора. Моделирование работы локальной сети</li>
                            <li>Создание и настройка однорананговой сети Ethernet</li>
                            <li>Алгоритм покрывающего дерева. Агрегирование линий связи в локальных сетях. Виртуальные локальные сети.</li>
                            <li>Создание Виртуальных сетей на базе одного и нескольких коммутаторов</li>
                            <li>Ethernet операторвского класса</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function onEntry(entry) {
                entry.forEach(change => {
                if (change.isIntersecting) {
                 change.target.classList.add('line_2_part_4_show');
                }
              });
            }
            
            options_ = {
              threshold: [0.3]
            };
            observer = new IntersectionObserver(onEntry, options);
            elements = document.querySelectorAll('.line_2_part_4');
            
            for (let elm of elements) {
              observer.observe(elm);
            }
    </script>


    <div class="container">
        <div class="part_5" id="reg">
            <div class="line_1_part_5">
                <h1>Присоединяйтесь к нам</h1>
            </div>
            <div class="line_2_part_5">
                <div class="wrapper_image_banner">
                    <img src="inc/img/background_part_5.png" class="img_part_5">
                </div>
                <div class="wrapper_full_reg">
                    <div class="steps_">
                        <div id="reg_step_1">1
                            <div class="inscription_reg">
                                <p>Регистрация</p>
                            </div>
                        </div>
                        <div class="line" id="line_1-2"></div>
                        <div id="reg_step_2">2
                            <div class="inscription_reg _ins_pers">
                                <p>Персональные данные</p>
                            </div>
                        </div>
                        <div class="line" id="line_2-3"></div>
                        <div id="reg_step_3">3
                            <div class="inscription_reg _ins_pers">
                                <p>Подтверждение данных</p>
                            </div>
                        </div>
                    </div>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="action" value="register">
                        <div id="data_step_1">
                            <h2 class="registr">Регистрация</h2>
                            <div class="input-container">
                                <span class="icon">
                                  <img src="inc/img/placeholder_human.png" alt="">
                                </span>
                                <input type="text" placeholder="Логин" name="login" required>
                            </div>
                            <div class="input-container">
                                <span class="icon">
                                  <img src="inc/img/palceholder_password.png" alt="">
                                </span>
                                <input type="password" placeholder="Пароль" name="password" required>
                            </div>
                            <div class="input-container">
                                <span class="icon">
                                  <img src="inc/img/palceholder_password.png" alt="">
                                </span>
                                <input id="password-input" type="password" placeholder="Повторите пароль" name="passwordRepeat" required>
                                <span class="icon_eye">
                                    <!-- <img src="inc/img/open_eye.png" alt=""> -->
                                    <!-- <img src="inc/img/palceholder_password.png" alt=""> -->
                                    <!-- <a href="#" class="password-control" onclick="return show_hide_password(this);"></a> -->
                                </span>
                                <!-- <div class="wrapper_icon_eye">
                                    <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
                                </div> -->
                            </div>
                            <div class="nav_reg">
                                <button class="go" type="button" type="hidden" style="background: transparent; cursor: none;"></button>
                                <button class="go" type="button" onclick="go_to_2()">Далее &#x27F6;</button>
                            </div>
                        </div>
                        <div id="data_step_2">
                            <h2 class="pers_data">Персональные данные</h2>
                            <div class="input-container">
                                <span class="icon">
                                  <img src="inc/img/mail.png" alt="">
                                </span>
                                <input type="email" placeholder="Электронная почта" name="email" required>
                            </div>
                            <div class="input-container">
                                <span class="icon">
                                  <img src="inc/img/pers_data.png" alt="">
                                </span>
                                <input type="text" placeholder="Фамилия" name="surname" required>
                            </div>
                            <div class="input-container">
                                <span class="icon">
                                  <img src="inc/img/pers_data.png" alt="">
                                </span>
                                <input type="text" placeholder="Имя" name="name" required>
                            </div>
                            <div class="input-container">
                                <span class="icon">
                                  <img src="inc/img/pers_data.png" alt="">
                                </span>
                                <input type="text" placeholder="Отчество" name="father_name" required>
                            </div>
                            <div class="nav_reg">
                                <button class="back" type="button" onclick="back_to_1()">&#x27F5; Вернуться</button>
                                <button class="go" type="button" onclick="go_to_3()">Далее &#x27F6;</button>
                            </div>
                        </div>
                        <div id="data_step_3">
                            <h2 class="access_data">Подтверждение данных</h2>
                            <div class="input-container">
                                <span class="icon">
                                  <img src="inc/img/pers_data.png" alt="">
                                </span>
                                <input type="text" placeholder="Логин" name="loginConfirm" required>
                            </div>
                            <div class="input-container">
                                <span class="icon">
                                  <img src="inc/img/mail.png" alt="">
                                </span>
                                <input type="email" placeholder="Электронная почта" name="emailConfirm" required>
                            </div>
                            <div class="input-container">
                                <span class="icon">
                                  <img src="inc/img/palceholder_password.png" alt="">
                                </span>
                                <input type="password" placeholder="Пароль" name="passwordConfirm" required>
                            </div>
                            <div class="nav_reg">
                                <button class="back" type="button" onclick="back_to_2()">&#x27F5; Вернуться</button>
                                <button class="go" onclick="finish_reg()">Далее &#x27F6;</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function onEntry(entry) {
                    entry.forEach(change => {
                    if (change.isIntersecting) {
                     change.target.classList.add('line_2_part_5_show');
                    }
                  });
                }
                
                options_ = {
                  threshold: [0.3]
                };
                observer = new IntersectionObserver(onEntry, options);
                elements = document.querySelectorAll('.line_2_part_5');
                
                for (let elm of elements) {
                  observer.observe(elm);
                }
        </script>

        <div class="part_6">
            <div class="main_stat">
                <h2 class="main_stat_title">Общая статистика</h2>
                <div class="hr_line"></div>
                <h4 class="inf_main_stat">Количество курсов <span>6</span></h4>
                <h4 class="inf_main_stat">Выдано серитификатов <span>52</span></h4>
                <h4 class="inf_main_stat">Количество учащихся<span>34</span></h4>
            </div>
            <div class="most_view">
                <h2 class="most_view_title">Часто просматриваемые</h2>
                <div class="hr_line"></div>
                <h4 class="inf_most_view"><a class="link_to_theme" href="">Название темы <span>6</span></a></h4>
                <h4 class="inf_most_view"><a class="link_to_theme" href="">Название темы <span>52</span></a></h4>
                <h4 class="inf_most_view"><a class="link_to_theme" href="">Название темы <span>34</span></a></h4>
            </div>
            <div class="best_students">
                <h2 class="most_view_title">Лучшие учащиеся</h2>
                <div class="hr_line"></div>
                <h4 class="inf_best_students">Коростик Павел <span><img src="inc/img/full_star.png" alt="" class="str_img"><img src="inc/img/full_star.png" alt="" class="str_img"><img src="inc/img/full_star.png" alt="" class="str_img"><img src="inc/img/full_star.png" alt="" class="str_img"><img src="inc/img/half_star.png" alt="" class="half_star"></span></h4>
            </div>
        </div>
        <script>
            function onEntry(entry) {
                entry.forEach(change => {
                if (change.isIntersecting) {
                 change.target.classList.add('part_6_show');
                }
              });
            }
            
            options_ = {
              threshold: [0.3]
            };
            observer = new IntersectionObserver(onEntry, options);
            elements = document.querySelectorAll('.part_6');
            
            for (let elm of elements) {
              observer.observe(elm);
            }
        </script>
    </div>

    
    
    <footer class="footer">
        <div class="wrapper_footer">
            <button onclick="myworks('#programm_courses')" class="link_programm">Программа курсов</button>
            <a href="" class="wrapper_logo_footer">
                <img src="inc/img/logo_small.png" alt="" class="small_logo_footer">
                <h2 class="name_logo_footer">StudyLab</h2>
            </a>
            <button onclick="myworks('#hiw')" class="link_hiw">Как это работает?</button>
        </div>
    </footer>

    <script>
        function onEntry(entry) {
            entry.forEach(change => {
            if (change.isIntersecting) {
             change.target.classList.add('wrapper_footer_show');
            }
          });
        }
        
        options_ = {
          threshold: [0.3]
        };
        observer = new IntersectionObserver(onEntry, options);
        elements = document.querySelectorAll('.wrapper_footer');
        
        for (let elm of elements) {
          observer.observe(elm);
        }
    </script>

    <script>
        function myworks(id) {
            var offset = 0;
            $('html, body').animate({
                scrollTop: $(id).offset().top - offset
            }, 600);
            return false;
        }
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                var myBlock = document.getElementById('window_log_in_wrapper');
                myBlock.style.display = 'none';
                document.getElementById('body').style.overflowY = 'auto';
            }
        });

        function go_to_2() {
            document.getElementById('data_step_2').style.display = "block";
            document.getElementById('data_step_1').style.display = "none";
            document.getElementById('line_1-2').style.animationName = "Anim_line_1-2";
            setTimeout(function() {
                document.getElementById('reg_step_2').style.animationName = "Anim_Step_2";            
            }, 500);
        }

        function back_to_1() {
            document.getElementById('data_step_1').style.display = "block";
            document.getElementById('data_step_2').style.display = "none";
            document.getElementById('reg_step_2').style.animationName = "Anim_Step_1";            
            setTimeout(function() {
                document.getElementById('line_1-2').style.animationName = "Anim_line_1-2-BACK";
            }, 200);
        }

        function go_to_3() {
            document.getElementById('data_step_3').style.display = "block";
            document.getElementById('data_step_2').style.display = "none";
            document.getElementById('line_2-3').style.animationName = "Anim_line_2-3";
            setTimeout(function() {
                document.getElementById('reg_step_3').style.animationName = "Anim_Step_3";            
            }, 500);
        }

        function back_to_2() {
            document.getElementById('data_step_2').style.display = "block";
            document.getElementById('data_step_3').style.display = "none";
            document.getElementById('reg_step_3').style.animationName = "Anim_Step_2_BACK";            
            setTimeout(function() {
                document.getElementById('line_2-3').style.animationName = "Anim_line_2-3-BACK";
            }, 200);
        }
    </script>
</body>
</html>