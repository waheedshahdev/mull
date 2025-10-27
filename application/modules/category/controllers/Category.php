<?php
class Category extends MX_Controller 
{

function __construct() {
parent::__construct();

$this->load->helper('cruds_helper');
}

function index()
{
    if( $this->session->userdata('user_type') == 'Super Admin')
    {

    $submit = $this->input->post('submit');
    if($submit == 'Submit')
    {
        $data = array(
                'category_name' => $this->input->post('category_name'),
                'base_fare' => $this->input->post('base_fare'),
                'per_km' => $this->input->post('per_km')
            );
        $result = save_data('tbl_categories',$data);
        if($result)
        {
            echo '<div class="alert alert-success">Data is successfully Added</div>';
        }
    }

    $data['view_categories'] = get_query_data("SELECT * FROM tbl_categories");
    $data['title'] = "Add Category";
    $data['view_module'] = "category";
    $data['view_files'] = "add_category";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
       else{
        redirect('saad/login');
    }
}

public function add_car_company()
{
    if( $this->session->userdata('user_type') == 'Super Admin')
    {

    $submit = $this->input->post('submit');
    if($submit == 'Submit')
    {
        $data = array(
                'name' => $this->input->post('name')
            );
        $result = save_data('car_companies',$data);
        if($result)
        {
            echo '<div class="alert alert-success">Data is successfully Added</div>';
        }
    }

    $data['view_categories'] = get_query_data("SELECT * FROM car_companies");
    $data['title'] = "Add Car Company";
    $data['view_module'] = "category";
    $data['view_files'] = "add_car_companies";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
       else{
        redirect('saad/login');
    }
}
public function car_type()
{
    if( $this->session->userdata('user_type') == 'Super Admin')
    {

    $submit = $this->input->post('submit');
    if($submit == 'Submit')
    {
        $data = array(
                'type_name' => $this->input->post('type_name')
            );
        $result = save_data('car_types',$data);
        if($result)
        {
            echo '<div class="alert alert-success">Data is successfully Added</div>';
        }
    }

    $data['view_categories'] = get_query_data("SELECT * FROM car_types");
    $data['title'] = "Add Car Type";
    $data['view_module'] = "category";
    $data['view_files'] = "car_type";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
       else{
        redirect('saad/login');
    }
}

public function car_model()
{
    if( $this->session->userdata('user_type') == 'Super Admin')
    {

    $submit = $this->input->post('submit');
    if($submit == 'Submit')
    {
        $data = array(
                'model' => $this->input->post('model')
            );
        $result = save_data('car_model',$data);
        if($result)
        {
            echo '<div class="alert alert-success">Data is successfully Added</div>';
        }
    }

    $data['view_model'] = get_query_data("SELECT * FROM car_model");
    $data['title'] = "Add Car Model";
    $data['view_module'] = "category";
    $data['view_files'] = "car_model";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
       else{
        redirect('saad/login');
    }
}

public function car_color()
{
    if( $this->session->userdata('user_type') == 'Super Admin')
    {
    
    $submit = $this->input->post('submit');
    if($submit == 'Submit')
    {
        $data = array(
                'color' => $this->input->post('color')
            );
        $result = save_data('car_color',$data);
        if($result)
        {
            echo '<div class="alert alert-success">Data is successfully Added</div>';
        }
    }

    $data['view_color'] = get_query_data("SELECT * FROM car_color");
    $data['title'] = "Add Car Color";
    $data['view_module'] = "category";
    $data['view_files'] = "car_color";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
       else{
        redirect('saad/login');
    }
}



}