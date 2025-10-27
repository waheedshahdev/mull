<?php
class Bookings extends MX_Controller 
{

function __construct() {
parent::__construct();
}

public function index()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

    $data['title'] = "Bookings";
    $data['view_module'] = "bookings";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
    else
    {
        redirect('saad/login');
    }
}
public function add_booking()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {
    
    $data['customer_table'] = get_query_data("SELECT * FROM tbl_customers");
    $data['choose_category'] = get_query_data("SELECT * FROM tbl_categories");
    $data['captain_table'] = get_query_data("SELECT * FROM tbl_captains WHERE captain_status = 'Online'");
    $data['title'] = "Add Booking";
    $data['view_module'] = "bookings";
    $data['view_files'] = "add_booking";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
    else
    {
        redirect('saad/login');
    }
}

 public function getaddress($lat,$lng)
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
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
       else{
        redirect('saad/login');
    }
}



function booking()
{
  if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

    $this->load->model("mdl_bookings");  
           $fetch_data = $this->mdl_bookings->make_datatables_booking();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  

            $status = $row->status;
            if($status=='Pending')
            {
                $status_desc = '<font color="blue">Pending</font>';
            }
            else if($status =='Accepted')
            {
                $status_desc = "<font color='success'>Accepted</font>";
            }
            else if($status =='Cancel By Captain'){
                $status_desc = "<font color='red'>Cancel By Captain</font>";
            }
            else if($status =='Cancel By Customer'){
                $status_desc = "<font color='red'>Cancel By Customer</font>";
            }
            else if($status == 'Ride Completed'){
                $status_desc = "<font color='black'>Ride Completed</font>";
            }
            $status = $row->ride_type;
            if($status==F)
            {
          
                $ride_type = '<font color="green">Fixed</font>';
            }
            else if($status ==R)
            {
                $ride_type = "<font color='brown'>Regular</font>";
            }

            $ride_status = $row->ride_for;
            if($ride_status == N){
                $ride_for = "<font color='brown'>Regular Ride</font>";
            }
             else if($ride_status == O)
            {
                $ride_for = "<font color='sky blue'>One Way</font>";
            }
             else if($ride_status == T)
            {
                $ride_for = "<font color='Purple'>Two Way</font>";
            }
             else if($ride_status == F)
            {
                $ride_for = "<font color='green'>Full Day</font>";
            }

            $cap_id = $row->captain_id;
            if($cap_id == 0){
                $capt = "<font color='red'>Captain Not Assign Yet</font>";
            }else if ($cap_id) {
                $capt = $row->captain_name;
            }
         
                $pickup_lat = $row->pickup_lat;
                $pickup_lng = $row->pickup_lng;
                $pickup_address = $this->getaddress($pickup_lat,$pickup_lng);

                $dropoff_lat = $row->dropoff_lat;
                $dropoff_lng = $row->dropoff_lng;
                $dropoff_address = $this->getaddress($dropoff_lat,$dropoff_lng);

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->customer_name;  
                $sub_array[] = $capt;  
                $sub_array[] = $row->category_name;
                $sub_array[] = $pickup_address;
                $sub_array[] = $dropoff_address;
                $sub_array[] = $status_desc;
                $sub_array[] = $ride_type;
                $sub_array[] = $ride_for;
              //  $sub_array[] = $ride_type;
               //  $sub_array[] = $status_desc;//$row->status; 
                $sub_array[] = $row->booking_date;  
                
                $sub_array[] = 
                '<button type="button" name="another_captain" id="'.$row->id.'" class="btn btn-danger btn-xs assign_another_captain" data-toggle="modal" data-target="#myModal_assign">Assign Another Cap</button>';   
                  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_bookings->get_all_data_booking(),  
                "recordsFiltered"     =>     $this->mdl_bookings->get_filtered_data_booking(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

            }
    else
    {
        redirect('saad/login');
    }
 
}


