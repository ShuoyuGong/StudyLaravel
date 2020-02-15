<?php
/**
 * Created by PhpStorm.
 * User: YiFeng
 * Date: 2019/4/18
 * Time: 13:27
 */

namespace App\Libs;


use Illuminate\Support\Facades\DB;

class Baidu
{
    public static $instance =null;
    private $key;
    private $domain;
    private $type="urls";
//    private $sendurl="";
    //禁外部实例化
    private function __construct()
    {
        if(!session()->has("key") || !session()->has("domain")){
            $config = DB::table('config')->where('name','=','baidu')->first();
            $config_baidu = json_decode($config->config,true);
            session()->put('key',$config_baidu['key']);
            session()->put('domain',$config_baidu['domain']);
        }
        $this->key = session("key");
        $this->domain = session("domain");
//        $this->sendurl="http://data.zz.baidu.com/".$this->type."?site=".$this->domain."&token=".$this->key;
    }
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
    //外部访问的统一入口
    public static function getInstance(){
        if(self::$instance instanceof self){
            return self::$instance;
        }
        return new self();
    }
    //推送
    public function baidusend($urls=null){
        if(is_null($urls)){
            $urls =[
                'http://www.yfketang.cn/course-show/9.html',
                'http://www.yfketang.cn/course-show/7.html'
            ];
        }
        return $this->dosend($urls);
    }
    //更新
    public function updatesend($urls=null){
        if(is_null($urls)){
            $urls =[
                'http://www.yfketang.cn/course-show/9.html',
                'http://www.yfketang.cn/course-show/7.html'
            ];
        }
        $this->type="update";
        return $this->dosend($urls);
    }
    //删除
    public function delsend($urls=null){
        if(is_null($urls)){
            $urls =[
                'http://www.yfketang.cn/course-show/9.html',
                'http://www.yfketang.cn/course-show/7.html'
            ];
        }
        $this->type="del";
        return $this->dosend($urls);
    }
    //百度推送
    private function dosend($urls){
        $api ="http://data.zz.baidu.com/".$this->type."?site=".$this->domain."&token=".$this->key;
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        $result =json_decode($result,true);
        if(array_key_exists('error',$result)){
            session()->forget("key");
            session()->forget("domain");
            return false;
        }
        if($result['success']>0){
            return true;
        }else{
            return false;
        }
    }
}

