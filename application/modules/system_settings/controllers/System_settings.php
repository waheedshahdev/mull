<?php
class System_settings extends MX_Controller 
{

function __construct() {
parent::__construct();
}

public function index()
{
     if( $this->session->userdata('user_type') == 'Super Admin')
    {

   $data['title'] = "System Settings";
    $data['view_module'] = "system_settings";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
}
public function administration_access()
{
     if( $this->session->userdata('user_type')== 'Super Admin')
    {
    $data['view_offices'] = get_query_data("SELECT * FROM tbl_offices");
    $data['title'] = "Add Administrator";
    $data['view_module'] = "system_settings";
    $data['view_files'] = "administration_access";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
}

public function add_administrator()
{

     if( $this->session->userdata('user_type')== 'Super Admin')
    {

    //$pass = rand(100000,999999);
        $pass = $this->input->post('password');
    $data = array(
            'office_id' => $this->input->post('office_id'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => md5($pass),
            //'password' => md5($pass),
            'user_type' => $this->input->post('user_type')

        );
            $status = save_data('tbl_admin',$data);

             if($status){
        redirect('system_settings/administration_access');
        $this->session->set_flashdata("message","Office Successfully Added");

    }


// if($status !=''){
//   $to_email = $this->CI->input->post('email');
//   $subject = "Login Credintials";
//   $data['name'] = $this->CI->input->post('name');
//   $data['Email'] = $this->CI->input->post('email');
//   $data['password'] = $pass;

//   $message = $this->CI->load->view('administrator_email_template',$data,true);
//   send_email($to_email, $subject, $message, $type='', $attachment='',$cc_to='');

// }

}
       else{
        redirect('saad/login');
    }
}
public function offices()
{
     if( $this->session->userdata('user_type')== 'Super Admin')
    {
    $data['view_district'] = get_query_data("SELECT * FROM tbl_district");
    $data['view_offices'] = get_query_data("SELECT *,tbl_district.district_name FROM tbl_offices JOIN tbl_district on tbl_district.id = tbl_offices.district_id");
    $data['title'] = "Add Office";
    $data['view_module'] = "system_settings";
    $data['view_files'] = "offices";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
}
public function add_office()
{

     if( $this->session->userdata('user_type')== 'Super Admin')
    {

    $data = array(
            'district_id' => $this->input->post('district_id'),
            'office_name' => $this->input->post('office_name'),
            'office_phone' => $this->input->post('office_phone'),
            'office_address' => $this->input->post('office_address')

        );
    $result = save_data('tbl_offices',$data);
    if($result){
        redirect('system_settings/offices');
        $this->session->set_flashdata("message","Office Successfully Added");

    }

    }
       else{
        redirect('saad/login');
    }
}
public function rates()
{
     if( $this->session->userdata('user_type')== 'Super Admin')
    {
    $data['view_category'] = get_query_data("SELECT * FROM tbl_categories");
    $data['view_rates'] = get_query_data("SELECT *,tbl_categories.category_name FROM tbl_rates join tbl_categories on tbl_categories.id = tbl_rates.category_id");
    $data['title'] = "Add Rates";
    $data['view_module'] = "system_settings";
    $data['view_files'] = "rates";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
}
public function add_rates()
{
    if( $this->session->userdata('user_type')== 'Super Admin')
    {
    $data = array(
                'category_id' => $this->input->post('category_id'),
                'base_fare' => $this->input->post('base_fare'),
                'per_km' => $this->input->post('per_km'),

        );
    $result = save_data('tbl_rates',$data);
    if($result){
        redirect('system_settings/rates');
        $this->session->set_flashdata("message","Rate for Category is Successfully Added");
    }

    }
       else{
        redirect('saad/login');
    }
}



// for contact number details 
public function contact_number()
{
    if( $this->session->userdata('user_type')== 'Super Admin' || $this->session->userdata('user_type')== 'Customer Care')
    {

    // $data['view_contacts'] = get_query_data("SELECT tbl_contact_number.app_name,tbl_contact_number.phone_number,
    //                                  tbl_contact_number.email, tbl_contact_number.id, tbl_contact_number.status FROM tbl_contact_number");
    $data['title'] = "Contact Numbers ";
    $data['view_module'] = "system_settings";
    $data['view_files'] = "contact_number";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }

}

public function select_inline_data()
{

    if( $this->session->userdata('user_type')== 'Super Admin' || $this->session->userdata('user_type')== 'Customer Care')
    {
//     $query = "SELECT * FROM employee";
// $result = mysqli_query($connect, $query);

$result = get_query_data("SELECT * FROM tbl_contact_number");
$output = array();

foreach ($result as $row) {
    $output[] = $row;
}
echo json_encode($output);

}
       else{
        redirect('saad/login');
    }
}

public function update_inline_data()
{
    if( $this->session->userdata('user_type')== 'Super Admin' || $this->session->userdata['user_type'] == 'Customer Care')
    {

    $sql_query = "UPDATE tbl_contact_number SET ".$_POST["name"]." = '".$_POST["value"]."' 
    WHERE id = '".$_POST["pk"]."'";

    $result = execute_query($sql_query);

    if($result){
        echo 'Query Successfully worked';
}
}
       else{
        redirect('saad/login');
    }
}








}

