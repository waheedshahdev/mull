<?php
class Captains extends MX_Controller 
{
function __construct() {
parent::__construct();
}

public function index()
{
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $data['title'] = "Captains";
    $data['view_module'] = "captains";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
}
public function captains_list()
{
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $this->load->model("mdl_captains");  
           $fetch_data = $this->mdl_captains->make_datatables();  
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

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->captain_name;  
                $sub_array[] = $row->cnic_number;  
                $sub_array[] = $row->mobile_number;
                $sub_array[] = $row->district_name;   
                $sub_array[] = $row->created_at;  
                $sub_array[] = $status_desc;//$row->status;  
                $sub_array[] = $row->updated_at;
                $sub_array[] = '<a href="captains/captain_profile/'.$row->id.'" name="captain_profile" class="btn btn-info btn-xs">View</a> 
                <a href="captains/captain_profile/'.$row->id.'" name="captain_profile" class="btn btn-danger btn-xs">Block</a>';   
                  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_captains->get_all_data(),  
                "recordsFiltered"     =>     $this->mdl_captains->get_filtered_data(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

           }
       else{
        redirect('saad/login');
    }


 }
 public function captain_profile($id)
 {
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {


    $data['captain_rating'] = get_query_data("SELECT CASE 
                                            WHEN  AVG(rating_stars) IS NULL THEN 0
                                            ELSE AVG(rating_stars) END AS cnt FROM tbl_ratings where captain_id=".$id."");
    $data['captain_data'] = get_query_data("SELECT *,tbl_vendors.id as vendorid ,tbl_vendors.cnic_number,tbl_vendors.mobile_number,tbl_vendors.created_at,
                                            tbl_captains.cnic_front,tbl_captains.cnic_back,tbl_captains.id,tbl_captains.status
                                             FROM tbl_captains join tbl_vendors on tbl_vendors.id = tbl_captains.vendor_id 
                                             join tbl_district on tbl_district.id = tbl_captains.district_id WHERE tbl_captains.id = $id");

    
    $data['captain_today_rides'] = get_query_data("SELECT * FROM tbl_rides join tbl_calculation on tbl_calculation.ride_id = tbl_rides.id
                                                    join tbl_customers on tbl_customers.id = tbl_rides.customer_id WHERE captain_id = $id AND DATE(tbl_rides.created_at) = CURDATE()");
	 $data['captain_weekly_rides'] = get_query_data("SELECT tbl_rides.created_at,tbl_rides.id,sum(tbl_rides.ride_amount) as ride_amount ,tbl_rides.ride_type,sum(tbl_calculation.pay_to_us) as pay_to_us,sum(tbl_calculation.pay_to_cap) as pay_to_cap,tbl_calculation.balance_amount,tbl_calculation.balance_type FROM tbl_rides join tbl_calculation on tbl_calculation.ride_id = tbl_rides.id
                                                    join tbl_customers on tbl_customers.id = tbl_rides.customer_id WHERE captain_id = $id group by tbl_rides.created_at");									
    $data['title'] = "Captain Profile";
    $data['view_module'] = "captains";
    $data['view_files'] = "captain_profile";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
 }
public function switch_captain()
{
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

   $id = $this->input->post('update_id');
    $data = array(
            'vendor_id' => $this->input->post('vendor_id')

        );
    update_data('tbl_captains',$data,$id);

    update_data('tbl_captain_switch','status = 1',$id);
    redirect('captains/captain_profile/'.$id);

    }
       else{
        redirect('saad/login');
    }
}
public function block_captain()
{
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $id = $this->input->post('captain_id');
    $data = array(
        'status' => 'B'
        );
    update_data('tbl_captains',$data,$id);
    echo "Captain is Blocked";

    }
       else{
        redirect('saad/login');
    }
}
public function approve_captain()
{
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $id = $this->input->post('captain_id');
    $data = array(
        'status' => 'A'
        );
    update_data('tbl_captains',$data,$id);
    echo "Captain Approved Successfully";

    }
       else{
        redirect('saad/login');
    }
}
public function captain_switching_list()
{
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $data['title'] = "Captain Switching List";
    $data['view_module'] = "captains";
    $data['view_files'] = "captain_switching";
    $this->load->module("templates");
    $this->templates->saad($data); 

    }
       else{
        redirect('saad/login');
    }
}
public function captain_switch_datatable()
{
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $this->load->model("mdl_captains");  
           $fetch_data = $this->mdl_captains->make_datatables_for_switch();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  

            $status = $row->status;
            if($status==0)
            {
                $status_label= '';
                $status_desc = '<font color="info">Pending</font>';
            }
            else if($status ==1)
            {
                $status_label = "success";
                $status_desc = "<font color='success'>Resolved</font>";
            }
            else{
                $status_label = "info";
                $status_desc = "<font color='red'>Blocked</font>";
            }

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->captain_name_cnic;  
                $sub_array[] = $row->captain_mobile;  
                $sub_array[] = $row->old_vendor_cnic;
                $sub_array[] = $row->new_vendor_cnic;   
                $sub_array[] = $row->created_at;  
                $sub_array[] = $status_desc;//$row->status;  
                $sub_array[] = '<a href="captain_profile/'.$row->id.'" name="captain_profile" class="btn btn-info btn-xs">View</a>
                <a href="approve_cap_switch/'.$row->id.'" name="captain_profile" class="btn btn-success btn-xs">Switch Success</a>';   
                  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_captains->get_all_data_for_switch(),  
                "recordsFiltered"     =>     $this->mdl_captains->get_filtered_data_for_switch(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output);

           }
       else{
        redirect('saad/login');
    }


    
}
public function captain_new()
{
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {
    
    $data['title'] = " Captain Profile";
    $data['view_module'] = "captains";
    $data['view_files'] = "captain_new";
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
public function captain_payment_history($id)
{

    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {
    $this->load->model("mdl_captains");  
           $fetch_data = $this->mdl_captains->make_datatables_history($id);  
           $data = array();  
           $ride_amount_total = 0;
           $captain_amount = 0;
           $customer_pay = 0;
           $mul_amount = 0;
           $remaining_amount = 0;

           foreach($fetch_data as $row)  
           
           {  

            $status = $row->balance_type;
            if($status==N)
            {
                $status_desc = '<font color="black">None</font>';
            }
            else if($status ==M)
            {
                $status_desc = "<font color='success'>Pay to Mul</font>";
            }
            else if($status ==C){

                $status_desc = "<font color='red'>Pay to Captain</font>";
            }
            $type = $row->ride_type;
            if($type==F)
            {
                $ride = '<font color="success">Fixed</font>';
            }
            else if($type ==O)
            {
                $ride = "<font color='blue'>One Way</font>";
            }
            else if($type ==T){

                $ride = "<font color='red'>Two Way</font>";
            }
            else if($type ==R){
                $ride = "<font color='brown'>Regular</font>";
            }



            $pickup_lat = $row->pickup_lat;
            $pickup_lng = $row->pickup_lng;
            $pickup_address = $this->getaddress($pickup_lat,$pickup_lng);

            $dropoff_lat = $row->distination_lat;
            $dropoff_lng = $row->distination_lng;
            $dropoff_address = $this->getaddress($dropoff_lat,$dropoff_lng);
             $ride_amount_total = $ride_amount_total+$row->ride_amount;
             $captain_amount = $captain_amount+$row->pay_to_cap;
             $customer_pay = $customer_pay+$row->customer_pay_to_captain;
             $mul_amount = $mul_amount+$row->pay_to_us;
             $remaining_amount = $remaining_amount+$row->balance_amount;
                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->customer_name;  
                $sub_array[] = $row->mobile_number;
                $sub_array[] = $pickup_address;  
                $sub_array[] = $dropoff_address;
                $sub_array[] = $row->ride_amount;
                $sub_array[] = $row->customer_pay_to_captain;
                $sub_array[] = $row->pay_to_cap;
                $sub_array[] = $row->pay_to_us;
                $sub_array[] = $row->balance_amount;
                $sub_array[] = $status_desc;
                $sub_array[] = $ride;
                $sub_array[] = $row->created_at;   
                $sub_array[] = '<a href="payments/car_profile/'.$row->id.'" name="car_profile" class="btn btn-info btn-xs">View</a>';   
                  
                $data[] = $sub_array;  
           }
           $row2[] = ""; $row2[] = ""; $row2[] = ""; $row2[] = ""; $row2[] = "Total";  $row2[] = $ride_amount_total; $row2[] = $customer_pay; $row2[] = $captain_amount; $row2[] = $mul_amount; $row2[] = $remaining_amount; $row2[] = ""; $row2[] = ""; $row2[] = ""; $row2[] = ""; 
           $data[] = $row2;
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_captains->get_all_data_history($id),  
                "recordsFiltered"     =>     $this->mdl_captains->get_filtered_data_history($id),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

           }
       else{
        redirect('saad/login');
    }


 }

  public function captain_fine_history($id)
   {

     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {
    $this->load->model("mdl_captains");  
           $fetch_data = $this->mdl_captains->make_datatables_fine_history($id);  
           $data = array();  
           $ride_amount_total = 0;

           foreach($fetch_data as $row)  
           
           {  

            $ride_amount_total = $ride_amount_total+$row->fine_amount;

                $sub_array = array();   
                $sub_array[] = $row->id;   
                $sub_array[] = $row->customer_name. '('.$row->mobile_number.')';  
                $sub_array[] = $row->complain;
                $sub_array[] = $row->fine_amount;
                $sub_array[] = $row->paid_status;
                $sub_array[] = $row->complain_date;
                $sub_array[] = $row->created_at;   
               // $sub_array[] = '<a href="payments/car_profile/'.$row->id.'" name="car_profile" class="btn btn-info btn-xs">View</a>';   
                  
                $data[] = $sub_array;  
           }
           $row2[] = ""; $row2[] = "";  $row2[] = "Total";  $row2[] = $ride_amount_total; $row2[] = ""; $row2[] = ""; $row2[] = ""; $row2[] = "";
           $data[] = $row2;
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
               "recordsTotal"          =>      $this->mdl_captains->get_all_data_fine_history($id),  
                "recordsFiltered"     =>     $this->mdl_captains->get_filtered_data_fine_history($id), 
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

           }
       else{
        redirect('saad/login');
    }


 }

public function approve_cap_switch($id)
{
   if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $data = array(
        'status' => '1'
        );
    update_data('tbl_captain_switch',$data,$id);
    // echo "Captain Swi Successfully";
    redirect('captains/captain_switching_list');
    }
       else{
        redirect('saad/login');
    }
}







}
