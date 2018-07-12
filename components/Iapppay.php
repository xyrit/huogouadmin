<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/12/17
 * Time: 下午5:43
 */
namespace app\components;

use yii\base\Component;

class Iapppay extends Component
{

    public $cpvkey = 'MIICWwIBAAKBgQCKDZ8f/3yYfXIxlVi65cPAefk78OPDBgWexUo8/eSkKcWI4X5tsnqMWtcZ9cQzpGW3FjIzHxM7NlhmgMgudX1KwSR/jwRZUBW9+P+rd4jE2LuXskJvyVT2u/o58Uh6Zzb9Wo5UKWfIEZe5aXqdmXTSSkgmttwlaxoihIqEfu9P8QIDAQABAoGAJilFx06UXoKuwk4KTP+ecOJGpu8bxpkvjIf00Y9NWKPDWucaT7B6d7nUo/Rv2+ahx053afI5GrEXFp6at1z62Pr11TbRySahTnw1SbemKqQizubC2ZBs53NC1p80GlqzbTI2Int4pB2TgoHvYboaFxtsGtlfE5RWNr6kL2OJM8ECQQDK9NRDJx3gtmFCrS2a+4iYAJH7J/wUK8DX9xO38QUj23fLsX2DzgAHsG4JNdNjzAjH3MCBLkKc+LAYethZKrj9AkEAriJTrIkRQwXBP4K8iLoyVBkXx+xESzLvO4leYW+D+fagcM0O7DZcRXxZQrx1EAQ6FcpUGdeH+nolpkv0nbRvBQJAXatnd+LK2FZ0Rxi0Tq4+maDRvy/yGMEkzMf88s0rSSRWgs1VF4rw2puj/V45RPr7JnsM4dIe7mGcrH+t8GFWZQJAGTnT0UzR+VmeEytHUK9YlyJDdazef95TFdbim07iWZXGzFCIduOxHkfTTn2qn7VdDMcQw+WbR0fmqF6cgzQeWQJAAbT11KUxG+nJ4C4vgTByirTrWbJgAtPQj0RxnX9aRFcAuRzxJ5rtkRU0BbqohtQRJqR0UvZXN5EdPVYdfG4Iuw==';

    public $platpkey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCWDXaGN2sjXl6VouBHyP/hVcyuKcwIj98IElPbpIv8ueVYNcAKLtWzqEnrojL/Xsym7UuAdlpmmGr4bXmKSdrw5fZzQ6HcKm9rOl75L6bbtzjYTOD9G6AAKUcdrZn6w5NDQOhYvusiUb7LBDkOxa7kgGmLGSCZ4tEKBWlQufgegwIDAQAB';

    public $appid = '3003377542';//应用编号



    public $tokenCheckUrl = 'http://ipay.iapppay.com:9999/openid/openidcheck';

    public $orderUrl = 'http://ipay.iapppay.com:9999/payapi/order';

    public $h5Url = 'https://web.iapppay.com/h5/exbegpay';

    /**
     * @param $goodsName
     * @param $goodsId
     * @param $orderId
     * @param $price
     * @param $cpprivateinfo
     * @param $notifyUrl
     * @return bool
     */
    function createOrder($userId,$goodsName,$goodsId,$orderId,$price,$cpprivateinfo,$notifyUrl)
    {
        //下单接口
        $orderReq["appid"] = "{$this->appid}";
        $orderReq["waresid"] = intval($goodsId);//商品编号
        $orderReq["waresname"] = $goodsName;//商品名称
        $orderReq["cporderid"] = "$orderId";//商户订单号
        $orderReq["price"] = floatval(sprintf('%.2f',$price));   //单位：元
        $orderReq["currency"] = "RMB";
        $orderReq["appuserid"] = "$userId";//应用userid
        $orderReq["cpprivateinfo"] = "$cpprivateinfo";//商户私有信息，支付完成后发送支付结果通知时会透传给商户
        $orderReq["notifyurl"] = "$notifyUrl";//商户服务端接收支付结果通知的地址
        //组装请求报文
        $reqData = $this->composeReq($orderReq, $this->cpvkey);

        //发送到爱贝服务后台请求下单
        $respJson = $this->httpPost($this->orderUrl, $reqData, '');
        if (!$respJson) {
            return false;
        }
        $transid = isset($respJson['transid']) ? $respJson['transid'] : false;
        return $transid;
    }

    //此为H5 调收银台时需要的参数组装函数
    function h5PayUrl($transid,$redirectUrl,$cpUrl = '') {
        //下单接口
        $orderReq["transid"] = "$transid";
        $orderReq["redirecturl"] = $redirectUrl;//回调URL
        $orderReq["cpur"] = $cpUrl;//返回商户URL
        //组装请求报文
        $reqData = $this->composeReq($orderReq, $this->cpvkey);
        return $this->h5Url . '?' . $reqData;

    }

