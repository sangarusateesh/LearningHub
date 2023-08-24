<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest'){die();}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../sendemail/src/Exception.php';
require '../sendemail/src/PHPMailer.php';
require '../sendemail/src/SMTP.php';
require '../classes/cls.php';
class mailController extends Cls{
    public $postData;
    public $getData;
    public $session;
    public $user_id;
    public $role_id;
	public function __construct(){
		parent::__construct();
        $getData = filter_input_array(INPUT_GET);
        $postData = filter_input_array(INPUT_POST);
        if($postData){$this->postData = $postData;}
        $this->session = !empty($_SESSION[SESSION_VAR]) && !empty($_SESSION[SESSION_VAR]['govtschool']) ? $_SESSION[SESSION_VAR]['govtschool'] : '';
        $this->user_id = !empty($this->session)?$this->session['user_id']:'';
        $this->role_id = !empty($this->session)?$this->session['role_id']:'';
	}
	public function get($index = NULL){
        $get = $this->getData ? $this->getData : [];
        if($index){ return isset($get[$index])?$get[$index]:NULL;}
        return $get;
    }
    private function now(){
        return date("Y-m-d H:i:s");
    }
    public function post($index = NULL){
        $post = $this->postData ? $this->postData : [];
        if($index){ return isset($post[$index])?$post[$index]:NULL;}
        return $post;
    }

	/*
		SendingDailyUpdate() Method Start Here
		Added On 		: 2022-12-11
		Added By 		: Sateesh Sangaru
		Description 	: Sending a mail of daily report
		Status 			: Active
	*/
    public function SendingDailyUpdate(){
    	$data = $this->postData;
    	$date = isset($data['date'])?$data['date']:date('Y-m-d');
		$records = $this->get_records(['table'=>'daily_updates','where'=>"dou='$date' and status=1"]);
		$pdata = array();
		// print_r($records);die;
		$mail = new PHPMailer(true);
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		// $mail->Username = 'sangaru.satti@gmail.com';
		// $mail->Password = 'ywjwfpxpujbvywfj
		// ';
		$mail->Username = 'sateesh.sangaru@reconnectenergy.com';
		$mail->Password = 'Sateesh@1996';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;

		$mail->setfrom('sateesh.sangaru@reconnectenergy.com');
		$mail->addAddress('sateesh.sangaru@reconnectenergy.com');
		$mail->isHTML(true);

		$mail->Subject = "Daily Update On ".date("Y-M-d");
		$toMail = 'sangaru.satti@gmail.com';
		$subject = 'Daily Update';
		$headers = "From: sateesh.sangaru@reconnectenergy.com";
		$mailBody = 'Hi Sir,<br>';
		$mailBody.='Good Evening,<br>';
		$mailBody.='Today Update<br><br>';
		if($records){
		    foreach ($records as $key => $value) {
		        $pdata[$value['build']][] = $value;
		    }

			$mailBody .= '<table class="table table-bordered table-dark">';
	            $mailBody.='<tr>';
	                $mailBody.='<th>S.No</th>';
	                $mailBody.='<th>Build</th>';
	                $mailBody.='<th>Tool</th>';
	                $mailBody.='<th>Module</th>';
	                $mailBody.='<th>Issue</th>';
	                $mailBody.='<th>Modified Files</th>';
	                $mailBody.='<th>Description</th>';
	                $mailBody.='<th>Task Status</th>';
	            $mailBody.='</tr>';
	        	$mailBody.='<tbody>';
	                $c=1;
	                foreach($pdata as $pkey=>$precord){
	                    foreach($precord as $prkey=>$prvalue){
	                        $mailBody.='<tr>';
	                            $mailBody.='<td>'.$c++.'</td>';
	                            $mailBody.='<td>'.$prvalue['build'].'</td>';
	                            $mailBody.='<td>'.$prvalue['tool'].'</td>';
	                            $mailBody.='<td>'.$prvalue['module'].'</td>';
	                            $mailBody.='<td>'.$prvalue['issue'].'</td>';
	                            $mailBody.='<td>'.$prvalue['modified_files'].'</td>';
	                            $mailBody.='<td>'.$prvalue['description'].'</td>';
	                            $mailBody.='<td>'.($prvalue['task_status']==0?'Pending':($prvalue['task_status'] == 1?'Under Development':($prvalue['task_status'] == 2?'Completed':'Not Required'))).'</td>';
	                        $mailBody.='</tr>';
	                    }
	                }
	            $mailBody.='</tbody';
	        $mailBody .='</table><br>';
		}else{
			$mailBody .= $data['mailBody'].'<br><br>';
			// return ['status'=>'NOT OK','message'=>'Data Not Found for the Date: '.date("d-M-Y")];
		}
		$mail->Body = $mailBody.'Thanks&Regards<br>Sateesh Sangaru,<br>sateesh.sangaru@reconnectenergy.com.';
		$mailStatus = $mail->send();
		// print_r(['mailStatus'=>$mailStatus]);die;
		if($mailStatus){
			return ['status'=>'OK','message'=>'Mail Sent Successfully!.'];
		}else{
			return ['status'=>'NOT OK','message'=>'Failed to send a mail!.'];
		}
    }
}
$controller = new mailController();
$action = $controller->post('action');//echo $action;exit;error_log('actioning1: ' .$action);
if($action && method_exists($controller, $action)){error_log('actioning: ' .$action);
    $response = $controller->{$action}(); error_log("response:: ".gettype($response). ' :: ' . (gettype($response)=='array' ? json_encode($response):$response));
    if(gettype($response)=='array'){
        echo json_encode($response);
    }else{
        echo $response;
    }
}else{
    http_response_code(404);
}
?>