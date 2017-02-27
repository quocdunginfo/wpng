<?php

class QdMyTags extends QdRoot
{
    static $table_name = 'mpd_mytags';
    public static $TYPE_SP = 'SP';
    public static $TYPE_ = '';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'name' => array(

            ),
            'description' => array(

            ),
            'type' => array(
                'Caption' => array('en-US' => 'Type', 'vi-VN' => 'Phân loại'),
                'DataType' => 'Option',
                'Options' => array(
                    static::$TYPE_ => array(
                        'Caption' => array('en-US' => '', 'vi-VN' => ''),
                    ),
                    static::$TYPE_SP => array(
                        'Caption' => array('en-US' => 'Product', 'vi-VN' => 'Sản phẩm'),
                    ),
                )
            )
        ));
    }
}