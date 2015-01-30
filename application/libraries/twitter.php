<?php
define('CONSUMER_KEY', 'r3sTMGrIuQSV1YzoSbJ3w');
define('CONSUMER_SECRET', '8dSlhVMc4EQsdXJHSFFqjjzBRkbj7PFrQggReL1sY');
define('OAUTH_CALLBACK', 'http://staging.ilverdepremia.it/signup/tweet');
class Twitter{
	var $CI;
	public function __construct()
    {
        $this->CI=& get_instance();
    }

	function login(){
	    $status=false;
		require_once($this->CI->config->item('absolute_url').'twitteroauth/twitteroauth.php');
		//require_once('twitteroauth/twitteroauth.php');
		
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
                $token=$request_token['oauth_token'];
		$this->CI->session->set_userdata('oauth_token',$request_token['oauth_token']);
		$this->CI->session->set_userdata('oauth_token_secret', $request_token['oauth_token_secret']);
		switch ($connection->http_code) {
			case 200:
					$url = $connection->getAuthorizeURL($token);
				        header('Location: ' . $url);
			default:
					$status=false;
		}
		
	}
	
	function callback($verify=""){
		require_once($this->CI->config->item('absolute_url').'twitteroauth/twitteroauth.php');
		

		/* If the oauth_token is old redirect to the connect page. */
		if (isset($_REQUEST['oauth_token']) && $this->CI->session->userdata('oauth_token') !== $_REQUEST['oauth_token']) {
		  $this->CI->session->set_userdata('oauth_status','oldtoken');
		  echo "oldtoken";
		}

		/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $this->CI->session->userdata('oauth_token'), $this->CI->session->userdata('oauth_token_secret'));

		/* Request access tokens from twitter */
		$access_token = $connection->getAccessToken($verify);

		/* Save the access tokens. Normally these would be saved in a database for future use. */
		$this->CI->session->set_userdata('access_token',$access_token);

		/* Remove no longer needed request tokens */
		$this->CI->session->unset_userdata('oauth_token');
		$this->CI->session->unset_userdata('oauth_token_secret');

		/* If HTTP response is 200 continue otherwise send to connect page to retry */
		if (200 == $connection->http_code) {
		  /* The user has been verified and the access tokens can be saved for future use */
		  $this->CI->session->set_userdata('status','verified');
		  return true;
		} else {
		  /* Save HTTP status for error dialog on connnect page.*/
		  echo "error in return code";
		  return false;
		}
		
		
		
	}
	
	function tweet($msg=""){


		require_once($this->CI->config->item('absolute_url').'twitteroauth/twitteroauth.php');
		

		/* If access tokens are not available redirect to connect page. */
		/*if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
		   header('Location: ./clearsessions.php');
		}*/
		/* Get user access tokens out of the session. */
		$access_token = $this->CI->session->userdata('access_token');

		/* Create a TwitterOauth object with consumer/user tokens. */
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

		$message = $msg;

		// Send tweet 
		$connection ->post('statuses/update', array('status' => "$message")); 
	}

}

?>