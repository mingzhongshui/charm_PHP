<?php 

namespace app\Controller;

use app\core\Home_Controller;
/**
 * 默认控制器
 */
class IndexController extends Home_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        $data['bankData']  = parent::$model->select('common', ['key', 'val'], ['type' => 'bank']);
        $data['quatoData'] = parent::$model->select('common', ['key', 'val'], ['type' => 'quato']);
		view('home/index', $data);
	}

    /**
     * 验证申请参数
     * @param  array $data 申请参数
     */
    private function _ckeckData($data)
    {
        if(empty($data['username'])) {
            ajaxReturn(202, '请输入姓名');
        }
        if(empty($data['phone'])) {
            ajaxReturn(202, '请输入手机号码');
        }else {
            if($this->checkPhoneNumber($data['phone']) == false) {
                ajaxReturn(202, '请填写正确的手机号码');
            }
        }
        if(empty($data['cardid'])) {
            ajaxReturn(202, '请输入身份证号码');
        }else{
            if($this->validation_filter_id_card($data['cardid']) == false) {
                ajaxReturn(202, '请填写真实的身份证号码');
            }
        }
        if(empty($data['address'])) {
            ajaxReturn(202, '请输入地址');
        }
        if(empty($data['bank'])) {
            ajaxReturn(202, '请选择申请银行');
        }

        if(empty($data['quato'])) {
            ajaxReturn(202, '请选择申请额度');
        }
    }

    /**
     * 提交申请
     */
    public function submitApplication()
    {
        $postData = post();
        $this->_ckeckData($postData);

        $postData['time'] = time();
        $postData['ip']   = getIp();

        parent::$model->insert('order', $postData);
        if(parent::$model->id()) {
            ajaxReturn(200);
        }else {
            ajaxReturn(202, '申请失败');
        }
    }
}