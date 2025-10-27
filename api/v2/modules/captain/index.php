<?php 
// Captains APIs





function Login_captain(){
	$mobile_number = post('mobile_number');
	$password = post('password');
	$gcm_id = post('gcm_id');
	if( if_empty($mobile_number) || if_empty($password) ){
		echo e_response('Both fields are required.');
	}else{



		$where = "mobile_number='".$mobile_number."' AND password='".md5($password)."'";
		//$data = get_table_data('tbl_captains', $where);
		$data = get_query_data("SELECT *,tbl_cars.car_reg_number AS registration_number,tbl_district.district_name AS district_name,tbl_captains.id AS captain_id,tbl_captains.status AS captain_status_1, tbl_cars.category_id AS category_id, tbl_categories.category_name AS category_name FROM tbl_captains 
			JOIN tbl_cars ON tbl_cars.id = tbl_captains.car_id 
			JOIN tbl_categories ON tbl_categories.id = tbl_cars.category_id
			JOIN tbl_district ON tbl_district.id = tbl_captains.district_id 
			WHERE ".$where."");

		$sql_query = "UPDATE tbl_captains SET gcm_id = '".$gcm_id."', last_login = CURRENT_TIMESTAMP(), captain_status = 'Online' WHERE mobile_number = '".$mobile_number."'";
		$result = execute_query($sql_query);

		if($data == false){
			 // No data found
			  echo e_response('Authentication failed. Try again.');
			}else{

				 $data_array['captain_id'] =  $data['captain_id'] ;
				 $data_array['captain_name'] = $data['captain_name'];
				 $data_array['captain_image'] = $data['captain_image'];
				 $data_array['mobile_number'] = $data['mobile_number'];
				 $data_array['captain_status'] = $data['captain_status']; 
				 $data_array['status'] = $data['captain_status_1']; 
				 $data_array['riding_type'] = $data['riding_type']; 
				 $data_array['amount'] = $data['amount'];
				 $data_array['amount_type'] = $data['amount_type'];
				 $data_array['car_id'] = $data['car_id'];
				 $data_array['registration_number'] = $data['registration_number'];
				 $data_array['district_name'] = $data['district_name'];
				 $data_array['category_id'] = $data['category_id'];
				 $data_array['category_name'] = $data['category_name'];
				 $response_data[] = $data_array;
				 echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Successfully logged in.',
								 'data' => $response_data));
			}
	}
	
}

// //status online

function status_online()
{   

	$id = post('id');
	if( if_empty($id) ){
				echo e_response('captain id is required.');
			}else{
	 
			 $data = array(
					'captain_status' => 'Online'
				);
		     $result = update_data('tbl_captains',$data,$id);

			     $where =" id = ".$id." ";
             	 $data = get_table_data('tbl_captains', $where);
             	 if($data == true){
                 $data_array['id'] = $data[0]->id;
				 $data_array['captain_name'] = $data[0]->captain_name;
				 $data_array['captain_status'] = $data[0]->captain_status; 
				 $response_data[] = $data_array;

			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Status Online.',
								 'data' => $response_data
								 ));
		}else{
			echo e_response('Something Went Wrong!  Captain not Online.');
		}

			
			}
}

// //status offline

function status_offline()
{   

	$id = post('id');
	if( if_empty($id) ){
				echo e_response('captain id is required.');
			}else{
	 
			 $data = array(
					'captain_status' => 'Offline'
				);
		     $result = update_data('tbl_captains',$data,$id);

			     $where =" id = ".$id." ";
             	 $data = get_table_data('tbl_captains', $where);
             	 if($data == true){
                 $data_array['id'] = $data[0]->id;
				 $data_array['captain_name'] = $data[0]->captain_name;
				 $data_array['captain_status'] = $data[0]->captain_status; 
				 $response_data[] = $data_array;

			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Status Offline.',
								 'data' => $response_data
								 ));
		}else{
			echo e_response('Something Went Wrong!  Captain not Offline.');
		}

			
			}
}

//captain rating

function captain_rating()
{
	$data['captain_id'] = post('captain_id');
   	$captain_id =post('captain_id');
	$data['rating_stars']=post("rating_stars");
	$data['customer_id']=post("customer_id");
	if(save_data("tbl_ratings",$data))
	{
		$average = get_query_data("SELECT AVG(rating_stars) AS cnt FROM tbl_ratings where captain_id=$captain_id");
	
		$rating_average=$average['cnt'];

		  echo json_encode(array('status' => 'success', 
								 'data' => round($rating_average,1))); 	
	}else{
				  echo json_encode(array('status' => 'failed', 
										 'message' => 'Error occured'));
	}
}


//  customer forgot password API
function captain_forgot_password(){
	 $captain_id = post('id');
	 $mobile_number = post('mobile_number');
	 
	 
	   if(if_empty($mobile_number) )
	   {
			echo e_response('Captain Id and Mobile Number is required.');
		}
		else
		{
		   $where = "mobile_number='".$mobile_number."'";
		   $data = get_single_row('tbl_captains', $where);
		    if($data == false){
				
					  echo json_encode(array('status' => 'failed', 
				                        'errorCode' => 1,
									    'message' => 'Invalid Mobile Number')); 
				
			}else{
					$new_password = rand(0000,9999);
					$new_pass = array(
							'password' => md5($new_password)
						);
					$result = update_data('tbl_captains',$new_pass,$data['id']);
					if($result){
						// $to = $data['email'];
						// $subject = 'New Password';
						// $message =  'Hi'.$data['captain_name'].'</n>
						// Here is your New Password </n>
						// New Password:  '.$new_password;
						$to = $mobile_number;
						$message = 'Dear Captain
							Your New Password is '.$new_password.'';

							sms_api($to,$message);
					// send_email($to,$subject, $message);
					echo json_encode(array('status' => 'success', 
				                        'errorCode' => 0,
									    'message' => 'New Password Successfully Send'));
				}else{
					echo json_encode(array('status' => 'failed', 
				                        'errorCode' => 2,
									    'message' => 'Sorry Password Not send Please Try again later'));
					
			  
			   }
				}
		}
}

//Captain update profile 
function update_captain_profile()
{

	$password = post('password');
	$captain_id = post('id');
	
	if( if_empty($password) || if_empty($captain_id)){
		echo e_response('All fields required.');
	}else{
		
		
		 $data = array(

					'password' => md5($password)
				);
		    $result = update_data('tbl_captains',$data,$captain_id);
			 $where =" id = ".$captain_id." ";
             $data = get_table_data('tbl_captains', $where);
			if($data == true){
                 $data_array['id'] = $data[0]->id;
				 $data_array['captain_name'] = $data[0]->captain_name;
				 $data_array['captain_status'] = $data[0]->captain_status; 
				 $response_data[] = $data_array;

			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Password Successfully Updated.',
								 'data' => $response_data
								 ));
		}else{
			echo e_response('Something Went Wrong!');
		}
		}
	}


// query for day of week group by      SELECT DAYOFWEEK(DATE(created_at)), COUNT(id) FROM tbl_rides WHERE captain_id = 2 GROUP BY DAYOFWEEK(DATE(created_at))

	//select count(id), str_to_date(concat(yearweek(created_at), ' friday'), '%X%V %W') from tbl_rides WHERE captain_id = 2 group by yearweek(created_at)
// below query for fines in captain week total api

	//   --             INNER JOIN 
    // --             (SELECT 
    // --          		 CASE
   	// -- 			 WHEN COUNT(F.id) IS NULL   THEN 0
   	// -- 			 ELSE COUNT(F.id)
  		// -- 			END AS Saleable
				// -- FROM tbl_fines AS F
				
				// -- WHERE F.captain_id = 2 AND YEARWEEK(F.created_at) = YEARWEEK(NOW()) group by 	yearweek(F.created_at)) t4



