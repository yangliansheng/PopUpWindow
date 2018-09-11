<?php
/**
 * Created by PhpStorm.
 * User: yls
 * Date: 2018/5/16
 * Time: 15:18
 */

namespace Bll\PopUpWindows;

/**
 * 版本更新弹窗
 * Class WindowMallCard
 * @package Bll\PopUpWindows
 */
class WindowVersion extends WindowBase
{
    /**
     * 当前配置的版本更新数据
     * @var
     */
    protected $popup;

    /**
     * 配置属性
     * WindowMallCard constructor.
     */
    public function __construct(UserInfo $userInfo)
    {
        $this->type = 1;//常态弹窗
        $this->istitle = 0;//是否给出标题
        $this->popType = 0;//弹窗类型
        if($userInfo->UserInfo) {
            $this->userinfo = $userInfo;
            $this->uid = $userInfo->Uid;
        }else{
            return false;
        }
    }

    /**
     * 弹出接口
     * @return mixed
     */
    public function popup($param){
        return ;
    }

    /**
     * 是否记录接口
     * @return mixed
     */
    public function isrecord(){
        return true;//需要记录频次每天一次
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
        $res = app('mysqlinsuerhelper')->insert('zs_popup_log', $data);
        return $res;
    }

    /**
     * 判断当前版本是否小于版本阀值
     * @param $appVersion
     * @param $versionLimit
     * @return bool
     */
    private function versionCompare($appVersion, $versionLimit) {
        return false;
    }

    /**
     * 当前用户当天是否弹出过版本更新弹窗
     * @return bool
     */
    private function isLog() {
        //判断当前用户是否弹出过版本更新弹窗
        return false;
    }
}