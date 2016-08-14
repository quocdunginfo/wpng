<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 3:28 AM
 */
Wpng::loadView('_base');
class WpngCheckOutView extends _BaseView {
    public function render($model) {
        $this->renderInPlaceHolder(function() use ($model){
           ?>
            <div ng-controller="checkOutController">
                <div>
                    Msg: {{msg}}
                </div>
                <button ng-click="checkOut($event)">Click here to Check Out</button>
            </div>

            <?php
        });
    }
}