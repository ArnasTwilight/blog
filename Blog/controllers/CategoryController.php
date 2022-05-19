<?php


class CategoryController
{
    public function actionView ($id, $page = 1)
    {
        if (!empty($id))
        {
            $userId = '';

            $category = true;

            if (!User::isGuest())
            {
                $userId = User::checkLogged();
                $userName = User::getUserName($userId);
            }

            $categoryList = Category::getCategoryList();
            foreach ($categoryList as $key => $item)
            {
                if ($item['id'] == $id)
                {
                    unset($categoryList[$key]);
                }
            }

            $selectCategory = Category::getCategoryName($id);

            $categoryPost = Category::getSelectCategoryPost($id, $page);

            $countNews = News::getCountNews($id);
            $countNews = intval($countNews);
            $pagination = new Pagination ($countNews, $page, News::getDefaultShow(), 'page-');

            require_once ROOT . '/views/html/post/category_view.php';
            return true;
        }

        return false;
    }
}