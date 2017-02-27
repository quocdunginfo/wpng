<?php

/**
 * Created by PhpStorm.
 * User: quocd_000
 * Date: 09/02/2015
 * Time: 10:45 PM
 */
class QdRootReport extends QdRoot
{
    public function fn_get_reporturl($location, $params = array()){
        if (!$this->checkPermission(__FUNCTION__)) return false;

        return array('reporturl' => $this->getReportURL());
    }
    protected function getReportURL(){
        return 'http://example.com';
    }
}