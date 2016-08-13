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
        $model = get_class($this);

        $this->render('index', $model);
    }
    public function showHand(){
        $model = get_class($this);

        $this->render('showhand', $model);
    }
}