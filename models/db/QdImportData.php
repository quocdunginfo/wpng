<?php

class QdImportData extends QdRoot
{
    static $table_name = 'mpd_import_data';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'path' => array(
                'Caption' => array('en-US' => 'Image', 'vi-VN' => 'Excel File'),
                'DataType' => 'File',
            ),
            'model' => array(

            ),
        ));
    }

    public static function getInitObj()
    {
        $obj = new QdImportData();
        return $obj;
    }

    protected function modelOnValidate($field_name)
    {
        if ($this->{$field_name} == '') {
            $this->pushValidateError($field_name, '"model" phải khác rỗng');
        }
    }

    public function fn_import($location, $params = array())
    {
        if($this->model == 'QdNote'){
            QdNote::import($this);
        }
        return true;
    }

}