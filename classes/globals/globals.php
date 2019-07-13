<?php


class globals implements globalHelpers
{
    public static function toArray($data): array
    {
        return (array)$data;
    }
    public static function toObject($data)
    {
        return (object) $data;
    }
    public static function toString($data): string
    {
        return json_encode($data);
    }
}