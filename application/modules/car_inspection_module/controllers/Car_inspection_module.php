<?php
class Car_inspection_module extends MX_Controller 
{

function __construct() {
parent::__construct();

//$this->load->model('mdl_admin_model');
}

public function index()
{
    if($this->session->userdata('user_type') == 'Car_inspection')
    {
    $office_id = $this->session->userdata('office_id');
    $data['office_share'] = get_query_data("SELECT 0.3 * SUM(inspection_fees) AS ofc_share, 0.7 * SUM(inspection_fees) AS mul_share  FROM tbl_car_inspection WHERE office_id = ".$office_id." AND DATE(created_at) = CURDATE()");

    $data['today_inspections'] = get_query_data("SELECT count('id') AS today_data FROM tbl_car_inspection WHERE office_id = ".$office_id." AND DATE(created_at) = CURDATE()");

    $data['all_inspection'] = get_query_data("SELECT count('id') AS all_data FROM tbl_car_inspection WHERE office_id = ".$office_id."");
    $data['today_fees'] = get_query_data("SELECT SUM(inspection_fees) AS all_fees FROM tbl_car_inspection WHERE office_id = ".$office_id." AND DATE(created_at) = CURDATE() ");
    $data['all_fees'] = get_query_data("SELECT SUM(inspection_fees) AS all_inspection_fees FROM tbl_car_inspection WHERE office_id = ".$office_id."");
    $data['view_module'] = "car_inspection_module";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->inspection($data);

    }
    else{
        redirect('car_inspection_module/login');
    }
}


public function login()
{
    $data['title'] = 'login';
           $this->load->view('login',$data);
}
public function dashboard(){
    if($this->session->userdata('user_type') == 'Car_inspection')
    {
       
            $data['title'] = 'Dashboard';
            $data['view_module'] = "car_inspection_module";
            $data['view_files'] = "index";
            $this->load->module("templates");
            $this->templates->inspection($data);
    }
    else
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if($email=="" || $password=="" ){   
            $this->session->set_flashdata('error_msg', 'Username or Password is empty. Please try again!');
            redirect(base_url().'car_inspection_module/login');    
        }
        
        $user_login = array(
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password'))
        );
        $this->load->model('mdl_car_inspection_module');
        $data = $this->mdl_car_inspection_module->validate_credentials($user_login['email'],$user_login['password']);
        if($data)
        {
            $this->session->set_userdata('id',$data['id']);
            $this->session->set_userdata('email',$data['email']);
            $this->session->set_userdata('name',$data['name']);
            $this->session->set_userdata('user_type',$data('user_type'));
            $this->session->set_userdata('office_id',$data['office_id']);
            $data['title'] = 'Dashboard';
            $data['view_module'] = "car_inspection_module";
            $data['view_files'] = "index";
            $this->load->module("templates");
            $this->templates->inspection($data);
        }
        else
        {
            $this->session->set_flashdata('error_msg', 'Invalid User,  Please Contact to Mul Administrator.');
            redirect('car_inspection_module/login');

        }   
    }
}
public function logout()
{
    $this->session->sess_destroy();
      redirect('car_inspection_module/login', 'refresh');
}

public function add_inspection()
{
    if($this->session->userdata('user_type') == 'Car_inspection')
    {







       
            $data['title'] = 'Add Inspection';
            $data['view_module'] = "car_inspection_module";
            $data['view_files'] = "add_inspection";
            $this->load->module("templates");
            $this->templates->inspection($data);
    }
    else{
        redirect('car_inspection_module/login');
    }

}
public function add_car_inspection()
{
    if($this->session->userdata('user_type') == 'Car_inspection')
    {

        $data = array(
                'office_id' => $this->input->post('office_id'),
                'car_number' => $this->input->post('car_number'),
                'ac' => $this->input->post('ac'),
                'black_mirrors' => $this->input->post('black_mirrors'),
                'tyre' => $this->input->post('tyre'),
                'original_number_plates' => $this->input->post('original_number_plates'),
                'seats_condition' => $this->input->post('seats_condition'),
                'suspension' => $this->input->post('suspension'),
                'music_system' => $this->input->post('music_system'),
                'inspection_fees' => $this->input->post('inspection_fees'),
            );

        $result = save_data('tbl_car_inspection',$data);
        if($result){

         $this->session->set_flashdata('error_msg', 'Car Inspection Successfull.');
        redirect('car_inspection_module/add_inspection');
       
        }
        else{
            $this->session->set_flashdata('error_msg', 'Car Inspection Not Successfuly submited.');
        }




       
         
    }
    else{
        redirect('car_inspection_module/login');
    }

}

public function view_inspection()
{
    if($this->session->userdata('user_type') == 'Car_inspection')
    {

        

            $data['title'] = 'View Inspection';
            $data['view_module'] = "car_inspection_module";
            $data['view_files'] = "view_inspection";
            $this->load->module("templates");
            $this->templates->inspection($data);

         
    }
    else{
        redirect('car_inspection_module/login');
    }

}
public function car_inspection_table()
{

    if($this->session->userdata('user_type') == 'Car_inspection')
    {

    $this->load->model("mdl_car_inspection_module");  
           $fetch_data = $this->mdl_car_inspection_module->make_datatables_for_inspection();  
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
                "recordsTotal"          =>      $this->mdl_car_inspection_module->get_all_data_for_inspection(),  
                "recordsFiltered"     =>     $this->mdl_car_inspection_module->get_filtered_data_for_inspection(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

       }
       else{
        redirect('car_inspection_module/login');
    }

}
public function view_single_inspection($id)
{
    if($this->session->userdata('user_type') == 'Car_inspection')
    {


    $data['single_inspection'] = get_query_data("SELECT * FROM tbl_car_inspection WHERE id = ".$id."");
    $data['office_data'] = get_query_data("SELECT tbl_offices.id,tbl_offices.office_name FROM tbl_offices");
    $data['title'] = "Update Inspection";
    $data['view_module'] = "car_inspection_module";
    $data['view_files'] = "view_single_inspection";
    $this->load->module("templates");
    $this->templates->inspection($data); 

    }
       else{
        redirect('car_inspection_module/login');
    }

}

public function update_single_inspection($id)
{
     if($this->session->userdata('user_type') == 'Car_inspection')
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
                //'status' => $this->input->post('status')
            );

    $result = update_data('tbl_car_inspection',$data,$id);
    if($result)
    {
        $this->session->set_flashdata('error_msg', 'Car Inspection Successfull Updated.');
        redirect('car_inspection_module/view_inspection');
       
        }
        else{
            $this->session->set_flashdata('error_msg', 'Car Inspection Not Successfuly submited.');
        }

        }
       else{
        redirect('car_inspection_module/login');
    }


}




}