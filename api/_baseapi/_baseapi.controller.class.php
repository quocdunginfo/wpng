<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 8:15 AM
 */
namespace Wpng;
Wpng::loadController(WPNG_MODULE, '_base');
class _BaseApiController extends _BaseController {
    function __construct(){
        if(!$this->isPublic()){
            if(!is_user_logged_in()){
                echo $this->defaultFormat('Unauthorized!');
                die(0);
            }
        }
    }
    protected function defaultFormat($result){
        header('Content-type: application/json');
        return json_encode(array('results' => $result));
    }
    public function get(){

    }
    protected function isPublic(){
        return false;
    }
}