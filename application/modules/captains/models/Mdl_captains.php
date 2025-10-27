<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_captains extends CI_Model
{
    var $table = "tbl_captains";  
      var $select_column = array("tbl_captains.id", "captain_name", "cnic_number", "district_id", "mobile_number", "tbl_captains.created_at", "status", "tbl_captains.updated_at","tbl_district.district_name");  
      var $order_column = array(null, "captain_name", "cnic_number", null, null);

        // variables for captain switching list
        var $table_for_switch = "tbl_captain_switch";  
        var $select_column_for_switch = array("id", "captain_name_cnic", "captain_mobile", "old_vendor_cnic", "new_vendor_cnic", "created_at", "status", "updated_at");  
        var $order_column_for_switch = array(null, "captain_name_cnic", "captain_mobile", null, null);
         //  end variables for captain switching list  

         // captain Payment History

      var $table_history = "tbl_rides";  
      var $select_column_history = array("tbl_rides.id", "captain_id", "customer_id", "pickup_lat", "pickup_lng",
                             "distination_lat", "distination_lng","ride_type","ride_amount","tbl_customers.customer_name","tbl_customers.mobile_number", "tbl_rides.created_at",
                             "tbl_calculation.customer_pay_to_captain","tbl_calculation.pay_to_us","tbl_calculation.pay_to_cap","tbl_calculation.balance_amount",
                             "tbl_calculation.balance_type");  
      var $order_column_history = array(null, "captain_id", "customer_id", null, null); 



       // captain Fine History
      var $table_fine_history = "tbl_fines"; 
      var $select_fine_column = array("tbl_fines.id","customer_id","captain_id","complain","fine_amount","complain_date","paid_status","tbl_fines.created_at","tbl_customers.customer_name","tbl_customers.mobile_number");  
      var $order_fine_column = array(null, "id", "customer_id", null, null);  





      // for captain data
      function make_query()  
      {  
           $this->db->select($this->select_column);  
           $this->db->from($this->table);
           $this->db->join('tbl_district','tbl_district.id = tbl_captains.district_id');
           
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("captain_name", $_POST["search"]["value"]);  
                $this->db->or_like("cnic_number", $_POST["search"]["value"]);  
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
// start Datatable captain switching Data
      function make_query_for_switch()  
      {  
           $this->db->select($this->select_column_for_switch);  
           $this->db->from($this->table_for_switch);
           
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("captain_name_cnic", $_POST["search"]["value"]);  
                $this->db->or_like("captain_mobile", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column_for_switch[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('id', 'DESC');  
           }  
      }  
      function make_datatables_for_switch(){  
           $this->make_query_for_switch();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data_for_switch(){  
           $this->make_query_for_switch();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data_for_switch()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table_for_switch); 

           return $this->db->count_all_results();  
      }
      // end captain Swithing Data

            // Captain All payment History
      function make_query_history($id)   
      {  

        $this->db->select($this->select_column_history);  
           $this->db->from($this->table_history);
           $where = "tbl_rides.captain_id = ".$id."";
           $this->db->where($where);
           $this->db->join('tbl_captains','tbl_captains.id = tbl_rides.captain_id');
           $this->db->join('tbl_customers','tbl_customers.id = tbl_rides.customer_id');
           $this->db->join('tbl_calculation','tbl_calculation.ride_id = tbl_rides.id');
          
           
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("captain_name", $_POST["search"]["value"]);  
                $this->db->or_like("customer_name", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column_history[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('id', 'DESC');  
           }  

           
      }  
      function make_datatables_history($id){  
           $this->make_query_history($id);  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $where = "tbl_rides.captain_id = ".$id."";
           $this->db->where($where);
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data_history($id){  
           $this->make_query_history($id); 
           $where = "tbl_rides.captain_id = ".$id."";
           $this->db->where($where); 
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data_history($id)  
      {  
           $this->db->select("*");  
           $this->db->from($this->table_history); 
           $where = "tbl_rides.captain_id = ".$id."";
           $this->db->where($where);
           return $this->db->count_all_results();  
      }

      // end captain all payment history 



       // Captain Fine History
      function make_query_fine_history($id)  
      {  
          $this->db->select($this->select_fine_column);  
           $this->db->from($this->table_fine_history);
           $where = "tbl_fines.captain_id = ".$id."";
           $this->db->where($where);
           $this->db->join('tbl_customers','tbl_customers.id = tbl_fines.customer_id');


         
          // $this->db->join('tbl_customers','tbl_customers.id = tbl_rides.customer_id');
          
           
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("customer_name", $_POST["search"]["value"]);  
                $this->db->or_like("complain_date", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_fine_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('id', 'DESC');  
           }
           
      }  
      function make_datatables_fine_history($id){  
           $this->make_query_fine_history($id);  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $where = "tbl_fines.captain_id = ".$id."";
           $this->db->where($where);
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data_fine_history($id){  
           $this->make_query_fine_history($id);  
           $where = "tbl_fines.captain_id = ".$id."";
           $this->db->where($where);
           $query = $this->db->get();  
           return $query->num_rows();  
      }     


      function get_all_data_fine_history($id)  
      {  
           $this->db->select("*");  
           $this->db->from($this->table_fine_history); 
           $where = "tbl_fines.captain_id = ".$id."";
           $this->db->where($where);
           return $this->db->count_all_results();  
      }

      // end captain Fine history 


}