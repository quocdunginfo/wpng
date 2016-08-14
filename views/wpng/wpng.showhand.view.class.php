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
        $this->renderInPlaceHolder(function() use ($model){
           ?>
            <div ng-controller="showHandController">
                <div>
                    <?php echo __('Msg', 'wpng') ?>: {{msg}}
                </div>
                <button ng-click="viewShowHand($event)">Click here to view Check Out inside</button>
                <br>
                <div ng-include src="templateUrl"></div>
            </div>

            <?php
        });
    }
}