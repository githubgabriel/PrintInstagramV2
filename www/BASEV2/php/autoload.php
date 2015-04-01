<?php
namespace base;
function load($namespace) {
    $splitpath = explode('\\', $namespace);
    $path = '';
    $name = '';
    $firstword = true;
    for ($i = 0; $i < count($splitpath); $i++) {
        if ($splitpath[$i] && !$firstword) {
            if ($i == count($splitpath) - 1)
                $name = $splitpath[$i];
            else
                $path .= DIRECTORY_SEPARATOR . $splitpath[$i];
        }
        if ($splitpath[$i] && $firstword) {
            if ($splitpath[$i] != __NAMESPACE__)
                break;
            $firstword = false;
        }
    }
    if (!$firstword) {
        $fullpath = __DIR__ ."/".AUTOLOAD_DIR_CLASS.$path . DIRECTORY_SEPARATOR . $name . '.php';
        //die($fullpath);
        return include_once($fullpath);
    }
    return false;
}

function loadPath($absPath) {
    return include_once($absPath);
}
spl_autoload_register(__NAMESPACE__ . '\load');
?>