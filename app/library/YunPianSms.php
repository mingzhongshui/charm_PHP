<?php 
namespace app\library;

use system\core\Config;
use \Yunpian\Sdk\YunpianClient;
/**
 * 路由类
 */
class YunPianSms
{

	private static $_apiKey = '7faf9f11d8bd5f7d8e1ds339009be21aa9'; 
    private static $_ch;
    public function __construct(string $apiKey = '')
    {
        if ($_apiKey) {
            self::$_apiKey = $apiKey;
        }

        $this->init();
    }

	/**
	 * 生成验证码
	 * @param  integer $length 验证码长度
	 * @return string          验证码字符串
	 */
    public function createSmsCode($length = 6)
    {
        $min = pow(10, ($length -1));
        $max = pow(10, $length) -1;
        return rand($min, $max);
    }

    public function init()
    {
        self::$_ch = curl_init();

        /* 设置验证方式 */
        curl_setopt(self::$_ch, CURLOPT_HTTPHEADER, array('Accept:text/plain;charset=utf-8',
            'Content-Type:application/x-www-form-urlencoded', 'charset=utf-8'));

        /* 设置返回结果为流 */
        curl_setopt(self::$_ch, CURLOPT_RETURNTRANSFER, true);

        /* 设置超时时间*/
        curl_setopt(self::$_ch, CURLOPT_TIMEOUT, 10);

        /* 设置通信方式 */
        curl_setopt(self::$_ch, CURLOPT_POST, 1);
        curl_setopt(self::$_ch, CURLOPT_SSL_VERIFYPEER, false);

    }

    /**
     * 发送模板消息
     * @param  array  $data 数据
     */
    public function sendSmsTpl(array $data)
    {
         // 发送模板短信
        // 需要对value进行编码
        $data = array('tpl_id' => $data['tplId'], 'tpl_value' => ('#code#').
            '='.urlencode($data['code']).
            '&'.urlencode('#company#').
            '='.urlencode($data['company']), 'apikey' => self::$_apiKey, 'mobile' => $data['mobile']);
        
        if ($data['deBug'] == true) {
            dump($data);
        
        }
        return $this->tpl_send($data);
    }

    /**
     * 发哦是那个语音验证
     * @param  array  $data 验证信息
     * @remark $data = ['code' => '', 'mobile' => ''];
     * @return array        执行结果
     */
    public function sendSmsVoice(array $data)
    {
        $data['apikey'] = self::$_apiKey;
        // 发送语音验证码
        // $data=array('code'=>'9876','apikey'=>$apikey,'mobile'=>$mobile);
        $json_data = $this->voice_send($data);
        echo '<pre>';print_r($array);
        //初始化client,apikey作为所有请求的默认值
        $clnt = YunpianClient::create($apikey);
        dump($clnt);exit;
        $param = [YunpianClient::MOBILE => '18336344622',YunpianClient::TEXT => '【云片网】您的验证码是1234'];
        $r = $clnt->sms()->single_send($param);
        var_dump($r);
    }

    /**
     * 获取云片开发者信息
     * @return array 开发者信息数组
     */
    public function getUser(){
        curl_setopt (self::$_ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/user/get.json');
        curl_setopt(self::$_ch, CURLOPT_POSTFIELDS, http_build_query(array('apikey' => self::$_apiKey)));
        $result = curl_exec(self::$_ch);
        $error  = curl_error(self::$_ch);
        $this->checkErr($result, $error);

        return json_decode($result, true);
    }

    /**
     * 发送短信验证码
     * @param  string $text   短信内容
     * @param  string $mobile 手机号
     * @return array          执行结果
     */
    public function sendCode($text, $mobile){
        $sendData = [
            'apikey' => self::$_apiKey,
            'text'   => $text,
            'mobile' => $mobile
        ];
        curl_setopt(self::$_ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/single_send.json');
        curl_setopt(self::$_ch, CURLOPT_POSTFIELDS, http_build_query($sendData));
        $result = curl_exec(self::$_ch);
        $error  = curl_error(self::$_ch);
        $this->checkErr($result,$error);

        return json_decode($result, true);
    }

    public function tpl_send($data) {
        curl_setopt (self::$_ch, CURLOPT_URL, 
            'https://sms.yunpian.com/v2/sms/tpl_single_send.json');
        curl_setopt(self::$_ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec(self::$_ch);
        $error = curl_error(self::$_ch);
        $this->checkErr($result,$error);

        return json_decode($result, true);
    }

    public function voice_send($data) {
        curl_setopt (self::$_ch, CURLOPT_URL, 'http://voice.yunpian.com/v2/voice/send.json');
        curl_setopt(self::$_ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec(self::$_ch);
        $error  = curl_error(self::$_ch);
        $this->checkErr($result,$error);

        return json_decode($result, true);
    }

    public function notify_send($data) {
        curl_setopt (self::$_ch, CURLOPT_URL, 'https://voice.yunpian.com/v2/voice/tpl_notify.json');
        curl_setopt(self::$_ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec(self::$_ch);
        $error = curl_error(self::$_ch);
        $this->checkErr($result,$error);
        return $result;
    }

    public function checkErr($result,$error) {
        if($result === false) {
            echo 'Curl error: ' . $error;
        } else {
            //echo '操作完成没有任何错误';
        }
    }
}