<?php

class ServiceController extends BaseController
{
    protected $db;

    protected function _init()
    {
        date_default_timezone_set('Asia/Shanghai');
        $this->db = M();
    }


}
