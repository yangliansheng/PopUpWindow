<?php
/**
 * Created by PhpStorm.
 * User: yls
 * Date: 2018/5/16
 * Time: 15:30
 */

namespace Bll\PopUpWindows;


class UserInfo
{

    /**
     * @var
     * 登录用户信息
     */
    public $UserInfo;

    /**
     * 用户ID
     * @var
     */
    public $Uid;
    
    /**
     * 用户实例
     * @var
     */
    public $User;

    public function __construct(/*用户模型*/User $user)
    {
        $this->User = $user;
        $this->UserInfo = $user->getUserInfo();
        $this->Uid = $user->u_id;
        //todo 实例模型验证
    }

    /**
     * 新用户还是老用户
     */
    public function isNewOrOld() {
        $userinfo = $this->UserInfo;
        if($userinfo) {
            //todo 新老用户界定时间
            $time1= '';
            //todo 用户注册时间
            $time2='';
            if(strtotime($time1)-strtotime($time2)<=0) {
                return ['new',$userinfo];
            }else{
                return ['old',$userinfo];
            }
        }else{
            return false;//新用户
        }
    }

    /**
     * 获取用户信息
     * @param $uid
     * @return array|mixed
     */
    public function getUserInfo() {
        return $this->UserInfo;
    }
    
    /**
     * 获取用户等级信息
     * @return array
     */
    public function getLevel() {
        //todo 用户等级
        return $this->User->getLevel();
    }
}