function captain_week_total($captain_id){
	$captain_id = $captain_id;
	 // Check status of the account
	
			if( if_empty($captain_id) ){
				echo e_response('Captain ID is required.');
			}else{
				
				$sql_query = "SELECT *,extra_pay_by_customer - less_pay_by_customer AS Extra_payment FROM (SELECT

				count(R.id) AS count_data,
				sum(R.ride_amount) AS rides_amount,
				sum(C.customer_pay_to_captain) AS total_collection,
				SUM(C.pay_to_us) AS mull_share,
				SUM(C.pay_to_cap) AS captain_net_amount,
				str_to_date(concat(yearweek(R.created_at), ' friday'), '%X%V %W') AS week_data
				FROM tbl_rides AS R
				JOIN tbl_calculation AS C on C.ride_id = R.id 
				WHERE captain_id = '".$captain_id."' AND YEARWEEK(R.created_at) = YEARWEEK(NOW())) t1
                INNER JOIN
                (SELECT 
                CASE 
                WHEN  SUM(C.balance_amount) IS NULL THEN 0
                ELSE 
				SUM(C.balance_amount) END AS extra_pay_by_customer,
				str_to_date(concat(yearweek(R.created_at), ' friday'), '%X%V %W') AS week_data1
				FROM tbl_rides AS R
				JOIN tbl_calculation AS C on C.ride_id = R.id 
				WHERE captain_id = '".$captain_id."' AND balance_type = 'M' AND YEARWEEK(R.created_at) = YEARWEEK(NOW())) t2
                INNER JOIN 
                (SELECT
                CASE
                WHEN  SUM(C.balance_amount) IS NULL THEN 0 
                ELSE
				SUM(C.balance_amount) END AS less_pay_by_customer,
				str_to_date(concat(yearweek(R.created_at), ' friday'), '%X%V %W') AS week_data2
				FROM tbl_rides AS R
				JOIN tbl_calculation AS C on C.ride_id = R.id 
				WHERE captain_id = '".$captain_id."' AND C.balance_type = 'C' AND YEARWEEK(R.created_at) = YEARWEEK(NOW())) t3
				
				

				";

				// INNER JOIN 
    //             (SELECT
               
				// W.status AS paid_status,
				// str_to_date(concat(yearweek(R.created_at), ' friday'), '%X%V %W') AS week_data3
				// FROM tbl_rides AS R
				// JOIN tbl_weekly_payments AS W on W.captain_id = R.captain_id 
				// WHERE W.captain_id = '".$captain_id."' AND W.week = str_to_date(concat(yearweek(R.created_at), ' friday'), '%X%V %W') AND YEARWEEK(R.created_at) = YEARWEEK(NOW())) t4

				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $weekly_data = array();
					while($row = fetch_object($result)):
					   $weekly_data['count_data'] = $row->count_data;
					   $weekly_data['week_data'] = $row->week_data;
					   $weekly_data['rides_amount'] = $row->rides_amount;
					   $weekly_data['total_collection'] = $row->total_collection;
					   $weekly_data['mull_share'] = round($row->mull_share,1);
					   $weekly_data['captain_net_amount'] = round($row->captain_net_amount,1);
					   $weekly_data['extra_pay_by_customer'] = $row->extra_pay_by_customer;
					   $weekly_data['less_pay_by_customer'] = $row->less_pay_by_customer;
					   $weekly_data['paid_status'] = 'Unpaid';
					   //$weekly_data['paid_status'] = $row->paid_status;
					   $weekly_data['paid_week'] = $row->week_data;
					   $weekly_data['Extra_payment'] = $row->Extra_payment;
					   $weekly_array[] = $weekly_data;
					endwhile;

					echo json_encode(array('status' => 'success',
										 'errorCode' => 0,
										 'message' => 'Weekly data found.',
										 'Weekly_List' => $weekly_array));
				}else{
					echo json_encode(array('status' => 'failed',
										 'errorCode' => 1,
										 'message' => 'No Weekly data found.',
										 'Weekly_List' => ''));
				}

				
					
				
			}
	
}


//captain Daily rides 
function captain_daily_rides($captain_id){
	$captain_id = $captain_id;
	 // Check status of the account

			if( if_empty($captain_id) ){
				echo e_response('Captain ID is required.');
			}else{

				$sql_query = "SELECT *,tbl_rides.id AS ride_id FROM tbl_rides join tbl_calculation on tbl_calculation.ride_id = tbl_rides.id
                                                     WHERE captain_id = ".$captain_id." AND DATE(tbl_rides.created_at) = CURDATE()";

				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $daily_data = array();
					while($row = fetch_object($result)):
					   // $daily_data['pickup_lat'] = $row->pickup_lat;
					   // $daily_data['pickup_lng'] = $row->pickup_lng;
					   // $daily_data['distination_lat'] = $row->distination_lat;
					   // $daily_data['distination_lng'] = $row->distination_lng;
					  // $daily_data['ride_amount'] = $row->ride_amount;
					   $daily_data['ride_id'] = $row->ride_id;
					   $daily_data['ride_amount'] = $row->ride_amount;
					   $daily_data['ride_type'] = $row->ride_type;
					   $daily_data['created_at'] = $row->created_at;
					   $daily_array[] = $daily_data;
					endwhile;
					echo json_encode(array('status' => 'success',
										 'errorCode' => 0,
										 'message' => 'Daily Ride data found.',
										 'Daily_List' => $daily_array));
				}else{
					echo json_encode(array('status' => 'failed',
										 'errorCode' => 1,
										 'message' => 'No daily Rides data found.',
										 'Daily_List' => ''));
				}
				
				
			}
	
}




//captain Daily individual ride detail 
function captain_daily_ride_detail($captain_id,$ride_id){
	$captain_id = $captain_id;
	$ride_id = $ride_id;
	 // Check status of the account

			if( if_empty($captain_id) ){
				echo e_response('Captain ID and Ride ID is required.');
			}else{

				$sql_query = "SELECT *,tbl_calculation.customer_pay_to_captain AS customer_pay, tbl_calculation.pay_to_us AS mul_share,
							tbl_calculation.pay_to_cap AS captain_share, tbl_calculation.balance_amount AS remaining_amount,
							tbl_calculation.balance_type AS remaining_amount_pay_to FROM tbl_rides join tbl_calculation on tbl_calculation.ride_id = tbl_rides.id
                                                     WHERE captain_id = ".$captain_id." AND tbl_rides.id = ".$ride_id."";

				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $daily_data = array();
					while($row = fetch_object($result)):
						
						$status  =$row->ride_type;
						if($status = "R"){
							$ride_type = "Regular";
						}else if($status = "F"){
							$ride_type = "Fixed";
						}
						$remainig = $row->remaining_amount_pay_to;
						if($remainig = "M"){
							$remain = "Mul";
						}else if($remainig = "C"){
							$remain = "Captain";
						}


					   $daily_data['pickup_lat'] = $row->pickup_lat;
					   $daily_data['pickup_lng'] = $row->pickup_lng;
					   $daily_data['distination_lat'] = $row->distination_lat;
					   $daily_data['distination_lng'] = $row->distination_lng;
					   $daily_data['ride_amount'] = $row->ride_amount;
					   $daily_data['customer_pay'] = $row->customer_pay;
					   $daily_data['mul_share'] = $row->mul_share;
					   $daily_data['captain_share'] = $row->captain_share;
					   $daily_data['remaining_amount'] = $row->remaining_amount;
					   $daily_data['remaining_amount_pay_to'] = $remain;
					   $daily_data['ride_type'] = $ride_type;
					   $daily_data['created_at'] = $row->created_at;
					   $daily_array[] = $daily_data;
					endwhile;
					echo json_encode(array('status' => 'success',
										 'errorCode' => 0,
										 'message' => 'Daily Ride data found.',
										 'Daily_List' => $daily_array));
				}else{
					echo json_encode(array('status' => 'failed',
										 'errorCode' => 1,
										 'message' => 'No daily Rides data found.',
										 'Daily_List' => ''));
				}
				
				
			}
	
}

// assign car to captain

