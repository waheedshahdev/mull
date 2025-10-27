<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_customers extends CI_Model
{
    var $table = "tbl_customers";  
      var $select_column = array("id","customer_name","mobile_number","email","password","status","customer_status","amount","amount_type","created_at"
                              );  
      var $order_column = array(null, "customer_name", "mobile_number", null, null);  

      // for car data

      // Individual customer rides detail 
      var $table_for_history = "tbl_rides";
      var $select_column_for_history = array("tbl_rides.id","captain_id","tbl_rides.customer_id","pickup_lat","pickup_lng","distination_lat","distination_lng","tbl_rides.created_at","ride_amount","ride_type","tbl_calculation.customer_pay_to_captain","tbl_calculation.balance_amount","tbl_calculation.balance_type","tbl_captains.captain_name","tbl_captains.mobile_number");
      var $order_column_for_history  = array(null,"customer_id","captain_id",null);
      // end 


      function make_query()  
      {  
           $this->db->select($this->select_column);  
           $this->db->from($this->table);
           //$this->db->join('tbl_categories','tbl_categories.id = tbl_customers.category_id');
           // $this->db->join('tbl_district','tbl_district.id = tbl_customers.district_id'); 
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("customer_name", $_POST["search"]["value"]);  
                $this->db->or_like("mobile_number", $_POST["search"]["value"]);  
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



      // start single customer ride history 


       function make_query_for_history($id)  
      {  
           $this->db->select($this->select_column_for_history);  
           $this->db->from($this->table_for_history);
           $where = "tbl_rides.customer_id = ".$id."";
           $this->db->where($where);
           $this->db->join('tbl_calculation','tbl_calculation.ride_id = tbl_rides.id');
           $this->db->join('tbl_captains','tbl_captains.id = tbl_rides.captain_id');
           // $this->db->join('tbl_district','tbl_district.id = tbl_customers.district_id'); 
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("captain_name", $_POST["search"]["value"]);  
                $this->db->or_like("tbl_rides.created_at", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column_for_history[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('id', 'DESC');  
           }  
      }  
      function make_datatables_for_history($id){  
           $this->make_query_for_history($id);  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $where = "tbl_rides.customer_id = ".$id."";
           $this->db->where($where);
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data_for_history($id){  
           $this->make_query_for_history($id); 
           $where = "tbl_rides.customer_id = ".$id."";
           $this->db->where($where); 
           $query = $this->db->get();  

          
           return $query->num_rows();  
      }       
      function get_all_data_for_history($id)  
      {  
           $this->db->select("*");  
           $this->db->from($this->table_for_history);
           $where = "tbl_rides.customer_id = ".$id."";
           $this->db->where($where);

           return $this->db->count_all_results();  
      }

      // end customer ride history 



}