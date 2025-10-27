<?php 
/*
SOS Module Email APIs
*/

// Add SOS Email
function add_sos_email_api(){
	  $resident_id = post('resident_id');
	   $condo_id = post('condo_id');
	   $unit_id = post('unit_id');
	   $key = post('key');
	   $email = post('email');
	   $created_at = created_at();
	  
	 // Check status of the account
	 $account_status = check_account_status($resident_id);
	 if(!$account_status){
		 echo key_response('Your account is not active');
	 }else{
		$api_key = check_api_key($key);
		if(!$api_key){
			echo key_response('Invalid key');
		}else{
			if( if_empty($resident_id) || if_empty($condo_id) || if_empty($unit_id)  ){
				echo e_response('Resident id, Condo id, Unit id is required.');
			}else{
			
		   $sos_info =   array(	  
					  'resident_id' =>	$resident_id,
					  'email' =>	$email,
					  'created_at' =>	$created_at				
					  );
				
				 
				 $ci = get_ci_app_env();
				 $ci->load->library('Sos');
				 $ci->sos->save_sos_contact($sos_info);
				 $emails_list = $ci->sos->get_resident_sos_contact_emails($resident_id);
				  echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Data saved successfully.',
											 'data' => $emails_list));
			}
		}
	 }
}


// Edit SOS  Email
function edit_sos_email_api($resident_id, $condo_id, $unit_id, $sos_id, $key){
	 // Check status of the account
	 $account_status = check_account_status($resident_id);
	 if(!$account_status){
		 echo key_response('Your account is not active');
	 }else{
		 $condo_id = $condo_id;
		 $key = $key;
		$api_key = check_api_key($key);
		if(!$api_key){
			echo key_response('Invalid key');
		}else{
			if( if_empty($resident_id) || if_empty($condo_id) || if_empty($unit_id)  || if_empty($sos_id)  ){
				echo e_response('Resident id, Condo id, Unit id, sos is required.');
			}else{
			     $ci = get_ci_app_env();
				  $ci->load->library('Sos');
				  $sos_data = $ci->sos->get_single_sos_contact($sos_id);
				  // display result
				  if(!empty($sos_data) ){
				  echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Data found.',
											 'data' => $sos_data));
				}else{
					echo s_response_2('No data found.');
				}	
			}
		}
	 }
}

// Update SOS Email
function update_sos_email(){
	   $resident_id = post('resident_id');
	   $condo_id = post('condo_id');
	   $unit_id = post('unit_id');
	   $key = post('key');
	   $email = post('email');
	   $sos_id = post('sos_id');
	 $account_status = check_account_status($resident_id);
	 if(!$account_status){
		 echo key_response('Your account is not active');
	 }else{
		 $condo_id = $condo_id;
		 $key = $key;
		$api_key = check_api_key($key);
		if(!$api_key){
			echo key_response('Invalid key');
		}else{
			if( if_empty($resident_id) || if_empty($condo_id) || if_empty($unit_id)  || if_empty($sos_id)  ){
				echo e_response('Resident id, Condo id, Unit id, sos is required.');
			}else{
		  
		    $sos_info =   array(	  
					  'email'         => $email				
					  );
				
				 $ci = get_ci_app_env();
				 $ci->load->library('Sos');
				 $ci->sos->update_sos_contact($sos_info,$sos_id);
				  $emails_list = $ci->sos->get_resident_sos_contact_emails($resident_id);
				  echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Data updated successfully.',
											 'data' => $emails_list));
			}
		}
	 }
}
// Delete SOS email
function delete_sos_email_api($resident_id, $condo_id, $unit_id, $sos_id, $key){
	 // Check status of the account
	 $account_status = check_account_status($resident_id);
	 if(!$account_status){
		 echo key_response('Your account is not active');
	 }else{
		 $condo_id = $condo_id;
		 $key = $key;
		$api_key = check_api_key($key);
		if(!$api_key){
			echo key_response('Invalid key');
		}else{
			if( if_empty($resident_id) || if_empty($condo_id) || if_empty($unit_id)  || if_empty($sos_id)  ){
				echo e_response('Resident id, Condo id, Unit id, sos is required.');
			}else{
				$where = "id=".$sos_id." ";
				$sos_id = display('id','sos_contacts', $where);
				if($sos_id){
				  $ci = get_ci_app_env();
				  $ci->load->library('Sos');
				  $ci->sos->delete_sos_contact($sos_id);
				  
				  // display result
				  echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Data deleted successfully.'));
				}else{
					echo e_response('No data found.');
				}
			}
		}
	 }
	
}



