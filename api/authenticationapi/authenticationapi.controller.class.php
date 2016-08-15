<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 13/8/16
 * Time: 8:18 AM
 */
namespace Wpng;
Wpng::loadApiController(WPNG_MODULE, '_baseapi');
class AuthenticationApiController extends _BaseApiController {
    public function checkLogin(){
        $request = $this->httpPostData();
        var_dump($request);
    }
}