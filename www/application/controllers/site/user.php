<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * User related functions
 * @author Teamtweaks
 *
 */
class User extends MY_Controller {

	function __construct(){
		//echo "<pre>";print_r($_REQUEST);echo "</pre>";// die;
		parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->library('twconnect');
		$this->load->model(array('user_model','product_model'));
		$this->load->model('seller_location_model');
		
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->product_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];

		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->user_model->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];

		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
		if ($this->data['loginCheck'] != ''){
			$this->data['likedProducts'] = $this->user_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
		}
		//set default initially
		//$this->session->set_userdata("location","nolocation");
	}

	/**
	 *
	 * Function for quick signup
	 */
	public function quickSignup(){
		$email = $this->input->post('email');
		$returnStr['success'] = '0';
		if (valid_email($email)){
			$condition = array('email'=>$email);
			$duplicateMail = $this->user_model->get_all_details(USERS,$condition);
			if ($duplicateMail->num_rows()>0){
				$returnStr['msg'] = 'Email id already exists';
			}else {
				$fullname = substr($email, 0,strpos($email, '@'));
				$checkAvail = $this->user_model->get_all_details(USERS,array('user_name'=>$fullname));
				if ($checkAvail->num_rows()>0){
					$avail = FALSE;
				}else {
					$avail = TRUE;
					$username = $fullname;
				}
				while (!$avail){
					$username = $fullname.rand(1111, 999999);
					$checkAvail = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
					if ($checkAvail->num_rows()>0){
						$avail = FALSE;
					}else {
						$avail = TRUE;
					}
				}
				if ($avail){
					$pwd = $this->get_rand_str('6');
					$this->user_model->insertUserQuick($fullname,$username,$email,$pwd);
					$this->session->set_userdata('quick_user_name',$username);
					$returnStr['msg'] = 'Successfully registered';
					$returnStr['full_name'] = $fullname;
					$returnStr['user_name'] = $username;
					$returnStr['password'] = $pwd;
					$returnStr['email'] = $email;
					$returnStr['success'] = '1';
				}
			}
		}else {
			$returnStr['msg'] = "Invalid email id";
		}
		echo json_encode($returnStr);
	}

	/**
	 *
	 * Function for quick signup update
	 */
	public function quickSignupUpdate(){
		$returnStr['success'] = '0';
		$unameArr = $this->config->item('unameArr');
		$username = $this->input->post('username');
		if (!preg_match('/^\w{1,}$/', trim($username))){
			$returnStr['msg'] = 'User name not valid. Only alphanumeric allowed';
		}elseif (in_array($username, $unameArr)){
			$returnStr['msg'] = 'User name already exists';
		}else {
			$email = $this->input->post('email');
			$condition = array('user_name'=>$username,'email !='=>$email);
			$duplicateName = $this->user_model->get_all_details(USERS,$condition);
			if ($duplicateName->num_rows()>0){
				$returnStr['msg'] = 'Username already exists';
			}else {
				$pwd = $this->input->post('password');
				$fullname = $this->input->post('fullname');
				$this->user_model->updateUserQuick($fullname,$username,$email,$pwd);
				$this->session->set_userdata('quick_user_name',$username);
				$returnStr['msg'] = 'Successfully registered';
				$returnStr['success'] = '1';
			}
		}
		echo json_encode($returnStr);
	}

	public function send_quick_register_mail(){
		$param = htmlspecialchars($_GET["next"]);
		$next = '';
		if ($param != ''){
			$next = '?next='.urlencode($param);
		}
		if ($this->checkLogin('U') != ''){
			redirect(base_url());
		}else {
			$quick_user_name = $this->session->userdata('quick_user_name');
			if ($quick_user_name == ''){
				redirect(base_url());
			}else {
				$condition = array('user_name'=>$quick_user_name);
				$userDetails = $this->user_model->get_all_details(USERS,$condition);
				if ($userDetails->num_rows() == 1){
					$this->send_confirm_mail($userDetails);
					$this->login_after_signup($userDetails);
					$this->session->set_userdata('quick_user_name','');
					if ($userDetails->row()->is_brand == 'yes'){
						redirect(base_url().'create-brand');
					}else {
						redirect(base_url().'onboarding'.$next);
					}
				}else {
					redirect(base_url());
				}
			}
		}
	}

	public function registerUser(){
		$returnStr['success'] = '0';
		$unameArr = $this->config->item('unameArr');
		$fullname = $this->input->post('fullname');
		$username = $this->input->post('username');
		if (!preg_match('/^\w{1,}$/', trim($username))){
			$returnStr['msg'] = 'User name not valid. Only alphanumeric allowed';
		}elseif (in_array($username, $unameArr)){
			$returnStr['msg'] = 'User name already exists';
		}else {
			$email = $this->input->post('email');
			$pwd = $this->input->post('pwd');
			$brand = $this->input->post('brand');
			if (valid_email($email)){
				$condition = array('user_name'=>$username);
				$duplicateName = $this->user_model->get_all_details(USERS,$condition);
				if ($duplicateName->num_rows()>0){
					$returnStr['msg'] = 'User name already exists';
				}else {
					$condition = array('email'=>$email);
					$duplicateMail = $this->user_model->get_all_details(USERS,$condition);
					if ($duplicateMail->num_rows()>0){
						$returnStr['msg'] = 'Email id already exists';
					}else {
						$this->user_model->insertUserQuick($fullname,$username,$email,$pwd,$brand);
						$this->session->set_userdata('quick_user_name',$username);
						$returnStr['msg'] = 'Successfully registered';
						$returnStr['success'] = '1';
					}
				}
			}else {
				$returnStr['msg'] = "Invalid email id";
			}
		}
		echo json_encode($returnStr);
	}

	public function resend_confirm_mail(){
		$mail = $this->input->post('mail');
		if ($mail == ''){
			echo '0';
		}else {
			$condition = array('email'=>$mail);
			$userDetails = $this->user_model->get_all_details(USERS,$condition);
			$this->send_confirm_mail($userDetails);
			echo '1';
		}
	}

	public function send_email_confirmation(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') == ''){
			if($this->lang->line('login_requ') != '')
			$returnStr['message'] = $this->lang->line('login_requ');
			else
			$returnStr['message'] = 'Login required';
		}else {
			$this->send_confirm_mail($this->data['userDetails']);
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function send_confirm_mail($userDetails=''){
		$uid = $userDetails->row()->id;
		$email = $userDetails->row()->email;
		$randStr = $this->get_rand_str('10');
		$condition = array('id'=>$uid);
		$dataArr = array('verify_code'=>$randStr);
		$this->user_model->update_details(USERS,$dataArr,$condition);
		$newsid='3';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);

		$cfmurl = base_url().'site/user/confirm_register/'.$uid."/".$randStr."/confirmation";
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
		extract($adminnewstemplateArr);
		//$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";

		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');

		$message .= '</body>
			</html>';

		if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->data['siteContactMail'];
			$sender_name=$this->data['siteTitle'];
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}

		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$email,
							'subject_message'=>$template_values['news_subject'],
							'body_messages'=>$message,
							'mail_id'=>'register mail'
							);
							$email_send_to_common = $this->product_model->common_email_send($email_values);
	}

	
/*
vinitj: function for sending seller registeration pending notification
*/

