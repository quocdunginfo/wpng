<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 3:28 AM
 */
namespace Wpng;
Wpng::loadView(WPNG_MODULE, '_base');
class WpmediaIndexView extends _BaseView {
    public function render($model) {
        $this->renderInPlaceHolder(function() use ($model){
            ?>

            <div>
                Toolbar here for selection...
            </div>
            <iframe src="<?php echo 'http://localhost:8056/wpng/wp-admin/upload.php' ?>"
                    frameborder="0"
                    style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;position:absolute;top:50px;left:0px;right:0px;bottom:0px"
                    height="100%"
                    width="100%" />
            <?php
        });
    }
}