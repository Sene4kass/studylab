<?php
include_once "db.php";
class User
{
    public function registerUser($login, $password, $email, $name, $surname, $father_name) {
        try {
            if (!$this->isAccountCreated($login, $email)) {
                // обработка строк для защиты
                $login = $this->stringValidation($login);
                $password = $this->stringValidation($password);
                $email = $this->stringValidation($email);
                $name = $this->stringValidation($name);
                $surname = $this->stringValidation($surname);
                $father_name = $this->stringValidation($father_name);
                $passwordHash = hash('sha256', $password);
                $STATUS = 'active';
                $ROLE = 1;

                global $db; // подключение базы данных (db.php)

                $query = "INSERT INTO `user`(`First_name`, `Surname`, `Patronymic`, `Status`, `Login`, `Password`, `E_mail`, `id_Role`) VALUES ('$name', '$surname', '$father_name', '$STATUS', '$login', '$passwordHash', '$email', '$ROLE')";
                $result = $db->query($query);
                $this->logToFile('>  Пользователь '.$login.' создан', 'log.txt');
                if ($db->error) {
                    $this->logToFile($db->error, 'log.txt');
                    return "Ошибка в создании пользователя [BD]. Обратитесь к администратору.";
                }
                return "Регистрация прошла успешно!";
            }
            else {
                return "Аккаунт с такими же данными уже имеется";
            }
        }
        catch(Exception $e ) {
                return "Упс! Что-то пошло не так";
            }

    }

