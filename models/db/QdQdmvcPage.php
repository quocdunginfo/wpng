<?php

class QdQdmvcPage extends QdRoot
{
    static $table_name = 'mpd_qdmvc_page';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array());
    }

    public static function getInitObj()
    {
        $obj = new QdQdmvcPage();
        return $obj;
    }

    public function fn_genfromfolder($location, $params)
    {
        $folder = Qdmvc::getPluginDir('controllers/pages'); //TODO
        $count = 0;
        foreach (glob("{$folder}/*") as $file) {
            if ($count == 0) {
                QdQdmvcPage::delete_all();
            }
            if (is_dir($file)) {
                $folder_name = basename($file);
                if (QdQdmvcPage::GET($folder_name) == null) {
                    $tmp = new QdQdmvcPage();
                    $tmp->id = $folder_name;
                    if ($tmp->save()) {
                        $count++;
                    }
                }
            }
        }
        $this->pushValidateError('', sprintf('Total items: %s', $count), 'info');
        return true;
    }
}