<?php


class MainController
{
    public function actionIndex ()
    {
        $latestNews = array();
        $latestNews = News::getLatestNews(3);

        $categoryList = array();
        $categoryList = Category::getCategoryList();

        $userId = '';

        if (!User::isGuest())
        {
            $userId = User::checkLogged();
            $userName = User::getUserName($userId);
        }

        $home = true;

        include_once (ROOT . "/views/html/main/index.php");

        return true;
    }
}