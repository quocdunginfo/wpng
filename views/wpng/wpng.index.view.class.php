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
					<form class="form-horizontal">
						<input class="form-control" type="text" id="myinput" ng-model="jqxInputValue" required placeholder="Hard Code"/>
						<script type="text/javascript">
							$(document).ready(function () {              
								$("#myinput").jqxInput({});
							});
						</script>
					</form>
				</div>
                <div>
                    <?php
                    Wpng::loadFile(WPNG_MODULE, 'helper/ui.control/ui.helper.render.class.php');
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
		</div>
    </div>
            </div>
			<script type="text/javascript">
        $(document).ready(function () {
            // the 'layout' JSON array defines the internal structure of the docking layout
            var layout = [{
                type: 'layoutGroup',
                orientation: 'horizontal',
                items: [{
                    type: 'tabbedGroup',
                    width: '20%',
                    items: [{
                        type: 'layoutPanel',
                        title: 'Solution Explorer',
                        contentContainer: 'SolutionExplorerPanel',
						initContent: function () {
                            // initialize a jqxTree inside the Solution Explorer Panel
                            var source = [{
                                icon: '../../images/earth.png',
                                label: 'Project',
                                expanded: true,
                                items: [{
                                    icon: '../../images/folder.png',
                                    label: 'css',
                                    expanded: true,
                                    items: [{
                                        icon: '../../images/nav1.png',
                                        label: 'jqx.base.css'
                                    }, {
                                        icon: '../../images/nav1.png',
                                        label: 'jqx.energyblue.css'
                                    }, {
                                        icon: '../../images/nav1.png',
                                        label: 'jqx.orange.css'
                                    }]
                                }, {
                                    icon: '../../images/folder.png',
                                    label: 'scripts',
                                    items: [{
                                        icon: '../../images/nav1.png',
                                        label: 'jqxcore.js'
                                    }, {
                                        icon: '../../images/nav1.png',
                                        label: 'jqxdata.js'
                                    }, {
                                        icon: '../../images/nav1.png',
                                        label: 'jqxgrid.js'
                                    }]
                                }, {
                                    icon: '../../images/nav1.png',
                                    label: 'index.htm'
                                }]
                            }];
                            $('#solutionExplorerTree').jqxTree({ source: source, width: '100%', height: '100%' });
                        }
                    }]
                },{
                    type: 'layoutGroup',
                    orientation: 'vertical',
                    width: '80%',
                    items: [{
                        type: 'documentGroup',
                        height: '100%',
                        minHeight: '25%',
                        items: [{
                            type: 'documentPanel',
                            title: 'Document 1',
                            contentContainer: 'Document1Panel'
                        }, {
                            type: 'documentPanel',
                            title: 'Document 2',
                            contentContainer: 'Document2Panel'
                        }]
                    }]
                }]
            }];
            $('#jqxDockingLayout').jqxDockingLayout({ width: '100%', height: '100%', layout: layout });
        });
    </script>
			<script>
                Wpng.App.controller('wpngController', function($scope) {
                    $scope.templateUrl = Wpng.BaseUrl + '?module=wpng&controller=wpng&action=showhand';
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