<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 3:41 PM
 */
namespace Wpng;
Wpng::loadView(WPNG_MODULE, '_base');
class _SharedMainView extends _BaseView {
    public function renderInPlaceHolder($childView){
        $childView();
    }
}