function assign_car()
{
	$car_id = post('car_id');
	$captain_id=post("id");
	if( if_empty($captain_id) || if_empty($car_id)  ){
		echo e_response('All fields are required.');
	}else{
		
		
		 $data = array(
					'car_id' => $car_id
				);
		    $result = update_data('tbl_captains',$data,$captain_id);
			

             $sql_query = "SELECT CAP.captain_name AS name,CAP.captain_status AS captain_status,CAR.car_reg_number AS car_registration,
             				C.name AS car_company,
             				T.type_name AS car_type
             				FROM tbl_captains AS CAP 
             				JOIN tbl_cars AS CAR  ON
             				CAR.id = CAP.car_id
             				JOIN car_companies AS C ON
             				C.id = CAR.car_company_id
             				JOIN car_types AS T ON
             				T.id = CAR.car_type_id
             				WHERE CAP.id = ".$captain_id."
				";

				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $data_array = array();
					while($row = fetch_object($result)):
				$data_array['name'] = $row->name;
				 $data_array['captain_status'] = $row->captain_status; 
				 $data_array['car_registration'] = $row->car_registration; 
				 $data_array['car_company'] = $row->car_company; 
				 $data_array['car_type'] = $row->car_type; 
				 $response_data[] = $data_array;
					endwhile;
				
			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Assign Car.',
								 'data' => $response_data
								 ));
		}else{
			echo e_response('Something Went Wrong!');
		}
		}
	}


// car list against captain id and vendor id 
 function captain_vendor_cars($captain_id){
	$captain_id = $captain_id;
	 // Check status of the account

			if( if_empty($captain_id) ){
				echo e_response('Captain ID is required.');
			}else{

				$sql_query = "SELECT C.vendor_id,tbl_cars.car_reg_number AS registration_number, tbl_cars.id AS car_id, car_companies.name AS car_company_name FROM tbl_captains 			AS C JOIN tbl_vendors on tbl_vendors.id = C.vendor_id JOIN tbl_cars on tbl_cars.vendor_id = tbl_vendors.id JOIN
								car_companies on car_companies.id = tbl_cars.car_company_id WHERE C.id = ".$captain_id."";

				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $car_data = array();
					while($row = fetch_object($result)):
					   $car_data['car_id'] = $row->car_id;
					   $car_data['vendor_id'] = $row->vendor_id;
					   $car_data['registration_number'] = $row->registration_number;
					   $car_data['car_company_name'] = $row->car_company_name;
					   $car_array[] = $car_data;
					endwhile;
					echo json_encode(array('status' => 'success',
										 'errorCode' => 0,
										 'message' => 'Captain vendor all car data found.',
										 'Daily_List' => $car_array));
				}else{
					echo json_encode(array('status' => 'failed',
										 'errorCode' => 1,
										 'message' => 'No car data found.',
										 'Daily_List' => ''));
				}
				
				
			}
	
}

// change Ride type to Regular api

function change_ride_type_R()
{   

	$captain_id = post('id');
	if( if_empty($captain_id) ){
				echo e_response('captain id is required.');
			}else{
	 
			 $data = array(
					'riding_type' => 'R'
				);
		     $result = update_data('tbl_captains',$data,$captain_id);

			     $where =" id = ".$captain_id." ";
             	 $data = get_table_data('tbl_captains', $where);
             	 if($data == true){
                 $data_array['id'] = $data[0]->id;
				 $data_array['captain_name'] = $data[0]->captain_name;
				 $data_array['riding_type'] = $data[0]->riding_type; 
				 $response_data[] = $data_array;

			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Riding status change to Fixed.',
								 'data' => $response_data
								 ));
		}else{
			echo e_response('Something Went Wrong!  Riding status not change to fixed.');
		}

			
			}
}


// change Ride type to fixed

function change_ride_type_F()
{   

	$captain_id = post('id');
	if( if_empty($captain_id) ){
				echo e_response('captain id is required.');
			}else{
	 
			 $data = array(
					'riding_type' => 'F'
				);
		     $result = update_data('tbl_captains',$data,$captain_id);

			     $where =" id = ".$captain_id." ";
             	 $data = get_table_data('tbl_captains', $where);
             	 if($data == true){
                 $data_array['id'] = $data[0]->id;
				 $data_array['captain_name'] = $data[0]->captain_name;
				 $data_array['riding_type'] = $data[0]->riding_type; 
				 $response_data[] = $data_array;

			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Riding status changed to Regular.',
								 'data' => $response_data
								 ));
		}else{
			echo e_response('Something Went Wrong!  Riding status not change successfully.');
		}

			
			}
}

// Add Fixed ride type data by captain


function add_fixed_amount()
{   

	$captain_id = post('captain_id');
	$category_id = post('category_id');
	$trip_amount = post('trip_amount');
	$trip_type = post('trip_type');
	$description = post('description');
	if( if_empty($captain_id) ){
				echo e_response('captain id is required.');
			}else{
	 
			 $data = array(
					'captain_id' => $captain_id,
					'category_id' => $category_id,
					'trip_amount' => $trip_amount,
					'trip_type' => $trip_type,
					'description' => $description,
				);
		     $result = save_data('tbl_fixed_price',$data);

			     $where =" captain_id = ".$captain_id." ";
             	 $data = get_table_data('tbl_fixed_price', $where);
             	 if($data == true){
				 $data_array['id'] = $data[0]->id; 
				 $data_array['trip_amount'] = $data[0]->trip_amount; 
				 $data_array['trip_type'] = $data[0]->trip_type; 
				 $response_data[] = $data_array;

			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Fixed amount successfully Added.',
								 'data' => $response_data
								 ));
		}else{
			echo e_response('Something Went Wrong!  Fixed amount not addedd.');
		}

			
			}
}


// update fixed amount

function update_fixed_amount()
{   
	$id = post('id');
	$captain_id = post('captain_id');
	$category_id = post('category_id');
	$trip_amount = post('trip_amount');
	$trip_type = post('trip_type');
	if( if_empty($captain_id) ){
				echo e_response('captain id is required.');
			}else{
	 
			 $data = array(
					'category_id' => $category_id,
					'trip_amount' => $trip_amount,
					'trip_type' => $trip_type
				);
		     $result = update_data('tbl_fixed_price',$data,$id);

			     $where =" captain_id = ".$captain_id." ";
             	 $data = get_table_data('tbl_fixed_price', $where);
             	 if($data == true){
				 $data_array['trip_amount'] = $data[0]->trip_amount; 
				 $data_array['trip_type'] = $data[0]->trip_type; 
				 $response_data[] = $data_array;

			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Update Fixed amount.',
								 'data' => $response_data
								 ));
		}else{
			echo e_response('Something Went Wrong!  Fixed amount not updated.');
		}

			
			}
}



// fines api

 function total_fines($captain_id){
	$captain_id = $captain_id;
	 // Check status of the account

			if( if_empty($captain_id) ){
				echo e_response('Captain ID is required.');
			}else{

				$sql_query = "SELECT
					 CASE 
                WHEN  count(F.id) IS NULL THEN 0
                ELSE
				count(F.id) END AS count_fines,F.id AS fine_id,
				str_to_date(concat(yearweek(F.created_at), ' friday'), '%X%V %W') AS week_data
				FROM tbl_fines AS F
				WHERE captain_id = ".$captain_id." AND YEARWEEK(F.created_at) = YEARWEEK(NOW()) group by yearweek(F.created_at)";

				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $fine_data = array();
					while($row = fetch_object($result)):
					   $fine_data['count_fines'] = $row->count_fines;
					   $fine_data['fine_id'] = $row->fine_id;
					   $fine_data['week_data'] = $row->week_data;
					   $fine_array[] = $fine_data;
					endwhile;
					echo json_encode(array('status' => 'success',
										 'errorCode' => 0,
										 'message' => 'Fine data found.',
										 'Daily_List' => $fine_array));
				}else{
					echo json_encode(array('status' => 'failed',
										 'errorCode' => 1,
										 'message' => 'Fine data Not found.',
										 'Daily_List' => $fine_array));
				}
				
				
			}
	
}


