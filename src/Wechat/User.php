<?php
/**
 * Created by PhpStorm.
 * User: 王越
 * Date: 2016/12/6
 * Time: 17:14
 */

namespace Wxapp\Wechat;

use Wxapp\Wechat\Encrypt\WXBizDataCrypt;

class User
{
    protected $app_id;
    protected $app_secret;

    public function __construct($app_id, $app_secret)
    {
        $this->app_id = $app_id;
        $this->app_secret = $app_secret;
    }

    public function decode($session_key, $encrypted_data, $iv)
    {
        $pc = new WXBizDataCrypt($this->app_id, $session_key);
        $err_code = $pc->decryptData($encrypted_data, $iv, $data);
        if ($err_code === 0) {
            return $data;
        }
        throw new Exception('', $err_code);
    }

}