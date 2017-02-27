<?php

class QdUserGroup extends QdRoot
{
    static $table_name = 'mpd_usergroup';

    public static function getFieldsConfig()
    {
        $obj = array_merge(parent::getFieldsConfig(), array(
            'description' => array(),
            'active' => array(
                'DataType' => 'Boolean'
            ),
            'parent_id' => array(
                'DataType' => 'Code',
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdUserGroup',
                    'Field' => 'id',
                    'TableFilter' => array()
                )
            )
        ));
        $obj['id']['ReadOnly'] = false;
        return $obj;
    }

    public static function getInitObj()
    {
        $obj = new QdUserGroup();
        return $obj;
    }

    private $_list_per = null;
    public function getPermissions()
    {
        if($this->_list_per==null) {
            //find all in Permission in current obj
            $tmp = new QdPermission();
            $tmp->SETRANGE('usergroupid', $this->id);
            $tmp->SETRANGE('active', true);
            $pers = $tmp->GETLIST();

            $po = $this->getParentObj();
            while($po!=null){
                //get Permission of current parent obj
                $tmp_ar = $po->getPermissions();
                if($tmp_ar!=null && is_array($tmp_ar) && !empty($tmp_ar)){
                    $pers = array_merge($pers, $tmp_ar);
                }
                $po = $po->getParentObj();
            }
            $this->_list_per = $pers;
        }
        return $this->_list_per;
    }

    /**
     * @param null $class_name Model class Name
     * @param null $method_name Function Name of Model class
     * @param null $page_name ID of the Page
     * @return bool
     */
    public function hasPermission($class_name = null, $method_name = null, $page_name = null)
    {
        //get permission
        $pers = $this->getPermissions();
        foreach($pers as $item){
            if($class_name !== null && $method_name !== null){
                if($item->classname==$class_name && $item->methodname==$method_name){
                    return false;
                }
            }else{
                if($page_name!=null){
                    if($page_name==$item->pagename){
                        return false;
                    }
                }
            }
        }
        return true;

        /*
        $tmp = new QdPermission();
        $tmp->SETRANGE('usergroupid', $this->id);
        $tmp->SETRANGE('active', true);
        if ($class_name !== null && $method_name !== null) {
            $tmp->SETRANGE('classname', $class_name);
            $tmp->SETRANGE('methodname', $method_name);
        } else {
            $tmp->SETRANGE('pagename', $page_name);
        }

        //KHONG nen check permission long nhau kieu nhu vay, nen Flating ra 1 array duy nhat
        $tmp = $tmp->GETLIST();
        if (empty($tmp)) {
            $po = $this->getParentObj();
            if ($po != null) {
                return $po->hasPermission($class_name, $method_name, $page_name);
            }
            return true;
        } else {
            return false;
        }*/
    }

    public function getParentObj()
    {
        return QdUserGroup::GET($this->parent_id);
    }
}