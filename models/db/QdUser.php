<?php

class QdUser extends QdRoot
{
    static $table_name = 'mpd_user';

    public static function getFieldsConfig()
    {
        $obj = array_merge(parent::getFieldsConfig(), array(
            'username' => array(
                'ReadOnly' => true
            ),
            'displayname' => array(
                'ReadOnly' => true
            ),
            'status' => array(
                'DataType' => 'Boolean',
                'ReadOnly' => true
            ),
        ));
        $obj['id']['ReadOnly'] = true;
        return $obj;
    }

    public static function getInitObj()
    {
        $obj = new QdUser();
        return $obj;
    }

    protected function idOnValidate($field_name)
    {
        if ($this->{$field_name} == '') {
            $this->pushValidateError($field_name, '"model" phải khác rỗng');
        }
    }

    public function fn_syncfromwp($location, $params = array())
    {
        if (!$this->checkPermission(__FUNCTION__)) return false;

        //remove all
        QdUser::delete_all();
        //copy all from WP
        $users = get_users();
        $count = 0;
        foreach ($users as $user) {
            $tmp = new QdUser();
            $tmp->id = $user->ID;
            $tmp->username = $user->user_login;
            $tmp->displayname = $user->display_name;
            $tmp->status = $user->user_status;
            $tmp->email = $user->user_email;
            $location .= sprintf('|%s|%s', $this->getCalledClassName(), 'fn_syncfromwp');
            if ($tmp->save($location)) {
                $count++;
            }
        }
        $this->pushValidateError('', 'Total Users: ' . $count, 'info');
        return $count > 0;
    }
    private $_user_group_obj = null;
    public function getUserGroupObj()
    {
        if($this->_user_group_obj==null){
            //try to get from DB
            $tmp = new QdUserInGroup();
            $tmp->SETRANGE('userid', $this->id);
            $tmp = $tmp->FINDFIRST();
            if ($tmp != null) {
                $this->_user_group_obj = QdUserGroup::GET($tmp->usergroupid);
            }
        }

        return $this->_user_group_obj;
    }

    public function getPermissions()
    {
        //get group
        $g = $this->getUserGroupObj();
        if ($g != null) {
            return $g->getPermissions();
        }
        return array();
    }

    public function hasPermission($class_name = null, $method_name = null, $page_name = null)
    {
        //get group
        $g = $this->getUserGroupObj();
        if ($g != null) {
            return $g->hasPermission($class_name, $method_name, $page_name);
        }
        return false;
    }
}