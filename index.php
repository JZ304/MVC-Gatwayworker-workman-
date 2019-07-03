
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

include './SinglePHP.class.php';
// include './Autoloader.php';
require_once './vendor/autoload.php';
$config = array(
    'APP_PATH' => './App/', #APP业务代码文件夹
    'DB_HOST' => '120.76.60.159', #数据库主机地址
    'DB_PORT' => 3306, #数据库端口，默认为3306
    'DB_USER' => 'root', #数据库用户名
    'DB_PWD' => '123456', #数据库密码
    'DB_NAME' => 'data', #数据库名
    'DB_CHARSET' => 'utf8mb4', #数据库编码，默认utf8
    'PATH_MOD' => 'NORMAL', #路由方式，支持NORMAL和PATHINFO，默认NORMAL
    'USE_SESSION' => true, #是否开启session，默认false
    'SITE_URL' => 'https://h5.rzthinkmore.com/ak190615/', #活动站域名地址
    'APPID' => 'wx3401d384002e2b51', #微信AppID
    'APPSECRET' => '2ef20cdaf9c13d5b52f9a3004a3d00a2', #微信AppSecret
    'redirect_uri' => 'https://h5.rzthinkmore.com/ak190615/', #微信网页授权回调地址
    'REDIS_HOST' => 'r-wz995bda04e3e2d4.redis.rds.aliyuncs.com', #Redis主机地址
    'REDIS_PASSWORD' => 'Thinkmore2018', #Redis密码
    'REDIS_PORT' => '6379', #Redis默认端口
);
SinglePHP::getInstance($config)->run();
