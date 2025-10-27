<?php
class Customers extends MX_Controller 
{

function __construct() {
parent::__construct();
}

public function index()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {
    $data['title'] = "customers";
    $data['view_module'] = "customers";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
       else{
        redirect('saad/login');
    }
}
public function customers_list()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $this->load->model("mdl_customers");  
           $fetch_data = $this->mdl_customers->make_datatables();  
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
                $status_desc = "<font color='success'>Approved</font>";
            }
            else if($status ==R){

                $status_desc = "<font color='red'>Rejected</font>";
            }
            else{
                $status_label = "info";
                $status_desc = "<font color='red'>Blocked</font>";
            }

            $amount = $row->amount_type;
            if($amount==N)
            {
                $amount_stats = '<font color="black">None</font>';
            }
            else if($amount == C){
                $amount_stats = '<font color="red"> Negative </font>';
            }
            else if($amount == D){
                $amount_stats = '<font color="green"> Positive </font>';
            }

            $pass = $row->password;
            $password = md5($pass);

                $sub_array = array();
                $sub_array[] = '<input type="checkbox" name="customer_mobile_number[]" class="customer_mobile_number" value="'.$row->mobile_number.'"/>'; 
                $sub_array[] = $row->id;  
                $sub_array[] = $row->customer_name;  
                $sub_array[] = $row->mobile_number;
                $sub_array[] = $row->email;  
                $sub_array[] = $password;
                $sub_array[] = $status_desc;   
                $sub_array[] = $row->customer_status;   
                $sub_array[] = $row->amount;     
                $sub_array[] = $row->created_at;   
                $sub_array[] = '<a href="customers/customer_profile/'.$row->id.'" name="customer_profile" class="btn btn-info btn-xs">View</a>';   
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_customers->get_all_data(),  
                "recordsFiltered"     =>     $this->mdl_customers->get_filtered_data(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

            }
       else{
        redirect('saad/login');
    }

 }


  public function customer_profile($id)
 {
   if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

     $data['customer_data'] = get_query_data("SELECT * FROM tbl_customers WHERE tbl_customers.id = ".$id."");
    $data['title'] = "Customer Profile";
    $data['view_module'] = "customers";
    $data['view_files'] = "customer_profile";
    $this->load->module("templates");
    $this->templates->saad($data); 

     }
       else{
        redirect('saad/login');
    }

 }
 

 public function getaddress($lat,$lng)
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
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


 public function customer_ride_history($id)
 {
   
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

// datatable
$this->load->model("mdl_customers");  
           $fetch_data = $this->mdl_customers->make_datatables_for_history($id);  
           $data = array();  
           foreach($fetch_data as $row)  
           {  

            $status = $row->ride_type;
            if($status==R)
            {
                $status_label= '';
                $status_desc = '<font color="info">Regular</font>';
            }
            else if($status ==F)
            {
                $status_label = "success";
                $status_desc = "<font color='success'>Fixed</font>";
            }

            $pickup_lat = $row->pickup_lat;
            $pickup_lng = $row->pickup_lng;
            $pickup_address = $this->getaddress($pickup_lat,$pickup_lng);

            $dropoff_lat = $row->distination_lat;
            $dropoff_lng = $row->distination_lng;
            $dropoff_address = $this->getaddress($dropoff_lat,$dropoff_lng);




                $sub_array = array();   
                $sub_array[] = $row->id;   
                $sub_array[] = $row->captain_name.'('.$row->mobile_number.')';  
                $sub_array[] = $pickup_address;  
                $sub_array[] = $dropoff_address;
                $sub_array[] = $row->ride_amount;   
                $sub_array[] = $row->customer_pay_to_captain;   
                $sub_array[] = $row->balance_amount;   
                $sub_array[] = $row->balance_type;        
                $sub_array[] = $status_desc;//$row->status;  
                $sub_array[] = $row->created_at;
                $sub_array[] = '<a href="captains/captain_profile/'.$row->id.'" name="captain_profile" class="btn btn-info btn-xs">View</a> ';   
                  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_customers->get_all_data_for_history($id),  
                "recordsFiltered"     =>     $this->mdl_customers->get_filtered_data_for_history($id),  
                "data"                    =>     $data  
           );  
           echo json_encode($output);

    // end datatable

            }
       else{
        redirect('saad/login');
    }

   

 }
public function send_individual_sms($id)
{


    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {
        $message = $this->input->post('sms_text');

        $result = get_query_data("SELECT C.mobile_number AS mobile_number FROM tbl_customers AS C WHERE C.id = '".$id."'");
       foreach ($result as $value) { 
       }

        $to = $value->mobile_number;
       $data = array(
                'sms_text' => $message,
                'purpose' => $this->input->post('purpose'),
                'mobile_number' => $to
            );
       save_data('tbl_sms', $data);
    
        sms_api($to,$message);

        redirect('customers/customer_profile/'.$id.'');



    }
       else{
        redirect('saad/login');
    }
}
public function send_sms_selected()
{
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {
        $message = $this->input->post('message');

        //$message = 'hello this is static message';
        $number = $this->input->post('id');
        if(isset($number)){

             foreach ($number as $to) { 

                sms_api($to,$message);
                  
            }

        }
        redirect('customers');
       


    }
       else{
        redirect('saad/login');
    }

}

public function update_customer_profile($id)
{
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

  //  $pass = $this->input->post('password');
       $data = array(

                    'customer_name' => $this->input->post('customer_name'),
                    'email' => $this->input->post('email'),
                    'mobile_number' => $this->input->post('mobile_number'),
                    'status' => $this->input->post('status'),
                    
       );

       $result = update_data('tbl_customers',$data,$id);
       if($result)
            {
        redirect('customers/customer_profile/'.$id.'');
            }
       else
            {
             echo 'Customer Profile Not Updated';
            }
       


    }
       else{
        redirect('saad/login');
    }

}

public function send_manual_messages()
{
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

        $message = $this->input->post('sms');
        $to = $this->input->post('customer_number');

        sms_api($to,$message);

        redirect('customers');


    }
       else{
        redirect('saad/login');
    }

}







}