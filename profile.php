<?php
    if(PagesNavigation::isAdmin()){
        PagesNavigation::redirectUser("template.php?action=profile_teacher.php");
        //exit();
    }
?>
        <div class="main_content_part">

            <div class="block_content">
                <h1 class="my_courses_name">Мои курсы</h1>
                <div class="courses_wrapper">
                    <div class="course_block porf_c_wrapper">
                        <img class="img_course" src="inc/img/image_of_course.png" alt="">
                        <h3 class="title_course_small">UX/UI Дизайн</h3>
                        <p class="info_course">Вы научитесь разрабатывать сайты, делать к ним интерфейс. Научитесь создавать дизайн для интернет-ресурсов, способный решить проблему пользователя</p>
                        <button class="filled_btn link_to_course"><a href="" class="">Перейти к курсу</a></button>
                    </div>
                </div>

                <h1 class="my_forthcoming_courses_name">Предстоящие курсы</h1>
                <div class="courses_wrapper">
                    <div class="course_block porf_c_wrapper">
                        <img class="img_course" src="inc/img/image_of_course.png" alt="">
                        <h3 class="title_course_small">UX/UI Дизайн</h3>
                        <p class="info_course">Вы научитесь разрабатывать сайты, делать к ним интерфейс. Научитесь создавать дизайн для интернет-ресурсов, способный решить проблему пользователя</p>
                    </div>
                </div>
            </div>
        </div>
