<?php
if($_SESSION["role"] !== 2){
    header("Location: template.php?action=profile.php");
    exit("Недостаточно прав доступа к данной странице");
}
$pageHeader = "Панель управления";
include_once "User.php";
?>


            <div class="block_content">
                <h1 class="my_courses_name">Мои курсы</h1>
                <div class="courses_wrapper">
                    <!-- <div class="course_block porf_c_wrapper">
                        <img class="img_course" src="inc/img/image_of_course.png" alt="">
                        <h3 class="title_course_small">UX/UI Дизайн</h3>
                        <p class="info_course">Вы научитесь разрабатывать сайты, делать к ним интерфейс. Научитесь создавать дизайн для интернет-ресурсов, способный решить проблему пользователя</p>
                        <button class="filled_btn link_to_course"><a href="" class="">Перейти к курсу</a></button>
                    </div> -->
                    <?php
                        if(User::hadSubjectTeacher() == null){
                            echo '
                            <div class="course_block porf_c_wrapper">
                            <p class="info_course">У вас нет ни одного курса. Желаете создать курс?</p>
                            <button class="filled_btn link_to_course"><a href="template.php?action=edit_module_teacher.php" class="">Создать курс</a></button>
                            </div>';
                        }
                        else {
                            $userSubjectInfo = User::hadSubjectTeacher();
                            $lengthOfArr = count($userSubjectInfo);
                            $i = 0;
                            while($i < $lengthOfArr) {
                                $id_of_course = $userSubjectInfo[$i][1];
                                $courseInfo = User::GetCourse($id_of_course);
                                echo '<div class="course_block porf_c_wrapper" style="margin-right: 20px;">
                                        <img class="img_course" src="inc/img/image_of_course.png" alt="">
                                        <h3 class="title_course_small">'.$courseInfo["Name"].'</h3>
                                        <p class="info_course">'.$courseInfo["Short_description"].'</p>
                                        <button class="filled_btn link_to_course"><a href="" class="">Перейти к курсу</a></button>
                                    </div>';
                                $i++;
                            }

                        }


                    ?>
                </div>

                <h1 class="my_forthcoming_courses_name">Предстоящие курсы</h1>
                <div class="courses_wrapper porf_c_wrapper">
                    <div class="course_block">
                        <img class="img_course" src="inc/img/image_of_course.png" alt="">
                        <h3 class="title_course_small">UX/UI Дизайн</h3>
                        <p class="info_course">Вы научитесь разрабатывать сайты, делать к ним интерфейс. Научитесь создавать дизайн для интернет-ресурсов, способный решить проблему пользователя</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
