<?php


class stringHelpers implements strings
{
    public static function random(int $length = 20, bool $containCapitals = true , bool $containNumbers = true)
    {
        $stringChars = array_merge(range('a','z'),$containCapitals == true ? range('A','Z') : range('a','z') , $containNumbers == true ? range(1,9) : range('a','z'));
        $string = '';
        for ($i = 1 ; $i <= $length ; $i++)
        {
            $string .= $stringChars[array_rand($stringChars)];
        }
        return $string;
    }

    public static function contains(string $needle, string $haystack): bool
    {
        return strpos($haystack,$needle);
    }
    public static function toLower(string $string): string
    {
        return strtolower($string);
    }
    public static function toUpper(string $string): string
    {
        return strtoupper($string);
    }
}