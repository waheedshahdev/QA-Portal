<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_admin extends CI_Model
{



function __construct() {
parent::__construct();
}	


      	
      // user Table code
        var $user_table = "user";  
        var $user_select_column = array("user.id", "username", "user.email", "user.user_type", "user.status", "user.created_at");  
        var $user_order_column = array(null, "user.id", "username", null, null); 

        var $zips_table = "tbl_zip";  
        var $zips_select_column = array("COUNT(zip) as total_zips", "time_zone", "file_name", "tbl_zip.client");  
        var $zips_order_column = array(null, "tbl_zip.id", " U.created_at", null, null); 




public function validate_credentials($email, $password){
        $sql = "SELECT * FROM tbl_users WHERE email='".$email."' AND password='".md5($password)."' AND status = 'Active'";
          if($query=$this->db->query($sql))
          {
              return $query->row_array();
          }
          else{
            return false;
          }
    
    }

    // contact list 
    function make_query()  
      {  
           $this->db->select($this->select_column);  
           $this->db->from($this->table);
          
           
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("first_name", $_POST["search"]["value"]);  
                $this->db->or_like("email", $_POST["search"]["value"]);  
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

      // end contact list 




      // user list
       function user_make_query()  
      {  
           $this->db->select($this->user_select_column);  
           $this->db->from('user');
          
           if(isset($_POST["search"]["value"]))  
           {   
                $this->db->like("username", $_POST["search"]["value"]);  
                $this->db->or_like("user.email", $_POST["search"]["value"]);  
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
      function user_make_datatables(){  
           $this->user_make_query();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function user_get_filtered_data(){  
           $this->user_make_query();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function user_get_all_data()  
      {  
           $this->db->select("*");  
           $this->db->from($this->user_table); 
            return $this->db->count_all_results(); 

      }

      // end user list


            // Zips file
       function zips_make_query()  
      {  
           $this->db->select($this->zips_select_column);  
           $this->db->from('tbl_zip');
           $this->db->join('tbl_file_data as S','S.zip_code = tbl_zip.zip');
           $this->db->join('tbl_uploaded_files as U','U.id = S.uploaded_file_id');
           $this->db->where('date(S.created_at) between "2022-05-01" and CURDATE()');
           $this->db->group_by('file_name,time_zone'); 
           if(isset($_POST["search"]["value"]))  
           {   
                $this->db->like("client", $_POST["search"]["value"]);  
                $this->db->or_like("file_name", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('U.id', 'DESC');  
           }  
      }  
      function zips_make_datatables(){  
           $this->zips_make_query();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function zips_get_filtered_data(){  
           $this->zips_make_query();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function zips_get_all_data()  
      {  
           $this->db->select("*");  
           $this->db->from($this->zips_table); 
            return $this->db->count_all_results(); 

      }

      // end Zips file


      




}