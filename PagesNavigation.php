<?php

class PagesNavigation
{
    private array $NavList = [
        "profile.php" => "Мой профиль",
        "profile_teacher.php" => "Панель управления",
        "courses.php" => "Просмотр курсов",
        "detailed_stat.php" => "Детальная статистика",
        "content_course.php" => "Просмотр курса",
        "content_course_teacher.php" => "Управление курсом",
        "edit_lesson_teacher.php" => "Редактировать урок",
        "edit_module_teacher.php" => "Редактировать модули",
        "edit_users_teacher.php" => "Редактировать пользователя",
        "edit_course_teacher.php" => "Редактировать курсы"
        ];
    public function getNavListModule(){
        print("wohoo");
    }
    public array $ElementsList = [
        "edit_module_teacher.php"
    ];

    public function getNavList(){
        return $this->NavList;
    }



    public static function isAdmin(){
        if($_SESSION["role"] == 2){
            return true;
        }
        else {
            return false;
        }
    }

    public static function redirectUser($page) {
        echo '<script type="text/javascript">
                location.replace("'.$page.'");
                </script>';
    }
}