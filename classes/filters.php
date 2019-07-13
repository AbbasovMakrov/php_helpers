<?php


class filters
{
    public static function filterAsString($data) : string 
    {
        return filter_var($data,FILTER_SANITIZE_STRING);
    }

    public static function filterAsInteger($data) : int
    {
        return filter_var($data,FILTER_SANITIZE_NUMBER_INT);
    }

    public static function filterAsFloat($data) : float 
    {
        return filter_var($data,FILTER_SANITIZE_NUMBER_FLOAT);
    }

    public static function filterAsEmail($data) : string 
    {
        return filter_var($data,FILTER_SANITIZE_EMAIL);
    }

    public static function filterAsURL($data) : string
    {
        return filter_var($data,FILTER_SANITIZE_URL);
    }
}