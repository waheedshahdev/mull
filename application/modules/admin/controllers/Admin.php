<?php
class Admin extends MX_Controller 
{

function __construct() {
parent::__construct();

//$this->load->model('mdl_admin_model');
}

    // (
    // CASE 
    //     WHEN COUNT(C.admin_id) IS NULL THEN 0
    //     ELSE 
    //     COUNT(C.admin_id)
    // END) AS C_cnt,
    // (
    // CASE 
    //     WHEN COUNT(CAR.admin_id) IS NULL THEN 0
    //     ELSE 
    //     COUNT(CAR.admin_id)
    // END) AS CAR_cnt

// SELECT A.id, A.name, A.email, V.admin_id,
//                 (
//     CASE 
//         WHEN COUNT(V.admin_id) IS NULL THEN 0
//         ELSE 
//         COUNT(V.admin_id)
//     END) AS total,
//      (
//     CASE 
//         WHEN COUNT(C.admin_id) IS NULL THEN 0
//         ELSE 
//         COUNT(C.admin_id)
//     END) AS C_cnt,
//     (
//     CASE 
//         WHEN COUNT(CAR.admin_id) IS NULL THEN 0
//         ELSE 
//         COUNT(CAR.admin_id)
//     END) AS CAR_cnt




//         FROM tbl_admin AS A 
//         JOIN tbl_vendors AS V on V.admin_id = A.id
//         JOIN tbl_captains AS C on C.admin_id = A.id
//         JOIN tbl_cars AS CAR on CAR.admin_id = A.id
    
//          WHERE A.office_id = 1 AND DATE(V.created_at) = DATE(CURDATE()) GROUP BY A.id

public function index()
{ 
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'Blind Partner')
    {
    $id = $this->session->userdata('office_id');
    $where = 'office_id = '.$id.' AND DATE(created_at) = DATE(CURDATE())';
    $data['today_vendors'] = get_total('office_id', 'tbl_vendors', $where);
    $data['today_cars'] = get_total('office_id', 'tbl_cars', $where);
    $data['today_captains'] = get_total('office_id', 'tbl_captains', $where);
    $data['total_vendor_register'] = get_query_data("SELECT A.id, A.name, A.email, V.admin_id, COUNT(V.admin_id) AS v_cnt
        FROM tbl_admin AS A 
        JOIN tbl_vendors AS V on V.admin_id = A.id
         WHERE A.office_id = ".$id." AND DATE(V.created_at) = DATE(CURDATE()) GROUP BY A.id");
    $data['total_captain_register'] = get_query_data("SELECT A.id, A.name, A.email, C.admin_id, COUNT(C.admin_id) AS C_cnt
        FROM tbl_admin AS A 
        JOIN tbl_captains AS C on C.admin_id = A.id
         WHERE A.office_id = ".$id." AND DATE(C.created_at) = DATE(CURDATE()) GROUP BY A.id");
    $data['total_car_register'] = get_query_data("SELECT A.id, A.name, A.email, CAR.admin_id, COUNT(CAR.admin_id) AS CAR_cnt
        FROM tbl_admin AS A 
        JOIN tbl_cars AS CAR on CAR.admin_id = A.id
         WHERE A.office_id = ".$id." AND DATE(CAR.created_at) = DATE(CURDATE()) GROUP BY A.id");
    $data['view_module'] = "admin";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->user_admin($data);

     }
       else{
        redirect('admin/login');
    }
}
public function login()
{
    $data['title'] = 'login';
           $this->load->view('login',$data);
}
public function dashboard(){
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'Blind Partner')
    {
     
            $data['title'] = 'Dashboard';
            $data['view_module'] = "admin";
            $data['view_files'] = "search";
            $this->load->module("templates");
            $this->templates->user_admin($data);
    }
    else
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if($email=="" || $password=="" ){   
            $this->session->set_flashdata('error_msg', 'Username or Password is empty. Please try again!');
            redirect(base_url().'admin/login');    
        }
        
        $user_login = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
		$this->load->model("Mdl_admin");
        $data = $this->Mdl_admin->validate_credentials($this->input->post('email'),$this->input->post('password'));
		
        if($data)
        { 
            $this->session->set_userdata('id',$data['id']);
            $this->session->set_userdata('email',$data['email']);
            $this->session->set_userdata('name',$data['name']);
            $this->session->set_userdata('user_type',$data['user_type']);
            $this->session->set_userdata('office_id',$data['office_id']);
            $data['title'] = 'Dashboard';
            $data['view_module'] = "admin";
            $data['view_files'] = "search";
            $this->load->module("templates");
            $this->templates->user_admin($data);
			
        }
        else
        {
            $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
            redirect('admin/login');
        }   
    }
}
public function logout()
{
    $this->session->sess_destroy();
      redirect('admin/login', 'refresh');

       

}
public function search()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
	$data['view_module'] = "admin";
    $data['view_files'] = "search";
    $this->load->module("templates");
    $this->templates->user_admin($data);

     }
       else{
        redirect('admin/login');
    }
}
public function add_vendor()
{
   if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
    
	$data['title'] = "Add Vendor";
	$data['view_module'] = "admin";
    $data['view_files'] = "add_vendor";
    $this->load->module("templates");
    $this->templates->user_admin($data);

     }
       else{
        redirect('admin/login');
    }
 }  
