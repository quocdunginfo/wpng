<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 3:41 PM
 */
Wpng::loadView('_base');
class _SharedMainView extends _BaseView {
    public function renderInPlaceHolder($childView){
        ?>
        <div>
            <p>
                This is Main Shared View which define ngApp
            </p>
            <script>
                // Define the `phonecatApp` module
                var Wpng = {};
                Wpng.App = angular.module('WpngApp', []);
            </script>
            <div ng-app="WpngApp">
                <?php
                    $childView();
                ?>
            </div>
        </div>

        <?php
    }
    public function render($model){
        // Must be overwrite in child class
    }
}