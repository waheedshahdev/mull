<?php
class Payments extends MX_Controller 
{

function __construct() {
parent::__construct();
}

public function index()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {

    $data['title'] = "Payments";
    $data['view_module'] = "payments";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
       else{
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
public function distance()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {

    $latitudeFrom = 34.771747;
    $longitudeFrom = 72.360151;

    $latitudeTo = 34.015137;
    $longitudeTo = 71.524915;



//Calculate distance from latitude and longitude
    $theta = $longitudeFrom - $longitudeTo;
    $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
// riksha 12 rupee
    echo $distance = ($miles * 1.609344).' km';
echo '<br>';
    echo $dis = $distance * 20 + 80 + 180;
echo '<br>';
    echo number_format($dis,1);
    exit();

     }
       else{
        redirect('saad/login');
    }

}
public function payments_list()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {

    $this->load->model("mdl_payments");  
           $fetch_data = $this->mdl_payments->make_datatables();  
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
                $sub_array[] = $row->captain_name;  
                $sub_array[] = $row->customer_name;
                $sub_array[] = $pickup_address;  
                $sub_array[] = $dropoff_address;
                $sub_array[] = $row->ride_amount;
                $sub_array[] = $row->customer_pay_to_captain;
                $sub_array[] = round($row->pay_to_cap,1);
                $sub_array[] = round($row->pay_to_us,1);
                $sub_array[] = $row->balance_amount;
                $sub_array[] = $status_desc;
                $sub_array[] = $ride;
                $sub_array[] = $row->created_at;   
                $sub_array[] = '<a href="" name="car_profile" class="btn btn-info btn-xs">View</a>';   
                  
                $data[] = $sub_array;  
           }
           $row2[] = ""; $row2[] = ""; $row2[] = ""; $row2[] = ""; $row2[] = "Total";  $row2[] = $ride_amount_total; $row2[] = $customer_pay; $row2[] = round($captain_amount,1); $row2[] = round($mul_amount,1); $row2[] = $remaining_amount; $row2[] = ""; $row2[] = ""; $row2[] = ""; $row2[] = ""; 
           $data[] = $row2;
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_payments->get_all_data(),  
                "recordsFiltered"     =>     $this->mdl_payments->get_filtered_data(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

            }
       else{
        redirect('saad/login');
    }


 }


