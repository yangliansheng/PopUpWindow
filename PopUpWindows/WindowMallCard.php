<?php
/**
 * Created by PhpStorm.
 * User: yls
 * Date: 2018/5/16
 * Time: 15:18
 */

namespace Bll\PopUpWindows;


/**
 * 购物卡弹窗
 * Class WindowMallCard
 * @package Bll\PopUpWindows
 */
class WindowMallCard extends WindowBase
{
    /**
     * 弹出的购物卡列表
     * @var array
     */
    private $MallCards = [];

    /**
     * 用户id
     * @var
     */
    private $uid;

    /**
     * 配置属性
     * WindowMallCard constructor.
     */
    public function __construct(UserInfo $userInfo)
    {
        $this->type = 1;//常态类型
        $this->istitle = 0;//是否包含标题
        $this->popType = 3;//弹窗类型
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
    }

    /**
     * 是否记录接口
     * @return mixed
     */
    public function isrecord(){
        return true;
    }

    /**
     * 记录日志接口
     * @return mixed
     */
    public function record(){
    }
}