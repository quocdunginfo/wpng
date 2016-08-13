<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 3:28 AM
 */
Wpng::loadView('_base');
class WpngShowHandView extends _BaseView {
    public function render($model) {
        echo $model . ' - but render in view 4';
    }
}