public function send_sellerpending_mail($userDetails=''){
		$uid = $userDetails->row()->id;
		$email = $userDetails->row()->email;
		$newsid='23';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
		extract($adminnewstemplateArr);
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
		
		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		
		$message .= '</body>
			</html>';
		
		if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->data['siteContactMail'];
			$sender_name=$this->data['siteTitle'];
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}

		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$email,
							'subject_message'=>$template_values['news_subject'],
							'body_messages'=>$message,
							'mail_id'=>'register mail'
							);
		$email_send_to_common = $this->product_model->common_email_send($email_values);
	}


        public function signup_form(){
		if ($this->checkLogin('U') != ''){
			redirect(base_url());
		}else {
			$this->data['heading'] = 'Sign up';
			$this->load->view('site/user/signup.php',$this->data);
		}
	}

	/**
	 *
	 * Loading login page
	 */
	public function login_form(){
		if ($this->checkLogin('U')!=''){
			redirect(base_url());
		}else {
			$this->data['next'] = $this->input->get('next');
			//echo $this->data['next'];die;
			$this->data['heading'] = 'Sign in';
			$this->load->view('site/user/login.php',$this->data);
		}
	}

	public function login_user(){
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$next = $this->input->post('next');
		if ($this->form_validation->run() === FALSE)
		{
			if($this->lang->line('email_pwd_req') != '')
			$lg_err_msg = $this->lang->line('email_pwd_req');
			else
			$lg_err_msg = 'Email and password fields required';
			$this->setErrorMessage('error',$lg_err_msg);
			redirect('login?next='.urlencode($next));
		}else {
			$email = $this->input->post('email');
			$pwd = md5($this->input->post('password'));
			$condition = array('email'=>$email,'password'=>$pwd,'status'=>'Active');
			$checkUser = $this->user_model->get_all_details(USERS,$condition);
			if ($checkUser->num_rows() == '1'){
				$userdata = array(
								'fc_session_user_id' => $checkUser->row()->id,
								'session_user_name' => $checkUser->row()->user_name,
								'session_user_email' => $checkUser->row()->email
				);
				//				echo "<pre>";print_r($userdata);
				$this->session->set_userdata($userdata);
				//				echo $this->session->userdata('fc_session_user_id');die;
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time();
				$newdata = array(
	               'last_login_date' => mdate($datestring,$time),
	               'last_login_ip' => $this->input->ip_address()
				);
				$condition = array('id' => $checkUser->row()->id);
				$this->user_model->update_details(USERS,$newdata,$condition);

				$this->user_model->updategiftcard(GIFTCARDS_TEMP,$this->checkLogin('T'),$checkUser->row()->id);

				if($this->data['login_succ_msg'] != '')
				$lg_err_msg = $this->data['login_succ_msg'];
				else
				$lg_err_msg = 'You are Logged In ...';
				$this->setErrorMessage('success',$lg_err_msg);
				//				$this->session->set_flashdata('loadAfterLog', '1');
				if ($next=='close'){
					echo "
					<script>
					window.close();
					</script>
					";
				}else {
					redirect($next);
				}
			}else {
				if($this->lang->line('inval_log_det') != '')
				$lg_err_msg = $this->lang->line('inval_log_det');
				else
				$lg_err_msg = 'Invalid login details';
				$this->setErrorMessage('error',$lg_err_msg);
				redirect('login?next='.urlencode($next));
			}
		}
	}

	public function login_after_signup($userDetails=''){
		if ($userDetails->num_rows() == '1'){
			$userdata = array(
							'fc_session_user_id' => $userDetails->row()->id,
							'session_user_name' => $userDetails->row()->user_name,
							'session_user_email' => $userDetails->row()->email
			);
			$this->session->set_userdata($userdata);
			$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time();
			$newdata = array(
               'last_login_date' => mdate($datestring,$time),
               'last_login_ip' => $this->input->ip_address()
			);
			$condition = array('id' => $userDetails->row()->id);
			$this->user_model->update_details(USERS,$newdata,$condition);

			$this->user_model->updategiftcard(GIFTCARDS_TEMP,$this->checkLogin('T'),$userDetails->row()->id);


		}else {
			redirect(base_url());
		}
	}

	public function confirm_register(){
		$uid = $this->uri->segment(4,0);
		$code = $this->uri->segment(5,0);
		$mode = $this->uri->segment(6,0);
		if($mode=='confirmation'){
			$condition = array('verify_code'=>$code,'id'=>$uid);
			$checkUser = $this->user_model->get_all_details(USERS,$condition);
			if ($checkUser->num_rows() == 1){
				$conditionArr = array('id'=>$uid,'verify_code'=>$code);
				$dataArr = array('is_verified'=>'Yes');
				$this->user_model->update_details(USERS,$dataArr,$condition);
				$subscribeCheck = $this->user_model->get_all_details(SUBSCRIBERS_LIST,array('subscrip_mail'=>$checkUser->row()->email));
				if ($subscribeCheck->num_rows() == 0){
					$this->user_model->simple_insert(SUBSCRIBERS_LIST,array('subscrip_mail'=>$checkUser->row()->email,'status'=>'Active'));
				}
				if($this->lang->line('mail_veri_succc') != '')
				$lg_err_msg = $this->lang->line('mail_veri_succc');
				else
				$lg_err_msg = 'Great going ! Your mail ID has been verified';
				$this->setErrorMessage('success',$lg_err_msg);
				$this->login_after_signup($checkUser);
				redirect(base_url());
			}else {
				if($this->lang->line('inval_conf_link') != '')
				$lg_err_msg = $this->lang->line('inval_conf_link');
				else
				$lg_err_msg = 'Invalid confirmation link';
				$this->setErrorMessage('error',$lg_err_msg);
				redirect(base_url());
			}
		}else {
			if($this->lang->line('inval_conf_link') != '')
			$lg_err_msg = $this->lang->line('inval_conf_link');
			else
			$lg_err_msg = 'Invalid confirmation link';
			$this->setErrorMessage('error',$lg_err_msg);
			redirect(base_url());
		}
	}

	public function logout_user(){
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = time();
		$newdata = array(
               'last_logout_date' => mdate($datestring,$time)
		);
		$condition = array('id' => $this->checkLogin('U'));
		$this->user_model->update_details(USERS,$newdata,$condition);
		$userdata = array(
						'fc_session_user_id'=>'',
						'session_user_name'=>'',
						'session_user_email'=>'',
						'fc_session_temp_id'=>''
						);
						$this->session->unset_userdata($userdata);

						@session_start();
						unset($_SESSION['token']);
						$twitter_return_values = array('tw_status'=>'',
										'tw_access_token'=>''
										);

										$this->session->unset_userdata($twitter_return_values);
										if($this->lang->line('logout_succ') != '')
										$lg_err_msg = $this->lang->line('logout_succ');
										else
										$lg_err_msg = 'Successfully logged out from your account';
										$this->setErrorMessage('success',$lg_err_msg);
										redirect(base_url());
	}

	public function forgot_password_form(){
		$this->data['heading'] = 'Forgot Password';
		$this->load->view('site/user/forgot_password.php',$this->data);
	}

	public function forgot_password_user(){
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			if($this->lang->line('email_requ') != '')
			$lg_err_msg = $this->lang->line('email_requ');
			else
			$lg_err_msg = 'Email address required';
			$this->setErrorMessage('error',$lg_err_msg);
			redirect('forgot-password');
		}else {
			$email = $this->input->post('email');
			if (valid_email($email)){
				$condition = array('email'=>$email);
				$checkUser = $this->user_model->get_all_details(USERS,$condition);
				if ($checkUser->num_rows() == '1'){
					$pwd = $this->get_rand_str('6');
					$newdata = array('password' => md5($pwd));
					$condition = array('email' => $email);
					$this->user_model->update_details(USERS,$newdata,$condition);
					$this->send_user_password($pwd,$checkUser);
					if($this->lang->line('pwd_sen_mail') != '')
					$lg_err_msg = $this->lang->line('pwd_sen_mail');
					else
					$lg_err_msg = 'New password sent to your mail';
					$this->setErrorMessage('success',$lg_err_msg);
					redirect('login');
				}else {
					if($this->lang->line('mail_not_record') != '')
					$lg_err_msg = $this->lang->line('mail_not_record');
					else
					$lg_err_msg = 'Your email id not matched in our records';
					$this->setErrorMessage('error',$lg_err_msg);
					redirect('forgot-password');
				}
			}else {
				if($this->lang->line('mail_not_valid') != '')
				$lg_err_msg = $this->lang->line('mail_not_valid');
				else
				$lg_err_msg = 'Email id not valid';
				$this->setErrorMessage('error',$lg_err_msg);
				redirect('forgot-password');
			}
		}
	}

	public function send_user_password($pwd='',$query){
		$newsid='5';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
		extract($adminnewstemplateArr);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title>
			<body>';
		include('./newsletter/registeration'.$newsid.'.php');

		$message .= '</body>
			</html>';
			

		if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->config->item('site_contact_mail');
			$sender_name=$this->config->item('email_title');
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}

		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$query->row()->email,
							'subject_message'=>'Password Reset',
							'body_messages'=>$message,
							'mail_id'=>'forgot'
							);
							$email_send_to_common = $this->product_model->common_email_send($email_values);

							/*		echo $this->email->print_debugger();die;
							 */
	}

	public function add_fancy_item(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') == ''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('tid');
			$checkProductLike = $this->user_model->get_all_details(PRODUCT_LIKES,array('product_id'=>$tid,'user_id'=>$this->checkLogin('U')));
			if ($checkProductLike->num_rows() == 0){
				$productDetails = $this->user_model->get_all_details(PRODUCT,array('seller_product_id'=>$tid));
				if ($productDetails->num_rows() == 0){
					$productDetails = $this->user_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$tid));
					$productTable = USER_PRODUCTS;
				}else {
					$productTable = PRODUCT;
				}
				if ($productDetails->num_rows()==1){
					$likes = $productDetails->row()->likes;
					$dataArr = array('product_id'=>$tid,'user_id'=>$this->checkLogin('U'),'ip'=>$this->input->ip_address());
					$this->user_model->simple_insert(PRODUCT_LIKES,$dataArr);
					$actArr = array(
						'activity_name'	=>	'fancy',
						'activity_id'	=>	$tid,
						'user_id'		=>	$this->checkLogin('U'),
						'activity_ip'	=>	$this->input->ip_address()
					);
					$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
					$datestring = "%Y-%m-%d %h:%i:%s";
					$time = time();
					$createdTime = mdate($datestring,$time);
					$actArr = array(
						'activity'		=>	'like',
						'activity_id'	=>	$tid,
						'user_id'		=>	$this->checkLogin('U'),
						'activity_ip'	=>	$this->input->ip_address(),
						'created'		=>	$createdTime
					);
					$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
					$likes++;
					$dataArr = array('likes'=>$likes);
					$condition = array('seller_product_id'=>$tid);
					$this->user_model->update_details($productTable,$dataArr,$condition);
					$totalUserLikes = $this->data['userDetails']->row()->likes;
					$totalUserLikes++;
					$this->user_model->update_details(USERS,array('likes'=>$totalUserLikes),array('id'=>$this->checkLogin('U')));
					/*************Send Message to TWITTER*************/
					if($this->data['userDetails']->row()->twitter_id!=''){
					     $TwitterId = $this->data['userDetails']->row()->twitter_id;
						 if($productDetails->row()->image!=''){
							$image = base_url()."images/product/".$productDetails->row()->image;
						 }else{
						   $image = base_url()."images/product/no_image.gif";
						 }
						 $short_url = $this->user_model->get_all_details(SHORTURL,array('id'=>$productDetails->row()->short_url_id));
						 if($short_url->num_rows() ==1){
						   $url = base_url().'t/'.$short_url->row()->id;
						 }
						    include_once './twittercard/twitter-card.php';
							$card = new Twitter_Card();
							$card->setURL( 'http://www.nytimes.com/2012/02/19/arts/music/amid-police-presence-fans-congregate-for-whitney-houstons-funeral-in-newark.html' );
							$card->setTitle( 'Parade of Fans for Houston\'s Funeral' );
							$card->setDescription( 'NEWARK - The guest list and parade of limousines with celebrities emerging from them seemed more suited to a red carpet event in Hollywood or New York than than a gritty stretch of Sussex Avenue near the former site of the James M. Baxter Terrace public housing project here.' );
							$card->setImage( 'http://graphics8.nytimes.com/images/2012/02/19/us/19whitney-span/19whitney-span-articleLarge.jpg', 600, 330 );
	$send_tweets = $this->twconnect->tw_post('https://api.twitter.com/1.1/statuses/update.json',$card->asHTML());
						    print_r($send_tweets);
						
					 }
					 /*************************END*********************/
					 
					 //die;
					
					/*
					 * -------------------------------------------------------
					 * Creating list automatically when user likes a product
					 * -------------------------------------------------------
					 *
					 $listCheck = $this->user_model->get_list_details($tid,$this->checkLogin('U'));
					 if ($listCheck->num_rows() == 0){
						$productCategoriesArr = explode(',', $productDetails->row()->category_id);
						if (count($productCategoriesArr)>0){
						foreach ($productCategoriesArr as $productCategoriesRow){
						if ($productCategoriesRow != ''){
						$productCategory = $this->user_model->get_all_details(CATEGORY,array('id'=>$productCategoriesRow));
						if ($productCategory->num_rows()==1){

						}
						}
						}
						}
						}
						*/
					$returnStr['status_code'] = 1;
				}else {
					if($this->lang->line('prod_not_avail') != '')
					$returnStr['message'] = $this->lang->line('prod_not_avail');
					else
					$returnStr['message'] = 'Product not available';
				}
			}
		}
		echo json_encode($returnStr);
	}

	public function remove_fancy_item(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') == ''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('tid');
			$checkProductLike = $this->user_model->get_all_details(PRODUCT_LIKES,array('product_id'=>$tid,'user_id'=>$this->checkLogin('U')));
			if ($checkProductLike->num_rows() == 1){
				$productDetails = $this->user_model->get_all_details(PRODUCT,array('seller_product_id'=>$tid));
				if ($productDetails->num_rows()==0){
					$productDetails = $this->user_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$tid));
					$productTable = USER_PRODUCTS;
				}else {
					$productTable = PRODUCT;
				}
				if ($productDetails->num_rows()==1){
					$likes = $productDetails->row()->likes;
					$conditionArr = array('product_id'=>$tid,'user_id'=>$this->checkLogin('U'));
					$this->user_model->commonDelete(PRODUCT_LIKES,$conditionArr);
					$actArr = array(
						'activity_name'	=>	'unfancy',
						'activity_id'	=>	$tid,
						'user_id'		=>	$this->checkLogin('U'),
						'activity_ip'	=>	$this->input->ip_address()
					);
					$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
					$likes--;
					$dataArr = array('likes'=>$likes);
					$condition = array('seller_product_id'=>$tid);
					$this->user_model->update_details($productTable,$dataArr,$condition);
					$totalUserLikes = $this->data['userDetails']->row()->likes;
					$totalUserLikes--;
					$this->user_model->update_details(USERS,array('likes'=>$totalUserLikes),array('id'=>$this->checkLogin('U')));
					$returnStr['status_code'] = 1;
				}else {
					if($this->lang->line('prod_not_avail') != '')
					$returnStr['message'] = $this->lang->line('prod_not_avail');
					else
					$returnStr['message'] = 'Product not available';
				}
			}
		}
		echo json_encode($returnStr);
	}

	public function display_user_profile(){
		$username =  urldecode($this->uri->segment(2,0));


		if ($username == 'administrator'){
			$this->data['heading'] = $username;
			$this->load->view('site/user/display_admin_profile');
		}else {
			$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username,'status'=>'Active'));
			if ($userProfileDetails->num_rows()==1){
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name;
				}else {
					$this->data['heading'] = $username;
				}
				if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
					$this->load->view('site/user/display_user_profile_private',$this->data);
				}else {
					$this->data['productLikeDetails'] = $this->user_model->get_like_details_fully($userProfileDetails->row()->id);
					$this->data['userProductLikeDetails'] = $this->user_model->get_like_details_fully_user_products($userProfileDetails->row()->id);
					$this->data['userProfileDetails'] = $userProfileDetails;
					$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
					$this->data['featureProductDetails'] = $this->product_model->get_featured_details($userProfileDetails->row()->feature_product);
					$this->data['follow'] = $this->product_model->view_follow_list($userProfileDetails->row()->id);
					$user_about = $this->user_model->get_about_details($userProfileDetails->row()->id);
$this->data['meta_title']= 'Check ' . $this->data['heading'] .'\'s profile on ' .$this->data['siteTitle'];
					if($user_about->row()->about != ''){
						$this->data['meta_description'] = $user_about->row()->about;
					}
                                        else {
                                                 $this->data['meta_description'] = 'Check '. $this->data['heading'] .'\'s profile, followers, likes, reviews and wishlists. Join Socktail, shopping is more fun with friends.';

                                        }
					$this->load->view('site/user/display_user_profile',$this->data);
				}
			}else {
				/*if($this->lang->line('user_det_not_avail') != '')
				$lg_err_msg = $this->lang->line('user_det_not_avail');
				else
				$lg_err_msg = 'User details not available';
				$this->setErrorMessage('error',$lg_err_msg);
				redirect(base_url());*/
header("Location: http://socktail.com/user/RedOlive", true, 301);
exit();
			}
		}
	}

	public function add_follow(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') != ''){
			$follow_id = $this->input->post('user_id');
			$followingListArr = explode(',', $this->data['userDetails']->row()->following);
			if (!in_array($follow_id, $followingListArr)){
				$followingListArr[] = $follow_id;
				$newFollowingList = implode(',', $followingListArr);
				$followingCount = $this->data['userDetails']->row()->following_count;
				$followingCount++;
				$dataArr = array('following'=>$newFollowingList,'following_count'=>$followingCount);
				$condition = array('id'=>$this->checkLogin('U'));
				$this->user_model->update_details(USERS,$dataArr,$condition);
				$followUserDetails = $this->user_model->get_all_details(USERS,array('id'=>$follow_id));
				if ($followUserDetails->num_rows() == 1){
					$followersListArr = explode(',', $followUserDetails->row()->followers);
					if (!in_array($this->checkLogin('U'), $followersListArr)){
						$followersListArr[] = $this->checkLogin('U');
						$newFollowersList = implode(',', $followersListArr);
						$followersCount = $followUserDetails->row()->followers_count;
						$followersCount++;
						$dataArr = array('followers'=>$newFollowersList,'followers_count'=>$followersCount);
						$condition = array('id'=>$follow_id);
						$this->user_model->update_details(USERS,$dataArr,$condition);
					}
				}
				$actArr = array(
					'activity_name'	=>	'follow',
					'activity_id'	=>	$follow_id,
					'user_id'		=>	$this->checkLogin('U'),
					'activity_ip'	=>	$this->input->ip_address()
				);
				$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time();
				$createdTime = mdate($datestring,$time);
				$actArr = array(
					'activity'	=>	'follow',
					'activity_id'	=>	$follow_id,
					'user_id'		=>	$this->checkLogin('U'),
					'activity_ip'	=>	$this->input->ip_address(),
					'created'		=>	$createdTime
				);
				$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
				$this->send_noty_mail($followUserDetails->result_array());
				$returnStr['status_code'] = 1;
			}else {
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function add_follows(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') != ''){
			$follow_ids = $this->input->post('user_ids');
			$follow_ids_arr = explode(',', $follow_ids);
			$followingListArr = explode(',', $this->data['userDetails']->row()->following);
			foreach ($follow_ids_arr as $flwRow){
				if (in_array($flwRow, $followingListArr)){
					if (($key = array_search($flwRow, $follow_ids_arr)) !== false){
						unset($follow_ids_arr[$key]);
					}
				}
			}
			if (count($follow_ids_arr)>0){
				$newfollowingListArr = array_merge($followingListArr,$follow_ids_arr);
				$newFollowingList = implode(',', $newfollowingListArr);
				$followingCount = $this->data['userDetails']->row()->following_count;
				$newCount = count($follow_ids_arr);
				$followingCount = $followingCount+$newCount;
				$dataArr = array('following'=>$newFollowingList,'following_count'=>$followingCount);
				$condition = array('id'=>$this->checkLogin('U'));
				$this->user_model->update_details(USERS,$dataArr,$condition);
				$conditionStr = 'where id IN ('.implode(',', $follow_ids_arr).')';
				$followUserDetailsArr = $this->user_model->get_users_details($conditionStr);
				if ($followUserDetailsArr->num_rows() > 0){
					foreach ($followUserDetailsArr->result() as $followUserDetails){
						$followersListArr = explode(',', $followUserDetails->followers);
						if (!in_array($this->checkLogin('U'), $followersListArr)){
							$followersListArr[] = $this->checkLogin('U');
							$newFollowersList = implode(',', $followersListArr);
							$followersCount = $followUserDetails->followers_count;
							$followersCount++;
							$dataArr = array('followers'=>$newFollowersList,'followers_count'=>$followersCount);
							$condition = array('id'=>$followUserDetails->id);
							$this->user_model->update_details(USERS,$dataArr,$condition);
							$datestring = "%Y-%m-%d %h:%i:%s";
							$time = time();
							$createdTime = mdate($datestring,$time);
							$actArr = array(
								'activity'	=>	'follow',
								'activity_id'	=>	$followUserDetails->id,
								'user_id'		=>	$this->checkLogin('U'),
								'activity_ip'	=>	$this->input->ip_address(),
								'created'		=>	$createdTime
							);
							$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
							$this->send_noty_mails($followUserDetails);
						}
					}
				}
				$returnStr['status_code'] = 1;
			}else {
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function delete_follow(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') != ''){
			$follow_id = $this->input->post('user_id');
			$followingListArr = explode(',', $this->data['userDetails']->row()->following);
			if (in_array($follow_id, $followingListArr)){
				if(($key = array_search($follow_id, $followingListArr)) !== false) {
					unset($followingListArr[$key]);
				}
				$newFollowingList = implode(',', $followingListArr);
				$followingCount = $this->data['userDetails']->row()->following_count;
				$followingCount--;
				$dataArr = array('following'=>$newFollowingList,'following_count'=>$followingCount);
				$condition = array('id'=>$this->checkLogin('U'));
				$this->user_model->update_details(USERS,$dataArr,$condition);
				$followUserDetails = $this->user_model->get_all_details(USERS,array('id'=>$follow_id));
				if ($followUserDetails->num_rows() == 1){
					$followersListArr = explode(',', $followUserDetails->row()->followers);
					if (in_array($this->checkLogin('U'), $followersListArr)){
						if(($key = array_search($this->checkLogin('U'), $followersListArr)) !== false) {
							unset($followersListArr[$key]);
						}
						$newFollowersList = implode(',', $followersListArr);
						$followersCount = $followUserDetails->row()->followers_count;
						$followersCount--;
						$dataArr = array('followers'=>$newFollowersList,'followers_count'=>$followersCount);
						$condition = array('id'=>$follow_id);
						$this->user_model->update_details(USERS,$dataArr,$condition);
					}
				}
				$actArr = array(
					'activity_name'	=>	'unfollow',
					'activity_id'	=>	$follow_id,
					'user_id'		=>	$this->checkLogin('U'),
					'activity_ip'	=>	$this->input->ip_address()
				);
				$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
				$returnStr['status_code'] = 1;
			}else {
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function display_user_added(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name.'\'s products';
				}else {
					$this->data['heading'] = $username.'\'s Products';
				}
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$this->data['addedProductDetails'] = $this->product_model->view_product_details(' where p.user_id='.$userProfileDetails->row()->id);
				$this->data['notSellProducts'] = $this->product_model->view_notsell_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"');
				$this->data['follow'] = $this->product_model->view_follow_list($userProfileDetails->row()->id);
			$user_about = $this->user_model->get_about_details($userProfileDetails->row()->id);
$this->data['meta_title']= 'Check what interesting products ' . $username . ' is curating on ' .$this->data['siteTitle'];
					if($user_about->row()->about != ''){
						$this->data['meta_description'] = $user_about->row()->about;
					}
                                        else {
                                                 $this->data['meta_description'] = 'Check '. $this->data['heading'] .', profile, followers, likes, reviews and wishlists.';

                                        }
				$this->load->view('site/user/display_user_added',$this->data);
			}
		}else {
							/*redirect(base_url());*/
header("Location: http://socktail.com/user/RedOlive/added", true, 301);
exit();
		}
	}

	public function display_user_lists(){

		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - Lists';
				}else {
					$this->data['heading'] = $username.' - Lists';
				}
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$this->data['listDetails'] = $this->product_model->get_all_details(LISTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id));
				$this->data['follow'] = $this->product_model->view_follow_list($userProfileDetails->row()->id);
				//$str = $this->db->last_query();
				//echo $str; die;
				if ($this->data['listDetails']->num_rows()>0){
					foreach ($this->data['listDetails']->result() as $listDetailsRow){
						$this->data['listImg'][$listDetailsRow->id] = '';
						if ($listDetailsRow->product_id != ''){
							$pidArr = array_filter(explode(',', $listDetailsRow->product_id));

							$productDetails = '';
							if (count($pidArr)>0){
								foreach ($pidArr as $pidRow){
									if ($pidRow!=''){
										$productDetails = $this->product_model->get_all_details(PRODUCT,array('seller_product_id'=>$pidRow,'status'=>'Publish'));
										if ($productDetails->num_rows()==0){
											$productDetails = $this->product_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pidRow,'status'=>'Publish'));
										}
										if ($productDetails->num_rows()==1)break;
									}
								}
							}
							if ($productDetails != '' && $productDetails->num_rows()==1){
								$this->data['listImg'][$listDetailsRow->id] = $productDetails->row()->image;
							}
						}
					}
				}
				$this->load->view('site/user/display_user_lists',$this->data);
			}
		}else {
				/*redirect(base_url());*/
header("Location: http://socktail.com/user/RedOlive/lists", true, 301);
exit();
		}
	}


	public function display_user_follow(){

		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		//echo $this->db->last_query(); die;
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - Following Lists';
				}else {
					$this->data['heading'] = $username.' - Following Lists';
				}
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				//	echo $this->db->last_query();[user_id] => 152
				$user_id = $this->data['recentActivityDetails']->result_array();

				$userid = $user_id[0]['user_id'];
				if ($userid==''){
					$userid = 0;
				}
				$this->data['listDetails'] = $this->product_model->view_follow_list($userid);
				//echo $this->db->last_query(); die;
				if ($this->data['listDetails']->num_rows()>0){
					foreach ($this->data['listDetails']->result() as $listDetailsRow){
						$this->data['listImg'][$listDetailsRow->id] = '';
						if ($listDetailsRow->product_id != ''){
							$pidArr = array_filter(explode(',', $listDetailsRow->product_id));

							$productDetails = '';
							if (count($pidArr)>0){
								foreach ($pidArr as $pidRow){
									if ($pidRow!=''){
										$productDetails = $this->product_model->get_all_details(PRODUCT,array('seller_product_id'=>$pidRow,'status'=>'Publish'));
										if ($productDetails->num_rows()==0){
											$productDetails = $this->product_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pidRow,'status'=>'Publish'));
										}
										if ($productDetails->num_rows()==1)break;
									}
								}
							}
							if ($productDetails != '' && $productDetails->num_rows()==1){
								$this->data['listImg'][$listDetailsRow->id] = $productDetails->row()->image;
							}
						}
					}
				}
				$this->load->view('site/user/display_admin_follow',$this->data);
			}
		}else {
							/*redirect(base_url());*/
header("Location: http://socktail.com/user/RedOlive/follows", true, 301);
exit();
		}
	}







	public function display_user_wants(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name;
				}else {
					$this->data['heading'] = $username;
				}
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$wantList = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id));
				$this->data['wantProductDetails'] = $this->product_model->get_wants_product($wantList);
				$this->data['notSellProducts'] = $this->product_model->get_notsell_wants_product($wantList);
				$this->data['follow'] = $this->product_model->view_follow_list($userProfileDetails->row()->id);
				$user_about = $this->user_model->get_about_details($userProfileDetails->row()->id);
