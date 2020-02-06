<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/16 0016
 * Time: 15:56
 */
namespace app\index\Controller;
use think\Controller;
 
class Line extends Controller{
    const TOKEN = 'API';
    //模拟前台请求服务器api接口
    public function getDataFromServer(){
        //时间戳
        $response_type = 'code';
        $client_id = '1648220216';
        $redirect_uri = '1648220216';
        $state = 'abcde';
        $scope = 'openid%20profile';

        // $url = "https://iachievedream.000webhostapp.com/TP5/public/index.php/index/Server/respond?t={$timeStamp}&r={$randomStr}&ab={$signature}";
        //本機
        $url = "https://api.line.me/oauth2/v2.1/token?response_type={$response_type}&client_id={$client_id}&redirect_uri={$redirect_uri}&state={$state}&scope={$scope}";

        $result = $this -> httpGet($url);
        dump($result);

    }
    //curl模拟get请求。
    private function httpGet($url){
        $curl = curl_init();
 
        //需要请求的是哪个地址
        curl_setopt($curl,CURLOPT_URL,$url);
        //表示把请求的数据已文件流的方式输出到变量中
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
 
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
}
