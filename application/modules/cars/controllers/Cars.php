<?php
class Cars extends MX_Controller 
{

function __construct() {
parent::__construct();
}

public function index()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {


    $data['title'] = "Cars";
    $data['view_module'] = "cars";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
}
public function cars_list()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $this->load->model("mdl_cars");  
           $fetch_data = $this->mdl_cars->make_datatables();  
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
            else{
                $status_label = "info";
                $status_desc = "<font color='red'>Blocked</font>";
            }

            $category = $row->category_id;
            if($category==0)
            {
                $category_name = '<font color="info">Not Assign yet</font>';
            }
            else{
                $category_name = '<font color="info"> Assign </font>';
            }

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->car_reg_number;  
                $sub_array[] = $category_name;
                $sub_array[] = $row->district_name;  
                $sub_array[] = $row->name;
                $sub_array[] = $row->type_name;   
                $sub_array[] = $row->model;   
                $sub_array[] = $row->color;   
                $sub_array[] = $row->created_at;  
                $sub_array[] = $status_desc;//$row->status;  
                $sub_array[] = $row->updated_at;
                $sub_array[] = '<a href="cars/car_profile/'.$row->id.'" name="car_profile" class="btn btn-info btn-xs">View</a> 
                <a href="cars/car_profile/'.$row->id.'" name="car_profile" class="btn btn-danger btn-xs">Block</a>';   
                  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_cars->get_all_data(),  
                "recordsFiltered"     =>     $this->mdl_cars->get_filtered_data(),  
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
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {


    $data = array();
    $data['car_data'] = get_query_data("SELECT *,tbl_vendors.name as vendor_name,tbl_vendors.cnic_number,tbl_vendors.mobile_number,tbl_vendors.created_at,
                                            tbl_vendors.id,tbl_cars.status,tbl_cars.id as carid
                                             FROM tbl_cars 
                                             join tbl_categories on tbl_categories.id = tbl_cars.category_id
                                             join tbl_vendors on tbl_vendors.id = tbl_cars.vendor_id 
                                             join tbl_district on tbl_district.id = tbl_cars.district_id
                                             join car_companies on car_companies.id = tbl_cars.car_company_id
                                             join car_types on car_types.id = tbl_cars.car_type_id
                                             join car_model on car_model.id = tbl_cars.car_model_id
                                            
                                             join car_color on car_color.id = tbl_cars.car_color_id WHERE tbl_cars.id = $id");

    $data['fetch_district'] = get_query_data("SELECT d.id,d.district_name FROM tbl_district as d");
    $data['fetch_car_company'] = get_query_data("SELECT c.id,c.name FROM car_companies as c");
    $data['fetch_car_type'] = get_query_data("SELECT t.id,t.type_name FROM car_types as t");
    $data['fetch_car_model'] = get_query_data("SELECT m.id,m.model FROM car_model as m");
    $data['fetch_car_color'] = get_query_data("SELECT c.id,c.color FROM car_color as c");
    $data['assign_category'] = get_query_data("SELECT *,tbl_categories.id as categoryid FROM tbl_categories ");
    $data['title'] = "Car Information";
    $data['view_module'] = "cars";
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
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

   $id = $this->input->post('update_id');
    $data = array(
            'vendor_id' => $this->input->post('vendor_id')

        );
    update_data('tbl_cars',$data,$id);

    redirect('cars/car_profile/'.$id);

    }
       else{
        redirect('saad/login');
    }
}
public function block_car()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $id = $this->input->post('car_id');
    $data = array(
        'status' => 'B'
        );
    update_data('tbl_cars',$data,$id);
    echo "car is Blocked";

    }
       else{
        redirect('saad/login');
    }
}
public function approve_car()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $id = $this->input->post('car_id');
    $data = array(
        'status' => 'A'
        );
    update_data('tbl_cars',$data,$id);
    echo "car Approved Successfully";

    }
       else{
        redirect('saad/login');
    }
}
public function assign_category($id)
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $id = $this->input->post('car_id');
	$cat_id = $this->input->post('category_id');
 $cid = implode(",",$cat_id);
    $data = array(
            'category_id' => $cid
        );
 
 
    update_data('tbl_cars',$data,$id);
	
    echo "Category Assign to Car Successfully";

    }
       else{
        redirect('saad/login');
    }
}

public function car_info_update($id)
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $data = array(
                'car_reg_number' => $this->input->post('car_reg_number'),
                'district_id' => $this->input->post('district_id'),
                'car_company_id' => $this->input->post('car_company_id'),
                'car_type_id' => $this->input->post('car_type_id'),
                'car_model_id' => $this->input->post('car_model_id'),
                'car_color_id' => $this->input->post('car_color_id')
        );
    update_data('tbl_cars',$data,$id);

    echo "Car Information is Updated Successfully!";
    redirect('cars/car_profile/'.$id.'');
    }
       else{
        redirect('saad/login');
    }
}

