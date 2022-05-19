<?php


class AdminController
{
    private const CLASS_ACTIVE_LINK = 'active';

    public static function actionMain ()
    {
        Admin::checkAdmin();

        $categoryList = Category::getCategoryList();

        $newPost = true;
        $linkHere = self::CLASS_ACTIVE_LINK;

        if (isset($_POST['submit']))
        {
            $title = $_POST['title'];
            $short_content = $_POST['short_content'];
            $content = $_POST['content'];
            $category = $_POST['select_category'];

            $content = nl2br($content);
            $errors = false;

            if (!empty($category))
            {
                $categoryId = Category::getCategoryId($category);

            } else {
                $errors[] = 'The "Category" field cannot be empty';
            }

            if (empty($title))
            {
                $errors[] = 'The "Title" field cannot be empty';
            }

            if (empty($content))
            {
                $errors[] = 'The "Content" field cannot be empty';
            } else {
                if (empty($short_content))
                {
                    $short_content = substr($content, 0, 255);
                }
            }

            if ($errors == false)
            {
                if (News::addNews($categoryId, $title, $short_content, $content))
                {
                    $success = 'Success!';
                } else {
                    $errors[] = 'Error';
                }
            }
        }

        require_once ROOT . '/views/html/cabinet/admin/admin.php';
        return true;
    }

    public static function actionList ($page = 1)
    {
        Admin::checkAdmin();

        $list = array();
        $list = News::getNews($page);

        $listPost = true;
        $linkHere = self::CLASS_ACTIVE_LINK;

        $countNews = News::getCountNews();
        $countNews = intval($countNews);
        $pagination = new Pagination ($countNews, $page, News::getDefaultShowList(), 'page-');



        require_once ROOT . '/views/html/cabinet/admin/list.php';
        return true;
    }
    public static function actionEdit ($id)
    {
        Admin::checkAdmin();

        $numPost = $id;

        if (!empty($id))
        {
            $editPost = true;
            $linkHere = self::CLASS_ACTIVE_LINK;

            $post = array();

            $post = News::getOneNews($id);
            $post['category'] = Category::getCategoryName($post['category']);

            $categoryList = Category::getCategoryList();

            foreach ($categoryList as $key => $item)
            {
                if ($item['category'] == $post['category'])
                {
                    array_unshift($categoryList, $categoryList[$key]);
                    unset($categoryList[$key + 1]);
                }
            }

            $check = true;

            if (isset($_POST['submit']))
            {
                $title = $_POST['title'];
                $category = ltrim($_POST['category'], '#');
                $short_content = $_POST['short_content'];
                $content = $_POST['content'];

                $errors = false;

                if (empty($title))
                {
                    $errors[] = 'The "Title" field cannot be empty';
                }

                if (empty($content))
                {
                    $errors[] = 'The "Content" field cannot be empty';
                } else {
                    if (empty($short_content))
                    {
                        $short_content = substr($content, 0, 255);
                    }
                    $content = nl2br($content);
                }

                if ($errors == false)
                {
                    $result = News::editNews($title, $category, $short_content, $content, $id);
                    if ($result == false)
                    {
                        $errors[] = 'Error';
                    }
                }
            }

            require_once ROOT . '/views/html/cabinet/admin/edit.php';
            return true;
        }
        return false;
    }
    public static function actionDelete ($id)
    {
        Admin::checkAdmin();

        if (!empty($id))
        {
            $errors = false;

            if (!News::deleteNews($id))
            {
                $errors[] = 'Error delete';
            }

            header ("Location: /admin/list");
            return true;
        }
        return false;
    }

    public static function actionCategory ()
    {
        Admin::checkAdmin();

        $categoryList = Category::getCategoryList();

        $newCategory = true;
        $linkHere = self::CLASS_ACTIVE_LINK;

        if (isset($_POST['submit']))
        {
            $name = $_POST['name_category'];

            $errors = false;

            if (!empty($name))
            {
                $nameCheck = strpos($name, '#');
                if ($nameCheck !== false)
                {
                    $name = ltrim($name, '#');
                }

                $name = Category::checkCapital($name);
                if ($name == false)
                {
                    $errors[] = 'Error';
                }

                foreach ($categoryList as $item)
                {
                    $item['category'] = ltrim($item['category'], '#');
                    if ($name === $item['category'])
                    {
                        $errors[] = 'This name already use in: ID ' . $item['id'] . ' #' . $item['category'];
                        break;
                    }
                }

                if ($errors == false)
                {
                    if(Category::addCategory($name))
                    {
                        $success = 'Success!';
                    } else {
                        $errors[] = 'Error';
                }
//                    header ("Location: /admin/category");
                }

            } else {
                $errors[] = 'The field cannot be empty';
            }
        }
        require_once ROOT . '/views/html/cabinet/admin/category.php';
        return true;
    }

    public static function actionCategories ($page = 1)
    {
        Admin::checkAdmin();

        $categories = array();
        $categories = Category::getCategoryList($page);

        $countCategories = Category::getCountCategory();
        $countCategories = intval($countCategories);

        $listCategories = true;
        $linkHere = self::CLASS_ACTIVE_LINK;

        $pagination = new Pagination ($countCategories, $page, Category::getDefaultShowCategoryList(), 'page-');

        require_once ROOT . '/views/html/cabinet/admin/categories.php';
        return true;
    }
    public static function actionCategories_edit ($id)
    {
        Admin::checkAdmin();

        if (!empty ($id))
        {
            $editCategory = true;
            $linkHere = self::CLASS_ACTIVE_LINK;

            $categoryList = Category::getCategoryList();

            $category = Category::getCategoryName($id);
            $category = ltrim($category, "#");


            if (isset($_POST['submit']))
            {
                $categoryName = $_POST['name_category'];

                $errors = false;

                if (empty($categoryName))
                {
                    $errors[] = 'The field cannot be empty!';
                }

                $categoryName = Category::checkCapital($categoryName);
                if ($categoryName == false)
                {
                    $errors[] = 'Error';
                }

                if ($categoryName === $category)
                {
                    $errors[] = 'This category name is already set';
                } else {
                    foreach ($categoryList as $item)
                    {
                        $item['category'] = ltrim($item['category'], '#');
                        if ($categoryName === $item['category'])
                        {
                            $errors[] = 'This name already use in: ID ' . $item['id'] . ' #' . $item['category'];
                            break;
                        }
                    }
                }

                if ($errors == false)
                {
                    if (!Category::editCategory($id, $categoryName))
                    {
                        $errors[] = 'Error edit category';
                    }
                    $success = 'Success!';
//                    header ("Location: /admin/categories/edit/" . $id);
                }
            }

            require_once ROOT . '/views/html/cabinet/admin/categories_edit.php';
            return true;
        }
        return false;
    }
    public static function actionCategories_delete ($id)
    {
        Admin::checkAdmin();

        if (!empty ($id))
        {
            $errors = false;

            if (!Category::deleteCategory($id))
            {
                $errors[] = 'Error delete category';
            }

            header ("Location: /admin/categories");
            return true;
        }

        return false;
    }
}