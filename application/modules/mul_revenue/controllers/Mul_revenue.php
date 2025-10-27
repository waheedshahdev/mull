<?php
class Mul_revenue extends MX_Controller 
{

function __construct() {
parent::__construct();
}

public function index()
{
    if( $this->session->userdata('user_type') == 'Super Admin')
    {
       $data['all_revenue'] = get_query_data("SELECT * FROM (SELECT SUM(tbl_calculation.pay_to_us) AS all_revenue  FROM tbl_calculation) t1
                                            INNER JOIN
                                            (SELECT 
                                            CASE 
                                            WHEN  SUM(C.balance_amount) IS NULL THEN 0
                                            ELSE 
                                    SUM(C.balance_amount) END AS extra_pay_by_customer
                                    FROM tbl_calculation AS C
                                    WHERE balance_type = 'M') t2

                                          ");
    $data['all_paid_revenue'] = get_query_data("SELECT * FROM (SELECT SUM(tbl_weekly_payments.mul_share) AS mul_revenue FROM tbl_weekly_payments WHERE status = 'PAID') t1
                                            INNER JOIN
                                            (SELECT 
                                            CASE 
                                            WHEN  SUM(W.extra_amount) IS NULL THEN 0
                                            ELSE 
                                    SUM(W.extra_amount) END AS extra_amount
                                    FROM tbl_weekly_payments AS W
                                    WHERE extra_amount_status = 'Captain Pay to Mul') t2
                                ");
    $data['current_month'] = get_query_data("SELECT * FROM (SELECT SUM(tbl_weekly_payments.mul_share) AS monthly_mul_revenue FROM tbl_weekly_payments WHERE MONTH(tbl_weekly_payments.created_at) = MONTH(CURRENT_DATE()) AND YEAR(tbl_weekly_payments.created_at) = YEAR(CURRENT_DATE()) AND status = 'PAID') t1
                                            INNER JOIN
                                            (SELECT 
                                            CASE 
                                            WHEN  SUM(W.extra_amount) IS NULL THEN 0
                                            ELSE 
                                    SUM(W.extra_amount) END AS extra_amount
                                    FROM tbl_weekly_payments AS W
                                    WHERE extra_amount_status = 'Captain Pay to Mul' AND MONTH(W.created_at) = MONTH(CURRENT_DATE()) AND YEAR(W.created_at) = YEAR(CURRENT_DATE())) t2");

    $data['monthly_revenue'] = get_query_data("SELECT * FROM (SELECT SUM(tbl_calculation.pay_to_us) AS all_monthly_revenue  FROM tbl_calculation WHERE MONTH(tbl_calculation.created_at) = MONTH(CURRENT_DATE()) AND YEAR(tbl_calculation.created_at) = YEAR(CURRENT_DATE())) t1
                                            INNER JOIN
                                            (SELECT 
                                            CASE 
                                            WHEN  SUM(C.balance_amount) IS NULL THEN 0
                                            ELSE 
                                    SUM(C.balance_amount) END AS monthly_extra_pay
                                    FROM tbl_calculation AS C
                                    WHERE balance_type = 'M' AND MONTH(C.created_at) = MONTH(CURRENT_DATE()) AND YEAR(C.created_at) = YEAR(CURRENT_DATE()) ) t2

                                          ");
    $data['current_month_credit'] = get_query_data("SELECT * FROM (SELECT SUM(tbl_office_monthly_share.office_share) AS monthly_office_share FROM tbl_office_monthly_share WHERE MONTH(tbl_office_monthly_share.created_at) = MONTH(CURRENT_DATE()) AND YEAR(tbl_office_monthly_share.created_at) = YEAR(CURRENT_DATE()) AND status = 'PAID') t1
                                            INNER JOIN
                                            (SELECT 
                                            CASE 
                                            WHEN  SUM(W.extra_amount) IS NULL THEN 0
                                            ELSE 
                                    SUM(W.extra_amount) END AS extra_amount
                                    FROM tbl_weekly_payments AS W
                                    WHERE extra_amount_status = 'We Pay to Captain' AND MONTH(W.created_at) = MONTH(CURRENT_DATE()) AND YEAR(W.created_at) = YEAR(CURRENT_DATE())) t2");


    $data['view_offices'] = get_query_data("SELECT *,tbl_offices.id AS office_id FROM tbl_offices JOIN tbl_district on tbl_district.id = tbl_offices.district_id");
    $data['title'] = "Mul Revenue";
    $data['view_module'] = "mul_revenue";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
}
public function view_office_revenue($id)
{
    if( $this->session->userdata('user_type') == 'Super Admin')
    {

      $data['view_offices'] = get_query_data("SELECT O.id AS office_id, O.office_name AS office_name, O.office_address AS office_address,
    O.office_phone AS office_phone, O.created_at AS office_created_at, D.district_name AS district_name  FROM tbl_offices AS O JOIN tbl_district AS D on D.id = O.district_id 
        WHERE O.id = ".$id."");
    $data['title'] = "View Office Revenue";
    $data['view_module'] = "mul_revenue";
    $data['view_files'] = "view_office_revenue";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
}


  public function fetch_office_monthly_revenue()
 {
    if($this->session->userdata('user_type') == 'Super Admin')
    {
        $fromdate = $this->input->post('from_date');
        $todate = $this->input->post('to_date');
        $office_id = $this->input->post('office_id');
     if(isset($fromdate, $todate))  
    {   
      $output = '';  
     // $sql_query = " SELECT * FROM tbl_rides  
       //    WHERE created_at BETWEEN '".$fromdate."' AND '".$todate."'  
     // ";  
        //$result = execute_query($sql_query); 
        // $result = get_query_data("SELECT * FROM tbl_rides  
        //    WHERE captain_id = ".$captain_id." AND created_at BETWEEN '".$fromdate."' AND '".$todate."' ");
        $result = get_query_data("SELECT C.office_id AS office_id,
            SUM(W.mul_share) AS mul_share,
            COUNT(W.captain_id) AS total_captains,
            0.1 * SUM(W.mul_share) AS office_share
        FROM tbl_captains AS C
        JOIN tbl_weekly_payments AS W on W.captain_id = C.id 
        WHERE C.office_id = ".$office_id." AND Date(W.created_at) BETWEEN '".$fromdate."' AND '".$todate."' AND W.status = 'PAID'");
       
      $output .= '  
           <table class="table table-bordered">  
                <tr>  
                     <th width="5%">Total Captains</th>   
                     <th width="10%">Total Mul Share</th>  
                     <th width="10%">Total Office Share</th>  
            
                </tr>  
      ';  
      if($result)  
      {  

        foreach ($result as $row) {
           $output .= '  
                     <tr>  
                          <td>'. $row->total_captains .'</td>  
                          <td>'. $row->mul_share .'</td>  
                          <td>'. $row->office_share .'</td>  
                          
 
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


// start pay office monthly share 
 public function pay_to_office()
 {

    if( $this->session->userdata('user_type') == 'Super Admin')
    {
        
    $submit = $this->input->post('submit');
    if($submit == 'Pay'){
        
    
         $data = array(
                'office_id' => $this->input->post('office_id'),
                'month_name' => $this->input->post('month_name'),
                'office_share' => $this->input->post('office_share'),
                'status' => $this->input->post('status'),
                'description' => $this->input->post('description'),
                );
        $result = save_data('tbl_office_monthly_share',$data);
        if($result){

          redirect('mul_revenue/office_paid');
        }
   
        }

        }
       else{
        redirect('saad/login');
    }
 }

  public function office_paid()
 {

    if( $this->session->userdata('user_type') == 'Super Admin')
    {
    $data['title'] = "Offices Revenue List";
    $data['view_module'] = "mul_revenue";
    $data['view_files'] = "office_paid_list";
    $this->load->module("templates");
    $this->templates->saad($data);


        }
       else{
        redirect('saad/login');
    }
 }




 public function office_paid_list()
{
    if($this->session->userdata('user_type') == 'Super Admin')
    {

         $this->load->model("mdl_mul_revenue");  
           $fetch_data = $this->mdl_mul_revenue->make_datatables_paid_payments();  
           $data = array();  

           $office_share_total = 0;

           foreach($fetch_data as $row)  
           
           {  

             $office_share_total = $office_share_total+$row->office_share;

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->invoice_id;   
                $sub_array[] = $row->office_name;   
                $sub_array[] = $row->month_name;
                $sub_array[] = $row->office_share;
                $sub_array[] = $row->status;
                $sub_array[] = $row->description;
                $sub_array[] = $row->created_at;   
                $sub_array[] = '<a href="office_payment_invoice/'.$row->id.'" name="car_profile" class="btn btn-info btn-xs">Invoice</a>';   
                  
                $data[] = $sub_array;  
           }
           $row2[] = ""; $row2[] = ""; $row2[] = ""; $row2[] = "Total"; $row2[] = $office_share_total; $row2[] = "";  $row2[] = ""; $row2[] = ""; $row2[] = ""; 
           $data[] = $row2;
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_mul_revenue->get_all_data_paid_payments(),  
                "recordsFiltered"     =>     $this->mdl_mul_revenue->get_filtered_data_paid_payments(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output);
    
    }
       else{
        redirect('saad/login');
 } 

}

public function office_payment_invoice($id)
{
    if($this->session->userdata('user_type') == 'Super Admin')
    {

    $data['invoice_data'] = get_query_data("SELECT * FROM tbl_office_monthly_share WHERE id = ".$id."");
    $data['title'] = "Payment Invoice List";
    $data['view_module'] = "mul_revenue";
    $data['view_files'] = "office_payment_invoice";
    $this->load->module("templates");
    $this->templates->saad($data);
    }
       else{
        redirect('saad/login');
      }
 } 






}
