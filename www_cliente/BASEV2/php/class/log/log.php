<?php
namespace base\log;
class log {
    static function logJs($text) {
        echo '<script> console.log("'.$text.'"); </script>';
    }
}
