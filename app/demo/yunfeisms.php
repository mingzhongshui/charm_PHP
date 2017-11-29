<?php 
namespace app\demo;

use system\core\Config;
use \Yunpian\Sdk\YunpianClient;
/**
 * 路由类
 */
class YunFeiSms
{
	
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

	public function sendSms()
    {
        $apikey = "xxxxxxx"; //修改为您的apikey(https://www.yunpian.com)登录官网后获取
        $mobile = "xxxxxx"; //请用自己的手机号代替
        $text = "【命中水的博客】您的验证码是". $this->createSmsCode() ."。如非本人操作，请忽略本短信";
        // $text =  ;
        $ch = curl_init();

        /* 设置验证方式 */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:text/plain;charset=utf-8',
            'Content-Type:application/x-www-form-urlencoded', 'charset=utf-8'));
        /* 设置返回结果为流 */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        /* 设置超时时间*/
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        /* 设置通信方式 */
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // 取得用户信息
        $json_data = $this->get_user($ch,$apikey);
        $array = json_decode($json_data,true);

        dump($array);
        // echo '<pre>';print_r($array);

        // 发送短信
        $data=array('text'=>$text,'apikey'=>$apikey,'mobile'=>$mobile, 'tpl_id' => 'xxxx');
        dump($data);
        $json_data = $this->send($ch,$data);
        $array = json_decode($json_data,true);

        dump($array);exit;
        // echo '<pre>';print_r($array);

        // 发送模板短信
        // 需要对value进行编码
        $data = array('tpl_id' => '1', 'tpl_value' => ('#code#').
            '='.urlencode('1234').
            '&'.urlencode('#company#').
            '='.urlencode('欢乐行'), 'apikey' => $apikey, 'mobile' => $mobile);
        print_r ($data);
        $json_data = $this->tpl_send($ch,$data);
        $array = json_decode($json_data,true);

        dump($array);exit;
        // echo '<pre>';print_r($array);

        // // 发送语音验证码
        // $data=array('code'=>'9876','apikey'=>$apikey,'mobile'=>$mobile);
        // $json_data = voice_send($ch,$data);
        // $array = json_decode($json_data,true);
        // echo '<pre>';print_r($array);
        // //初始化client,apikey作为所有请求的默认值
        // $clnt = YunpianClient::create($apikey);
        // dump($clnt);exit;
        // $param = [YunpianClient::MOBILE => '18336344600',YunpianClient::TEXT => '【云片网】您的验证码是1234'];
        // $r = $clnt->sms()->single_send($param);
        // var_dump($r);
    }


    public function get_user($ch,$apikey){
        curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/user/get.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('apikey' => $apikey)));
        $result = curl_exec($ch);
        $error = curl_error($ch);
        $this->checkErr($result,$error);
        return $result;
    }
    public function send($ch,$data){
        curl_setopt ($ch, CURLOPT_URL, 'https://sms.yunpian.com/v2/sms/single_send.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($ch);
        $error = curl_error($ch);
        $this->checkErr($result,$error);
        return $result;
    }
    public function tpl_send($ch,$data){
        curl_setopt ($ch, CURLOPT_URL, 
            'https://sms.yunpian.com/v2/sms/tpl_single_send.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($ch);
        $error = curl_error($ch);
        $this->checkErr($result,$error);
        return $result;
    }
    public function voice_send($ch,$data){
        curl_setopt ($ch, CURLOPT_URL, 'http://voice.yunpian.com/v2/voice/send.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($ch);
        $error = curl_error($ch);
        $this->checkErr($result,$error);
        return $result;
    }
    public function notify_send($ch,$data){
        curl_setopt ($ch, CURLOPT_URL, 'https://voice.yunpian.com/v2/voice/tpl_notify.json');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($ch);
        $error = curl_error($ch);
        $this->checkErr($result,$error);
        return $result;
    }

    public function checkErr($result,$error) {
        if($result === false)
        {
            echo 'Curl error: ' . $error;
        }
        else
        {
            //echo '操作完成没有任何错误';
        }
    }
}