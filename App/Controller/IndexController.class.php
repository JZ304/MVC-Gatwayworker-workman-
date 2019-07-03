<?php
use GatewayClient\Gateway;

class IndexController extends ServiceController
{

    protected $db;
    protected $login;

    protected function _init()
    {
        header("Content-Type:text/html; charset=utf-8");
        date_default_timezone_set('Asia/Shanghai');
        $this->login = $_SESSION['isLogin'];
        $this->db = M();
    }

    /**
     * 首页授权 普通入口
     */
    public function IndexAction()
    {
        if (isset($this->login)) {
            $this->display('index');
        } else {
            $this->display('login');
        }

    }


    /*
	* 登录
	*/
    public function userLoginAction()
    {
        $account = $_POST['account'];
        $password = $_POST['password'];

        // 非空判断
        if (empty($account) || empty($password)) {
            return $this->errorResponse('账号密码不能为空');
        }

        // 判断账号正确性（先固定判断）
        if ($account == 'admin' && $password == 'admin') {
            $_SESSION['isLogin'] = 'admin';
            $this->login = $_SESSION['isLogin'];
            return $this->successResponse('登陆成功:' . $this->login);
        } else if ($account == 'summer' && $password == 'admin') {
            $_SESSION['isLogin'] = 'summer';
            $this->login = $_SESSION['isLogin'];
            return $this->successResponse('登陆成功:' . $this->login);
        } else {
            return $this->errorResponse('密码错误');
        }

    }


    /*
    * 登陆成功跳转页面
    */
    public function hrefIndexAction()
    {
        $this->isSetLogin();
        $this->display('index');

    }

    public function bindAction()
    {
        $this->isSetLogin();
        $client_id = $_POST['client_id'];
        $loginID = $this->login;
        // 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值(ip不能是0.0.0.0)
        Gateway::$registerAddress = '127.0.0.1:1238';

        Gateway::bindUid($client_id, $loginID);

        $data = json_encode(['type' => 'bind', 'message' => '绑定成功']);

        Gateway::sendToUid($loginID, $data);

        // 加入某个群组（可调用多次加入多个群组）
        Gateway::joinGroup($client_id, 'g5');
//        Gateway::sendToClient($client_id, $data);
    }


    public function sendMessageAction(){
        $this->isSetLogin();
        $user = $this->login;
        $contents = $_POST['content'];
        $data = json_encode(['type' => 'message','from' => $user , 'message' => $contents], JSON_UNESCAPED_UNICODE);
        // Gateway::sendToGroup('g5',$data);
        Gateway::$registerAddress = '127.0.0.1:1238';
        $loginID = $this->login;

        // 消息发送
        $accecpt = $user == 'admin' ? 'summer' : 'admin';
        Gateway::sendToUid($accecpt,$data);
    }


    /*
    * 身份验证--
    */
    private function isSetLogin()
    {
        if ( !isset($this->login)) {
            return $this->errorResponse('sorry!');
        }
    }
}
