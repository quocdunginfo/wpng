<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 3:32 AM
 */
namespace Wpng;
class _BaseView {
    public function renderInPlaceHolder($childView){
        $childView();
    }
    public function render($model){
        // Must be overwrite in child class
    }
}