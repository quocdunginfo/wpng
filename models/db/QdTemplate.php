<?php

class QdTemplate extends QdRoot
{
    static $table_name = 'mpd_template';
    public static $TYPE_ = '';
    public static $TYPE_PBH = 'PBH';

    public static function getFieldsConfig()
    {
        $obj = array_merge(parent::getFieldsConfig(), array(
            'content' => array(
                'DataType' => 'WYSIWYG'
            ),
            'type' => array(
                'Caption' => array('en-US' => 'Type', 'vi-VN' => 'Type'),
                'DataType' => 'Option',
                'Options' => array(
                    static::$TYPE_ => array(
                        'Caption' => array('en-US' => 'Default', 'vi-VN' => 'Mặc định'),
                    ),
                    static::$TYPE_PBH => array(
                        'Caption' => array('en-US' => 'Warranty', 'vi-VN' => 'Phiếu bảo hành'),
                    ),
                )
            ),
            'description' => array(
                'DataType' => 'Text'
            )
        ));
        $obj['id']['ReadOnly'] = false;
        return $obj;
    }

    public static function getInitObj()
    {
        $obj = new QdTemplate();
        $obj->type = static::$TYPE_;
        return $obj;
    }
}