function fare_fixed()
{
  if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

    $this->load->model("mdl_bookings");  
           $fetch_data = $this->mdl_bookings->make_datatables();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  

            $status = $row->status;
            if($status==P)
            {
              
                $status_desc = '<font color="info">Pending</font>';
            }
            else if($status ==A)
            {
           
                $status_desc = "<font color='success'>Approved</font>";
            }
            else if($status ==B){
             
                $status_desc = "<font color='red'>Blocked</font>";
            }
            $status = $row->riding_type;
            if($status==F)
            {
             
                $ride_type = '<font color="info">Fixed</font>';
            }
            else if($status ==R)
            {
         
                $ride_type = "<font color='success'>Regular</font>";
            }
         

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->captain_name;  
                //$sub_array[] = $row->cnic_number;  
                $sub_array[] = $row->mobile_number;
                $sub_array[] = $row->district_name;
                //$sub_array[] = $row->captain_status;
                $sub_array[] = $ride_type;
                $sub_array[] = $row->trip_amount;
                $sub_array[] = $row->trip_type;
                 //$sub_array[] = $status_desc;//$row->status; 
                $sub_array[] = $row->category_id;  
                
                $sub_array[] = '<a href="bookings/assign_fixed_ride/'.$row->id.'/'.$row->fixed_id.'" name="captain_profile" class="btn btn-info btn-xs">Assign Ride</a>';   
                  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_bookings->get_all_data(),  
                "recordsFiltered"     =>     $this->mdl_bookings->get_filtered_data(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output);

            }
    else
    {
        redirect('saad/login');
    } 
 
}
public function regular_fare(){
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

    $this->load->model("mdl_bookings");  
           $fetch_data = $this->mdl_bookings->make_datatables_regular();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  

            $status = $row->status;
            if($status==P)
            {
                $status_label= '';
                $status_desc = '<font color="info">Pending</font>';
            }
            else if($status ==A)
            {
                $status_label = "success";
                $status_desc = "<font color='success'>Approved</font>";
            }
            else if($status ==B){
                $status_label = "info";
                $status_desc = "<font color='red'>Blocked</font>";
            }
            $status = $row->riding_type;
            if($status==F)
            {
                $status_label= '';
                $ride_type = '<font color="info">Fixed</font>';
            }
            else if($status ==R)
            {
                $status_label = "success";
                $ride_type = "<font color='success'>Regular</font>";
            }
         

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->captain_name;  
                $sub_array[] = $row->cnic_number;  
                $sub_array[] = $row->mobile_number;
                $sub_array[] = $row->captain_status;
                $sub_array[] = $ride_type;
                $sub_array[] = $row->district_name;   
                $sub_array[] = $row->category_name;  
                $sub_array[] = $status_desc;//$row->status;  
                $sub_array[] = '<a href="bookings/assign_captain/'.$row->id.'" name="captain_profile" class="btn btn-info btn-xs">Assign</a>';   
                  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_bookings->get_all_data_regular(),  
                "recordsFiltered"     =>     $this->mdl_bookings->get_filtered_data_regular(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

            }
    else
    {
        redirect('saad/login');
    }
}


public function add_bookings()
{

    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {
     

    $searchTextField = $this->input->post('searchTextField');
    $searchTextField2 = $this->input->post('searchTextField2');
    
    if($searchTextField=="Mingora Local Bus station, Mingora, Pakistan"){
         $search1="Mingora Local Bus station, Mingora, Pakistan";
     }else{
         $search1=$searchTextField;
     }
             if($searchTextField2=="Mingora Local Bus station, Mingora, Pakistan"){
         $search2="Mingora Local Bus station, Mingora, Pakistan";
     }else{
         $search2=$searchTextField2;
     }
         $formattedAddrFrom = str_replace(' ','+',$search1);
     $formattedAddrTo = str_replace(' ','+',$search2);  
            
     //$discount_coupon=$_POST['discount_coupon'];
     $geocodeFrom = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false');
     $geocodeTo = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false');
     $outputFrom = json_decode($geocodeFrom);
     $outputTo = json_decode($geocodeTo);
         //==================================================================
     if($_POST['pickup_lat']!="" && $_POST['pickup_lng']!="")
     {
      $latitudeFrom = $_POST['pickup_lat'];
      $longitudeFrom = $_POST['pickup_lng'];
     }else{
      $latitudeFrom = $outputFrom->results[0]->geometry->location->lat;
      $longitudeFrom = $outputFrom->results[0]->geometry->location->lng;
     }
     if($_POST['dropoff_lat']!="" && $_POST['dropoff_lng']!="")
     {
      $latitudedesfrom = $_POST['dropoff_lat'];
      $longitudedesFrom = $_POST['dropoff_lng'];
     }else{
         $latitudedesfrom = $outputTo->results[0]->geometry->location->lat;
         $longitudedesFrom = $outputTo->results[0]->geometry->location->lng;
     }


     $data = array(
            'customer_id' => $this->input->post('customer_id'),
            'ride_type' => $this->input->post('select_ride_type'),
            'category_id' => $this->input->post('category_id'),
            'ride_for' => $this->input->post('ride_for'),
            'pickup_lat' => $latitudeFrom,
            'pickup_lng' => $longitudeFrom,
            'dropoff_lat' => $latitudedesfrom,
            'dropoff_lng' => $longitudedesFrom,
            'pickup' => $searchTextField,
            'dropoff' => $searchTextField2,
            'pickup_time' => $this->input->post('time')

        );
     $insert = save_data('booking_request',$data);

      }
    else
    {
        redirect('saad/login');
    }

  


}

