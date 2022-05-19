<?php


class Router
{
    private $routes;

    /*
     * Конструктор с подключением файла маршрутов */
    public function __construct ()
    {
        $routesPath = ROOT . '/settings/routes.php';
        $this->routes = include($routesPath);
    }

    /*
     * Получение адресной строки пользователя и подмена слеша для файловой системы */
    private function getURI ()
    {
        if(!empty($_SERVER['REQUEST_URI']))
        {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        return false;
    }

    /*
     * */
    public function begin ()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path)
        {
            if(preg_match("~$uriPattern~", $uri))
            {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $arrayUri = explode("/", $internalRoute);

                /*
                 * Построение наименований имени файла Контроллера и его метода из URI*/
                $controllerName = ucfirst(array_shift($arrayUri)) . 'Controller';
                $actionName = 'action' . ucfirst(array_shift($arrayUri));

                $parameter = $arrayUri;

                $controllerFile = ROOT . '\controllers\\' . $controllerName . '.php';

                /*
                 * Подключение файла с именем класса */
                if (file_exists($controllerFile)) {
                    include_once ($controllerFile);
                } else {
//                    echo 'Класс с именем ' . $controllerName . ' отсутствует.';
                    require_once ROOT . '\views\html\errors\404.php';
                    break;
                }

                $createObject = new $controllerName;
                if (method_exists($createObject, $actionName))
                {
                    $callMethod = call_user_func_array(array($createObject, $actionName), $parameter);
                } else {
//                    echo 'Метод класса ' . $controllerName . ' с именем ' . $actionName . ' отсутствует.';
                    require_once ROOT . '\views\html\errors\404.php';
                    break;
                }


                if ($callMethod != null) {
                    break;
                }
            }
        }
    }
}