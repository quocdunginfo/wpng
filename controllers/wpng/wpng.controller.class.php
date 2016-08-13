<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 2:36 AM
 */
Wpng::loadController('_base');
class WpngController extends _BaseController {
    public function index(){
        $this->render(__FUNCTION__, 'Content from MVC Controller');
    }
    public function showHand(){
        $request = $this->httpPostData();
        var_dump($request);
        $request = $this->httpGetData();
        var_dump($request);

        $this->render(__FUNCTION__, '');
    }
}