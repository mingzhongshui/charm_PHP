<?php 
namespace app\core;

use system\core\Controller;
/**
 * 公共控制器
 */
class Wb_Controller extends Controller
{

    public static $model;
    public function __construct() 
    {
        self::$model =& model();
        session_start();
        if(!isset($_SESSION['uid']) || empty($_SESSION['uid'])) {
            redirect('common/login');
        }
    }
}