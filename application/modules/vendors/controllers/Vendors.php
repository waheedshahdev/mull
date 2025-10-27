<?php
class Vendors extends MX_Controller 
{

function __construct() {
parent::__construct();
}

public function index()
{

    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $data['title'] = "Vendors";
    $data['view_module'] = "vendors";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
}
public function vendors_list()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $this->load->model("mdl_vendors");  
           $fetch_data = $this->mdl_vendors->make_datatables();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  

            $status = $row->status;
            if($status==A)
            {
                $status_desc = "<font color='success'>Approved</font>";
            }
            else if($status ==P)
            {
                $status_desc = "<font color='blue'>Pending</font>";
            }
            else if($status ==B)
            {
                $status_desc = "<font color='red'>Blocked</font>";
            }

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->name;  
                $sub_array[] = $row->cnic_number;  
                $sub_array[] = $row->email_address;  
                $sub_array[] = $row->mobile_number;  
                $sub_array[] = $row->created_at;  
                $sub_array[] = $status_desc;//$row->status;  
                $sub_array[] = $row->updated_at;
                $sub_array[] = '<a href="vendors/vendor_profile/'.$row->id.'" name="vendor_profile" class="btn btn-info btn-xs">View</a>';    
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_vendors->get_all_data(),  
                "recordsFiltered"     =>     $this->mdl_vendors->get_filtered_data(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

           }
       else{
        redirect('saad/login');
    }


 }
 public function vendor_profile($id)
 {

    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $data['vendor_car'] = get_query_data("SELECT *,tbl_cars.id FROM tbl_cars
                                            join tbl_district on tbl_district.id = tbl_cars.district_id join car_companies on car_companies.id = tbl_cars.car_company_id
                                            join car_types on car_types.id = tbl_cars.car_type_id
                                            join car_model on car_model.id = tbl_cars.car_model_id
                                            join car_color on car_color.id = tbl_cars.car_color_id WHERE vendor_id = '".$id."'");
    $data['vendor_captain'] = get_query_data("SELECT *,count(tbl_captains.id) AS count_captain FROM tbl_captains join tbl_district on tbl_district.id = tbl_captains.district_id WHERE vendor_id = '".$id."'");
    $data['vendor_data'] = get_query_data("SELECT * FROM tbl_vendors WHERE id = '".$id."'");
    $data['count_car'] = get_query_data("SELECT count(tbl_cars.id) AS count_car FROM tbl_cars WHERE vendor_id = '".$id."'");
    $data['title'] = "Vendor Profile";
    $data['view_module'] = "vendors";
    $data['view_files'] = "vendor_profile";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
 }

}