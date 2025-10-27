<?php
class Saad extends MX_Controller 
{

function __construct() {
parent::__construct();
$this->load->model('Mdl_saad');
}

public function index()
{
    if($this->session->userdata('user_type') == 'Super Admin' )
    {

   
    $data['view_module'] = "saad";
	$data['all_vendors']=get_total("id", "tbl_vendors");
    $data['all_captains']=get_total("id", "tbl_captains");
    $data['all_cars']=get_total("id", "tbl_cars");
    $data['today_vendors']=get_total_using_query("id", "tbl_vendors where DATE(created_at) = DATE(CURDATE())");
    $data['today_cars']=get_total_using_query("id", "tbl_cars where DATE(created_at) = DATE(CURDATE())");
    $data['today_captains']=get_total_using_query("id", "tbl_captains where DATE(created_at) = DATE(CURDATE())");
    $data['all_amount_rides']=get_sum("ride_amount", "tbl_rides");
    $data['all_amount_our']=get_sum("pay_to_us", "tbl_calculation");
    $data['total_fines'] = get_query_data("SELECT sum(fine_amount) AS total_fines FROM tbl_fines");
    $data['unpaid_fines'] = get_query_data("SELECT sum(fine_amount) AS unpaid_fines FROM tbl_fines WHERE tbl_fines.paid_status = 'UNPAID'");
    $data['paid_fines'] = get_query_data("SELECT sum(fine_amount) AS paid_fines FROM tbl_fines WHERE tbl_fines.paid_status = 'PAID'");
    $data['remission_fines'] = get_query_data("SELECT sum(fine_amount) AS remission_fines FROM tbl_fines WHERE tbl_fines.paid_status = 'REMISSION'");
    $data['today_fines_recieved'] = get_query_data("SELECT sum(fine_amount) AS today_fines_recieved FROM tbl_fines WHERE tbl_fines.paid_status = 'PAID' AND DATE(updated_at) = DATE(CURDATE())");
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
}
public function login()
{
    $data['title'] = 'login';
           $this->load->view('login',$data);
}
public function dashboard(){
    if($this->session->userdata('user_type') == 'Super Admin' )
    {
       
            $data['title'] = 'Dashboard';
            $data['view_module'] = "saad";
            $data['view_files'] = "index";
            $this->load->module("templates");
            $this->templates->saad($data);
    }
    else
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if($email=="" || $password=="" ){   
            $this->session->set_flashdata('error_msg', 'Username or Password is empty. Please try again!');
            redirect(base_url().'saad/login');    
        }
        
        $user_login = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        $data = $this->Mdl_saad->validate_credentials($this->input->post('email'), $this->input->post('password'));
        if($data)
        {
            $this->session->set_userdata('id',$data['id']);
            $this->session->set_userdata('email',$data['email']);
            $this->session->set_userdata('name',$data['name']);
			$this->session->set_userdata('user_type',$data['user_type']);
            $data['title'] = 'Dashboard';
            $data['view_module'] = "saad";
            $data['view_files'] = "index";
            $this->load->module("templates");
            $this->templates->saad($data);
        }
        else
        {
            $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
            redirect('saad/login');
        }   
    }
}
public function logout()
{
    $this->session->sess_destroy();
      redirect('saad/login', 'refresh');
}
public function vendors()
{
    if($this->session->userdata('user_type') == 'Super Admin' )
    {

	$data['title'] = "Vendors";
	$data['view_module'] = "saad";
    $data['view_files'] = "vendors";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
}
public function captains()
{
    if($this->session->userdata('user_type') == 'Super Admin' )
    {

	$data['title'] = "Captains";
	$data['view_module'] = "saad";
    $data['view_files'] = "captains";
    $this->load->module("templates");
    $this->templates->saad($data);

    }
       else{
        redirect('saad/login');
    }
}



}