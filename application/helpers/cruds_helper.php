<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
$ci =& get_instance();

/*----------------------------------------------------------------------------------------------------
*                                      	CRUD OPERATIONS WAHEED SHAH
-----------------------------------------------------------------------------------------------------*/
define('ENC_KEY', 'T3Encr3p71onK3yT3Encr3p71onK3yYT');

if ( ! function_exists('encode_id')) :
function encode_id($value){ 
		$skey 	= ENC_KEY; //"T3Encr3p71onK3y";
	    if(!$value){return false;}
        $text = $value;
		$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
		$iv = openssl_random_pseudo_bytes($ivlen);
		$ciphertext_raw = openssl_encrypt($text, $cipher, $skey, $options=OPENSSL_RAW_DATA, $iv);
		$hmac = hash_hmac('sha256', $ciphertext_raw, $skey, $as_binary=true);
		$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
		// $encode_value = urlencode($ciphertext);
		$encode_value =str_replace("/", "9090909090", $ciphertext);
        return trim($encode_value); 
    }
endif;		
if ( ! function_exists('decode_id')) :
function decode_id($value){
		$skey 	= ENC_KEY; //"T3Encr3p71onK3y";
        if(!$value){return false;}
      	$encode_value =str_replace("9090909090", "/", $value);
	    $c = base64_decode($encode_value);
		$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
		$iv = substr($c, 0, $ivlen);
		$hmac = substr($c, $ivlen, $sha2len=32);
		$ciphertext_raw = substr($c, $ivlen+$sha2len);
		$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $skey, $options=OPENSSL_RAW_DATA, $iv);
		$calcmac = hash_hmac('sha256', $ciphertext_raw, $skey, $as_binary=true);
		if (hash_equals($hmac, $calcmac))// timing attack safe comparison
		{
		    return $original_plaintext."\n";
		}
    }
endif;
if ( ! function_exists('safe_b64_encode_id')) :
function safe_b64_encode_id($string) {
	
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }	
endif;	
if ( ! function_exists('safe_b64_decode_id')) :
function safe_b64_decode_id($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }	
endif; 


if ( ! function_exists('save_data')) :
	function save_data($table,$data)
	{
		$ci =& get_instance();
		$ci->db->insert($table, $data); 
		return $ci->db->insert_id();
	} 
endif;

if ( ! function_exists('save_bulk_data')) :
function save_bulk_data($table, $data)
  {
		$ci =& get_instance();
		$ci->db->insert_batch($table, $data);
		return $ci->db->insert_id();
  }
endif;

if ( ! function_exists('update_data')) :
	function update_data($table,$data,$id)
	{
		$ci =& get_instance();
		$ci->db->where('id', $id);
		$ci->db->update($table, $data); 
		return true;
	} 
endif;
if ( ! function_exists('update_data_by_where')) :
	function update_data_by_where($table,$data,$where)
	{
		$ci =& get_instance();
		$ci->db->where($where);	
		$ci->db->update($table, $data); 
	} 
endif;

if ( ! function_exists('delete_data')) :
function delete_data($table, $id)
	{
		# code...
		$ci =& get_instance();
		$ci->db->where('id', $id);
		$ci->db->delete($table);
	}
endif;	

if ( ! function_exists('delete_data_by_where')) :
function delete_data_by_where($table, $where)
	{
		# code...
		$ci =& get_instance();
		$ci->db->where($where);	
		$ci->db->delete($table);
	}
endif;	

if ( ! function_exists('execute_query')) :
function execute_query($sql_query)
	{
		# code...
		$ci =& get_instance();
		$ci->db->query($sql_query);
		return true;
		
	}
endif;

if ( ! function_exists('get_query_data')) :
function get_query_data($sql_query)
	{
		# code...
		$ci =& get_instance();
		$data = $ci->db->query($sql_query);
		return $data->result();
		
	}
endif;




