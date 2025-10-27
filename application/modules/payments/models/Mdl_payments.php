<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_payments extends CI_Model
{
    var $table = "tbl_rides";  
      var $select_column = array("tbl_rides.id", "captain_id", "customer_id", "pickup_lat", "pickup_lng",
                             "distination_lat", "distination_lng","tbl_captains.captain_name","ride_type","tbl_rides.ride_amount","tbl_customers.customer_name", "tbl_rides.created_at",
                             "tbl_calculation.customer_pay_to_captain","tbl_calculation.pay_to_us","tbl_calculation.pay_to_cap","tbl_calculation.balance_amount",
                             "tbl_calculation.balance_type");  
      var $order_column = array(null, "captain_id", "customer_id", null, null);  


            // paid payments datatable code

      var $table_paid_payments = "tbl_weekly_payments";  
      var $select_column_paid_payments = array("tbl_weekly_payments.id","invoice_id", "captain_id", "week", "mul_share", "extra_amount",
                             "extra_amount_status","tbl_weekly_payments.status","tbl_weekly_payments.created_at","tbl_captains.captain_name",
                             "tbl_captains.mobile_number");  
      var $order_column_paid_payments = array(null, "captain_name", "mul_share", null, null); 


      // for car data
      function make_query()  
      {  
           $this->db->select($this->select_column);  
           $this->db->from($this->table);

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
                $this->db->like("car_reg_number", $_POST["search"]["value"]);  
                $this->db->or_like("old_vendor_cnic", $_POST["search"]["value"]);  
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

        // Paid payments datatable 

      function make_query_paid_payments()  
      {  
           $this->db->select($this->select_column_paid_payments);  
           $this->db->from($this->table_paid_payments);

           $this->db->join('tbl_captains','tbl_captains.id = tbl_weekly_payments.captain_id');
          
           
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("captain_name", $_POST["search"]["value"]);  
                $this->db->or_like("week", $_POST["search"]["value"]);  
                $this->db->or_like("invoice_id", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column_paid_payments[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('id', 'DESC');  
           }  
      }  
      function make_datatables_paid_payments(){  
           $this->make_query_paid_payments();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data_paid_payments(){  
           $this->make_query_paid_payments();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data_paid_payments()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table_paid_payments); 

           return $this->db->count_all_results();  
      }



}