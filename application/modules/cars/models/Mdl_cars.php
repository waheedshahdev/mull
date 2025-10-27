<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_cars extends CI_Model
{
    var $table = "tbl_cars";  
      var $select_column = array("tbl_cars.id", "car_reg_number", "category_id", "district_id", "car_company_id",
                             "car_type_id", "car_model_id", "car_color_id", "tbl_cars.created_at", "tbl_cars.status",
                             "car_types.type_name", "car_model.model", "car_color.color",
                              "tbl_cars.updated_at","tbl_district.district_name", "car_companies.name");  
      var $order_column = array(null, "car_reg_number", "category_id", null, null);  

      // variables for captain switching list
        var $table_for_switch = "tbl_car_switch";  
        var $select_column_for_switch = array("id", "car_reg_number", "old_vendor_cnic", "old_vendor_number", "new_vendor_cnic", "new_vendor_number", "car_doc", "created_at", "status", "updated_at");  
        var $order_column_for_switch = array(null, "car_reg_number", "old_vendor_cnic", null, null);
         //  end variables for captain switching list 

        // car inspection table  variables 
        var $table_for_inspection = "tbl_car_inspection";
        var $select_column_for_inspection = array("tbl_car_inspection.id","office_id","car_number","ac","black_mirrors","tyre"," original_number_plates","seats_condition","suspension","music_system","inspection_fees","status","tbl_car_inspection.created_at","tbl_offices.office_name");
        var $order_column_for_inspection = array(null,'office_id',"car_number",null, null);

      // for car data
      function make_query()  
      {  
           $this->db->select($this->select_column);  
           $this->db->from($this->table);
           //$this->db->join('tbl_categories','tbl_categories.id = tbl_cars.category_id');
           $this->db->join('tbl_district','tbl_district.id = tbl_cars.district_id');
           $this->db->join('car_companies','car_companies.id = tbl_cars.car_company_id');
           
           $this->db->join('car_types','car_types.id = tbl_cars.car_type_id');
           $this->db->join('car_model','car_model.id = tbl_cars.car_model_id');
           $this->db->join('car_color','car_color.id = tbl_cars.car_color_id');
          
           
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("car_reg_number", $_POST["search"]["value"]);  
                $this->db->or_like("category_id", $_POST["search"]["value"]);  
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


            //start  car inspection datatable code in saad
        function make_query_for_inspection()  
      {  
           $this->db->select($this->select_column_for_inspection);  
           $this->db->from($this->table_for_inspection);
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
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data_for_inspection(){  
           $this->make_query_for_inspection();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data_for_inspection()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table_for_inspection); 

           return $this->db->count_all_results();  
      }



      // end car inspection datatable


}