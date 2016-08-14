<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 14/8/16
 * Time: 6:49 PM
 */
Wpng::loadFile('models/ui.control/_base/_base.uicontrol.class.php');
class UIButton extends _BaseUIControl {
    public $label;
    public $ng_click;
    public $onclick;
    public $class = '';
    public $control_length = 12;
}
