<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   if (!function_exists('exportCSV')) {
        function iphonepush($user_id,$message)
	{
		// Get a reference to the controller object
   		$CI = get_instance();

    		// You may need to load the model if it hasn't been pre-loaded
   		$CI->load->model('apn_model');

		// Call a function of the model
 		$device_detail =  $CI->apn_model->get_iphone_user_service($user_id);
		$deviceToken = $device_detail[0]->device_id; 
		$badge       = $device_detail[0]->badge+1; 
		if(!empty($deviceToken))
                { 
                	$CI->apn_model->update_badge($badge,$deviceToken); 
                        //return true;
                          
			// Put your device token here (without spaces):
			//$deviceToken = 'a25f6330d8eed752842c8122facd246337fd194b';
			// Put your private key's passphrase here:
                        $passphrase = '!@#$%^&*()';
			////////////////////////////////////////////////////////////////////////////////
			$ctx = stream_context_create();
                        $pem_data = file_get_contents('public/GcCertificates.pem');
			stream_context_set_option($ctx, 'ssl', 'local_cert', $pem_data);
			stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

			// Open a connection to the APNS server
			$fp = stream_socket_client(
			'ssl://gateway.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

			if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);

			//echo 'Connected to APNS' . PHP_EOL;
                              
			// Create the payload body
			$body['aps'] = array(
			 'alert' => $message,
			 'sound' => 'default',
			 'badge' => $badge,
			 );

			// Encode the payload as JSON
			$payload = json_encode($body);

			// Build the binary notification
			$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

			// Send it to the server
			$result = fwrite($fp, $msg, strlen($msg));

			// Close the connection to the server
			fclose($fp);
			return("done");
		   }else{
			return("device id not found");
		   }
		}
		
	}	