// fine detail api

function fines_detail($captain_id){
	$captain_id = $captain_id;
	 // Check status of the account

			if( if_empty($captain_id)){
				echo e_response('Captain ID  and Fine ID is required.');
			}else{

				$sql_query = "SELECT 
				F.complain AS complain, F.fine_amount AS fine, F.paid_status AS status, F.complain_date AS complain_date,
				str_to_date(concat(yearweek(F.created_at), ' friday'), '%X%V %W') AS week_data
				FROM tbl_fines AS F
				WHERE F.captain_id = ".$captain_id."  AND YEARWEEK(F.created_at) = YEARWEEK(NOW())";

				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $fine_data = array();
					while($row = fetch_object($result)):
					   $fine_data['complain'] = $row->complain;
					   $fine_data['fine'] = $row->fine;
					   $fine_data['status'] = $row->status;
					   $fine_data['complain_date'] = $row->complain_date;
					   $fine_data['week_data'] = $row->week_data;
					   $fine_array[] = $fine_data;
					endwhile;
					echo json_encode(array('status' => 'success',
										 'errorCode' => 0,
										 'message' => 'Fine data found.',
										 'Daily_List' => $fine_array));
				}else{
					echo json_encode(array('status' => 'failed',
										 'errorCode' => 1,
										 'message' => 'Fine data Not found.',
										 'Daily_List' => $fine_array));
				}
				
				
			}
	
}


function contact_number($captain_id){
	$captain_id = $captain_id;
	 // Check status of the account

			if( if_empty($captain_id)){
				echo e_response('Captain ID is required.');
			}else{

				$sql_query = "SELECT tbl_contact_number.phone_number AS phone, tbl_contact_number.email AS email  FROM tbl_contact_number WHERE app_name = 'Driver' AND status = 'Active'";

				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $contact_data = array();
					while($row = fetch_object($result)):
					   $contact_data['phone'] = $row->phone;
					   $contact_data['email'] = $row->email;
					   $contact_array[] = $contact_data;
					endwhile;
					echo json_encode(array('status' => 'success',
										 'errorCode' => 0,
										 'message' => 'Data found.',
										 'Daily_List' => $contact_array));
				}else{
					echo json_encode(array('status' => 'failed',
										 'errorCode' => 1,
										 'message' => 'phone Number is temporary  Block.',
										 'Daily_List' => ''));
				}
				
				
			}
	
}


// assign Ride to captain 

function assign_ride_to_captain()
{   
	//$cap_id = '10';
	//$gcm_id = post('gcm_id');
	$booking_id = post('booking_id');
	$customer_id = post('customer_id');
	$category_id = post('category_id');
	$pickup_lat = post('pickup_lat');
	$pickup_lng = post('pickup_lng');
	$dropoff_lat = post('dropoff_lat');
	$dropoff_lng = post('dropoff_lng');
	//$pickup = post('pickup');
	//$dropoff = post('dropoff');
	$ride_type = post('ride_type');
	$ride_for = post('ride_for');
	//$pickup_time = post('pickup_time');


	if( if_empty($customer_id) ){
				echo e_response('Customer is not online');
			}else{
	 
			 $data = array(
			 	//'captain_id' => $cap_id,
			 		'booking_id' => $booking_id,
					'customer_id' => $customer_id,
					'category_id' => $category_id,
					'pickup_lat' => $pickup_lat,
					'pickup_lng' => $pickup_lng,
					'dropoff_lat' => $dropoff_lat,
					'dropoff_lng' => $dropoff_lng,
					//'pickup' => $pickup,
					//'dropoff' => $dropoff,
					'ride_type' => $ride_type,
					'ride_for' => $ride_for,
					//'status' => 'Accepted'
					//'pickup_time' => $pickup_time
				);
		      
		     if(save_data('booking_request',$data)){

			     // $where =" status = 'A' AND captain_status = 'Online' AND riding_type = ".$ride_type." AND riding_status = 'Free' ";
        //      	 $data = get_single_row('tbl_captains', $where);
		     	// $where = "CAR.category_id ='".$category_id."' AND C.status = 'A' AND C.captain_status = 'Online' AND C.riding_type = '".$ride_type."' AND C.riding_status = 'Free'";
		     	$result = get_query_data("SELECT C.id AS captainID, C.gcm_id AS gcm_id FROM tbl_captains AS C JOIN tbl_cars AS CAR on CAR.id = C.car_id WHERE CAR.category_id ='".$category_id."' AND C.status = 'A' AND C.captain_status = 'Online' AND C.riding_type = '".$ride_type."' AND C.riding_status = 'Free'");

		     	
              		$dropoff_location = $dropoff_lat.','.$dropoff_lng.',';

              	 	//$post_id = $result['captainID'];
              	 	$gcm_id = $result['gcm_id'];
             	 	$title = 'Here is Your Ride';
             	 	$message = "Your Customer is waiting for you at Point, ".$pickup_lat.",".$pickup_lng.",".$dropoff_location."
             	 				Location: 
             	 				";

              	 	//sendPushNotification_rider($gcm_id,$post_id,$title,$message);

             	 // $res = get_query_data("SELECT B.id AS id, C.customer_name AS customer_name, B.pickup_lat AS Pickup_lat, B.pickup_lng AS pickup_lng, B.dropoff_lat AS dropoff_lat, B.dropoff_lng AS dropoff_lng, B.customer_id AS customer_id, 
             	 // 	FROM booking_request AS B 
             	 // 	JOIN tbl_customers AS C on C.id = B.customer_id 
             	 // 	WHERE booking_id = '".$booking_id."' AND category_id = '".$category_id."'");


             	 $res = get_query_data("SELECT 111.045 * DEGREES(ACOS(COS(RADIANS('".$pickup_lat."'))
					 * COS(RADIANS(dropoff_lat))
					 * COS(RADIANS(dropoff_lng) - RADIANS('".$pickup_lng."'))
					 + SIN(RADIANS('".$pickup_lat."'))
					 * SIN(RADIANS(dropoff_lat))))
					 AS distance_in_km,
					B.id AS id, C.customer_name AS customer_name, B.pickup_lat AS Pickup_lat, B.pickup_lng AS pickup_lng, B.dropoff_lat AS dropoff_lat, B.dropoff_lng AS dropoff_lng, B.customer_id AS customer_id
             	 	FROM booking_request AS B 
             	 	JOIN tbl_customers AS C on C.id = B.customer_id 
             	 	WHERE booking_id = '".$booking_id."' AND category_id = '".$category_id."' AND 
                    111.045 * DEGREES(ACOS(COS(RADIANS('".$pickup_lat."'))
					 * COS(RADIANS(dropoff_lat))
					 * COS(RADIANS(dropoff_lng) - RADIANS('".$pickup_lng."'))
					 + SIN(RADIANS('".$pickup_lat."'))
					 * SIN(RADIANS(dropoff_lat)))) <= 20");

					 $km = $res['distance_in_km'];
             	 if($res == true){

             	   $booking_request_id['booking_request_id'] = $res['id'];
             	   $booking_request_id['customer_id'] = $res['customer_id'];


             	  	$post_id = $res['id'];
             	  	sendPushNotification_rider($gcm_id,$post_id,$title,$message);
			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Notification sent successfully.',
								 'data' => $booking_request_id
								 ));
		}else{
			echo e_response('Drivers are Busy Please Try Later.');
		}

		}	
			
			}

}

// End assign Ride to captain

//when captain accept the ride

