<?php
// Автозагрузка классов в каталогах: components и models

function my_autoload ($class_name)
{
    $array_path = array(
        '/components/',
        '/models/',
    );

    foreach ($array_path as $path)
    {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path))
        {
            include_once $path;
        }
    }
}