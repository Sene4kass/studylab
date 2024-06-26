<?php
session_start();
    include_once "db.php";
    include_once "User.php";
    $user = new User();
    global $db;
    if(!isset($_GET["action"])) {
        header("Location:index.php");
        showNotification("Ошибка запроса");
    }

    function showNotification($text) {
        echo "<script>alert('".$text."')</script>";
    }

    if(!isset($_SESSION) or $_SESSION["isAuth"] == 0) {
        header("Location:index.php");
        showNotification("Не выполнен вход");
    }

    include_once "PagesNavigation.php";
    $pagesNav = new PagesNavigation();

    $query = $db->prepare("SELECT `Role_name` FROM `role` WHERE `id_Role` = ?");
    $query->bind_param("i", $_SESSION["role"]);
    $query->execute();
    $result = $query->get_result();
    $userRole = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        echo $pagesNav->getNavList()[$_GET["action"]];
        ?></title>
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
                <?php
                echo '
                <a class="nav_link main_link" href="index.php"><img class="img_link_prof" src="inc/img/home_dafulut.png" alt=""> Главная</a>
                <a class="nav_link courses_link" href="template.php?action=courses.php"><img class="img_link_prof" src="inc/img/courses_default.png" alt=""> Курсы</a>
                <a style="color: #5B34CA;" class="nav_link content_link" href="template.php?action=content_course.php"><img class="img_link_prof" src="inc/img/content_icon_active.png" alt=""> Содержание</a>
                <a class="nav_link dashbord_link" href="template.php?action=detailed_stat.php"><img class="img_link_prof" src="inc/img/dashboard_default.png" alt=""> Дашборд</a>
                ';
                if(PagesNavigation::isAdmin())
                {
                    echo '
                        <a style="color: #5B34CA;" class="nav_link courses_link" href="template.php?action=edit_module_teacher.php"><img class="img_link_prof" src="inc/img/conf_active.png" alt="">Управление</a>
                    ';
                }
                ?>
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
                    <?php
                    echo $pagesNav->getNavList()[$_GET["action"]];
                    for($i=0; $i<=count($pagesNav->ElementsList); $i++){
                        if($_GET["action"] == $pagesNav->ElementsList[$i]) {
                        $courses_names_list = $user->getAllCoursesNames();
                            echo '<button class="button_menu butt__" id="toggleButton" onclick="toggleDropdown(\'arrow_list\')"><div class="arrow" id="arrow_button"></div></button>
                                    <div class="dropdown-container">
                                      <ul id="dropdownList">';
                            for($i=0;$i<count($courses_names_list);$i++) {
                                echo '
                                    <li><a href="template.php?action=edit_module_teacher.php&course='.$courses_names_list[$i][0].'">'. $courses_names_list[$i][0] . '</a></li>';
                            }
                            echo'
                              </ul>
                            </div>';
                        }
                        break;
                    }
                    ?>
                </h1>

                <div class="small_info">
                    <img class="small_ava_heaader" src="inc/img/ava_teacher.png" alt="">
                    <div class="wrapper_name_prioritety">
                        <h4><?php echo $_SESSION["name"].' '.$_SESSION["surname"]; ?></h4>
                        <p><? echo $userRole["Role_name"];?></p>
                    </div>
                    <button id="toggle-button">
                        <div class="arrow" id="arrow_button_"></div>
                    </button>
                    <div id="window" style="display: none;opacity: 0;">
                        <div class="small_window_line_1">
                            <img src="inc/img/user_icon.png" class="us_ic" alt="">
                            <h4 class="link_us_prof"><a href="template.php?action=profile.php">Личный профиль</a></h4>
                        </div>

                        <div class="horiz_line_menu"></div>

                        <div class="small_window_line_2">
                            <img src="inc/img/logout.png" class="logout_ic" alt="">
                            <h4 class="link_logout"><a href="exit.php">Выйти</a></h4>
                        </div>
                    </div>

            </header>

            <div class="block_content _spsp" style="display: flex;justify-content: space-between;">
                <?php
                    include_once $_GET["action"];
                ?>
            </div>

            <script type="text/javascript" src="inc/js/main.js">
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

            </script>
    </div>
</body>
</html>