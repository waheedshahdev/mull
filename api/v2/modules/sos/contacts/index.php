<?php 
/*
SOS Module Contacts APIs
*/

// Add SOS Contact
function add_sos_contact_api(){
	  $resident_id = post('resident_id');
	   $condo_id = post('condo_id');
	   $unit_id = post('unit_id');
	   $key = post('key');
	   $contact_name = post('contact_name'); // array
	   $phone = post('contact_phone'); //  array
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
			$ci = get_ci_app_env();
			$ci->load->library('Sos');	
			//$sos_info = array();
			foreach($_POST['contact_name'] as $key=>$name):
			   if(!empty($name)){
				    $sos_info =   array(	  
					  'resident_id' =>	$resident_id,
					  'contact_name' =>	$name,
					  'phone' =>	$_POST['contact_phone'][$key],
					  'created_at' =>	$created_at				
					  );
					$ci->sos->save_sos_contact($sos_info);  
			   }  
			endforeach;
		     
				
				 
				 
				 $contacts_list = $ci->sos->get_resident_sos_contacts($resident_id);
				 
				  echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Data saved successfully.',
											 'data' => $contacts_list));
			}
		}
	 }
}


// Edit SOS Contact
function edit_sos_contact_api($resident_id, $condo_id, $unit_id, $sos_id, $key){
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

// Update SOS contact
function update_sos_contact(){
	   $resident_id = post('resident_id');
	   $condo_id = post('condo_id');
	   $unit_id = post('unit_id');
	   $key = post('key');
	   $contact_name = post('contact_name');
	   $phone = post('contact_phone');
	   $contact_email = post('contact_email');
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
					  'resident_id'   => $resident_id,
					  'contact_name'  => $contact_name,
					  'email' => $contact_email,
					  'phone'         => $phone,				
					  );
				
				 $ci = get_ci_app_env();
				 $ci->load->library('Sos');
				 $ci->sos->update_sos_contact($sos_info,$sos_id);
				  $contacts_list = $ci->sos->get_resident_sos_contacts($resident_id);
				  echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Data updated successfully.',
											 'data' => $contacts_list));
			}
		}
	 }
}
// Delete SOS contact
function delete_sos_contact_api($resident_id, $condo_id, $unit_id, $sos_id, $key){
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



function get_resident_sos_contacts_list_api($resident_id, $condo_id, $unit_id, $key){
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
				$sos_contacts_list = $ci->sos->get_resident_sos_contacts($resident_id,$condo_id,$unit_id);
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
