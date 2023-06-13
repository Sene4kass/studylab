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
            // работа с сессиями
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

    private function logToFile($message, $filename) {
        $logMessage = '[' . date('Y-m-d H:i:s') . '] ' . $message . "\n";
        file_put_contents($filename, $logMessage, FILE_APPEND);
    }
}

?>