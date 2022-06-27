<<<<<<< HEAD
<<<<<<< HEAD
<?php

namespace application\libs;

require_once "application/utils/UrlUtils.php";
require_once "application/utils/SessionUtils.php";

class Application
{

    public $controller;
    public $action;
    private static $modelList = [];

    public function __construct()
    {
        $urlPaths = getUrlPaths();
        $controller = isset($urlPaths[0]) && $urlPaths[0] != '' ? $urlPaths[0] : 'board';
        $action = isset($urlPaths[1]) && $urlPaths[1] != '' ? $urlPaths[1] : 'index';

        if (!file_exists('application/controllers/' . $controller . 'Controller.php')) {
            echo "해당 컨트롤러가 존재하지 않습니다.";
            exit();
        }

        if (!in_array($controller, static::$modelList)) {
            $modelName = 'application\models\\' . $controller . 'model';
            static::$modelList[$controller] = new $modelName();
        }

        $controllerName = 'application\controllers\\' . $controller . 'controller';
        $model = static::$modelList[$controller];
        new $controllerName($action, $model);
    }
}
=======
<?php
namespace application\libs;

require_once "application/utils/UrlUtils.php";

class Application{
    
    public $controller;
    public $action;
    private static $modelList = [];

    public function __construct() {        
        $urlPaths = getUrlPaths();
        $controller = isset($urlPaths[0]) && $urlPaths[0] != '' ? $urlPaths[0] : 'board';
        $action = isset($urlPaths[1]) && $urlPaths[1] != '' ? $urlPaths[1] : 'index';

        if (!file_exists('application/controllers/'. $controller .'Controller.php')) {
            echo "해당 컨트롤러가 존재하지 않습니다.";
            exit();
        }

        if(!in_array($controller, static::$modelList)) {
            $modelName = 'application\models\\' . $controller . 'model';
            static::$modelList[$controller] = new $modelName();
        }

        $controllerName = 'application\controllers\\' . $controller . 'controller';                
        $model = static::$modelList[$controller];
        new $controllerName($action, $model);
    }
}
>>>>>>> 86ec8f6d1f4e8fdf3a12de269d97b6b279bc873d
=======
<?php
namespace application\libs;

require_once "application/utils/UrlUtils.php";

class Application{
    
    public $controller;
    public $action;
    private static $modelList = [];

    public function __construct() {        
        $urlPaths = getUrlPaths();
        $controller = isset($urlPaths[0]) && $urlPaths[0] != '' ? $urlPaths[0] : 'board';
        $action = isset($urlPaths[1]) && $urlPaths[1] != '' ? $urlPaths[1] : 'index';

        if (!file_exists('application/controllers/'. $controller .'Controller.php')) {
            echo "해당 컨트롤러가 존재하지 않습니다.";
            exit();
        }

        if(!in_array($controller, static::$modelList)) {
            $modelName = 'application\models\\' . $controller . 'model';
            static::$modelList[$controller] = new $modelName();
        }

        $controllerName = 'application\controllers\\' . $controller . 'controller';                
        $model = static::$modelList[$controller];
        new $controllerName($action, $model);
    }
}
>>>>>>> 86ec8f6d1f4e8fdf3a12de269d97b6b279bc873d
