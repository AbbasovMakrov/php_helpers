<?php


class Files implements fileHelpers
{
    public static function fileValidator($file, array $Extensions, array $MIMES = null, $isRequired = true, $isMultiple = false)
    {
        $errors = [];

        if ($isRequired == true)
        {
            if (empty($_FILES[$file]['name']))
            {
                $errors[] = "file is required";
            }
        }
        if ($isMultiple)
        {
           $files = [];

            for ($i = 0 ; $i < count($_FILES[$file]['name']) ; $i++)
            {
                if (!in_array(pathinfo($_FILES[$file]['name'][$i],PATHINFO_EXTENSION),$Extensions))
                {
                    $extintionError = "file must end with : ";
                    foreach ($Extensions as $extension) {
                        $extintionError .= "{$extension} ";
                    }
                    $errors[$_FILES[$file]['name'][$i]] = $extintionError;
                    $files[$_FILES[$file]['name'][$i]] = false;
                }
               else
               {
                   $files[$_FILES[$file]['name'][$i]] = true ;
               }
                if ($MIMES != null)
                {
                    if (!in_array($_FILES[$file]['type'][$i],$MIMES))
                    {
                        $mimeError = "File must have MIMES: ";
                        foreach ($MIMES as $MIME) {
                            $mimeError .= "{$MIME} ";
                        }
                        $errors[$_FILES[$file]['name'][$i]] = $mimeError;
                        $files[$_FILES[$file]['name'][$i]] = false;
                    }
                }
            }
            echo count($errors) > 0 ? globals::toString($errors) : null;
                return globals::toString([
                    'errors' =>  count($errors) > 0 ?  $errors : null,
                    'files' => $files
                ]);
        }
        else
        {
            if (!in_array(pathinfo($_FILES[$file]['name'],PATHINFO_EXTENSION),$Extensions))
            {
                $extintionError = "file must end with : ";
                foreach ($Extensions as $extension) {
                    $extintionError .= "{$extension} ";
                }
                $errors[] = $extintionError;
            }
            if ($MIMES != null)
            {
                if (!in_array($_FILES[$file]['type'],$MIMES))
                {
                    $mimeError = "File must have MIMES: ";
                    foreach ($MIMES as $MIME) {
                        $mimeError .= "{$MIME} ";
                    }
                    $errors[] = $mimeError;
                }
            }
            if (count($errors) > 0)
            {
                foreach ($errors as $error)
                {
                    echo "<p style='color: red'> {$error} </p>";
                }
                return false;
            }
            return true;
        }

    }
    public static function fileValidateAndStore($file, array $Extensions, array $MIMES = null, $isRequired = true, $path = "files/", $isFilenameRandom = false, $filename = null , $isMultiple = false)
    {

     $validation =  static::fileValidator($file,$Extensions,$MIMES,$isRequired,$isMultiple);
     if ($validation == true)
     {
       return  static::fileStore($file,$path,$isFilenameRandom,$filename,$isMultiple);
     }
     return null;

    }
    public static function fileStore($file, $path = "files/", $isFilenameRandom = false, $filename = null, $isMultiple = false)
    {
        if (!file_exists($path))
        {
            mkdir($path);
        }
        if ($isMultiple)
        {
            $files = [];
            for ($i = 0 ; $i < count($_FILES[$file]['name']) ; $i++)
            {
                $fileName = $_FILES[$file]['name'][$i];
                if ($isFilenameRandom)
                {
                    $fileName = stringHelpers::random(20);
                }
                if ($fileName != null)
                {
                    $fileName = $filename;
                }
                if (!stringHelpers::contains("/",$path))
                {
                    $path .= "/";
                }
                if (move_uploaded_file($_FILES[$file]['tmp_name'] ,$path.$filename))
                {
                   $files[] =  $path.$fileName;
                }
            }
            return count($files) > 0 ? globals::toString($files) : null;
        }
        $fileName = $_FILES[$file]['name'];
        if ($isFilenameRandom)
        {
            $fileName = stringHelpers::random(20);
        }
        if ($fileName != null)
        {
            $fileName = $filename;
        }
        if (!stringHelpers::contains("/",$path))
        {
            $path .= "/";
        }
        if (move_uploaded_file($_FILES[$file]['tmp_name'] ,$path.$filename))
        {
            return $path.$fileName;
        }
        return null;
    }
}