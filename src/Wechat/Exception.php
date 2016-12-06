<?php
/**
 * Created by PhpStorm.
 * User: 王越
 * Date: 2016/12/6
 * Time: 17:39
 */

namespace Wxapp\Wechat;

use Wxapp\Wechat\Encrypt\ErrorCode;


/**
 * Class Exception
 * @package Wxapp\Wechat
 */
class Exception extends \Exception
{

    protected $errors = array();

    /**
     * Exception constructor.
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code = -1)
    {
        $this->errors = array(
            ErrorCode::$OK                => '请求成功',
            ErrorCode::$NoGetSessionKey   => '获取session_key失败',
            ErrorCode::$IllegalAesKey     => 'session_key非法',
            ErrorCode::$IllegalIv         => 'iv非法',
            ErrorCode::$DecodeBase64Error => 'base64解密失败',
            ErrorCode::$IllegalBuffer     => '解码后得到的base64非法'
        );
        $message = empty($this->errors[$code]) ? $message : $this->errors[$code];
        $message = "[Wechat]{$message}";
        parent::__construct($message, $code);

    }

}