if ( ! function_exists('get_query_data_array')) :
function get_query_data_array($sql_query)
	{
		# code...
		$ci =& get_instance();
		$ci->db->query('SET SESSION group_concat_max_len = 1000000');
		$data = $ci->db->query($sql_query);
		return $data->result_array();
		
	}
endif;
if ( ! function_exists('select_dataaa')) :
function select_dataaa($index_column, $query){
        $ci =& get_instance();
        $sql_query = "SELECT $index_column  FROM $query ";  
        $query = $ci->db->query($sql_query);                     
        $result = $query->row();
        return $query->result(); 
    }
endif;

if ( ! function_exists('get_total')) :
function get_total($index_column, $table, $where=''){
		if(!empty($where)){
			$where_clause = " WHERE $where";
		}else{
			$where_clause = "";
		}
		$ci =& get_instance();
	    $sql_query = "SELECT COUNT($index_column) AS cnt FROM $table  $where_clause";	
	    $query = $ci->db->query($sql_query);					 
		$result = $query->row();
		return $result->cnt; 
	}
endif;

if ( ! function_exists('get_total_using_query')) :
function get_total_using_query($index_column, $query){
		$ci =& get_instance();
	    $sql_query = "SELECT COUNT($index_column) AS cnt FROM $query";	
	    $query = $ci->db->query($sql_query);					 
		$result = $query->row();
		return $result->cnt; 
	}
endif;


if ( ! function_exists('get_sum')) :
function get_sum($index_colum, $table, $where=''){
		if(!empty($where)){
			$where_clause = " WHERE $where";
		}else{
			$where_clause = "";
		}
		$ci =& get_instance();
	    $sql_query = "SELECT SUM($index_colum) AS cnt FROM $table  $where_clause";	
	    $query = $ci->db->query($sql_query);					 
		$result = $query->row();
		return $result->cnt; 
	}
endif;

if ( ! function_exists('get_average')) :
function get_average($index_colum, $table, $where=''){
		if(!empty($where)){
			$where_clause = " WHERE $where";
		}else{
			$where_clause = "";
		}
		$ci =& get_instance();
	    $sql_query = "SELECT AVG($index_colum) AS cnt FROM $table  $where_clause";	
	    $query = $ci->db->query($sql_query);					 
		$result = $query->row();
		return $result->cnt; 
	}
endif;

if ( ! function_exists('select_data')) :
	function select_data($table, $where,$order='')
	{
		$ci =& get_instance();
		$ci->db->select('*');
		$ci->db->from($table);
		$ci->db->where($where);
		if( !empty($order) && isset($order) ):
		      $ci->db->order_by($order);
		endif;
		$query = $ci->db->get();
		return $query->result();
	} 
endif;

if ( ! function_exists('select_columns')) :
function select_columns($colulmns,$table, $where,$order='')
      {
	      	$ci =& get_instance();
	      	$ci->db->select($colulmns);
			$ci->db->from($table);
			$ci->db->where($where);
			if( !empty($order) && isset($order) ):
		      $ci->db->order_by($order);
		    endif;
			$query = $ci->db->get();
			return $query->result();
      }
endif;

if ( ! function_exists('select_columns_array')) :
function select_columns_array($colulmns,$table, $where,$order='')
      {
	      	$ci =& get_instance();
	      	$ci->db->select($colulmns);
			$ci->db->from($table);
			$ci->db->where($where);
			if( !empty($order) && isset($order) ):
		      $ci->db->order_by($order);
		    endif;
			$query = $ci->db->get();
			return $query->result_array();
      }
endif;
                //////////////////////////////helper/////////////////////////

if ( ! function_exists('select_data_group')) :
function select_data_group($index_column, $query, $group){
        $ci =& get_instance();
        $sql_query = "SELECT $index_column AS center FROM $query $group";   
       
        $data = $ci->db->query($sql_query);
		return $data->result();
        // return $result->center; 
    }
endif;




