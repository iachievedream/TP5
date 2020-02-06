<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/16 0016
 * Time: 15:56
 */
namespace app\index\Controller;
use think\Controller;
class Client extends Controller{
    const TOKEN = 'API';
    //模拟前台请求服务器api接口
    public function Index(){
        //时间戳
        $timeStamp = time();
        //随机数
        $randomStr = $this -> createNonceStr();
        // //生成签名
        $signature = $this -> arithmetic($timeStamp,$randomStr);
        //url地址
        $url = "http://fuwork.xyz/index/Server/respond?t={$timeStamp}&r={$randomStr}&ab={$signature}";
        
        //本機
        // $url = "http://localhost/tp5/public/index/Server/respond?t={$timeStamp}&r={$randomStr}&ab={$signature}";

        $result = $this -> httpGet($url);
        dump($timeStamp);
        dump($randomStr);
        dump($signature);
        dump($url);
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
    //随机生成字符串
    private function createNonceStr($length = 8) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return "z".$str;
    }
    /**
     * @param $timeStamp 时间戳
     * @param $randomStr 随机字符串
     * @return string 返回签名
     */
    private function arithmetic($timeStamp,$randomStr){
        $arr['timeStamp'] = $timeStamp;
        $arr['randomStr'] = $randomStr;
        $arr['token'] = self::TOKEN;
        //按照首字母大小写顺序排序
        sort($arr,SORT_STRING);
        //拼接成字符串
        $str = implode($arr);
        //进行加密
        $signature = sha1($str);
        $signature = md5($signature);
        //转换成大写
        $signature = strtoupper($signature);
        return $signature;
    }
}