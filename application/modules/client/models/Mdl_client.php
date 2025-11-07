<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_client extends CI_Model
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



      




}