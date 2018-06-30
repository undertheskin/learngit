<?php
$url = "http://gl.fhm520.com/index.php?mod=admin&act=login";
//$url = "http://gl.fhm520.com";
get_curlcontent($url);

function get_curlcontent($url,$url2='')
{
//    授权账号和密码
    $auth = "fhm520:fhm5208866123";
//    登陆账号和密码
    $post = [
        "username" => 'admin',
        "password" => "1",
        "stopoutenable" => "b3f02a02382573dcd33dc07a83b9a115",
        "seccode" => "ba85",
        "submit" => "登 陆"
    ];
    $dir = __DIR__ . "\baidu.html";
    $cookie_jar = tempnam('./temp','cookie');
//    初始化
    $ch = curl_init();
//    设置访问的url地址
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //设置文件读取并提交的cookie路径
    curl_setopt($ch, CURLOPT_USERPWD, $auth);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
    $filecontent=curl_exec($ch);
/*    $retinfo = curl_getinfo($ch);
    print_r($retinfo);*/
    curl_close($ch);
    echo $filecontent;die;

    $ch = curl_init();
    $hostname ="www.domain.com";
    //$referer="http://www.domain.com/";
    curl_setopt($ch, CURLOPT_URL, $url2);
    //curl_setopt($ch, CURLOPT_REFERER, $referer); // 看这里，你也可以说你从google来
    curl_setopt($ch, CURLOPT_USERAGENT, "www.domain.com");

    //$request = "JSESSIONID=abc6szw15ozvZ_PU9b-8r"; //设置POST参数
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    // 上面这句，当然你可以说你是baidu，改掉这里的值就ok了，可以实现小偷的功能，$_SERVER['HTTP_USER_AGENT']
    //你也可以自己做个 spider 了，那么就伪装这里的 CURLOPT_USERAGENT 吧
    //如果你要把这个程序放到linux上用php -q执行那也要写出具体的$_SERVER['HTTP_USER_AGENT']，伪造的也可以
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
    curl_setopt($ch, CURLOPT_HEADER, false);//设定是否输出页面内容
    curl_setopt($ch, CURLOPT_GET, 1); // post,get 过去

//
    $filecontent = curl_exec($ch);
    preg_match_all("/charset=(.+?)[NULL\"\']/is",$filecontent, $charsetarray);
    if(strtolower($charsetarray[1][0])=="utf-8")
    $filecontent=iconv( 'utf-8', 'gb18030//IGNORE' , $filecontent);
    curl_close($ch);
    return $filecontent;
}




?>