if ( ! function_exists('select_column_name')) :
 function select_column_name($col,$table,$id){
	        $ci =& get_instance();
            $ci->db->select($col);
		    $ci->db->from($table);
			$ci->db->where('id', $id);
	return	$get_col =  $ci->db->get()->row()->$col;	
}
endif;

if ( ! function_exists('select_column_name_by_where')) :
 function select_column_name_by_where($col,$table,$where){
	        $ci =& get_instance();
            $ci->db->select($col);
		    $ci->db->from($table);
			$ci->db->where($where);
	return	$get_col =  $ci->db->get()->row()->$col;	
}
endif;

// if ( ! function_exists('send_email')) :
//  function send_email($to_email, $subject, $message, $type='', $attachment='',$cc_to=''){
// 	   if(!empty($type) && isset($type)){
// 		   $mail_type = $type;
// 	   }else{
// 		  $mail_type = 'html';   
// 	   }
// 		$config['protocol'] = 'sendmail';
// 		$config['mailpath'] = '/usr/sbin/sendmail';
// 		$config['charset'] = 'utf-8';
// 		$config['wordwrap'] = TRUE;
// 		$config['mailtype'] = $mail_type;
// 		$ci =& get_instance();
// 		$ci->load->library('email');
// 		$ci->email->initialize($config);
// 		$ci->email->from(SITE_EMAIL, SITE_NAME);
// 		$ci->email->to($to_email);
// 		if(!empty($cc_to) && isset($cc_to)){
// 			$ci->email->cc($to_email);
// 		}
// 		$ci->email->subject($subject);
// 		$ci->email->message($message);
// 		if(!empty($attachment) && isset($attachment)){
// 			$ci->email->attach($attachment);

// 		}
// 		$ci->email->send();
// 		return true;
// 	}
// endif;

if ( ! function_exists('send_email')) :
 function send_email($to_email, $subject, $message, $type='', $attachment='',$cc_to){
	   if(!empty($type) && isset($type)){
		   $mail_type = $type;
	   }else{
		  $mail_type = 'html';   
	   }
		   $config = Array(
		    'protocol'  => 'smtp',
		    'smtp_host' => 'mail.leadvines.com',
		    'smtp_port' => 587,
			'smtp_user' => 'noreply@leadvines.com', // change it to yours
			'smtp_pass' => 'FCpk?o%)y3?t', // change it to yours
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
	);
		$ci =& get_instance();
		$ci->load->library('email', $config);
		$ci->email->set_newline("\r\n");
		// Set to, from, message, etc.
        $ci->email->from('noreply@leadvines.com', 'FSC DEBT');
 		$ci->email->to($to_email);
 		$ci->email->subject($subject);
 		$ci->email->message($message);
		if(!empty($cc_to) && isset($cc_to)){
			$ci->email->cc($cc_to);
		}
		if(!empty($attachment) && isset($attachment)){
			$ci->email->attach($attachment);

		}
		$ci->email->send();
		echo $ci->email->print_debugger();
		return true;
	}
endif;

if ( ! function_exists('get_lat_lng')) :
function get_lat_lng($location){
	   $formattedAddrFrom = str_replace(' ','+',$location);
	   $geocode_location=  file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false');
	   $output_location = json_decode($geocode_location);
	   $lat = $output_location->results[0]->geometry->location->lat;
	   $lng = $output_location->results[0]->geometry->location->lng;  
	   return array('loc_lat' => $lat, 'loc_lng' => $lng);
  }
endif;

if ( ! function_exists('meridian_time')) :
function meridian_time($datetime){
	   return date('j F Y - H:i', strtotime($datetime));
  }
endif;

if ( ! function_exists('hr_datetime')) :
function hr_datetime($datetime){
	   
	   return date('d/m/Y g:i a', strtotime($datetime));
  }
endif;

if ( ! function_exists('hr_time')) :
function hr_time($datetime){
	   
	   return date('g:i A', strtotime($datetime));
	  
  }
endif;

if ( ! function_exists('sys_datetime')) :
function sys_datetime($datetime){
	   
	   return date('d/m/Y H:i', strtotime($datetime));
  }
