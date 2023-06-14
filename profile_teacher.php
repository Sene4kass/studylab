<?php
if($_SESSION["role"] !== 2){
    header("Location: template.php?action=profile.php");
    exit("Недостаточно прав доступа к данной странице");
}
$pageHeader = "Панель управления";
?>


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
