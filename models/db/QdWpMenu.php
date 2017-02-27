<?php

class QdWpMenu extends QdRoot
{
    static $table_name = 'mpd_wp_menu';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'count' => array(
                'DataType' => 'Integer'
            ),
            'wpid' => array()
        ));
    }

    public static function getInitObj()
    {
        $obj = new QdWpMenu();
        return $obj;
    }

    public function fn_syncfromwp($location, $params)
    {

        $menus = get_terms('nav_menu', array('hide_empty' => false));

        $count = 0;
        foreach ($menus as $item) {
            if ($count == 0) {
                QdWpMenu::delete_all();
            }

            $tmp = new QdWpMenu();
            $tmp->id = $item->slug;
            $tmp->wpid = $item->term_id;
            $tmp->count = $item->count;
            if ($tmp->save()) {
                $count++;
            }
        }
        $this->pushValidateError('', sprintf('Total items: %s', $count), 'info');
        return true;
    }
}