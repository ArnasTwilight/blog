<?php


class User
{
    private const PASSWORD_LENGTH = 8;
    private const NAME_LENGTH = 2;

    /**
     * Check that $_SESSION['user'] is full;
     * Проверка $_SESSION['user'] на заполненность
     * @return bool
     */
    public static function isGuest ()
    {
        if (isset($_SESSION['user']))
        {
            return false;
        }
        return true;
    }
    /**
     * Checking whether the user is an administrator;
     * Проверка является ли пользователь администратором
     * @param $id
     * @return bool
     */
    public static function isAdmin ($id)
    {
        if (!empty($id))
        {
            $db = Db::getConnection();

            $sql = 'SELECT admin FROM user WHERE id = :Id';

            $result = $db->prepare($sql);
            $result->bindParam(':Id', $id['id'], PDO::PARAM_INT);
            $result->execute();
            $name = $result->fetch(PDO::FETCH_ASSOC);

            if ($name['admin'] == 1)
            {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * Registering a new user;
     * Регистрация нового пользователя
     * @param $name
     * @param $email
     * @param $password
     * @return bool
     */
    public static function registerUser ($name, $email, $password)
    {
        if (!empty($name) && !empty($email) && !empty($password))
        {
            $db = Db::getConnection();

            $sql = 'INSERT INTO user (name, email, password) VALUE (:name, :email, :password)';

            $result = $db->prepare($sql);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->bindParam(':password', $password, PDO::PARAM_STR);

            return $result->execute();
        }
        return false;
    }
    /**
     * Record user ID in $_SESSION ['user'];
     * Запись ID пользователя в $_SESSION ['user']
     * @param $userId
     * @return bool
     */
    public static function UserIdRecord ($userId)
    {
        if (!empty($userId))
        {
            $_SESSION['user'] = $userId;
            return true;
        }
        return false;
    }

    /**
     * Checking for user authorization;
     * Проверка авторизован ли пользователь
     * @return mixed
     */
    public static function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /login");
    }
    /**
     * Checking passed string for length NAME_LENGTH;
     * Проверка переданной строки на длинну NAME_LENGTH
     * @param $name
     * @return bool
     */
    public static function checkName ($name)
    {
        if (strlen($name) >= self::NAME_LENGTH)
        {
            return true;
        }
        return false;
    }
    /**
     * Validation of the email;
     * Проверка на корректность email
     * @param $email
     * @return bool
     */
    public static function checkEmail ($email)
    {
        if (!empty($email))
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Check the uniqueness of the name in the database;
     * Проверка на уникальность имени в БД
     * @param $name
     * @return bool
     */
    public static function checkUniquenessName ($name)
    {
        if (!empty($name))
        {
            $db = Db::getConnection();

            $sql = 'SELECT name FROM user WHERE name = :name';
            $result = $db->prepare($sql);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->execute();
            $nameVerify = $result->fetch(PDO::FETCH_ASSOC);

            if ($nameVerify == false)
            {
                return true;
            }
            return false;
        }
        return false;
    }
    /**
     * Check the uniqueness of the email in the database;
     * Проверка на уникальность email в БД
     * @param $email
     * @return bool
     */
    public static function checkUniquenessEmail ($email)
    {
        if (!empty($email))
        {
            $db = Db::getConnection();

            $sql = 'SELECT email FROM user WHERE email = :email';
            $result = $db->prepare($sql);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->execute();
            $emailVerify = $result->fetch(PDO::FETCH_ASSOC);

            if ($emailVerify == false)
            {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Checking password length with a constant PASSWORD_LENGTH;
     * Проверка длинны пароля по константе PASSWORD_LENGTH
     * @param $password
     * @return bool
     */
    public static function checkPasswordStrlen ($password)
    {
        if (!empty($password))
        {
            if (strlen($password) >= self::PASSWORD_LENGTH)
            {
                return true;
            }
            return false;
        }
        return false;
    }
    /**
     * Checks passwords for a match;
     * Проверка паролей на совпадение
     * @param $password
     * @param $password_repeat
     * @return bool
     */
    public static function checkPasswordMatching ($password, $password_repeat)
    {
        if (!empty($password) && !empty($password_repeat))
        {
            if ($password === $password_repeat)
            {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Hashes the password;
     * Хеширование пароля
     * @param $password
     * @return false|string|null
     */
    public static function passwordHash ($password)
    {
        if (!empty($password)){
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            return $password;
        }
        return false;
    }
    /**
     * Checks the password against the hash in the database;
     * Сверка введённого пароля с хешем в БД
     * @param $password
     * @param $email
     * @return bool
     */
    public static function passwordVerify ($password, $email)
    {
        if (!empty($password) && !empty($email))
        {
            $id = self::getUserId($email);

            if ($id != false)
            {
                $db = Db::getConnection();

                $sql = 'SELECT password FROM user WHERE id = :id';
                $result = $db->prepare($sql);
                $result->bindParam(':id', $id['id'], PDO::PARAM_STR);
                $result->execute();
                $passwordHash = $result->fetch(PDO::FETCH_ASSOC);

                $passwordVerify = password_verify($password, $passwordHash['password']);

                return $passwordVerify;
            }
            return false;
        }
        return false;
    }

    /**
     * Search for user id by email;
     * Получение ID пользователя по email в БД
     * @param $email
     * @return false|mixed
     */
    public static function getUserId ($email)
    {
        if (!empty($email))
        {
            $db = Db::getConnection();

            $sql = 'SELECT id FROM user WHERE email = :email';

            $result = $db->prepare($sql);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->execute();

            return $result->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
    /**
     * Get username by ID from DB;
     * Получение имени пользователя по ID из БД
     * @param $userId
     * @return mixed
     */
    public static function getUserName ($userId)
    {
        if (!empty($userId))
        {
            $db = Db::getConnection();

            $sql = 'SELECT name FROM user WHERE id = :userId';

            $result = $db->prepare($sql);
            $result->bindParam(':userId', $userId['id'], PDO::PARAM_INT);
            $result->execute();
            $name = $result->fetch(PDO::FETCH_ASSOC);

            return $name['name'];
        }
        return false;
    }
    /**
     * Get user data from database;
     * Получение данных пользователя из БД;
     * @param $userId
     * @return array
     */
    public static function getUserData ($userId)
    {
        if (!empty($userId))
        {
            $userData = array();

            $db = Db::getConnection();

            $sql = 'SELECT name, email FROM user WHERE id = :userId';

            $result = $db->prepare($sql);
            $result->bindParam(':userId', $userId['id'], PDO::PARAM_INT);
            $result->execute();
            $userData = $result->fetch(PDO::FETCH_ASSOC);

            return $userData;
        }
        return false;
    }
    /**
     * Updates user data, if they have been transferred;
     * Обновление данных пользователя
     * @param $id
     * @param $name
     * @param $password
     * @return bool
     */
    public static function editUserData ($id, $name, $password)
    {
        if (!empty($id) && !empty($name) or !empty($password))
        {
            $caseNum = '';

            $db = Db::getConnection();

            if (!empty($password) && !empty($name))
            {
                $caseNum = 2;
                $sql = 'UPDATE user SET name = :name, password = :password WHERE id = :id';
            }

            if (empty($name))
            {
                $caseNum = 1;
                $sql = 'UPDATE user SET password = :password WHERE id = :id';
            }

            if (empty($password))
            {
                $caseNum = 0;
                $sql = 'UPDATE user SET name = :name WHERE id = :id';
            }

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id['id'], PDO::PARAM_INT);

            switch ($caseNum)
            {
                case 0:
                    $result->bindParam(':name', $name, PDO::PARAM_STR);
                    return $result->execute();
                case 1:
                    $result->bindParam(':password', $password, PDO::PARAM_STR);
                    return $result->execute();
                case 2:
                    $result->bindParam(':name', $name, PDO::PARAM_STR);
                    $result->bindParam(':password', $password, PDO::PARAM_STR);
                    return $result->execute();
                default:
                    return false;
            }
        }
        return false;
    }
}