<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 3:28 AM
 */
namespace Wpng;
Wpng::loadView(WPNG_MODULE, '_base');
class MenuIndexView extends _BaseView {
    public function render($model) {
        $this->renderInPlaceHolder(function() use ($model){
            foreach ($model as $item){
                $this->renderMenuItem($item);
            }
        });
    }
    private function renderMenuItem($item){
        if(isset($item['childs']) && count($item['childs']) > 0){
            ?>
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Folder </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <?php
                    foreach ($item['childs'] as $child){
                        $this->renderMenuItem($child);
                    }
                    ?>
                </ul>
            </li>
            <?php
        }else{
            ?>
            <li class="">
                <a href="javascript:void(0)" data-url="<?php echo $item['url'] ?>">
                    <i class="menu-icon fa fa-caret-right"></i>
                    <?php echo $item['caption'] ?>
                </a>
                <b class="arrow"></b>
            </li>
            <?php
        }
    }
}