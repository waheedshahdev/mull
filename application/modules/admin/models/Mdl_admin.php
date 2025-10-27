<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_admin extends CI_Model
{

      var $table = "tbl_captain_switch";  
      var $select_column = array("id", "captain_name_cnic", "captain_mobile", "old_vendor_cnic", "new_vendor_cnic", "created_at", "status");  
      var $order_column = array(null, "captain_name_cnic", "captain_mobile", null, null);  
      //for car switch data
      var $table_for_car = "tbl_car_switch";
      var $select_column_for_car = array("id","car_reg_number","old_vendor_cnic","new_vendor_cnic","created_at","status");
      var $corder_column_for_car = array(null,"car_reg_number","old_vendor_cnic",null, null);
      // end for car switch data
//Validation of Login
    public function validate_credentials($email, $password){
        $sql = "SELECT * FROM tbl_admin WHERE email='".$email."' AND password='".md5($password)."' AND (user_type = 'User Admin' or user_type = 'User Admin CR' or user_type = 'Blind Partner')";
          if($query=$this->db->query($sql))
          {
              return $query->row_array();
          }
          else{
            return false;
          }
    
    }
    //end function validate
      // for captain data
      function make_query()  
      {  
           $this->db->select($this->select_column);  
           $this->db->from($this->table);  
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("captain_name_cnic", $_POST["search"]["value"]);  
                $this->db->or_like("captain_mobile", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('id', 'DESC');  
           }  
      }  
      function make_datatables(){  
           $this->make_query();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data(){  
           $this->make_query();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table); 

           return $this->db->count_all_results();  
      } 
// end for captain data
      // start code for car switch data
      function make_query_for_car()  
      {  
           $this->db->select($this->select_column_for_car);  
           $this->db->from($this->table_for_car);  
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("car_reg_number", $_POST["search"]["value"]);  
                $this->db->or_like("old_vendor_cnic", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column_for_car[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('id', 'DESC');  
           }  
      }  
      function make_datatables_for_car(){  
           $this->make_query_for_car();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data_for_car(){  
           $this->make_query_for_car();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data_for_car()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table_for_car); 
             
           return $this->db->count_all_results();  
      }
      // end code for car switch data  
 }  
