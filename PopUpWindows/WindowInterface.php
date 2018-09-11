<?php
/**
 * Created by PhpStorm.
 * User: yls
 * Date: 2018/5/16
 * Time: 14:35
 */

namespace Bll\PopUpWindows;


interface WindowInterface
{
    /**
     * 弹出接口
     * @return mixed
     */
    public function popup($param);

    /**
     * 是否记录接口
     * @return mixed
     */
    public function isrecord();

    /**
     * 记录日志接口
     * @return mixed
     */
    public function record();
}