function when_captain_accept_ride()
{   
	$id = post('id');
	$captain_id = post('captain_id');
	if( if_empty($captain_id) || if_empty($id)){
				echo e_response('captain is not Online and booking ID is Missing.');
			}else{

				$missed_status = get_query_data("SELECT B.status AS status FROM booking_request AS B WHERE B.id = '".$id."'");
				if($missed_status['status'] == 'Ride Missed'){

					echo json_encode(array('status' => 'failed',
								 'errorCode' => 3,
								 'message' => 'Sorry Ride is Missed.',
								 'data' => ''
								 ));

				}else{

				$sql_query = "UPDATE booking_request SET captain_id = '".$captain_id."', status = 'Accepted' WHERE id = '".$id."'";
		    	$result = execute_query($sql_query);

		    	$sql_query = "UPDATE tbl_captains SET riding_status = 'Busy' WHERE id = '".$captain_id."'";
		    	$res = execute_query($sql_query);
		    

		     	 $sql_query = " SELECT *,C.customer_name AS customer_name,C.mobile_number AS customer_number, B.pickup_lat AS plat, B.pickup_lng AS plng, B.dropoff_lat AS dlat,
		     	 B.dropoff_lng AS dlng, B.ride_type AS ride_type, C.id AS customer_id, B.category_id AS cat_id, B.status AS status 
		     	 				FROM booking_request AS B 
		     	 				JOIN tbl_customers AS C on C.id = B.customer_id 
		     	 				WHERE B.id = '".$id."'";

				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $data_array = array();
					while($row = fetch_object($result)):
					    $data_array['customer_id'] = $row->customer_id;
					    $data_array['category_id'] = $row->cat_id;
					   $data_array['customer_name'] = $row->customer_name;
					   $data_array['customer_number'] = $row->customer_number;
					   $data_array['pickup_lat'] = $row->plat;
					   $data_array['pickup_lng'] = $row->plng;
					   $data_array['dropoff_lat'] = $row->dlat;
					   $data_array['dropoff_lng'] = $row->dlng;
					   $data_array['ride_type'] = $row->ride_type;
					   $response_data[] = $data_array;
					endwhile;

					//$caution = get_query_data("SELECT B.status AS status FROM booking_request WHERE id = '".$id."'");
					$status = $row->status;
		    	if($status == 'Accepted'){

		    		echo json_encode(array('status' => 'failed',
								 'errorCode' => 2,
								 'message' => 'Ride is Accepted By Another Driver.',
								 'data' => ''
								 ));
		    	}else{

			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Ride Accepted.',
								 'data' => $response_data
								 ));
		}
		}
		

		else{
			echo json_encode(array('status' => 'failed',
								 'errorCode' => 1,
								 'message' => 'Driver Not availabe Yet Please Try Again later.',
								 'data' => ''
								 ));
		}

		}
			
			}
}



//search captain cancel the ride

function search_captain()
{   
	$booking_id = post('id');
	$customer_id = post('customer_id');

	if( if_empty($customer_id) || if_empty($booking_id)){
				echo e_response('Customer is not Online and booking ID is Missing.');
			}else{

				$sql_query = "SELECT C.captain_name AS captain_name, C.id AS captainID, B.id AS booking_id , B.customer_id AS customer_id , C.mobile_number AS captain_number, C.captain_image AS captain_image,
		     		CAR.car_reg_number AS reg_number, CC.name AS company_name, CT.type_name AS car_type_name, CLR.color AS color
		     	 FROM tbl_captains AS C JOIN tbl_cars AS CAR on CAR.id = C.car_id
		     	 JOIN booking_request B on B.captain_id = C.id
		     	 JOIN car_companies CC on CC.id = CAR.car_company_id
		     	 JOIN car_types AS CT on CT.id = CAR.car_type_id
		     	 JOIN car_color AS CLR on CLR.id = CAR.car_color_id  WHERE B.id = '".$booking_id."' AND B.status = 'Accepted'";

				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $data_array = array();
					while($row = fetch_object($result)):
					   $data_array['booking_id'] = $row->booking_id;
					   $data_array['customer_id'] = $row->customer_id;
					   $data_array['captainID'] = $row->captainID;
					   $data_array['captain_name'] = $row->captain_name;
					   $data_array['captain_number'] = $row->captain_number;
					   $data_array['captain_image'] = $row->captain_image;
					   $data_array['car_registration_number'] = $row->reg_number;
					   $data_array['company_name'] = $row->company_name.''.$row->car_type_name;
					   $data_array['car_color'] = $row->color;
					   $response_data[] = $data_array;
					endwhile;

			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Captain Searched.',
								 'data' => $response_data
								 ));
		}
		else{

			$sql_query = "UPDATE booking_request SET status = 'Ride Missed' WHERE id = '".$booking_id."'";
			$result = execute_query($sql_query);

			echo json_encode(array('status' => 'failed',
								 'errorCode' => 1,
								 'message' => 'Driver Not availabe Yet Please Try Again later.',
								 'data' => ''
								 ));
		}
		
			
			}
}

//search Capatain 
// SELECT C.id AS captain_id, C.captain_name AS captain_name, C.mobile_number AS captain_number, B.booking_id AS bookingID FROM booking_request AS B 
// JOIN tbl_captains AS C on C.id = B.captain_id
// JOIN tbl_cars on tbl_cars.id = C.car_id
// JOIN car_companies AS CC on CC.id = tbl_cars.car_company_id
// JOIN car_types AS CT on CT.id = tbl_cars.car_type_id
// JOIN car_color AS co on co.id - tbl_cars.car_color_id
// WHERE B.booking_id = 'A92B5316E4F24694B2C628C07337645F' AND B.captain_id = C.id
//when captain cancel the ride

function when_captain_cancel_ride()
{   
	$id = post('id');
	$captain_id = post('captain_id');
	$cancelation_reason = post('cancelation_reason');
	if( if_empty($captain_id) || if_empty($id)){
				echo e_response('captain is not Online and booking ID is Missing.');
			}else{

				$sql_query = "UPDATE booking_request SET captain_id = '".$captain_id."', status = 'Cancel By Captain', cancelation_reason = '".$cancelation_reason."' WHERE id = '".$id."'";
		     $result = execute_query($sql_query);

		     	// here is little bit confusion tomorrow i will ask from tabinda   that what can i send in response   to customer and how 
			     // $where =" id = '".$captain_id."'";
        //      	 $data1 = get_table_data('tbl_captains', $where);
             	 if($result == true){
				 $data_array['canel_ride'] = 'Captain is Not available Please Try again!'; 
				 $response_data[] = $data_array;

			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Ride Cancelled.',
								 'data' => $response_data
								 ));
		}
		else{
			echo json_encode(array('status' => 'failed',
								 'errorCode' => 1,
								 'message' => 'Something Went Wrong Please Try Again.',
								 'data' => ''
								 ));
		}
		
			
			}
}

//when Customer cancel the ride

function when_customer_cancel_ride()
{   
	$booking_id = post('booking_id');
	$customer_id = post('customer_id');
	$cancelation_reason = post('cancelation_reason');
	if( if_empty($customer_id) || if_empty($booking_id)){
				echo e_response('captain is not Online and booking ID is Missing.');
			}else{

				$sql_query = "UPDATE booking_request SET status = 'Cancel By Customer', cancelation_reason = '".$cancelation_reason."' WHERE id = '".$booking_id."' AND customer_id = '".$customer_id."' ";
		    		 $result = execute_query($sql_query);


		    	$res = get_query_data("SELECT B.captain_id AS captain_id FROM booking_request AS B WHERE id = '".$booking_id."'"); 
		    	$sql_query = "UPDATE tbl_captains SET riding_status = 'Free' WHERE id = '".$res['captain_id']."'";
		    	$result = execute_query($sql_query);

		     	// here is little bit confusion tomorrow i will ask from tabinda   that what can i send in response   to customer and how 
			     // $where =" id = '".$captain_id."'";
        //      	 $data1 = get_table_data('tbl_captains', $where);
		    	// $gcm = get_query_data("SELECT C.gcm_id AS gcm_id, C.id AS captainID FROM booking_request AS B JOIN tbl_captains AS C on C.id = B.captain_id 
			    //  							WHERE B.id = '".$id."'");



             	 if($result == true){
             	 	$gcm1 = get_query_data("SELECT C.gcm_id AS gcm_id, C.id AS captainID FROM tbl_captains AS C JOIN booking_request AS B on B.captain_id = C.id WHERE B.id = '".$booking_id."'");
					$gcm_id = $gcm1['gcm_id'];
					$post_id = $gcm1['captainID'];
					$title = 'Ride is Cancel';
					$message = 'Ride is Cancel By Customer Please Try Again';

             	sendPushNotification_rider($gcm_id,$post_id,$title,$message);
	             	

				 $data_array['canel_ride'] = 'Customer is Not available Anymore!'; 
				 $response_data[] = $data_array;

			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Ride Cancelled.',
								 'data' => $response_data
								 ));
		}
		else{
			echo json_encode(array('status' => 'failed',
								 'errorCode' => 1,
								 'message' => 'Something Went Wrong Please Try Again.',
								 'data' => ''
								 ));
		}
		
			
			}
}


