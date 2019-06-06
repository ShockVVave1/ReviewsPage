<?php
/**
 * Created by PhpStorm.
 * User: shockvvave
 * Date: 06.06.19
 * Time: 9:05
 */

class ReviewModel
{
    public static function getReviews($page)
    {

        $reviewList = array();
        //Получение соединения с БД
        $db = Db::getConnection();

        $start = ($page-1)*2;

        $reviews = $db->query("SELECT * FROM Reviews ORDER BY date LIMIT $start, 2");
        $reviews->setFetchMode(PDO::FETCH_NUM);
        $i = 0;
        //Сохранение полученных данных
        while ($row = $reviews->fetch()) {
            $reviewList[$i]['id'] = $row['0'];
            $reviewList[$i]['fio'] = $row['1'];
            $reviewList[$i]['subject'] = $row['2'];
            $reviewList[$i]['review'] = $row['3'];
            $reviewList[$i]['img'] = $row['4'];
            $reviewList[$i]['likes'] = $row['5'];
            $reviewList[$i]['date'] = $row['6'];
            $i++;
        }
        //Возвращение результируещего массива
        echo $page;
        return $reviewList;
    }

    public static function getReviewsCount()
    {

        $db = Db::getConnection();

        //Запрос sql в БД
        $count = $db->query('SELECT COUNT(*) FROM Reviews');

        return $count->fetch();
    }
}