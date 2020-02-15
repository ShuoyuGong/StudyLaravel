<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    // 站点配置界面
    public function siteconfig(){
        $config = $this->getConfig("siteconfig");
        return view("admin.config.siteconfig")->with('config',$config);
    }

    // 基本信息配置界面
    public function information(){
        $config = $this->getConfig("information");
        return view("admin.config.information")->with('config',$config);
    }

    // 百度推送配置界面
    public function baidu(){
        $config = $this->getConfig("baidu");
        return view("admin.config.baidu")->with('config',$config);
    }

    //数据入库
    public function store(Request $request){
        $this->checkdata($request->name,$request);
        $data = $request->only('name','title');
        $conifg = json_encode($request->except('name','title','_token'));
        $data['config']=$conifg;
        $data['created_at']=date("Y/m/d H:i:s",time());
        $data['updated_at']=date("Y/m/d H:i:s",time());
        $config = DB::table("config")->where('name','=',$request->name)->first();
        if($config){
            $result = DB::table('config')->where('name','=',$request->name)->update($data);
        }else{
            $result = DB::table('config')->insert($data);
        }
        if($result===true || $result>0){
            session()->flash("data",['class'=>'success','msg'=>"更新成功"]);
        }else{
            session()->flash("data",['class'=>'danger','msg'=>"更新失败"]);
        }
        return redirect(route('admin.config.'.$request->name));
    }

    private function checkdata($name ="siteconfig",$request){
        switch ($name){
            case "information":
                $datavalidate = $request->validate([
                    'company' =>'required',
                    'address'=>'required',
                    'phone'=>'required'
                ],[
                    'company.required'=>"公司名称不能为空",
                    'address.required'=>"公司地址不能为空",
                    'phone.required'=>'客服热线不能为空',
                ]);
                break;
            case "baidu":
                $datavalidate = $request->validate([
                    'key' =>'required'
                ],[
                    'key.required'=>"密钥不能为空"
                ]);
                break;
            default:
                $datavalidate = $request->validate([
                    'name' =>'required',
                    'title'=>'required',
                    'sitetitle'=>'required',
                    'domain'=>'required|url'
                ],[
                    'name.required'=>"配置标识不能为空",
                    'title.required'=>"配置名称不能为空",
                    'sitetitle.required'=>'网站名称不能为空',
                    'domain.required'=>'网站域名不能为空',
                    'domain.url'=>'网址输入不正确',
                ]);
                break;
        }
    }
//    根据配置标识获取配置信息
    private function getConfig($name = "siteconfig"){
        $res_config = DB::table("config")->where('name','=',$name)->first();
        $config=[];
        if($res_config){
            $config = json_decode($res_config->config,true);
        }
        return $config;
    }
}
