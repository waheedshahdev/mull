<?php
class Fines extends MX_Controller 
{

function __construct() {
parent::__construct();
}

public function index()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {

    $data['title'] = "Fines";
    $data['view_module'] = "fines";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
       else{
        redirect('saad/login');
    }
}
public function add_fines()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {

    $data['customer_table'] = get_query_data("SELECT * FROM tbl_customers");
    $data['captain_table'] = get_query_data("SELECT * FROM tbl_captains");
    $data['title'] = "Add Fines";
    $data['view_module'] = "fines";
    $data['view_files'] = "add_fine";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
       else{
        redirect('saad/login');
    }
}

public function add_captain_fine()
{
  if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {
      
    $data = array(
                'customer_id' => $this->input->post('customer_id'),
                'captain_id' => $this->input->post('captain_id'),
                'complain' => $this->input->post('complain'),
                'fine_amount' => $this->input->post('fine_amount'),
                'complain_date' => $this->input->post('complain_date'),
                'paid_status' => $this->input->post('paid_status'),
                 );
    save_data('tbl_fines',$data);
    redirect('fines');

     }
       else{
        redirect('saad/login');
    }
}

public function fines_list()
{
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {

    $this->load->model("mdl_fines");  
           $fetch_data = $this->mdl_fines->make_datatables();  
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
            else if($status ==B){
                $status_label = "info";
                $status_desc = "<font color='red'>Blocked</font>";
            }

                $sub_array = array();   
                $sub_array[] = $row->id;  
                $sub_array[] = $row->captain_name;  
                $sub_array[] = $row->cnic_number;  
                $sub_array[] = $row->customer_name;  
                $sub_array[] = $row->complain;  
                $sub_array[] = $row->fine_amount;
                $sub_array[] = $row->paid_status;   
                $sub_array[] = $row->complain_date;   
                $sub_array[] = $row->created_at;  
                $sub_array[] = '<a href="fines/view_fines/'.$row->id.'" name="captain_profile" class="btn btn-info btn-xs">Edit</a> 
                ';   
                  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->mdl_fines->get_all_data(),  
                "recordsFiltered"     =>     $this->mdl_fines->get_filtered_data(),  
                "data"                    =>     $data  
           );  
           echo json_encode($output); 

            }
       else{
        redirect('saad/login');
    }


 }

   public function view_fines($id)
{
  
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {
 

   
    
    $data['fine_data'] = get_query_data("SELECT * FROM tbl_fines JOIN
                                 tbl_captains on tbl_captains.id = tbl_fines.captain_id JOIN tbl_customers on
                                  tbl_customers.id = tbl_fines.customer_id
                                  WHERE tbl_fines.id=".$id."");
    

    $data['title'] = "View Fines";
    $data['view_module'] = "fines";
    $data['view_files'] = "view_fines";
    $this->load->module("templates");
    $this->templates->saad($data);

     }
       else{
        redirect('saad/login');
    }
   


}
 public function update_fines($id)
 {
    if( $this->session->userdata('user_type') == 'Super Admin' || $this->session->userdata('user_type') == 'Accounts')
    {

    $submit = $this->input->post('submit');
    if($submit == 'Submit'){
        
    
         $data = array(
                'complain' => $this->input->post('complain'),
                'fine_amount' => $this->input->post('fine_amount'),
                'paid_status' => $this->input->post('status'),
                'complain_date' => $this->input->post('complain_date'),
                );
        $result = update_data('tbl_fines',$data,$id);
        if($result){
          redirect('fines');
        }
   
        }

         }
       else{
        redirect('saad/login');
    }
 }








}
