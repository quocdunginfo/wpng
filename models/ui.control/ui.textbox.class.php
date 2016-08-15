<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 14/8/16
 * Time: 6:49 PM
 */
namespace Wpng;
Wpng::loadFile(WPNG_MODULE, 'models/ui.control/_base/_base.uicontrol.class.php');
class UITextBox extends _BaseUIControl {
    public static $TYPE_TEXT = 'text';
    public static $TYPE_EMAIL = 'email';
    public static $TYPE_PASSWORD = 'password';

    public $label;
    public $value;
    public $ng_model;
    public $required = false;
    public $control_length = 8;
    public $place_holder = '';
    public $read_only = false;
    public $input_type = 'text';
}
