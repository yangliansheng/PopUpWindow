<?php
/**
 * Created by PhpStorm.
 * User: yls
 * Date: 2018/5/16
 * Time: 9:12
 */
namespace Bll\PopUpWindows;


class Windows extends WindowBase
{
    /**
     * @var
     * 登录用户
     */
    protected $User;

    /**
     * 优先级类配置文件
     * @var
     */
    private $ListConfig;

    public function __construct($uid)
    {
        $this->ListConfig = require_once 'windowconfig.php';
        $User = User::getUser($uid);
        $this->User = new UserInfo($User);
    }

    /**
     * 弹出接口
     * @return mixed
     */
    public function popup($param){
        if($param['result_type'] == 'all') {
            $paramindex = $param;
            $paramindex['type'] = 0;
            $CentreWindow = $this->getWindow($paramindex);
            $paramFloat = $param;
            $paramFloat['type'] = 1;
            $FloatWindow = $this->getWindow($paramFloat);
            $paramSuspend = $param;
            $paramSuspend['type'] = 2;
            $SuspendWindow = $this->getWindow($paramSuspend);
            $data = [
                'Centre'=>$CentreWindow,
                'Float'=>$FloatWindow,
                'Suspend'=>$SuspendWindow
            ];
        }else{
            $data = $this->getWindow($param);
        }
        return $data;
    }

    /**
     * 根据弹窗展示类型获取弹窗
     * @param $param
     * @return array|mixed
     */
    protected function getWindow($param) {
        if($param['type'] == 0) {
            foreach ($this->ListConfig as $value) {
                $data = [];
                $window = new $value($this->User);
                if($window) {
                    $res = $window->popup($param);
                    if ($res){
                        $data = $res;
                        $rec = $window->isrecord();
                        if($rec) {
                            $window->record();
                        }
                        break;
                    }else{
                        continue;
                    }
                }
            }
        }else{
            $data = [];
            $window = new WindowAppActivity($this->User);
            if($window) {
                $res = $window->popup($param);
                if ($res){
                    $data = $res;
                    $rec = $window->isrecord();
                    if($rec) {
                        $window->record();
                    }
                }
            }
        }
        return $data;
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
    public function record(){
        return;
    }

}