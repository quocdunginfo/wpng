<?php

class QdObjectTask extends QdRoot
{
    static $table_name = 'mpd_object_task';
    public static $LAYER_FW = 'FW';
    public static $LAYER_APP = 'APP';
    public static $LAYER_THEME = 'THEME';
    public static $LAYER_DB = 'DB';
    public static $LAYER_OTHER = 'OTHER';

    public static $ACTION_CREATE = 'CREATE';
    public static $ACTION_MODIFY = 'MODIFY';
    public static $ACTION_REMOVE = 'REMOVE';
    public static $ACTION_OTHER = 'OTHER';

    public static $OBJECT_TYPE_MODEL = 'MODEL';
    public static $OBJECT_TYPE_PAGE = 'PAGE';
    public static $OBJECT_TYPE_DATAPORT = 'DATAPORT';
    public static $OBJECT_TYPE_LAYOUT = 'LAYOUT';
    public static $OBJECT_TYPE_MENU = 'MENU';
    public static $OBJECT_TYPE_TABLE = 'TABLE';
    public static $OBJECT_TYPE_COLUMN = 'COLUMN';
    public static $OBJECT_TYPE_OTHER = 'OTHER';


    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'description' => array(
                'DataType' => 'WYSIWYG',
            ),
            'compatible' => array(
                'DataType' => 'Boolean',
            ),
            'object_type' => array(
                'Caption' => array('en-US' => 'Object Type', 'vi-VN' => 'Object Type'),
                'DataType' => 'Option',
                'Options' => array(
                    static::$OBJECT_TYPE_MODEL => array(
                        'Caption' => array('en-US' => 'Model', 'vi-VN' => 'Model'),
                    ),
                    static::$OBJECT_TYPE_PAGE => array(
                        'Caption' => array('en-US' => 'Page', 'vi-VN' => 'Page'),
                    ),
                    static::$OBJECT_TYPE_DATAPORT => array(
                        'Caption' => array('en-US' => 'Dataport', 'vi-VN' => 'Dataport'),
                    ),
                    static::$OBJECT_TYPE_LAYOUT => array(
                        'Caption' => array('en-US' => 'Layout', 'vi-VN' => 'Layout'),
                    ),
                    static::$OBJECT_TYPE_MENU => array(
                        'Caption' => array('en-US' => 'menu', 'vi-VN' => 'Menu'),
                    ),
                    static::$OBJECT_TYPE_TABLE => array(
                        'Caption' => array('en-US' => 'Table', 'vi-VN' => 'Table'),
                    ),
                    static::$OBJECT_TYPE_COLUMN => array(
                        'Caption' => array('en-US' => 'Column', 'vi-VN' => 'Column'),
                    ),
                    static::$OBJECT_TYPE_OTHER => array(
                        'Caption' => array('en-US' => 'Other', 'vi-VN' => 'Other'),
                    ),
                )
            ),
            'object_name' => array(),
            'version' => array(),
            'layer' => array(
                'Caption' => array('en-US' => 'Layer', 'vi-VN' => 'Layer'),
                'DataType' => 'Option',
                'Options' => array(
                    static::$LAYER_FW => array(
                        'Caption' => array('en-US' => 'Framework', 'vi-VN' => 'Framework'),
                    ),
                    static::$LAYER_APP => array(
                        'Caption' => array('en-US' => 'App', 'vi-VN' => 'App'),
                    ),
                    static::$LAYER_THEME => array(
                        'Caption' => array('en-US' => 'Theme', 'vi-VN' => 'Theme'),
                    ),
                    static::$LAYER_DB => array(
                        'Caption' => array('en-US' => 'Database', 'vi-VN' => 'Database'),
                    ),
                    static::$LAYER_OTHER => array(
                        'Caption' => array('en-US' => 'Other', 'vi-VN' => 'Other'),
                    ),
                )
            ),
            'action' => array(
                'Caption' => array('en-US' => 'Action', 'vi-VN' => 'Action'),
                'DataType' => 'Option',
                'Options' => array(
                    static::$ACTION_CREATE => array(
                        'Caption' => array('en-US' => 'Create', 'vi-VN' => 'Create'),
                    ),
                    static::$ACTION_MODIFY => array(
                        'Caption' => array('en-US' => 'Modify', 'vi-VN' => 'Modify'),
                    ),
                    static::$ACTION_REMOVE => array(
                        'Caption' => array('en-US' => 'Remove', 'vi-VN' => 'Remove'),
                    ),
                    static::$ACTION_OTHER => array(
                        'Caption' => array('en-US' => 'Other', 'vi-VN' => 'Other'),
                    ),
                )
            ),
        ));
    }

    public static function getInitObj()
    {
        $obj = new QdObjectTask();
        $obj->object_type = static::$OBJECT_TYPE_MODEL;
        $obj->compatible = true;
        $obj->layer = static::$LAYER_APP;
        return $obj;
    }
}