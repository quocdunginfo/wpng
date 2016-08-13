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
            <p>
                This is Child View which render model passed from MVC Controller -
                <?php
                    echo $model;
                ?>
            </p>
            <script>
                Wpng.App.controller('WpngController', function PhoneController($scope) {
                    $scope.msg = 'Content is set from AngularJS';
                });
            </script>
            <div ng-controller="WpngController">
                {{msg}}
            </div>
            <?php
        });
    }
}