public function random_booking_id($length = 35) {
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;

      }
    else
    {
        redirect('saad/login');
    }
}

public function assign_captain($id)
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {
        $booking_id = $this->random_booking_id();

    $maxid = 0;
    $row = $this->db->query('SELECT MAX(id) AS `maxid` FROM `booking_request`')->row();
    if ($row) {
        $maxid = $row->maxid;  
    }
    $asign_captain = array(
            'captain_id' => $id,
            'booking_id' => $booking_id
        );
      $success = update_data('booking_request',$asign_captain,$maxid);


     if($success){

            $fetch = get_query_data("SELECT B.category_id AS category_id, B.ride_type AS ride_type,B.pickup_lat AS pickup_lat, B.dropoff_lat AS dropoff_lat, B.pickup_lng AS pickup_lng, B.dropoff_lng AS dropoff_lng FROM booking_request AS B WHERE B.id = '".$maxid."'");

                    foreach ($fetch as $values) {
                        
                    }
                    $category_id = $values->category_id;
                    $ride_type = $values->ride_type;
                    $pickup_lat = $values->pickup_lat;
                    $pickup_lng = $values->pickup_lng;
                    $dropoff_lat = $values->dropoff_lat;
                    $dropoff_lng = $values->dropoff_lng;

                $where = "CAR.category_id ='".$category_id."' AND C.status = 'A' AND C.captain_status = 'Online' AND C.riding_type = '".$ride_type."' 
                    AND C.riding_status = 'Free'";
                $result = get_query_data("SELECT C.id AS captainID, C.gcm_id AS gcm_id FROM tbl_captains AS C JOIN tbl_cars AS CAR on CAR.id = C.car_id WHERE ".$where."");

                if($result){
                    foreach ($result as $res) {
                       
                    }

                    $dropoff_location = $dropoff_lat.','.$dropoff_lng.',';

                    $gcm_id = $res->gcm_id;
                    $post_id = $maxid;
                    $title = 'Here is Your Ride';
                    $message = "Your Customer is waiting for you at Point, ".$pickup_lat.",".$pickup_lng.",".$dropoff_location."
                                Location: 
                                ";
                    sendPushNotification_rider($gcm_id,$post_id,$title,$message);
                }
                else{
                    echo 'Notification Not send Successfully';
                }




        redirect('bookings');
     }
     else{
        echo 'Ride Not assign';
     }

      }
    else
    {
        redirect('saad/login');
    }
}

public function assign_fixed_ride($id,$fixed_id)
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {
        $booking_id = $this->random_booking_id();

    $maxid = 0;
    $row = $this->db->query('SELECT MAX(id) AS `maxid` FROM `booking_request`')->row();
    if ($row) {
        $maxid = $row->maxid;  
    }
    $asign_captain = array(
            'captain_id' => $id,
            'booking_id' => $booking_id,
            'list_id' => $fixed_id,
        );
      $success = update_data('booking_request',$asign_captain,$maxid);


     if($success){

            $fetch = get_query_data("SELECT B.category_id AS category_id, B.ride_type AS ride_type,B.pickup_lat AS pickup_lat, B.dropoff_lat AS dropoff_lat, B.pickup_lng AS pickup_lng, B.dropoff_lng AS dropoff_lng FROM booking_request AS B WHERE B.id = '".$maxid."'");

                    foreach ($fetch as $values) {
                        
                    }
                    $category_id = $values->category_id;
                    $ride_type = $values->ride_type;
                    $pickup_lat = $values->pickup_lat;
                    $pickup_lng = $values->pickup_lng;
                    $dropoff_lat = $values->dropoff_lat;
                    $dropoff_lng = $values->dropoff_lng;

                $where = "CAR.category_id ='".$category_id."' AND C.status = 'A' AND C.captain_status = 'Online' AND C.riding_type = '".$ride_type."' 
                    AND C.riding_status = 'Free'";
                $result = get_query_data("SELECT C.id AS captainID, C.gcm_id AS gcm_id FROM tbl_captains AS C JOIN tbl_cars AS CAR on CAR.id = C.car_id WHERE ".$where."");

                if($result){
                    foreach ($result as $res) {
                       
                    }

                    $dropoff_location = $dropoff_lat.','.$dropoff_lng.',';

                    $gcm_id = $res->gcm_id;
                    $post_id = $maxid;
                    $title = 'Here is Your Ride';
                    $message = "Your Customer is waiting for you at Point, ".$pickup_lat.",".$pickup_lng.",".$dropoff_location."
                                Location: 
                                ";
                    sendPushNotification_rider($gcm_id,$post_id,$title,$message);
                }
                else{
                    echo 'Notification Not send Successfully';
                }




        redirect('bookings');
     }
     else{
        echo 'Ride Not assign';
     }

      }
    else
    {
        redirect('saad/login');
    }
}