$this->data['meta_title']= 'Check what products ' . $this->data['heading'] . ' wants to have.';
					if($user_about->row()->about != ''){
						$this->data['meta_description'] = $user_about->row()->about;
					}
                                        else {
                                                 $this->data['meta_description'] = 'Check '. $this->data['heading'] .'\'s profile, followers, likes, reviews and wishlists.';

                                        }
				$this->load->view('site/user/display_user_wants',$this->data);
			}
		}else {
							/*redirect(base_url());*/
header("Location: http://socktail.com/user/RedOlive/wants", true, 301);
exit();
		}
	}

	public function display_user_owns(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name;
				}else {
					$this->data['heading'] = $username;
				}
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$this->data['follow'] = $this->product_model->view_follow_list($userProfileDetails->row()->id);
				$productIdsArr = array_filter(explode(',', $userProfileDetails->row()->own_products));
				$productIds = '';
				if (count($productIdsArr)>0){
					foreach ($productIdsArr as $pidRow){
						if ($pidRow != ''){
							$productIds .= $pidRow.',';
						}
					}
					$productIds = substr($productIds, 0,-1);
				}
				if ($productIds != ''){
					$this->data['ownsProductDetails'] = $this->product_model->view_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"');
					$this->data['notSellProducts'] = $this->product_model->view_notsell_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"');
				}else {
					$this->data['addedProductDetails'] = '';
					$this->data['notSellProducts'] = '';
				}
				$user_about = $this->user_model->get_about_details($userProfileDetails->row()->id);
