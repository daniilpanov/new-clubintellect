<?php
namespace app\classes;

class Creview extends Mreview
{
    // параметры для фильтрации
    private $filter_params = null;

    // возвращение всевозможных параметров для фильтрации
    public function returnValuesForFilter()
    {
        $result['pages'] = $this->getAllPages();
        return $result;
    }

    public function getAllPages()
    {
        $all_pages = Factory::getClassInst("Cpage");
        $pages = $all_pages->print_list($_SESSION['language'], "menu_name, menu_icon, icon_size, id");

        foreach ($pages as $page)
        {
            $result[$page['id']] = "<i class='{$page['menu_icon']} {$page['icon_size']}'></i>&nbsp;" . $page['menu_name'];
        }

        return $result;
    }

    // запись параметров фильтрации в свойство
    public function setFilterParams($params)
    {
        $this->filter_params = $params;
    }

    // возвращаем отзывы
    public function getReviewsFromDB()
    {
        $res = $this->returnReviews($this->filter_params); // запрос к БД
        $reviews = $res->fetchAll();
        return $reviews;
    }

    // добавление отзыва
    public function addReview($review)
    {
        //проверяем не пришел ли отзыв с главной страницы
        if (!$review['page_id'])
        {
            $review['page_id'] = 1;
        }

        $result = parent::addReview($review);

        if (!$result)
        {
            echo "Извините, но в процессе отправки отзыва произошла ошибка.";
        }
        else
        {
            echo $review["autor"] . ", мы получили ваш отзыв и вскоре добавим его.";
        }
    }
}