// when start ride button is pressed than  

function start_ride_button_pressed()
{   

	$customer_id = post('customer_id');
	$captain_id = post('captain_id');
	$booking_request_id = post('booking_request_id');
	$pickup_lat = post('pickup_lat');
	$pickup_lng = post('pickup_lng');
	$distination_lat = post('distination_lat');
	$distination_lng = post('distination_lng');
	$ride_type = post('ride_type');
	$category_id = post('category_id');
	//$pickup_time = post('pickup_time');


	if( if_empty($customer_id) || if_empty($captain_id) || if_empty($booking_request_id)){
				echo e_response('Customer is required and captain and booking id is also required');
			}else{
	 
			 $data = array(
			 		'booking_request_id' => $booking_request_id,
					'customer_id' => $customer_id,
					'captain_id' => $captain_id,
					'pickup_lat' => $pickup_lat,
					'pickup_lng' => $pickup_lng,
					'distination_lat' => $distination_lat,
					'distination_lng' => $distination_lng,
					//'pickup' => $pickup,
					//'dropoff' => $dropoff,
					'ride_type' => $ride_type,
					'category_id' => $category_id
					//'pickup_time' => $pickup_time
				);
		      	$saved = save_data('tbl_rides',$data);
		     

		     	$sql_query = "UPDATE tbl_captains SET riding_status = 'InRide' WHERE id = '".$captain_id."'";
		    	 
		    	if(execute_query($sql_query)){
			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Ride Started successfully.',
								 'ride_id' => $saved,
								 'data' => $data
								 ));
		}else{
			echo e_response('Something Went Wrong!  Ride not Start Please Try Again.');
		}

			
			
			}

}

// End start ride button is pressed than  


// when End ride button is pressed than  

function end_ride_button_pressed()
{   
	$ride_id = post('id');
	$captain_id = post('captain_id');
	$category_id = post('category_id');
	$distance = post('distance');

	if( if_empty($captain_id) || if_empty($category_id)){
				echo e_response('Sytem is Down kindly contact to Customer Care');
			}else{

				$data = array(
							'distance' => $distance
				);
				update_data('tbl_rides',$data,$ride_id);
				
	 			
	 			$sql_query = "SELECT c.per_km * '".$distance."' AS cost_of_moving, c.mul_share * '".$distance."' AS service_fees, c.base_fare AS base_fare FROM tbl_categories AS c where c.id = '".$category_id."'";
				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $data_array = array();
					while($row = fetch_object($result)):
						$var1 = $row->cost_of_moving;
						$var2 = $row->service_fees;
						$var3 = $row->base_fare;
						$calculate = $var1 + $var2 + $var3;
					   $data_array['cost_of_moving'] = $row->cost_of_moving;
					   $data_array['service_fees'] = $row->service_fees;
					   $data_array['base_fare'] = $row->base_fare;
					   $data_array['calculate'] = round($calculate);
					   $response_data[] = $data_array;
					endwhile;
				
				$send_fare = get_query_data("SELECT R.customer_id AS customer_id FROM tbl_rides AS R WHERE R.id = '".$ride_id."'");
				$customer_id = $send_fare['customer_id'];

				$cust_num = get_query_data("SELECT C.mobile_number AS mobile_number FROM tbl_customers AS C WHERE C.id = '".$customer_id."'");
				$to = $cust_num['mobile_number'];
				$message = 'Your MULL Ride Amount is RS: '.round($calculate).'';
				sms_api($to,$message);

			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Ride Ended.',
								 'data' => $response_data
								 ));
		}else{
			echo e_response('Something Went Wrong!  Ride not Ended Please Contact to customer Care.');
		}

			
			
			}

}

// End End ride button is pressed than 

// when pay  button is pressed than  

function pay_ride_amount()
{   
	$ride_id = post('id');
	$captain_id = post('captain_id');
	$calculate = post('calculate');
	$service_fees = post('service_fees');
	$base_fare = post('base_fare');
	$cost_of_moving = post('cost_of_moving');
	$customer_pay_to_captain = post('customer_pay_to_captain');
	$customer_id = post('customer_id');
	$booking_request_id = post('booking_request_id');
	

	if( if_empty($ride_id) || if_empty($captain_id)){
				echo e_response('System is Down kindly contact to Customer Care');
			}else{
	 			
				$sql_query = " UPDATE tbl_captains SET riding_status = 'Free' WHERE id = '".$captain_id."'";
				$exec = execute_query($sql_query);

				$request = get_query_data("SELECT R.booking_request_id AS booking_request_id FROM tbl_rides AS R WHERE R.id = '".$ride_id."'");
				$booking_id = $request['booking_request_id']; 

				$sql_query = "UPDATE booking_request SET status = 'Ride Completed' WHERE id = '".$booking_id."'";
		    	$re = execute_query($sql_query);

	 			$sql_query = "UPDATE tbl_rides SET ride_amount = '".$calculate."' WHERE id = '".$ride_id."'";
		    	$result = execute_query($sql_query);

				
				if($result){
					$extra_amount = $customer_pay_to_captain - $calculate;
					$pay_to_captain = $base_fare + $cost_of_moving;

					$sql_query = "UPDATE tbl_customers SET amount = amount + '".$extra_amount."' WHERE id = '".$customer_id."'";
		    		$result = execute_query($sql_query);

					if($customer_pay_to_captain > $calculate){
						$balance_type = 'M';
					}
					else if($customer_pay_to_captain < $calculate){
						$balance_type = 'C';
					}
					else if($customer_pay_to_captain = $calculate){
						$balance_type = 'N';
					}

					$data = array(
								'ride_id' => $ride_id,
								'customer_pay_to_captain' => $customer_pay_to_captain,
								'pay_to_us' => $service_fees,
								'pay_to_cap' => $pay_to_captain,
								'balance_amount' => $extra_amount,
								'balance_type' => $balance_type
					);
				save_data('tbl_calculation',$data);
				$extra_value = 1;
				$gcm1 = get_query_data("SELECT C.gcm_id AS gcm_id, C.id AS customer_id FROM tbl_customers AS C  WHERE C.id = '".$customer_id."'");
					$gcm_id = $gcm1['gcm_id'];
					$post_id = $gcm1['customer_id'].','.$extra_value;
					$title = 'Ride Completed';
					$message = 'Ride is Completed. Give rating to Captain';

             	$push = sendPushNotification_rider($gcm_id,$post_id,$title,$message);
             	if($push == true)
             	{
             		$mobile = get_query_data("SELECT C.mobile_number AS mobile_number FROM tbl_customers AS C WHERE C.id = '".$customer_id."'");

             		$to = $mobile['mobile_number'];
             		$message = 'Thanks For the Ride with MULL. Please Give Rating to the Captain.';

             		sms_api($to,$message);
             	}



			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Ride Payment added Successfully.',
								 'data' => 'done'
								 ));
		}else{
			echo e_response('Something Went Wrong!  Ride not Ended Please Contact to customer Care.');
		}

			
			
			}

}

// End End ride button is pressed than  

// list of FIxed captains show to customer