public function car_switching_list()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $data['title'] = "Car Switching List";
    $data['view_module'] = "cars";
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
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {
    
    $this->load->model("mdl_cars");  
           $fetch_data = $this->mdl_cars->make_datatables_for_switch();  
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
                $sub_array[] = '<a href="cars/car_profile/'.$row->id.'" name="car_profile" class="btn btn-info btn-xs">View</a> 
                <a href="car_switch_approve/'.$row->id.'" name="captain_profile" class="btn btn-success btn-xs">Switch Success</a>';   
                  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_cars->get_all_data_for_switch(),  
                "recordsFiltered"     =>     $this->mdl_cars->get_filtered_data_for_switch(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output);

           }
       else{
        redirect('saad/login');
    }


    
}

//  From here car Inspection module code will be start which is shown on saad

public function view_inspection()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {



    $data['title'] = "Car Inspection List";
    $data['view_module'] = "cars";
    $data['view_files'] = "car_inspection_list";
    $this->load->module("templates");
    $this->templates->saad($data); 

    }
       else{
        redirect('saad/login');
    }


}

public function car_inspection_list()
{
     if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $this->load->model("mdl_cars");  
           $fetch_data = $this->mdl_cars->make_datatables_for_inspection();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  

            

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->office_name;  
                $sub_array[] = $row->car_number;
                $sub_array[] = $row->ac;  
                $sub_array[] = $row->black_mirrors;
                $sub_array[] = $row->tyre;   
                $sub_array[] = $row->original_number_plates;   
                $sub_array[] = $row->seats_condition;   
                $sub_array[] = $row->suspension;   
                $sub_array[] = $row->music_system;   
                $sub_array[] = $row->inspection_fees;   
                $sub_array[] = $row->status;   
                $sub_array[] = $row->created_at;  
                $sub_array[] = '<a href="view_single_inspection/'.$row->id.'" name="car_profile" class="btn btn-info btn-xs">View</a>';   
                  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_cars->get_all_data_for_inspection(),  
                "recordsFiltered"     =>     $this->mdl_cars->get_filtered_data_for_inspection(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

           }
       else{
        redirect('saad/login');
    }


}

public function view_single_inspection($id)
{
   if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {


    $data['single_inspection'] = get_query_data("SELECT * FROM tbl_car_inspection WHERE id = ".$id."");
    $data['office_data'] = get_query_data("SELECT tbl_offices.id,tbl_offices.office_name FROM tbl_offices");
    $data['title'] = "View Inspection";
    $data['view_module'] = "cars";
    $data['view_files'] = "view_inspection";
    $this->load->module("templates");
    $this->templates->saad($data); 

    }
       else{
        redirect('saad/login');
    }

}

public function update_single_inspection($id)
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

$id = $this->input->post('inspect_id');
    $data = array(
                // 'office_id' => $this->input->post('office_id'),
                // 'car_number' => $this->input->post('car_number'),
                'ac' => $this->input->post('ac'),
                'black_mirrors' => $this->input->post('black_mirrors'),
                'tyre' => $this->input->post('tyre'),
                'original_number_plates' => $this->input->post('original_number_plates'),
                'seats_condition' => $this->input->post('seats_condition'),
                'suspension' => $this->input->post('suspension'),
                'music_system' => $this->input->post('music_system'),
                'inspection_fees' => $this->input->post('inspection_fees'),
                'status' => $this->input->post('status')
            );

    $result = update_data('tbl_car_inspection',$data,$id);
    if($result)
    {
        $this->session->set_flashdata('error_msg', 'Car Inspection Successfull Updated.');
        redirect('cars/view_inspection');
       
        }
        else{
            $this->session->set_flashdata('error_msg', 'Car Inspection Not Successfuly submited.');
        }

    }
       else{
        redirect('saad/login');
    }


}

public function car_switch_approve($id)
{
   if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

    $data = array(
        'status' => '1'
        );
    update_data('tbl_car_switch',$data,$id);
    // echo "Captain Swi Successfully";
    redirect('cars/car_switching_list');
    }
       else{
        redirect('saad/login');
    }
}

public function change_car_category($id)
{   
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Manager')
    {

        $submit = $this->input->post('submit');
        if($submit == 'Submit'){
        $data = array(
                    'category_id' => $this->input->post('category_id')
        );
        update_data('tbl_cars',$data,$id);

        redirect('cars/car_profile/'.$id.'');
        }
        else
        {
            echo 'data not updated';
        }
    }
       else{
        redirect('saad/login');
    }   

}






}