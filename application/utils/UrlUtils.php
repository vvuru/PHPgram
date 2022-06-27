<?php
<<<<<<< HEAD
<<<<<<< HEAD
function getParam($key)
{
    return isset($_GET[$key]) ? $_GET[$key] : "";
}

function getUrl()
{
    return isset($_GET['url']) ? rtrim($_GET['url'], '/') : "";
}
function getUrlPaths()
{
    $getUrl = getUrl();
    return $getUrl !== "" ? explode('/', $getUrl) : "";
}

function getMethod()
{
    // $headers = getallheaders();
    // return $headers['Accept'];
    return $_SERVER['REQUEST_METHOD'];
}

function isGetOne()
{
    $urlPaths = getUrlPaths();
    if (isset($urlPaths[2])) { //one
        return $urlPaths[2];
    }
    return false;
}
=======
=======
>>>>>>> 86ec8f6d1f4e8fdf3a12de269d97b6b279bc873d
    function getUrlPaths() {
        $getUrl = '';
        if (isset($_GET['url'])) {
            $getUrl = rtrim($_GET['url'], '/');
            $getUrl = filter_var($getUrl, FILTER_SANITIZE_URL);
        }
        return explode('/', $getUrl);
    }

    function getMethod() {
        $headers = getallheaders();
        return $headers['Accept'];
    }

    function isGetOne() {
        $urlPaths = getUrlPaths();
        if(isset($urlPaths[2])) { //one
            return $urlPaths[2];
        }
        return false;
    }
<<<<<<< HEAD
>>>>>>> 86ec8f6d1f4e8fdf3a12de269d97b6b279bc873d
=======
>>>>>>> 86ec8f6d1f4e8fdf3a12de269d97b6b279bc873d
