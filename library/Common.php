<?php
/**
 * Created by PhpStorm.
 * User: shockvvave
 * Date: 07.06.19
 * Time: 16:34
 */

class Common
{


    public static function getPagination($page, $count, $postsPerPage, $get_mass)
    {

        $tabs = 2;

        $pagination = '';

        $get_query = '';

        if (count($get_mass)) {
            $get_query = '?' . http_build_query($_GET);
        }

        if ($postsPerPage > $count) {
            return "";
        }

        $pages = ceil(($count / $postsPerPage));

        $pagination .= '<div>';
        if ($page - $tabs > 1) {
            $pagination .= "<a href='/" . $get_query . "'><<</a><span>...</span> ";
        }


        if ($page > 3) {
            $start = $page - 2;
        } else {
            $start = 1;
        }

        if ($page < $pages - 2) {
            $end = $page + 2;
        } else {
            $end = $pages;
        }


        /** TODO
         *  else блок можно убрать
         */
        if ($tabs * 2 + 1 < $pages) {
            for ($i = $start; $i <= $end; $i++) {
                if ($i == $page) {
                    $pagination .= "<span>$i</span> ";
                } else {
                    if ($i == 1) {
                        $pagination .= "<a href='/" . $get_query . "'>$i</a> ";
                    } else {
                        $pagination .= "<a href='/page=" . $i . $get_query . "'>$i</a> ";
                    }

                }
            }
        } else {
            for ($i = $start; $i <= $end; $i++) {
                if ($i == $page) {
                    $pagination .= "<span>$i</span> ";
                } else {
                    $pagination .= "<a href='/page=" . $i . $get_query . "'>$i</a> ";
                }
            }
        }


        if ($page + $tabs < $pages) {
            $pagination .= "<span>...</span><a href='/page=" . $pages . $get_query . "'>>></a> ";
        }

        $pagination .= '</div>';
        return $pagination;
    }

    public static function getViewOption($postsPerPageArray, $sortby, $postsPerPage)
    {

        $module = "";

        $module .= "<div><form action='/' >";

        if (isset($postsPerPageArray)) {
            $module .= "<select name='postsperpage'>";
            foreach ($postsPerPageArray as $value) {
                $module .= "<option value='$value'";
                if ($postsPerPage == $value) {
                    $module .= "selected";
                }
                $module .= ">$value</option>";
            }
            $module .= "</select>";
        }

        $module .= "<select name='sortby'>";
        $module .= "<option value='ASC' ";
        if ($sortby == 'DESC') {
            $module .= "selected";
        }
        $module .= ">От новых</option>";
        $module .= "<option value='DESC'";
        if ($sortby == 'DESC') {
            $module .= "selected";
        }
        $module .= ">От старых</option>";
        $module .= "</select>";

        $module .= "<input type='submit' >";
        $module .= "</form></div>";

        return $module;
    }

}