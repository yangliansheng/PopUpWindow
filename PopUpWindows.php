<?php

namespace controller\API;
use Bll\PopUpWindows\Windows;//使用业务层封装

/**
 * 弹窗接口控制器
 * Class PopUpWindows
 * @package controller\API
 */
class PopUpWindows extends \controller\API\ApiBase
{
    /**
     * 获取弹窗
     */
    public function getPopup() {
        $uid = (int)app()->request->params('uid');
        if (empty($uid)) {
            $uid = (int)app()->request->params('userid');
        }
        if (empty($uid)) {
            $this->outMsgA('', 1, '参数有误');
        }
        $window = new Windows($uid);
        $data = $window->popup($this->data);
        if($data) {
            foreach ($data as &$datum) {
                if($datum === null) {
                    $datum = '';
                }
            }
            $this->outMsgA($data);
        }else{
            $this->outMsgA($data,0,'未获取到弹窗');
        }
    }
    
    /**
     * 响应结果JSON化
     * @param array $data
     * @param int $code
     * @param string $msg
     */
    protected function outMsgA($data = array(), $code = 0, $msg = '')
    {
        if (!is_array($data) && !is_object($data)) {
            $data = array($data);
        }
        $info = [
            'message' => $msg,
            'code'    => $code,
            'data'    => $data,
        ];
        app()->response->header('Content-Type', 'application/json');
        echo json_encode($info);
        app()->stop();
    }
}