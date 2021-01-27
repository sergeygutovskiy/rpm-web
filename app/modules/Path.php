<?php

class Path
{
    private static function basePath($path = "")
    {
        return $_SERVER['DOCUMENT_ROOT'] . "/" . $path;
    }

    public static function view($name)
    {
        require_once self::basePath("public/views/" . $name . ".php");
    }

    public static function asset($name)
    {
        require_once self::basePath("public/assets/" . $name);
    }

    public static function js($name)
    {
        require_once self::basePath("public/js/" . $name . ".js");
    }

    public static function css($name)
    {
        require_once self::basePath("public/css/" . $name . ".css");
    }
}