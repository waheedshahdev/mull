<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_mul_revenue extends CI_Model
{

        
      // paid payments datatable code

      var $table_paid_payments = "tbl_office_monthly_share";  
      var $select_column_paid_payments = array("tbl_office_monthly_share.id","invoice_id", "office_id", "month_name", "office_share",
                             "tbl_office_monthly_share.status","tbl_office_monthly_share.created_at","tbl_office_monthly_share.description",
                             "tbl_offices.office_name"
                             );  
      var $order_column_paid_payments = array(null, "month_name", "tbl_office_monthly_share.created_at", null, null);  


     
      // start code for office share paid


       function make_query_paid_payments()  
      {  
           $this->db->select($this->select_column_paid_payments);  
           $this->db->from($this->table_paid_payments);

           $this->db->join('tbl_offices','tbl_offices.id = tbl_office_monthly_share.office_id');
          
           
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("month_name", $_POST["search"]["value"]);  
                $this->db->or_like("office_name", $_POST["search"]["value"]);  
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
      // end office share paid






}