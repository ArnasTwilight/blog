<?php


class PostController
{
    public function actionView ($postId)
    {
        $post = array();
        $post = Post::getPostById($postId);

        $userId = '';

        $postPage = true;

        if (!User::isGuest())
        {
            $userId = User::checkLogged();
            $userName = User::getUserName($userId);
        }

        require_once ROOT . '/views/html/post/post.php';
        return true;
    }
}