endif;

if ( ! function_exists('datemont_year_time')) :
function datemont_year_time($datetime){
	   return date('d M Y (H:i)', strtotime($datetime));
  }
endif;


if ( ! function_exists('hr_date')) :
function hr_date($date){
	   
	   return date('d/m/Y', strtotime($date));
  }
endif;
if ( ! function_exists('mysql_date')) :
function mysql_date($start_date) {
if( empty($start_date)){
			$start_date = date('Y-m-d');
		}else{
			$date_format = explode('/', $start_date);
			$start_date = $date_format[2].'-'.$date_format[1].'-'.$date_format[0];  
	}
	return $start_date;
 }	
endif;


if ( ! function_exists('get_member_email_template')) :
function get_member_email_template($template_id, $user_id,$password=''){
	   $where = "id=".$user_id." ";
	   $customer_data = select_data('members', $where,'');
	   // Get template data
	   $where_template = " id=".$template_id." ";
	   $template_data = select_data('email_templates', $where_template,'');
	   // Set email body from email template for sending in email
	   $email_subject = $template_data[0]->email_subject;
	   $template_body = $template_data[0]->email_body;
	   $email_message_body = '';
	   $email_message_body = str_replace('$MEMBER_NAME', $customer_data[0]->full_name, $template_body);
	   $email_message_body = str_replace('$MEMBER_LOGIN_ID', $customer_data[0]->login_id, $email_message_body);
	   $email_message_body = str_replace('$MEMBER_LOGIN_PASSWORD', $password , $email_message_body);
	   $email_message_body = str_replace('$MEMBER_EMAIL', $customer_data[0]->email , $email_message_body);
	   $email_message_body = str_replace('SITE_NAME', SITE_NAME , $email_message_body);
	   $email_message_body = str_replace('$MEMBER_LOGIN_LINK', '<a href='.ADMIN_URL.' target="_blank">'.ADMIN_URL.'</a>' , $email_message_body);
	   $message = $email_message_body;
	   send_email($customer_data[0]->email, $customer_data[0]->full_name, $email_subject, $message);
	   
	  
  }
endif;


if ( ! function_exists('get_user_email_template')) :
function get_user_email_template($template_id, $user_id,$password=''){
	   $where = "id=".$user_id." ";
	   $customer_data = select_data('users', $where,'');
	   // Get template data
	   $where_template = " id=".$template_id." ";
	   $template_data = select_data('email_templates', $where_template,'');
	   // Set email body from email template for sending in email
	   $email_subject = $template_data[0]->email_subject;
	   $template_body = $template_data[0]->email_body;
	   $email_message_body = '';
	   $email_message_body = str_replace('$MEMBER_NAME', $customer_data[0]->full_name, $template_body);
	   $email_message_body = str_replace('$MEMBER_LOGIN_ID', $customer_data[0]->login_id, $email_message_body);
	   $email_message_body = str_replace('$MEMBER_LOGIN_PASSWORD', $password , $email_message_body);
	   $email_message_body = str_replace('$MEMBER_EMAIL', $customer_data[0]->email , $email_message_body);
	   $email_message_body = str_replace('SITE_NAME', SITE_NAME , $email_message_body);
	   $email_message_body = str_replace('$MEMBER_LOGIN_LINK', '<a href='.ADMIN_URL.' target="_blank">'.ADMIN_URL.'</a>' , $email_message_body);
	   $message = $email_message_body;
	   send_email($customer_data[0]->email, $customer_data[0]->full_name, $email_subject, $message);
	   
	  
  }
endif;