function get_resident_sos_emails_list_api($resident_id, $condo_id, $unit_id, $key){
	 // Check status of the account
	 $account_status = check_account_status($resident_id);
	 if(!$account_status){
		 echo key_response('Your account is not active');
	 }else{
		$api_key = check_api_key($key);
		if(!$api_key){
			echo key_response('Invalid key');
		}else{
			if( if_empty($resident_id) || if_empty($condo_id) || if_empty($unit_id)   ){
				echo e_response('Resident, Codo and Unit id is required.');
			}else{
				$ci = get_ci_app_env();
				$ci->load->library('Sos');
				$sos_contacts_list = $ci->sos->get_resident_sos_contact_emails($resident_id,$condo_id,$unit_id);
				if(!empty($sos_contacts_list)){
					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Data found.',
											 'data' => $sos_contacts_list));
				}else{
					echo s_response_2('No data found.');
				}
			}
		}
	 }
}


// Send SOS email
function send_sos_email_api_old($resident_id, $condo_id, $unit_id, $gps_location, $key){
	 // Check status of the account
	 $account_status = check_account_status($resident_id);
	 if(!$account_status){
		 echo key_response('Your account is not active');
	 }else{
		$api_key = check_api_key($key);
		if(!$api_key){
			echo key_response('Invalid key');
		}else{
			if( if_empty($resident_id) || if_empty($condo_id) || if_empty($unit_id)   ){
				echo e_response('Resident, Codo and Unit id is required.');
			}else{
				$ci = get_ci_app_env();
				$ci->load->library('Sos');
				
				$email_conent = $ci->sos->send_sos_email($resident_id,$condo_id,$unit_id,$gps_location);
				if(!empty($email_conent)){
					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Data found.',
											 'data' => $email_conent));
				}else{
					echo s_response_2('No data found.');
				}
			}
		}
	 }
}

// Send SOS email media
function send_sos_email_media_api_old(){
	$resident_id = post('resident_id');
	$condo_id = post('condo_id');
	$unit_id = post('unit_id');
	$key = post('key');
	 // Check status of the account
	 $account_status = check_account_status($resident_id);
	 if(!$account_status){
		 echo key_response('Your account is not active');
	 }else{
		$api_key = check_api_key($key);
		if(!$api_key){
			echo key_response('Invalid key');
		}else{
			if( if_empty($resident_id) || if_empty($condo_id) || if_empty($unit_id)   ){
				echo e_response('Resident, Codo and Unit id is required.');
			}else{
				
				$ci = get_ci_app_env();
				$ci->load->library('Sos');
				
				if (!empty($_FILES)) {
					$target_path = DOC_ROOT."uploads/sos_attachments/";
					$ext = explode('.', $_FILES['media_attachment']['name']); //explode file name from dot(.) 
                    $file_extension = end($ext); //store extensions in the variable
					$file_name = md5(uniqid()).'_'.time().".mp3"; // Rename the file
					$file_with_path = $target_path.$file_name;
					if(move_uploaded_file($_FILES['media_attachment']['tmp_name'], $file_with_path)){
						//$audio_link = BASE_URL."uploads/sos_attachments/".$file_name;
				        //$attachment_content = base64_encode(file_get_contents($files_to_send));
						//$attachment_array = array($files_to_send =>$attachment_content);
						$audio_link = $file_name;
						
					}
				}else{
					$audio_link = '';
				}
				
				
				$send_email_with_media = $ci->sos->send_sos_email_attachment($resident_id,$condo_id,$unit_id,$audio_link);
				if(!empty($send_email_with_media)){
					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Data found.'));
				}else{
					echo s_response_2('No data found.');
				}
			}
		}
	 }
}


