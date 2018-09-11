<?php
/**
 * Created by PhpStorm.
 * User: yls
 * Date: 2018/5/16
 * Time: 15:18
 */

namespace Bll\PopUpWindows;

/**
 * APP活动弹窗
 * Class WindowMallCard
 * @package Bll\PopUpWindows
 */
class WindowAppActivity extends WindowBase
{
    /**
     * 用户id
     * @var
     */
    protected $uid;

    /**
     * 当前配置的认证配置数据
     * @var
     */
    protected $popup;

    /**
     * 用户类对象
     * @var UserInfo
     */
    protected $user;

    /**
     * 当前实例的弹窗展示实例
     * @var
     */
    protected $Window;

    /**
     * 配置属性
     * WindowAppActivity constructor.
     */
    public function __construct(UserInfo $userInfo)
    {
        $this->type = 0;//后台配置类型
        $this->istitle = 0;//是否包含标题
        $this->popType = 2;//弹窗类型
        if($userInfo->UserInfo) {
            $this->user = $userInfo;
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
        $type = $param['type'];
        $this->showType = (int)$type;
        $Window = $this->AppActivityWindowFactory();
        if(!$Window) {
            return false;
        }
        $this->Window = $Window;
        $res = $Window->popup($param);
        if(!$res) {
            return false;
        }
        $this->popup = $res;
        $resData = [
            'remind_content' => $res['remind_content'],
            'bg_img' => $res['bg_img'],
            'jump_way' => $res['jump_way'],
            'url_h5' => $res['url_h5'],
            'android_url' => $res['android_url'],
            'ios_url' => $res['ios_url'],
            'show_time' => $res['show_time'],
        ];
        $data =  [
            'show_type'=> $this->showType, //展示类型 0 中间弹窗
            'content'=> $resData,
            'popup_type'=> $this->popType,//弹窗类型 0 版本更新
        ];

        return $data;
    }

    /**
     * 是否记录接口
     * @return mixed
     */
    public function isrecord(){
        return $this->Window->isrecord($this->popup);
    }

    /**
     * 记录日志接口
     * @return mixed
     */
    public function record(){
        //记录当前用户本次弹出记录
        $data = [
            'zp_id' => $this->popup['id'],
            'u_id' => $this->uid,
            'zp_name' => $this->popup['name'],
            'zp_type' => $this->popType,
            'zp_show_type' => $this->showType,
            'created' => date("Y-m-d H:i:s"),
        ];
        $res = app('mysql')->insert('zs_popup_log', $data);
        return $res;
    }

    /**
     * 实例活动弹窗对象
     * @return bool
     */
    public function AppActivityWindowFactory() {
        switch ($this->showType) {//0 弹出窗口 1 上浮栏目 2 游动浮窗（原点）
            case 0:{
                $classname = 'Bll\PopUpWindows\CentreWindow';
                break;
            }
            case 1:{
                $classname = 'Bll\PopUpWindows\FloatWindow';
                break;
            }
            case 2:{
                $classname = 'Bll\PopUpWindows\SuspendWindow';
                break;
            }
            default:{
                return false;
            }
        }
        return new $classname($this->user,$this->showType);
    }
}