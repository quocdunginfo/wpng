<?php

class QdVnWard extends QdRoot
{
    static $table_name = 'mpd_vn_ward';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'name' => array(),
            'type' => array(
                'Caption' => array('en-US' => 'Type', 'vi-VN' => 'Phân loại'),
                'DataType' => 'Option',
                'Options' => array(
                    QdVnProvince::$TYPE_PHUONG => array(
                        'Caption' => array('en-US' => QdVnProvince::$TYPE_PHUONG, 'vi-VN' => QdVnProvince::$TYPE_PHUONG),
                    ),
                    QdVnProvince::$TYPE_THITRAN => array(
                        'Caption' => array('en-US' => QdVnProvince::$TYPE_THITRAN, 'vi-VN' => QdVnProvince::$TYPE_THITRAN),
                    ),
                    QdVnProvince::$TYPE_XA => array(
                        'Caption' => array('en-US' => QdVnProvince::$TYPE_XA, 'vi-VN' => QdVnProvince::$TYPE_XA),
                    ),
                )
            ),
            'location' => array(),
            'districtid' => array(),
            '_districtname' => array(
                'Name' => '_districtname',
                'Caption' => array('en-US' => 'District Name', 'vi-VN' => 'Tên Quận/Huyện'),
                'DataType' => 'Text',
                'FieldClass' => 'FlowField',
                'FieldClass_FlowField' => array(
                    'Method' => 'Lookup',
                    'Table' => 'QdVnDistrict',
                    'Field' => 'name',
                    'TableFilter' => array(
                        0 => array(
                            'Field' => 'id',
                            'Type' => 'FIELD',
                            'Value' => 'districtid'
                        )
                    )
                )
            ),
            '_provinceid' => array(
                'Name' => '_provinceid',
                'Caption' => array('en-US' => 'Mã Tỉnh', 'vi-VN' => 'Mã Tỉnh/Thành phố'),
                'DataType' => 'Text',
                'FieldClass' => 'FlowField',
                'FieldClass_FlowField' => array(
                    'Method' => 'Lookup',
                    'Table' => 'QdVnDistrict',
                    'Field' => 'provinceid',
                    'TableFilter' => array(
                        0 => array(
                            'Field' => 'id',
                            'Type' => 'FIELD',
                            'Value' => 'districtid'
                        )
                    )
                )
            ),
            '_provincename' => array(
                'Name' => '_provincename',
                'Caption' => array('en-US' => 'Tên Tỉnh', 'vi-VN' => 'Tên Tỉnh/Thành phố'),
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
                            'Value' => '_provinceid'
                        )
                    )
                )
            ),
        ));
    }

    public static function getInitObj()
    {
        $obj = new QdVnWard();
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