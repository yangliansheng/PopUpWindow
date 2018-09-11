<?php
/**
 * 处理不同类型的用户获取不同弹出位置弹窗业务
 * Created by PhpStorm.
 * User: yls
 * Date: 2018/5/22
 * Time: 11:06
 */

namespace Bll\PopUpWindows;


class PopupUser
{
    /**
     * 用户id
     * @var
     */
    protected $uid;

    /**
     * 用户类对象
     * @var UserInfo
     */
    protected $user;

    /**
     * 用户等级
     * @var
     */
    protected $userLevel;

    /**
     * 新老用户标识 新用户new老用户old
     * @var
     */
    protected $neworold;

    /**
     * 用户服务等级
     * @var
     */
    protected $userVipLevel;

    /**
     * 活动弹窗类型
     * @var
     */
    protected $show_type;

    /**
     * 弹窗类型
     * @var int
     */
    protected $popType;

    /**
     * 绑定用户信息与活动弹窗类型
     * PopupUser constructor.
     * @param UserInfo $userInfo
     * @param $type
     */
    public function __construct(UserInfo $userInfo, $type)
    {
        $this->show_type = $type;
        $this->user = $userInfo;
        $this->uid = $userInfo->Uid;
        $this->neworold = $userInfo->isNewOrOld();
        $this->userVipLevel = $userInfo->getLevel();
        $this->userLevel = $userInfo->getLevel();
        $this->popType = 2;//弹窗类型
    }

    /**
     * 基础类型的获取弹窗业务给予其他业务参考
     * @return array|mixed
     */
    public function getWindows($frequency) {
        //首先获取全部用户都需要弹出的活动弹窗
        $data = [];
        $AllData = $this->getWindowsAllUser();
        if(!$AllData) {
            return $data;
        }
        //处理用户当前满足弹窗人群要求的弹窗
        foreach ($AllData as $key=>$value){
            if($value['start_time']&&$value['end_time']){//如果配置了活动开始结束时间
                if(!$this->isTimeout($value['start_time'],$value['end_time'])) {//弹窗活动是否超时
                    continue;
                }
            }
            if($frequency) {
                if($this->isLog($value)) {//当前用户在弹出频次要求内是否弹出过当前活动弹窗
                    continue;
                }
            }
            //当前活动满足弹出频次--获取满足用户条件的所有活动弹窗
            if($value['user_type'] == 0) {
                $data[] = $value;
                continue;
            }else{
                if($this->isAllowUser($value)) {
                    $data[] = $value;
                    continue;
                }
            }
        }
        if($data) {
            $data = $data[0];//如果出现多个满足的弹窗给出第一个
        }
        return $data;
    }

    /**
     * 当前活动弹窗是否满足用户条件
     */
    protected function isAllowUser($value){
        $res = false;
        if(!$value || !isset($value['user_type'])) {
            return $res;
        }
        $arr = explode(',',$value['user_type']);
        if($this->neworold == 'new' && in_array(3,$arr)) {
            $res = true;
        }
        if($this->neworold == 'old' && in_array(4,$arr)) {
            $res = true;
        }
        if($this->userVipLevel >=2 && in_array(2,$arr)) {
            $res = true;
        }
        if($this->userVipLevel <2 && in_array(1,$arr)) {
            $res = true;
        }
        return $res;
    }

    /**
     * 获取当前活动弹窗位置的开启的活动弹窗
     * @return array
     */
    protected function getWindowsAllUser() {
        $sql = "SELECT * FROM zs_popup WHERE type = $this->popType  and is_open = 1 and show_type = $this->show_type ORDER BY created DESC";
        $resVer = app('mysql')->select($sql);
        if(count($resVer)) {
            return $resVer;
        }else{
            return [];
        }
    }

    /**
     * 当前用户在弹出频次要求内是否弹出过当前活动弹窗
     * @return bool
     */
    protected function isLog($window) {
        $timestart = date('Y-m-d 00:00:00');
        $timeend = date('Y-m-d 23:59:59');
        $uid = $this->uid;
        $zp_id = $window['id'];
        $type = $this->popType;
        $show_type = $this->show_type;
        if($window['frequency'] == 0) {//0仅提醒一次
            $sql = "SELECT * FROM zs_popup_log WHERE zp_type = $type and zp_show_type = $show_type and u_id = $uid and zp_id = $zp_id";
            $logs = app('mysql')->fetch($sql);
        }
        if($window['frequency'] == 1) {//1每次启动
            return false;
        }
        if($window['frequency'] == 2) {//2每天启动
            $sql = "SELECT * FROM zs_popup_log WHERE zp_type = $type and zp_show_type = $show_type and u_id = $uid and created >='$timestart' and created<='$timeend' and zp_id = $zp_id";
            $logs = app('mysql')->fetch($sql);
        }
        if($window['frequency'] == 3) {//3间隔时长
            $time = date("Y-m-d H:i:s", (time() - 3600 * (int)$window['frequency_interval']));
            $sql = "SELECT * FROM zs_popup_log WHERE zp_type = $type and zp_show_type = $show_type and u_id = $uid and created >='$time' and zp_id = $zp_id";
            $logs = app('mysql')->fetch($sql);
        }
        if($logs) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * 判断时间是否未开始或已经结束
     * @param $timestart
     * @param $timeend
     * @return bool
     */
    protected function isTimeout($timestart, $timeend) {
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

}