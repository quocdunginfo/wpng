<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 2:36 AM
 */
namespace Wpng;
Wpng::loadController(WPNG_MODULE, '_base');
class HomeController extends _BaseController {
    public function index(){
        $this->render(__FUNCTION__, '');
    }
    public function test(){
        $this->render(__FUNCTION__, 'Content from Server');
    }
}