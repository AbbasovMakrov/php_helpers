<?php


interface strings
{
    public static function random(int $length = 20 ,bool $containCapitals = true , bool $containNumbers = true);
    public static function contains(string $needle ,string $haystack) : bool ;
    public static function toLower(string $string) : string ;
    public static function toUpper(string $string) : string ;
}