if ( ! function_exists('get_customer_email_template')) :
function get_customer_email_template($template_id, $user_id,$password=''){
	   $where = "id=".$user_id." ";
	   $customer_data = select_data('customers', $where,'');
	   // Get template data
	   $where_template = " id=".$template_id." ";
	   $template_data = select_data('email_templates', $where_template,'');
	   // Set email body from email template for sending in email
	   $email_subject = $template_data[0]->email_subject;
	   $template_body = $template_data[0]->email_body;
	   $email_message_body = '';
	   $email_message_body = str_replace('$CUSTOMER_NAME', $customer_data[0]->name, $template_body);
	   $email_message_body = str_replace('$CUSTOMER_EMAIL', $customer_data[0]->email, $email_message_body);
	   $email_message_body = str_replace('$CUSTOMER_MOBILE', $customer_data[0]->mobile , $email_message_body);
	   $email_message_body = str_replace('$CUSTOMER_LOGIN_ID', $customer_data[0]->login_id , $email_message_body);
	   $email_message_body = str_replace('$CUSTOMER_LOGIN_PASSWORD', $password , $email_message_body);
	   $email_message_body = str_replace('SITE_NAME', SITE_NAME , $email_message_body);
	  
	   $message = $email_message_body;
	   send_email($customer_data[0]->email, $customer_data[0]->full_name, $email_subject, $message);
	   
	  
  }
endif;


if ( ! function_exists('job_alert_email')) :
function job_alert_email($order_id){
	   $where = "id=".$user_id." ";
	   $customer_data = select_data('users', $where,'');
	   // Get template data
	   $template_id = 11;
	   $where_template = " id=".$template_id." ";
	   $template_data = select_data('email_templates', $where_template,'');
	   // Set email body from email template for sending in email
	   $email_subject = $template_data[0]->email_subject;
	   $template_body = $template_data[0]->email_body;
	   $email_message_body = '';
	   $email_message_body = str_replace('$MEMBER_NAME', $customer_data[0]->full_name, $template_body);
	   $email_message_body = str_replace('$MEMBER_LOGIN_ID', $customer_data[0]->login_id, $email_message_body);
	   $email_message_body = str_replace('$MEMBER_LOGIN_PASSWORD', $password , $email_message_body);
	   $email_message_body = str_replace('$MEMBER_EMAIL', $customer_data[0]->email , $email_message_body);
	   $email_message_body = str_replace('SITE_NAME', SITE_NAME , $email_message_body);
	   $email_message_body = str_replace('$MEMBER_LOGIN_LINK', '<a href='.ADMIN_URL.' target="_blank">'.ADMIN_URL.'</a>' , $email_message_body);
	   $message = $email_message_body;
	   send_email($customer_data[0]->email, $customer_data[0]->full_name, $email_subject, $message);
	   
	  
  }
endif;

if ( ! function_exists('with_selected_options')) :
function with_selected_options($array = array(),$check_box_class, $table_name,$datatable_id){
	
	 $option  = '<input type="hidden" name="check_box_class" id="check_box_class" value="'.$check_box_class.'"  />';
	 $option .= '<input type="hidden" name="table_name" id="table_name" value="'.$table_name.'"  />';
	 $option .= '<select class="bs-select form-control drop_down_options" name="selected_fields_edit" onchange="edit_selected_rows_fields((this.value))"  id="selected_fields_edit">';
	 $option .= '<option value="">Select Option</option>';
	 foreach($array as $arr){
		 $option .= '<option value="'.str_replace(' ', '_',strtolower($arr)).'">'.$arr.'</option>';
	 }
	 $option .= '</select>';
	 return $option;
  }
endif;


if ( ! function_exists('get_segment')) :
function get_segment($number)
      {
	      	$ci =& get_instance();
	      	return $ci->uri->segment($number);
      }
endif;

if ( ! function_exists('format_money')) :
function format_money($n) {
        $n = (0+str_replace(",","",$n));
        // is this a number?
        if(!is_numeric($n)) return false;
        // now filter it;
        return STORE_CURRENCY.number_format($n,2);
 }	
endif;

