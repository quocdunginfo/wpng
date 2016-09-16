<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 2:36 AM
 */
namespace Wpng;
Wpng::loadController(WPNG_MODULE, '_base');
class WpngController extends _BaseController {
    public function index(){
        $this->render(__FUNCTION__, 'Content from MVC Controller Index');
    }
    public function showHand(){
        $this->render(__FUNCTION__, 'Content from MVC Controller Show Hand');
    }
    public function checkOut(){
        $this->render(__FUNCTION__, 'Content from MVC Controller Check Out');
    }
}