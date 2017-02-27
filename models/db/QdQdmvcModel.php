<?php

class QdQdmvcModel extends QdRoot
{
    static $table_name = 'mpd_qdmvc_model';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array());
    }

    public static function getInitObj()
    {
        $obj = new QdQdmvcModel();
        return $obj;
    }

    public function fn_genfromfolder($location, $params)
    {
        $folder = Qdmvc::getPluginDir('models'); //TODO
        $count = 0;
        $t = glob("{$folder}/*");
        foreach (glob("{$folder}/*") as $file) {
            if ($count == 0) {
                QdQdmvcModel::delete_all();
            }

            if (is_file($file)) {
                $file_name = basename($file);
                $file_name = str_replace(".php", "", $file_name);
                if (QdQdmvcModel::GET($file_name) == null) {
                    $tmp = new QdQdmvcModel();
                    $tmp->id = $file_name;
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