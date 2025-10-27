<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_rides extends CI_Model
{
    var $table = "tbl_rides";  
      var $select_column = array("tbl_rides.id","tbl_captains.captain_name ", "tbl_captains.mobile_number as cap_mobile", "tbl_customers.mobile_number as cust_mobile", "tbl_customers.customer_name", "captain_id", "customer_id", "pickup_lat", "pickup_lng","tbl_categories.category_name",
                             "distination_lat", "distination_lng", "tbl_rides.created_at", "ride_amount", "ride_type"
                              );  
      var $order_column = array(null, "captain_id", "customer_id", null, null);  
      // for rides data
      function make_query()  
      {  
           $this->db->select($this->select_column);  
           $this->db->from($this->table);
           $this->db->join('tbl_captains','tbl_captains.id = tbl_rides.captain_id');
           $this->db->join('tbl_cars','tbl_cars.id = tbl_captains.car_id');
           $this->db->join('tbl_categories','tbl_categories.id = tbl_rides.category_id');
           $this->db->join('tbl_customers','tbl_customers.id = tbl_rides.customer_id');
           
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("captain_name", $_POST["search"]["value"]);  
                $this->db->or_like("customer_name", $_POST["search"]["value"]);  
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

     


}