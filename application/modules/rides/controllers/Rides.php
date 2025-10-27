<?php
class Rides extends MX_Controller 
{

function __construct() {
parent::__construct();
}

public function index()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {


    $data['title'] = "All Rides History";
    $data['view_module'] = "rides";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
       else{
        redirect('saad/login');
    }
}
public function rides_list()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

    $this->load->model("mdl_rides");  
           $fetch_data = $this->mdl_rides->make_datatables();  
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
             else if($status ==D)
            {
                $status_label = "success";
                $status_desc = "<font color='success'>Full Day</font>";
            }
             else if($status ==O)
            {
                $status_label = "success";
                $status_desc = "<font color='success'>One Way</font>";
            }
             else if($status ==T)
            {
                $status_label = "success";
                $status_desc = "<font color='success'>Two Way</font>";
            }
            else{
                $status_label = "info";
                $status_desc = "<font color='red'>Blocked</font>";
            }

          

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->captain_name;  
                $sub_array[] = $row->cap_mobile;  
                $sub_array[] = $row->customer_name;  
                $sub_array[] = $row->cust_mobile;  
                $sub_array[] = $row->category_name;
                $sub_array[] = $row->pickup_lat;  
                $sub_array[] = $row->pickup_lng;  
                $sub_array[] = $row->distination_lat;  
                $sub_array[] = $row->distination_lng;  
                $sub_array[] = $row->created_at;  
                $sub_array[] = $row->ride_amount;
                $sub_array[] = $status_desc;//$row->status;  
                $sub_array[] = '<a href="rides/car_profile/'.$row->id.'" name="car_profile" class="btn btn-info btn-xs">View</a> 
                <a href="rides/car_profile/'.$row->id.'" name="car_profile" class="btn btn-danger btn-xs">Block</a>';   
                  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_rides->get_all_data(),  
                "recordsFiltered"     =>     $this->mdl_rides->get_filtered_data(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

            }
       else{
        redirect('saad/login');
    }


 }
 public function car_profile($id)
 {
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {


    
    $data['car_data'] = get_query_data("SELECT *,tbl_vendors.name as vendor_name,tbl_vendors.cnic_number,tbl_vendors.mobile_number,tbl_vendors.created_at,
                                            tbl_vendors.id,tbl_rides.status
                                             FROM tbl_rides join tbl_vendors on tbl_vendors.id = tbl_rides.vendor_id 
                                             join tbl_district on tbl_district.id = tbl_rides.district_id
                                             join car_companies on car_companies.id = tbl_rides.car_company_id
                                             join car_types on car_types.id = tbl_rides.car_type_id
                                             join car_model on car_model.id = tbl_rides.car_model_id
                                             join car_color on car_color.id = tbl_rides.car_color_id WHERE tbl_rides.id = $id");
    $data['fetch_district'] = get_query_data("SELECT d.id,d.district_name FROM tbl_district as d");
    $data['fetch_car_company'] = get_query_data("SELECT c.id,c.name FROM car_companies as c");
    $data['fetch_car_type'] = get_query_data("SELECT t.id,t.type_name FROM car_types as t");
    $data['fetch_car_model'] = get_query_data("SELECT m.id,m.model FROM car_model as m");
    $data['fetch_car_color'] = get_query_data("SELECT c.id,c.color FROM car_color as c");
    $data['assign_category'] = get_query_data("SELECT *,tbl_categories.id as categoryid FROM tbl_categories");
    $data['title'] = "Car Information";
    $data['view_module'] = "rides";
    $data['view_files'] = "car_profile";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
       else{
        redirect('saad/login');
    }
 }
public function switch_car()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

   $id = $this->input->post('update_id');
    $data = array(
            'vendor_id' => $this->input->post('vendor_id')

        );
    update_data('tbl_rides',$data,$id);
    redirect('rides/car_profile/'.$id);

     }
       else{
        redirect('saad/login');
    }
}
public function block_car()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

    $id = $this->input->post('car_id');
    $data = array(
        'status' => '2'
        );
    update_data('tbl_rides',$data,$id);
    echo "car is Blocked";

     }
       else{
        redirect('saad/login');
    }
}
public function approve_car()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

    $id = $this->input->post('car_id');
    $data = array(
        'status' => '1'
        );
    update_data('tbl_rides',$data,$id);
    echo "car Approved Successfully";

     }
       else{
        redirect('saad/login');
    }
}
public function assign_category($id)
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

    $id = $this->input->post('car_id');
    $data = array(
            'category_id' => $this->input->post('category_id')
        );


     update_data('tbl_rides',$data,$id);
    echo "Category Assign to Car Successfully";

     }
       else{
        redirect('saad/login');
    }
}

public function car_info_update($id)
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

    $id = $this->input->post('car_id');
    $data = array(
                'car_reg_number' => $this->input->post('car_reg_number'),
                'district_id' => $this->input->post('district_id'),
                'car_company_id' => $this->input->post('car_company_id'),
                'car_type_id' => $this->input->post('car_type_id'),
                'car_model_id' => $this->input->post('car_model_id'),
                'car_color_id' => $this->input->post('car_color_id')
        );
    update_data('tbl_rides',$data,$id);

    echo "Car Information is Updated Successfully!";

     }
       else{
        redirect('saad/login');
    }
}

public function car_switching_list()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {

    $data['title'] = "Car Switching List";
    $data['view_module'] = "rides";
    $data['view_files'] = "car_switching";
    $this->load->module("templates");
    $this->templates->saad($data); 

     }
       else{
        redirect('saad/login');
    }
}

public function car_switch_datatable()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Customer Care')
    {
    
    $this->load->model("mdl_rides");  
           $fetch_data = $this->mdl_rides->make_datatables_for_switch();  
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
                $sub_array[] = $row->car_reg_number;  
                $sub_array[] = $row->old_vendor_cnic;  
                $sub_array[] = $row->old_vendor_number;  
                $sub_array[] = $row->new_vendor_cnic;   
                $sub_array[] = $row->new_vendor_number;   
                $sub_array[] = $row->car_doc;   
                $sub_array[] = $row->created_at;  
                $sub_array[] = $status_desc;//$row->status;  
                $sub_array[] = $row->updated_at;
                $sub_array[] = '<a href="rides/car_profile/'.$row->id.'" name="car_profile" class="btn btn-info btn-xs">View</a> 
                <a href="rides/car_profile/'.$row->id.'" name="captain_profile" class="btn btn-danger btn-xs">Block</a>';   
                  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_rides->get_all_data_for_switch(),  
                "recordsFiltered"     =>     $this->mdl_rides->get_filtered_data_for_switch(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output);

            }
       else{
        redirect('saad/login');
    }


    
}





}