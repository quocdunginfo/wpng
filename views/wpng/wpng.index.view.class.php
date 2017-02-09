<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 3:28 AM
 */
namespace Wpng;
Wpng::loadView(WPNG_MODULE, '_shared', 'main');
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
                    Wpng::loadFile(WPNG_MODULE, 'helper/ui.control/ui.helper.render.class.php');
                    $form = new UIForm();
                    $form->ng_submit = 'formSubmit()';
                    $button = new UIButton();
                    $textbox = new UITextBox();
                    $ttextbox = new UITriggerTextBox();
                    {
                        //$button->id = 'WpngButton001';
                        $button->label = __('Click here', 'wpng');
                        //$button->ng_click = 'openDialog($event)';
                        $button->style = '';
                        $button->class = array('btn-primary');
                        $button->control_length = 8;
                        $button->button_type = UIButton::$TYPE_SUBMIT;

                        $textbox->label = __('Email', 'wpng');
                        $textbox->ng_model = 'emailValue';
                        $textbox->required = true;
                        //$textbox->read_only = true;
                        //$textbox->value = '@Sample';
                        $textbox->place_holder = 'Enter text here';
                        $textbox->input_type = UITextBox::$TYPE_TEXT;

                        $ttextbox->label = __('Email', 'wpng');
                        $ttextbox->ng_model = 'addrValue';
                        $ttextbox->required = true;
                        //$textbox->read_only = true;
                        //$textbox->value = '@Sample';
                        $ttextbox->place_holder = 'Enter text here';
                        $ttextbox->input_type = UITextBox::$TYPE_TEXT;

                        $form->controls[] = $textbox;
                        $form->controls[] = $ttextbox;
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
                <div ng-include src="templateUrl2"></div>
            </div>
		</div>
    </div>
            </div>
			<script>
                Wpng.App.controller('wpngController', function($scope) {
                    $scope.templateUrl2 = Wpng.BaseUrl + '?module=wpng&controller=wpng&action=showhand';
                });
            </script>
			<script>
                Wpng.App.controller('showHandController', function($scope) {
                    
                });
            </script>
            <?php
        });
    }
}