public function add_vendor_data()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {


    $this->form_validation->set_rules('cnic_number','CNIC','is_unique[tbl_vendors.cnic_number]|trim|exact_length[13]');
    $this->form_validation->set_rules('mobile_number','MOBILE NO.','is_unique[tbl_vendors.mobile_number]|trim');
    $this->form_validation->set_rules('email_address','EMAIL','is_unique[tbl_vendors.email_address]|trim');


     if($this->form_validation->run()){   
               $data = array(
                                'name' => $this->input->post('name'),
                                'cnic_number' => $this->input->post('cnic_number'),
                                'office_id'=>$this->input->post('office_id'),
            					'admin_id'=>$this->input->post('admin_id'),
                                'email_address' => $this->input->post('email_address'),
                                'mobile_number' => $this->input->post('mobile_number'),
                                'cnic_front' => $this->upload_image(),
                                'cnic_back' => $this->upload_image2()

                    );

              $result =  save_data('tbl_vendors',$data);
                    echo $result;

    }else{
        echo validation_errors();

    }

         }
       else{
        redirect('admin/login');
    }
}
public function upload_image()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {

    if(isset($_FILES['cnic_front']))
    {
        $cnic_front = explode('.', $_FILES['cnic_front']['name']);
        $new_name = rand().'.'.$cnic_front[1];
        //$destination = '/vendor_images'.$new_name;
        move_uploaded_file($_FILES['cnic_front']['tmp_name'], './userfiles/vendor_images/'.$new_name);
        return $new_name;

    

    }

     }
       else{
        redirect('admin/login');
    }
}
public function upload_image2()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {

    if(isset($_FILES['cnic_back']))
    {
        $cnic_back = explode('.', $_FILES['cnic_back']['name']);
        $new_name = rand().'.'.$cnic_back[1];
       // $destination = 'vendor_images'.$new_name;
        move_uploaded_file($_FILES['cnic_back']['tmp_name'], './userfiles/vendor_images/'.$new_name);
        return $new_name;

    }

     }
       else{
        redirect('admin/login');
    }
}
public function add_car()
{
    // $submit = $this->input->post('submit');
    // if($submit == 'Submit')
    // {

if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {

    $data['view_district'] = get_query_data('SELECT * FROM tbl_district');
    $data['view_color'] = get_query_data('SELECT * FROM car_color');
    $data['view_model'] = get_query_data('SELECT * FROM car_model');
    $data['view_car_company'] = get_query_data('SELECT * FROM car_companies');
    $data['view_car_type'] = get_query_data('SELECT * FROM car_types');
    $data['title'] = "Add Car";
    $data['view_module'] = "admin";
    $data['view_files'] = "add_car";
    $this->load->module("templates");
    $this->templates->user_admin($data);

     }
       else{
        redirect('admin/login');
    }
}
public function add_car_data()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {

    $data = array(
                        'vendor_id' => $this->input->post('vendor_id'),
                        'car_reg_number' => $this->input->post('car_reg_number'),
                        'district_id' => $this->input->post('district_id'),
                        'car_company_id' => $this->input->post('car_company_id'),
                        'car_type_id' => $this->input->post('car_type_id'),
                        'car_model_id' => $this->input->post('car_model_id'),
                        'car_color_id' => $this->input->post('car_color_id'),
                        'office_id' => $this->input->post('office_id'),
                        'admin_id' => $this->input->post('admin_id'),
                        'car_document' => $this->upload_car_document()

            );
        save_data('tbl_cars',$data);

       // redirect($this->update_vendor.'/'.$this->uri->segment(3));

         }
       else{
        redirect('admin/login');
    }

}
public function check_car()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {

    $car_reg_number = $this->input->post('car_reg_number');
    $district_id = $this->input->post('district_id');
    $result = get_query_data("SELECT car_reg_number, district_id FROM tbl_cars WHERE car_reg_number = '$car_reg_number' and district_id = $district_id");
if($result)
{
    echo '<div class="alert alert-success">
                                <button class="close" data-dismiss="alert"></button>
                        Data found
            </div>';

}

 }
       else{
        redirect('admin/login');
    }

}