function list_of_fixed_captains_show()
{   

	//$gcm_id = post('gcm_id');
	$customer_id = post('customer_id');
	$category_id = post('category_id');
	$ride_type = post('ride_type');
	$ride_for = post('ride_for');

	if( if_empty($customer_id) ){
				echo e_response('Customer is not online');
			}else{
	 
		     	$where = "F.category_id ='".$category_id."' AND C.status = 'A' AND C.captain_status = 'Online' AND C.riding_type = '".$ride_type."' AND C.riding_status = 'Free' AND F.trip_type ='".$ride_for."' ";
		     	// $result = get_query_data("SELECT * FROM tbl_captains AS C JOIN tbl_fixed_price AS F on F.captain_id = C.id WHERE ".$where."");
             	 
		     	$sql_query = "SELECT F.trip_amount AS amount, F.id AS list_id, F.trip_type AS trip_type, F.description AS description, C.id AS captain_id FROM tbl_captains AS C 
		     		JOIN tbl_fixed_price AS F on F.captain_id = C.id 
		     		WHERE ".$where."";
				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $data_array = array();
					while($row = fetch_object($result)):

						// $var1 = '200';
						// $var2 = $row->amount;	
						// $trip_amount = $var1 + $var2;
					   $data_array['list_id'] = $row->list_id;
					   $data_array['captain_id'] = $row->captain_id;
					   $data_array['Trip_amount'] = $row->amount;
					   $data_array['Trip_type'] = $row->trip_type;
					   $data_array['description'] = $row->description;
					   $response_data[] = $data_array;
					endwhile;
			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'list Found.',
								 'data' => $response_data
								 ));
		}else{
			echo json_encode(array('status' => 'failed',
								 'errorCode' => 1,
								 'message' => 'Sorry Captain Not Available Please Try Again',
								 'data' => ''
								 ));
		}

			
			
			}

}


// End list of Fixed customers
// For fixed ride API    To assign ride to captain   

function assign_fixed_ride_to_captain()
{   
	
	//$gcm_id = post('gcm_id');
	$booking_id = post('booking_id');
	$customer_id = post('customer_id');
	$captain_id = post('captain_id');
	$category_id = post('category_id');
	$pickup_lat = post('pickup_lat');
	$pickup_lng = post('pickup_lng');
	$list_id = post('list_id');
	// $dropoff_lat = post('dropoff_lat');
	// $dropoff_lng = post('dropoff_lng');
	//$pickup = post('pickup');
	//$dropoff = post('dropoff');
	$ride_type = post('ride_type');
	$ride_for = post('ride_for');
	//$pickup_time = post('pickup_time');


	if( if_empty($customer_id) || if_empty($captain_id) ){
				echo e_response('Customer is not online And captain id is Missing');
			}else{
	 
			 $data = array(

			 		'booking_id' => $booking_id,
					'customer_id' => $customer_id,
					'captain_id' => $captain_id,
					'category_id' => $category_id,
					'pickup_lat' => $pickup_lat,
					'pickup_lng' => $pickup_lng,
					'list_id' => $list_id,
					// 'dropoff_lat' => $dropoff_lat,
					// 'dropoff_lng' => $dropoff_lng,
					//'pickup' => $pickup,
					//'dropoff' => $dropoff,
					'ride_type' => $ride_type,
					'ride_for' => $ride_for,
				//	'pickup_time' => $pickup_time
					//'status' => 'Accepted'
				);
		      
		     if(save_data('booking_request',$data)){

			     // $where =" status = 'A' AND captain_status = 'Online' AND riding_type = ".$ride_type." AND riding_status = 'Free' ";
        //      	 $data = get_single_row('tbl_captains', $where);
		     	$where = "F.category_id ='".$category_id."' AND C.status = 'A' AND C.captain_status = 'Online' AND C.riding_type = '".$ride_type."' AND C.riding_status = 'Free' AND C.id = '".$captain_id."' AND F.id = '".$list_id."'";
		     	$result = get_query_data("SELECT C.id AS captainID, C.gcm_id AS gcm_id FROM tbl_captains AS C 
		     		JOIN tbl_fixed_price AS F on F.captain_id = C.id
		     		 WHERE ".$where."");
             	 if($result){

             	 	
             	
             	 $res = get_query_data("SELECT B.id AS id,B.list_id AS list_id  FROM booking_request AS B WHERE B.booking_id = '".$booking_id."'");
             	 $booking_request_id['booking_request_id'] = $res['id'];
             	 $booking_request_id['list_id'] = $res['list_id'];


             	 	$dropoff_location = $dropoff_lat.','.$dropoff_lng.','.$res['list_id'].',';
             	 	//$post_id = $result['captainID'];
             	 	$gcm_id = $result['gcm_id'];
             	 	$title = 'Here is Your Ride';
             	 	$message = "Your Customer is waiting for you at Point, ".$pickup_lat.", ".$pickup_lng.",".$dropoff_location."";
             	 $post_id = $res['id'];

             	 sendPushNotification_rider($gcm_id,$post_id,$title,$message);




			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Notification sent successfully.',
								 'data' => $booking_request_id
								 ));
		}else{
			echo e_response('Driver Not availabe Yet Please Try Again later.');
		}

			
			}
			}

}


// end fixed ride API 


// End fixed Ride 

function end_fixed_ride_button_pressed()
{   
	$ride_id = post('id');
	$captain_id = post('captain_id');
	$category_id = post('category_id');
	$list_id = post('list_id');

	if( if_empty($captain_id) || if_empty($category_id)){
				echo e_response('Sytem is Down kindly contact to Customer Care');
			}else{
	 			
	 			$sql_query = "SELECT C.fixed_ride_share AS fixed_share, F.trip_amount AS trip_amount  FROM `tbl_categories` AS C
								JOIN tbl_fixed_price AS F ON F.category_id = C.id
								WHERE C.id = '".$category_id."' AND F.id = '".$list_id."' 
	 							";

				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $data_array = array();
					while($row = fetch_object($result)):
						$var1 = $row->trip_amount;
						$var2 = $row->fixed_share;
						$calculate = $var1 + $var2;
					   $data_array['cost_of_moving'] = $row->trip_amount;
					   $data_array['service_fees'] = $row->fixed_share;
					   $data_array['calculate'] = round($calculate);
					   $response_data[] = $data_array;
					endwhile;
			

			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Ride Ended.',
								 'data' => $response_data
								 ));
		}else{
			echo e_response('Something Went Wrong!  Ride not Ended Please Contact to customer Care.');
		}

			
			
			}

}

// end for fixed ride 

// when fixed pay  button is pressed  

