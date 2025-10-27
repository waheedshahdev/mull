<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_bookings extends CI_Model
{

      // for tbl fixed captains
       var $table = "tbl_captains";
      var $select_column = array("tbl_captains.id", "captain_name", "cnic_number", "district_id", "mobile_number","captain_status","riding_type", "tbl_captains.created_at", "status",
                        "tbl_captains.updated_at","tbl_district.district_name","tbl_fixed_price.trip_amount","tbl_fixed_price.trip_type","tbl_fixed_price.captain_id","tbl_fixed_price.id AS fixed_id");  
      var $order_column = array(null, "captain_name", "cnic_number", null, null);
      // end for fixed captains

      // for regular captains
       var $table_regular = "tbl_captains";
      var $select_column_regular = array("tbl_captains.id", "captain_name", "cnic_number", "tbl_captains.district_id", "mobile_number","captain_status","riding_type", "tbl_categories.category_name", "tbl_captains.status","tbl_cars.category_id","car_id",
                        "tbl_captains.updated_at","tbl_district.district_name");  
      var $order_column_regular = array(null, "captain_name", "cnic_number", null, null);
      // end for regular captains

      //for booking request
      var $table_booking = "booking_request";
      var $select_column_booking = array("booking_request.id","customer_id", "captain_id", "category_id", "pickup", "dropoff","booking_request.status","ride_type", "ride_for","pickup_lat","pickup_lng","dropoff_lat","dropoff_lng", "booking_date","tbl_customers.customer_name","tbl_categories.category_name","tbl_captains.captain_name");  
      var $order_column_booking = array(null, "customer_id", "captain_id", null, null);
      // end for booking request

      // for captain data
      function make_query()  
      {  
             $this->db->select($this->select_column);  
             $this->db->from($this->table);
             $this->db->where(array('status'=>'A',"captain_status"=>"Online","riding_type"=>"F"));
             $this->db->join('tbl_district','tbl_district.id = tbl_captains.district_id');
             $this->db->join('tbl_fixed_price','tbl_fixed_price.captain_id = tbl_captains.id');
            //get_query_data('SELECT * from tbl_captains where status = 'A' AND captain_status = Online AND riding_type = F');
           
           // if(isset($_POST["search"]["value"]))  
           // {  
           //      // $this->db->like("captain_name", $_POST["search"]["value"]);
           //      // $this->db->or_like("cnic_number", $_POST["search"]["value"]);  
           // }  
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

            // for Regular Fare
      function make_query_regular()  
     {  
             $this->db->select($this->select_column_regular);  
             $this->db->from($this->table_regular);
             $this->db->where(array('tbl_captains.status'=>'A',"captain_status"=>"Online","riding_type"=>"R"));
             $this->db->join('tbl_district','tbl_district.id = tbl_captains.district_id');
             $this->db->join('tbl_cars','tbl_cars.id = tbl_captains.car_id');
             $this->db->join('tbl_categories','tbl_categories.id = tbl_cars.category_id');
            //get_query_data('SELECT * from tbl_captains where status = 'A' AND captain_status = Online AND riding_type = F');
           
           // if(isset($_POST["search"]["value"]))  
           // {  
           //      $this->db->like("captain_id", $_POST["search"]["value"]);
           //      $this->db->or_like("cnic_number", $_POST["search"]["value"]);  
           // }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column_regular[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('id', 'DESC');  
           }  
      }  
      function make_datatables_regular(){  
           $this->make_query_regular();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data_regular(){  
           $this->make_query_regular();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data_regular()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table_regular); 

           return $this->db->count_all_results();  
      }

// bookings
    function make_query_booking()  
      {  
           $this->db->select($this->select_column_booking);  
           $this->db->from($this->table_booking);
           // $this->db->order_by("","desc");
           $this->db->join('tbl_customers','tbl_customers.id = booking_request.customer_id');
           $this->db->join('tbl_categories','tbl_categories.id = booking_request.category_id');
           $this->db->join('tbl_captains','tbl_captains.id = booking_request.captain_id');
           
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("customer_id", $_POST["search"]["value"]);  
                $this->db->or_like("captain_id", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column_booking[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('booking_request.id', 'DESC');  
           }  
      }  
      function make_datatables_booking(){  
           $this->make_query_booking();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data_booking(){  
           $this->make_query_booking();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data_booking()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table_booking); 

           return $this->db->count_all_results();  
      }

      //online captains
        // bookings
    function make_query_online_captains()  
      {  
           $this->db->select($this->select_column_regular);  
             $this->db->from($this->table_regular);
             $this->db->where(array('tbl_captains.status'=>'A',"captain_status"=>"Online","riding_status"=>"Free"));
             $this->db->join('tbl_district','tbl_district.id = tbl_captains.district_id');
             $this->db->join('tbl_cars','tbl_cars.id = tbl_captains.car_id');
             $this->db->join('tbl_categories','tbl_categories.id = tbl_cars.category_id');
           
           // if(isset($_POST["search"]["value"]))  
           // {  
           //      $this->db->like("captain_name", $_POST["search"]["value"]);  
           //      $this->db->or_like("category_name", $_POST["search"]["value"]);  
           // }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column_regular[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('id', 'DESC');  
           }  
      }  
      function make_datatables_online_captains(){  
           $this->make_query_online_captains();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data_online_captains(){  
           $this->make_query_online_captains();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data_online_captains()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table_regular); 

           return $this->db->count_all_results();  
      }

      // end online captains



}