public function upload_car_document()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {

    if(isset($_FILES['car_document']))
    {
        $car_document = explode('.', $_FILES['car_document']['name']);
        $new_name = rand().'.'.$car_document[1];
       // $destination = 'vendor_images'.$new_name;
        move_uploaded_file($_FILES['car_document']['tmp_name'], './userfiles/car_document/'.$new_name);
        return $new_name;

    }

     }
       else{
        redirect('admin/login');
    }
}
public function add_captain()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {

    $data['view_district'] = get_query_data('SELECT * FROM tbl_district');
    $data['title'] = "Add Captain";
    $data['view_module'] = "admin";
    $data['view_files'] = "add_captain";
    $this->load->module("templates");
    $this->templates->user_admin($data);

     }
       else{
        redirect('admin/login');
    }
}
public function add_captain_data()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {


    $this->form_validation->set_rules('cnic_number','CNIC','is_unique[tbl_captains.cnic_number]|trim|exact_length[13]');
    $this->form_validation->set_rules('mobile_number','MOBILE NO.','is_unique[tbl_captains.mobile_number]|trim');


     if($this->form_validation->run()){  

     $data = array(
                        
                        'vendor_id' => $this->input->post('vendor_id'),
                        'captain_name' => $this->input->post('captain_name'),
                        'cap_id' => $this->input->post('cap_id'),
                        'mobile_number' => $this->input->post('mobile_number'),
                        'cnic_number' => $this->input->post('cnic_number'),
                        'district_id' => $this->input->post('district_id'),
                        'office_id' => $this->input->post('office_id'),
                        'admin_id' => $this->input->post('admin_id'),
                        'password' => md5('1234'),
                        'captain_image' => $this->upload_captain_image(),
                        'cnic_front' => $this->upload_cnic_front(),
                        'cnic_back' => $this->upload_cnic_back(),
                        'liscence_front' => $this->upload_liscence_front(),
                        'liscence_back' => $this->upload_liscence_back(),

            );
        save_data('tbl_captains',$data);

            }else{

                echo validation_errors();
            }

         }
       else{
        redirect('admin/login');
    }
}
public function upload_captain_image()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {

    if(isset($_FILES['captain_image']))
    {
        $captain_image = explode('.', $_FILES['captain_image']['name']);
        $new_name = rand().'.'.$captain_image[1];
       // $destination = 'vendor_images'.$new_name;
        move_uploaded_file($_FILES['captain_image']['tmp_name'], './userfiles/captain_images/'.$new_name);
        return $new_name;

    }

     }
       else{
        redirect('admin/login');
    }
}
public function upload_cnic_front()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
    if(isset($_FILES['cnic_front']))
    {
        $cnic_front = explode('.', $_FILES['cnic_front']['name']);
        $new_name = rand().'.'.$cnic_front[1];
       // $destination = 'vendor_images'.$new_name;
        move_uploaded_file($_FILES['cnic_front']['tmp_name'], './userfiles/captain_images/'.$new_name);
        return $new_name;

    }

     }
       else{
        redirect('admin/login');
    }
}
public function upload_cnic_back()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
    if(isset($_FILES['cnic_back']))
    {
        $cnic_back = explode('.', $_FILES['cnic_back']['name']);
        $new_name = rand().'.'.$cnic_back[1];
       // $destination = 'vendor_images'.$new_name;
        move_uploaded_file($_FILES['cnic_back']['tmp_name'], './userfiles/captain_images/'.$new_name);
        return $new_name;

    }

     }
       else{
        redirect('admin/login');
    }
}
public function upload_liscence_front()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
    if(isset($_FILES['liscence_front']))
    {
        $liscence_front = explode('.', $_FILES['liscence_front']['name']);
        $new_name = rand().'.'.$liscence_front[1];
       // $destination = 'vendor_images'.$new_name;
        move_uploaded_file($_FILES['liscence_front']['tmp_name'], './userfiles/captain_images/'.$new_name);
        return $new_name;

    }

     }
       else{
        redirect('admin/login');
    }
}
public function upload_liscence_back()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
    if(isset($_FILES['liscence_back']))
    {
        $liscence_back = explode('.', $_FILES['liscence_back']['name']);
        $new_name = rand().'.'.$liscence_back[1];
       // $destination = 'vendor_images'.$new_name;
        move_uploaded_file($_FILES['liscence_back']['tmp_name'], './userfiles/captain_images/'.$new_name);
        return $new_name;

    }
     }
       else{
        redirect('admin/login');
    }
}
public function car_switch()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
    $car_switching = get_query_data("SELECT * FROM tbl_car_switch");
    $data['car_switch'] = $car_switching;
    $data['title'] = "Car Switching";
    $data['view_module'] = "admin";
    $data['view_files'] = "car_switch";
    $this->load->module("templates");
    $this->templates->user_admin($data);

     }
       else{
        redirect('admin/login');
    }
}
public function car_switch_data()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
        $car = $this->input->post('car_reg_number');
        // $today = date("Y-m-d");
        $chk_data = get_query_data("SELECT id from tbl_car_switch where car_reg_number = '".$car."'  and DATE(created_at) = DATE(CURDATE())");

        if($chk_data){

            echo "already";

        }else{
    $data = array(
                    'car_doc' => $this->upload_car_doc(),
                    'car_reg_number' => $this->input->post('car_reg_number'),
                    'old_vendor_cnic' => $this->input->post('old_vendor_cnic'),
                    'old_vendor_number' => $this->input->post('old_vendor_number'),
                    'new_vendor_cnic' => $this->input->post('new_vendor_cnic'),
                    'new_vendor_number' => $this->input->post('new_vendor_number'),
                    'office_id' => $this->input->post('office_id')

        );
    $result = save_data('tbl_car_switch',$data);
    if($result){
        echo '<div class="alert alert-success">
                                <button class="close" data-dismiss="alert"></button>
                        Car switch Successfully!
            </div>';
    }
    }

     }
       else{
        redirect('admin/login');
    }
}
public function upload_car_doc()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
    if(isset($_FILES['car_doc']))
    {
        $car_doc = explode('.', $_FILES['car_doc']['name']);
        $new_name = rand().'.'.$car_doc[1];
       // $destination = 'vendor_images'.$new_name;
        move_uploaded_file($_FILES['car_doc']['tmp_name'], './userfiles/car_switch_images/'.$new_name);
        return $new_name;

    }

     }
       else{
        redirect('admin/login');
    }
}
public function captain_switch()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {

    //$data['captain_data'] = get_query_data("SELECT * FROM tbl_captain_switch");
    $data['title'] = "Captain Switching";
    $data['view_module'] = "admin";
    $data['view_files'] = "captain_switch";
    $this->load->module("templates");
    $this->templates->user_admin($data);

     }
       else{
        redirect('admin/login');
    }
}
public function captain_datatable()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
    $this->load->model("mdl_admin");  
           $fetch_data = $this->mdl_admin->make_datatables();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  

            $status = $row->status;
            if($status==0)
            {
                $status_label= 'danger';
                $status_desc = 'Pending';
            }
            else if($status ==1)
            {
                $status_label = "success";
                $status_desc = "Resolved";
            }
            else{
                $status_label = "info";
                $status_desc = "Blocked";
            }

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->captain_name_cnic;  
                $sub_array[] = $row->captain_mobile;  
                $sub_array[] = $row->old_vendor_cnic;  
                $sub_array[] = $row->new_vendor_cnic;  
                $sub_array[] = $row->created_at;  
                $sub_array[] = '<span class="label label-<?php echo $status_label?>">'.$status_desc;//$row->status;  
                $sub_array[] = '<button type="button" name="view" id="'.$row->id.'" class="btn btn-info btn-xs">View</button>';  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_admin->get_all_data(),  
                "recordsFiltered"     =>     $this->mdl_admin->get_filtered_data(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

            }
       else{
        redirect('admin/login');
    }



       }
