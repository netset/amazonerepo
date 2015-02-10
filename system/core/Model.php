<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model { 

	/**
	 * Constructor
	 *
	 * @access public
	 */
	function __construct()
	{
		log_message('debug', "Model Class Initialized");
	}

	/**
	 * __get
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @access private
	 */
	function __get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
		function findWhere($table,$where=1,$single=false,$order='id desc',$paging=false,$num=10,$offset=0)
	  {   
		  if($where!=1){
			$this->db->where($where);
		  }
		  if($paging)
		  {
			 $this->db->limit($num,$offset);
		  }
		  $this->db->order_by($order);
		  $r = $this->db->get($table);
		  if($r)
		  {
			 if($single){
				return $r->row_object();
			 }else{
			   return $r->result_object();
			 }
	 
		  }else{
			return false;
		  }
		  
	  }
	  
	  	  function getCountry(){
     $this->db->select(array('id','country_name'));
   $this->db->where('is_deleted','0');
       $query = $this->db->get('countries');
   return $query->result_object();   
  }
	  
	  
	  function getQuestion(){
	  		$this->db->select(array('id','question'));
			$this->db->where('user_id',null);
	  	  	$query = $this->db->get('questions');
			return $query->result_object();	  
	  }


	function doAction($tbl_name="")
    {
		if($tbl_name!=''){
			$ids = $this->input->post('IDs');
                       
			$action = $this->input->post('action'); 

			  if(count($ids)>0){

				 switch ($action){

					case 'delete':
					
					if($tbl_name=='at_jobs')
					{
					
					foreach($ids as $id){

						$this->db->where('id',$id);
						$this->db->delete($tbl_name);
						
						$this->db->where('job_id',$id);
						$this->db->delete('at_assistant_in_job');
						$this->session->set_flashdata('status', '<div class="msg">Successfully deleted.</div>');

					   }
					
					}elseif($tbl_name=='at_assistants')
					{
						foreach($ids as $id){

						$this->db->where('id',$id);
						$this->db->delete($tbl_name);
						
						$this->db->where('assistant_id',$id);
						$this->db->delete('at_assistant_in_job');
						$this->session->set_flashdata('status', '<div class="msg">Successfully deleted.</div>');

					   }
					}else
					{
					foreach($ids as $id){

						$this->db->where('id',$id);
						$out=$this->db->delete($tbl_name);
						$this->session->set_flashdata('status', '<div class="msg">Successfully deleted.</div>');

					   }
					
					}
					

					   

					break;

					case 'active':

					  $data['status'] = '1';

					  foreach($ids as $id){

						

						$this->db->where('id',$id);

						$this->db->update($tbl_name,$data);

						$this->session->set_flashdata('status', '<div class="msg">Successfully activated.</div>');

					   }

					 

					break;

					case 'deactive':

					  $data['status'] = '0';

					  foreach($ids as $id){

						

						$this->db->where('id',$id);

						$this->db->update($tbl_name,$data);

						$this->session->set_flashdata('status', '<div class="msg">Successfully deactivated.</div>');

					   }

					break;
					case 'approve':

					  $data['payment_approval_status'] = '1';

					  foreach($ids as $id){

						

						$this->db->where('id',$id);

						$this->db->update($tbl_name,$data);

						$this->session->set_flashdata('status', '<div class="msg">Successfully approved.</div>');

					   }

					break;
					case 'unapprove':

					  $data['payment_approval_status'] = '0';

					  foreach($ids as $id){

						

						$this->db->where('id',$id);

						$this->db->update($tbl_name,$data);

						$this->session->set_flashdata('status', '<div class="msg">Successfully approved.</div>');

					   }

					break;
				 

				 

				 }

			 }

		  redirect($_SERVER['HTTP_REFERER']);
		}
	}
	

	  function numRows($table,$where=1)
		  {
		 
			  if($where!=1){
				$this->db->where($where);
			  }
			  $r = $this->db->get($table);
			  return $r->num_rows();
				
		  }
  		 
  function find($table,$id,$order='id desc')
  {
      $this->db->where('id',$id);
      $this->db->order_by($order); 
      $r = $this->db->get($table);
      $this->numrows =  $r->num_rows();
      if($this->numrows)
      {
       return $r->row_object();
      }else{
        return false;
      }
      
      
  }
	  function getRemainingConversion()
	  {
		$where=array('user_id'=>$this->session->userdata('user_id'),'conversion_date'=>date('Y-m-d'));
		$query=$this->db->get_where('tbl_ipcount',$where);
			
		  if($query->num_rows()>0)
		  {
		  $rows_data=$query->row_array();
		 
		  $remaining_conversion=$this->session->userdata('downloadlimitperday') - $rows_data['conversion_count'];
		  }
		  else
		  {
		  $remaining_conversion=$this->session->userdata('downloadlimitperday');
		  }	
		
		return $remaining_conversion;
		}
		public function scan_Dir($directory)
		{
			$temp = "";
			
			$arrfiles=array();
			$handle = opendir($directory);
			while (false !== ($filename = readdir($handle)))
			{
				
					if (($filename!=".") AND ($filename!="..") and ($filename!=".htaccess"))
					{
							if (is_dir($directory."/".$filename))
							{
									$old_directory = $directory;
									$directory .= "/".$filename;
									$temp = $this->scan_Dir($directory);
									
									$cpt = 0;
									while ($cpt<count($temp["filename"]))
									{
											$arrfiles["path"][]      = $directory."/".$temp["filename"][$cpt];
											$arrfiles["directory"][] = $directory;
											$arrfiles["filename"][]  = $temp["filename"][$cpt];
											$arrfiles["filesize"][]  = $this->_format_bytes(filesize($directory."/".$temp["filename"][$cpt]));
											$cpt++;
									}
									$directory = $old_directory;
							}
							else
							{
									$arrfiles["path"][]      = $directory."/".$filename;
									$arrfiles["directory"][] = $directory;
									$arrfiles["filename"][]  = $filename;
									$arrfiles["filesize"][]  = $this->_format_bytes(filesize($directory."/".$filename));
							}
					}
			}
			
			return $arrfiles;
		}
		
	
		public function userfilelist($directory)
		{
			$temp = "";
			
			$arrfiles=array();
			$handle = opendir($directory);
			while (false !== ($filename = readdir($handle)))
			{
				
					if (($filename!=".") AND ($filename!="..") and ($filename!=".htaccess"))
					{
							if (is_dir($directory."/".$filename))
							{
									$old_directory = $directory;
									$directory .= "/".$filename;
									$temp = $this->userfilelist($directory);
									
									$cpt = 0;
									while ($cpt<count($temp["filename"]))
									{
											$arrfiles[$directory]["path"][]        = $directory."/".$temp["filename"][$cpt];
											$arrfiles[$directory]["directory"][] = $directory;
											$arrfiles[$directory]["filename"][]  = $temp["filename"][$cpt];
											$arrfiles[$directory]["filesize"][]  = $this->_format_bytes(filesize($directory."/".$temp["filename"][$cpt]));
											$cpt++;
									}
									$directory = $old_directory;
							}
							else
							{
									$arrfiles[$directory]["path"][]      = $directory."/".$filename;
									$arrfiles[$directory]["directory"][] = $directory;
									$arrfiles[$directory]["filename"][]  = $filename;
									$arrfiles[$directory]["filesize"][]  = $this->_format_bytes(filesize($directory."/".$filename));
							}
					}
			}
			
			return $arrfiles;
			//xpr($arrfiles);
		}
		
		/**
			 * Recursive function to scan a directory with * scandir() *
			 *
			 * @param String $rootDir
			 * @return multi dimensional array
			 */
			function scanDirectories($rootDir) {
				// set filenames invisible if you want
				$invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
				// run through content of root directory
				$dirContent = scandir($rootDir);
				//pr($dirContent );
				$allData = array();
				// file counter gets incremented for a better
				$fileCounter = 0;
				foreach($dirContent as $key => $content) {
					
					// filter all files not accessible
					$path = $rootDir.'/'.$content;
					if(!in_array($content, $invisibleFileNames)) {
						// if content is file & readable, add to array
						if(is_file($path) && is_readable($path)) {
							$tmpPathArray = explode("/",$path);
							// saving filename
							$allData[$fileCounter]['fileName'] = end($tmpPathArray);
							// saving while path (for better access)
							
							$allData[$fileCounter]['filePath'] = $path;
							// get file extension
							$filePartsTmp = explode(".", end($tmpPathArray));
							$allData[$fileCounter]['fileExt'] = end($filePartsTmp);
							// get file date
							$allData[$fileCounter]['fileDate'] = filectime($path);
							// get filesize in byte
							$allData[$fileCounter]['fileSize'] = $this->_format_bytes(filesize($path));
							$allData[$fileCounter]['modifiedago'] = $this->gettimedifference(filectime($path));
							$fileCounter++;
						// if content is a directory and readable, add path and name
						}elseif(is_dir($path) && is_readable($path)) {
							$dirNameArray = explode('/',$path);
							$allData[$path]['dirPath'] = $path;
							$allData[$path]['dirName'] = end($dirNameArray);
							// recursive callback to open new directory
							$allData[$path]['content'] = $this->scanDirectories($path);
						}
					}
				}
				$allData['totalcount']=$fileCounter;
				return $allData;
				}	
		function gettimedifference($time1)
		{
			
				//Get current Unix time stamp
				
				$time2 = time();
				
				//Calculate the difference in seconds
				
				$difference = $time2 - $time1;
				
				$diffSeconds = $difference;
				
				//Calculate how many days are within $difference
				
				$days = intval($difference / 86400);
				
				//Keep the remainder
				
				$difference = $difference % 86400;
				
				//Calculate how many hours are within $difference
				
				$hours = intval($difference / 3600);
				
				//Keep the remainder
				
				$difference = $difference % 3600;
				
				//Calculate how many minutes are within $difference
				
				$minutes = intval($difference / 60);
				
				//Keep the remainder
				
				$difference = $difference % 60;
				
				//Calculate how many seconds are within $difference
				
				$seconds = intval($difference);
				
				//Output:
				$output='';
				if($days > 0)
				{
					$output .= $days." days ";
				}
				if($hours > 0)
				{
					$output .= $hours." Hrs ";
				}
				if($minutes > 0)
				{
					$output .= $minutes." Min ";
				}
				/*if($seconds > 0)
				{
					$output .= $seconds." Sec ";
				}*/
				
				 $output .=" ago ";
				 
				 return $output;

		
		}
		public function _format_bytes($a_bytes)
		{
			if ($a_bytes < 1024) {
				return $a_bytes .' B';
			} elseif ($a_bytes < 1048576) {
				return round($a_bytes / 1024, 2) .' KB';
			} elseif ($a_bytes < 1073741824) {
				return round($a_bytes / 1048576, 2) . ' MB';
			} elseif ($a_bytes < 1099511627776) {
				return round($a_bytes / 1073741824, 2) . ' GB';
			} elseif ($a_bytes < 1125899906842624) {
				return round($a_bytes / 1099511627776, 2) .' TB';
			} elseif ($a_bytes < 1152921504606846976) {
				return round($a_bytes / 1125899906842624, 2) .' PB';
			} elseif ($a_bytes < 1180591620717411303424) {
				return round($a_bytes / 1152921504606846976, 2) .' EB';
			} elseif ($a_bytes < 1208925819614629174706176) {
				return round($a_bytes / 1180591620717411303424, 2) .' ZB';
			} else {
				return round($a_bytes / 1208925819614629174706176, 2) .' YB';
			}
		}
		function getStorageLimit()
		{
			$max_upload_limit=0;
			if($_SERVER['SERVER_NAME']=='localhost')
			{
				 
			 $uploaddir=$_SERVER['DOCUMENT_ROOT'].'development/multipleupload/files/';
			 $downloaddir=$_SERVER['DOCUMENT_ROOT'].'development/download/';
			 	
				
			 }
			 else
			 if($_SERVER['SERVER_NAME']!='localhost')
			{
				 
			 $uploaddir=$_SERVER['DOCUMENT_ROOT'].'/development/multipleupload/files/';
			  $downloaddir=$_SERVER['DOCUMENT_ROOT'].'/development/download/';
				
			
			 }
			if($this->session->userdata('user_id')!='')
			{
				
				
				$uploaddir=$uploaddir.$this->session->userdata('user_id').'/';
				$downloaddir=$downloaddir.$this->session->userdata('user_id').'/';
				if($this->session->userdata('subscription_id')==0)
				{
					$this->db->where(array('usertype'=>'free user'));
					
				
				}
				else
				{
					$this->db->where(array('usertype'=>'paid user'));
				}
					$query=$this->db->get('tbl_storage_limit');
					$row=$query->row();
					$max_upload_limit=$row->sizelimit;
			}
			else
			{
			
				
				
				
				
				
				
				$uploaddir=$uploaddir.$_SERVER['REMOTE_ADDR'].'/';
				$downloaddir=$downloaddir.$_SERVER['REMOTE_ADDR'].'/';
				
				$this->db->where(array('usertype'=>'visitor'));
				$query=$this->db->get('tbl_storage_limit');
				$row=$query->row();
				$max_upload_limit=$row->sizelimit;
			}
				$max_upload_limit=$max_upload_limit * 1048576;
				$uploaded_file_size=$this->foldersize($uploaddir) + $this->foldersize($downloaddir);
				$max_size_limit=$max_upload_limit - $uploaded_file_size;
				
				return $max_size_limit;
			
		}
		function getFileUploadLimit()
		{
			$max_upload_limit=0;
			
			if($this->session->userdata('user_id')!='')
			{
				
				
				
				if($this->session->userdata('subscription_id')==0)
				{
					$this->db->where(array('usertype'=>'free user'));
					
				
				}
				else
				{
					$this->db->where(array('usertype'=>'paid user'));
				}
					$query=$this->db->get('tbl_size_limit');
					$row=$query->row();
					$max_upload_limit=$row->sizelimit;
			}
			else
			{
			
				$this->db->where(array('usertype'=>'visitor'));
				$query=$this->db->get('tbl_size_limit');
				$row=$query->row();
				$max_upload_limit=$row->sizelimit;
			}
				$max_upload_limit=$max_upload_limit * 1048576;
				
				
				return $max_upload_limit;

		}
		 function foldersize($path) {
				$total_size = 0;
				$files = scandir($path);
				$cleanPath = rtrim($path, '/'). '/';
			
					foreach($files as $t) {
						if ($t<>"." && $t<>"..") {
							$currentFile = $cleanPath . $t;
							if (is_dir($currentFile)) {
								$size = foldersize($currentFile);
								$total_size += $size;
							}
							else {
								$size = filesize($currentFile);
								$total_size += $size;
							}
						}   
					}
	
		return $total_size;
	  }
	  function format_size($size) {
		global $units;
	
		$mod = 1024;
	
		for ($i = 0; $size > $mod; $i++) {
			$size /= $mod;
		}
	
		$endIndex = strpos($size, ".")+3;
	
		return substr( $size, 0, $endIndex).' '.$units[$i];
	}


		
}
// END Model Class

/* End of file Model.php */
/* Location: ./system/core/Model.php */