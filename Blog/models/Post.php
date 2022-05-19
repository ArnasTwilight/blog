<?php


class Post
{
    /**
     * Getting data post from database;
     * Получение данных поста из БД
     * @param $postId
     * @return false|mixed
     */
    public static function getPostById($postId)
    {
        if (!empty($postId))
        {
            $db = Db::getConnection();

            $sql = 'SELECT * FROM news WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $postId, PDO::PARAM_INT);
            $result->execute();

            $i = 0;
            while ($row = $result->fetch())
            {
                $post[$i]['id'] = $row['id'];

                if ($row['category'])
                {
                    $sqlTwo = ('SELECT category FROM category WHERE id = :id');

                    $result = $db->prepare($sqlTwo);
                    $result->bindParam(':id', $row['category'], PDO::PARAM_INT);
                    $result->execute();
                    $news = $result->fetch(PDO::FETCH_ASSOC);

                    $post[$i]['category'] = '#' . $news['category'];
                }

                $post[$i]['category_id'] = $row['category'];
                $post[$i]['title'] = $row['title'];
                $post[$i]['date_post'] = $row['date_post'];
                $post[$i]['short_content'] = $row['short_content'];
                $post[$i]['content'] = $row['content'];

                $i++;
            }

            return $post['0'];
        }
        return false;
    }
}