function send_sos_email_api($resident_id, $condo_id, $unit_id, $gps_location, $key){
	 // Check status of the account
	 $account_status = check_account_status($resident_id);
	 if(!$account_status){
		 echo key_response('Your account is not active');
	 }else{
		$api_key = check_api_key($key);
		if(!$api_key){
			echo key_response('Invalid key');
		}else{
			if( if_empty($resident_id) || if_empty($condo_id) || if_empty($unit_id)   ){
				echo e_response('Resident, Codo and Unit id is required.');
			}else{
				$ci = get_ci_app_env();
				$ci->load->library('Sos');
				
				$email_conent = $ci->sos->send_sos_email($resident_id,$condo_id,$unit_id,$gps_location);
				if(!empty($email_conent)){
					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Data found.',
											 'data' => $email_conent));
				}else{
					echo s_response_2('No data found.');
				}
			}
		}
	 }
}


// Send SOS email media
function send_sos_email_post_api(){
	$resident_id = post('resident_id');
	$condo_id = post('condo_id');
	$unit_id = post('unit_id');
	$key = post('key');
	$gps_location = post('gps_location');
	 // Check status of the account
	 $account_status = check_account_status($resident_id);
	 if(!$account_status){
		 echo key_response('Your account is not active');
	 }else{
		$api_key = check_api_key($key);
		if(!$api_key){
			echo key_response('Invalid key');
		}else{
			if( if_empty($resident_id) || if_empty($condo_id) || if_empty($unit_id)   ){
				echo e_response('Resident, Codo and Unit id is required.');
			}else{
				
				$ci = get_ci_app_env();
				$ci->load->library('Sos');
				
				if (!empty($_FILES)) {
					$target_path = DOC_ROOT."uploads/sos_attachments/";
					$ext = explode('.', $_FILES['media_attachment']['name']); //explode file name from dot(.) 
                    $file_extension = end($ext); //store extensions in the variable
					$file_name = md5(uniqid()).'_'.time().".mp3"; // Rename the file
					$file_with_path = $target_path.$file_name;
					if(move_uploaded_file($_FILES['media_attachment']['tmp_name'], $file_with_path)){
						$audio_link = $file_name;
					}
				}else{
					$audio_link = '';
				}
				
				
				$send_email_with_media = $ci->sos->send_sos_email_attachment($resident_id,$condo_id,$unit_id,$gps_location,$audio_link);
				if(!empty($send_email_with_media)){
					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Data found.'));
				}else{
					echo s_response_2('No data found.');
				}
			}
		}
	 }
}

function get_condo_manager_number_api($resident_id,$condo_id,$unit_id,$gps_location,$key){
    // Check status of the account
	 $account_status = check_account_status($resident_id);
	 if(!$account_status){
		 echo key_response('Your account is not active');
	 }else{
		$api_key = check_api_key($key);
		if(!$api_key){
			echo key_response('Invalid key');
		}else{
			if( if_empty($resident_id) || if_empty($condo_id) || if_empty($unit_id)   ){
				echo e_response('Resident, Codo and Unit id is required.');
			}else{
				$ci = get_ci_app_env();
				$ci->load->library('Sos');
				$manager_number = $ci->sos->get_manager_data('phone',$condo_id);
				$msg_content = $ci->sos->sos_email_content('','',$gps_location);
				if(!empty($email_conent) || !empty($manager_number) ){
					$data = array('phone' => $manager_number, 'msg_content' => $msg_content);
					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Data found.',
											 'data' => $data));
				}else{
					echo s_response_2('No data found.');
				}
			}
		}
	 }
}

