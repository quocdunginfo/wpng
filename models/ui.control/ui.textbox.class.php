<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 14/8/16
 * Time: 6:49 PM
 */
Wpng::loadFile('models/ui.control/_base/_base.uicontrol.class.php');
class UITextBox extends _BaseUIControl {
    public $label;
    public $value;
    public $ng_model;
    public $required = false;
    public $control_length;
}
