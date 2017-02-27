<?php

class QdImage extends QdNote
{
    static $table_name = 'mpd_image';
    public static $TYPE_UNUSED = 'UNUSED';
    public static $TYPE_ = '';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
                'path' => array(
                    'Caption' => array('en-US' => 'Image', 'vi-VN' => 'Hình ảnh'),
                    'DataType' => 'Image',
                    'MultiValue' => true
                ),
                '_path_preview' => array(
                    'Caption' => array('en-US' => 'Image Preview', 'vi-VN' => 'Xem trước'),
                    'DataType' => 'ImagePreview',
                    'ImagePreviewField' => 'path',
                    'FieldClass' => 'System',
                ),
                'active' => array(
                    'DataType' => 'Boolean'
                ),
                'order' => array(
                    'Caption' => array('en-US' => 'Order', 'vi-VN' => 'Thứ tự'),
                ),
                'type' => array(
                    'Caption' => array('en-US' => 'Type', 'vi-VN' => 'Phân loại'),
                    'DataType' => 'Option',
                    'Options' => array(
                        static::$TYPE_ => array(
                            'Caption' => array('en-US' => 'Default', 'vi-VN' => 'Mặc định'),
                        ),static::$TYPE_UNUSED => array(
                            'Caption' => array('en-US' => 'Unused', 'vi-VN' => 'Rác'),
                        ),
                    ),
                    'ReadOnly' => true
                ),
            )
        );
    }


    public static function getInitObj()
    {
        $obj = new QdImage();
        $obj->active = true;
        $obj->type = static::$TYPE_;
        return $obj;
    }

    protected function orderOnValidate($field_name)
    {
        if ($this->{$field_name} != '') {
            if ($this->{$field_name} <= 0) {
                $this->pushValidateError($field_name, 'Thứ tự phải lớn hơn 0');
            }
        } else {
            $this->{$field_name} = $this->GETIMAGEMAX($field_name) + 10;
            $this->pushValidateError($field_name, 'Thứ tự được gán tự động RANGE +10', 'info');
        }
    }

    public function GETIMAGEMAX($field)
    {
        $record = new QdImage();
        $record->SETRANGE('model', $this->model);
        $record->SETRANGE('model_id', $this->model_id);
        $max = $record->SELECTMAX($field);
        if($max!==false){
            return $max;
        }else{
            return 0;
        }
    }

    public function fn_get_unused($location, $params = array())
    {
        $ignore = array('QdRoot', 'QdRootReport', 'QdRootSetup');
        //delete all previous
        $r = new QdImage();
        $r->SETRANGE('type', static::$TYPE_UNUSED);
        $r->DELETEALL();
        //get unused list
        $media_query = new WP_Query(
            array(
                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'posts_per_page' => -1,
            )
        );
        $model_list = new QdQdmvcModel();
        $model_list = $model_list->GETLIST();
        $count=0;
        foreach ($media_query->posts as $post) {
            $tmp = wp_get_attachment_image_src($post->ID, 'full');
            $url = $tmp[0];
            $found = false;
            foreach($model_list as $item){
                $c = $item->id;
                if(in_array($c, $ignore)){
                    continue;
                }
                $m = new $c();
                if($c==='QdSetupProduct'){
                    $ttt = 1;
                }
                foreach($c::getImageFields() as $item2){
                    $m->SETRANGE($item2, $url, QdRoot::$OP_CONTAINS);
                    if($c==='QdImage'){
                        $m->SETRANGE('type', QdImage::$TYPE_);
                    }
                    if($m->COUNTLIST() > 0){
                        $found = true;
                        break;
                    }
                }
                if($found)
                    break;
            }
            if(!$found){
                $obj = new QdImage();
                $obj->active = false;
                $obj->order = 10;
                $obj->type = QdImage::$TYPE_UNUSED;
                $obj->path = $url.'?id='.$post->ID;
                $obj->model = '';
                $obj->model_id = '';

                if($obj->save(false))
                {
                    $count++;
                }
                else{
                    $this->pushValidateError($obj->GETVALIDATION());
                }
            }
        }
        //msg
        $this->pushValidateError('', 'Total unused images: '.$count, 'info');

        return true;
    }

    public function delete($location = '', $validate = true)
    {
        if($validate && $this->type===static::$TYPE_UNUSED){
            //get id
            $id = $this->getMediaID('path');
            //delete wp media too
            if($id!=null)
                wp_delete_attachment($id, true);
        }
        return parent::delete($location, $validate);
    }

    protected function pathOnValidate($field_name)
    {
        $tmp = explode("|", $this->$field_name);
        if(count($tmp) > 1){
            foreach($tmp as $item){
                $obj = static::getInitObj();
                $obj->transferFieldsFrom($this);

                $obj->path = $item;
                $obj->save();
            }
        }
    }
    public function save($validate = true, $location = '')
    {
        $tmp = explode("|", $this->path);
        if(count($tmp) > 1){
            $this->pathOnValidate('path');
            return true;
        }else{
            return parent::save($validate, $location);
        }
    }


}