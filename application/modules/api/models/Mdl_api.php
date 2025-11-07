<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_api extends CI_Model
{



function __construct() {
parent::__construct();
}	
		var $table = "contactus";  
    	var $select_column = array("contactus.id", "first_name", "last_name", "email", "subject", "message", "created_at");  
      	var $order_column = array(null, "contactus.id", "first_name", null, null); 

      	
      // user Table code
        var $user_table = "user";  
        var $user_select_column = array("user.id", "username", "user.email", "user.user_type", "user.status", "user.created_at");  
        var $user_order_column = array(null, "user.id", "username", null, null); 




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


      




}