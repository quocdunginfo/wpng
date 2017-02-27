<?php

class QdSetup extends QdRootSetup
{
    static $table_name = 'mpd_setup';

    public function save($validate = true)
    {
        $re = parent::save($validate);
        if ($re) {
            $this->pushValidateError('', 'Cần tải lại trang Web để có hiệu lực', 'warning');
        }
        return $re;
    }

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'df_language' => array(
                'Caption' => array('en-US' => 'DF Language', 'vi-VN' => 'Ngôn ngữ mặc định'),
                'DataType' => 'Option',
                'Options' => array(
                    'en-US' => array(
                        'Caption' => array('en-US' => 'English', 'vi-VN' => 'Tiếng Anh'),
                    ),
                    'vi-VN' => array(
                        'Caption' => array('en-US' => 'Vietnamese', 'vi-VN' => 'Tiếng việt'),
                    ),
                )
            ),
            'autoexpandmenu' => array(

                'DataType' => 'Boolean',

            ),
        ));
    }

    public function fn_removecache()
    {
        //xoa het file trong qdmvc_caches
        if (Wpng\WpngHelper::cacheRemoveAll()) {
            $this->pushValidateError('', 'Remove All Cache files done!', 'info');
        }

    }

    public function fn_extractcores($location, $params = array())
    {
        Qdmvc::extractQdmvcCoreFiles(); //TODO
        $this->pushValidateError('', 'Core package extracted under Qdmvc Plugin root directory!', 'info');
        return true;
    }


}