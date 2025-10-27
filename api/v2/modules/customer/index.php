<?php 
// Customer APIs


function testing()
{
	$ci = get_ci_app_env();

	$this->ci->load->library('customer');
	echo 'im here';
	
}







function signup(){
	$customer_name = post('customer_name');
	$email = post('email');
	$mobile_number = post('mobile_number');
	$password = post('password');
	$verification_code = rand(00000,99999);

	if( if_empty($email) || if_empty($password) || if_empty($customer_name)|| if_empty($mobile_number)  ){
		echo e_response('All fields are required.');
	}else{
		$where = "email='".$email."' or mobile_number='".$mobile_number."'";
		$data = get_table_data('tbl_customers', $where);
		if($data == true){
			echo e_response('Email and mobile number already Exists');
		}else{
			$data = array(
					'customer_name' => $customer_name,
					'email' => $email,
					'password' => md5($password),
					'mobile_number' => $mobile_number,
					'verification_code' => $verification_code
				);
			$result = save_data('tbl_customers',$data);
			if($result){
				$to = $mobile_number;
				// $subject = 'Verification Code';
				$message =  'Hi '.$customer_name.'
				Here is your Verification code: 
				 '.$verification_code;
				// send_email($email,$subject, $message);
				sms_api($to,$message);

				 echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Successfully Signup.',
								 'data' => $result));
			}
		}
	}


}

// validate verification code 
function validate_verification(){
	 $verification_code = post('verification_code');
	 $customer_id = post('customer_id');	

	   if( if_empty($verification_code)){
			echo e_response('Verification code is required.');
		}else{
		   $where = "verification_code='".$verification_code."'";
		   $data = get_single_row('tbl_customers', $where);
		    if($data == false){
				
					  echo json_encode(array('status' => 'failed', 
				                        'errorCode' => 1,
									    'message' => 'Invalid Verification Code'));	
			}else{
				// Update customer
				$updat_fields = array('verification_code' => 1);
				update_data('tbl_customers',$updat_fields,$data['id']);
				//update_data('tbl_customers',$updat_fields,$customer_id);
				echo json_encode(array('status' => 'success', 
				                        'errorCode' => 0,
									    'message' => 'Verification successfull'));	
			   }
		}
}

function Login(){
	$mobile_number = post('mobile_number');
	$password = post('password');
	$gcm_id = post('gcm_id');
	//$customer_location = post('customer_location');
	if( if_empty($mobile_number) || if_empty($password) ){
		echo e_response('Both fields are required.');
	}else{

	
		$where1 = "verification_code <> '1' AND mobile_number = '".$mobile_number."'";
		$data_search = get_table_data('tbl_customers',$where1);
		if($data_search == true){
		$resend_code = $data_search[0]->verification_code;
		$name = $data_search[0]->customer_name;
		$to = $mobile_number;

			$message =  'Dear '.$name.'
				Here is your New Verification code: 
				'.$resend_code;

				sms_api($to,$message);

			echo json_encode(array('status' => 'failed',
								 'errorCode' => 3,
								 'message' => 'Please Verify Your Account.',
								 'data' => ''));
		}
		
		// i have to write verification_code = 1 in where condition where this will be okay
		$where = "mobile_number='".$mobile_number."' AND password='".md5($password)."' AND verification_code = '1'";
		$data = get_table_data('tbl_customers', $where);

		$sql_query = "UPDATE tbl_customers SET gcm_id = '".$gcm_id."', last_login = CURRENT_TIMESTAMP(), customer_status = 'Online' WHERE mobile_number = '".$mobile_number."'";
		$result = execute_query($sql_query);

		if($data == false){
			 // No data found
			
			  echo json_encode(array('status' => 'failed',
								 'errorCode' => 2,
								 'message' => 'Phone Number and Password Not Correct.',
								 'data' => ''));
			
			
			
			}else{
				 $data_array['id'] = $data[0]->id;
				 $data_array['customer_name'] = $data[0]->customer_name;
				 $data_array['email'] = $data[0]->email;
				 $data_array['mobile_number'] = $data[0]->mobile_number;
				 $data_array['amount'] = $data[0]->amount;
				 $data_array['amount_type'] = $data[0]->amount_type;
				 //$data_array['token'] = apiKey();
				     $response_data[] = $data_array;
				 // Update Key
				// $key = $data_array['token'];
				// $updat_fields = array('api_key' => $key);
				// update_data('tbl_customers',$updat_fields,$customer_id);
				 // Return json response
				 echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Successfully logged in.',
								 'data' => $response_data));
			}
	}
	
}
//customer update profile 
function update_customer()
{
	$customer_name=post("customer_name");
	$email=post("email");
	$customer_id=post("id");
	if( if_empty($email) || if_empty($customer_name) || if_empty($customer_id)  ){
		echo e_response('All fields are required.');
	}else{
		
		
		 $data = array(
					'customer_name' => $customer_name,
					'email' => $email,
				
				);
		    $result = update_data('tbl_customers',$data,$customer_id);
			 $where =" id = '".$customer_id."'";
             $data = get_table_data('tbl_customers', $where);
			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Successfully updated profile.',
								 'data' => $data
								 ));
		}
	}
	//customer update profile Ends

