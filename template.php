<?php
    session_start();
    include_once "db.php";
    global $db;
    if(!isset($_GET["action"])) {
        header("Location:index.php");
        exit("Ошибка запроса");
    }
    if(!isset($_SESSION) or $_SESSION["isAuth"] == 0) {
        header("Location:index.php");
        exit("Не выполнен вход");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylesprof.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="menu_part">
            <a class="home_link" href="">
                <img class="small_logo" src="inc/img/logo_small.png">
                <h2 class="name_logo">StudyLab</h2>
            </a>
            <nav>
                <a class="nav_link main_link" href=""><img class="img_link_prof" src="inc/img/home_dafulut.png" alt=""> Главная</a>
                <a class="nav_link courses_link" href=""><img class="img_link_prof" src="inc/img/courses_default.png" alt=""> Курсы</a>
                <a style="color: #5B34CA;" class="nav_link content_link" href=""><img class="img_link_prof" src="inc/img/content_icon_active.png" alt=""> Содержание</a>
                <a class="nav_link dashbord_link" href=""><img class="img_link_prof" src="inc/img/dashboard_default.png" alt=""> Дашборд</a>
                <a style="color: #5B34CA;" class="nav_link courses_link" href=""><img class="img_link_prof" src="inc/img/conf_active.png" alt="">Управление</a>
            </nav>
            <script>

                // do for every recorded object
                function onEntry(entry) {
                    entry.forEach(change => {
                        if (change.isIntersecting) {
                            change.target.classList.add('menu_part_show');
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
                let elements = document.querySelectorAll('.menu_part');
                // tracking class on page
                for (let elm of elements) {
                    observer.observe(elm); // visor
                }

            </script>
        </div>
        <div class="main_content_part">
            <header>
                <h1 class="name_header_profile_page">
                    Компьютерные сети
                    <button class="button_menu butt__" id="toggleButton" onclick="toggleDropdown()"><div class="arrow"></div></button>
                    <div class="dropdown-container">
                      <ul id="dropdownList">
                        <li>Элемент 1</li>
                        <li>Элемент 2</li>
                        <li>Элемент 3</li>
                      </ul>
                    </div>
                </h1>

                <div class="small_info">
                    <img class="small_ava_heaader" src="inc/img/ava_teacher.png" alt="">
                    <div class="wrapper_name_prioritety">
                        <h4><?php echo $_SESSION["name"].' '.$_SESSION["surname"]; ?></h4>
                        <p>
                            <?php
                            $query = $db->prepare("SELECT `Role_name` FROM `role` WHERE `id_Role` = ?");
                            $query->bind_param("i", $_SESSION["role"]);
                            $query->execute();
                            $result = $query->get_result();
                            $userRole = $result->fetch_assoc();
                            print($userRole["Role_name"]);

                            ?>

                        </p>
                    </div>
                    <button id="toggle-button">
                        <div class="arrow"></div>
                    </button>
                    <div id="window" style="display: none;opacity: 0;">
                        <div class="small_window_line_1">
                            <img src="inc/img/user_icon.png" class="us_ic" alt="">
                            <h4 class="link_us_prof"><a href="">Линчый профиль</a></h4>
                        </div>

                        <div class="horiz_line_menu"></div>

                        <div class="small_window_line_2">
                            <img src="inc/img/logout.png" class="logout_ic" alt="">
                            <h4 class="link_logout"><a href="">Выйти</a></h4>
                        </div>
                    </div>

            </header>

            <div class="block_content _spsp" style="display: flex;justify-content: space-between;">
                <?php
                    include_once $_GET["action"];
                ?>
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







                /*Menu Modal*/

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
                }




                function toggleDropdown() {
                    var dropdownList = document.getElementById("dropdownList");
                    dropdownList.classList.toggle("show");
                }






                /* Checkboxes */


                function toggleCheckboxes() {
                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    var masterCheckbox = document.getElementById('masterCheckbox');

                    for (var i = 0; i < checkboxes.length; i++) {
                      checkboxes[i].checked = masterCheckbox.checked;
                    }
                }

               









                /* Add block */
                
                function toggleBlockEdit() {
                    var block = document.getElementById("myBlock");
                    block.classList.toggle("hidden_block");
                    block.classList.toggle("show_block");

                    // var block2 = document.getElementById("myBlockAdd");
                    // block2.classList.toggle("hidden_block");
                    // block2.classList.toggle("show_block");
                }

                function toggleBlockAdd() {
                    // var block3 = document.getElementById("myBlock");
                    // block3.classList.toggle("hidden_block");

                    var block = document.getElementById("myBlockAdd");
                    block.classList.toggle("hidden_block");
                    block.classList.toggle("show_block");
                }










                /* Test Mark */

                const tableRows = document.querySelectorAll('.tt_');

                tableRows.forEach(function(row) {
                  row.addEventListener('click', function() {
                    // const targetId = row.getAttribute('data-target');
                    // const targetBlock = document.getElementById(targetId);
                    document.getElementById('modal_wind_marks').style.display = "flex";
                  });
                });
















                function toggleCheckboxes() {
                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    var masterCheckbox = document.getElementById('masterCheckbox');

                    for (var i = 0; i < checkboxes.length; i++) {
                      checkboxes[i].checked = masterCheckbox.checked;
                    }
                }

                function toggleCheckbox_All(checkbox) {
                    checkbox.classList.toggle("checked");

                    var checkboxes = document.querySelectorAll(".custom-checkbox");
                    var isChecked = checkbox.classList.contains("checked");

                    checkboxes.forEach(function(element) {
                        if (checkbox.id === "select-all") {
                            element.classList.toggle("checked", isChecked);
                        } else if (element !== checkbox) {
                            if (isChecked) {
                                element.classList.add("checked");
                            } else {
                                element.classList.remove("checked");
                            }
                        }
                    });
                }
        </script>
    </div>
</body>
</html>