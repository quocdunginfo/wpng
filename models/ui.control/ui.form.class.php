<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 14/8/16
 * Time: 6:49 PM
 */
Wpng::loadFile('models/ui.control/_base/_base.uicontrol.class.php');
class UIForm extends _BaseUIControl {
    public $controls = array();
    public $column_num = 1;
    public $ng_submit = '';
}
