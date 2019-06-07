<?php
/**
 * Created by PhpStorm.
 * User: shockvvave
 * Date: 06.06.19
 * Time: 9:05
 */

class ReviewModel
{
    /**
     *
     * Функция получегия записей отзывов учитывая постраничный вывод
     * @param $page
     * @param $sortby
     * @param $postsPerPage
     * @param $count
     * @return array
     */
    public static function getReviews($page, $sortby, $postsPerPage, $count)
    {
        //Результирующий массив
        $reviewList = array();
        //Получение соединения с БД
        $db = Db::getConnection();

        //Переменные диапазона индексов текущей страницы
        $start = (($page - 1) * $postsPerPage + 1);
        $end = $start + $postsPerPage;

        //Смотреть записи с конца
        if ($sortby == 'DESC' || $sortby == 'desc') {
            $newEnd = $end;
            $end = $count - $start;
            $start = $count - $newEnd;
        }

        //запрос в БД
        $reviews = $db->query("SELECT * FROM Reviews  WHERE ID BETWEEN $start AND $end ORDER BY ID $sortby;");
        $reviews->setFetchMode(PDO::FETCH_NUM);

        //Сохранение полученных данных
        $i = 0;
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
        return $reviewList;
    }

    /**
     * Получает макс значение id записи пользователя
     * @return bool|PDOStatement
     */
    public static function getMaxId()
    {
        $db = Db::getConnection();

        //Запрос sql в БД
        $max = $db->query('SELECT MAX(id) FROM Reviews');
        $max->setFetchMode(PDO::FETCH_NUM);
        $max = $max->fetch()[0];

        return $max;
    }
}