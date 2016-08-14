<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 14/8/16
 * Time: 7:11 PM
 */
Wpng::loadUIControl('form');
Wpng::loadUIControl('button');
Wpng::loadUIControl('textbox');
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
        if ($control instanceof UITextBox){

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
        $class = '';
        if($control->control_length > 0){
            $class .= ' col-sm-' . $control->control_length;
        }
        {
            $label_length = 12 - $control->control_length;
            if ($label_length > 0) {
                $class .= ' col-sm-offset-' . $label_length;
            }
        }

        ?>
        <div class="form-group">
            <div class="<?php echo $class ?>">
                <?php self::renderButton($control) ?>
            </div>
        </div>
        <?php
    }
    private static function renderButton($control, $getOutput = false){
        ?>
        <button
            id="<?php echo $control->id ?>"
            type="button"
            class="btn <?php echo $control->class ?>"
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
}