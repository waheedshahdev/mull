<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_saad extends CI_Model
{

function __construct() {
parent::__construct();
}


//Validation of Login
    public function validate_credentials($email, $password){
        $sql = "SELECT * FROM tbl_admin WHERE email='".$email."' AND password='".md5($password)."' AND (user_type = 'Super Admin' or user_type = 'Customer Care' or user_type = 'Accounts' or user_type = 'Manager')";
          if($query=$this->db->query($sql))
          {
              return $query->row_array();
          }
          else{
            return false;
          }
    
    }
    //end function validate

}