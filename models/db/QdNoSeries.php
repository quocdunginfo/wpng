<?php

class QdNoSeries extends QdRoot
{
    static $table_name = 'mpd_noseries';

    public static function getFieldsConfig()
    {
        $obj = array_merge(parent::getFieldsConfig(), array(
            'from_no' => array(
                'DataType' => 'Integer',
            ),
            'to_no' => array(
                'DataType' => 'Integer',
            ),
            'last_no' => array(
                'DataType' => 'Integer',
            ),
            'prefix' => array(
                'DataType' => 'Integer',
            ),
            'active' => array(
                'Caption' => array('en-US' => 'Active', 'vi-VN' => 'Kích hoạt'),
                'DataType' => 'Boolean',
                'InitValue' => true,
            ),
            'manual_allowed' => array(
                'DataType' => 'Boolean',
            ),
            'fixed_length' => array(
                'DataType' => 'Boolean',
            ),
        ));
        $obj['id']['ReadOnly'] = false;
        return $obj;
    }

    public static function getInitObj()
    {
        $obj = new QdNoSeries();
        $obj->from_no = 1;
        $obj->to_no = 99999;
        $obj->last_no = $obj->from_no - 1;
        $obj->fixed_length = true;
        $obj->manual_allowed = true;
        $obj->active = true;

        return $obj;
    }

    public function getNextNo()
    {
        //check active
        if ($this->active == false) {
            $this->pushValidateError('', 'No Series is not active', 'error');
            return false;
        }

        $this->last_no++;
        if ($this->last_no > $this->to_no) {
            $this->pushValidateError('', 'No Series reach maximum of ' . ($this->last_no - 1), 'error');
            return false;
        }

        $tmp = $this->prefix;
        if ($this->fixed_length == true) {
            $tmp .= str_pad($this->last_no, strlen($this->to_no), '0', STR_PAD_LEFT);
        } else {
            $tmp .= $this->last_no;
        }

        if ($this->save(false, '|QdNoSeries|getNextNo')) {
            return $tmp;
        }
        return false;
    }
}