<?php


class Db
{
    public static function getConnection ()
    {
        $paramsPath = ROOT . '/settings/database.php';
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        return $db;
    }
}