<?php
/**
 * Created by PhpStorm.
 * User: shockvvave
 * Date: 06.06.19
 * Time: 8:18
 */

class ReviewController
{

    public static function actionIndex($params)
    {
        $page = 1;
        is_array($params);
        if (!empty($params)) {
            $page = explode('=', $params[0])[1];
        };
        $reviews = ReviewModel::getReviews($page);
        $count = ReviewModel::getReviewsCount();
        echo '<pre>';
        print_r($count);
        echo '</pre>';
        echo '<pre>';
        print_r($reviews);
        echo '</pre>';
    }

}