public function captain_switch_data()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {


    $c_mobile = $this->input->post('captain_mobile');

    // echo $c_mobile;
            // $today = date("Y-m-d");
            $chk_data = get_query_data("SELECT id from tbl_captain_switch where captain_mobile = '".$c_mobile."'  and DATE(created_at) = DATE(CURDATE())");

            if($chk_data){

                echo "already";

            }else{

    $data = array(
                    'captain_name_cnic' => $this->input->post('captain_name_cnic'),
                    'captain_mobile' =>  $c_mobile,
                    'old_vendor_cnic' => $this->input->post('old_vendor_cnic'),
                    'new_vendor_cnic' => $this->input->post('new_vendor_cnic')

        );
    $result = save_data('tbl_captain_switch',$data);
    if($result){
        echo '<div class="alert alert-success">
                                <button class="close" data-dismiss="alert"></button>
                        Captain switch Successfully!
            </div>';
    }
}

     }
       else{
        redirect('admin/login');
    }
}
public function car_switch_datatable()
{
   if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
     $this->load->model("mdl_admin");  
           $fetch_data = $this->mdl_admin->make_datatables_for_car();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  

            $status = $row->status;
            if($status==0)
            {
                $status_label= 'danger';
                $status_desc = 'Pending';
            }
            else if($status ==1)
            {
                $status_label = "success";
                $status_desc = "Resolved";
            }
            else{
                $status_label = "info";
                $status_desc = "Blocked";
            }

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->car_reg_number;  
                $sub_array[] = $row->old_vendor_cnic;  
                $sub_array[] = $row->new_vendor_cnic;
                 
                $sub_array[] = '<span class="label label-<?php echo $status_label?>">'.$status_desc;//$row->status; 
                $sub_array[] = $row->created_at; 
                $sub_array[] = '<button type="button" name="view" id="'.$row->id.'" class="btn btn-info btn-xs">View</button>';  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_admin->get_all_data_for_car(),  
                "recordsFiltered"     =>     $this->mdl_admin->get_filtered_data_for_car(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

            }
       else{
        redirect('admin/login');
    }
}
public function update_vendor($id)
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
    $result = get_query_data("SELECT * FROM tbl_vendors WHERE id = $id");
    $view_captain = get_query_data("SELECT * FROM tbl_captains join tbl_district on tbl_captains.district_id = tbl_district.id where vendor_id = $id");
    $view_cars = get_query_data("SELECT *,tbl_cars.id FROM tbl_cars join car_companies on tbl_cars.car_company_id = car_companies.id 
                                    join car_types on tbl_cars.car_type_id = car_types.id 
                                    join tbl_district on tbl_cars.district_id = tbl_district.id
                                    join car_color on tbl_cars.car_color_id = car_color.id 
                                    join car_model on tbl_cars.car_model_id = car_model.id WHERE vendor_id = $id"); 
    $data['view_car'] = $view_cars;
    $data['captains'] = $view_captain;
    $data['view'] = $result;
    $data['title'] = "Add Car and Captain";
    $data['view_module'] = "admin";
    $data['view_files'] = "update_vendor";
    $this->load->module("templates");
    $this->templates->user_admin($data);

     }
       else{
        redirect('admin/login');
    }

}
//search vendor_id
public function search_vendor()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
 $search_type=$this->input->post("search_type");
 $search_vendor=$this->input->post("search_vendor");
 $result = $this->db->where($search_type,$search_vendor)->get("tbl_vendors");
 $vendor_result=$result->result_array();
 //get_query_data("select * from tbl_vendors where {$search_type} = {$search_vendor}");
 
   echo '<div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>NAME</th>
                                                <th>Cnic Number</th>
                                                <th>Email Address</th>
                                                <th>Mobile Number</th>
                                                <th>Update</th>
												
                                            </tr>
                                        </thead>';
 foreach($vendor_result as $key=>$vendors )
 {
 	 echo "<tr>";
	 echo "<td>".$vendor_result[$key]['name']."</td>";
	 echo "<td>".$vendor_result[$key]['cnic_number']."</td>";
	 echo "<td>".$vendor_result[$key]['email_address']."</td>";
	 echo "<td>".$vendor_result[$key]['mobile_number']."</td>";
	 $id=$vendor_result[$key]["id"];
	 echo "<td><a href='".base_url()."admin/update_vendor/{$id}' class='btn btn-primary'>update"."</a></td>";
	 echo "</tr>";
 }
