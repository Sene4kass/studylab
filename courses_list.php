<?php
if(!PagesNavigation::isAdmin()){
    PagesNavigation::redirectUser("template.php?action=profile.php");
}

if(isset($_POST) and $_POST["action"] == "create_module") {
    global $user;
    $user->createModule($_POST["course_name"], $_POST["course_description"], $_POST["course_image"]);
}
?>
            <div class="block_content" style="display: flex;">
            
                <div class="wrapper_course_area">
                    <div class="wrapper_image_icon">
                        <img class="icon_course" src="inc/img/image4.png" alt="">
                        <div class="time_wrapper">
                            <img class="clock_icon" src="inc/img/clock.png" alt="">
                            <p>95ч 35мин</p>
                        </div>
                    </div>
                    
                    <h2>Компьютерные сети</h2>
                    <p>Вы научитесь разрабатывать сайты, делать к ним интерфейс. Научитесь создавать дизайн для интернет-ресурсов, способный решить проблему пользователя</p>
                    <div class="wrapper_buttons_select">
                        <button class="filled_btn big">Узнать больше</button>
                        <button class="unfilled_bgtn big" style="margin-left: 20px; width: 140px;">Перейти</button>
                    </div>
                </div>

                <div class="wrapper_course_area">
                    <div class="wrapper_image_icon">
                        <img class="icon_course" src="inc/img/image4.png" alt="">
                        <div class="time_wrapper">
                            <img class="clock_icon" src="inc/img/clock.png" alt="">
                            <p>95ч 35мин</p>
                        </div>
                    </div>
                    
                    <h2>Компьютерные сети</h2>
                    <p>Вы научитесь разрабатывать сайты, делать к ним интерфейс. Научитесь создавать дизайн для интернет-ресурсов, способный решить проблему пользователя</p>
                    <div class="wrapper_buttons_select">
                        <button class="filled_btn big">Узнать больше</button>
                        <button class="unfilled_bgtn big" style="margin-left: 20px; width: 140px;">Перейти</button>
                    </div>
                </div>

                <div class="wrapper_course_area">
                    <div class="wrapper_image_icon">
                        <img class="icon_course" src="inc/img/image4.png" alt="">
                        <div class="time_wrapper">
                            <img class="clock_icon" src="inc/img/clock.png" alt="">
                            <p>95ч 35мин</p>
                        </div>
                    </div>
                    
                    <h2>Компьютерные сети</h2>
                    <p>Вы научитесь разрабатывать сайты, делать к ним интерфейс. Научитесь создавать дизайн для интернет-ресурсов, способный решить проблему пользователя</p>
                    <div class="wrapper_buttons_select">
                        <button class="filled_btn big">Узнать больше</button>
                        <button class="unfilled_bgtn big" style="margin-left: 20px; width: 140px;">Перейти</button>
                    </div>
                </div>

            </div>
        </div>
        <script type="text/javascript" src="inc/js/modal.js"></script>
    </div>
</body>
</html>