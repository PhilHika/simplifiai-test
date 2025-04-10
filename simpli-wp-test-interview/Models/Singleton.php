<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 07/05/18
 * Time: 10:38
 */
namespace SimpliCeremonyStreamingPlugin\Models;

class Singleton {
    public static $instance = array();


    public static function getInstance(){
        $class = get_called_class();
        if( ! isset(self::$instance[ $class ]) || ! self::$instance[ $class ] instanceof $class){
            self::$instance[ $class ] = new static();
        }

        return static::$instance[ $class ];
    }
}