<?php 
class FacebookComponent 
{
	var $fb_friends = array();
	
	/**  @Date: 08-Feb-2012
    	*@Method : get_user_data
    	*@Purpose: This function is to fetch facebook user information
		*@params: $data, $access_token
    **/
    
	function get_user_data($access_token = null){
		    $url =  'https://graph.facebook.com/me?access_token='.$access_token;
			// Initialize session and set URL.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);

			// Set so curl_exec returns the result instead of outputting it.
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			// Get the response and close the channel.
			$response = curl_exec($ch);
			curl_close($ch);
			return $user = json_decode($response);
	}
	
	
	/** @Date: 08-Feb-2012
    	*@Method : post_on_wall
    	*@Purpose: This function is used to post on any user's wall
		*@params: $data, $access_token
    **/
	function post_on_wall($data = null, $access_token = null){
		// URL: "https://graph.facebook.com/neema.netset/feed"
		$url = 'https://graph.facebook.com/'.$data['id'].'/feed';
		$ch=curl_init($url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		$postArray = array(
			'message'    => $data['message'],
			'access_token' => $access_token,
			'picture' => (!empty($data['picture'])?$data['picture']:''),
			'link'    => (!empty($data['link'])?$data['link']:''), // Link to which you want to send user
			'icon'    => (!empty($data['picture'])?$data['picture']:''),
			'from'    => (!empty($data['site_name'])?$data['site_name']:''),
			'name'    => (!empty($data['name'])?$data['name']:''),
			'caption' => (!empty($data['caption'])?$data['caption']:''),
			'description' => (!empty($data['description'])?$data['description']:'')
		);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$postArray);
		curl_exec($ch);
		curl_close($ch);
		
	}
	/** @Date: 08-Feb-2012
    	*@Method : get_facebook_friends
    	*@Purpose: This function is used to find facebook friends of a user
		*@params: $access_token, $facebook_ids (exclude IDs)
    **/
	function get_facebook_friends($access_token = null, $facebook_ids = array()){
	    $url = 'https://graph.facebook.com/me/friends?access_token=' .$access_token;
		// set URL.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		
		// Set so curl_exec returns the result instead of outputting it.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		// Get the response and close the channel.
		$response = curl_exec($ch);
		curl_close($ch);
		$friends = json_decode($response);
		if(!empty($friends->data)){
			$i=0;
			foreach($friends->data as $value){
				$gender=$this->get_facebook_female_friends($value->id);

				if($gender=='female')
				{
					if(in_array($value->id,$facebook_ids) == false){
						$this->fb_friends[$i]['type'] = 'FB'; 
						$this->fb_friends[$i]['facebook_id'] = $value->id; 
						$this->fb_friends[$i]['friend_name'] = $value->name; 
						$this->fb_friends[$i]['friend_pic'] = "https://graph.facebook.com/".$value->id."/picture?type=small"; 
						$i++;
					}
				}
				
			}
			if(!empty($friends->paging->next)){
			$this->get_facebook_friends($friends->paging->next,$facebook_ids);
		   }
			   
		}
		return !empty($this->fb_friends)?$this->fb_friends:$this->fb_friends=array();
	}
	
	/** @Date: 08-Feb-2012
    	*@Method : get_facebook_friends
    	*@Purpose: This function is used to find facebook friends of a user
		*@params: $access_token, $facebook_ids (exclude IDs)
    **/
	function get_facebook_female_friends($fb_id){

		$url = 'https://graph.facebook.com/'.$fb_id;
		$handle = curl_init();
		curl_setopt($handle,CURLOPT_URL,$url);
		curl_setopt($handle,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($handle);
		$friends =  json_decode($data);
		curl_close($handle);
		return $friends->gender;
	}
	
	
	/** @Date: 08-Feb-2012
    	*@Method : get_facebook_friends
    	*@Purpose: This function is used to find facebook friends of a user
		*@params: $access_token, $facebook_ids (exclude IDs)
    **/
	function get_fbfriends_iphone($access_token = null, $facebook_ids = array()){
	    $url = 'https://graph.facebook.com/me/friends?access_token=' .$access_token;
		// set URL.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		
		// Set so curl_exec returns the result instead of outputting it.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		// Get the response and close the channel.
		$response = curl_exec($ch);
		curl_close($ch);
		$friends = json_decode($response);//echo "<pre>";print_r($friends);die;
		if(!empty($friends->data)){
			$i=0;
			foreach($friends->data as $value){
				if(in_array($value->id,$facebook_ids) == false){
					$this->fb_friends[$i]['type'] = 'FB'; 
					$this->fb_friends[$i]['friend_id'] = $value->id; 
					$this->fb_friends[$i]['friend_name'] = $value->name; 
					$this->fb_friends[$i]['friend_pic'] = "https://graph.facebook.com/".$value->id."/picture?type=small"; 
					$this->fb_friends[$i]['challenges_won'] = 0;
					$this->fb_friends[$i]['fav']=0;
					$i++;
				}
			}
			if(!empty($friends->paging->next)){
			$this->get_facebook_friends($friends->paging->next,$facebook_ids);
		   }
			   
		}
		return !empty($this->fb_friends)?$this->fb_friends:$this->fb_friends=array();
	}
}

?>