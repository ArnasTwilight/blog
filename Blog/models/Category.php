<?php


class Category
{
    private const SHOW_BY_DEFAULT_CATEGORY_LIST = 15;

    /**
     * Returns data from the 'category' database;
     * '#' . ['category'];
     * Возвращает данные из БД 'category'
     * @return array
     */
    public static function getCategoryList ($page = 1, $count = self::SHOW_BY_DEFAULT_CATEGORY_LIST)
    {
        $categoryList = array();

        $db = Db::getConnection();

        $page = intval($page);
        $offset = ($page - 1) * $count;

        $sql = $db->query('SELECT id, category FROM category ORDER BY id DESC LIMIT ' . $count . ' OFFSET ' . $offset);

        $i = 0;
        while ($row = $sql->fetch())
        {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['category'] = '#' . $row['category'];
            $i++;
        }

        return $categoryList;
    }
    /**
     * Returns the name "'#' . category" from the DB;
     * Возвращает наименование "'#' . категории" из БД
     * @param $categoryId
     * @return false|string
     */
    public static function getCategoryName ($categoryId)
    {
        if (!empty($categoryId))
        {
            $db = Db::getConnection();

            $sql = 'SELECT category FROM category WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $categoryId, PDO::PARAM_INT);
            $result->execute();
            $categoryName = $result->fetch(PDO::FETCH_ASSOC);

            $categoryName['category'] = '#' . $categoryName['category'];

            return $categoryName['category'];
        }
        return false;
    }
    /**
     * Returning posts by category;
     * Возвращение постов по категории
     * @param $category
     * @return array|false
     */
    public static function getSelectCategoryPost($category, $page = 1)
    {
        if (!empty($category))
        {
            $categoryPost = array();

            $db = Db::getConnection();

            $page = intval($page);
            $offset = ($page - 1) * News::getDefaultShow();

            $sql = $db->query('SELECT id, category, title, date_post, short_content FROM news'
                . ' WHERE category = ' . $category
                . ' ORDER BY id DESC '
                . 'LIMIT ' . News::getDefaultShow()
                . ' OFFSET ' . $offset);

            $i = 0;
            while ($row = $sql->fetch())
            {
                $categoryPost[$i]['id'] = $row['id'];

                if ($row['category'])
                {
                    $sqlTwo = ('SELECT category FROM category WHERE id = :id');

                    $result = $db->prepare($sqlTwo);
                    $result->bindParam(':id', $row['category'], PDO::PARAM_INT);
                    $result->execute();
                    $news = $result->fetch(PDO::FETCH_ASSOC);

                    $categoryPost[$i]['category'] = '#' . $news['category'];
                }

                $categoryPost[$i]['title'] = $row['title'];
                $categoryPost[$i]['date_post'] = $row['date_post'];
                $categoryPost[$i]['short_content'] = $row['short_content'];

                $i++;
            }

            return $categoryPost;
        }

        return false;
    }

    /**
     * Returns id category from DB 'category';
     * Возвращает ID категории из БД 'category'
     * @param $category
     * @return false|mixed
     */
    public static function getCategoryId ($category)
    {
        if (!empty($category))
        {
            if (!strpos($category, '#'))
            {
                $category = ltrim($category, "#");
            }

            $db = Db::getConnection();

            $sql = 'SELECT id FROM category WHERE category = :category';

            $result = $db->prepare($sql);
            $result->bindParam(':category', $category, PDO::PARAM_STR);
            $result->execute();
            $idCategory = $result->fetch(PDO::FETCH_ASSOC);

            return $idCategory ['id'];
        }
        return false;
    }

    /**
     * Creating a new category;
     * Создание новой категории
     * @param $name
     * @return bool
     */
    public static function addCategory ($name)
    {
        if (!empty($name))
        {
            if ($name{0} !== strtoupper($name{0}))
            {
                $name = ucfirst($name);
            }

            $db = Db::getConnection();

            $sql = 'INSERT INTO category (category) VALUES (:category)';

            $result = $db->prepare($sql);
            $result->bindParam(':category',$name, PDO::PARAM_STR);

            return $result->execute();
        }
        return false;
    }
    /**
     * Update category;
     * Обновление категории в БД 'category'
     * @param $id
     * @param $categoryName
     * @return bool
     */
    public static function editCategory ($id, $categoryName)
    {
        if (!empty($id) && !empty($categoryName))
        {
            if ($categoryName{0} !== strtoupper($categoryName{0}))
            {
                $categoryName = ucfirst($categoryName);
            }

            $db = Db::getConnection();

            $sql = 'UPDATE category SET category = :category WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':category', $categoryName, PDO::PARAM_STR);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            return $result->execute();
        }
        return false;
    }
    /**
     * Delete category by id;
     * Удаление категории по id;
     * @param $id
     * @return bool
     */
    public static function deleteCategory ($id)
    {
        if (!empty($id))
        {
            $db = Db::getConnection();

            $sql = 'DELETE FROM category WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            return $result->execute();
        }
    }

    /**
     * Returns the number of category;
     * Возвращает количество категорий
     * @return mixed
     */
    public static function getCountCategory ()
    {
        $db = Db::getConnection();

        $sql = ('SELECT count(id) FROM category');

        $result = $db->prepare($sql);
        $result->execute();
        $count = $result->fetch(PDO::FETCH_ASSOC);

        return $count['count(id)'];
    }

    /**
     * Checking for and setting a capital letter;
     * Проверка на заглавную букву и её установка
     * @param $string
     * @return false|string
     */
    public static function checkCapital ($string)
    {
        if (!empty($string))
        {
            if ($string{0} !== strtoupper($string{0}))
            {
                $string = ucfirst($string);
                return $string;
            }
            return $string;
        }
        return false;
    }

    /**
     * Return value from const SHOW_BY_DEFAULT_CATEGORY_LIST;
     * Возвращает значение из константы SHOW_BY_DEFAULT_CATEGORY_LIST
     * @return int
     */
    public static function getDefaultShowCategoryList ()
    {
        return $value = self::SHOW_BY_DEFAULT_CATEGORY_LIST;
    }
}