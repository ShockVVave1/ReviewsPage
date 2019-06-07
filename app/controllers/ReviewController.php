<?php
/**
 * Created by PhpStorm.
 * User: shockvvave
 * Date: 06.06.19
 * Time: 8:18
 */

class ReviewController
{

    /**
     * @param $params
     * @return mixed
     */
    public static function actionIndex($params)
    {
        //Стартовые переменные
        $page = 1;
        $sortby = 'ASC';
        $postsPerPage = 6;

        //если страница указана запоминаем
        if (!empty($params)) {
            $page = $params[0];
        };

        //не выбран ли тип сортировки
        if (isset($_GET['sortby']) && ($_GET['sortby'] == 'asc' || $_GET['sortby'] == 'desc' || $_GET['sortby'] == 'ASC' || $_GET['sortby'] == 'DESC')) {
            $sortby = $_GET['sortby'];
            unset($_GET['sortby']);
        };

        //не выбрано ли количество записей на страницу
        if (isset($_GET['postsperpage']) && (in_array((int)$_GET['postsperpage'], array(7, 14, 21, 70)))) {
            $postsPerPage = (int)$_GET['postsperpage'] - 1;
            unset($_GET['postsperpage']);
        }

        //если есть неизвестный параметр->404
        if (count($_GET)) {
            die;
        }

        //содержит кол-во записей по максимальному id
        $count = ReviewModel::getMaxId();

        //содержит полученные записи
        $reviews = ReviewModel::getReviews($page, $sortby, $postsPerPage, $count);


        return include ROOT . '/app/views/reviews.php';
    }


    /**
     * Функция добавления 100 миллионов записей в БД
     */
    public static function actionMillione()
    {
        $db = Db::getConnection();

        $time1 = round(microtime(true) * 1000);
        for ($i = 0; $i < 100000; $i++) {
            $db->exec(file_get_contents(ROOT . '/database/insert1000rows'));
        }
        $time2 = round(microtime(true) * 1000);
        echo $time2 - $time1;
    }

}