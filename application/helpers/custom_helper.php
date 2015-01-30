<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * return date
 *
 * return date in custom format.
 * add by gaurav
 * @access	public
 * @param	string	raw date
 * @return	date
 */
if ( ! function_exists('getFormatDate'))
{
	function getFormatDate($date, $format = null)
	{
	  $format = (!empty($format)?$format:DATE_FORMAT);
	  return date($format,strtotime($date));
    }	
}


/* language */
if ( ! function_exists('italian_lang'))
{
	function italian_lang($str='')
	{		
		$lang=array();
		$lang['User Management']			= "Gestione degli utenti";
		$lang['Partner Management']			= "la gestione dei partner";
		$lang['I corner Management']		        = "I angolo di gestione";
		$lang['Manage Stores']				= "Gestione Negozi";
		$lang['Manage Faqs']				= "Gestione Faq";
		$lang['Manage Static pages']		        = "Gestione Pagine Statiche";
		$lang['Manage Troffies']			= "Gestione Troffies";
		$lang['Manage Point Settings']			= "Gestire le impostazioni del Punto di";
		$lang['Change Password']			= "Cambia password";
		$lang['Home']		 		        = "Casa";
		$lang['Administrator Controls']		        = "Amministratore Controlla";
		$lang['Logout']				        = "Il logout";
		$lang['Users List']			        = "Lista utenti";
		$lang['Search']					= "Cerca";
		$lang['Search By']				= "Ricerca per";
		$lang['Search Value']				= "Cerca valore";
		$lang['Reset']					= "Reset";
		$lang['Name']					= "Nome";
		$lang['Email']					= "Invia";
		$lang['DOB']					= "Data di nascita";
		$lang['Status']					= "Stato";
		$lang['Created']				= "Creato";
		$lang['Action']					= "Azione";
		$lang['Delete Selected']			= "Elimina selezione";
		$lang['Activate']				= "Attivare";
		$lang['Deactivate']				= "Disattivare";
		$lang['Add User']				= "Aggiungi utente";
		$lang['Edit User']				= "Modifica utente";
		$lang['Confirm Password']			= "Conferma password";
		$lang['Sur Name']				= "Sur Nome";
		$lang['Member Type']				= "Tipo di membro";
		$lang['User']					= "Utente";
		$lang['Province']				= "Provincia";
		$lang['CAP']					= "Cappuccio";
		$lang['Profession']				= "Professione";
		$lang['Profile Image']				= "Profilo Immagine";
		$lang['Active']					= "Attivo";
		$lang['Inactive']				= "Inattivo";
		$lang['Submit']					= "Presentare";
		$lang['Cancel']					= "Annullare";
		$lang['Description']				= "Descrizione";
		$lang['Add Date']				= "Aggiungi la data";
		$lang['Image']					= "Immagine";
		$lang['Add Partner']				= "Aggiungi partner di";
		$lang['Partner Name']				= "Partner di nome";
		$lang['Partner Description']		        = "Partner di descrizione";
		$lang['Edit Partner']				= "Modifica partner di";
		$lang['Update']					= "Aggiornare";
		$lang['Icorner Management']			= "I angolo di gestione";
		$lang['Add Icorner']				= "Aggiungi I angolo";
		$lang['Edit Icorner']				= "Modifica Ho angolo";
		$lang['Icorner Name']				= "Iangolo nome";
		$lang['Address1']				= "Indirizzo1";
		$lang['Address2']				= "Indirizzo2";
		$lang['province']				= "Provincia";
		$lang['Store Management']			= "Gestione Magazzino";
		$lang['Add Store']				= "Aggiungi Negozio";
		$lang['Store Name']				= "Negozio Nome";
		$lang['Address']				= "Indirizzo";
		$lang['Store Description']			= "Descrizione del Negozio";
		$lang['Edit Store']				= "Modifica Negozio";
		$lang['Question']			        = "Domanda";
		$lang['Answer']					= "Rispondere";
		$lang['Add FAQ']				= "Aggiungi FAQ";
		$lang['Edit FAQ']				= "Modifica FAQ";
		$lang['Add']					= "Aggiungi";
		$lang['Title']					= "Titolo";
		$lang['Content']				= "Contenuto";
		$lang['CreatedOn']				= "Creato il";
		$lang['Add Pages']				= "Aggiungi Pagine";
		$lang['Edit Pages']				= "Modifica pagine";
		$lang['Troffie Name']				= "Troffie nome";
		$lang['Points']                                 = "Punti";
		$lang['Add Troffie']				= "Aggiungi Troffie";
		$lang['Edit Troffie']				= "Modifica Troffie";
		$lang['Old Password']                           = "Vecchia password";
		$lang['New Password']                           = "Nuova password";
		$lang['Change']                                 = "Cambiare";
		$lang['Welcome Administrator']                  = "Benvenuto Amministratore";
		$lang['Welcome Admin']	                        = "Benvenuto Admin";	
                $lang['Admin FAQ List']				= "Admin FAQ Lista";	
                $lang['Admin Static Pages List']                = "Admin Elenco Pagine Statiche";
                $lang['Troffie Management']                     = "Troffie Gestione";
                $lang['© Copyright. All Rights Reserved.']	= "© Copyright. Tutti i diritti riservati.";
		return $lang[$str];
	}
	
}
/**
 * return subject and content  of template
 *
 * 
 * add by gaurav
 * @access	public
 * @param	string	$code
 * @return	data
 */
