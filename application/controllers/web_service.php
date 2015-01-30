<?php ob_start();

/**
	* Web Service Controller Class
	* @date 28-03-2013
	* @Purpose:This controller class handles all web services of Savaria App.
	* @author     netset software
	
**/
?>
<?php 
	class Web_service extends CI_Controller
	{
		function __construct()
			{
				parent::__construct();
				$this->load->model("web_service_model");
				error_reporting(0);
				
				ini_set("display_errors", "1");
				error_reporting(E_ALL); 
				$this->load->helper('pay');
				$this->load->helper('apn');
				$this->load->helper('facebook');
			}
          
		function index()
			{
				$this->load->view("admin/web_form");
			}
		/*customer registration start here */
		function register()
			{
				$uname=$_REQUEST['uname'];
				$email=$_REQUEST['email'];
				$pwd=$_REQUEST['pwd'];
				
				if((!empty($uname)) && (!empty($pwd)) && (!empty($email)) && (!empty($_REQUEST['lang'])))
				{			
				       	$this->checkemail($_REQUEST['email']);
					if($id=$this->web_service_model->register($uname,$email,$pwd))
					{
						if($data=$this->web_service_model->check_google_user($id))
						{
							$user_name=$data[0]->user_name;
							$email=$data[0]->email;
							//$pass=$data[0]->$pass;
						}
						if($_REQUEST['lang'] == 1)
						{
							$mess="Hi $user_name!\n\nThank you for registering to MyM.\nThe mail address and password you registered is necessary to use this service, so please save it carefully.\n\nYour mail address and password:\n\nMAIL: $email\nPW: $pwd\n\nYou can get information about this app and update at Mypage＞Setting＞New Info.\n\nThank you for using MyM.\nMyM team.\n\nPlease don't replay to this mail, because this mail address is only to send mails.";
						}
						else
						{
$mess="$user_name さま\n\nMyMアカウントをご登録いただきありがとうございました。\nご登録いただいたメールアドレスとパスワードは本サービスを利用 \nする際に必要となりますので、大切に保管してください。\n\nご登録内容は下記の通りとなります。\n\nMAIL: $email\nPW: $pwd\n\nMyMのアップデートや最新情報は、アプリ内、マイページ＞設定＞ヘルプをご覧ください。\n\nMyMをお使いいただき、ありがとうございます。\nMyMスタッフ一同\n\nこのメールは送信専用です。\n本メールアドレスへはご返信いただけません。";
						}
						$this->send_reg_mail($email,$mess);
					
					      echo json_encode(array('Status'=>True,'message'=>'Registered Successfully','user_id'=>$id,'user_name'=>$user_name));
					}
					else
					{
				
						echo json_encode(array('Status'=>false,'message'=>'Not Registered'));
					}
				}
				else
				{
				
					echo json_encode(array('status'=>false,'message'=>'Please enter required fields'));
				}	
			}
		
			
			function do_upload($file,$uploads)
			{	
		
					$config['upload_path'] = './public/'.$uploads.'/';
					$config['allowed_types'] = 'jpg|png|gif|jpeg';	
					$config['max_size']	= '10000';
					//$config['image_width'] = '200';
					//$config['image_height'] = '200';
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('user_img'))
					{
						$error = $this->upload->display_errors();
						echo json_encode(array('status'=>false,'message'=>$error));
						die;
						
					}
					else
					{
						$data = array('upload_data' => $this->upload->data());	
					}
				return $data;
			}

	function checkemail($mail)
	{
                $result=$this->web_service_model->checkemail($mail);
               // pr($result); 
		if(!empty($result[0]->id))
		{
			return true; 
		}
                elseif(!empty($result[0]->email))
                {
                  echo json_encode(array('status'=>false,'message'=>'Email Id is already in use'));
			die;
                 }
               
	}
	
	function checkvalid($mob)
	{
		if($result=$this->web_service_model->checkvalid($mob))
		{
			echo json_encode(array('status'=>false,'message'=>'user is already registered'));
			die;
		}
	}
		/*customer registration end here */
		
		
	function login_fb()
	{
		if(!empty($_REQUEST['access_token']))
		{
		
			if($res=$this->get_fb_user_detail($_REQUEST['access_token']))
			{
				if($user=$this->web_service_model->reg_fb($res))
				{
					$user_name=$user['user_name'];
					$email=$user['email'];
							//$pass=$data[0]->$pass;
					$mess="Hi $user_name!\n\nThank you for registering to MyM.\nThe mail address and password you registered is necessary to use this service, so please save it carefully.\n\nYour mail address and password:\n\nMAIL: $email\n\nYou can get information about this app and update at Mypage＞Setting＞New Info.\n\nThank you for using MyM.\nMyM team.\n\nPlease don't replay to this mail, because this mail address is only to send mails.";
					if($user['type']==1)	
					{
						$this->send_reg_mail($email,$mess);
					}
echo json_encode(array('Status'=>True,'message'=>'User successfully loggedin','user_id'=>$user['id'],'user_name'=>$user_name));				
				}
				else
				{
					echo json_encode(array('Status'=>false,'message'=>'Login failed'));
				}
			}
			else
			{
				echo json_encode(array('Status'=>false,'message'=>'Invalid Oath token'));	
			}
		}else
		{
			echo json_encode(array('Status'=>false,'message'=>'Enter access token'));
		}
	}	

	
	function get_fb_friends()
	{	
	
		if(!empty($_REQUEST['access_token']))
		{							
			$fb=new FacebookComponent();
			if($fb_friends=$fb->get_fbfriends_iphone($_REQUEST['access_token']))
			{
				echo json_encode(array('Status'=>True,'friend_list'=>$fb_friends));
				foreach($fb_friends as $fbu){
					$this->web_service_model->addFriend($fbu['friend_name'],$fbu['friend_id']);
				}
				
			}else
			{
				echo json_encode(array('Status'=>false,'friend_list'=>'Invalid token'));
			}	
		}else
		{
		
			echo json_encode(array('Status'=>false,'friend_list'=>'Enter access token'));
		}

	}
	

	function get_fb_user_detail($access_token)
	{								
		$fb=new FacebookComponent();
		$fb_data=$fb->get_user_data($access_token);	
		return $fb_data;
	}
	
	function send_reg_mail($email,$mess)
	{
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'text';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from('webpaandu@gmail.com', 'Admin');
		$this->email->to($email);
		$this->email->subject('Registeration');
		$this->email->message($mess);
		if(!$this->email->send())
		{
			return false;
		}
		else
		{
			return true;
		}
	}
			
	



			/* forgot_password function */			
			function forgot_password()
			{
				$email=$_REQUEST['email'];
				if(!empty($email) && !empty($_REQUEST['email']))
				{
					$user=$this->web_service_model->userEmail($email);
					if(is_object($user))
					{
					$password=$this->web_service_model->updateForgot($user->email);
					$this->load->library('email');
					$config['protocol'] = 'sendmail';
					$config['mailtype'] = 'text';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
$this->email->from('webpaandu@gmail.com', 'Admin');
$this->email->to($email);
$this->email->subject('Password Recovery');
if($_REQUEST['lang']==1)
{
$this->email->message("Hi $user->user_name, \nThank you for using 【MyM】 app watching movie and sharing and creating music playlists.\n \nWe are sending password you requested.\n \nPassword \n$password \n\nPlease use password carefully not to show to others.\n \nIf you didn't request sending this mail to you, please delete this.\n \n ※ This mail is sended to mail address registered in MyM by JilApp.\n ※ Please don't replay to this mail, because this mail address is only to send mails.\n \nManaged by JilApp");
}else
{
$this->email->message("$user->user_name さん, \nいつも、動画視聴、音楽プレイリスト共有・作成アプリ【MyM】を\nご利用いただき、誠にありがとうございます。\n \nご希望の通りパスワードを送付させて頂きます。。\n \n「パスワード」 \n$password \n\n尚、パスワードの取扱いには十分にご注意ください。\n \nまた、こちらのメールに身に覚えがない方は、\n削除して頂けますようお願い致します。\n \n ※ このメールはMatsuAppからMyM登録されているメールアドレス宛にお送りしております。\n ※ 配信専用のアドレスのため、このメールに返信されても返信内容の確認およびご変更はできません。\n \n運営元：MatsuApp");
}

if(!$this->email->send())
{
							echo $this->email->print_debugger();
						}
						else
						{
						echo json_encode(array('Status'=>true,'message'=>'Password sent on email id successfully'));		
						}
				 	}
					else
					{
					echo json_encode(array('Status'=>false,'message'=>'Email does not exists'));	
					}
				}
				else
				{
					echo json_encode(array('Status'=>false,'message'=>'Enter Email '));
				}
			
			}
		/* forgot_password function end*/
			

 	
			
 	function user_detail()
	{
		if(!empty($_REQUEST['u_id']))
		{
		
			if($res=$this->web_service_model->get_user_detail($_REQUEST['u_id']))
			{
				$total_count = $this->web_service_model->get_all_playlist_count($_REQUEST['u_id']);
                                // pr($total_count); die;
				if($total_count[0]->total_count)
				{
                                        //echo $total_count; 
					$res->play_count= $total_count[0]->total_count;		
				}
				else
				{
					$res->play_count='0';
				}
$res->total_playlists=$this->web_service_model->get_total_playlist($_REQUEST['u_id']);
$res->avg_eval=$this->get_playlist_uploader_avg_eval($_REQUEST['u_id']);
$res->total_songs=$this->web_service_model->get_total_songs($_REQUEST['u_id']);
echo json_encode(array('Status'=>True,'message'=>'User successfully logged in','user_detail'=>$res));				
				
			}
			else
			{
				echo json_encode(array('Status'=>false,'message'=>'User not exist'));	
			}
		}else
		{
			echo json_encode(array('Status'=>false,'message'=>'Enter User Id'));
		}
	}
	
	private function set_price($price){
			if($price >0 && $price<=15){
				return 1;	
			}elseif($price >15 && $price<=30){
				return 2;		
			}elseif($price >30 && $price<=50){
				return 3;			
			}elseif($price >50 && $price<=75){
				return 4;		
			}elseif($price >75){
				return 5;		
			}		
	}
	
	/*
	* 
	* name: get_price
	* @param : None
	* @return : json
	* @description : Convert price comming from factual api
	* 
	*/
	private function get_price($price){
		$arp=array("$0","$15","$15-30","$30-50","$50-75","$75+");
		return $arp[$price];
	} 
	/*
	* 
	* name: get_hotels
	* @param : None
	* @return : json
	* @description : Get all Cuisine base of Cuisine type, Budget and Location
	* 
	*/
	
	function get_hotels(){
		
		$this->load->library('factual_lib');
		//$factualID = "5aa2a736-806f-4fe6-8b89-a0bc9f6e33dc";
		$tableName = "restaurants";
		$query = new FactualQuery;
		if(!$this->input->post('Budget') || !$this->input->post('type') || !$this->input->post('Location')){
			$resarray['message'] ="Please Provide Inputs"; 
			$resarray['status'] =false;
			echo json_encode($resarray);
			exit; 	
		}	
			if($this->input->post('Budget')){
				$price = $this->input->post('Budget'); //$this->set_price($this->input->post('Budget'));
			}
			//if($query){
			//$query->only("name,rating,price,hours,address,website,tel");
			$query->search($this->input->post('type'));  
			$query->limit(50);
			//$query->offset(150);
			//$query->field("rating")->greaterThanOrEqual(5);
			//$query->field("cuisine")->equal($this->input->post('type'));
			$query->field("price")->lessThanOrEqual($price);
			$query->_or(array(
				$query->field("country")->equal($this->input->post('Location')), 
				$query->field("locality")->equal($this->input->post('Location')), 
				$query->field("postcode")->equal($this->input->post('Location')) 
			));
		$res = $this->factual_lib->fetch($tableName, $query);
		if(!$res->getdata()){
			$resarray['message'] ="No Results Found Please Try Again"; 
			$resarray['status'] =false;
			echo json_encode($resarray);
			exit; 			
		}
			$resarray['message'] ="Search successful"; 
			$resarray['status'] =true; 
			$i = 0;
		foreach($res->getdata()as $data){
			foreach($data as $key=>$val)
			{
				if($key == "name"){
					$resarrays[$i]['Restaurant Name'] = $val;	
				}elseif($key == "rating"){
					$resarrays[$i]['Reviews'] = $val;	
				}elseif($key == "price"){
					$resarrays[$i]['Yelp Price'] = $this->get_price($val);		
				}elseif($key == "website"){
					$resarrays[$i]['Website'] = $val;			
				}elseif($key == "hours"){
					$resarrays[$i]['Hours'] = $val;			
				}elseif($key == "tel"){
					$resarrays[$i]['Phone'] = $val;	
				}elseif($key == "address"){
					$resarrays[$i]['Address'] = $val;			
				}elseif($key == "cuisine"){
					$resarrays[$i]['Menu'] = $val;			
				}
				elseif($key == "latitude"){
					$resarrays[$i]['Lat'] = $val;			
				}
				elseif($key == "longitude"){
					$resarrays[$i]['Long'] = $val;			
				}
                                 elseif($key == "factual_id"){
					$resarrays[$i]['id'] = $val;			
				}	
			}
			$i++;	
		}
		
		$resarray['data']=$resarrays;
		echo json_encode($resarray); 
	}	
	/*
	* 
	* name: top_sponsors
	* @param : None
	* @return : json
	* @description : Get all Top rating sponsors
	* 
	*/
		
	function top_sponsors(){
		
		$this->load->library('factual_lib');
		$tableName = "restaurants";
		$query = new FactualQuery;
	    //$query->only("name,rating,price,hours,address,website,tel");
		$query->_or(array(
		$query->field("postcode")->equal($this->input->post('Location')), 
		$query->field("address")->equal($this->input->post('Location')), 
		$query->field("locality")->equal($this->input->post('Location'))
			));
		$query->field("rating")->greaterThanOrEqual(5);	
		$res = $this->factual_lib->fetch($tableName, $query);
         if(!$res->getdata()){
			$resarray['message'] ="No Results Found Please Try Again"; 
			$resarray['status'] =false;
			echo json_encode($resarray);
			exit; 			
		}
			$resarray['message'] ="Search successful"; 
			$resarray['status'] =true; 
			
			
			$i = 0;
		
		foreach($res->getdata()as $data){
			if(@$data['rating']>=5){
			foreach($data as $key=>$val){
				if($key == "name"){
					$resarrays[$i]['Restaurant Name'] = $val;	
				}elseif($key == "rating"){
					$resarrays[$i]['Reviews'] = $val;	
				}elseif($key == "price"){
					$resarrays[$i]['Yelp Price'] = $this->get_price($val);			
				}elseif($key == "website"){
					$resarrays[$i]['Website'] = $val;			
				}elseif($key == "hours"){
					$resarrays[$i]['Hours'] = $val;			
				}elseif($key == "tel"){
					$resarrays[$i]['Phone'] = $val;	
				}elseif($key == "address"){
					$resarrays[$i]['Address'] = $val;			
				}
				elseif($key == "latitude"){
					$resarrays[$i]['Lat'] = $val;			
				}
				elseif($key == "longitude"){
					$resarrays[$i]['Long'] = $val;			
				}
				elseif($key == "cuisine"){
					$resarrays[$i]['Menu'] = $val;			
				}
                                elseif($key == "factual_id"){
					$resarrays[$i]['id'] = $val;			
				}
 	
				
			}
		}
			$i++;	
		}
		$resarray['data']=$resarrays;
		echo json_encode($resarray); 
		 
	}		
	
	
		function get_cuisine(){
		
		$this->load->library('factual_lib');
		$tableName = "restaurants";
		$query = new FactualQuery;
		$query->only("name,cuisine");
		$res = $this->factual_lib->fetch($tableName, $query);
         if(!$res->getdata()){
			$resarray['message'] ="No Results Found Please Try Again"; 
			$resarray['status'] =false;
			echo json_encode($resarray);
			exit; 			
		}
			$resarray['message'] ="Search successful"; 
			$resarray['status'] =true; 
			
			
			$i = 0;
		
		foreach($res->getdata()as $data){
			
			foreach($data as $key=>$val){
			if($key == "cuisine"){
				foreach($val as $c){
					$resarrays[] = $c;	
				}		
				}	

		}
				
		}
		$resarray['data']=$resarrays;
		echo json_encode($resarray);  
	}	
	
	function add_fav(){
  
       $object=$_POST;
       $uid=$_POST['fb_id'];
       $rid=$_POST['restaurant_id'];
      if($_POST['favorite']==0){
        $this->db->where('fb_id',$uid);
        $this->db->where('restaurant_id',$rid);
         $this->db->delete('fav_restaurant'); 
         
         $resarray['message'] ="Delete successful"; 
	 $resarray['status'] ="false";
	 echo json_encode($resarray);  
die;
     }
       $this->db->where('fb_id',$uid);
       $this->db->where('restaurant_id',$rid);
       $query = $this->db->get('fav_restaurant');
       if ($query->num_rows()<=0)
       {
	 $this->db->insert('fav_restaurant', $object);
	 $resarray['message'] ="Add successful"; 
	 $resarray['status'] ="true";
	 $resarray['data']=$object;
      }else{
         $resarray['message'] ="Restaurant already exist"; 
	 $resarray['status'] ="false";
      }
	 echo json_encode($resarray);  
	}
       function get_fav(){
       $uid=$_POST['fb_id'];
       $this->db->select('*');
       $this->db->from('fav_restaurant');
        $this->db->where('fb_id',$uid);
       $query = $this->db->get();
       if ($query->num_rows() > 0)
       {
      $object=$query->result();
$i=0;
      foreach($object as $data){
			
			foreach($data as $key=>$val){
			      if($key == "restaurant_name"){
					$resarrays[$i]['Restaurant Name'] = $val;	
				}elseif($key == "reviews"){
					$resarrays[$i]['Reviews'] = $val;	
				}elseif($key == "yelp_price"){
					$resarrays[$i]['Yelp Price'] = $val;			
				}elseif($key == "website"){
					$resarrays[$i]['Website'] = $val;			
				}elseif($key == "hours"){
					$resarrays[$i]['Hours'] = $val;			
				}elseif($key == "phone"){
					$resarrays[$i]['Phone'] = $val;	
				}elseif($key == "address"){
					$resarrays[$i]['Address'] = $val;			
				}
				elseif($key == "menu"){
                                        $val=str_replace("(","",$val);
                                        $val=str_replace(")","",$val);
                                        $val=str_replace("\n","",$val);
					$resarrays[$i]['Menu'] =explode(",",$val);			
				}
                                elseif($key == "restaurant_id"){
					$resarrays[$i]['id'] = $val;			
				}	
			      elseif($key == "fb_id"){
				$resarrays[$i]['fb_id'] = $val;			
			     }
                              elseif($key == "favorite"){
				$resarrays[$i]['favorite'] = $val;			
			     }

			}
			$i++;	
		}
       $resarray['message'] ="Search successful"; 
       $resarray['status'] ="true";
       $resarray['data']=$resarrays;
     }else{
       $resarray['message'] ="No record found"; 
       $resarray['status'] ="true";
   }
       echo json_encode($resarray);  
  }

   function invite_friend(){
        $object=$_POST;
	$this->db->insert('invite_friends', $object);
        $resarray['message'] ="Add successful"; 
        $resarray['status'] ="true";
        echo json_encode($resarray);  
   }

  function get_invite(){
        $uid=$_POST['fb_id'];
       $this->db->select('*');
       $this->db->from('invite_friends');
        $this->db->where('fb_id',$uid);
       $query = $this->db->get();
       if ($query->num_rows() > 0)
       {
      $object=$query->result();
       $resarray['message'] ="Search successful"; 
       $resarray['status'] ="true";
       $resarray['data']=$object;
     }else{
       $resarray['message'] ="No record found"; 
       $resarray['status'] ="true";
   }
       echo json_encode($resarray);  
     }
     
     
     
     

		
	function getbyid(){
		
$this->load->library('factual_lib');
$factualID =$_POST['factual_id'];
$tableName = "places";
$res =$this->factual_lib->fetchRow($tableName, $factualID);
	
		
		$tableName = "restaurants";
		$query = new FactualQuery;
	    //$query->only("name,rating,price,hours,address,website,tel");
	
		$query->field("name")->equal($res[0]['name']);
			

		$res = $this->factual_lib->fetch($tableName, $query);
         if(!$res->getdata()){
			$resarray['message'] ="No Results Found Please Try Again"; 
			$resarray['status'] =false;
			echo json_encode($resarray);
			exit; 			
		}
			$resarray['message'] ="Search successful"; 
			$resarray['status'] =true; 
			
			
			$i = 0;
		
		foreach($res->getdata()as $data){
			//if(@$data['rating']>=5){
			foreach($data as $key=>$val){
				if($key == "name"){
					$resarrays[$i]['Restaurant Name'] = $val;	
				}elseif($key == "rating"){
					$resarrays[$i]['Reviews'] = $val;	
				}elseif($key == "price"){
					$resarrays[$i]['Yelp Price'] = $this->get_price($val);			
				}elseif($key == "website"){
					$resarrays[$i]['Website'] = $val;			
				}elseif($key == "hours"){
					$resarrays[$i]['Hours'] = $val;			
				}elseif($key == "tel"){
					$resarrays[$i]['Phone'] = $val;	
				}elseif($key == "address"){
					$resarrays[$i]['Address'] = $val;			
				}
				elseif($key == "latitude"){
					$resarrays[$i]['Lat'] = $val;			
				}
				elseif($key == "longitude"){
					$resarrays[$i]['Long'] = $val;			
				}
				elseif($key == "cuisine"){
					$resarrays[$i]['Menu'] = $val;			
				}
                                elseif($key == "factual_id"){
					$resarrays[$i]['id'] = $val;			
				}
 	
				
			//}
		}
			$i++;	
		}
		$resarray['data']=$resarrays;
		echo json_encode($resarray); 
		
		

	}		

 }	


