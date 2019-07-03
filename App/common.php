<?php

//二维数组根据制定键值排序,默认升序(ASC),降序(DESC)
function arrOrder($arr, $key, $order = 'ASC')
{
    $tempArr = array();
    foreach ($arr as $k => $r) {
        $tempArr[$k] = $r[$key];
    }
    if ('ASC' == $order) {
        asort($tempArr);
    } else {
        arsort($tempArr);
    }
    reset($tempArr);
    $newArr = array();
    foreach ($tempArr as $k => $r) {
        $newArr[$k] = $arr[$k];
    }
    return $newArr;
}

function getOpenID($code)
{
    $appid = C('APPID');
    $appsecret = C('APPSECRET');
    $access_token = "";

    $access_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";

    $access_token_json = https_request($access_token_url);
    $access_token_array = json_decode($access_token_json, true);
    $access_token = $access_token_array['access_token'];
    $openid = $access_token_array['openid'];

    $errcode = $access_token_array['errcode'];
    if (isset($errcode)) {
        exit("授权出错！code：" . $errcode);
    }

    return $openid;
}

function getUserInfo($code)
{
    $appid = C('APPID');
    $appsecret = C('APPSECRET');
    $access_token = "";

    $access_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";

    $access_token_json = https_request($access_token_url);
    $access_token_array = json_decode($access_token_json, true);
    $access_token = $access_token_array['access_token'];
    $openid = $access_token_array['openid'];


    // var_dump($access_token_array);

    // $access_token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

    // $access_token_json = https_request($access_token_url);
    // $access_token_array = json_decode($access_token_json, true);
    // $access_token = $access_token_array['access_token'];

    $userinfo_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";

    $userinfo_json = https_request($userinfo_url);
    $userinfo_array = json_decode($userinfo_json, true);
    $errcode = $userinfo_array['errcode'];
    if (isset($errcode)) {
        $this->redirect("http://h5.rzthinkmore.com/xxw180601/index.php");//如果授权失败，重定向
    }
    // Log::warn("微信授权得到的信息：".print_r($userinfo_array,1));
//    var_dump($userinfo_array);
    // var_dump($userinfo_array);exit();

    return $userinfo_array;
}

function https_request($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    if (curl_errno($curl)) {
        return 'ERROR ' . curl_error($curl);
    }
    curl_close($curl);
    return $data;
}

/**
 * utf-8 转unicode
 *
 * @param string $name
 *
 * @return string
 */
function utf8_unicode($name)
{
    $name = iconv('UTF-8', 'UCS-2', $name);
    $len = strlen($name);
    $str = '';
    for ($i = 0; $i < $len - 1; $i = $i + 2) {
        $c = $name[$i];
        $c2 = $name[$i + 1];
        if (ord($c) > 0) {   //两个字节的文字
            $str .= '\u' . base_convert(ord($c), 10, 16) . str_pad(base_convert(ord($c2), 10, 16), 2, 0, STR_PAD_LEFT);
            //$str .= base_convert(ord($c), 10, 16).str_pad(base_convert(ord($c2), 10, 16), 2, 0, STR_PAD_LEFT);  
        } else {
            $str .= '\u' . str_pad(base_convert(ord($c2), 10, 16), 4, 0, STR_PAD_LEFT);
            //$str .= str_pad(base_convert(ord($c2), 10, 16), 4, 0, STR_PAD_LEFT);  
        }
    }
    $str = strtoupper($str);//转换为大写  
    return $str;
}

/**
 * unicode 转 utf-8
 *
 * @param string $name
 *
 * @return string
 */
function unicode_decode($name)
{
    $name = strtolower($name);
    // 转换编码，将Unicode编码转换成可以浏览的utf-8编码  
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $name, $matches);
    if (!empty($matches)) {
        $name = '';
        for ($j = 0; $j < count($matches[0]); $j++) {
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0) {
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code) . chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $name .= $c;
            } else {
                $name .= $str;
            }
        }
    }
    return $name;
}

/**
 * 生成图片
 */
function touchImg($base64_source)
{
    //判断图片base64格式,并截取扩展名
    $pattern = '/^data:image\/(?<ext>jpeg|png|gif|jpg);base64,(?<source>\S+)/';
    if (!preg_match($pattern, $base64_source, $match) || !base64_decode($match['source']))
        return false;

    //扩展名
    if (($match['ext'] != 'png' && $match['ext'] != 'gif' && $match['ext'] != 'jpg') || $match['ext'] == 'jpeg')
        $match['ext'] = 'jpg';

    //图片名称
    $img_name = md5(microtime(true) . mt_rand(1000, 9999)) . '.' . $match['ext'];

    //获取图片的服务器地址，以及存入数据库地址
    $data_path = 'uploads/';

    //生成图片
    file_put_contents($data_path . $img_name, base64_decode($match['source']));

    return $data_path . $img_name;
}

?>