if ( ! function_exists('get_stars')) :
function get_stars($number)
      {
	      	$stars = '';
	      switch($number){
			  case 1:
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
			   $stars .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
			   $stars .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
			   $stars .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
			  break;
			  case 2:
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
			   $stars .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
			   $stars .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
			  break;
			  case 3:
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
			   $stars .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
			  break;
			  case 4:
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
			  break;
			  case 5:
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			   $stars .= '<i class="fa fa-star" aria-hidden="true" style="color:yellow"></i>';
			  break;
		  }
		  return $stars;
      }
endif;

if(!function_exists('one_time_bulk_invoice') ):
	function one_time_bulk_invoice($condo_id){
		$ci =& get_instance();
		// Get all units of this condo
		$sql = "SELECT U.name AS unit_name FROM units AS U WHERE U.condo_id=".$condo_id." ";
		$query = $ci->db->query($sql);
		$filename = "e-Pay_Templates_ot.xlsx"; // File Name
		// Download file
		/*
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");*/
		header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
		foreach($query->result() as $row):
		   
		endforeach;
	}
endif;
	


	function fetch_array($query){
	return mysqli_fetch_array($query);
}

// Return result row as an object
function fetch_object($query){
	return mysqli_fetch_object($query);
}

// Return table data as row
function fetch_row($query){
	return mysql_fetch_row($query);
}

// Return table data as object
function fetch_assoc($query){
	return mysqli_fetch_assoc($query);
}

// Return number of rows
function num_rows($query){
	return mysqli_num_rows($query);
}


// Return single row as an associative array
function get_single_row($table, $where){
    $mysqli_obj = connect_db();
	$tbl_data = $mysqli_obj->query("SELECT * FROM $table WHERE $where");
	if(num_rows($tbl_data) > 0){
		$row = fetch_assoc($tbl_data);
		$array[] = $row;
	   return $array[0];
	}else{
	  return false;	
	}
}

// Return single row as an associative array using single sql query
// function get_query_data($sql){
//     $mysqli_obj = connect_db();
//    $tbl_data = $mysqli_obj->query($sql);
//    if(num_rows($tbl_data) > 0){
// 	   $row = fetch_assoc($tbl_data);
// 	   $array[] = $row;
// 	   return $array[0];
//    }else{
// 	 return false;   
//    }
// }

// // Return multiple rows as an associative array
// function get_table_rows($table, $where){
//     $mysqli_obj = connect_db();
// 	$tbl_data = $mysqli_obj->query("SELECT * FROM $table WHERE $where");
// 	if(num_rows($tbl_data) > 0){
// 		while($row = fetch_assoc($tbl_data)){
// 		  $array[] = $row;
// 		}
// 		return $array[0];
// 	}else{
// 		return false;	
// 	}
// }

// function get_table_data($table, $where,$order=null)
// {
	
// 	$tbl_data = $mysqli_obj->query("SELECT * FROM $table WHERE $where $order_clause");
// 	if(num_rows($tbl_data) > 0){
// 		while($row = fetch_object($tbl_data)){
// 		  $array[] = $row;
// 		}
// 		return $array;
// 	}else{
// 	   return false;	
// 	}
	
	
// }




// // Return multiple column rows as an associative array
// function get_columns($columns, $table, $where){
//     $mysqli_obj = connect_db();
//     $tbl_data = $mysqli_obj->query("SELECT $columns FROM $table WHERE $where");
// 	if(num_rows($tbl_data) > 0){
// 		while($row = fetch_array($tbl_data)){
// 		  $array[] = $row;
// 		}
// 	  return $array[0];
// 	}else{
// 	  return false;	
// 	}
// }

// function select_columns($columns, $table, $where, $order=''){
//     $mysqli_obj = connect_db();
// 	if($order != ''){
// 	    $order_by = "ORDER BY $order";	
// 	}else{
// 		 $order_by = "";
// 	}
//     $tbl_data = $mysqli_obj->query("SELECT $columns FROM $table WHERE $where $order_by");
// 	if(num_rows($tbl_data) > 0){
// 		while($row = fetch_array($tbl_data)){
// 		  $array[] = $row;
// 		}
// 	  return $array[0];
// 	}else{
// 	  return false;	
// 	}
// }


