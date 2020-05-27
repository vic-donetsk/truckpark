<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*
     * возвращает преобразованный в латиницу госномер авто
     */
    public function translit_truck_name($str)
    {
        $tr = array(
            "А"=>"A", "а"=>"a",
            "B"=>"B", "в"=>"b",
            "Е"=>"E", "е"=>"e",
            "К"=>"K", "к"=>"k",
            "М"=>"M", "м"=>"m",
            "Н"=>"H", "н"=>"h",
            "О"=>"O", "о"=>"o",
            "Р"=>"P", "р"=>"p",
            "С"=>"C", "с"=>"c",
            "Т"=>"T", "т"=>"t",
            "Х"=>"X", "х"=>"x",
        );
        return strtoupper(strtr($str,$tr));
    }
}