public function online_captain($id)
{
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

        $this->load->model("mdl_bookings");  
           $fetch_data = $this->mdl_bookings->make_datatables_online_captains();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  

            $status = $row->status;
            if($status==P)
            {
                $status_label= '';
                $status_desc = '<font color="info">Pending</font>';
            }
            else if($status ==A)
            {
                $status_label = "success";
                $status_desc = "<font color='success'>Approved</font>";
            }
            else if($status ==B){
                $status_label = "info";
                $status_desc = "<font color='red'>Blocked</font>";
            }
            $status = $row->riding_type;
            if($status==F)
            {
                $status_label= '';
                $ride_type = '<font color="info">Fixed</font>';
            }
            else if($status ==R)
            {
                $status_label = "success";
                $ride_type = "<font color='success'>Regular</font>";
            }
         

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->captain_name;   
                $sub_array[] = $row->mobile_number;
                $sub_array[] = $row->captain_status;
                $sub_array[] = $ride_type;
                $sub_array[] = $row->district_name;   
                $sub_array[] = $row->category_name;  
                $sub_array[] = $status_desc;//$row->status;  
                $sub_array[] = '
                                <a href="bookings/assign_another_captain/'.$row->id.'/'.$id.'" name="captain_profile" class="btn btn-info btn-xs">Assign</a>
                ';   
                  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_bookings->get_all_data_online_captains(),  
                "recordsFiltered"     =>     $this->mdl_bookings->get_filtered_data_online_captains(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 
      
    }
    else
    {
        redirect('saad/login');
    }
}


// assign another captain
public function assign_another_captain($cap_id,$id) {
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

            $fetch = get_query_data("SELECT B.category_id AS category_id, B.ride_type AS ride_type,B.pickup_lat AS pickup_lat, B.dropoff_lat AS dropoff_lat, B.pickup_lng AS pickup_lng, B.dropoff_lng AS dropoff_lng, B.customer_id AS customer_id FROM booking_request AS B WHERE B.id = '".$id."'");

                    foreach ($fetch as $values) {
                        
                    }
                    $category_id = $values->category_id;
                    $ride_type = $values->ride_type;
                    $pickup_lat = $values->pickup_lat;
                    $pickup_lng = $values->pickup_lng;
                    $dropoff_lat = $values->dropoff_lat;
                    $dropoff_lng = $values->dropoff_lng;
                    $customer_id = $values->customer_id;

                $where = "CAR.category_id ='".$category_id."' AND C.status = 'A' AND C.captain_status = 'Online' AND C.riding_type = '".$ride_type."' 
                    AND C.riding_status = 'Free' AND C.id = '".$cap_id."'";
                $result = get_query_data("SELECT C.id AS captainID, C.gcm_id AS gcm_id,C.captain_name AS captain_name, CAR.car_reg_number AS reg_number,
                          COM.name AS company_name
                          FROM tbl_captains AS C 
                          JOIN tbl_cars AS CAR on CAR.id = C.car_id
                          JOIN car_companies AS COM on COM.id = CAR.car_company_id
                          WHERE ".$where."");

                if($result){
                    foreach ($result as $res) {
                       
                    }
                    $cap_name = $res->captain_name;
                    $car_number = $res->reg_number;
                    $company = $res->company_name;

                    

                    $dropoff_location = $dropoff_lat.','.$dropoff_lng.',';

                    $gcm_id = $res->gcm_id;
                    $post_id = $id;
                    $title = 'Here is Your Ride';
                    $message = "Your Customer is waiting for you at Point, ".$pickup_lat.",".$pickup_lng.",".$dropoff_location."
                                Location: 
                                ";
                   $push = sendPushNotification_rider($gcm_id,$post_id,$title,$message);
                    
                    if($push == true){
                      $cust_data = get_query_data("SELECT tbl_customers.customer_name AS customer_name, tbl_customers.mobile_number AS mobile_number FROM tbl_customers WHERE id = '".$customer_id."'");
                        foreach ($cust_data as $cust) {
                          
                        }
                        $customer_name = $cust->customer_name;
                        $to = $cust->mobile_number;
                        $message = 'Dear '.$customer_name.'   Your MULL Driver '.$cap_name.' is on his way. Car Plate Number is '.$car_number.' '.$company.' 
                                    ';

                        sms_api($to,$message);
                    }
                        
                    
                }
                else{
                    echo 'Notification Not send Successfully';
                }




        redirect('bookings');

       
    }
    else
    {
        redirect('saad/login');
    }
}



}