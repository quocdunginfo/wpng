<?php

class QdUserInGroup extends QdRoot
{
    static $table_name = 'mpd_useringroup';

    public static function getFieldsConfig()
    {
        $obj = array_merge(parent::getFieldsConfig(), array(
            'usergroupid' => array(
                'DataType' => 'Code',
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdUserGroup',
                    'Field' => 'id',
                    'TableFilter' => array()
                )
            ),
            'userid' => array(
                'DataType' => 'Code',
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdUser',
                    'Field' => 'id',
                    'TableFilter' => array()
                )
            ),
        ));
        return $obj;
    }

    public static function getInitObj()
    {
        $obj = new QdUserInGroup();
        return $obj;
    }
}