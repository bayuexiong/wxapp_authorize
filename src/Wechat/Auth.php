<?php
/**
 * Created by PhpStorm.
 * User: 王越
 * Date: 2016/12/6
 * Time: 16:59
 */

namespace Wxapp\Wechat;

use Wxapp\Wechat\Util\Http;
use Wxapp\Wechat\Encrypt\ErrorCode;

/**
 * Class Auth
 * @package Wxapp\Wechat
 */
class Auth
{
    /**
     *
     */
    const API_SESSION_KEY = 'https://api.weixin.qq.com/sns/jscode2session';
    /**
     * @var
     */
    protected $app_id;
    /**
     * @var
     */
    protected $app_secret;
    /**
     * @var Http
     */
    protected $http;

    /**
     * Auth constructor.
     * @param $app_id
     * @param $app_secret
     */
    public function __construct($app_id, $app_secret)
    {
        $this->app_id = $app_id;
        $this->app_secret = $app_secret;
        $this->http = new Http();
    }

    /**
     * @param $code
     * @return mixed
     * @throws Exception
     */
    public function authorize($code)
    {
        $params = array(
            'appid'      => $this->app_id,
            'secret'     => $this->app_secret,
            'js_code'    => $code,
            'grant_type' => 'authorization_code',
        );
        $res = $this->http->get(static::API_SESSION_KEY, $params)->body;
        $data = json_decode($res, true);
        if ($data === null || !isset($data['openid'])) {
            throw new Exception('', ErrorCode::$NoGetSessionKey);
        }
        return $data;
    }

    /**
     * @param $session_key
     * @param $encrypted_data
     * @param $iv
     * @return mixed
     */
    public function getUser($session_key, $encrypted_data, $iv)
    {
        $user = new User($this->app_id, $this->app_secret);
        return $user->decode($session_key, $encrypted_data, $iv);
    }

}