// function get_table_columns($columns,$table, $where)
// {
// 	      	 $mysqli_obj = connect_db();
// 			 //echo "SELECT $columns FROM $table WHERE $where<br>";
// 			  $tbl_data = $mysqli_obj->query("SELECT $columns FROM $table WHERE $where");
// 			  if(num_rows($tbl_data) > 0){
// 					while($row = fetch_assoc($tbl_data)){
// 					  $array[] = $row;
// 					}
// 				  return $array[0];
// 			  }else{
// 				 return false;  
// 			  }
// }

// // Return single column as an associative array
// function get_single_column($column,$table, $where){
// 	$mysqli_obj = connect_db();
// 	$tbl_data = $mysqli_obj->query("SELECT $column FROM $table WHERE $where");
// 	if(num_rows($tbl_data) > 0){
// 		$row = fetch_assoc($tbl_data);	
// 		$array[] = $row;
// 		return $array[0];
// 	}else{
// 	  return false;	
// 	}

// }

// // Return 1 if data exists
// function check_single_column($column,$table, $where){
//   $mysqli_obj = connect_db();
//   $tbl_data = $mysqli_obj->query("SELECT $column FROM $table WHERE $where");
//   if(num_rows($tbl_data) > 0){
//     return 1;
//   }else{
//     return 0;
//   }  


// }



// // Save Table Data
// function save_data($table,$array){
// 	$db = connect_db();
//     $sql = 'INSERT INTO '.$table.' SET ';
// 	  $sep = '';
// 	  foreach($array as $key=>$value) {
// 		$sql .= $sep.$key." = '".trim(real_escape_string($value))."'";
// 		$sep = ',';
// 	}
// 	$sql_query = $sql;
// 	//echo $sql_query;
// 	$data = $db->query("$sql_query");
//     return mysqli_insert_id($db);
// }


// // Update Table Data
// function update_data($table,$array,$id){
// 	$db = connect_db();
//     $sql = 'UPDATE '.$table.' SET ';
// 	  $sep = '';
// 	  foreach($array as $key=>$value) {
// 		$sql .= $sep.$key." = '".trim(real_escape_string($value))."'";
// 		$sep = ',';
// 	}
// 	$sql .= " WHERE `id` = ".$id."";
// 	execute_query($sql);
// }

// // Update Table Data using where
// function update_data_with_where($table,$array,$where){
// 	$db = connect_db();
//     $sql = 'UPDATE '.$table.' SET ';
// 	  $sep = '';
// 	  foreach($array as $key=>$value) {
// 		$sql .= $sep.$key." = '".trim(real_escape_string($value))."'";
// 		$sep = ',';
// 	}
// 	$sql .= " WHERE ".$where." ";
	
// 	execute_query($sql);
// }

// // Display column directly
// function display($column, $table, $where){
//   $db = connect_db();
//   $tbl_data = $db->query("SELECT $column FROM $table WHERE $where");
//   if(num_rows($tbl_data) > 0){
// 	  $row = fetch_assoc($tbl_data);
// 	  return $row[$column];
//   }else{
// 	return false;  
//   }
// }




// // Delete Data
// function delete_data($table, $where){
//     $db = connect_db();
//     $delete_data = $db->query("DELETE FROM $table WHERE $where");
// }


// // Function to execute query
// function execute_query_and_get_id($sql){
//     $mysqli_obj = connect_db();
//     $data = $mysqli_obj->query("$sql");
//     return mysqli_insert_id($mysqli_obj);
// }

// // run the query 
// function execute_query($sql){
//     $mysqli_obj = connect_db();
//     $data = $mysqli_obj->query("$sql");
//     return $data;
// }






// // Find total number of records in a table
// function find_total($table, $where){
// 	$mysqli_boject = connect_db();
// 	$query_data = $mysqli_boject->query("SELECT COUNT(*) AS num FROM $table WHERE $where");
//     $total_records = fetch_assoc($query_data);
//     return $total_records['num'];
// }


