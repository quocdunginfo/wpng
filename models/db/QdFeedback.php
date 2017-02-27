<?php

class QdFeedback extends QdRoot
{
    static $table_name = 'mpd_feedback';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'customer_name' => array(
                'Caption' => array('en-US' => 'Customer Name', 'vi-VN' => 'Tên KH')
            ),
            'customer_phone' => array(
                'Caption' => array('en-US' => 'Customer Phone', 'vi-VN' => 'SĐT KH')
            ),
            'customer_email' => array(
                'Caption' => array('en-US' => 'Customer Email', 'vi-VN' => 'Email KH')
            ),
            'title' => array(
                'Caption' => array('en-US' => 'Title', 'vi-VN' => 'Tiêu đề')
            ),
            'content' => array(
                'Caption' => array('en-US' => 'Content', 'vi-VN' => 'Nội dung'),
                'DataType' => 'WYSIWYG'
            ),
            'done' => array(
                'Caption' => array('en-US' => 'Done', 'vi-VN' => 'Hoàn tất'),
                'DataType' => 'Boolean'
            ),
        ));
    }

    /*
    protected function contentOnValidate($field_name)
    {
        if($this->content!=$this->xRec()->content)
        {
            if($this->done)
            {
                $this->pushValidateError($field_name, 'Không thể sửa Content khi Done = true');
            }
        }
    }
    protected function customer_emailOnValidate($field_name)
    {
        if($this->customer_email!=$this->xRec()->customer_email)
        {
            if($this->done)
            {
                $this->pushValidateError($field_name, 'Không thể sửa Customer Email khi Done = true');
            }
        }

    }
    protected function customer_nameOnValidate($field_name)
    {
        if($this->customer_name!=$this->xRec()->customer_name)
        {
            if($this->done)
            {
                $this->pushValidateError($field_name, 'Không thể sửa Customer Name khi Done = true');
            }
        }
    }
    */

    public function save($validate = true, $location = '')
    {
        if (!$this->is_new_record()) {
            if ($this->done) {
                if ($this->xRec()->done) {
                    $this->pushValidateError('', 'Không thể sửa khi Done = true');
                    return false;
                }
            }
        }
        return parent::save($validate, $location);
    }

    public function delete($location = '')
    {
        if ($this->done) {
            $this->pushValidateError('', 'Không thể xóa khi Done = true');
            return false;
        }
        return parent::delete($location);
    }

    public function fn_sendemail($location, $param)
    {
        if (is_array($param)) {
            if (isset($param['subject']) && isset($param['content'])) {
                return Wpng\WpngHelper::sendEmail($this->customer_email, $param['subject'], $param['content']);
            }
        }
        return true;
    }

}