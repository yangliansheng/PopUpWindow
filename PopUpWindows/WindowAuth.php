<?php
/**
 * Created by PhpStorm.
 * User: yls
 * Date: 2018/5/16
 * Time: 15:18
 */

namespace Bll\PopUpWindows;

/**
 * 认证弹窗
 * Class WindowMallCard
 * @package Bll\PopUpWindows
 */
class WindowAuth extends WindowBase
{
    /**
     * 用户id
     * @var
     */
    private $uid;

    /**
     * 新老用户标识
     * @var
     */
    private $neworold;

    /**
     * 当前配置的认证配置数据
     * @var
     */
    protected $popup;

    /**
     * 配置属性
     * WindowAuth constructor.
     */
    public function __construct(UserInfo $userInfo)
    {
        $this->type = 1;//常态类型
        $this->istitle = 0;//是否包含标题
        $this->popType = 1;//弹窗类型
        if($userInfo->UserInfo) {
            $this->userinfo = $userInfo;
            $this->uid = $userInfo->Uid;
        }else{
            return false;
        }
    }

    /**
     * 获取新老用户、是否给出完善认证信息弹窗
     * 弹出接口
     * @return mixed
     */
    public function popup($param){
        //是否有相关配置
        $res = $this->getAuthConfig();
        if(!$res) {
            return false;
        }
        //类型为时间周期-如果超时或未到发布时间
        $this->popup = $res;
        //todo 弹窗给出业务
        $data = $res;
        return $data;
    }

    /**
     * 是否记录接口
     * @return mixed
     */
    public function isrecord(){
        if($this->neworold == 'new') {
            return false;
        }else{
            return true;
        }
    }

    /**
     * 记录日志接口
     * @return mixed
     */
    public function record(){
        //记录当前用户本次弹出记录
        $data = [
            'zp_id' => $this->popup['id'],
            'u_id' => $this->userinfo->Uid,
            'zp_name' => $this->popup['name'],
            'zp_type' => $this->popType,
            'zp_show_type' => 0,
            'created' => date("Y-m-d H:i:s"),
        ];
        $res = app('mysql')->insert('zs_popup_log', $data);
        return $res;
    }

    /**
     * 获取当前开启的认证弹窗配置
     * @return mixed
     */
    private function getAuthConfig(){
        $type = $this->popType;
        $sql = "SELECT * FROM zs_popup WHERE type = $type and is_open = 1";
        $resVer = app('mysql')->fetch($sql);
        return $resVer;
    }

    /**
     * 判断时间是否未开始或已经结束
     * @param $timestart
     * @param $timeend
     * @return bool
     */
    private function isTimeout($timestart, $timeend) {
        $timenow=time();//获取当天最后时间
        if(strtotime($timestart)-$timenow>0) {
            //如果开始时间大于当前时间
            return false;
        }elseif($timenow-strtotime($timeend)>0){
            return false;
        }else{
            return true;
        }
    }

    /**
     * 是否满足认证弹窗的要求
     * @return bool
     */
    private function isRangeTime() {
        //todo 处理认证验证
        return true;
    }
}