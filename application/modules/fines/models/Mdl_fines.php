<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_fines extends CI_Model
{
    var $table = "tbl_fines";  
      var $select_column = array("tbl_fines.id", "customer_id", "captain_id", "complain", "fine_amount", "paid_status", "complain_date", "tbl_fines.created_at","tbl_customers.customer_name","tbl_captains.captain_name","tbl_captains.cnic_number");  
      var $order_column = array(null, "tbl_captains.captain_name", "tbl_customers.customer_name", null, null);

         //  end variables for captain switching list  
        



      // for captain data
      function make_query()  
      {  
           $this->db->select($this->select_column);  
           $this->db->from($this->table);
           $this->db->join('tbl_customers','tbl_customers.id = tbl_fines.customer_id');
           $this->db->join('tbl_captains','tbl_captains.id = tbl_fines.captain_id');
           
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







}