    public function loginUser($login,$password){
        if(isset($_SESSION) and $_SESSION["isAuth"] == 1){
            return false;
        }
        $login = $this->stringValidation($login);
        $password = $this->stringValidation($password);
        global $db;
        $query = $db->prepare("SELECT * FROM `user` WHERE `Login` = ? OR `E_mail` = ?");
        $query->bind_param("ss", $login, $login);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            $userInfo = $result->fetch_assoc();
            $passHash = hash("sha256", $password);
            if($passHash == $userInfo["Password"]):
                $_SESSION["id"] = $userInfo["id_User"];
                $_SESSION["login"] = $userInfo["Login"];
                $_SESSION["role"] = $userInfo["id_Role"];
                $_SESSION["name"] = $userInfo["First_name"];
                $_SESSION["surname"] = $userInfo["Surname"];
                $_SESSION["lastname"] = $userInfo["Patronymic"];
                $_SESSION["isAuth"] = 1;

                return true;
            else:
                return false;
            endif;
        }
    }



    private function stringValidation($string){
        global $db;
        $string = $db->real_escape_string($string);
        $string = htmlspecialchars($string);
        return $string;
    }

    // есть ли аккаунт с такими же данными в бд
    private function isAccountCreated($login, $email) {
        global $db;
        $query = $db->prepare("SELECT * FROM `user` WHERE `Login` = ? OR `E_mail` = ?");
        $query->bind_param("ss", $login, $email);
        $query->execute();
        $query->store_result();
        $this->logToFile($query->num_rows, "num_rows.txt");
        if($query->num_rows == 0) {
            return false;
        }
        else {
            return true;
        }
    }


    public function userLogout(){
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
    }

    function createCourse($name, $desc, $fullDesk, $future){
        global $db;
        $query = $db->prepare("INSERT INTO `subject`(`Name`, `Short_description`, `Full_description`, `Status`) VALUES (?,?,?,?)");
        $query->bind_param("sssi",$name, $desc, $fullDesk, $future);
        $query->execute();

        $id_User = $_SESSION["id"];

        $query = $db->prepare("SELECT * FROM `subject` WHERE `Name` = ".$name."");
        $query->execute();
        $result = $query->get_result();
        $subject = $result->fetch_assoc();
        $id_Subject = $subject["id_Subject"];

        $query = $db->prepare("INSERT INTO `subject_user`(`id_Subject`, `id_User`) VALUES (?,?)");
        $query->bind_param("ii",$id_Subject, $id_User);
        $query->execute();
        if($db->error){
            echo $db->error;
        }
        PagesNavigation::redirectUser('');
    }

    function createModule($name, $position, $view_status, $access_status){
        global $db;
        $course_id = User::GetCourseByName($_GET["course"]);
        $query = $db->prepare("INSERT INTO `module`(`Module_name`,`Position_in_list`, `View_status`, `Access_status`, `id_Subject`) VALUES (?,?,?,?,?)");
        $query->bind_param("siiii",$name, $position, $view_status, $access_status, $course_id["id_Subject"]);
        $query->execute();
        if($db->error){
            echo $db->error;
        }
    }

    function updateModule($name, $position, $view_status, $access_status, $id){
        global $db;
        $query = $db->prepare("UPDATE `module` SET `Module_name` = ?, `Position_in_list` = ?, `View_status` = ?, `Access_status` = ? WHERE `id_Module` = ?");
        $query->bind_param("siiii",$name, $position, $view_status, $access_status, $id);
        $query->execute();
        if($db->error){
            echo $db->error;
        }
        PagesNavigation::redirectUser('');
    }
    function updateCourse($name, $desc, $fulldesc, $id){
        global $db;
        $query = $db->prepare("UPDATE `subject` SET `Name` = ?, `Short_description` = ?, `Full_description` = ? WHERE `id_Subject` = ?");
        $query->bind_param("sssi",$name, $desc, $fulldesc, $id);
        $query->execute();
        if($db->error){
            echo $db->error;
        }
        PagesNavigation::redirectUser('');
    }


    public static function hadSubjectTeacher(){
        // есть ли у учителя созданные курсы
        global $db;
        $query = $db->prepare("SELECT * FROM `subject_user` WHERE `id_User` = ?");
        $query->bind_param("s", $_SESSION["id"]);
        $query->execute();
        $result = $query->get_result();
        if($db->error){
            echo $db->error;
        }
        if($result->num_rows == 0) {
            return null;
        }
        else {
            $i = 0;
            $subjectUserInfo = $result->fetch_all();
            return $subjectUserInfo;
        }
    }

    public static function GetCourseList(){
        global $db;
        $query = $db->prepare("SELECT * FROM `subject`");
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows == 0) {
            return null;
        }
        else {
            $subjectList = $result->fetch_all();
            return $subjectList;
        }

    }

    public static function GetCourse($id) {
        global $db;
        $query = $db->prepare("SELECT * FROM `subject` WHERE `id_Subject` = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();
        if($db->error){
            echo $db->error;
        }
        if($result->num_rows == 0) {
            return null;
        }
        else {
            $courseInfo = $result->fetch_assoc();
            return $courseInfo;
        }
    }
    public static function GetCourseByName($name) {
        global $db;
        $query = $db->prepare("SELECT * FROM `subject` WHERE `Name` = ?");
        $query->bind_param("s", $name);
        $query->execute();
        $result = $query->get_result();
        if($db->error){
            echo $db->error;
        }
        if($result->num_rows == 0) {
            return null;
        }
        else {
            $courseInfo = $result->fetch_assoc();
            return $courseInfo;
        }
    }

    public static function getAllCoursesNames() {
        global $db;
        $query = $db->prepare("SELECT `Name` FROM `subject`");
        $query->execute();
        $result = $query->get_result();
        if($db->error){
            echo $db->error;
        }
        if($result->num_rows == 0) {
            return null;
        }
        else {
            $courseInfo = $result->fetch_all();
            return $courseInfo;
        }
    }

    public static function getModulesByCourse($course_name) {
        global $db;
        $query = $db->prepare("SELECT `id_Subject` FROM `subject` WHERE `Name` = ?");
        $query->bind_param("s", $course_name);
        $query->execute();
        $result = $query->get_result();
        if($db->error){
            echo $db->error;
        }
        if($result->num_rows == 0) {
            return null;
        }
        else {
            $course_ID = $result->fetch_row();
            $course_ID = $course_ID[0];
        }
        $query = $db->prepare("SELECT * FROM `module` WHERE `id_Subject` = ?");
        $query->bind_param("i", $course_ID);
        $query->execute();
        $result = $query->get_result();
        if($db->error){
            echo $db->error;
        }
        if($result->num_rows == 0) {
            return null;
        }
        else {
            $modules_list = $result->fetch_all();
            return $modules_list;
        }
    }

    public function getLessonsByModule($moduleID) {
        global $db;
        $query = $db->prepare("SELECT COUNT(*) FROM `lesson` WHERE `id_Module` = ?");
        $query->bind_param("i", $moduleID);
        $query->execute();
        $result = $query->get_result();
        if($db->error){
            echo $db->error;
        }
        return $result->fetch_row();
    }





    private function logToFile($message, $filename) {
        $logMessage = '[' . date('Y-m-d H:i:s') . '] ' . $message . "\n";
        file_put_contents($filename, $logMessage, FILE_APPEND);
    }
}


?>