<?php
namespace app\classes;


class Mreview
{
    protected function filtered($col, $val)
    {

    }
    
    protected function returnReviews($filter_values)
    {
        $filter_values['language'] = $_SESSION['language'];

        $res = Db::getInstance()
            ->read("reviews", "*", $filter_values);
        return $res;
    }

    protected function addReview($review)
    {
        $res = Db::getInstance()->create("reviews", $review, true); // выполняем запрос
        return $res;
    }

    protected function updateReview($data)
    {
        
    }

    protected function deleteReview($id)
    {
        
    }
    
}