<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 2:36 AM
 */
namespace Wpng;
Wpng::loadController(WPNG_MODULE, '_base');
class MenuController extends _BaseController {
    public function index(){
        $menu = array(
            array(
                'url' => SITECOOKIEPATH . '?module=wpng&controller=home&action=test',
                'caption' => '@Caption 1',
                'childs' => array(
                    array(
                        'url' => SITECOOKIEPATH . '?module=wpng&controller=home&action=test2',
                        'caption' => '@Caption 1.1',
                        'childs' => array(

                        )
                    ),
                    array(
                        'url' => SITECOOKIEPATH . '?module=wpng&controller=home&action=test3',
                        'caption' => '@Caption 1.2',
                        'childs' => array(

                        )
                    )
                )
            ),
            array(
                'url' => 'http://google.com',
                'external' => true,
                'target' => '_blank',
                'caption' => '@Google new Tab',
                'childs' => array(

                )
            )
        );
        $this->render(__FUNCTION__, $menu);
    }
}