<?php
namespace App\Helpers;

class Helper
{
    public static function letter($index)
    {
        $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N'];
        return $letters[$index];
    }
}