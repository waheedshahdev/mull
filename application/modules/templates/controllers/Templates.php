<?php
class Templates extends MX_Controller 
{

    public function saad($data)
    {
        
        $this->load->view("saad",$data);
    }
     public function user_admin($data)
    {
           
        $this->load->view("user_admin",$data);
    }
     public function inspection($data)
    {
           
        $this->load->view("inspection",$data);
    }




}