// customer forgot password API
function forgot_password(){
	 $mobile_number = post('mobile_number');
	// $customer_id = post('customer_id');
	 
	 
	   if( if_empty($mobile_number))
	   {
			echo e_response('Mobile Number is required and Customer ID is required.');
		}
		else
		{
		   $where = "mobile_number='".$mobile_number."'";
		   $data = get_single_row('tbl_customers', $where);
		    if($data == false){
				
					  echo json_encode(array('status' => 'failed', 
				                        'errorCode' => 1,
									    'message' => 'Invalid Mobile Number')); 
				
			}else{
					$new_password = rand(00000,99999);

					$new_pass = array(
							'password' => md5($new_password)
						);
					$result = update_data('tbl_customers',$new_pass,$data['id']);
					
					
						$to = $mobile_number;
						$message = ' Dear '.$data['customer_name'].' 
						Here is your New Password: 
						'.$new_password.'
						';
						// send_email($email,$subject, $email_message);
						  sms_api($to,$message);	
										
						echo json_encode(array('status' => 'success', 
				                        'errorCode' => 0,
									    'message' => 'New Password Successfully Send'));

						//}
					// 	else
					// 	{
					// 	echo json_encode(array('status' => 'failed', 
				 //                        'errorCode' => 2,
					// 				    'message' => 'Password Not Send. Please try Again'));
					// }
			   }
		}
}
// all categories API

function get_categories($customer_id){

			if( if_empty($customer_id) ){
				echo e_response('customer id is required.');
			}else{
             $where =" id IS NOT NULL AND category_name IS NOT NULL ";
             $table = "tbl_categories";
            $data = get_table_data($table, $where);
             // $data = get_query_data("SELECT * FROM tbl_categories  JOIN tbl_rates on tbl_rates.category_id = tbl_categories.id");


            // $sql_query = "SELECT C.id AS category_id, C.category_name AS category_name
 			// 					FROM
 			// 					`tbl_categories` AS C ";
 			// 	$result = execute_query($sql_query);
 			// 	$num_rows = num_rows($result);
 			// 	if($num_rows > 0){
 			// 		 $condos_data = array();
 			// 		while($row = fetch_object($result)):
 			// 		   $condos_data['category_id'] = $row->category_id;
 			// 		   $condos_data['category_name'] = $row->category_name;
 			// 		   $condo_array[] = $condos_data;
 			// 		endwhile;

 			
				if(!empty($data)){
					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Data found.',
											 'data' => $data));
				}else{
					echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'No data found',
											 'data' => ''));
				}
			}
		
}

// version API


function customer_app_version(){

	
             $where =" app_name = 'customer' AND status = 'Active'";
             $table = "tbl_versions";
            $data = get_table_data($table, $where);

           		 $data_array['id'] = $data[0]->id;
				 $data_array['version'] = $data[0]->version;
				 $response_data[] = $data_array;

 			
				if(!empty($data)){
					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Version found.',
											 'data' => $data_array));
				}else{
					echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'No version found',
											 'data' => ''));
				}
			
		
}

// end customer version API

// version API


function customer_contact_us(){

		$customer_id = post('customer_id');

			if( if_empty($customer_id) ){
				echo e_response('customer id is required.');
			}else{
             $where =" app_name = 'customer' AND status = 'Active'";
             $table = "tbl_contact_number";
            $data = get_table_data($table, $where);
            

 			
				if(!empty($data)){
					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'contact found.',
											 'data' => $data));
				}else{
					echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'No contact found',
											 'data' => ''));
				}
			}
		
}

// end customer version API

// customer logout API
function customer_logout(){

		$customer_id = post('customer_id');

			if( if_empty($customer_id) ){
				echo e_response('customer id is required.');
			}else{

            $sql_query = "UPDATE tbl_customers SET customer_status = 'Offline' WHERE id = '".$customer_id."'";
			$result = execute_query($sql_query);

 			
				if($result){
					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Logout Successfully.',
											 'data' => ''));
				}else{
					echo json_encode(array('status' => 'success',
											 'errorCode' => 1,
											 'message' => 'Something Went Wrong!  Not Logging Out',
											 'data' => ''));
				}
			}
		
}

// end customer Logout API
// convert location 

function getaddress($lat,$lng)
{   

        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
        $json = @file_get_contents($url);
        $data=json_decode($json);
        $status = $data->status;
        if($status=="OK")
        return $data->results[0]->formatted_address;
        else
        return false;

   
}

// end convert location


// check customer location for availability in area
function check_customer_location(){

		$customer_id = post('customer_id');
		$customer_location = post('customer_location');

			if( if_empty($customer_id) ){
				echo e_response('customer id is required.');
			}else{

			// $address = explode("-",$customer_location);
			// $lat = $address[0];
			// $lng = $address[1];

			
			// $convert_loc = getaddress($lat,$lng);

			$sql_query = " UPDATE tbl_customers SET customer_location = '".$customer_location."' WHERE tbl_customers.id = '".$customer_id."'";
			$result = execute_query($sql_query);


           	$query = get_query_data("SELECT tbl_customers.customer_location AS location FROM tbl_customers WHERE tbl_customers.id = '".$customer_id."'");
           	$result = $query['location'];
           	$q = explode(",",$result);
           	$address = $q[1];
          	$address2 = $q[2];
 			
				if($address  == ' Swat' || $address2 == ' Swat' || $address2 == ' Rawalpindi'){
					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'MULL Working in this Area',
											 'data' => ''));
				}else{
					echo json_encode(array('status' => 'failed',
											 'errorCode' => 1,
											 'message' => 'MULL is Not Working in this Area.',
											 'data' => ''));
				}
			}
		
}


// end chec customer location




