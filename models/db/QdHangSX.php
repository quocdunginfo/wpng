<?php

class QdHangSX extends QdRoot
{
    public function __construct(array $attributes = array(), $guard_attributes = true, $instantiating_via_find = false, $new_record = true)
    {
        parent::__construct($attributes, $guard_attributes, $instantiating_via_find, $new_record); // TODO: Change the autogenerated stub
    }

    public static function getFieldsConfig()
    {
        $obj = array_merge(parent::getFieldsConfig(), array(
            'name' => array(
                'DataType' => 'Text'
            )
        ));
        return $obj;
    }
}