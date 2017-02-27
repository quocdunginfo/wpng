<?php

class QdVersion extends QdRootSetup
{
    static $table_name = 'mpd_version';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'source_version' => array(
                'DataType' => 'WYSIWYG',
            ),
            'db_version' => array(
                'DataType' => 'WYSIWYG',
            ),
        ));
    }
}