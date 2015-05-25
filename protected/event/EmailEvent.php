<?php
//include(Yii::app()->basePath.'/event/EventBase.php');
class EmailEvent extends EventBase
{
    public function exec() {
        echo "exec 1\n";

        $param = $this->param;
        $o = Yii::app()->MailSendCloud;
        // $flag = $o->sc_send('接口报警邮件', "EmailEvent接口请求过程出错！ 错误信息如下：err_no:'00000' err_msg:'测试队列'  请求参数为:'".json_encode($param)."'", $param['email']);
        //$flag = $o->sc_send($param['title'], $param['contents'], $param['email']);
        $flag['message'] = 'success';
        $flag['message'] = 'success1';
        if ($flag['message'] == 'success') {
            // 成功
            $param['status'] = 1;
        } else {
            // 失败 入库,重试机制还没想好.
            $param['status'] = 0;
            $this->event_rs['err_no'] = 100;
            $this->event_rs['err_msg'] = '发送邮件失败';
        }
        $param['create_time'] = time();
        $param['mobile'] = '';
        $message = new Messages();
        $message->attributes = $param;
// var_dump('execing', $param, $message);
        $rs = $message->insert();

        echo "exec 2\n";

        return $this->event_rs;
    }
}
