<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_car_inspection_module extends CI_Model
{


  // car inspection table  variables 
        var $table_for_inspection = "tbl_car_inspection";
        var $select_column_for_inspection = array("tbl_car_inspection.id","office_id","car_number","ac","black_mirrors","tyre"," original_number_plates","seats_condition","suspension","music_system","inspection_fees","status","tbl_car_inspection.created_at","tbl_offices.office_name");
        var $order_column_for_inspection = array(null,'office_id',"car_number",null, null);



     //Validation of Login
    public function validate_credentials($email, $password){
        $sql = "SELECT * FROM tbl_admin WHERE email='".$email."' AND password='".$password."' AND user_type = 'Car_inspection'";
          if($query=$this->db->query($sql))
          {
              return $query->row_array();
          }
          else{
            return false;
          }
    
    }
    //end function validate


    //start  car inspection datatable code in saad
        function make_query_for_inspection()  
      {  
           $this->db->select($this->select_column_for_inspection);  
           $this->db->from($this->table_for_inspection);
           $where = "DATE(tbl_car_inspection.created_at) = CURDATE()";
           $this->db->where($where);
           $this->db->join('tbl_offices','tbl_offices.id = tbl_car_inspection.office_id');
           
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("office_name", $_POST["search"]["value"]);  
                $this->db->or_like("car_number", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column_for_inspection[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('id', 'DESC');  
           }  
      }  
      function make_datatables_for_inspection(){  
           $this->make_query_for_inspection();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           } 
           $where = "DATE(tbl_car_inspection.created_at) = CURDATE()";
           $this->db->where($where); 
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data_for_inspection(){  
           $this->make_query_for_inspection(); 
           $where = "DATE(tbl_car_inspection.created_at) = CURDATE()";
           $this->db->where($where); 
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data_for_inspection()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table_for_inspection); 
           $where = "DATE(tbl_car_inspection.created_at) = CURDATE()";
           $this->db->where($where);

           return $this->db->count_all_results();  
      }



      // end car inspection datatable
 
 }  
