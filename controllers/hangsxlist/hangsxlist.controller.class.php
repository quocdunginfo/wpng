<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 2:36 AM
 */
namespace Wpng;
Wpng::loadController(WPNG_MODULE, '_base');
class HangSXListController extends _BaseController {
    public function index(){
        $p = new \QdUser();
        $r = $p->GETLIST();

        $this->render(__FUNCTION__, '');
    }
}