<?php

class Path
{
    private static function basePath($path = "")
    {
        return $_SERVER['DOCUMENT_ROOT'] . "/" . $path;
    }

    public static function view($name, $vars = [])
    {
        require_once self::basePath("public/views/" . $name . ".php");
    }

    public static function template($name)
    {
        require_once self::basePath("public/templates/_" . $name . ".php");
    }

    public static function asset($name)
    {
        echo self::basePath("public/assets/" . $name);
    }

    public static function js($name)
    {
        echo self::basePath("public/js/" . $name . ".js");
    }

    public static function css($name)
    {
        echo "/public/css/" . $name . ".css";
    }
}