// if ( ! function_exists('get_total')) :
// function get_total($index_column, $table, $where=''){
// 		if(!empty($where)){
// 			$where_clause = " WHERE $where";
// 		}else{
// 			$where_clause = "";
// 		}
// 		$mysqli_boject = connect_db();
// 	    $query_data = "SELECT COUNT($index_column) AS num FROM $table  $where_clause";	
// 	    $query = $mysqli_boject->query($query_data);					 
// 		$total_records = fetch_assoc($query);
// 		return $total_records['num'];
// 	}
// endif;


// // Find total number of records in a table
// function find_sum($column,$table, $where){
//   $mysqli_boject = connect_db();
//   $query_data = $mysqli_boject->query("SELECT SUM($column) AS num FROM $table WHERE $where");
//    $total_records = fetch_assoc($query_data);
//    return $total_records['num'];
// }

// function real_escape_string($string){
//   $con = connect_db();
//   return mysqli_real_escape_string($con, $string);
// }


// // New Functions
// if ( ! function_exists('select_column_name')) :
//  function select_column_name($col,$table,$id){
// 	  $db = connect_db();
// 	  $query = $db->query("SELECT $col FROM $table WHERE id=".$id." ");
// 	  if(num_rows($query) > 0){
// 		  $row = fetch_assoc($query);
// 		  return $row[$col];
// 	  }else{
// 		return false;  
// 	  }
// }
// endif;

// if ( ! function_exists('select_column_name_by_where')) :
//  function select_column_name_by_where($col,$table,$where){
// 	       $db = connect_db();
// 		  $query = $db->query("SELECT $col FROM $table WHERE $where ");
// 		  if(num_rows($query) > 0){
// 			  $row = fetch_assoc($query);
// 			  return $row[$col];
// 		  }else{
// 			return false;  
// 		  }	
// }
// endif;


// messages helper data start



function if_empty($input){
  return (empty($input) || !isset($input) || is_null($input)	);
}





function e_response($message){
  return  json_encode(array('status' => 'failed',
			                 'errorCode' => 1,
							 'message' => $message));	
}

function key_response($message){
  return  json_encode(array('status' => 'failed',
			                 'errorCode' => 2,
							 'message' => $message));	
}

function s_response($message,$data, $array=''){
	     
  return  json_encode(array('status' => 'success',
                             'errorCode' => 0,
                             'message' => $message,
			                 'data' => $data));	
}

function s_response_2($message){
  return  json_encode(array('status' => 'success',
                             'errorCode' => 0,
                             'message' => $message));	
}
function s_ex_response($message,$data, $array=array()){
	     
    $resp = array('status' => 'success',
                             'errorCode' => 0,
                             'message' => $message,
			                 'data' => $data);
	$extra_array = array($array);
	$merged_array = array_merge($resp, $extra_array);
	$sliced = array_splice($merged_array);
	return  json_encode($sliced);						 	
}

/* API key encryption */
function apiKey()
{
   return md5(get_random_string(16));
}


function get_id($id){
  return intval($id);	
}

function empty_vars(){
  $missing = array();
 foreach ($_REQUEST as $key => $value) { 
   if ($value == "") { 
     array_push($missing, $key);
   }
 }
 if (count($missing) > 0) {
	 show_empty_vars($missing);
	 return true;
 }else{
	return false; 
 }
 
}

function show_empty_vars($missing){
  if (count($missing) > 0) {
  foreach ($missing as $k => $v) { 
     echo $v."<br> ";
  }
  }
}


function post($posted_value){
  return $_REQUEST[$posted_value];	
}

function get($posted_value){
  return $_GET[$posted_value];	
}

function req($posted_value){
  return $_REQUEST[$posted_value];	
}

function dd($array){
  echo '<pre>';
  print_r($array);
  echo '</pre>';	
}



?>