 public function pay_payment()
 {
    if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {
    
   $data['captain_table'] = get_query_data("SELECT tbl_captains.id,tbl_captains.captain_name,tbl_captains.mobile_number FROM tbl_captains");
    $data['title'] = "Payment";
    $data['view_module'] = "payments";
    $data['view_files'] = "pay_payment";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
       else{
        redirect('saad/login');
    }
 }

 public function fetch_captain_payment()
 {
    if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {
        $fromdate = $this->input->post('from_date');
        $todate = $this->input->post('to_date');
        $captain_id = $this->input->post('captain_id');
     if(isset($fromdate, $todate))  
    {   
      $output = '';  
     // $sql_query = " SELECT * FROM tbl_rides  
       //    WHERE created_at BETWEEN '".$fromdate."' AND '".$todate."'  
     // ";  
        //$result = execute_query($sql_query); 
        // $result = get_query_data("SELECT * FROM tbl_rides  
        //    WHERE captain_id = ".$captain_id." AND created_at BETWEEN '".$fromdate."' AND '".$todate."' ");
        $result = get_query_data("SELECT *,extra_pay_by_customer - less_pay_by_customer AS Extra_payment FROM (SELECT

        count(R.id) AS count_data,
        sum(R.ride_amount) AS rides_amount,
        sum(C.customer_pay_to_captain) AS total_collection,
        SUM(C.pay_to_us) AS mull_share,
        SUM(C.pay_to_cap) AS captain_net_amount
        FROM tbl_rides AS R
        JOIN tbl_calculation AS C on C.ride_id = R.id 
        WHERE captain_id = ".$captain_id." AND Date(R.created_at) BETWEEN '".$fromdate."' AND '".$todate."') t1
                INNER JOIN
                (SELECT 
                CASE 
                WHEN  SUM(C.balance_amount) IS NULL THEN 0
                ELSE 
        SUM(C.balance_amount) END AS extra_pay_by_customer
        FROM tbl_rides AS R
        JOIN tbl_calculation AS C on C.ride_id = R.id 
        WHERE captain_id = ".$captain_id." AND balance_type = 'M' AND Date(R.created_at) BETWEEN '".$fromdate."' AND '".$todate."') t2
                INNER JOIN 
                (SELECT
                CASE
                WHEN  SUM(C.balance_amount) IS NULL THEN 0 
                ELSE
        SUM(C.balance_amount) END AS less_pay_by_customer
        FROM tbl_rides AS R
        JOIN tbl_calculation AS C on C.ride_id = R.id 
        WHERE captain_id = ".$captain_id." AND C.balance_type = 'C' AND Date(R.created_at) BETWEEN '".$fromdate."' AND '".$todate."') t3");
       
      $output .= '  
           <table class="table table-bordered">  
                <tr>  
                     <th width="5%">Ride Count</th>   
                     <th width="10%">Rides Amount</th>  
                     <th width="10%">Total Collection</th>  
                     <th width="10%" style="color:red;">Mul Share</th>  
                     <th width="10%">Captain Net Amount</th>  
                     <th width="10%">Extra Pay</th>  
                     <th width="10%">Less Pay</th>  
                     <th width="10%" style="color:red;">Extra Payment</th>  
                </tr>  
      ';  
      if($result)  
      {  

        foreach ($result as $row) {
           $output .= '  
                     <tr>  
                          <td>'. $row->count_data .'</td>  
                          <td>'. $row->rides_amount .'</td>  
                          <td>'. $row->total_collection .'</td>  
                          <td style="color:red;">'. $row->mull_share .'</td>  
                          <td>'. $row->captain_net_amount .'</td>  
                          <td>'. $row->extra_pay_by_customer .'</td>  
                          <td>'. $row->less_pay_by_customer .'</td>  
                          <td style="color:red;">'. $row->Extra_payment .'</td>  
                     </tr>  
                ';  
        }
           
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Order Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }

  }
       else{
        redirect('saad/login');
    }  
 }


 public function captain_pay()
 {
    if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {
        $submit = $this->input->post('submit');
        if($submit == 'Pay'){
          $data = array(
              'captain_id' => $this->input->post('captain_id'),
              'week' => $this->input->post('week'),
              'mul_share' => $this->input->post('mul_share'),
              'extra_amount' => $this->input->post('extra_amount'),
              'extra_amount_status' => $this->input->post('extra_amount_status'),
              'status' => $this->input->post('status'),
              'description' => $this->input->post('description')
            );

          $result = save_data('tbl_weekly_payments',$data);
          if($result)
          {
            $this->session->set_flashdata('error_msg', 'Amount Successfully Paid');
            redirect('payments/paid_payments_table');
          }
          else{
              $this->session->set_flashdata('error_msg', 'Sorry Amount not Paid Please Try Again.');
              redirect('payments/pay_payment');
          }
        }

      }
       else{
        redirect('saad/login');
 } 


 }
public function paid_payments_table()
{
    if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {

    $data['title'] = "Paid Payments List";
    $data['view_module'] = "payments";
    $data['view_files'] = "paid_payments_list";
    $this->load->module("templates");
    $this->templates->saad($data);
    }
       else{
        redirect('saad/login');
 } 

}

public function paid_payments_list()
{
    if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {

         $this->load->model("mdl_payments");  
           $fetch_data = $this->mdl_payments->make_datatables_paid_payments();  
           $data = array();  

           $mul_share_total = 0;
           $extra_amount_total = 0;

           foreach($fetch_data as $row)  
           
           {  

             $mul_share_total = $mul_share_total+$row->mul_share;
             $extra_amount_total = $extra_amount_total+$row->extra_amount;

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->invoice_id;  
                $sub_array[] = $row->captain_name.'('.$row->mobile_number.')';  
                $sub_array[] = $row->week;

                $sub_array[] = $row->mul_share;
                $sub_array[] = $row->extra_amount;
                $sub_array[] = $row->extra_amount_status;
                $sub_array[] = $row->status;
                $sub_array[] = $row->created_at;   
                $sub_array[] = '<a href="payment_invoice/'.$row->id.'" name="car_profile" class="btn btn-info btn-xs">Invoice</a>';   
                  
                $data[] = $sub_array;  
           }
           $row2[] = ""; $row2[] = ""; $row2[] = ""; $row2[] = "Total"; $row2[] = $mul_share_total; $row2[] = $extra_amount_total;  $row2[] = ""; $row2[] = ""; $row2[] = ""; $row2[] = ""; 
           $data[] = $row2;
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_payments->get_all_data_paid_payments(),  
                "recordsFiltered"     =>     $this->mdl_payments->get_filtered_data_paid_payments(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output);
    
    }
       else{
        redirect('saad/login');
 } 

}

public function payment_invoice($id)
{
    if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {

    $data['invoice_data'] = get_query_data("SELECT *,tbl_weekly_payments.mul_share + tbl_weekly_payments.extra_amount AS subtotal FROM tbl_weekly_payments WHERE id = ".$id."");
    $data['title'] = "Payment Invoice List";
    $data['view_module'] = "payments";
    $data['view_files'] = "payment_invoice";
    $this->load->module("templates");
    $this->templates->saad($data);
    }
       else{
        redirect('saad/login');
      }
 } 

  public function fetch_daily_rides()
 {
    if($this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {
        // $fromdate = $this->input->post('from_date');
        $today_date = $this->input->post('today_date');
        $captain_id = $this->input->post('cap_id');
     if(isset($today_date, $captain_id))  
    {   
      $output = '';  
      $amount = 0;
      $customer_pay = 0;
     // $sql_query = " SELECT * FROM tbl_rides  
       //    WHERE created_at BETWEEN '".$fromdate."' AND '".$todate."'  
     // ";  
        //$result = execute_query($sql_query); 
        // $result = get_query_data("SELECT * FROM tbl_rides  
        //    WHERE captain_id = ".$captain_id." AND created_at BETWEEN '".$fromdate."' AND '".$todate."' ");
        $result = get_query_data("SELECT *,tbl_customers.customer_name
        FROM tbl_rides AS R
        JOIN tbl_calculation AS C on C.ride_id = R.id
        JOIN tbl_customers on tbl_customers.id = R.customer_id 
        WHERE captain_id = ".$captain_id." AND Date(R.created_at) = '".$today_date."'");
       
      $output .= '  
           <table class="table table-bordered">  
                <tr>   
                     <th width="10%">Customer Name</th>  
                     <th width="10%">Customer Name</th>  
                     <th width="10%">Customer Name</th>  
             
                    
                     <th width="10%">Ride Type</th>  
                     <th width="10%">Ride Amount</th>  
                     <th width="10%">Customer Pay</th>   
                </tr>  
      ';  
      if($result)  
      {  

        foreach ($result as $row) {

          $pickup_lat = $row->pickup_lat;
            $pickup_lng = $row->pickup_lng;
            $pickup_address = $this->getaddress($pickup_lat,$pickup_lng);

            $dropoff_lat = $row->distination_lat;
            $dropoff_lng = $row->distination_lng;
            $dropoff_address = $this->getaddress($dropoff_lat,$dropoff_lng);
            $amount = $amount + $row->ride_amount;
            $customer_pay = $customer_pay + $row->customer_pay_to_captain;
          $type = $row->ride_type;
          if($type == 'R'){
            $ride_type = "<font color='success'>Regular</font>";
          }
          else if($type == 'F'){
            $ride_type = "<font color='blue'>Fixed</font>";
          }

           $output .= '  
                     <tr>   
                          <td>'. $row->customer_name .'</td>  
                          <td>'. $pickup_address .'</td>  
                          <td>'. $dropoff_address .'</td>  
                   
                          
                          <td>'. $ride_type .'</td>  
                          <td>'. $row->ride_amount .'</td>  
                          <td>'. $row->customer_pay_to_captain .'</td>  
                     </tr> 


                ';  
        }
        $output .= '<tr>
          <th>All Rides</th>
          <td>'.count($result).'</td>
          <td></td>
          <th>Total</th>
          <td>'.$amount.'</td>
          <td>'.$customer_pay.'</td>
          </tr>
        ';
           
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Order Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }

  }
       else{
        redirect('saad/login');
    }  
 }







}