$this->data['meta_title']= 'Check what interesting products ' . $this->data['heading'] . ' owns.';
					if($user_about->row()->about != ''){
						$this->data['meta_description'] = $user_about->row()->about;
					}
                                        else {
                                                 $this->data['meta_description'] = 'Check '. $this->data['heading'] .'\'s profile, followers, likes, reviews and wishlists.';

                                        }
				$this->load->view('site/user/display_user_owns',$this->data);
			}
		}else {
							/*redirect(base_url());*/
header("Location: http://socktail.com/user/RedOlive/owns", true, 301);
exit();
		}
	}

	public function display_user_following(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - Following';
				}else {
					$this->data['heading'] = $username.' - Following';
				}
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$fieldsArr = array('*');
				$searchName = 'id';
				$searchArr = explode(',', $userProfileDetails->row()->following);
				$joinArr = array();
				$sortArr = array();
				$limit = '';
				$this->data['followingUserDetails'] = $followingUserDetails = $this->product_model->get_fields_from_many(USERS,$fieldsArr,$searchName,$searchArr,$joinArr,$sortArr,$limit);
				if ($followingUserDetails->num_rows()>0){
					foreach ($followingUserDetails->result() as $followingUserRow){
						$this->data['followingUserLikeDetails'][$followingUserRow->id] = $this->user_model->get_userlike_products($followingUserRow->id);
					}
				}
				$this->load->view('site/user/display_user_following',$this->data);
			}
		}else {
							/*redirect(base_url());*/
header("Location: http://socktail.com/user/RedOlive/following", true, 301);
exit();
		}
	}

	public function display_user_followers(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - Followers';
				}else {
					$this->data['heading'] = $username.' - Followers';
				}
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$fieldsArr = array('*');
				$searchName = 'id';
				$searchArr = explode(',', $userProfileDetails->row()->followers);
				$joinArr = array();
				$sortArr = array();
				$limit = '';
				$this->data['followingUserDetails'] = $followingUserDetails = $this->product_model->get_fields_from_many(USERS,$fieldsArr,$searchName,$searchArr,$joinArr,$sortArr,$limit);
				if ($followingUserDetails->num_rows()>0){
					foreach ($followingUserDetails->result() as $followingUserRow){
						$this->data['followingUserLikeDetails'][$followingUserRow->id] = $this->user_model->get_userlike_products($followingUserRow->id);
					}
				}
				$this->load->view('site/user/display_user_followers',$this->data);
			}
		}else {
							/*redirect(base_url());*/
header("Location: http://socktail.com/user/RedOlive/followers", true, 301);
exit();
		}
	}

	public function add_list_when_fancyy(){
		$returnStr['status_code'] = 0;
		$returnStr['listCnt'] = '';
		$returnStr['wanted'] = 0;
		$uniqueListNames = array();
		if ($this->checkLogin('U') == ''){
			if($this->lang->line('login_requ') != '')
			$returnStr['message'] = $this->lang->line('login_requ');
			else
			$returnStr['message'] = 'Login required';
		}else {
			$tid = $this->input->post('tid');
			$firstCatName = '';
			$firstCatDetails = '';
			$count = 1;

			//Adding lists which was not already created from product categories
			$productDetails = $this->user_model->get_all_details(PRODUCT,array('seller_product_id'=>$tid));
			if ($productDetails->num_rows()==0){
				$productDetails = $this->user_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$tid));
			}
			if ($productDetails->num_rows()==1){
				$productCatArr = explode(',', $productDetails->row()->category_id);
				if (count($productCatArr)>0){
					$productCatNameArr = array();
					foreach ($productCatArr as $productCatID){
						if ($productCatID != ''){
							$productCatDetails = $this->user_model->get_all_details(CATEGORY,array('id'=>$productCatID));
							if ($productCatDetails->num_rows()==1){
								if ($count == 1){
									$firstCatName = $productCatDetails->row()->cat_name;
								}
								$listConditionArr = array('name'=>$productCatDetails->row()->cat_name,'user_id'=>$this->checkLogin('U'));
								$listCheck = $this->user_model->get_all_details(LISTS_DETAILS,$listConditionArr);
								if ($count == 1){
									$firstCatDetails = $listCheck;
								}
								if ($listCheck->num_rows()==0){
									$this->user_model->simple_insert(LISTS_DETAILS,$listConditionArr);
									$userDetails = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
									$listCount = $userDetails->row()->lists;
									if ($listCount<0 || $listCount == ''){
										$listCount = 0;
									}
									$listCount++;
									$this->user_model->update_details(USERS,array('lists'=>$listCount),array('id'=>$this->checkLogin('U')));
								}
								$count++;
							}
						}
					}
				}
			}

			//Check the product id in list table
			$checkListsArr = $this->user_model->get_list_details($tid,$this->checkLogin('U'));

			if ($checkListsArr->num_rows() == 0){

				//Add the product id under the first category name
				if ($firstCatName!=''){
					$listConditionArr = array('name'=>$firstCatName,'user_id'=>$this->checkLogin('U'));
					if ($firstCatDetails == '' || $firstCatDetails->num_rows() == 0){
						$dataArr = array('product_id'=>$tid);
					}else {
						$productRowArr = explode(',', $firstCatDetails->row()->product_id);
						$productRowArr[] = $tid;
						$newProductRowArr = implode(',', $productRowArr);
						$dataArr = array('product_id'=>$newProductRowArr);
					}
					$this->user_model->update_details(LISTS_DETAILS,$dataArr,$listConditionArr);
					$listCntDetails = $this->user_model->get_all_details(LISTS_DETAILS,$listConditionArr);
					if ($listCntDetails->num_rows()==1){
					
						array_push($uniqueListNames, $listCntDetails->row()->id);
						if($listCntDetails->row()->name != 'Our Picks'){
						/*Remove class selected and rmove checked="checked" for unload the by default selected categories*/
						//$returnStr['listCnt'] .= '<li class="selected"><label for="'.$listCntDetails->row()->id.'"><input type="checkbox" checked="checked" id="'.$listCntDetails->row()->id.'" name="'.$listCntDetails->row()->id.'">'.$listCntDetails->row()->name.'</label></li>';
						$returnStr['listCnt'] .= '<li><label for="'.$listCntDetails->row()->id.'"><input type="checkbox" id="'.$listCntDetails->row()->id.'" name="'.$listCntDetails->row()->id.'">'.$listCntDetails->row()->name.'</label></li>';
						}
					}
				}
			}else {

				//Get all the lists which contain this product
				foreach ($checkListsArr->result() as $checkListsRow){
					if($checkListsRow->name != 'Our Picks'){
					array_push($uniqueListNames, $checkListsRow->id);
					/*Remove class selected and rmove checked="checked" for unload the by default selected categories*/
					$returnStr['listCnt'] .= '<li class="selected"><label for="'.$checkListsRow->id.'"><input type="checkbox" checked="checked" id="'.$checkListsRow->id.'" name="'.$checkListsRow->id.'">'.$checkListsRow->name.'</label></li>';
					// $returnStr['listCnt'] .= '<li><label for="'.$checkListsRow->id.'"><input type="checkbox" id="'.$checkListsRow->id.'" name="'.$checkListsRow->id.'">'.$checkListsRow->name.'</label></li>';
					}
				}
			}
			$all_lists = $this->user_model->get_all_details(LISTS_DETAILS,array('user_id'=>$this->checkLogin('U'), 'name !='=>'Our Picks'));
			if ($all_lists->num_rows()>0){
				foreach ($all_lists->result() as $all_lists_row){
					if (!in_array($all_lists_row->id, $uniqueListNames)){
					if($all_lists_row->name != 'Our Picks'){
						$returnStr['listCnt'] .= '<li><label for="'.$all_lists_row->id.'"><input type="checkbox" id="'.$all_lists_row->id.'" name="'.$all_lists_row->id.'">'.$all_lists_row->name.'</label></li>';
						}
					}
				}
			}

			//Check the product wanted status
			$wantedProducts = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$this->checkLogin('U')));
			if ($wantedProducts->num_rows()==1){
				$wantedProductsArr = explode(',', $wantedProducts->row()->product_id);
				if (in_array($tid, $wantedProductsArr)){
					$returnStr['wanted'] = 1;
				}
			}
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function add_item_to_lists(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('tid');
			$lid = $this->input->post('list_ids');
			$listDetails = $this->user_model->get_all_details(LISTS_DETAILS,array('id'=>$lid));
			if ($listDetails->num_rows()==1){
				$product_ids = explode(',', $listDetails->row()->product_id);
				if (!in_array($tid, $product_ids)){
					array_push($product_ids, $tid);
				}
				$new_product_ids = implode(',', $product_ids);
				$this->user_model->update_details(LISTS_DETAILS,array('product_id'=>$new_product_ids),array('id'=>$lid));
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function remove_item_from_lists(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('tid');
			$lid = $this->input->post('list_ids');
			$listDetails = $this->user_model->get_all_details(LISTS_DETAILS,array('id'=>$lid));
			if ($listDetails->num_rows()==1){
				$product_ids = explode(',', $listDetails->row()->product_id);
				if (in_array($tid, $product_ids)){
					if(($key = array_search($tid, $product_ids)) !== false) {
						unset($product_ids[$key]);
					}
				}
				$new_product_ids = implode(',', $product_ids);
				$this->user_model->update_details(LISTS_DETAILS,array('product_id'=>$new_product_ids),array('id'=>$lid));
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function add_want_tag(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('thing_id');
			$wantDetails = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$this->checkLogin('U')));
			if ($wantDetails->num_rows()==1){
				$product_ids = explode(',', $wantDetails->row()->product_id);
				if (!in_array($tid, $product_ids)){
					array_push($product_ids, $tid);
				}
				$new_product_ids = implode(',', $product_ids);
				$this->user_model->update_details(WANTS_DETAILS,array('product_id'=>$new_product_ids),array('user_id'=>$this->checkLogin('U')));
			}else {
				$dataArr = array('user_id'=>$this->checkLogin('U'),'product_id'=>$tid);
				$this->user_model->simple_insert(WANTS_DETAILS,$dataArr);
			}
			$wantCount = $this->data['userDetails']->row()->want_count;
			if ($wantCount<=0 || $wantCount==''){
				$wantCount = 0;
			}
			$wantCount++;
			$dataArr = array('want_count'=>$wantCount);
			$ownProducts = explode(',', $this->data['userDetails']->row()->own_products);
			if (in_array($tid, $ownProducts)){
				if (($key = array_search($tid, $ownProducts)) !== false){
					unset($ownProducts[$key]);
				}
				$ownCount = $this->data['userDetails']->row()->own_count;
				$ownCount--;
				$dataArr['own_count'] = $ownCount;
				$dataArr['own_products'] = implode(',', $ownProducts);
			}
			$this->user_model->update_details(USERS,$dataArr,array('id'=>$this->checkLogin('U')));
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function delete_want_tag(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('thing_id');
			$wantDetails = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$this->checkLogin('U')));
			if ($wantDetails->num_rows()==1){
				$product_ids = explode(',', $wantDetails->row()->product_id);
				if (in_array($tid, $product_ids)){
					if(($key = array_search($tid, $product_ids)) !== false) {
						unset($product_ids[$key]);
					}
				}
				$new_product_ids = implode(',', $product_ids);
				$this->user_model->update_details(WANTS_DETAILS,array('product_id'=>$new_product_ids),array('user_id'=>$this->checkLogin('U')));
				$wantCount = $this->data['userDetails']->row()->want_count;
				if ($wantCount<=0 || $wantCount==''){
					$wantCount = 1;
				}
				$wantCount--;
				$this->user_model->update_details(USERS,array('want_count'=>$wantCount),array('id'=>$this->checkLogin('U')));
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function create_list(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('tid');
			$list_name = $this->input->post('list_name');
			$category_id = $this->input->post('category_id');
			$checkList = $this->user_model->get_all_details(LISTS_DETAILS,array('name'=>$list_name,'user_id'=>$this->checkLogin('U')));
			if ($checkList->num_rows() == 0){
				$dataArr = array('user_id'=>$this->checkLogin('U'),'name'=>$list_name,'product_id'=>$tid);
				if ($category_id != ''){
					$dataArr['category_id'] = $category_id;
				}
				$this->user_model->simple_insert(LISTS_DETAILS,$dataArr);
				$userDetails = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
				$listCount = $userDetails->row()->lists;
				if ($listCount<0 || $listCount == ''){
					$listCount = 0;
				}
				$listCount++;
				$this->user_model->update_details(USERS,array('lists'=>$listCount),array('id'=>$this->checkLogin('U')));
				$returnStr['list_id'] = $this->user_model->get_last_insert_id();
				$returnStr['new_list'] = 1;
			}else {
				$productArr = explode(',', $checkList->row()->product_id);
				if (!in_array($tid, $productArr)){
					array_push($productArr, $tid);
				}
				$product_id = implode(',', $productArr);
				$dataArr = array('product_id'=>$product_id);
				if ($category_id != ''){
					$dataArr['category_id'] = $category_id;
				}
				$this->user_model->update_details(LISTS_DETAILS,$dataArr,array('user_id'=>$this->checkLogin('U'),'name'=>$list_name));
				$returnStr['list_id'] = $checkList->row()->id;
				$returnStr['new_list'] = 0;
			}
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function search_users(){
		$search_key = $this->input->post('term');
		$returnStr = array();
		if ($search_key != ''){
			$userList = $this->user_model->get_search_user_list($search_key,$this->checkLogin('U'));
			if ($userList->num_rows()>0){
				$i=0;
				foreach ($userList->result() as $userRow){
					$userArr['id'] = $userRow->id;
					$userArr['fullname'] = $userRow->full_name;
					$userArr['username'] = $userRow->user_name;
					if ($userRow->thumbnail != ''){
						$userArr['image_url'] = 'images/users/'.$userRow->thumbnail;
					}else {
						$userArr['image_url'] = 'images/users/user-thumb1.png';
					}
					array_push($returnStr, $userArr);
					$i++;
				}
			}
		}
		echo json_encode($returnStr);
	}

	public function seller_signup_form(){
		if ($this->checkLogin('U')==''){
			redirect(base_url());
		}else {
			if ($this->data['userDetails']->row()->is_verified == 'No'){
				if($this->lang->line('cfm_mail_fst') != '')
				$lg_err_msg = $this->lang->line('cfm_mail_fst');
				else
				$lg_err_msg = 'Please confirm your email first';
				$this->setErrorMessage('error',$lg_err_msg);
				redirect(base_url());
			}else {
				$this->data['heading'] = 'Seller Signup';
				$this->load->view('site/user/seller_register',$this->data);
			}
		}
	}

	public function create_brand_form(){
		if ($this->checkLogin('U')==''){
			redirect(base_url());
		}else {
			$this->data['heading'] = 'Seller Signup';
			$this->data['locations'] = $this->seller_location_model->get_sellerlocation_details();
            $this->data['ProfCatList'] = $this->user_model->getCategoriesMain();
			$this->load->view('site/user/seller_register',$this->data);
		}
	}

		public function custom_request_form(){
			$this->data['heading'] = 'Custom Made Furniture Online in India';
			$this->data['meta_title'] = 'Custom Made Furniture Online in India';
			$this->data['meta_description'] = 'Provide us your customization request, we will make it for you';
			$this->data['heading'] = 'Submit Customization Request';
            $this->data['ProfCatList'] = $this->user_model->getCategoriesMain();
			$this->load->view('site/user/custom',$this->data);
	}
	public function custom_request_submit(){
					$datestring = "%Y-%m-%d %h:%i:%s";
					$time = time();
					$createdTime = mdate($datestring,$time);
					$img1 = "";
					$img2 = "";
					$img3 = "";
					$img4 = "";
					$img5 = "";
					
					
					$config['overwrite'] = FALSE;
					$config['remove_spaces'] = TRUE;
					$config['allowed_types'] = 'jpg|jpeg|gif|png';
					$config['max_size'] = 30000;
					$config['max_width']  = '1400';
					$config['max_height']  = '1400';
					$config['upload_path'] = './images/users/custom';
					$this->load->library('upload', $config);
					if ( $this->upload->do_upload('customImage_one')){
						$imgDetails = $this->upload->data();
						$img1 = $imgDetails['file_name'];
					}else
					if ( $this->upload->do_upload('customImage_two')){
						$imgDetails2 = $this->upload->data();
						$img2 = $imgDetails2['file_name'];
					}else
					if ( $this->upload->do_upload('customImage_three')){
						$imgDetails3 = $this->upload->data();
						$img3 = $imgDetails3['file_name'];
					}else 
					if ( $this->upload->do_upload('customImage_four')){
						$imgDetails4 = $this->upload->data();
						$img4 = $imgDetails4['file_name'];
					}else
					if ( $this->upload->do_upload('customImage_five')){
						$imgDetails5 = $this->upload->data();
						$img5 = $imgDetails5['file_name'];
					}else {
						$this->setErrorMessage('error',strip_tags($this->upload->display_errors()));
						redirect(base_url().'customization-request');
					}


					
				$customArr = array(
										 'status'	=>	'Pending',
                                         'project_name' => $this->input->post('project_name'),
                                         'email' => $this->input->post('email'),
                                         'phone_no' => $this->input->post('phone_no'),
                                         'project_description' => $this->input->post('project_description'),
                                         'size' => $this->input->post('size'),
                                         'color' => $this->input->post('color'),
                                         'material' => $this->input->post('material'),
										 'city' => $this->input->post('city'),
                                         'created' => $createdTime,
										 'pic1' => $img1,
										 'pic2' => $img2,
										 'pic3' => $img3,
 										 'pic4' => $img4,
 										 'pic5' => $img5
					);
					$this->user_model->simple_insert(CUSTOM,$customArr);					
                    $this->send_custom_request_noty_mail();
					$this->load->view('site/user/request_received',$this->data);

	}
	
	
	/* Send notification mail for customization request */
		public function send_custom_request_noty_mail(){
							$subject = 'Customization Request';
							$message .= '<!DOCTYPE HTML>
											<html>
												<head>
													<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
													<meta name="viewport" content="width=device-width"/>
													<title>Customization Request</title>
												</head>
												<body>';
							$message .= 			'You have got a new customization request
												</body>
											</html>';
								$sender_email=$this->data['siteContactMail'];
								$sender_name=$this->data['siteTitle'];

							$email_values = array('mail_type'=>'html',
												'from_mail_id'=>$sender_email,
												'mail_name'=>$sender_name,
												'to_mail_id'=>$sender_email,
												'subject_message'=>$subject,
												'body_messages'=>$message
							);
							$email_send_to_common = $this->product_model->common_email_send($email_values);
		}


	public function seller_signup(){
		if ($this->checkLogin('U')==''){
			redirect(base_url());
		}else {
                        //vinitj: continue even if email is not confirmed
			//if ($this->data['userDetails']->row()->is_verified == 'No'){
			//	if($this->lang->line('cfm_mail_fst') != '')
			//	$lg_err_msg = $this->lang->line('cfm_mail_fst');
			//	else
			//	$lg_err_msg = 'Please confirm your email first';
			//	$this->setErrorMessage('error',$lg_err_msg);
			//	redirect('create-brand');
			//}else {
				$dataArr = array(
					'request_status'	=>	'Approved',
					'group'	=>	'Seller'
					);
					$this->user_model->commonInsertUpdate(USERS,'update',array(),$dataArr,array('id'=>$this->checkLogin('U')));
					if($this->lang->line('sell_reg_succ_msg') != '')
					$lg_err_msg = $this->lang->line('sell_reg_succ_msg');
					else
					$lg_err_msg = 'Welcome onboard ! Our team is evaluating your request. We will contact you shortly';
                                        //vinitj: send pending notification
                                        $this->send_sellerpending_mail($this->data['userDetails']);
				        $this->setErrorMessage('success',$lg_err_msg);
					redirect(base_url().'settings');
			//}
		}
	}

	public function view_purchase(){
		if ($this->checkLogin('U') == ''){
			show_404();
		}else {
			$uid = $this->uri->segment(2,0);
			$dealCode = $this->uri->segment(3,0);
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$purchaseList = $this->user_model->get_purchase_list($uid,$dealCode);
				$invoice = $this->get_invoice($purchaseList);
				echo $invoice;
			}
		}
	}

	public function view_order(){
		if ($this->checkLogin('U') == ''){
			show_404();
		}else {
			$uid = $this->uri->segment(2,0);
			$dealCode = $this->uri->segment(3,0);
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$orderList = $this->user_model->get_order_list($uid,$dealCode);
				$invoice = $this->get_invoice($orderList);
				echo $invoice;
			}
		}
	}

public function get_invoice($PrdList){
$redoliveAdd = $this->user_model->get_all_details(USERS, array( 'full_name' => 'RedOlive'));
		$shipAddRess = $this->user_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $PrdList->row()->shippingid ));
		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>Product Order Confirmation</title>
<body>
<div style="width:1012px;background:#FFFFFF; margin:0 auto;font-size:12px;font-family: Arial, Helvetica, sans-serif;">
<center><h4 style="margin:0 auto;">RETAIL INVOICE</h4></center>
<div style="width:100%;background:#FFFFFF; border:1px solid #000; float:left; margin:0 auto;">
    <p style="margin:0px 0px 2px 5px;">Bought on : </p>
    <div style="float:left; width:30%;"><a href="'.base_url().'" target="_blank" id="logo"><img src="'.base_url().'images/logo/socktail-transparent.png" alt="'.$this->data['WebsiteTitle'].'" title="'.$this->data['WebsiteTitle'].'" style=" height:77px; margin: 0px 0px 2px 5px;"></a></div>
	<div style="float:left; width:70%;">
		<div style="width:360px; float:right;">
		<table>
        	<tr>
        		<td>Seller Name : </td>
        		<td>'.stripslashes($PrdList->row()->full_name).'</td>
        	</tr>
        	<tr>
        		<td>Invoice No. : </td>
        		<td>'.$PrdList->row()->dealCodeNumber.'</td>
        	</tr>
        	<tr>
        		<td>Invoice Date. : </td>
        		<td>'.date("F j, Y g:i a",strtotime($PrdList->row()->created)).'</td>
        	</tr>
        	<tr>
        		<td>TIN / VAT / CST No. :</td>
        		<td>'.stripslashes($PrdList->row()->s_tin_no).'/'.stripslashes($PrdList->row()->s_vat_no).'/'.stripslashes($PrdList->row()->s_cst_no).'</td>
        	</tr>
        	
    	</table>
		</div>
	</div>
</div>			
<!--END OF LOGO-->
    
 <!--start of deal-->
    <div style="width:972px;background:#FFFFFF;float:left; padding:20px; border:1px solid #454B56; ">
	<div style="float:left; width:100%; margin-bottom:20px; margin-right:7px;">
		<div style="float:left; width:49%; border:1px solid #cccccc;">
		<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.8%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#000305;">If Undelivered Return to :</span>
        <table style="width:100%; float:left;">
        	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($PrdList->row()->full_name).'</td></tr>
            <tr><td style="vertical-align: baseline;width: 100px;">Address</td><td style="vertical-align: baseline;">:</td><td>'.stripslashes($PrdList->row()->address).','.stripslashes($PrdList->row()->address2).','.stripslashes($PrdList->row()->city).','.stripslashes($PrdList->row()->state).','.stripslashes($PrdList->row()->postal_code).'</td></tr>
			<!--<tr><td>Address 2</td><td>:</td><td>'.stripslashes($PrdList->row()->address2).'</td></tr>
			<tr><td>City</td><td>:</td><td>'.stripslashes($PrdList->row()->city).'</td></tr>
			<tr><td>Country</td><td>:</td><td>'.stripslashes($PrdList->row()->country).'</td></tr>
			<tr><td>State</td><td>:</td><td>'.stripslashes($PrdList->row()->state).'</td></tr>
			<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($PrdList->row()->postal_code).'</td></tr>
			<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($PrdList->row()->phone_no).'</td></tr>-->
    	</table>
    	</div>
    	<div style="float:right; width:40%;">
		<table style="width:100%; border:1px solid #cecece; float:left;">
		  	<tr bgcolor="#f3f3f3">
            	<td width="100"  style="border-right:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Id</span></td>
	            <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">#'.$PrdList->row()->dealCodeNumber.'</span></td>
	        </tr>
	        <tr bgcolor="#f3f3f3">
                <td width="100"  style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Order Date</span></td>
                <td  width="100"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.date("F j, Y g:i a",strtotime($PrdList->row()->created)).'</span></td>
            </tr>	 
        </table>
        </div>
    </div>
		
    <div style="float:left; width:100%;">
	
    <div style="width:49%; float:left; border:1px solid #cccccc; margin-right:10px;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.8%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#000305;">Shipping Address</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($shipAddRess->row()->full_name).'</td></tr>
                    <tr><td style="vertical-align: baseline;width: 100px;">Address</td><td style="vertical-align: baseline;">:</td><td>'.stripslashes($shipAddRess->row()->address1).', '.stripslashes($shipAddRess->row()->address2).', '.stripslashes($shipAddRess->row()->city).', '.stripslashes($shipAddRess->row()->state).', '.stripslashes($shipAddRess->row()->postal_code).', '.stripslashes($shipAddRess->row()->country).'</td></tr>
					<!--<tr><td>Address 2</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($shipAddRess->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($shipAddRess->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($shipAddRess->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($shipAddRess->row()->postal_code).'</td></tr> -->
					<tr><td style="vertical-align: baseline;">Phone Number</td><td>:</td><td>'.stripslashes($shipAddRess->row()->phone).'</td></tr>
            	</table>
            </div>
     </div>
    
    <div style="width:49%; float:left; border:1px solid #cccccc;">
    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:95.7%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#000305;">From :</span>
    		<div style="float:left; padding:10px; width:96%;  font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#030002; line-height:28px;">
            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($PrdList->row()->full_name).'</td></tr>
                    <tr><td style="vertical-align: baseline;width: 100px;">Address</td><td style="vertical-align: baseline;">:</td><td>'.stripslashes($PrdList->row()->address).','.stripslashes($PrdList->row()->address2).','.stripslashes($PrdList->row()->city).','.stripslashes($PrdList->row()->state).','.stripslashes($PrdList->row()->postal_code).','.stripslashes($PrdList->row()->country).'</td></tr>
					<!--<tr><td>Address 2</td><td>:</td><td>'.stripslashes($PrdList->row()->address2).'</td></tr>
					<tr><td>City</td><td>:</td><td>'.stripslashes($PrdList->row()->city).'</td></tr>
					<tr><td>Country</td><td>:</td><td>'.stripslashes($PrdList->row()->country).'</td></tr>
					<tr><td>State</td><td>:</td><td>'.stripslashes($PrdList->row()->state).'</td></tr>
					<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($PrdList->row()->postal_code).'</td></tr>
					<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($PrdList->row()->phone_no).'</td></tr>-->
            	</table>
            </div>
    </div>
</div> 
	   
<div style="float:left; width:100%; margin-right:3%; margin-top:10px; font-size:12px; font-weight:normal; line-height:28px;  font-family:Arial, Helvetica, sans-serif; color:#000; overflow:hidden;">   
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece; width:99.5%;">
        <tr bgcolor="#f3f3f3">
        	<td width="16%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Image</span></td>
        	<td width="10%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product ID</span></td>
        	<td width="10%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">SKU Code</span></td>
            <td width="30%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>
            <td width="10%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Qty</span></td>
            <td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Unit Price</span></td>
            <td width="12%" style="text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Sub Total</span></td>
         </tr>';	   
			
$disTotal =0; $grantTotal = 0;
foreach ($PrdList->result() as $cartRow) { $InvImg = @explode(',',$cartRow->image);
$unitPrice = ($cartRow->price*(0.01*$cartRow->product_tax_cost))+$cartRow->product_shipping_cost+$cartRow->price; 
$uTot = $unitPrice*$cartRow->quantity;
if($cartRow->attr_name != '' || $cartRow->attr_type != ''){ $atr = '<br>'.$cartRow->attr_type.' / '.$cartRow->attr_name; }else{ $atr = '';}
$message.='<tr>
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="'.base_url().PRODUCTPATH.$InvImg[0].'" alt="'.stripslashes($cartRow->product_name).'" width="70" /></span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->seller_product_id).'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->sku).'</span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).$atr.'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($unitPrice,2,'.','').'</span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($uTot,2,'.','').'</span></td>
        </tr>';
	$grantTotal = $grantTotal + $uTot;
}
	$private_total = $grantTotal - $PrdList->row()->discountAmount;
	$private_total = $private_total + $PrdList->row()->tax  + $PrdList->row()->shippingcost;
				 
$message.='</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';
			if($PrdList->row()->note !=''){
$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>
               
            </tr>
			<tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">'.stripslashes($PrdList->row()->note).'</span></td>
            </tr></table>';
			}

			
			if($PrdList->row()->order_gift == 1){
$message.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:14px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
			}
			
$message.='</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
            <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Sub Total</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($grantTotal,'2','.','').'</span></td>
            </tr>
			<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Discount Amount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->discountAmount,'2','.','').'</span></td>
            </tr>
		<tr bgcolor="#f3f3f3">
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Cost</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->shippingcost,2,'.','').'</span></td>
              </tr>
			  <tr>
            	<td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Tax</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->tax ,2,'.','').'</span></td>
              </tr>
			  <tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31" style="border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($private_total,'2','.','').'</span></td>
              </tr>
              <tr>
                <td width="87" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Amount Paid</span></td>
                <td width="31" style="border-bottom:1px solid #cecece;"><span style="font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;font-weight:800">'.$this->data['currencySymbol'].number_format($private_total,'2','.','').'</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        </div>
        
        <!--end of left--> 
        <div style="width:100%; margin-right:5px; float:left; border-bottom:1px dashed #575757;">
	        <p>
		        *All octroi and entry taxes are borne by the vendor<br />
		        <p> Payment mode : Prepaid - Credit card | Debit card | Online bank transfer , COD</p>
		        <p> Have a question? Our customer service is here to help you - +91 7304 22 44 88</p>
		        <strong style="font-size:15px;"> Please note that this is computer generated invoice and hence does not need a signature</strong><br /></br>
		       <p style="font-size:11px;color:grey;"> Disclaimer : This invoice is generated and issued on behalf and under the instructions of vendor mentioned in this invoice. The goods described in the invoice are sold to the customer by the vendor and not by Redolive Platforms Pvt Ltd. Redolive Platforms Pvt Lts has merely facilitated the sale and purchase between the vendor and customer and the vendor is responsible and liable for all the warranties, quality, merchantability etc. of the goods mentioned herein. Redolive Platforms Pvt Ltd is not an agent and shall not be deemed to be construed as an agent of vendor.</p>
	        </p>
        </div>
        <div style="width:100%; margin-right:5px; margin-top:5px; float:left;">
	        <center>
	        <p>Prepaid - Credit card | Debit card | Online bank transfer , COD</p>
	        </center>
	        <div style="width:60%; float:left; border:1px solid #cccccc; margin-right:10px;">
		    	<span style=" border-bottom:1px solid #cccccc; background:#f3f3f3; width:97%; float:left; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#000305;">Shipped to :</span>
		    		<div style="float:left; padding:10px; width:100%;  font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#030002; line-height:28px;">
		            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		                	<tr><td>Full Name</td><td>:</td><td>'.stripslashes($shipAddRess->row()->full_name).'</td></tr>
		                    <tr><td style="vertical-align: baseline;width: 100px;">Address</td><td style="vertical-align: baseline;">:</td><td>'.stripslashes($shipAddRess->row()->address1).','.stripslashes($shipAddRess->row()->address2).','.stripslashes($shipAddRess->row()->city).','.stripslashes($shipAddRess->row()->state).','.stripslashes($shipAddRess->row()->postal_code).','.stripslashes($shipAddRess->row()->country).'</td></tr>
							<!--<tr><td>Address 2</td><td>:</td><td>'.stripslashes($shipAddRess->row()->address2).'</td></tr>
							<tr><td>City</td><td>:</td><td>'.stripslashes($shipAddRess->row()->city).'</td></tr>
							<tr><td>Country</td><td>:</td><td>'.stripslashes($shipAddRess->row()->country).'</td></tr>
							<tr><td>State</td><td>:</td><td>'.stripslashes($shipAddRess->row()->state).'</td></tr>
							<tr><td>Zipcode</td><td>:</td><td>'.stripslashes($shipAddRess->row()->postal_code).'</td></tr>-->
							<tr><td>Phone Number</td><td>:</td><td>'.stripslashes($shipAddRess->row()->phone).'</td></tr>
		            	</table>
		            </div>
		     </div>
        </div>
        <div style="width:30%;margin-right:5px; margin-top:5px; float:right;">
	       RedOlive Platforms pvt. ltd.
               S-305, Cosmos, Magarpatta City,
               Pune - 411028
                  Customer Care: 7304 22 44 88
            </div>
        </div>
        <div style="clear:both"></div>
    </div>
    </div></body></html>';
                return $message;
	}

	public function change_order_status(){
		if ($this->checkLogin('U') == ''){
			show_404();
		}else {
			$uid = $this->input->post('seller');
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$returnStr['status_code'] = 0;
				$dealCode = $this->input->post('dealCode');
				$status = $this->input->post('value');
				$dataArr = array('shipping_status'=>$status);
				$conditionArr = array('dealCodeNumber'=>$dealCode,'sell_id'=>$uid);
				$this->user_model->update_details(PAYMENT,$dataArr,$conditionArr);
				$returnStr['status_code'] = 1;
				echo json_encode($returnStr);
			}
		}
	}

	public function display_user_lists_home(){

		$lid = $this->uri->segment('4','0');
		$uname = $this->uri->segment('2','0');
		$this->data['user_profile_details'] = $userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$uname));
		if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
			$this->load->view('site/user/display_user_profile_private',$this->data);
		}else {
			$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$this->data['user_profile_details']->row()->id));
			if ($this->data['list_details']->num_rows()==0){
				show_404();
			}else {
				if ($userProfileDetails->row()->full_name == ''){
					$this->data['heading'] = $uname.' - List';
				}else {
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - List';
				}
				$searchArr = array_filter(explode(',', $list_details->row()->product_id));
				if (count($searchArr)>0){
					$fieldsArr = array(PRODUCT.'.*',USERS.'.user_name',USERS.'.full_name');
					$condition = array(PRODUCT.'.status'=>'Publish');
					$joinArr1 = array('table'=>USERS,'on'=>USERS.'.id='.PRODUCT.'.user_id','type'=>'');
					$joinArr = array($joinArr1);
					$this->data['product_details'] = $product_details = $this->product_model->get_fields_from_many(PRODUCT,$fieldsArr,PRODUCT.'.seller_product_id',$searchArr,$joinArr,'','',$condition);
					$this->data['totalProducts'] = count($searchArr);
					$fieldsArr = array(USER_PRODUCTS.'.*',USERS.'.user_name',USERS.'.full_name');
					$condition = array(USER_PRODUCTS.'.status'=>'Publish');
					$joinArr1 = array('table'=>USERS,'on'=>USERS.'.id='.USER_PRODUCTS.'.user_id','type'=>'');
					$joinArr = array($joinArr1);
					$this->data['notsell_product_details'] = $this->product_model->get_fields_from_many(USER_PRODUCTS,$fieldsArr,USER_PRODUCTS.'.seller_product_id',$searchArr,$joinArr,'','',$condition);
				}else {
					$this->data['notsell_product_details'] = '';
					$this->data['product_details'] = '';
					$this->data['totalProducts'] = 0;
				}
				$USER_NAME = $uname;
				$this->data['meta_description'] = 'Buy Online in India '.$list_details->row()->name.' from '.$USER_NAME.'. Read '.$USER_NAME.' Review, Check Price of Products Offered by '.$USER_NAME;

				$this->load->view('site/user/user_list_home',$this->data);
			}
		}
	}
	//store User location in session
	public function add_user_locationtosession(){
		$returnStr['status_code'] = 1;
		$userlocation = array(
								'long' => $this->input->post('lng'),
								'lat' => $this->input->post('lat')
				);
		$this->session->set_userdata("location",$userlocation);
		echo json_encode($this->session->userdata('location'));
	}
	public function display_user_lists_followers(){
		$lid = $this->uri->segment('4','0');
		$uname = $this->uri->segment('2','0');
		$this->data['user_profile_details'] = $userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$uname));
		if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
			$this->load->view('site/user/display_user_profile_private',$this->data);
		}else {
			$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$this->data['user_profile_details']->row()->id));
			if ($this->data['list_details']->num_rows()==0){
				show_404();
			}else {
				if ($userProfileDetails->row()->full_name == ''){
					$this->data['heading'] = $uname.' - List';
				}else {
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - List';
				}
				$fieldsArr = '*';
				$searchArr = explode(',', $list_details->row()->followers);
				$this->data['user_details'] = $user_details = $this->product_model->get_fields_from_many(USERS,$fieldsArr,'id',$searchArr);
				if ($user_details->num_rows()>0){
					foreach ($user_details->result() as $userRow){
						$fieldsArr = array(PRODUCT_LIKES.'.*',PRODUCT.'.product_name',PRODUCT.'.image',PRODUCT.'.id as PID');
						$searchArr = array($userRow->id);
						$joinArr1 = array('table'=>PRODUCT,'on'=>PRODUCT_LIKES.'.product_id='.PRODUCT.'.seller_product_id','type'=>'');
						$joinArr = array($joinArr1);
						$sortArr1 = array('field'=>PRODUCT.'.created','type'=>'desc');
						$sortArr = array($sortArr1);
						$this->data['product_details'][$userRow->id] = $this->product_model->get_fields_from_many(PRODUCT_LIKES,$fieldsArr,PRODUCT_LIKES.'.user_id',$searchArr,$joinArr,$sortArr,'5');
					}
				}
				$fieldsArr = array(PRODUCT.'.*',USERS.'.user_name',USERS.'.full_name');
				$searchArr = array_filter(explode(',', $list_details->row()->product_id));
				if (count($searchArr)>0){
					$this->data['totalProducts'] = count($searchArr);
				}else {
					$this->data['totalProducts'] = 0;
				}

				$this->load->view('site/user/user_list_followers',$this->data);
			}
		}
	}

	public function follow_list(){
		$returnStr['status_code'] = 0;
		$lid = $this->input->post('lid');
		if ($this->checkLogin('U') != ''){
			$listDetails = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid));
			$followersArr = explode(',', $listDetails->row()->followers);
			$followersCount = $listDetails->row()->followers_count;
			$oldDetails = explode(',', $this->data['userDetails']->row()->following_user_lists);
			if (!in_array($lid, $oldDetails)){
				array_push($oldDetails, $lid);
			}
			if (!in_array($this->checkLogin('U'), $followersArr)){
				array_push($followersArr, $this->checkLogin('U'));
				$followersCount++;
			}
			$this->product_model->update_details(USERS,array('following_user_lists'=>implode(',', $oldDetails)),array('id'=>$this->checkLogin('U')));
			$this->product_model->update_details(LISTS_DETAILS,array('followers'=>implode(',', $followersArr),'followers_count'=>$followersCount),array('id'=>$lid));
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function unfollow_list(){
		$returnStr['status_code'] = 0;
		$lid = $this->input->post('lid');
		if ($this->checkLogin('U') != ''){
			$listDetails = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid));
			$followersArr = explode(',', $listDetails->row()->followers);
			$followersCount = $listDetails->row()->followers_count;
			$oldDetails = explode(',', $this->data['userDetails']->row()->following_user_lists);
			if (in_array($lid, $oldDetails)){
				if ($key = array_search($lid, $oldDetails) !== false){
					unset($oldDetails[$key]);
				}
			}
			if (in_array($this->checkLogin('U'), $followersArr)){
				if ($key = array_search($this->checkLogin('U'), $followersArr) !== false){
					unset($followersArr[$key]);
				}
				$followersCount--;
			}
			$this->product_model->update_details(USERS,array('following_user_lists'=>implode(',', $oldDetails)),array('id'=>$this->checkLogin('U')));
			$this->product_model->update_details(LISTS_DETAILS,array('followers'=>implode(',', $followersArr),'followers_count'=>$followersCount),array('id'=>$lid));
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function edit_user_lists(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$lid = $this->uri->segment('4','0');
			$uname = $this->uri->segment('2','0');
			if ($uname != $this->data['userDetails']->row()->user_name){
				show_404();
			}else {
				$this->data['user_profile_details'] = $this->user_model->get_all_details(USERS,array('user_name'=>$uname));
				$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$this->data['user_profile_details']->row()->id));
				if ($this->data['list_details']->num_rows()==0){
					show_404();
				}else {
					$this->data['list_category_details'] = $this->user_model->get_all_details(CATEGORY,array('id'=>$this->data['list_details']->row()->category_id));
					$this->data['heading'] = 'Edit List';
					$this->load->view('site/user/edit_user_list',$this->data);
				}
			}
		}
	}

	public function edit_user_list_details(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$lid = $this->input->post('lid');
			$uid = $this->input->post('uid');
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$list_title = $this->input->post('setting-title');
				$catID = $this->input->post('category');
				$duplicateCheck = $this->user_model->get_all_details(LISTS_DETAILS,array('user_id'=>$uid,'id !='=>$lid,'name'=>$list_title));
				if ($duplicateCheck->num_rows()>0){
					if($this->lang->line('list_tit_exist') != '')
					$lg_err_msg = $this->lang->line('list_tit_exist');
					else
					$lg_err_msg = 'List title already exists';
					$this->setErrorMessage('error',$lg_err_msg);
					echo '<script>window.history.go(-1);</script>';
				}else {
					if ($catID == ''){
						$catID = 0;
					}
					$this->user_model->update_details(LISTS_DETAILS,array('name'=>$list_title,'category_id'=>$catID),array('id'=>$lid,'user_id'=>$uid));
					if($this->lang->line('list_updat_succ') != '')
					$lg_err_msg = $this->lang->line('list_updat_succ');
					else
					$lg_err_msg = 'List updated successfully';
					$this->setErrorMessage('success',$lg_err_msg);
					echo '<script>window.history.go(-1);</script>';
				}
			}
		}
	}

	public function delete_user_list(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			if($this->lang->line('login_requ') != '')
			$returnStr['message'] = $this->lang->line('login_requ');
			else
			$returnStr['message'] = 'Login required';
		}else {
			$lid = $this->input->post('lid');
			$uid = $this->input->post('uid');
			if ($uid != $this->checkLogin('U')){
				if($this->lang->line('u_cant_del_othr_lst') != '')
				$returnStr['message'] = $this->lang->line('u_cant_del_othr_lst');
				else
				$returnStr['message'] = 'You can\'t delete other\'s list';
			}else {
				$list_details = $this->user_model->get_all_details(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$uid));
				if ($list_details->num_rows() == 1){
					$followers_id = $list_details->row()->followers;
					if ($followers_id != ''){
						$searchArr = array_filter(explode(',', $followers_id));
						$fieldsArr = array('following_user_lists','id');
						$followersArr = $this->user_model->get_fields_from_many(USERS,$fieldsArr,'id',$searchArr);
						if ($followersArr->num_rows()>0){
							foreach ($followersArr->result() as $followersRow){
								$listArr = array_filter(explode(',', $followersRow->following_user_lists));
								if (in_array($lid, $listArr)){
									if (($key = array_search($lid, $listArr)) != false){
										unset($listArr[$key]);
										$this->user_model->update_details(USERS,array('following_user_lists'=>implode(',', $listArr)),array('id'=>$followersRow->id));
									}
								}
							}
						}
					}
					$this->user_model->commonDelete(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$this->checkLogin('U')));
					$listCount = $this->data['userDetails']->row()->lists;
					$listCount--;
					if ($listCount == '' || $listCount < 0){
						$listCount = 0;
					}
					$this->user_model->update_details(USERS,array('lists'=>$listCount),array('id'=>$this->checkLogin('U')));
					$returnStr['url'] = base_url().'user/'.$this->data['userDetails']->row()->user_name.'/lists';
					if($this->lang->line('list_del_succ') != '')
					$lg_err_msg = $this->lang->line('list_del_succ');
					else
					$lg_err_msg = 'List deleted successfully';
					$this->setErrorMessage('success',$lg_err_msg);
					$returnStr['status_code'] = 1;
				}else {
					if($this->lang->line('lst_not_avail') != '')
					$returnStr['message'] = $this->lang->line('lst_not_avail');
					else
					$returnStr['message'] = 'List not available';
				}
			}
		}
		echo json_encode($returnStr);
	}

	public function image_crop(){
		if($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$uid = $this->uri->segment(2,0);
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$this->data['heading'] = 'Cropping Image';
				$this->load->view('site/user/crop_image',$this->data);
			}
		}
	}

	public function image_crop_process(){
		if($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$targ_w = $targ_h = 240;
			$jpeg_quality = 90;

			$src = 'images/users/'.$this->data['userDetails']->row()->thumbnail;
			$ext = substr($src, strpos($src , '.')+1);
			if ($ext == 'png'){
				$jpgImg = imagecreatefrompng($src);
				imagejpeg($jpgImg, $src, 90);
			}
			$img_r = imagecreatefromjpeg($src);
			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

			//			list($width, $height) = getimagesize($src);

			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x1'],$_POST['y1'],	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
			//		imagecopyresized($dst_r,$img_r,0,0,$_POST['x1'],$_POST['y1'],	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
			//		imagecopyresized($dst_r, $img_r,0,0, $_POST['x1'],$_POST['y1'], $_POST['x2'],$_POST['y2'],1024,980);
			//			header('Content-type: image/jpeg');
			imagejpeg($dst_r,'images/users/'.$this->data['userDetails']->row()->thumbnail);
			if($this->lang->line('prof_photo_change_succ') != '')
			$lg_err_msg = $this->lang->line('prof_photo_change_succ');
			else
			$lg_err_msg = 'Profile photo changed successfully';
			$this->setErrorMessage('success',$lg_err_msg);
			redirect(base_url().'settings');
			exit;
		}
	}

	public function send_noty_mail($followUserDetails=array()){
		if (count($followUserDetails)>0){
			$emailNoty = explode(',', $followUserDetails[0]['email_notifications']);
			if (in_array('following', $emailNoty)){
				$newsid='7';
				$template_values=$this->product_model->get_newsletter_template_details($newsid);
				$adminnewstemplateArr=array('logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'),'full_name'=>$followUserDetails[0]['full_name'],'cfull_name'=>$this->data['userDetails']->row()->full_name,'user_name'=>$this->data['userDetails']->row()->user_name);
				extract($adminnewstemplateArr);
				$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
				$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title><body>';
				include('./newsletter/registeration'.$newsid.'.php');

				$message .= '</body>
			</html>';


				if($template_values['sender_name']=='' && $template_values['sender_email']==''){
					$sender_email=$this->data['siteContactMail'];
					$sender_name=$this->data['siteTitle'];
				}else{
					$sender_name=$template_values['sender_name'];
					$sender_email=$template_values['sender_email'];
				}

				$email_values = array('mail_type'=>'html',
                                    'from_mail_id'=>$sender_email,
                                    'mail_name'=>$sender_name,
									'to_mail_id'=>$followUserDetails[0]['email'],
									'subject_message'=>$subject,
									'body_messages'=>$message
				);
				$email_send_to_common = $this->product_model->common_email_send($email_values);
			}
		}
	}

	public function send_noty_mails($followUserDetails=array()){
		if (count($followUserDetails)>0){
			$emailNoty = explode(',', $followUserDetails->email_notifications);
			if (in_array('following', $emailNoty)){

				$newsid='9';
				$template_values=$this->product_model->get_newsletter_template_details($newsid);
				$adminnewstemplateArr=array('logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'),'full_name'=>$followUserDetails[0]['full_name'],'cfull_name'=>$this->data['userDetails']->row()->full_name,'user_name'=>$this->data['userDetails']->row()->user_name);
				extract($adminnewstemplateArr);
				$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
				$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title><body>';
				include('./newsletter/registeration'.$newsid.'.php');

				$message .= '</body>
			</html>';

				if($template_values['sender_name']=='' && $template_values['sender_email']==''){
					$sender_email=$this->data['siteContactMail'];
					$sender_name=$this->data['siteTitle'];
				}else{
					$sender_name=$template_values['sender_name'];
					$sender_email=$template_values['sender_email'];
				}

				$email_values = array('mail_type'=>'html',
                                    'from_mail_id'=>$sender_email,
                                    'mail_name'=>$sender_name,
									'to_mail_id'=>$followUserDetails->email,
									'subject_message'=>$subject,
									'body_messages'=>$message
				);
				$email_send_to_common = $this->product_model->common_email_send($email_values);
			}
		}
	}

	public function order_review(){
		if ($this->checkLogin('U')==''){
			show_404();
		}else {
			$uid = $this->uri->segment(2,0);
			$sid = $this->uri->segment(3,0);
			$dealCode = $this->uri->segment(4,0);
			if ($uid == $this->checkLogin('U')){
				$view_mode = 'user';
			}else if ($sid == $this->checkLogin('U')){
				$view_mode = 'seller';
			}else {
				$view_mode = '';
			}
			if ($view_mode == ''){
				show_404();
			}else {
				if ($view_mode == 'seller'){
					$this->db->select('p.*,pAr.attr_name as attr_type,sp.attr_name');
					$this->db->from(PAYMENT.' as p');
					$this->db->join(SUBPRODUCT.' as sp' , 'sp.pid = p.attribute_values','left');
					$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = sp.attr_id','left');
					$this->db->where('p.sell_id = "'.$sid.'" and p.status = "Paid" and p.dealCodeNumber = "'.$dealCode.'"');
					$order_details = $this->db->get();
					//$order_details = $this->user_model->get_all_details(PAYMENT,array('dealCodeNumber'=>$dealCode,'status'=>'Paid','sell_id'=>$sid));
				}else {
					//$order_details = $this->user_model->get_all_details(PAYMENT,array('dealCodeNumber'=>$dealCode,'status'=>'Paid'));
					$this->db->select('p.*,pAr.attr_name as attr_type,sp.attr_name');
					$this->db->from(PAYMENT.' as p');
					$this->db->join(SUBPRODUCT.' as sp' , 'sp.pid = p.attribute_values','left');
					$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = sp.attr_id','left');
					$this->db->where("p.status = 'Paid' and p.dealCodeNumber = '".$dealCode."'");
					$order_details = $this->db->get();
				}
				if ($order_details->num_rows()==0){
					show_404();
				}else {
					if ($view_mode == 'user'){
						$this->data['user_details'] = $this->data['userDetails'];
						$this->data['seller_details'] = $this->user_model->get_all_details(USERS,array('id'=>$sid));
					}elseif ($view_mode == 'seller'){
						$this->data['user_details'] = $this->user_model->get_all_details(USERS,array('id'=>$uid));
						$this->data['seller_details'] = $this->data['userDetails'];
					}
					foreach ($order_details->result() as $order_details_row){
						$this->data['prod_details'][$order_details_row->product_id] = $this->user_model->get_all_details(PRODUCT,array('id'=>$order_details_row->product_id));
					}
					$this->data['view_mode'] = $view_mode;
					$this->data['order_details'] = $order_details;
					$sortArr1 = array('field'=>'date','type'=>'desc');
					$sortArr = array($sortArr1);
					$this->data['order_comments'] = $this->user_model->get_all_details(REVIEW_COMMENTS,array('deal_code'=>$dealCode),$sortArr);
					$this->load->view('site/user/display_order_reviews',$this->data);
				}
			}
		}
	}
	/********* Coding for display add feedback form for user product *********/

	public function display_user_product_feedback($product_id)
	{
		if ($this->checkLogin('U')==''){
			redirect('login');
		}else {
			$id =  array('id'=>$product_id);
			$this->data['userVal'] = $this->product_model->get_all_details(PRODUCT,$id);
			$this->data['feedback_details'] = $this->product_model->get_all_details(PRODUCT_FEEDBACK,array('voter_id'=>$this->checkLogin('U'),'product_id'=>$product_id));
			$this->load->view('site/user/add_user_product_feedback',$this->data);
		}
	}


	/********* Coding for add feedback for user product *********/

	public function add_user_product_feedback()
	{
		$user_id = $this->input->post('rate');
		$rating = $this->input->post('rating_value');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$product_id = $this->input->post('product_id');
		$seller_id = $this->input->post('seller_id');
		if($user_id!='')
		{
			$this->user_model->simple_insert(PRODUCT_FEEDBACK,array('title' => $title,'description' => $description,'product_id' => $product_id,'seller_id'=>$seller_id,'rating' => $rating, 'voter_id' => $user_id,'status'=>'InActive'));
			if($this->lang->line('ur_feedback_add_succ') != '')
			$lg_err_msg = $this->lang->line('ur_feedback_add_succ');
			else
			$lg_err_msg = 'Your feedback added successfully';
			$this->setErrorMessage('success',$lg_err_msg);
			//redirect($base_url);
			echo "<script>window.history.go(-1)</script>";

		}
	}


	public function post_order_comment(){
		if ($this->checkLogin('U') != ''){
			$this->user_model->commonInsertUpdate(REVIEW_COMMENTS,'insert',array(),array(),'');
		}
	}

	public function change_received_status(){
		if ($this->checkLogin('U')!=''){
			$status = $this->input->post('status');
			$rid = $this->input->post('rid');
			$this->user_model->update_details(PAYMENT,array('received_status'=>$status),array('id'=>$rid));
		}
	}

	/******************Invite Friends********************/
	public function invite_friends(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = 'Invite Friends';
			$this->load->view('site/user/invite_friends',$this->data);
		}
	}
     public function app_twitter(){
		$returnStr['status_code'] = 1;
		$returnStr['url'] = base_url().'twtest/get_twitter_user';
		$returnStr['message'] = '';
		echo json_encode($returnStr);
	}
	
	public function find_friends_twitter(){
		$returnStr['status_code'] = 1;
		$returnStr['url'] = base_url().'twtest/invite_friends';
		$returnStr['message'] = '';
		echo json_encode($returnStr);
	}

	public function find_friends_gmail(){
		$returnStr['status_code'] = 1;
		error_reporting(0);
		include_once './invite_friends/GmailOath.php';
		include_once './invite_friends/Config.php';
		$oauth =new GmailOath($consumer_key, $consumer_secret, $argarray, $debug, $callback);
		$getcontact=new GmailGetContacts();
		$access_token=$getcontact->get_request_token($oauth, false, true, true);
		$this->session->set_userdata('oauth_token',$access_token['oauth_token']);
		$this->session->set_userdata('oauth_token_secret',$access_token['oauth_token_secret']);
		$returnStr['url'] = "https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=".$oauth->rfc3986_decode($access_token['oauth_token']);
		$returnStr['message'] = '';
		echo json_encode($returnStr);
	}

	public function find_friends_gmail_callback(){
		include_once './invite_friends/GmailOath.php';
		include_once './invite_friends/Config.php';
		error_reporting(0);
		$oauth =new GmailOath($consumer_key, $consumer_secret, $argarray, $debug, $callback);
		$getcontact_access=new GmailGetContacts();

		$request_token=$oauth->rfc3986_decode($this->input->get('oauth_token'));
		$request_token_secret=$oauth->rfc3986_decode($this->session->userdata('oauth_token_secret'));
		$oauth_verifier= $oauth->rfc3986_decode($this->input->get('oauth_verifier'));

		$contact_access = $getcontact_access->get_access_token($oauth,$request_token, $request_token_secret,$oauth_verifier, false, true, true);
		$access_token=$oauth->rfc3986_decode($contact_access['oauth_token']);
		$access_token_secret=$oauth->rfc3986_decode($contact_access['oauth_token_secret']);
		$contacts= $getcontact_access->GetContacts($oauth, $access_token, $access_token_secret, false, true,$emails_count);

		$count = 0;
		foreach($contacts as $k => $a)
		{
			$final = end($contacts[$k]);
			foreach($final as $email)
			{
				$this->send_invite_mail($email["address"]);
				$count++;
			}
		}
		if ($count>0){
			echo "
			<script>
				alert('Invitations sent successfully');
				window.close();
			</script>
			";
		}else {
			echo "
			<script>
				window.close();
			</script>
			";
		}
	}

	public function send_invite_mail($to=''){
		if ($to != ''){
			$newsid='16';
			$template_values=$this->product_model->get_newsletter_template_details($newsid);
			$adminnewstemplateArr=array('logo'=> $this->data['logo'],'siteTitle'=>$this->data['siteTitle'],'meta_title'=>$this->config->item('meta_title'),'full_name'=>$this->data['userDetails']->row()->full_name,'user_name'=>$this->data['userDetails']->row()->user_name);
			extract($adminnewstemplateArr);
			$subject = $template_values['news_subject'];
			$message .= '<!DOCTYPE HTML>
					<html>
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<meta name="viewport" content="width=device-width"/>
					<title>'.$template_values['news_subject'].'</title><body>';
			include('./newsletter/registeration'.$newsid.'.php');

			$message .= '</body>
					</html>';


			if($template_values['sender_name']=='' && $template_values['sender_email']==''){
				$sender_email=$this->data['siteContactMail'];
				$sender_name=$this->data['siteTitle'];
			}else{
				$sender_name=$template_values['sender_name'];
				$sender_email=$template_values['sender_email'];
			}

			$email_values = array('mail_type'=>'html',
                                    'from_mail_id'=>$sender_email,
                                    'mail_name'=>$sender_name,
									'to_mail_id'=>$to,
									'subject_message'=>$subject,
									'body_messages'=>$message
			);
			$email_send_to_common = $this->product_model->common_email_send($email_values);
		}
	}
	/***************************************************/
}

/* End of file user.php */
/* Location: ./application/controllers/site/user.php */