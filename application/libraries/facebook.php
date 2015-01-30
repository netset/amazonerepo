<?php 
class Facebook
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
			echo "<pre>";
			print_r($friends->data);
			foreach($friends->data as $value){
				if(in_array($value->id,$facebook_ids) == false){
					$this->fb_friends[$i]['typeggg'] = 'FB'; 
					$this->fb_friends[$i]['facebook_id'] = $value->id; 
					$this->fb_friends[$i]['friend_name'] = $value->name; 
					$this->fb_friends[$i]['friend_pic'] = "https://graph.facebook.com/".$value->id."/picture?type=small"; 
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