function pay_fixed_ride_amount()
{   
	$ride_id = post('id');
	$captain_id = post('captain_id');
	$calculate = post('calculate');
	$service_fees = post('service_fees');
	// $base_fare = post('base_fare');
	$cost_of_moving = post('cost_of_moving');
	$customer_pay_to_captain = post('customer_pay_to_captain');
	$customer_id = post('customer_id');
	$booking_request_id = post('booking_request_id');
	

	if( if_empty($ride_id) || if_empty($captain_id)){
				echo e_response('Sytem is Down kindly contact to Customer Care');
			}else{
	 			
				$sql_query = " UPDATE tbl_captains SET riding_status = 'Free' WHERE id = '".$captain_id."'";
				$exec = execute_query($sql_query);

				$request = get_query_data("SELECT R.booking_request_id AS booking_request_id FROM tbl_rides AS R WHERE R.id = '".$ride_id."'");
				$booking_id = $request['booking_request_id']; 

				$sql_query = "UPDATE booking_request SET status = 'Ride Completed' WHERE id = '".$booking_id."'";
		    	$re = execute_query($sql_query);

	 			$sql_query = "UPDATE tbl_rides SET ride_amount = '".$calculate."' WHERE id = '".$ride_id."'";
		    	$result = execute_query($sql_query);
				
				if($result){
					$extra_amount = $customer_pay_to_captain - $calculate;
					$pay_to_captain = $cost_of_moving;

					$sql_query = "UPDATE tbl_customers SET amount = amount + '".$extra_amount."' WHERE id = '".$customer_id."'";
		    		$result = execute_query($sql_query);

					if($customer_pay_to_captain > $calculate){
						$balance_type = 'M';
					}
					else if($customer_pay_to_captain < $calculate){
						$balance_type = 'C';
					}
					else if($customer_pay_to_captain = $calculate){
						$balance_type = 'N';
					}

					$data = array(
								'ride_id' => $ride_id,
								'customer_pay_to_captain' => $customer_pay_to_captain,
								'pay_to_us' => $service_fees,
								'pay_to_cap' => $pay_to_captain,
								'balance_amount' => $extra_amount,
								'balance_type' => $balance_type
					);
				save_data('tbl_calculation',$data);
				$extra_value = 1;
				$gcm1 = get_query_data("SELECT C.gcm_id AS gcm_id, C.id AS customer_id FROM tbl_customers AS C  WHERE C.id = '".$customer_id."'");
					$gcm_id = $gcm1['gcm_id'];
					$post_id = $gcm1['customer_id'].','.$extra_value;
					$title = 'Ride Completed';
					$message = 'Ride is Completed. Give rating to Captain';

             	sendPushNotification_rider($gcm_id,$post_id,$title,$message);



			echo json_encode(array('status' => 'success',
								 'errorCode' => 0,
								 'message' => 'Ride Payment added Successfully.',
								 'data' => 'done'
								 ));
		}else{
			echo e_response('Something Went Wrong!  Ride not Ended Please Contact to customer Care.');
		}

			
			
			}

}

// End pay ride api  


// check drivers availability

// function check_driver_availability()
// {
// 	$where = "captain_status = 'Offline'";
// 	$table = "tbl_captains";
// 	$data = get_table_data($table,$where);
// 				if(!empty($data)){
// 					 echo json_encode(array('status' => 'success',
// 											 'errorCode' => 0,
// 											 'message' => 'Driver Not Found in this Area. Please try Again Later',
// 											 'data' => ''));
// 				}else{
// 					echo json_encode(array('status' => 'success',
// 											 'errorCode' => 0,
// 											 'message' => '',
// 											 'data' => ''));
// 				}
// }


// End check drivers availability
// version API


function captain_app_version(){

		
             $where =" app_name = 'captain' AND status = 'Active'";
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
// captain Logout API

function captain_logout(){

		$captain_id = post('captain_id');

			if( if_empty($captain_id) ){
				echo e_response('Captain id is required.');
			}else{
			$query = get_query_data("SELECT tbl_captains.riding_status AS status FROM tbl_captains WHERE id = '".$captain_id."'");
			if($query['status'] == 'Free'){
            $sql_query = "UPDATE tbl_captains SET captain_status = 'Offline' WHERE id = '".$captain_id."'";
			$result = execute_query($sql_query);

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

// End captain Logout API


// arrived captain API

function captain_arrived(){

		$captain_id = post('captain_id');
		$customer_id = post('customer_id');
		$extra_value = 0;
			if( if_empty($captain_id) || if_empty($customer_id)){
				echo e_response('Captain id and customer ID is required.');
			}else{
			$query = get_query_data("SELECT C.gcm_id AS gcm_id, C.id AS customer_id FROM tbl_customers AS C WHERE C.id = '".$customer_id."'");

			if($query){

					$gcm_id = $query['gcm_id'];
					$post_id = $query['customer_id'].','.$extra_value;
					$title = 'Captain is Arrived';
					$message = 'Captain is Front of Your Door.';
             		sendPushNotification_rider($gcm_id,$post_id,$title,$message);

					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Captain Arrived.',
											 'data' => ''));
				}else{
					echo json_encode(array('status' => 'success',
											 'errorCode' => 1,
											 'message' => 'Something Went Wrong!  Not Logging Out',
											 'data' => ''));
				}
			}
		
}


// end arrived captain APi

// captain Fixed amount list

function captain_fixed_list_data(){

		$captain_id = post('captain_id');

			if( if_empty($captain_id)){
				echo e_response('Captain ID is required.');
			}else{

			$sql_query = "SELECT F.category_id AS category_id, F.trip_amount AS amount, F.trip_type AS trip_type, F.description AS description, C.category_name AS category_name, F.id AS fixed_id FROM tbl_fixed_price AS F
						JOIN tbl_categories AS C on C.id = F.category_id
						WHERE F.captain_id = '".$captain_id."'
	 							";

				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $data_array = array();
					while($row = fetch_object($result)):
						$var1 = $row->trip_type;
						if($var1 == 'One'){
							$trip = 'One Way';
						}
						else if($var1 == 'Two'){
							$trip = 'Two Way';
						}
						else if($var1 == 'Other'){
							$trip = 'Other';
						}

					   $data_array['fixed_id'] = $row->fixed_id;
					   $data_array['category_id'] = $row->category_id;
					   $data_array['category_name'] = $row->category_name;
					   $data_array['trip_type'] = $trip;
					   $data_array['amount'] = $row->amount;
					   $data_array['description'] = $row->description;
					   $response_data[] = $data_array;
					endwhile;



					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Fixed List Found.',
											 'data' => $response_data));
				}else{
					echo json_encode(array('status' => 'success',
											 'errorCode' => 1,
											 'message' => 'Nothing Found',
											 'data' => ''));
				}
			}
		
}

// end captain fixed amount list

// update captain fixed Amount

function update_fixed_amount_data(){

		$captain_id = post('captain_id');
		$id = post('fixed_id');
		$trip_amount = post('trip_amount');
		$description = post('description');

			if( if_empty($captain_id)){
				echo e_response('Captain ID is required.');
			}else{
					$data = array(
								'trip_amount' => $trip_amount,
								'description' => $description
					);
					$update = update_data('tbl_fixed_price',$data,$id);
					  $where =" id = ".$id." ";
             	 $data = get_table_data('tbl_fixed_price', $where);
             	 if($data == true){
                 $data_array['id'] = $data[0]->id;
				 $data_array['trip_amount'] = $data[0]->trip_amount;
				 $data_array['description'] = $data[0]->description; 
				 $response_data[] = $data_array;

					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Fixed List Successfully Updated.',
											 'data' => $response_data));
				}else{
					echo json_encode(array('status' => 'failed',
											 'errorCode' => 1,
											 'message' => 'Nothing Updated',
											 'data' => ''));
				}
			}
		
}

// end update fixed amount


// captain Fixed amount list

function fetch_fixed_list_data(){

		$captain_id = post('captain_id');
		$fixed_id = post('fixed_id');

			if( if_empty($captain_id)){
				echo e_response('Captain ID is required.');
			}else{

			$sql_query = "SELECT F.category_id AS category_id, F.trip_amount AS amount, F.trip_type AS trip_type, F.description AS description, C.category_name AS category_name, F.id AS fixed_id FROM tbl_fixed_price AS F
						JOIN tbl_categories AS C on C.id = F.category_id
						WHERE F.id = '".$fixed_id."'
	 							";

				$result = execute_query($sql_query);
				$num_rows = num_rows($result);
				if($num_rows > 0){
					 $data_array = array();
					while($row = fetch_object($result)):

					   $data_array['fixed_id'] = $row->fixed_id;
					   $data_array['category_id'] = $row->category_id;
					   $data_array['category_name'] = $row->category_name;
					   $data_array['trip_type'] = $row->trip_type;
					   $data_array['amount'] = $row->amount;
					   $data_array['description'] = $row->description;
					   $response_data[] = $data_array;
					endwhile;



					 echo json_encode(array('status' => 'success',
											 'errorCode' => 0,
											 'message' => 'Fixed List Found.',
											 'data' => $response_data));
				}else{
					echo json_encode(array('status' => 'success',
											 'errorCode' => 1,
											 'message' => 'Nothing Found',
											 'data' => ''));
				}
			}
		
}

// end captain fixed amount list

