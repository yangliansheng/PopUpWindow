<?php
/**
 * Created by PhpStorm.
 * User: yls
 * Date: 2018/5/16
 * Time: 14:30
 */

namespace Bll\PopUpWindows;


abstract class WindowBase implements WindowInterface
{
    /**
     * 类型 (1 常态类型 2 配置类型)
     * @var
     */
    protected $type;

    /**
     * 开始时间
     * @var
     */
    protected $timestart;

    /**
     * 结束时间
     * @var
     */
    protected $timeend;

    /**
     * 是否包含title
     * @var
     */
    protected $istitle;

    /**
     * 频次规则
     * @var
     */
    protected $popuprule;

    /**
     * 用户信息
     * @var
     */
    protected $userinfo;

    /**
     * 需要记录的弹窗类型: 0 版本更新弹窗 1 认证弹窗 2 APP活动弹窗 3 购物卡弹窗 4 展业金弹窗
     * @var
     */
    protected $popType;

    /**
     * 弹窗展示类型 1 弹出窗口 2 上浮栏目 3 游动浮窗（原点）
     * @var
     */
    protected $showType = 1;

    /**
     * 提醒模式 1时间周期 0永久提醒
     * @var
     */
    protected $remind_type = [
        '1时间周期' => 1,
        '0永久提醒' => 0,
    ];

    // 强制要求子类定义这些方法
//    abstract protected function getValue();

}