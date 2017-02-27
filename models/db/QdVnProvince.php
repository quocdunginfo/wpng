<?php

class QdVnProvince extends QdRoot
{
    static $table_name = 'mpd_vn_province';
    public static $TYPE_THANHPHO = 'Thành Phố';
    public static $TYPE_QUAN = 'Quận';
    public static $TYPE_TINH = 'Tỉnh';
    public static $TYPE_HUYEN = 'Huyện';
    public static $TYPE_THIXA = 'Thị Xã';
    public static $TYPE_PHUONG = 'Phường';
    public static $TYPE_THITRAN = 'Thị Trấn';
    public static $TYPE_XA = 'Xã';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'name' => array(),
            'type' => array(
                'Caption' => array('en-US' => 'Type', 'vi-VN' => 'Phân loại'),
                'DataType' => 'Option',
                'Options' => array(
                    static::$TYPE_THANHPHO => array(
                        'Caption' => array('en-US' => static::$TYPE_THANHPHO, 'vi-VN' => static::$TYPE_THANHPHO),
                    ),
                    static::$TYPE_TINH => array(
                        'Caption' => array('en-US' => static::$TYPE_TINH, 'vi-VN' => static::$TYPE_TINH),
                    ),
                )
            ),
        ));
    }

    public static function getInitObj()
    {
        $obj = new QdVnProvince();
        return $obj;
    }

    public function save($validate = true, $location = '')
    {
        $this->pushValidateError('', 'Readonly model');
        return false;
    }

    public function delete($location = '')
    {
        $this->pushValidateError('', 'Readonly model');
        return false;
    }
}