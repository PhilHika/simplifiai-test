<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 20/07/18
 * Time: 12:00
 */

namespace SimpliCeremonyStreamingPlugin;
class Autoloader {
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($class){

        if(false === strpos($class, __NAMESPACE__)){
            return;
        }

        $class = str_replace('\\', '/', $class);

        $class = str_replace(__NAMESPACE__, plugin_dir_path(__FILE__), $class);
        /*
         * If we are autoloading a widgets, we need to specify the folder
         *because namespace path is not the same : ex: ListObituaryWidgets/ListObituaryWidgets.php
        */
        if(strpos($class, "Widgets")){
            $class_explode = explode("/", $class);
            $className = end($class_explode);
            $class = $class . "/" . $className;
        }
        require_once $class . '.php';
    }
}
