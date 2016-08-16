<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 3:28 AM
 */
namespace Wpng;
Wpng::loadView(WPNG_MODULE, '_base');
class HomeTestView extends _BaseView {
    public function render($model) {
        $this->renderInPlaceHolder(function() use ($model){
           ?>
           <?php echo $model ?>
            <?php
        });
    }
}