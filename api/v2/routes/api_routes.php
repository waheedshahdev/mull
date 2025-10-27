<?php  





function check_api_key($key){
        $api = $key;
		if($api == 'alia_appkey_amin'){
			return  true;	
		}else{
        $where = "api_key='".$api."' ";
		$data = get_table_data('residents', $where);
		if($data == false){
			return false;
		}else{
		     return  true;	   
	  	    
		}
	}	
}

function check_account_status($customer_id){
        $customer_id = $customer_id;
        $where = "id=".$customer_id." AND status= A ";
		$data = get_table_data('tbl_customers', $where);
		if($data == false){
			return false;
		}else{
		    return  true;	   
		}
}




// GET Requests
//$app->get('/notice_board/:resident_id/:condo_id/:key','Notice_board');
// $app->get('/get_post/:resident_id/:post_id/:key','get_notice_board');
// $app->get('/get_user_condos/:resident_id/:key','get_user_condos');
// $app->get('/get_user_units/:resident_id/:condo_id/:key','get_user_units');
// $app->get('/get_units_by_condo/:resident_id/:condo_id/:key','get_units_by_condo_id');
// $app->get('/get_profile/:resident_id/:condo_id/:unit_id/:key','get_profile'); 
// $app->get('/get_users_list/:resident_id/:condo_id/:key','user_list'); 
// $app->get('/get_useful_contacts/:resident_id/:condo_id/:key','useful_contacts_list'); 
// $app->get('/get_useful_forms/:resident_id/:condo_id/:key','house_rules_forms_list'); 
// $app->get('/my_address_info/:resident_id/:condo_id/:unit_id/:key','my_address_info'); 
// $app->get('/users_management/:resident_id/:condo_id/:unit_id/:key', 'user_management');

// // POST Requests
 //$app->get('/test','testing'); 
// captain API Routes
 $app->post('/login_captain','Login_captain');
 $app->post('/captain_status_online_api','status_online');
 $app->post('/captain_status_offline_api','status_offline');
 $app->post('/change_ride_type_R_api','change_ride_type_R');
 $app->post('/change_ride_type_F_api','change_ride_type_F');
 $app->post('/add_fixed_amount_api','add_fixed_amount');
 $app->post('/update_fixed_amount_api','update_fixed_amount');
 $app->post('/captain_forgot_password_api','captain_forgot_password');
 $app->post('/update_captain_profile_api','update_captain_profile'); 
 $app->post('/captain_rating_api','captain_rating'); 
 $app->get('/get_categories_api/:captain_id', 'get_categories');
 $app->get('/captain_week_total_api/:captain_id', 'captain_week_total');
 $app->get('/captain_daily_rides_api/:captain_id', 'captain_daily_rides');
 $app->get('/captain_vendor_cars_api/:captain_id', 'captain_vendor_cars');
 $app->get('/total_fines_api/:captain_id', 'total_fines');
 $app->get('/fines_detail_api/:captain_id', 'fines_detail');
 $app->get('/contact_number_api/:captain_id', 'contact_number');
 $app->get('/captain_daily_ride_detail_api/:captain_id/:ride_id', 'captain_daily_ride_detail');
 // $app->get('/captain_fines_api/:captain_id', 'captain_fines');
 $app->post('/assign_car_api','assign_car');
 $app->post('/assign_ride_to_captain_api','assign_ride_to_captain');
 $app->post('/when_captain_accept_ride_api','when_captain_accept_ride');
 $app->post('/when_captain_cancel_ride_api','when_captain_cancel_ride');
 $app->post('/list_of_fixed_captains_show_api','list_of_fixed_captains_show');
 $app->post('/assign_fixed_ride_to_captain_api','assign_fixed_ride_to_captain');
 $app->post('/start_ride_button_pressed_api','start_ride_button_pressed');
 $app->post('/end_ride_button_pressed_api','end_ride_button_pressed');
 $app->post('/end_fixed_ride_button_pressed_api','end_fixed_ride_button_pressed');
 $app->post('/pay_ride_amount_api','pay_ride_amount');
 $app->post('/pay_fixed_ride_amount_api','pay_fixed_ride_amount');
 $app->post('/search_captain_api','search_captain');
  $app->post('/captain_app_version_api','captain_app_version');
  $app->post('/captain_logout_api','captain_logout');
  $app->post('/captain_arrived_api','captain_arrived');
  $app->post('/captain_fixed_list_data_api','captain_fixed_list_data');
  $app->post('/update_fixed_amount_data_api','update_fixed_amount_data');
  $app->post('/fetch_fixed_list_data_api','fetch_fixed_list_data');

 
 // End Captain API Routes

 //Customer API Routes
 $app->post('/signup','signup');
 $app->post('/login','Login');
 $app->post('/validate_verification_api','validate_verification');
 $app->post('/forgot_password_api','forgot_password');
 $app->post('/customer_update_profile','update_customer'); 
 $app->post('/when_customer_cancel_ride_api','when_customer_cancel_ride');
 $app->post('/customer_app_version_api','customer_app_version');
 $app->post('/customer_contact_us_api','customer_contact_us');
 $app->post('/customer_logout_api','customer_logout');
 $app->post('/check_customer_location_api','check_customer_location');

 
 //End customer API Routes

 // $app->get('/Notice_board', 'Notice_board');
// $app->post('/forgot/','Forgot_password');
// $app->post('/update_password/','Update_password');
// $app->post('/change_password','Change_password');
// $app->post('/verify_password_code/','Password_verification_code');
// $app->post('/resend_forgot_pass_email/','Resend_forgot_email_pass');
// $app->post('/update_gcm_id','update_gcm_id');
// $app->post('/enable_notification','enable_push_notification');







