<?php

namespace app\classes;

class Upload
{

    public static function validate($file)
    {
        if ($file['size'] > (MAX_UPLOAD_SIZE * 1024 * 1024)) {
            ///é grande de mais para subir para o server;
            return false;
        }

        $mimeType = mime_content_type($file['tmp_name']);

        if (!in_array($mimeType, MIME_TYPE_UPLOAD)) {
            return false;
        }

        return true;
    }

    public static function upload($file)
    {
        $name = $file['name'];

        $name = strtolower($name);

        $name = str_replace(' ', '', $name);

        $name = str_replace(
            ['--', ',', '(', ')', '[', ']', '*', '+', '&', '%'],
            '-',
            $name
        );
        
        $name = uniqid() . $name;

        $path = IMAGE_PATH . $name;

        if (!move_uploaded_file($file['tmp_name'], $path))
            return 'error';

        return $name;
    }
}
