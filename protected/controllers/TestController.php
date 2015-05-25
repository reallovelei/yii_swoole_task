<?php 
	class TestController extends Controller{
		
		public function actionIndex(){
			$request = Yii::app()->request;
            $project_id = $request->getParam('project_id');
            $uid = $request->getParam('uid');
            $money = $request->getParam('money');
            $arr_inveset_detail = $this->rpc('project/Rpctest', array('project_id'=>$project_id,'uid'=>$uid,'money'=>$money));
   			print_r($arr_inveset_detail);
            die;
		}
		
		
		
		public function actionDES256(){
/* 			{"errorCode":"LAZ36T1LyLZwV8sH4vx4fg==",
			"errorMessage":"zn3BA6Yyun5aw/38XlCCTQ==",
			"ckm":"818063545460210c016147e015c3bf647e124eb71f491b8b635277f6c4b824ff"
			} */
			$ckm = "818063545460210c016147e015c3bf647e124eb71f491b8b635277f6c4b824ff";
			$data['errorMessage'] = "zn3BA6Yyun5aw/38XlCCTQ==";
			$data['errorCode']  ="LAZ36T1LyLZwV8sH4vx4fg==";
			$check_res = Aes256Model::checkAes256($ckm, $data);
			print_r($check_res);
			
		}
		
		
		
		/**
		 * @desc 检测渠道号or邀请码
		 */
		public function checkChannelOrCode($src_code=0){
			$partern = "/^([A-Za-z]{2})+(\d{4,12})/";
			return preg_match($partern,$src_code);
		}
		/**
		 * test
		 */
		public function actionLLPayRequest(){
		
		//$card_no ="6225880165157638"; //test right
		$card_no ="62258805565157630"; //test error
		$user_info = array(
				'no'=>"15001196383",
				'dt_register'=>"1427255732",
				'name'=>"徐春迎",
				'credentials_no'=>"411081198605084078",
		);
		$good_info = array(
				'user_id'=>"15001196383",
				'name'=>"TT_good",
				'price'=>"0.10",
			
		);
		$card_no = "";
		//检查参数是否合法
		if(empty($card_no)){
			
		}
		//支付
		$LLpay_result = LianlianPaymentModel::lianLianPay($user_info, $good_info, $card_no);
		var_dump($LLpay_result);
		
	}
	public function actionRs(){
		$lianlian_response = file_get_contents("php://input");
		Yii::log("LLpay_rs=>".$lianlian_response);
/* 		$Post_data =  json_decode($lianlian_response,true);
		print_r($Post_data);
		die("testpay"); */
	}
	public function actionTT(){
        $message['uid'] = 2;
        $message['email'] = 'zhanglei@dmgcf.com';
        $message['title'] = '接口报警邮件';
        $message['contents'] = "'EmailEvent'接口请求过程出错！ 错误信息如下：err_no:'00000' err_msg:'测试队列' 请求参数为:'[]'";
        $message['type'] = 2;

        $data['param'] = $message;
        $data['class'] = 'Email';
        $client = new EventClient();
        $data = $client->send($data);

var_dump($data);   die;

		$response = array(
				'ret_code'=>"0000",
				'ret_msg'=>"交易成功"
		);
		//$aes256_res = Aes256Model::reponse_ckm_aes256($response);  //通知连连不用再发送请求
		$res_json = CJSON::encode($response);
		die($res_json);
	}
		
	}
?>
