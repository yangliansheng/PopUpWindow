<?php
/**
 * Created by PhpStorm.
 * User: yls
 * Date: 2018/5/16
 * Time: 15:18
 */

namespace Bll\PopUpWindows;

/**
 * 展业金弹窗
 * Class WindowCard
 * @package Bll\PopUpWindows
 */
class WindowCard extends WindowBase
{

    /**
     * 用户id
     * @var
     */
    private $uid;

    /**
     * 配置属性
     * WindowCard constructor.
     */
    public function __construct(UserInfo $userInfo)
    {
        $this->type = 1;//常态类型
        $this->istitle = 0;//是否包含标题
        $this->popType = 4;//弹窗类型
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
        return false;
    }

    /**
     * 是否记录接口
     * @return mixed
     */
    public function isrecord(){
        return false;
    }

    /**
     * 记录日志接口
     * @return mixed
     */
    public function record(){}
}