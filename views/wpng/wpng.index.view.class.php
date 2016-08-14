<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 3:28 AM
 */
Wpng::loadView('_shared', 'main');
class WpngIndexView extends _SharedMainView {
    public function render($model) {
        parent::renderInPlaceHolder(function() use ($model) {
            ?>
            <div ng-controller="wpngController">
                <button ng-click="changeTemplate($event, 'showhand')">Show Hand</button>
                <button ng-click="changeTemplate($event, 'checkout')">Check Out</button>
                <br>
                <?php echo __('Msg', 'wpng') ?>
                <br>
                <div ng-include src="template.url"></div>
            </div>
            <script>
                Wpng.App.controller('wpngController', function($scope) {
                    $scope.template = {};
                    $scope.changeTemplate = function(e, $view){
                        $scope.template.url = '/?module=wpng&controller=wpng&action=' + $view;
                    };
                });
            </script>
            <script>
                Wpng.App.controller('showHandController', function($scope) {
                    $scope.msg = 'Content is set from AngularJS';
                    $scope.viewShowHand = function(e){
                        $scope.templateUrl = '/?module=wpng&controller=wpng&action=checkout';
                    };
                });
            </script>
            <script>
                Wpng.App.controller('checkOutController', function($scope) {
                    $scope.msg = 'Content is set from AngularJS';
                    $scope.checkOut = function(e){
                        alert('Check Out');
                    };
                });
            </script>
            <script>
                Wpng.App.controller('stockCountController', function($scope) {
                    $scope.msg = 'Switch to Page Stock Count';
                });
            </script>
            <?php
        });
    }
}