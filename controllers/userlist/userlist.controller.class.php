<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 2:36 AM
 */
namespace Wpng;
Wpng::loadController(WPNG_MODULE, '_base');
class UserListController extends _BaseController {
    public function index(){
        $this->render(__FUNCTION__, '');
    }
}