echo "<table></div>";

 }
       else{
        redirect('admin/login');
    }


}

public function update_vendor_data($id)
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {

            $data = array(

                        'name' => $this->input->post('name'),

                        'cnic_number' => $this->input->post('cnic_number'),
                        'email_address' => $this->input->post('email_address'),
                        'mobile_number' => $this->input->post('mobile_number'),
                        // 'cnic_front' => $this->upload_cnic_front(),
                        // 'cnic_back' => $this->upload_cnic_back(),

            );
            if($_FILES['cnic_front']['name']!='' || $_FILES['cnic_back']['name']!='' ){
                $data['cnic_front'] = $this->upload_cnic_front();
                $data['cnic_back'] = $this->upload_cnic_back();
                }
        update_data('tbl_vendors',$data,$id);
        redirect('admin/update_vendor/'.$id.'');



 }
       else{
        redirect('admin/login');
    }


}
public function search_captain_info()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {





    $data['title'] = "Search Captain Information";
    $data['view_module'] = "admin";
    $data['view_files'] = "search_captain_info";
    $this->load->module("templates");
    $this->templates->user_admin($data);
           



 }
       else{
        redirect('admin/login');
    }


}

public function fetch_captain_info()
{
    if( $this->session->userdata('user_type') == 'User Admin' || $this->session->userdata('user_type') == 'User Admin CR')
    {
         $search_type = $this->input->post('search_type');
        $search_captain = $this->input->post('search_captain');
     if(isset($search_type, $search_captain))  
    {   
      $output = '';  
     // $sql_query = " SELECT * FROM tbl_rides  
       //    WHERE created_at BETWEEN '".$fromdate."' AND '".$todate."'  
     // ";  
        //$result = execute_query($sql_query); 
        // $result = get_query_data("SELECT * FROM tbl_rides  
        //    WHERE captain_id = ".$captain_id." AND created_at BETWEEN '".$fromdate."' AND '".$todate."' ");
        $result = get_query_data("SELECT *,C.captain_name,C.mobile_number AS captain_cell_number, C.cnic_number AS captain_cnic, C.created_at AS captain_reg_date, C.office_id AS captain_reg_office, C.captain_image AS cap_image, C.cnic_front AS cap_cnic_front, C.cnic_back AS cap_cnic_back, CAR.car_reg_number AS car_reg_number,
         V.name AS vendor_name, V.cnic_number AS vendor_cnic, V.mobile_number AS vendor_cell_number
        FROM tbl_captains AS C
        JOIN tbl_vendors AS V on V.id = C.vendor_id
        JOIN tbl_cars AS CAR on CAR.id = C.car_id
        WHERE C.".$search_type." = ".$search_captain."");
       
      $output .= '  
            <div class="container">
                    <div class="row">
                    <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Captain Profile</div>
                                  
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        ';
                                        if($result)  
      {  

        foreach ($result as $row) {

          // $type = $row->ride_type;
          // if($type == 'R'){
          //   $ride_type = "<font color='success'>Regular</font>";
          // }
          // else if($type == 'F'){
          //   $ride_type = "<font color='blue'>Fixed</font>";
          // }
            $cnic_front= base_url('userfiles/captain_images/'.$row->cap_cnic_front);
            $captain_image= base_url('userfiles/captain_images/'.$row->cap_image);
            $cnic_back= base_url('userfiles/captain_images/'.$row->cap_cnic_back);
           $output .= '  
                     <tr>
                                               <td><b>Captain Name</b></td>
                                               <td>'.$row->captain_name.'</td>
                                          
                                            </tr>
                                            <tr>
                                               <td><b>Captain Mobile Number</b></td>
                                               <td>'.$row->captain_cell_number.'</td>
                                          
                                            </tr>
                                            <tr>
                                               <td><b>Captain CNIC</b></td>
                                               <td>'.$row->captain_cnic.'</td>
                                          
                                            </tr>
                                            <tr>
                                               <td><b>Registration Date</b></td>
                                               <td>'.$row->captain_reg_date.'</td>
                                          
                                            </tr>
                                            <tr>
                                               <td><b>Registration Office</b></td>
                                               <td>'.$row->captain_reg_office.'</td>
                                          
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                           
                        </div>
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Captain Registration</div>
                                   
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <img src="'.$captain_image.'" style="width:300px; height:200px;">
                                            <br>
                                            <img src="'.$cnic_front.'" style="width:300px; height:200px;">
                                            <br>
                                            <img src="'.$cnic_back.'" style="width:300px; height:200px;">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                          
                        </div>
                        <div class="row">
                          <div class="span6">
                          
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Vendor Information</div>
                                  
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       
                                            <tr>
                                               <td><b>Vendor Name</b></td>
                                               <td>'.$row->vendor_name.'</td>
                                          
                                            </tr>
                                            <tr>
                                               <td><b>Mobile Number</b></td>
                                               <td>'.$row->vendor_cell_number.'</td>
                                          
                                            </tr>
                                            <tr>
                                               <td><b>Cnic Number</b></td>
                                               <td>'.$row->vendor_cnic.'</td>
                                          
                                            </tr>
                                          
                                    
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>

                         <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Car Information</div>
                                   
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>

                                            </tr>
                                        </thead>
                                        <tbody>
                                       
                                            <tr>
                                               <td><b>Car Registration Number</b></td>
                                               <td>'.$row->car_reg_number.'</td>
                                          
                                            </tr>
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
                        </div>

            </div>
                    </div>


                ';  
        }
           
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Captain Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }
        



 }
       else{
        redirect('admin/login');
    }


}











}