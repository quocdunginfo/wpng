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
                <button ng-click="showPopup($event)">Show Popup</button>
                <div>
                    <?php
                    Wpng::loadFile('helper/ui.control/ui.helper.render.class.php');
                    $form = new UIForm();
                    $form->ng_submit = 'formSubmit()';
                    $button = new UIButton();
                    $textbox = new UITextBox();
                    {
                        //$button->id = 'WpngButton001';
                        $button->label = __('Click here', 'wpng');
                        //$button->ng_click = 'openDialog($event)';
                        $button->style = '';
                        $button->class = 'btn-primary';
                        $button->control_length = 8;
                        $button->button_type = UIButton::$TYPE_SUBMIT;

                        $textbox->label = __('Email', 'wpng');
                        $textbox->ng_model = 'emailValue';
                        $textbox->required = true;
                        //$textbox->read_only = true;
                        //$textbox->value = '@Sample';
                        $textbox->place_holder = 'Enter text here';
                        $textbox->input_type = UITextBox::$TYPE_TEXT;

                        $form->controls[] = $textbox;
                        $form->controls[] = $button;
                    }
                    ?>
                    <div>
                        <?php UIRenderHelper::render($form) ?>
                    </div>

                </div>
                <br>
                <?php echo __('Msg', 'wpng') ?>
                <br>
                <div ng-include src="template.url"></div>
            </div>

            <script>
                Wpng.App.controller('wpngController', function($scope, ngDialog) {
                    $scope.template = {};
                    $scope.emailValue = 'Value from AngularJS';
                    $scope.changeTemplate = function(e, $view){
                        $scope.template.url = Wpng.BaseUrl + '?module=wpng&controller=wpng&action=' + $view;
                    };
                    $scope.showPopup = function(e){
                        ngDialog.open({ template: Wpng.BaseUrl + '?module=wpng&controller=wpng&action=showhand', className: 'ngdialog-theme-default' });
                    };
                    $scope.openDialog = function(e){
                        ngDialog.open({ template: Wpng.BaseUrl + '/?module=wpng&controller=wpng&action=showhand', className: 'ngdialog-theme-default' });
                    };
                    $scope.formSubmit = function(e){
                        alert('form Submit via AngularJS');
                    };
                });
            </script>
            <script>
                Wpng.App.controller('showHandController', function($scope) {
                    $scope.msg = 'Content is set from AngularJS';
                    $scope.viewShowHand = function(e){
                        $scope.templateUrl = Wpng.BaseUrl + '?module=wpng&controller=wpng&action=checkout';
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