<?php


class CabinetController
{
    public function actionMain ()
    {
        $userId = User::checkLogged();

        $userName = User::getUserName($userId);

        $userData = User::getUserData($userId);

        $admin = User::isAdmin($userId);

        $name = '';
        $password = '';
        $password_repeat = '';

        $errors = '';

        $cabinet = true;

        if (isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $password_repeat = $_POST['password_repeat'];

            $errors = false;

            if (!empty($name))
            {
                if ($userData['name'] == $name)
                {
                    $errors[] = 'The name you entered is already in use by you';
                }
                if (!User::checkName($name))
                {
                    $errors[] = 'A short name. You need more than 2 characters in the name';
                }
            }
            if (!empty($password) && !empty($password_repeat))
            {
                if (User::checkPasswordStrlen($password))
                {
                    if (User::checkPasswordMatching($password, $password_repeat))
                    {
                        $passwordHash = User::passwordHash($password);
                        if ($passwordHash == false)
                        {
                            $errors[] = 'Error';
                        }
                    } else {
                        $errors[] = 'Passwords do not match';
                    }
                } else {
                    $errors[] = 'Requires a password longer than 8 characters';
                }
            }

            if ($errors == false)
            {
                if (User::editUserData($userId, $name, $passwordHash))
                {
                    $success = 'Update data was successful!';
                } else {
                    $errors[] = 'Error';
                }
            }
        }

        require_once ROOT . '/views/html/cabinet/cabinet/user.php';
        return true;
    }
}