<?php 
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest'){die();}
require '../classes/cls.php';
class AjaxController extends Cls {
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
        dailUpdateForm() Method Start Here
        Added On        : 2022-12-11
        Added By        : Sateesh Sangaru
        Description     : Adding for creating the daily report what i did
        Status          : Active
    */
    public function dailUpdateForm(){
        $data = $this->postData;
        $id = !empty($data['id'])?$data['id']:'';
        $pdata = [
            'dou'               => $data['dou'],
            'build'             => $data['build_name'],
            'tool'              => $data['tool'],
            'module'            => $data['module'],
            'issue'             => $data['issue'],
            'modified_files'    => $data['modifiedFiles'],
            'description'       => $data['description'],
            'task_status'       => $data['taskStatus']
        ];
        if($id){
            $pdata['updated'] = $this->now();
            if($this->update_data(['table'=>'daily_updates','where'=>"id='$id'",'data'=>$pdata])){
                return ['status'=>'OK'];
            }
        }else{
            $pdata['now'] = $this->now();
            if($this->insert_data(['table'=>'daily_updates','data'=>$pdata])){
                return ['status'=>'OK','msg'=>'Daily Update of Date:'.date("d-M-Y",strtotime($data['dou'])).' was sent successfully!.'];
            }
        }
    }
    /* dailUpdateForm() Method End Here */


