<?php


class Admin
{
    /**
     * Checking whether the user is an administrator;
     * Проверка является ли пользователь администратором
     * @return bool
     */
    public static function checkAdmin ()
    {
        $userId = User::checkLogged();
        if(!User::isAdmin($userId))
        {
            header("Location: /");
            return true;
        }
        return false;
    }
}