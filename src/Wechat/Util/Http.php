<?php
/**
 * Created by PhpStorm.
 * User: 王越
 * Date: 2016/12/6
 * Time: 17:00
 */

namespace Wxapp\Wechat\Util;


/**
 * Class Http
 * @package Wxapp\Wechat\Util
 */
class Http
{
    /**
     *
     */
    const GET = 'GET';
    /**
     *
     */
    const POST = 'POST';
    /**
     *
     */
    const PUT = 'PUT';
    /**
     *
     */
    const PATCH = 'PATCH';
    /**
     *
     */
    const DELETE = 'DELETE';

    /**
     * @var
     */
    protected $curl;

    /**
     * @var array
     */
    protected $header = array();

    /**
     * Http constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $head
     * @return $this
     */
    public function setHeader($head)
    {
        $this->header = array_merge($this->header, $head);
        return $this;
    }

    /**
     * @param $url
     * @param array $param
     * @param array $option
     */
    public function get($url, $param = array(), $option = array())
    {
        $this->request($url, self::GET, $param, $option);
    }

    /**
     * @param $url
     * @param $method
     * @param $param
     * @param $option
     * @return \Requests_Response
     */
    public function request($url, $method, $param, $option)
    {
        return \Requests::request($url, $this->header, $param, $method, $option);
    }

    /**
     * @param $url
     * @param array $param
     * @param array $option
     */
    public function post($url, $param = array(), $option = array())
    {
        $this->request($url, self::GET, $param, $option);
    }

}