<?php


class UserController
{
    public static function actionRegister ()
    {
        if (!empty($_SESSION['user'])) {
            header("Location: /");
        }

        $name = '';
        $email = '';
        $password = '';

        $errors = '';

        $register = true;

        if (isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_repeat = $_POST['password_repeat'];

            $errors = false;

            if (!User::checkName($name))
            {
                $errors[] = 'A short name. You need 2 or more characters in the name';
            }
            if (!User::checkUniquenessName($name))
            {
                $errors[] = 'This name is already in use';
            }
            if (!User::checkEmail($email))
            {
                $errors[] = 'Invalid e-mail';
            }
            if (!User::checkUniquenessEmail($email))
            {
                $errors[] = 'This email is already in use';
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
                            $errors [] = 'Error';
                        }
                    } else {
                        $errors[] = 'Passwords do not match';
                    }
                } else {
                    $errors[] = 'Requires a password longer than 8 characters';
                }
            } else {
                $errors[] = 'The password field is blank';
            }

            if ($errors == false)
            {
                if (User::registerUser($name, $email, $passwordHash))
                {
                    $success = 'Registration was successful!';
                } else {
                    $errors[] = 'Error';
                }
            }
        }

        require_once (ROOT . '/views/html/user/register.php');
        return true;
    }
    public static function actionLogin ()
    {

        if (!empty($_SESSION['user'])) {
            header("Location: /");
        }

        $email = '';
        $password = '';

        $errors = '';

        $login = true;

        if (isset($_POST['submit']))
        {
           $email = $_POST['email'];
           $password = $_POST['password'];

           $errors = false;

           if (!empty($email) && !empty($password))
           {
               if (!User::checkEmail($email))
               {
                   $errors[] = 'Invalid email. Check if the input is correct';
               }

               $id = User::getUserId($email);
               if ($id == false)
               {
                   $errors[] = 'Wrong password or email';
               }
               elseif (User::checkPasswordStrlen($password))
               {
                   if (!User::passwordVerify($password, $email))
                   {
                       $errors[] = 'Wrong password or email';
                   }
               } else {
                   $errors[] = 'Requires a password longer than 8 characters';
               }
           } else {
               $errors[] = 'Fill in all fields';
           }

           if ($errors == false)
           {
               User::UserIdRecord($id);

               if (User::isAdmin($id))
               {
                   header("Location: /admin");

                   return true;
               }
               header("Location: /cabinet/");
           }
        }

        require_once (ROOT . '/views/html/user/login.php');
        return true;
    }
    public static function actionLogout ()
    {
        unset($_SESSION["user"]);

        header("Location: /");
    }
}