    /**格式化公钥
     * $pubKey PKCS#1格式的公钥串
     * return pem格式公钥， 可以保存为.pem文件
     */
    function formatPubKey($pubKey)
    {
        $fKey = "-----BEGIN PUBLIC KEY-----\n";
        $len = strlen($pubKey);
        for ($i = 0; $i < $len;) {
            $fKey = $fKey . substr($pubKey, $i, 64) . "\n";
            $i += 64;
        }
        $fKey .= "-----END PUBLIC KEY-----";
        return $fKey;
    }


    /**格式化私钥
     * $priKey PKCS#1格式的私钥串
     * return pem格式私钥， 可以保存为.pem文件
     */
    function formatPriKey($priKey)
    {
        $fKey = "-----BEGIN RSA PRIVATE KEY-----\n";
        $len = strlen($priKey);
        for ($i = 0; $i < $len;) {
            $fKey = $fKey . substr($priKey, $i, 64) . "\n";
            $i += 64;
        }
        $fKey .= "-----END RSA PRIVATE KEY-----";
        return $fKey;
    }

    /**RSA签名
     * $data待签名数据
     * $priKey商户私钥
     * 签名用商户私钥
     * 使用MD5摘要算法
     * 最后的签名，需要用base64编码
     * return Sign签名
     */
    function sign($data, $priKey)
    {
        //转换为openssl密钥
        $res = openssl_get_privatekey($priKey);

        //调用openssl内置签名方法，生成签名$sign
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_MD5);

        //释放资源
        openssl_free_key($res);

        //base64编码
        $sign = base64_encode($sign);
        return $sign;
    }

    /**RSA验签
     * $data待签名数据
     * $sign需要验签的签名
     * $pubKey爱贝公钥
     * 验签用爱贝公钥，摘要算法为MD5
     * return 验签是否通过 bool值
     */
    function verify($data, $sign, $pubKey)
    {
        //转换为openssl格式密钥
        $res = openssl_get_publickey($pubKey);

        //调用openssl内置方法验签，返回bool值
        $result = (bool)openssl_verify($data, base64_decode($sign), $res, OPENSSL_ALGO_MD5);

        //释放资源
        openssl_free_key($res);

        //返回资源是否成功
        return $result;
    }


    /**
     * 解析response报文
     * $content  收到的response报文
     * $pkey     爱贝平台公钥，用于验签
     * $respJson 返回解析后的json报文
     * return    解析成功TRUE，失败FALSE
     */
    function parseResp($content, $pkey, &$respJson)
    {
        $arr = array_map(create_function('$v', 'return explode("=", $v);'), explode('&', $content));
        foreach ($arr as $value) {
            $resp[($value[0])] = urldecode($value[1]);
        }

        //解析transdata
        if (array_key_exists("transdata", $resp)) {
            $respJson = json_decode($resp["transdata"],true);
        } else {
            return FALSE;
        }

        //验证签名，失败应答报文没有sign，跳过验签
        if (array_key_exists("sign", $resp)) {
            //校验签名
            $pkey = $this->formatPubKey($pkey);
            return $this->verify($resp["transdata"], $resp["sign"], $pkey);
        } else if (!array_key_exists("errmsg", $respJson)) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * curl方式发送post报文
     * $remoteServer 请求地址
     * $postData post报文内容
     * $userAgent用户属性
     * return 返回报文
     */
    function request_by_curl($remoteServer, $postData, $userAgent)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remoteServer);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }


    /**
     * 组装request报文
     * $reqJson 需要组装的json报文
     * $vkey  cp私钥，格式化之前的私钥
     * return 返回组装后的报文
     */
    function composeReq($reqJson, $vkey)
    {
        //获取待签名字符串
        $content = json_encode($reqJson);
        //格式化key，建议将格式化后的key保存，直接调用
        $vkey = $this->formatPriKey($vkey);

        //生成签名
        $sign = $this->sign($content, $vkey);

        //组装请求报文，目前签名方式只支持RSA这一种
        $reqData = "transdata=" . urlencode($content) . "&sign=" . urlencode($sign) . "&signtype=RSA";

        return $reqData;
    }

    //发送post请求 ，并得到响应数据  和对数据进行验签
    function httpPost($url, $reqData, $userAgent = '')
    {
        $respData = $this->request_by_curl($url, $reqData, $userAgent);
        $notifyJson = '';
        if (!$this->parseResp($respData, $this->platpkey, $notifyJson)) {
            return false;
        }
        return $notifyJson;
    }


}