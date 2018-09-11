<?php
/**
 * 中间弹窗实例
 * Created by PhpStorm.
 * User: yls
 * Date: 2018/5/22
 * Time: 10:15
 */

namespace Bll\PopUpWindows;


class CentreWindow extends PopupUser
{
    /**
     * 弹出形式类型
     * @var int
     */
    protected $showType = 0;//0 弹出窗口 1 上浮栏目 2 游动浮窗(原点)

    /**
     * 是否有关于频次的配置要求
     * @var int
     */
    protected $frequency = 1;//提醒频次 1 有要求 0无要求(按照每次启动)

    /**
     * 获取中间弹窗接口
     * @param $param
     * @return array|bool|mixed
     */
    public function popup($param)
    {
        if($this->showType != $this->show_type) {//如果代码问题类型不匹配(容错处理)
            return false;
        }
        $data = $this->getWindows($this->frequency);
        return $data?$data:false;
    }

    /**
     * 是否记录接口
     * @return mixed
     */
    public function isrecord($window){
        if($window['frequency'] == 0) {//0仅提醒一次
           return true;
        }
        if($window['frequency'] == 1) {//1每次启动
            return false;
        }
        if($window['frequency'] == 2) {//2每天启动
            return true;
        }
        if($window['frequency'] == 3) {//3间隔时长
            return true;
        }
    }
}