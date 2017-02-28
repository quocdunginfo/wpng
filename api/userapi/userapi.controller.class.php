<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 8:18 AM
 */
namespace Wpng;
Wpng::loadApiController(WPNG_MODULE, '_baseapi');
class UserApiController extends _BaseApiController {
    public function getUsers(){
        $u = new \QdUser();
        $r = \QdUser::toJSON($u->GETLIST());
        echo $this->defaultFormat($r);
    }
    protected function isPublic(){
        return true;
    }
}