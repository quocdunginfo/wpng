<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 14/8/16
 * Time: 6:49 PM
 */
namespace Wpng;
Wpng::loadFile(WPNG_MODULE, 'models/ui.control/_base/_base.uicontrol.class.php');
class UIButton extends _BaseUIControl {
    public static $TYPE_BUTTON = 'button';
    public static $TYPE_SUBMIT = 'submit';
    public $label;
    public $ng_click;
    public $onclick;
    public $control_length = 12;
    public $button_type = 'button';
}
