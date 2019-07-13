<?php


interface fileHelpers
{
    public static function fileValidator($file, array $Extensions  ,array $MIMES = null,$isRequired = true,  $isMultiple = false);
    public static function fileStore($file,$path = "files/",$isFilenameRandom = false , $filename = null , $isMultiple = false);
    public static function fileValidateAndStore($file,array $Extensions  ,array $MIMES = null,$isRequired = true,$path = "files/",$isFilenameRandom = false , $filename = null);
}