<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);



/*----------------------------------------------------------------------------------------------------
*                                      	ALIA Helper 
-----------------------------------------------------------------------------------------------------*/
function get_residents_units_name($condo_id,$where=''){
     $ci =& get_instance();

	 if($where != ''){

		 $where_cond = $where; 

	 }else{

		 $where_cond = '1';

	 }
    $query = $ci->db->query("SELECT  R.name as resident_name,U.name as unit_name,RU.id as resident_unit_id,RU.unit_id as myunit_id,RU.resident_id as myresident_id,

								 C.name as condo_name  FROM

								`residents` AS R

								INNER JOIN `residents_units` AS RU

								ON

								R.`id`=RU.`resident_id` 

								INNER JOIN units as U

								ON

								U.id=RU.unit_id

								INNER JOIN

								condos as C

								ON

								C.id=RU.condo_id

								AND RU.`condo_id`=".$condo_id." 

								WHERE

								 $where_cond

								GROUP BY RU.`resident_id`");

	$result = $query->result_array();

	return $result;					 
}
function general_report($index_column,$table, $where_condition=''){
  	  $ci =& get_instance();
	  if(!empty($where_condition)){
			$where_clause = " WHERE  $where_condition";
		}else{
			$where_clause = " WHERE 1";
		}
	    $sql_query = "SELECT COUNT($index_column) AS cnt FROM $table $where_clause";	
	    $query = $ci->db->query($sql_query);					 
		$result = $query->row();
		return $result->cnt; 
}

function deliveries_registered($condo_id, $range=''){
    $ci =& get_instance();
	if($range==''){
	$where="MONTH(D.deliverydatetime) = MONTH(CURDATE()) AND D.condo_id=".$condo_id." ORDER BY D.`deliverydatetime` ASC";
	}else{
	
	$where="DATE(D.deliverydatetime) BETWEEN '".date('Y-m-d',strtotime($range[0]))."' and '".date('Y-m-d',strtotime($range[1]))."' AND D.condo_id=".$condo_id." ORDER BY D.`deliverydatetime` ASC";
	}
	$sql_query  = "SELECT U.name AS unit_name,R.name AS resident_name,
				D.* FROM delivery_requests AS D 
				INNER JOIN residents AS R 
				ON
				D.delivery_for=R.id 
				INNER JOIN units AS U 
				ON
				D.unit_id=U.id
				WHERE $where";
				 $query = $ci->db->query($sql_query);	
	return $query->result();			 	
   	
}

function visitors_registered($condo_id, $range=''){
    $ci =& get_instance();
	if($range==''){
	$where="MONTH(D.visitdatetime) = MONTH(CURDATE()) AND D.condo_id=".$condo_id." ORDER BY D.`visitdatetime` ASC";
	}else{
	
		$where="DATE(D.visitdatetime) BETWEEN '".date('Y-m-d',strtotime($range[0]))."' and '".date('Y-m-d',strtotime($range[1]))."' AND D.condo_id=".$condo_id." ORDER BY D.`visitdatetime` ASC";
	}
	$sql_query  = "SELECT U.name AS unit_name,R.name AS resident_name,
				D.* FROM visitor_requests AS D 
				INNER JOIN residents AS R 
				ON
				D.visitor_for=R.id 
				INNER JOIN units AS U 
				ON
				D.unit_id=U.id
				WHERE $where";
				 $query = $ci->db->query($sql_query);	
	return $query->result();			 	
   	
}

function helpdesk_report($where_condition=''){
	if(!empty($where_condition)){
			$where_clause = "   $where_condition";
		}else{
			$where_clause = "  1";
		}
		 $ci =& get_instance();
	  $sql_query = "SELECT 
				  IR.*,
				  R.name AS resident_name,
				  U.name AS unit_name,
				  IC.id AS category_id,
				  IC.name AS category_name,
				  INS.name AS status_name,
				  IP.`name` AS priority_name 
				FROM
				  `incident_reporting` AS IR 
				  INNER JOIN `incident_status` AS INS 
					ON IR.`status` = INS.`id` 
				  INNER JOIN `incident_priority` AS IP 
					ON IR.`priority` = IP.`id` 
				  INNER JOIN `units` AS U 
					ON IR.`unit_id` = U.`id` 
				  INNER JOIN `residents` AS R 
					ON IR.`reported_by` = R.`id` 
				  INNER JOIN `incident_categories` AS IC 
					ON IR.`incident_category` = IC.`id` 
				WHERE $where_clause
				ORDER BY priority_name ASC 
							";	
		 $query = $ci->db->query($sql_query);	
	return $query->result_array();						
}

function get_unit_mailing_address($unit_id){
    	 $ci =& get_instance();
	  $sql_query = "SELECT U.name AS unit_name,
			C.name AS condo_name, 
			C.address,A.name AS areas,
			S.name AS state_name,
			C.postcode
			FROM `units` AS U
			INNER JOIN
			`condos` AS C
			ON
			U.`condo_id`=C.`id`
			INNER JOIN
			`residents_units` AS RU
			ON
			U.`id`=RU.`unit_id`
			INNER JOIN
			`states` AS S
			ON
			C.`state`=S.`id`
			INNER JOIN `areas` AS A
			ON
			C.`areas`=A.`id`
			WHERE  RU.`unit_id`=".$unit_id."
							";	
		 $query = $ci->db->query($sql_query);	
		 $row = $query->row();	
		 $full_mailing_address = $row->unit_name.', '.$row->condo_name.', '.$row->address.', '.$row->areas.', '.$row->postcode.', '.$row->state_name;
	return $full_mailing_address ;
}

if ( ! function_exists('delivery_datetime')) :
function delivery_datetime($datetime){
	   if($datetime != '' && $datetime != '0000-00-00 00:00:00')
	   return date('d/m/Y g:i a', strtotime($datetime));
	   else
	   return '-';
  }
endif;

function priorit_type($type){
   switch($type){
	    case "High":   
	      return '<font color="red">'.$type.'</font>';
	    break;
	    case "Medium":
		  return '<font color="blue">'.$type.'</font>';
		 break;
		 case "Low": 
		 return  '<font color="green">'.$type.'</font>';
		 break;  
		
   }
}

function alia_email_helper($to_email, $to_name, $subject, $message, $attachment=''){
	
	 $ci =& get_instance();
	 $ci->load->helper('cruds');
	  
 	     
		// Get condo Name
		$condo_name = select_column_name('name','condos',$ci->session->userdata('condo_id'));
     	$ci->load->library('mailinv2');
		$mailin = new mailinv2('https://api.sendinblue.com/v2.0','TcG27sRLqHmkQnCE');
		$subject = $subject;
		$msg_append = $message;
		$email_footer = '<div style="font-family: Georgia; font-size: 14px;">This message is sent on behalf of '.$condo_name.' Management </style>';
		$msg_append.=$email_footer;
		if($attachment == ''){
		   $data = array( "id" => 2,
    		  "to" => $to_email,
    		  "replyto" => $ci->config->item('email_from'),
    		  "attr" => array("SUBJECT"=>$subject,"MESSAGE"=>$msg_append),	
    		  "headers" => array("Content-Type"=> "text/html;charset=iso-8859-1")	 
    		);
		}else{
		  
		  $data = array( "id" => 2,
    		  "to" => $to_email,
    		  "replyto" => $ci->config->item('email_from'),
    		  "attr" => array("SUBJECT"=>$subject,"MESSAGE"=>$msg_append),
              "attachment" => $attachment,
    		  "headers" => array("Content-Type"=> "text/html;charset=iso-8859-1")	 
    		);  
		}
        

  		//$res = $mailin->send_transactional_template($data);
       //var_dump($res);
	}

function invoice_email_footer_section($condo_name,$before_thank_you_text=''){
	$email_footer_section  = $before_thank_you_text;
   $email_footer_section  .= '<br><br>
Thank you.<br><br>
 
This message is sent on behalf of '.$condo_name.' Management<br><br>

<font color="#C1BDBD" style="font-size:11px">Confidential information may be contained in this e-mail and any files transmitted with it (Message).
If you are not the addressee indicated in this Message (or responsible for delivery of this Message to such person), you are hereby notified that any dissemination, distribution, printing or copying of this Message or any part thereof is strictly prohibited. In such a case, you should delete this Message immediately and advice the sender immediately by return e-mail. No assumption of responsibility or liability whatsoever is undertaken by ALIA and the respective Management of this community in respect of prohibited and unauthorized use by any other person.
</font>';
   return $email_footer_section;	
}

function payment_email_footer_section($condo_name,$resident_type=''){
   $email_footer_section  = '<br>Please ignore this email if payment is already made.<br><br>
 
Thank you.<br><br>
 
This message is sent on behalf of '.$condo_name.' Management<br><br>

<font color="#C1BDBD" style="font-size:11px">Confidential information may be contained in this e-mail and any files transmitted with it (Message).
If you are not the addressee indicated in this Message (or responsible for delivery of this Message to such person), you are hereby notified that any dissemination, distribution, printing or copying of this Message or any part thereof is strictly prohibited. In such a case, you should delete this Message immediately and advice the sender immediately by return e-mail. No assumption of responsibility or liability whatsoever is undertaken by ALIA and the respective Management of this community in respect of prohibited and unauthorized use by any other person.
</font>';
   return $email_footer_section;	
}
// Check Module if allowed
function is_condo_module_allowed($condo_id,$module_id){
	  $col = "id";
	  $table = "condo_modules";
	  $where = "condo_id=".$condo_id." AND module_id=".$module_id."  ";
  	  $allowed = select_column_name_by_where($col,$table,$where);
	  if($allowed){
		  return true;  
	  }else{
		  return false;
	  }
}
// Check for allowed modules
function get_condo_allowed_modules($condo_id){
  	  $ci =& get_instance();
	 
		$q = $ci->db->query("SELECT 
				GROUP_CONCAT(DISTINCT(CM.module_id)) AS allowed_condo_modules,
				GROUP_CONCAT(DISTINCT(SM.`module_name`)) AS allowed_module_names
				FROM `condo_modules` AS CM
				INNER JOIN `system_module` AS SM
				ON
				FIND_IN_SET(CM.`module_id`,SM.`id`)
				WHERE
				CM.`condo_id`=".$condo_id."
				GROUP BY CM.`condo_id`"); 
		return $q->result();
}
// Get manager allowed modules
function get_manager_allowed_modules($condo_id,$manager_id){
  	  $ci =& get_instance();
		$q = $ci->db->query("SELECT 
				GROUP_CONCAT(DISTINCT(CM.module_id)) AS allowed_condo_modules,
				GROUP_CONCAT(DISTINCT(SM.`module_name`)) AS allowed_module_names
				FROM `condo_admin_modules` AS CM
				INNER JOIN `system_module` AS SM
				ON
				FIND_IN_SET(CM.`module_id`,SM.`id`)
				WHERE
				CM.`condo_id`=".$condo_id." AND manager_id=".$manager_id."
				GROUP BY CM.`manager_id`"); 
		return $q->result();
}

// Get Custome role manager allowed modules
function get_custom_manager_allowed_modules($condo_id,$custome_role_id){
  	  $ci =& get_instance();
		$q = $ci->db->query("SELECT 
				GROUP_CONCAT(DISTINCT(CM.module_id)) AS allowed_condo_modules,
				GROUP_CONCAT(DISTINCT(SM.`module_name`)) AS allowed_module_names
				FROM `condo_admin_role_modules` AS CM
				INNER JOIN `system_module` AS SM
				ON
				FIND_IN_SET(CM.`module_id`,SM.`id`)
				WHERE
				CM.`condo_id`=".$condo_id." AND role_id=".$custome_role_id."
				GROUP BY CM.`role_id`"); 
		return $q->result();
}

if ( ! function_exists('check_condo_allowed_modules')) :
	function check_condo_allowed_modules($condo_id,$manager_id='')
	{
		$ci =& get_instance();
		 if($manager_id == ''){
		   $role_based_modules = get_condo_allowed_modules($condo_id);
		 }else if($manager_id != ''){
		   $role_based_modules = get_manager_allowed_modules($condo_id,$manager_id);
		 }
		 if(!empty($role_based_modules)):
		  
		   return $modules_array = explode(',',$role_based_modules[0]->allowed_condo_modules);
		endif;
		
	} 
endif;

if ( ! function_exists('check_condo_customer_manager_allowed_modules')) :
	function check_condo_customer_manager_allowed_modules($condo_id,$manager_id,$custome_role_id)
	{
		$ci =& get_instance();
		   $role_based_modules = get_custom_manager_allowed_modules($condo_id,$manager_id,$custome_role_id);
		 if(!empty($role_based_modules)):
		   return $modules_array = explode(',',$role_based_modules[0]->allowed_condo_modules);
		endif;
		
	} 
endif;



if ( ! function_exists('check_if_manager_allowed')) :
	function check_if_manager_allowed($module_id,$condo_allowed_modules)
	{
		$ci =& get_instance();
		return in_array($module_id, $condo_allowed_modules) ? true : false;  
	} 
endif;

if ( ! function_exists('get_this_condo_allowed_modules')) :
	function get_this_condo_allowed_modules($condo_id)
	{
		$ci =& get_instance();
		$q = $ci->db->query("SELECT SM.id,SM.module_name FROM
				`system_module` AS SM
				INNER JOIN
				`condo_modules` AS CM
				ON
				SM.`id`=CM.`module_id`
				WHERE CM.`condo_id`=".$condo_id."
				ORDER BY SM.module_name ASC"); 
		return $q->result();
	} 
endif;


// user roles list
function get_user_roles_list($condo_id){
	
	$ci =& get_instance();
		$q = $ci->db->query(" SELECT AR.*, COUNT(ARM.id) AS total_modules
						FROM `condo_admin_roles` AS AR
						LEFT JOIN
						`condo_admin_role_modules` AS ARM
						ON
						AR.`id`=ARM.`role_id`
						AND AR.`condo_id`=ARM.`condo_id`
						WHERE AR.`condo_id`=".$condo_id."
						GROUP BY AR.`id`
						ORDER BY AR.id DESC	"); 
		return $q->result_array();
   
}

function get_condo_custom_roles_list($condo_id){
	
	$ci =& get_instance();
		$q = $ci->db->query(" SELECT AR.*
						FROM `condo_admin_roles`  AS AR
						WHERE AR.`condo_id`=".$condo_id."
						ORDER BY AR.id DESC	"); 
		return $q->result_array();
   
}

function get_custom_role_modules_list($role_id){
	
	$ci =& get_instance();
		$q = $ci->db->query("SELECT SM.id,SM.module_name 
					FROM `system_module` AS SM
					INNER JOIN
					`condo_admin_role_modules` AS CRM
					ON
					SM.`id`=CRM.`module_id`
					WHERE CRM.`role_id`=".$role_id."
					ORDER BY SM.`module_name` ASC	"); 
		return $q->result_array();
   
}

function get_manager_condos_list($admin_id){
	
	$ci =& get_instance();
	
		$q = $ci->db->query("SELECT C.id AS condo_id, C.name AS condo_name, C.logo
								FROM 
								`condos` AS C
								INNER JOIN
								`admin_condos` AS AC
								ON
								C.`id`=AC.`condo_id`
								WHERE AC.`admin_id`=".$admin_id."
								ORDER BY C.name ASC	"); 
		return $q->result_array();
   
}

function get_manager_active_condos_list($admin_id){
	
	$ci =& get_instance();
	
		$q = $ci->db->query("SELECT C.id AS condo_id, C.name AS condo_name, C.logo
								FROM 
								`condos` AS C
								INNER JOIN
								`admin_condos` AS AC
								ON
								C.`id`=AC.`condo_id`
								WHERE AC.`admin_id`=".$admin_id."
								AND AC.status='Y'
								ORDER BY C.name ASC	"); 
		return $q->result_array();
   
}





?>