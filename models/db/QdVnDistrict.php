<?php

class QdVnDistrict extends QdRoot
{
    static $table_name = 'mpd_vn_district';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'name' => array(),
            'type' => array(
                'Caption' => array('en-US' => 'Type', 'vi-VN' => 'Phân loại'),
                'DataType' => 'Option',
                'Options' => array(
                    QdVnProvince::$TYPE_THANHPHO => array(
                        'Caption' => array('en-US' => 'Thành Phố', 'vi-VN' => 'Thành Phố'),
                    ),
                    QdVnProvince::$TYPE_QUAN => array(
                        'Caption' => array('en-US' => 'Quận', 'vi-VN' => 'Quận'),
                    ),
                    QdVnProvince::$TYPE_HUYEN => array(
                        'Caption' => array('en-US' => 'Huyện', 'vi-VN' => 'Huyện'),
                    ),
                    QdVnProvince::$TYPE_THIXA => array(
                        'Caption' => array('en-US' => 'Thị Xã', 'vi-VN' => 'Thị Xã'),
                    ),
                )
            ),
            'location' => array(),
            'provinceid' => array(),
            '_provincename' => array(
                'Name' => '_provincename',
                'Caption' => array('en-US' => 'Province Name', 'vi-VN' => 'Tên Tỉnh/TP'),
                'DataType' => 'Text',
                'FieldClass' => 'FlowField',
                'FieldClass_FlowField' => array(
                    'Method' => 'Lookup',
                    'Table' => 'QdVnProvince',
                    'Field' => 'name',
                    'TableFilter' => array(
                        0 => array(
                            'Field' => 'id',
                            'Type' => 'FIELD',
                            'Value' => 'provinceid'
                        )
                    )
                )
            ),
        ));
    }

    public static function getInitObj()
    {
        $obj = new QdVnDistrict();
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