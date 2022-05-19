<?php


class News
{
    private const SHOW_BY_DEFAULT_NEWS = 3;
    private const LENGTH_SHORT_CONTENT_TABLE = 60;
    private const SHOW_BY_DEFAULT_NEWS_LIST = 10;

    /**
     * Output the last posts in a given amount;
     * Вывод последних постов в переданном или заданном количестве;
     * @param int $count
     * @return array
     */
    public static function getLatestNews ($count = self::SHOW_BY_DEFAULT_NEWS)
    {
        $count = intval($count);
        $db = Db::getConnection();

        $latestNews = array();

        $sql = $db->query('SELECT id, category, title, date_post, short_content FROM news '
                . 'ORDER BY id DESC '
                . 'LIMIT ' . $count);

        $i = 0;
        while ($row = $sql->fetch())
        {
            $latestNews[$i]['id'] = $row['id'];

            if ($row['category'])
            {
                $sqlTwo = ('SELECT category FROM category WHERE id = :id');

                $result = $db->prepare($sqlTwo);
                $result->bindParam(':id', $row['category'], PDO::PARAM_INT);
                $result->execute();
                $news = $result->fetch(PDO::FETCH_ASSOC);

                $latestNews[$i]['category'] = '#' . $news['category'];
            }
            $latestNews[$i]['category_id'] = $row['category'];
            $latestNews[$i]['title'] = $row['title'];
            $latestNews[$i]['date_post'] = $row['date_post'];
            $latestNews[$i]['short_content'] = $row['short_content'];

            $i++;
        }
        return $latestNews;
    }

    /**
     * Adds post to the database;
     * Добавляет новую запись в БД
     * @param $category
     * @param $title
     * @param $short_content
     * @param $content
     * @return bool
     */
    public static function addNews ($category, $title, $short_content, $content)
    {
        if (!empty($category) && !empty($title) && !empty($short_content) && !empty($content))
        {
            $db = Db::getConnection();

            $sql = 'INSERT INTO news (category, title, short_content, content)' .
                'VALUES (:category, :title, :short_content, :content)';

            $result = $db->prepare($sql);
            $result->bindParam(':category',$category, PDO::PARAM_INT);
            $result->bindParam(':title',$title, PDO::PARAM_STR);
            $result->bindParam(':short_content',$short_content, PDO::PARAM_STR);
            $result->bindParam(':content',$content,PDO::PARAM_STR);

            return $result->execute();
        }
        return false;
    }
    /**
     * Return list from DB 'news';
     * Возвращает список из БД 'news'
     * @return array
     */
    public static function getNews ($page = 1, $count = self::SHOW_BY_DEFAULT_NEWS_LIST)
    {
        $db = Db::getConnection();

        $page = intval($page);
        $offset = ($page - 1) * $count;

        $sql = $db->query('SELECT * FROM news ORDER BY date_post DESC LIMIT ' . $count . ' OFFSET ' . $offset);

        $i = 0;
        while ($row = $sql->fetch()){
            $listPost[$i]['id'] = $row['id'];

            if ($row['category'])
            {
                $sqlTwo = ('SELECT category FROM category WHERE id = :id');

                $result = $db->prepare($sqlTwo);
                $result->bindParam(':id', $row['category'], PDO::PARAM_INT);
                $result->execute();
                $news = $result->fetch(PDO::FETCH_ASSOC);

                $listPost[$i]['category'] = '#' . $news['category'];
            }

            $listPost[$i]['title'] = $row['title'];
            $listPost[$i]['date_post'] = $row['date_post'];
            $listPost[$i]['short_content'] = $row['short_content'];

            if (strlen($listPost[$i]['short_content']) > self::LENGTH_SHORT_CONTENT_TABLE )
            {
                $listPost[$i]['short_content'] = substr($listPost[$i]['short_content'], 0 , self::LENGTH_SHORT_CONTENT_TABLE) . ' &#8230';
            }

            $listPost[$i]['is_new'] = $row['is_new'];

            $i++;
        }
        return $listPost;
    }
    /**
     * Update post in database 'news';
     * Обновление поста в БД 'news'
     * @param $title
     * @param $category
     * @param $short_content
     * @param $content
     * @return bool
     */
    public static function editNews ($title, $category, $short_content, $content, $id)
    {
        if (!empty($title) && !empty($category) && !empty($short_content) && !empty($content))
        {
            $db = Db::getConnection();


            $sql = ('SELECT id FROM category WHERE category = :category');

            $result = $db->prepare($sql);
            $result->bindParam(':category', $category, PDO::PARAM_STR);
            $result->execute();
            $category = $result->fetch(PDO::FETCH_ASSOC);


            $sql = 'UPDATE news SET title = :title,'
                . ' category = :category,'
                . ' short_content = :short_content,'
                . ' content = :content WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':title', $title, PDO::PARAM_STR);
            $result->bindParam(':category', $category['id'], PDO::PARAM_INT);
            $result->bindParam(':short_content', $short_content, PDO::PARAM_STR);
            $result->bindParam(':content', $content, PDO::PARAM_STR);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            return $result->execute();
        }
        return false;
    }
    /**
     * Delete post from DB 'news';
     * Удаление записи из БД 'news' по $id
     * @param $id
     * @return bool
     */
    public static function deleteNews ($id)
    {
        if (!empty($id))
        {
            $db = Db::getConnection();

            $sql = 'DELETE FROM news WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            return $result->execute();
        }
        return false;
    }

    /**
     * Get post from DB 'news' by $id;
     * Получение одной записи из БД по $id
     * @param $id
     * @return false|mixed
     */
    public static function getOneNews ($id)
    {
        if (!empty($id))
        {
            $db = Db::getConnection();

            $sql = 'SELECT * FROM news WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();
            $news = $result->fetch(PDO::FETCH_ASSOC);

            return $news;
        }
        return false;
    }
    /**
     * Returns the number of posts of the selected category or the total number of posts;
     * Возвращает количество постов выбранной категории или общее количество постов;
     * @param $category
     * @return false|mixed
     */
    public static function getCountNews ($category = null)
    {
        if (!empty($category))
        {
            $db = Db::getConnection();

            $result = $db->query('SELECT count(id) AS count FROM news WHERE category = ' . $category
                 . ' ORDER BY id DESC');
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $count = $result->fetch();

            return $count['count'];
        } else {
            $db = Db::getConnection();

            $sql = ('SELECT count(id) FROM news');

            $result = $db->prepare($sql);
            $result->execute();
            $count = $result->fetch(PDO::FETCH_ASSOC);

            return $count['count(id)'];
        }
    }
    /**
     * Return value from const SHOW_BY_DEFAULT_NEWS;
     * Возвращает значение из константы SHOW_BY_DEFAULT_NEWS
     * @return int
     */
    public static function getDefaultShow ()
    {
        return $value = self::SHOW_BY_DEFAULT_NEWS;
    }

    /**
     * Return value from const SHOW_BY_DEFAULT_NEWS_LIST;
     * Возвращает значение из константы SHOW_BY_DEFAULT_NEWS_LIST
     * @return int
     */
    public static function getDefaultShowList ()
    {
        return $value = self::SHOW_BY_DEFAULT_NEWS_LIST;
    }
}