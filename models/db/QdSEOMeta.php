<?php

class QdSEOMeta extends QdNote
{
    static $table_name = 'mpd_seo_meta';

    public static $META_NAME_DESCRIPTION = 'DESCRIPTION';
    public static $META_NAME_KEYWORDS = 'KEYWORDS';
    public static $META_NAME_TITLE = 'TITLE';
    public static $SEO_TPL_1 = 1;
    public static $SEO_TPL_2 = 2;

    public static function getFieldsConfig()
    {
        $obj = array_merge(parent::getFieldsConfig(), array(
            'meta_name' => array(
                //'Caption' => array('en-US' => 'Type', 'vi-VN' => 'Phân loại'),
                'DataType' => 'Option',
                'Options' => array(
                    static::$META_NAME_TITLE => array(
                        'Caption' => array('en-US' => 'Title', 'vi-VN' => 'Title'),
                    ),
                    static::$META_NAME_DESCRIPTION => array(
                        'Caption' => array('en-US' => 'Description', 'vi-VN' => 'Description'),
                    ),
                    static::$META_NAME_KEYWORDS => array(
                        'Caption' => array('en-US' => 'Keywords', 'vi-VN' => 'Keywords'),
                    ),
                )
            ),
            'meta_value' => array(),
            'active' => array(
                'DataType' => 'Boolean'
            ),
            'overwrite' => array(
                'DataType' => 'Boolean'
            ),
            '_meta_value_preview' => array(
                'FieldClass' => 'FlowField',
                'DataType' => 'Text'
            ),
            'model' => array(
                'ReadOnly' => true
            ),
            'model_id' => array(
                'ReadOnly' => true
            ),
            'seo_tpl' => array(
                'DataType' => 'Option',
                'Options' => array(
                    static::$SEO_TPL_1 => array(
                        'Caption' => array('en-US' => 'SEO TPL 1', 'vi-VN' => 'SEO TPL 1'),
                    ),
                    static::$SEO_TPL_2 => array(
                        'Caption' => array('en-US' => 'SEO TPL 2', 'vi-VN' => 'SEO TPL 2'),
                    ),
                )
            )
        ));
        unset($obj['content']);
        return $obj;
    }

    public static function getInitObj()
    {
        $obj = new QdSEOMeta();
        $obj->active = true;
        $obj->overwrite = false;
        $obj->meta_name = static::$META_NAME_TITLE;
        return $obj;
    }

    protected function CALCFIELDS($flowfield_name)
    {
        $config = static::getFieldsConfig();
        if (isset($config[$flowfield_name]) && $flowfield_name == '_meta_value_preview') {
            if ($this->overwrite == true || $this->meta_name != static::$META_NAME_TITLE) {
                return $this->meta_value;
            } else {
                $trs = QdTRootSetup::GET();
                if ($this->seo_tpl == 1) {
                    return str_replace('{prefix}', $this->meta_value, $trs->seo_title_struct);
                } else {
                    return str_replace('{prefix}', $this->meta_value, $trs->seo_title_struct_2);
                }
            }
        }
        return parent::CALCFIELDS($flowfield_name);
    }
}