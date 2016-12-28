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
        $this->curl = curl_init();
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
     * @return object
     */
    public function get($url, $param = array(), $option = array())
    {
        return $this->request($url, self::GET, $param, $option);
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
        $param = $param ? http_build_query($param) : '';
        switch ($method) {
            case self::GET:
                $param && $url .= "?{$param}";
                break;
            case self::POST:
                curl_setopt($this->curl, CURLOPT_POST, 1);
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, $param);
                break;
        }
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HEADER, 0);
        return curl_exec($this->curl);
    }

    /**
     * @param $url
     * @param array $param
     * @param array $option
     * @return object
     */
    public function post($url, $param = array(), $option = array())
    {
        return $this->request($url, self::GET, $param, $option);
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }

}