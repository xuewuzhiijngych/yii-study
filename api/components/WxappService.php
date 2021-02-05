<?php

namespace api\components;

use GuzzleHttp\Client;

class WxappService
{
    protected array $data = [];
    protected string $serve_url = 'https://api.weixin.qq.com/sns/jscode2session?';

    public string $appkey;
    public string $secret;
    public string $grant_type;

    function __construct()
    {
        $wxapp = \Yii::$app->params['wxapp'];

        $this->appid = $wxapp['appid'];
        $this->secret = $wxapp['secret'];
        $this->grant_type = 'authorization_code';
    }

    /**
     * 微信小程序授权
     *
     * @param array $data
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function auth(array $data): \stdClass
    {
        $get = [
            'appid' => $this->appid,
            'secret' => $this->secret,
            'js_code' => $data['code'],
            'grant_type' => $this->grant_type,
        ];
        $client = new Client();
        $serve_url = "https://api.weixin.qq.com/sns/jscode2session?" . http_build_query($get);
        $response = $client->request('GET', $serve_url);
        return @json_decode($response->getBody());
    }

    /**
     * 微信小程序获取手机号
     *
     * @param array $data
     * @return string
     */
    public function getPhone(array $data): string
    {
        $encryptedData = $data['encryptedData'];
        $iv = $data['iv'];
        $sessionKey = $data['session_key'];
        if (strlen($sessionKey) != 24) {
            return [
                'status' => 0,
                'msg' => '手机号获取失败',
            ];
        }
        $aesKey = base64_decode($sessionKey);
        if (strlen($iv) != 24) {
            return [
                'status' => 0,
                'msg' => '手机号获取失败',
            ];;
        }
        $aesIV = base64_decode($iv);
        $aesCipher = base64_decode($encryptedData);
        $result = openssl_decrypt($aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);
        $dataObj = json_decode($result);
        if ($dataObj == NULL) {
            return [
                'status' => 0,
                'msg' => '手机号获取失败',
            ];;
        }
        if ($dataObj->watermark->appid != $this->appid) {
            return [
                'status' => 0,
                'msg' => '手机号获取失败',
            ];;
        }
        $result = json_decode($result, true);
        return $result['phoneNumber'];
    }
}