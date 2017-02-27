<?php

class QdPermission extends QdRoot
{
    static $table_name = 'mpd_permission';

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
            'classname' => array(),
            'methodname' => array(),
            'pagename' => array(
                'DataType' => 'Code',
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdQdmvcPage',
                    'Field' => 'id',
                    'TableFilter' => array()
                ),
                'DataPort' => 'qdmvcpage_port'
            ),
            'active' => array(
                'DataType' => 'Boolean'
            ),
        ));
        return $obj;
    }

    public static function getInitObj()
    {
        $obj = new QdPermission();
        return $obj;
    }

    protected function usergroupidOnValidate($field_name)
    {
        $u = Wpng\WpngHelper::getCurrentUser();
        if ($u != null) {
            $g = $u->getUserGroupObj();
            if ($g != null) {
                if ($g->id == $this->{$field_name}) {
                    $this->pushValidateError($field_name, 'You can not set Permission by your self!', 'error');
                }
            }
        }
    }
}