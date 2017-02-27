<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 26/2/17
 * Time: 7:45 PM
 */
namespace Wpng;
class WpngDb {
    private static $connection = null;
    public static function loadDriver(){
        //phpActiveRecord init
        static::$connection = \QdPhpactiverecords::getCon();
        $tmp_con = static::$connection;
        \ActiveRecord\Config::initialize(function ($cfg) use ($tmp_con) {
            $model_dir = WpngDb::getModelPath();
            $cfg->set_model_directory($model_dir);
            $cfg->set_connections($tmp_con);

            # default connection is now production
            $cfg->set_default_connection('production');
        });
    }
    public static function getModelPath(){
        return (WPNG_PLUGIN_DIR . 'models/db/');
    }
}