if ( ! function_exists('getTemplateData'))
{
	function getTemplateData($code)
	{
	  $ci=& get_instance();
    $ci->load->database(); 
    $ci->db->where('code',$code);
	  $s = $ci->db->get('email_templates');
	  $r = $s->row_object();
	  $data['subject'] = $r->subject;
	  $data['content'] = $r->content;
	  return $data;
    }	
}

/**
    * @Date: 26-March-2010
    * @Method : getUserType
    * @Purpose: This function will be used to get type of user by code
    * @Param: $id
    * @Return: none
	* @Last Modified By: Neema Tiwari
**/
function replaceTemplateData($variables = array(), $content = ""){
  $str = $content;
  foreach($variables as $key => $val){
	$str = preg_replace("/(\{$key\})/i",$val, $str);
  }
  return $str;
}

/**
    * @Date: 26-March-2010
    * @Method : getUserType
    * @Purpose: This function will be used to get type of user by code
    * @Param: $id
    * @Return: none
	* @Last Modified By: Neema Tiwari
**/
function getUserType($type = null){
  $userType = array(
      'MA' => 'Mega Admin',
      'SA' => 'Super Admin',
      'A' => 'Admin',
      'MU' => 'Mega User',
      'U' => 'User',
  );
  if(!empty($type)){
    return $userType[$type]; 
  }else{
    return $userType;
  }
  
}
   
/**
    * @Date: 08-May-2010
    * @Method : base64encode
    * @Purpose: This function will be used to base64 encode value to pass to URL
    * @Param: $id
    * @Return: none
	* @Last Modified By: Neema Tiwari
**/
function base64encode($id = null){
  
  $str = base64_encode($id);
  $replaceArray = array(
  '='=>'-',
  '/'=>'_',
  );
  foreach($replaceArray as $key => $value){
    $str  = str_replace($key,$value, $str);
  }
  return $str;
}

/**
    * @Date: 08-May-2010
    * @Method : base64decode
    * @Purpose: This function will be used to base64 decode value to pass to URL
    * @Param: $id
    * @Return: none
	* @Last Modified By: Neema Tiwari
**/
function base64decode($str = null){

  $replaceArray = array(
  '-'=>'=',
  '_'=>'/',
  );
  foreach($replaceArray as $key => $value){
    $str  = str_replace($key,$value, $str);
  }
  $str = base64_decode($str);
  return $str;
}

function getImagePrivacy($type = null){
  $privacy = array(
      '1' => lang('EVERYONE_CAN_SEE_THIS'),
      '2' => lang('ONLY_ME_SEE_THIS'),
      '3' => lang('ONLY_CONTACT_SEE_THIS'),
      '4' => lang('ONLY_FAMILY_SEE_THIS'),
      '5' => lang('ONLY_FRIENDS_SEE_THIS'),
  );
  if(!empty($type)){
    return $privacy[$type]; 
  }else{
    return $privacy;
  }
}

function getParentImagesCategories($id = null){
    $ci=& get_instance();
    $ci->load->database(); 
    $ci->db->select(array('id','name','parent_id'));
    $ci->db->order_by("name","asc");
    $ci->db->where(array('parent_id'=>'0','is_deleted'=>'0'));
	  $s = $ci->db->get('image_categories');
	  $result = $s->result_array();
	  $return['0'] = "No Parent";
	  foreach($result as $row){
	   $return[$row['id']] = ucwords($row['name']); 
    }
	  if(!empty($id)){ 
      return $return[$id]; 
    }else{
      return $return;
    }
	
	  
}