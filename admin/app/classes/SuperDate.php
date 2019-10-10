<?php
namespace app\classes;

class SuperDate extends \DateTime
{
    private $month = array(
        1 => "января",
        2 => "февраля",
        3 => "марта",
        4 => "апреля",
        5 => "мая",
        6 => "июня",
        7 => "июля",
        8 => "августа",
        9 => "сентября",
        10 => "октября",
        11 => "ноября",
        12 => "декабря"
    );
					
    private $day = array(
        0 => "воскресенье",
        1 => "понедельник",
        2 => "вторник",
        3 => "среда",
        4 => "четверг",
        5 => "пятница",
        6 => "суббота"
    );
                
    public function __construct($timezone = null)
    {
        parent::__construct('now', $timezone);
    }

    public function getSuperFormattedTime()
    {
        echo 'Сегодня ' . $this->format("j") . " "
            . $this->month[$this->format("n")] . " "
            . $this->format("Y") . " года, "
            . $this->day[$this->format("w")];
    }
}