    public function employeeForm(){
        $data = $this->postData;
        $id = !empty($data['id'])?$data['id']:'';
        if(empty($data['address']) || empty($data['blood_group']) || empty($data['contact']) || empty($data['designation']) || empty($data['dob']) || empty($data['doj']) || empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL) || empty($data['name'])){return ['error'=>'Please enter all * mandatory fields.'];}
        $pdata = [
            'employee_name' => $data['name'],
            'designation'   => $data['designation'],
            'dob'           => $data['dob'],
            'doj'           => $data['doj'],
            'blood_group'   => $data['blood_group'],
            'email'         => $data['email'],
            'phone'         => $data['contact'],
            'address'       => $data['address'],
            'id_proof'      => $data['idproof']
        ];
        if(isset($_FILES['proofimg']) && $_FILES['proofimg']['error']==0){
            $pimage = $_FILES['proofimg'];
            $o_file=time().'.';
            $temp_name=$pimage["tmp_name"];
            $mime_type = self::getMimeType($temp_name);
            if(!empty($mime_type) && self::isImage($temp_name,$mime_type)){
                if ($pimage['size'] > 5*1024*1024) {
                    return ["error"=>"Image size exceeded 5mb."];
                }else{
                    $filename= self::renameFile($o_file,$mime_type);
                    self::createDuplicate($temp_name, '../uploads/employee/'.$id.'/'.$filename);
                    $pdata['proofimg']=$filename;
                }
            }else{
                return ['status'=>"invalid file format."];
            }
        }
        if($id){
            $pdata['updated'] = $this->now();
            if($this->update_data(['table'=>'employees','where'=>"id='$id'",'data'=>$pdata])){
                return ['status'=>'OK'];
            }
        }else{
            $pdata['insert_date'] = $this->now();
            if($this->insert_data(['table'=>'employees','data'=>$pdata])){
                return ['status'=>'OK','msg'=>'New Employee added successfully!.'];
            }
        }
    }

    /*
        deleteRecord() Method Start Here
        Added On        : 2022-12-11
        Added By        : Sateesh Sangaru
        Description     : Adding for Deleting the records of every module dynamically bassed on cat value
        Status          : Active
    */
    public function deleteRecord(){
        $data = $this->postData;
        $id = !empty($data['id'])?$data['id']:'';
        if(empty($data['cat']) || !$id){return ['error'=>'Invalid Data!.'];}
        if($data['cat']=='employee'){
            if($this->delete_record(['table'=>'employees','where'=>"id='$id'"])){
                return ['status'=>'OK','msg'=>'Employee Deleted Successfully!.'];
            }
        }
        if($data['cat']=='user'){
            if($this->delete_record(['table'=>'users','where'=>"id='$id'"])){
                return ['status'=>'OK','msg'=>'User Deleted Successfully!.'];
            }
        }
        if($data['cat']=='daily_update'){
            if($this->delete_record(['table'=>'daily_updates','where'=>"id='$id'"])){
                return ['status'=>'OK','msg'=>'Daily Update Deleted Successfully!.'];
            }
        }
    }
    /* deleteRecord() Method End Here */

    /*
        statusChange() Method Start Here
        Added On        : 2022-12-11
        Added By        : Sateesh Sangaru
        Description     : Adding for Changing the status of every module data dynamically based on cat value
        Status          : Active
    */
    public function statusChange(){
        $data = $this->postData;
        $id = !empty($data['id'])?$data['id']:'';
        if(empty($data['cat']) || empty($id) || empty($data['status'])){return ['Invalid Data., Please try again.'];}
        $pdata = [
            'status'    => $data['status'] == 'Disable'?0:1,
            'updated'   => $this->now()
        ];
        if($data['cat']=='employee'){
            $status = $pdata['status']==1?'Employee activated Successfully!.':'Employee De-activated successfully!.';
            if($this->update_data(['table'=>'employees','data'=>$pdata,'where'=>"id='$id'"])){
                return ['status'=>'OK','msg'=>$status];
            }
        }else if($data['cat']=='user'){
            $status = $pdata['status']==1?'User activated Successfully!.':'User De-activated successfully!.';
            if($this->update_data(['table'=>'users','data'=>$pdata,'where'=>"id='$id'"])){
                return ['status'=>'OK','msg'=>$status];
            }
        }else if($data['cat'] == 'daily_update'){
            $status = $pdata['status']==1?'Daily Update activated Successfully!.':'Daily Update successfully!.';
            if($this->update_data(['table'=>'daily_updates','data'=>$pdata,'where'=>"id='$id'"])){
                return ['status'=>'OK','msg'=>$status];
            }
        }
        
    }
    /* statusChange() Method End Here */
    public function registerForm(){
        $data = $this->postData;
        if(empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL) || empty($data['name']) || empty($data['contact']) || empty($data['dob']) || empty($data['address']) || empty($data['gender'])){return ['error'=>'Please enter all * Mandatory fields.'];}
        $record = $this->get_record(['table'=>'users','where'=>"email like '".$data['email']."'"]);
        if($record){return ['error'=>'This Email Address already exists., try anpther Email!.'];}
        $pdata = [
            'name'          => $data['name'],
            'role'          => 3,
            'email'         => $data['email'],
            'mobile'        => $data['contact'],
            'address'       => $data['address'],
            'date_of_birth' => $data['dob'],
            'gender'        => $data['gender']=='male'?1:($data['gender']=='female'?2:1),
            'insert_date'   => $this->now()
        ];
        $id = $this->insert_data(['table'=>'users','data'=>$pdata]);error_log($id);
        if(!file_exists("../uploads/employee/".$id)){
            mkdir(__DIR__."/../uploads/employee/".$id,0777);
        }
        if(isset($_FILES['sign']) && $_FILES['sign']['error']==0){
            $pimage = $_FILES['sign'];
            $o_file=time().'.';
            $temp_name=$pimage["tmp_name"];
            $mime_type = self::getMimeType($temp_name);
            if(!empty($mime_type) && self::isImage($temp_name,$mime_type)){
                if ($pimage['size'] > 5*1024*1024) {
                    return ["error"=>"Image size exceeded 5mb."];
                }else{
                    $filename= self::renameFile($o_file,$mime_type);
                    self::createDuplicate($temp_name, '../uploads/employee/'.$id.'/'.$filename);
                    $pdata['signature']=$filename;
                }
            }else{
                return ['status'=>"invalid file format."];
            }
        }
        if(isset($_FILES['profileimg']) && $_FILES['profileimg']['error']==0){
            $pimage = $_FILES['profileimg'];
            $o_file=time().rand(1,999).'.';
            $temp_name=$pimage["tmp_name"];
            $mime_type = self::getMimeType($temp_name);
            if(!empty($mime_type) && self::isImage($temp_name,$mime_type)){
                if ($pimage['size'] > 5*1024*1024) {
                    return ["error"=>"Image size exceeded 5mb."];
                }else{
                    $filename= self::renameFile($o_file,$mime_type);
                    self::createDuplicate($temp_name, '../uploads/employee/'.$id.'/'.$filename);
                    $pdata['profile_picture']=$filename;
                }
            }else{
                return ['status'=>'OK','msg'=>'Registration completed successfully and Approval is pending!.'];
            }
        }
        if($this->update_data(['table'=>'users','data'=>$pdata,'where'=>"id='$id'"])){error_log(15);
            return ['status'=>'OK','msg'=>'Profile Updated Successfully!.'];
        }
    }
    public function registerationForm(){
        $data = $this->postData;
        if(empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL) || empty($data['name']) || empty($data['contact']) || empty($data['dob']) || empty($data['address']) || empty($data['gender'])){return ['error'=>'Please enter all * Mandatory fields.'];}
        $record = $this->get_record(['table'=>'users','where'=>"email like '".$data['email']."'"]);
        if($record){return ['error'=>'This Email Address already exists., try anpther Email!.'];}
        $pdata = [
            'name'          => $data['name'],
            'role'          => 3,
            'email'         => $data['email'],
            'mobile'        => $data['contact'],
            'address'       => $data['address'],
            'date_of_birth' => $data['dob'],
            'gender'        => $data['gender']=='male'?1:($data['gender']=='female'?2:1),
            'insert_date'   => $this->now()
        ];
        if($this->insert_data(['table'=>'users','data'=>$pdata])){
            return ['status'=>'OK','msg'=>'Profile Updated Successfully!.'];
        }
    }
    public static function rand_password($length = 6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }
    public function loginForm(){
        $data = $this->postData;
        $referer = $_SERVER['HTTP_REFERER'];
        $url = preg_replace('#\/[^/]*$#', '', $referer);//print_r($url);exit;
        if(empty($data['password']) || empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)){return ['error'=>'Please enter login Credentials!.'];}
        $record = $this->get_record(['table'=>'users','where'=>"email like '".$data['email']."'"]);
        if(!$record){return ['error'=>'Sorry You\'re not registered withus.'];}
        if($record['status']!=1){return ['error'=>'Sorry your account is inactive.,Please contact admin.'];}
        if($record['password']!=md5($data['password'])){return ['error'=>'Invalid Email/Password'];}
        $_SESSION[SESSION_VAR]['user']['user_id'] = $record['id'];
        $_SESSION[SESSION_VAR]['user']['role_id'] = $record['role'];//return $record;
        $redirect_url = $url.'/'.($record['role']==3?'profile.php':'profile.php');
        return ['status'=>'OK','redirect'=>$redirect_url];
    }
    public function forgotPassword(){
        $data = $this->postData;
        $email = !empty($data['email']) ? filter_var(trim($data['email']), FILTER_VALIDATE_EMAIL) : '';
        if(!$email){return ['error'=>'Please Enter Valid Email id.'];}
        $record = $this->get_record(['table'=>'users',"where"=>"email like '$email'"]);
        if(!$record){return ['error'=>'This Email id Not Exists.'];}
        if(!in_array($record['role'],[1,2,3])){return ['error'=>'Invalid Email/Password.'];}
        if($record['status'] != '1'){return ['error'=>'Sorry, Your account is inactive.'];}
        $newpassword = self::rand_password();
        if(!$newpassword){return ['error'=>'Internal server error, Please Try Again.'];}
        if(!$this->update_data(['table'=>'users','data'=>['password'=>md5($newpassword),'updated'=> $this->now()],'where'=>"email like '$email'"])){return ['status'=>'Internal server error, Please Try Again.'];}
        $subjecttouser = 'Password Reset confirmation from '.SITE_NAME;
        $messagetouser = '<p>Dear User,</p><br>
                            <p>Your password has been reset Successfully.<br><br>
                            <p>Please use below details for login to your account.</p><br><br>
                            <table>
                                <tr><td width="20%"><b>Email:</b></td><td width="30%">' . $email . '</td></tr>
                                <tr><td><b>New Password:</b> </td><td>' . $newpassword . '</td></tr>
                                <tr><td colspan="2"></td></tr>
                            </table>
                            <br>
                        <p>Please contact us for further assistance.</p><br>
                        <p><a href="'.SITE_URL.'/admin/login" target="_blank">Click here for Login</a></p><br><br>
                        ---
                        <p>Admin,</p>
                        <p>'.SITE_NAME.'</p>';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.SITE_NAME.' <'.SERVER_EMAIL.'>' . "\r\n";
        $headers .= 'Reply-To: '.SITE_NAME.' <'.CONTACT_EMAIL.'>' . "\r\n";
        $mailstatus = mail($email, $subjecttouser, $messagetouser, $headers);
        if($mailstatus){return ['status'=>'OK','msg'=>'Please check your Email.'];}else{return ['error'=>'Internal server error, Please Try Again.'];}
    }
    public function changePassword(){
        $data = $this->postData;
        $id = !empty($data['id'])?$data['id']:'';
        if(!$id){return ['error'=>'Invalid Data!.'];}
        if(empty($data['npassword']) || empty($data['cnfpassword'])){return ['error'=>'Please enter all * mandatory fields.'];}
        if($data['npassword']!=$data['cnfpassword']){return ['error'=>'Password and Confirm Password must be same.'];}
        $record = $this->get_record(['table'=>'users','where'=>"id='$id' and status=1"]);
        if(!$record){return ['error'=>'Invalid Data!.'];}
        $pdata = [
            'password'  => md5($data['npassword']),
            'updated'   => $this->now()
        ];
        if($this->update_data(['table'=>'users','data'=>$pdata,'where'=>"id='$id'"])){
            return ['status'=>'OK','msg'=>'Password Changed Successfully!.'];
        }
    }
    public function profileForm(){//print_r($_FILES['sign']);exit;
        $data = $this->postData;
        $id = !empty($data['id'])?$data['id']:'';
        if(!$id){return ['error'=>'Invalid Data!.'];}
        if(empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL) || empty($data['name']) || empty($data['contact']) || empty($data['dob']) || empty($data['address']) || empty($data['gender'])){return ['error'=>'Please enter all * Mandatory fields.'];}
        $record = $this->get_record(['table'=>'users','where'=>"email like '".$data['email']."' and status=1"]);//print_r($record);exit;
        if(!$record){return ['error'=>'Invalid User!.'];}
        if($record && $record['id']!=$id){return ['error'=>'Invalid User!.'];}
        $pdata = [
            'name'          => $data['name'],
            'role'          => $data['type'],
            'email'         => $data['email'],
            'mobile'        => $data['contact'],
            'address'       => $data['address'],
            'date_of_birth' => $data['dob'],
            'gender'        => $data['gender']=='male'?1:($data['gender']=='female'?2:1),
            'updated'       => $this->now()
        ];
        if(!file_exists("../uploads/employee/".$id)){
            mkdir(__DIR__."/../uploads/employee/".$id,0777);
        }
        if(isset($_FILES['sign']) && $_FILES['sign']['error']==0){
            $pimage = $_FILES['sign'];
            $o_file=time().'.';
            $temp_name=$pimage["tmp_name"];
            $mime_type = self::getMimeType($temp_name);
            if(!empty($mime_type) && self::isImage($temp_name,$mime_type)){
                if ($pimage['size'] > 5*1024*1024) {
                    return ["error"=>"Image size exceeded 5mb."];
                }else{
                    $filename= self::renameFile($o_file,$mime_type);
                    self::createDuplicate($temp_name, '../uploads/employee/'.$id.'/'.$filename);
                    $pdata['signature']=$filename;
                }
            }else{
                return ['status'=>"invalid file format."];
            }
        }
        if(isset($_FILES['profileimg']) && $_FILES['profileimg']['error']==0){
            $pimage = $_FILES['profileimg'];
            $o_file=time().rand(1,999).'.';
            $temp_name=$pimage["tmp_name"];
            $mime_type = self::getMimeType($temp_name);
            if(!empty($mime_type) && self::isImage($temp_name,$mime_type)){
                if ($pimage['size'] > 5*1024*1024) {
                    return ["error"=>"Image size exceeded 5mb."];
                }else{
                    $filename= self::renameFile($o_file,$mime_type);
                    self::createDuplicate($temp_name, '../uploads/employee/'.$id.'/'.$filename);
                    $pdata['profile_picture']=$filename;
                }
            }else{
                return ['status'=>"invalid file format."];
            }
        }
        if($this->update_data(['table'=>'users','data'=>$pdata,'where'=>"id='$id'"])){
            return ['status'=>'OK','msg'=>'Profile Updated Successfully!.'];
        }
    }

    public function queryForm(){
        $data = $this->postData;
        if(empty($data['database_name']) || empty($data['table_name']) || empty($data['query'])){
            return ['error'=>'Invali Data!.'];
        }
        $pdata = [
            'database_name'     => $data['database_name'],
            'table_name'        => $data['table_name'],
            'query'             => $data['query']
        ];
        if($data['id']){
            $pdata['updated'] = $this->now();
            if($this->update_data(['table'=>'queries','data'=>$pdata,'where'=>"id='".$data['id']."'"])){
                return ['status'=>'OK','msg'=>'Query Data Updated Successfully!.'];
            }
        }else{
            $pdata['now'] = $this->now();
            if($this->insert_data(['table'=>'queries','data'=>$pdata])){
                return ['status'=>'OK','msg'=>'New Record Created Successfully!.'];
            }
        }
    }
    private static function createDuplicate($original,$filename) {
        $size = getimagesize($original);
        $mime_type = strtolower($size['mime']); 
        if ($mime_type=='image/jpeg' || $mime_type=='image/jpg')
            $src_img = imagecreatefromjpeg($original);
        if ($mime_type=='image/png')
            $src_img = imagecreatefrompng($original);
        if ($mime_type=='image/gif')
            $src_img = imagecreatefromgif($original);

        if ($src_img) { 
            $width = imageSX($src_img);
            $height = imageSY($src_img);
            $dst_img = imagecreatetruecolor($width, $height);
            if (preg_match("/jpg|jpeg/",$mime_type)) {
                $back = imagecolorallocate($dst_img, 255, 255, 255);
                imagecopyresized($dst_img, $src_img, 0,0,0,0,$width,$height,$width,$height);
                imagejpeg($dst_img,$filename);
            }
            if (preg_match("/png/",$mime_type)) { 
                imagealphablending($dst_img, false);
                $colorTransparent = imagecolorallocatealpha($dst_img, 0, 0, 0, 127);
                imagefill($dst_img, 0, 0, $colorTransparent);
                imagesavealpha($dst_img, true);
                imagecopyresampled($dst_img, $src_img, 0,0,0,0, $width, $height, $width, $height); 
                imagepng($dst_img,$filename);
            }
            if (preg_match("/gif/",$mime_type)) { 
                $trnprt_indx = imagecolortransparent($src_img); 
                if ($trnprt_indx >= 0) { //its transparent
                    $trnprt_color = imagecolorsforindex($src_img, $trnprt_indx);
                    $trnprt_indx = imagecolorallocate($dst_img, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                    imagefill($dst_img, 0, 0, $trnprt_indx);
                    imagecolortransparent($dst_img, $trnprt_indx);
                }
                //imagecopyresized($dst_img, $src_img, 0,0,0,0, $width, $height, $width, $height);
                imagecopyresampled($dst_img, $src_img, 0,0,0,0, $width, $height, $width, $height); 
                imagegif($dst_img,$filename);
            }
            imagedestroy($dst_img);
            imagedestroy($src_img);
        }
        return is_file($filename);
    }
    private static function renameFile($filename,$mime_type){
        $file = $ext = $name = false;
        if($filename && $mime_type){
            $mime = explode('/',$mime_type);
            if(count($mime)>1){
                $ext = end($mime);
            }
            $fname = explode('.',$filename);
            if(count($fname)>0){
                $name = $fname[0];
            }
            if($name && $ext){
                $file = self::slugify($name).'.'.strtolower($ext);
            }
        }
        return $file;
    }
    private static function frenchChars($string){
        $normalizeChars = array(
            'Ã©'=>'e','Ã‰'=>'e','â€œ'=>'"','â€'=>'"','â€˜'=>"'",'â€™'=>"'",'â€¦'=>"...",'â€”'=>"-",'â€“'=>"-", 'Ã´'=>'o','`ÃŽ'=>'i','Ã®'=>'a','¢'=>'c',
          'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
          'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
          'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
          'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
          'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
          'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
          'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
          'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T',
        );
        $string = strtr($string, $normalizeChars); /* Translating the letters */ /* This function will search the key (array-key of second parameter) and will replace with its respective value. */
        $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,ø,Ø,Å,Á,À,Â,Ä,È,É,Ê,Ë,Í,Î,Ï,Ì,Ò,Ó,Ô,Ö,Ú,Ù,Û,Ü,Ÿ,Ç,Æ,Œ");
        $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,o,O,A,A,A,A,A,E,E,E,E,I,I,I,I,O,O,O,O,U,U,U,U,Y,C,AE,OE");
        $string = str_replace($search, $replace, $string); /* Replacing the letters */
        return $string;
    }
    private static function slugify($text){ 
        //$text = iconv("ISO-8859-1", "UTF-8", $text);
        $text = htmlentities($text);
        $text = preg_replace("/&([a-z])[a-z]+;/i", "$1", $text);
        $text = self::frenchChars($text);
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        setlocale(LC_CTYPE, 'en_GB.utf8');
        // transliterate
        //$text = iconv('utf-8', 'ascii//TRANSLIT', $text);
        if (function_exists('iconv')) {
          $text = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $text);
        } 
        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text)){return 'n-a';}
        return $text;
    }
    private static function isImage($file,$mime_type) {
        $src_img = '';
        if($file && $mime_type){
            if ($mime_type=='image/jpeg' || $mime_type=='image/jpg')
                $src_img = imagecreatefromjpeg($file);
            if ($mime_type=='image/png')
                $src_img = imagecreatefrompng($file);
            if ($mime_type=='image/gif')
                $src_img = imagecreatefromgif($file);
        }
        if($src_img){
            return true;
        }else{
            return false;
        }
    }
    private static function getMimeType($file){
        $mime_type = '';
        if($file){
            if (function_exists('finfo_file')){
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime_type = finfo_file($finfo, $file);
                finfo_close($finfo);
            }else{
                $mime = getimagesize($file);
                $mime_type = $mime['mime'];
            }
        }
        return $mime_type ? strtolower($mime_type) : '';
    }
}
$controller = new AjaxController();
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