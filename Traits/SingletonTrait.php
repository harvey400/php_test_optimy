<?php
/**
 * @author Harvey Tapang <harveytapang@gmail.com>
 */

trait SingletonTrait
{
    protected static array $_instance = array();

    /**
     * Return new or existing instance of the class from which it is called
     * @return mixed
     */
    final public static function getInstance()
    {
        $called_class = get_called_class();

        if ( ! isset( static::$_instance[ $called_class ] ) ) {
            static::$_instance[ $called_class ] = new $called_class();
        }

        return static::$_instance[ $called_class ];
    }
}