<?php


function getFunctionJS($funcName) {

    $dir = HOST_ROOT_FULL."/BASEV2/javascript/functions/";

    if($funcName == "ajax") {

        /* Functions Ajax Javascript */
        echo '<script src="'.$dir.'ajax-functions.js"> </script>';

    }
    else { echo "getPluginJS - Error Name Plugin."; }

}

function getPluginJS($pluginName) {

    $dir = HOST_ROOT_FULL."/BASEV2/javascript/plugins/".$pluginName."/";

    if($pluginName == "Jquery") {

        /* Jquery 1.11.2 */
        include_JS($dir."jquery-1.11.2.min.js");

    }

    else if($pluginName == "JqueryTE") {

        include_CSS($dir."jquery-te-1.4.0.css");
        include_JS($dir."jquery-te-1.4.0.min.js");

    }

    else if($pluginName == "JqueryUI") {

        include_CSS($dir."jquery-ui.css");
        include_JS($dir."jquery-ui.js");

    }

    else if($pluginName == "Chosen") {

        include_CSS($dir."chosen.css");
        include_JS($dir."chosen.jquery.js");

    }

    else if($pluginName == "BootStrap") {

        include_CSS($dir."css/bootstrap.min.css");
        include_CSS($dir."css/bootstrap-theme.min.css");
        include_JS($dir."js/bootstrap.min.js");

    }

    else if($pluginName == "Mask") {

        include_JS($dir."jquery.mask.min.js");

    }


    else { echo "getPluginJS - Error Name Plugin."; }

}

