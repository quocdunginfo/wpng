<?php

class QdLog extends QdNote
{
    static $table_name = 'mpd_log';
    public static $ACTION_UNDEFINED = 0;
    public static $ACTION_INSERT = 1;
    public static $ACTION_MODIFY = 2;
    public static $ACTION_DELETE = 3;

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'action' => array(
                'Caption' => array('en-US' => 'Action', 'vi-VN' => 'Hành động'),
                'DataType' => 'Option',
                'Options' => array(
                    static::$ACTION_UNDEFINED => array(
                        'Caption' => array('en-US' => 'Undefined', 'vi-VN' => 'Không xác định'),
                    ),
                    static::$ACTION_INSERT => array(
                        'Caption' => array('en-US' => 'Insert', 'vi-VN' => 'Thêm mới'),
                    ),
                    static::$ACTION_MODIFY => array(
                        'Caption' => array('en-US' => 'Modify', 'vi-VN' => 'Sửa'),
                    ),
                    static::$ACTION_DELETE => array(
                        'Caption' => array('en-US' => 'Delete', 'vi-VN' => 'Xóa'),
                    ),
                ),
                'ReadOnly' => true
            ),
            'location' => array(
                'Caption' => array('en-US' => 'Location', 'vi-VN' => 'Nơi phát sinh'),
                'ReadOnly' => true
            ),
            'ip' => array(
                'Caption' => array('en-US' => 'IP', 'vi-VN' => 'IP'),
                'ReadOnly' => true
            ),
        ));
    }

    public static function getInitObj($model = '', $model_id = '', $action = 0, $location = '', $ip = '')
    {
        $obj = new QdLog();
        $obj->model = $model;
        $obj->model_id = $model_id;
        $obj->action = $action;
        $obj->location = $location;
        $obj->ip = $ip;
        return $obj;
    }
}