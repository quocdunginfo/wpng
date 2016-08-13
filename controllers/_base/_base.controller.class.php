<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 3:30 AM
 */
class _BaseController {
    protected function render($view, $model){
        $viewClass = Wpng::loadView($this->getControllerName(), $view);
        $ins = new $viewClass();
        $ins->render($model);
    }
    protected function getControllerName(){
        $cName = strtolower(get_class($this));
        $c = substr($cName, 0, strpos($cName, 'controller'));
        return $c;
    }
}