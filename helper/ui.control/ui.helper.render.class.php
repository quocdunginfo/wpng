<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 14/8/16
 * Time: 7:11 PM
 */
namespace Wpng;
Wpng::loadUIControl(WPNG_MODULE, 'form');
Wpng::loadUIControl(WPNG_MODULE, 'button');
Wpng::loadUIControl(WPNG_MODULE, 'textbox');
Wpng::loadUIControl(WPNG_MODULE, 'triggertextbox');
class UIRenderHelper{
    public static function render($control, $context = null, $getOutput = false){

        if ($control instanceof UIButton){
            if(!$context){
                self::renderButton($control);
            }else{
                if($context instanceof UIForm){
                    self::renderButtonInForm($control, $context);
                }
            }

            return;
        }
        if ($control instanceof UITriggerTextBox){
            if(!$context){
                self::renderTriggerTextBox($control);
            }else{
                self::renderTriggerTextBoxInForm($control, $context);
            }
            return;
        }
        if ($control instanceof UITextBox){
            if(!$context){
                self::renderTextBox($control);
            }else{
                self::renderTextBoxInForm($control, $context);
            }
            return;
        }
        if ($control instanceof UIForm){
            if(!$context){
                self::renderForm($control);
            }
            return;
        }
    }
    private static function renderForm($control){
        ?>
        <form
            class="form-horizontal <?php echo $control->class ?>"
            style="<?php echo $control->style ?>"
            id="<?php echo $control->id ?>"
            <?php if($control->ng_submit) : ?>
                ng-submit="<?php echo $control->ng_submit ?>"
            <?php endif; ?>
            <?php echo $control->attributes ?>
            >

            <?php
            for($i = 0; $i < count($control->controls); $i++){
                self::render($control->controls[$i], $control);
            }
            ?>
        </form>
        <?php
    }
    private static function renderButtonInForm($control, $context = null){
        if($control->control_length > 0){
            $control->class = array_merge($control->class, self::genResponsiveClass($control->control_length));
        }
        $labelClass = array();
        {
            $labelLength = 12 - $control->control_length;
            if ($labelLength > 0) {
                $labelClass = array_merge($labelClass, self::genResponsiveOffsetClass($labelLength));
            }
        }

        ?>
        <div class="form-group">
            <div class="<?php echo implode(' ', $labelClass) ?>">
                <?php self::renderButton($control) ?>
            </div>
        </div>
        <?php
    }
    private static function renderButton($control, $getOutput = false){
        ?>
        <button
            id="<?php echo $control->id ?>"
            type="<?php echo $control->button_type ?>"
            class="btn <?php echo implode(' ', $control->class) ?>"
            style=" <?php echo $control->style ?>"
            <?php echo $control->attributes ?>

            <?php if($control->ng_click): ?>
                ng-click="<?php echo $control->ng_click ?>"
            <?php endif; ?>

            <?php if($control->ng_show): ?>
                ng-show="<?php echo $control->ng_show ?>"
            <?php endif; ?>
            >
            <?php echo $control->label ?>
        </button>
        <?php
    }
    private static function genResponsiveClass($length){
        //$a = array('col-xs-','col-sm-','col-md-','col-lg-');
        $a = array('col-sm-');
        $class = array();
        foreach($a as $item){
            $class[] = $item . $length;
        }
        return $class;
    }
    private static function genResponsiveOffsetClass($length){
        //$a = array('col-xs-offset-','col-sm-offset-','col-md-offset-','col-lg-offset-');
        $a = array('col-sm-offset-');
        $class = array();
        foreach($a as $item){
            $class[] = $item . $length;
        }
        return $class;
    }
    private static function renderTextBoxInForm($control, $context = null){
        $labelClass = array('control-label');
        if($control->control_length > 0){
            $control->class = array_merge($control->class, self::genResponsiveClass($control->control_length));
        }
        {
            $labelLength = 12 - $control->control_length;
            if ($labelLength > 0) {
                $labelClass = array_merge($labelClass, self::genResponsiveClass($labelLength));
            }
        }
        ?>
        <div class="form-group">
            <label for="<?php echo $control->id ?>" class="<?php echo implode(' ', $labelClass) ?>">
                <?php echo $control->label ?>
                <?php if($control->required) {
                    echo '(*)';
                }
                ?>
            </label>
            <div class="<?php echo implode(' ', $control->class) ?>">
                <?php
                $control->class[] = 'form-control';
                self::renderTextBox($control);
                ?>
            </div>
        </div>
        <?php
    }
    private static function renderTextBox($control){
        ?>
        <input
            id="<?php echo $control->id ?>"
            class="<?php echo implode(' ', $control->class) ?>"
            style="<?php echo $control->style ?>"
            type="<?php echo $control->input_type ?>"
            <?php if($control->ng_model): ?>
            ng-model="<?php echo $control->ng_model ?>"
            <?php endif; ?>

            <?php if($control->ng_show): ?>
            ng-show="<?php echo $control->ng_show ?>"
            <?php endif; ?>

            placeholder="<?php echo $control->place_holder ?>"
            value="<?php echo $control->value ?>"

            <?php echo $control->attributes ?>

            <?php if($control->read_only): ?>
                readonly
            <?php endif; ?>

            <?php if($control->required): ?>
                required
            <?php endif; ?>
        >
        <?php
    }
    private static function renderTriggerTextBox($control){
        ?>
        <span class="input-icon input-icon-right">
            <?php static::renderTextBox($control) ?>
            <i class="ace-icon fa fa-leaf green"></i>
        </span>
        <?php
    }
    private static function renderTriggerTextBoxInForm($control){
        ?>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right">Input with Icon</label>

            <div class="col-sm-9">
                <div class="input-group">
                    <input class="form-control input-mask-product" type="text" id="form-field-mask-3">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-key"></i>
																</span>
                </div>
            </div>
        </div>
    <?php
    }
}