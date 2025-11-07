<?php
class Admin extends MX_Controller 
{

function __construct() {
parent::__construct();

$this->load->model('mdl_admin');

$allowed_ips = $this->db->get('ip_access')->result_array();
        $current_ip = $this->input->ip_address();

        if (!$this->isIpAllowed($current_ip, $allowed_ips)) {
            // Set HTTP response code to 403 Forbidden
            http_response_code(403);

            // Display a simple text message
            echo "Access Forbidden\nYour IP Address is not allowed to access this site.";

            // Terminate further execution
            exit();
        }

}

private function isIpAllowed($ip, $allowed_ips) {
        foreach ($allowed_ips as $allowed_ip) {
            if ($allowed_ip['ip_address'] === $ip) {
                return true;
            }
        }
        return false;
    }

    public function image_config($path_name)
    {
        $path ='./'.$path_name.'/';
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|jpeg|png|mov|mpeg|zip|mp3|wav|m4a|ogg';
        $config['max_size']             = 555550000000;
        $config['max_width']            = 555550000000;
        $config['max_height']           = 555550000000;
        $config['encrypt_name']         = true;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
    }

public function index()
{
    $user_type = $this->session->userdata('user_type_a1d_qa');
    if($user_type == 'Administrator' || $user_type == 'LMS Manager')
    {


    // $data['agent_status'] = get_query_data('SELECT *
    //                                         FROM tbl_users where user_type = "CSR"
                                               
    //                                             ');
    $data['title'] = "Dashboard";
    $data['view_module'] = "admin";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->admin($data);

    }
    elseif ($user_type == '') {
        redirect('admin/login');
    }
    elseif ($user_type != 'Administrator' || $user_type != 'LMS Manager') {
        redirect('admin/page_not_found');
    }
}

public function page_not_found()
{

    $data['title'] = "404";
    $data['view_module'] = "admin";
    $data['view_files'] = "page_not_found";
    $this->load->module("templates");
    $this->templates->admin($data);

}


public function login()
{


    $this->load->view('admin/login');

}

public function check_auth()
{
    if($this->session->userdata('user_type') !='')
    {
        $user_type = $this->session->userdata('user_type_a1d_qa');
            if ($user_type == 'CSR') {
               $this->session->set_flashdata('error_msg', 'You Are already Logged In.');
               redirect('admin/agent_list','refresh'); 
               // $this->load->view('admin/user_dashbaord');
            }
            elseif ($user_type == 'HR' || $user_type == 'Administrator'){
               $this->session->set_flashdata('error_msg', 'You Are already Logged In.');
               redirect('admin','refresh'); 
            }
            elseif ($user_type == 'LMS Manager' || $user_type == 'LMS TeamLead') {
               redirect('admin','lead_list'); 
            }
            elseif ($user_type == 'Broker') {
                redirect('admin/leads','refresh'); 
            }

    }
//echo "access_level";exit();

    $submit = $this->input->post('submit');
    if($submit == 'Log In')
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if($email=="" || $password=="" ){   
            $this->session->set_flashdata('error_msg', 'Username or Password is empty. Please try again!');
            redirect(base_url().'admin/login');    
        }
        
        $user_login = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        $this->load->model('mdl_admin');
        $data = $this->mdl_admin->validate_credentials($user_login['email'],$user_login['password']);

        if($data)
        {

            $this->session->set_userdata('id',$data['id']);
            $this->session->set_userdata('ein',$data['ein']);
            $this->session->set_userdata('email',$data['email']);
            $this->session->set_userdata('username',$data['username']);
            $this->session->set_userdata('access_level_1',$data['access_level']);
            $this->session->set_userdata('user_type_a1d_qa',$data['user_type']);
            $this->session->set_userdata('lo_name',$data['lo_name']);
            $this->session->set_userdata('center',$data['center']);
             //redirect('admin','refresh');
            // $this->load->view('admin/user_dashbaord');
            // echo ' i m here';
            $user_type = $this->session->userdata('user_type_a1d_qa');
            $access_level = $this->session->userdata('access_level_1');

            if ($user_type == 'CSR') {
               redirect('admin/agent_list','refresh'); 
               // $this->load->view('admin/user_dashbaord');
            }
            // elseif ($user_type == 'Software Manager' || $user_type == 'CEO' || $user_type == 'Administrator'){
            //    redirect('admin','refresh'); 
            // }
            elseif ($user_type == 'HR' || $user_type == 'Administrator'){
               redirect('admin','refresh'); 
            }
            elseif ($user_type == 'LMS Manager' || $user_type == 'LMS TeamLead'){
               redirect('admin/lead_list','refresh'); 
            }
            elseif ($access_level == 'Client' || $access_level == 'AE')  {

                redirect('client/qa_reports','refresh'); 
            }
            elseif ($user_type == 'Broker') {
                redirect('admin/leads','refresh'); 
            }
            elseif ($user_type == 'QA Evaluator') {
            $this->session->set_flashdata('error_msg', 'You Are already Logged In.');
               redirect('admin/qa_list','refresh'); 
            }
             elseif ($user_type == 'QA Manager') {
            $this->session->set_flashdata('error_msg', 'You Are already Logged In.');
               redirect('admin/qa_list','refresh'); 
            }

            

        }
        else
        {
            $this->session->set_flashdata('error_msg', 'You are Not Authorized Person, Contact to Administrator.');
            redirect('admin/login');
        }   
    }
    else{
        redirect('admin/login');
    }
}

public function logout()
{

$this->session->unset_userdata('user_type_a1d_qa');
$this->session->unset_userdata('access_level_1');
$this->session->unset_userdata('username');
$this->session->unset_userdata('ein');
$this->session->unset_userdata('id');
      redirect('admin/login', 'refresh');
}

////////////// Administrator Dashboard ////////////////////////

public function user_dashbaord()
{
    $user_type = $this->session->userdata('user_type_a1d_qa');
    if($user_type == 'Administrator')
    {
        $ein = $this->session->userdata('ein');
   
    $data['title'] = "User Dashboard";
    $data['view_module'] = "admin";
    $data['view_files'] = "user_dashboard";
    $this->load->module("templates");
    $this->templates->admin($data);

     }
    elseif ($user_type == '') {
        redirect('admin/login');
    }
    elseif ($user_type != 'Administrator') {
        redirect('admin/page_not_found');
    }
}

////////////// End Administrator Dashboard ////////////////////

public function ip_whitelist()
    {
          $user_type = $this->session->userdata('user_type_a1d_qa');
    if ($user_type == '') {
        redirect('admin/login');
    }
    elseif($user_type != 'Administrator' )
    {
        redirect('admin/page_not_found');
    }
        $submit = $this->input->post('submit');
        $ip_name = $this->input->post('ip_name');
        $ip_address = $this->input->post('ip_address');
        $ein = $this->session->userdata('ein');
        
        
            
          
        if($submit == 'Submit'){




        $ip_data = array(
                 'ip_name'    => $ip_name,
                'ip_address'    => $ip_address,
                'employee_ein'    => $ein
                
        );

        $result = save_data('ip_access', $ip_data);

            
                
                          


                    if($result)
                    {
                            $this->session->set_flashdata('success', 'IP Address Added Successfully.');
                            redirect('admin/ip_whitelist');
                            
                           
                    }
                    else{
                            
                             $this->session->set_flashdata('error_msg', 'Something went Wrong.');
                            redirect('admin/ip_whitelist');

                    }

          
           

        }


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if($submit == 'Update IP')
        {

          
            $id  = $this->input->post('id');
            $ip_name = $this->input->post('ip_name');
            $ip_address = $this->input->post('ip_address');
            $ein = $this->session->userdata('ein');
            
           
            $updated_ip = array(
              
                 'ip_name'    => $ip_name,
                'ip_address'    => $ip_address,
                'employee_ein'    => $ein
                    
            );


           

             $update_ip =  update_data_by_where('ip_access', $updated_ip, 'id = '.$id.'');

             
         
            


            if ($update_ip) {
               $this->session->set_flashdata('error_msg', 'Sorry! IP is not Updated due to error.');
                redirect('admin/ip_whitelist');
            } 
            else {
                
                 $this->session->set_flashdata('success', 'IP have been Updated!');
                redirect('admin/ip_whitelist');
            }





        }



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       
        

        $data['ip_address'] = get_query_data('SELECT I.*, E.employee_name FROM `ip_access` as I  JOIN employee_data as E on E.ein = I.employee_ein  ORDER BY I.created_at DESC');

        

       // $data = $this->common->evaluated_leads_lib($from_date, $to_date);
        $data['title'] = "IP Whitelist";
        $data['view_module'] = "admin";
        $data['view_files'] = "ip_whitelist";
        $this->load->module("templates");
        $this->templates->admin($data);
    }

    public function fetch_ip()
    {
       
        $id = $this->input->post('id');
        $result = get_query_data('SELECT * FROM ip_access where id = '.$id.'');
        echo json_encode($result);

    } 


    public function delete_ip($ip_id)
{
    $user_type = $this->session->userdata('user_type_a1d_qa');
    if($user_type == 'Administrator')
    {
        $result = delete_data('ip_access', $ip_id);
        if ($result) {
                $this->session->set_flashdata('error_msg', 'Sorry! IP not Deleted due to error.');
                redirect('admin/ip_whitelist');
            } 
            else {
                $this->session->set_flashdata('success', 'IP has been Deleted!');
                redirect('admin/ip_whitelist');
            }

    }  elseif ($user_type == '') 
    {
        redirect('admin/login');
    }
    elseif ($user_type != 'Administrator') {
        redirect('admin/page_not_found');
    }
}




public function getEIN ($cnic) {
    // remove dashes and slice out last 6 characters.
    $ein = substr(str_replace('-', '', $cnic), 7);
    return $ein;
}

public function add_user()
{
    $user_type = $this->session->userdata('user_type_a1d_qa');
    if( $user_type == 'Administrator' || $user_type == 'LMS Manager' || $user_type == 'LMS TeamLead')
    {

        $submit = $this->input->post('submit');

        if($submit == 'Submit'){
            $cnic1 = $this->input->post('cnic');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            if($password != $confirm_password)
            {
                $this->session->set_flashdata('error_msg', 'Sorry! Password Not Matched. Please Try Again.');
                        redirect('admin/users');
            }
            $cnic = $this->getEIN($cnic1);
                $where = 'ein = '.$cnic.'';
                 $check_ein = select_columns('ein','tbl_users', $where);
                
                 if ($cnic == "") {
                     # code...
                    $digits = 8;
                    $cnic = rand(pow(10, $digits-1), pow(10, $digits)-1);
                 }
                 

                 $team_id = $this->input->post('team_lead');
                // echo $team_id;
               //  exit();
                 if ($team_id == "" || $team_id == 0) {
                     $id = $cnic;
                 } else {
                     $id = $team_id;
                 }
                 
                 
                
        $data = array(
            'ein' => $cnic,
            'cnic' => $cnic1,
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => md5($password),
            'access_level' => $this->input->post('access_level'),
            'user_type' => $this->input->post('user_type'),
            'status' => $this->input->post('status'),
            'lo_name' => $this->input->post('lo_name'),
            'center' => $this->input->post('center'),
            'team_id' => $id,
            );

        $employee_data = array(
            'ein' => $cnic,
            'cnic' => $cnic1,
            'employee_name' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'access_level' => $this->input->post('access_level'),
            'user_type' => $this->input->post('user_type'),          
            'lo_name' => $this->input->post('lo_name'),
            'center' => $this->input->post('center'),
            'team_id' => $id,
            );

        // print_r($data);

        if($check_ein[0]->ein == $cnic && $cnic != ''){
                      $this->session->set_flashdata('error_msg', 'Sorry! User Already Exist. Please contact to Administrator.');
                        redirect('admin/users');
                }
                else if($cnic =='' || $cnic != ''){
                    $result = save_data('employee_data', $employee_data);
                    $result = save_data('tbl_users', $data);
                if($result)
                {
                    $this->session->set_flashdata('success', 'User Added Successfully');
                    redirect('admin/users');
                }
                else{
                    $this->session->set_flashdata('error_msg', 'User Not Added Successfully');
                    redirect('admin/users');
                }
                }

        

        }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if($submit == 'Update User')
        {

            $id = $this->input->post('ein');
            
             // print_r($ein);
             // exit();

            $username  = $this->input->post('username');
            $cnic = $this->input->post('cnic');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $access_level  = $this->input->post('access_level');
            $user_type = $this->input->post('user_type');
            $center = $this->input->post('center');
            $agent_status  = $this->input->post('agent_status');
            $status  = $this->input->post('status');
            $lo_name = $this->input->post('lo_name');
            $team_id = $this->input->post('team_lead');
            // echo $user_type;
            // exit();
           $confirm_password = $this->input->post('confirm_password');
           if ($password != "") {
               # code...
             if($password != $confirm_password)
            {
                $this->session->set_flashdata('error_msg', 'Sorry! Password Not Matched. Please Try Again.');
                        redirect('admin/users');
            }
           } 
           
            $client_data = array(
              
                 'username'             => $username,
                 'email'                => $email,
                 'access_level'         => $access_level,
                 'user_type'            => $user_type,
                 'center'               => $center,
                 'agent_status'         => $agent_status,
                 'status'               => $status,
                 'lo_name'              => $lo_name,
                 'team_id'              => $team_id,
                    
            );


            if(!empty($password) || !empty($confirm_password))
            {
                $client_data['password'] = md5($password);
            }

             $update_user =  update_data_by_where('tbl_users', $client_data, 'ein = '.$id.'');

             
             $eemp_data = array(
              
                 'employee_name'     => $this->input->post('username'),
                 'email'                => $email,
                 'access_level'         => $access_level,
                 'user_type'            => $user_type,
                 'center'               => $center,
                 'status'               => $status,
                 'lo_name'              => $lo_name,
                 'team_id'              => $team_id,
                    
            );

              // print_r($eemp_data);
              // echo $ein;
              // exit();



            $update_user =  update_data_by_where('employee_data', $eemp_data, 'ein = '.$id.'');
            


            if ($update_user) {
                $this->session->set_flashdata('success', 'User have been Updated!');
                redirect('admin/users');
            } 
            else {
                $this->session->set_flashdata('error_msg', 'Sorry! User are not Updated due to error.');
                redirect('admin/users');
            }





        }



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    }

    elseif ($user_type == '') {
        redirect('admin/login');
    }
    elseif ($user_type != 'Administrator' || $user_type != 'LMS Manager' || $user_type != 'LMS TeamLead') {
        redirect('admin/page_not_found');
    }

}

public function fetch_user()
    {
       
        $id = $this->input->post('id');
        $result = get_query_data('SELECT * FROM tbl_users where id = '.$id.'');
        echo json_encode($result);

    } 

public function delete_user($user_id)
{
    $user_type = $this->session->userdata('user_type_a1d_qa');
    if($user_type == 'Administrator')
    {
        $result = delete_data('tbl_users', $user_id);
        if ($result) {
                $this->session->set_flashdata('error_msg', 'Sorry! User not Deleted due to error.');
                redirect('admin/users');
            } 
            else {
                $this->session->set_flashdata('success', 'User has been Deleted!');
                redirect('admin/users');
            }

    }  elseif ($user_type == '') 
    {
        redirect('admin/login');
    }
    elseif ($user_type != 'Administrator') {
        redirect('admin/page_not_found');
    }
}

public function users()
{
    $user_type = $this->session->userdata('user_type_a1d_qa');
    if( $user_type == 'Administrator')
    {
    $data['user_data'] = get_query_data('SELECT * FROM tbl_users order by created_at DESC');
    $data['clients'] = get_query_data('SELECT * FROM tbl_clients group by client_name');
    $data['lo'] = get_query_data('SELECT * FROM tbl_clients group by lo');
    //print_r($data['lo']);exit();
    $data['user_team'] = get_query_data('SELECT ein, username FROM tbl_users where user_type = "LMS TeamLead"');
    $data['user_data'] = get_query_data('SELECT * FROM tbl_users order by created_at DESC');
    $data['title'] = 'Users';
    $data['view_module'] = "admin";
    $data['view_files'] = "users";
    $this->load->module("templates");
    $this->templates->admin($data); 
    }

    elseif ($user_type == '') 
    {
        redirect('admin/login');
    }
    elseif ($user_type != 'Administrator') {
        redirect('admin/page_not_found');
    } 
}




public function fetch_client_lo()
{
    $client_name = $this->input->post('client');
// echo $client_name;
// exit();
    $data = get_query_data('SELECT lo FROM tbl_clients WHERE client_name = "'.$client_name.'" order by lo ASC');

   
    if($client_name == 'A1D' || $client_name == 'SNK' || $client_name == 'SNKLT2-B10' || $client_name == 'CR1' || $client_name == 'STR' || $client_name == 'S1D' || $client_name == 'RMD')
    {
        $output      = '<select class="form-control check_lo" name="lo" id="lo" required="required">';
        $output     .= '<option value="">Please Select Lo</option>';
        foreach ($data as $values) {

        $output .= '<option value="'.$values->lo.'">'.$values->lo.'</option>';
        }
        $output     .= '</select>';

        echo $output;
    }

    else{
        $output = '<input type="text" name="lo" class="form-control" data-parsley-group="payment" id="lo" data-parsley-required>';
        echo $output;
    }
    
    // print_r($output);
    // exit();
    
}





public function fetch_lo()
{
    $client = $this->input->post('client');

    // $data = get_query_data("SELECT * FROM tbl_menu_category WHERE type = '".$cat."'");
    $data = get_query_data('SELECT * from tbl_clients where client_name="'.$client.'"');

     foreach ($data as $client) {
            $output .= '<option value="'.$client->id.'">'.$client->lo.'</option>';
        }

 
   // $output = ' <option value="'.$data->id.'"> '.$data->lo.' </option>';

    
    // print_r($output);
    // exit();
    echo $output;
}

///////////// END client Lo ///////////////



































public function download_qa_report()
{

$user_type = $this->session->userdata('user_type_a1d_qa');
    if($user_type == 'Administrator' || $user_type == 'LMS Manager')
    {

        $button = $this->input->post('download');
        if($button == 'Download'){

           $get_query = $this->input->post('get_download_query');
            
            $search_query = decode_id($get_query);
            // echo $search_query;
            // exit();

             $retrive_data = get_query_data($search_query);

             $client_name = $retrive_data[0]->client; 


             $client_data = $data['fetch_client_data'];
             // print_r($retrive_data);
             // exit;
             $this->common->generate_qa_report($retrive_data);

            

             }
         }
        elseif ($user_type == '') 
    {
        redirect('admin/login');
    }
    elseif ($user_type != 'Administrator') 
    {
        redirect('admin/page_not_found');
    }        
}


public function download_qa_leads()
{

$user_type = $this->session->userdata('user_type_a1d_qa');
    if($user_type == 'Administrator' || $user_type == 'LMS Manager')
    {

        $button = $this->input->post('download');
        if($button == 'Download'){

           $get_query = $this->input->post('get_download_query');
           $get_avg_query = $this->input->post('get_download_avg_query');
            
            $search_query = decode_id($get_query);
            $search_avg_query = decode_id($get_avg_query);
            // echo $search_avg_query;
            // exit();

             $retrive_data = get_query_data($search_query);
             $retrive_avg_data = get_query_data($search_avg_query);

             $client_name = $retrive_data[0]->client; 


             $client_data = $data['fetch_client_data'];
             $this->common->generate_qa_sheet($retrive_data,$retrive_avg_data);

             
             }
         }
        elseif ($user_type == '') 
    {
        redirect('admin/login');
    }
    elseif ($user_type != 'Administrator') 
    {
        redirect('admin/page_not_found');
    }        
}



////////// Change Passsowrd ///////////////

public function change_password()
{
    $user_type = $this->session->userdata('user_type_a1d_qa');
    if($user_type == 'Administrator')
    {

        $submit = $this->input->post('submit');
        if($submit == 'Change Password')
        {
            $ein = $this->session->userdata('ein');
            $old_password = md5($this->input->post('old_password'));
            $new_password = md5($this->input->post('new_password'));
            $confirm_password = md5($this->input->post('confirm_password'));
            $where = 'ein = '.$ein.'';
            $get_password = select_columns('password','tbl_users',$where);
            $user_password = $get_password[0]->password;
            if($user_password == $old_password)
            {
                    if($new_password == $confirm_password){
                        $data = array(
                                'password' => $new_password
                        );
                        update_data_by_where('tbl_users',$data,$where);
                        $this->session->set_flashdata('success', 'Password Changed Successfully.');
                        redirect('admin/change_password');
                    }
                    else{
                        $this->session->set_flashdata('error_msg', 'Your New Password is not Matched with Confirm Password. Try Again');
                        redirect('admin/change_password');
                    }
            }
            else{
                $this->session->set_flashdata('error_msg', 'Your Old Password is not Matched. Try Again');
                redirect('admin/change_password');
            }

            // exit();




        }



    $data['title'] = 'Reset Password';
    $data['view_module'] = "admin";
    $data['view_files'] = "change_password";
    $this->load->module("templates");
    $this->templates->admin($data); 
    } 

        elseif ($user_type == '') 
    {
        redirect('admin/login');
    }
    elseif ($user_type != 'Administrator') 
    {
        redirect('admin/page_not_found');
    }
}

////////// END change Password ////////////
////////// Block Employee ////////////////
public function block_employee()
{
    $user_type = $this->session->userdata('user_type_a1d_qa');
    if($user_type == 'Administrator')
    {
    $ein = $this->input->post('ein');

    // $data = get_query_data("SELECT * FROM tbl_menu_category WHERE type = '".$cat."'");
    $data = array(
            'status' => 'Block'
    );
    $where = 'ein = '.$ein.'';
    update_data_by_where('tbl_users',$data, $where);

    echo 'Employee Blocked Successfully';
}
else
{
    echo 'you are not Authorized Person for such Action';
}
}
////////// END Block Employee ////////////

////////// Block Employee ////////////////
public function unblock_employee()
{
    $user_type = $this->session->userdata('user_type_a1d_qa');
    if($user_type == 'Administrator')
    {
    $ein = $this->input->post('ein');

    // $data = get_query_data("SELECT * FROM tbl_menu_category WHERE type = '".$cat."'");
    $data = array(
            'status' => 'Active'
    );
    $where = 'ein = '.$ein.'';
    update_data_by_where('tbl_users',$data, $where);

    echo 'Employee Blocked Successfully';
}
else
{
    echo 'you are not Authorized Person for such Action';
}
}
////////// END Block Employee ////////////



///////////// Fetch Client LO ///////////////



public function fetch_access_level()
{
    $access_level = $this->input->post('access_level');

    // $data = get_query_data("SELECT * FROM tbl_menu_category WHERE type = '".$cat."'");
    

    $output = '<option value="">Please Select User Type</option>';
    if($access_level == ''){
        $output .= '<option value="">Please Select User Type</option>';
    }
    elseif ($access_level == 'Agent') {
        $output .= '<option value="CSR">CSR</option>';
    }
    elseif ($access_level == 'Support') {
        $output .= '<option value="Administrator">Administrator</option>';
        $output .= '<option value="Broker">Broker</option>';
    }

    elseif ($access_level == 'Management') {
        $output .= '<option value="LMS Manager">LMS Manager</option>';
        $output .= '<option value="LMS TeamLead">LMS TeamLead</option>';
        $output .= '<option value="QA Evaluator">QA Evaluator</option>';
        $output .= '<option value="QA Manager">QA Manager</option>';
    }
    elseif ($access_level == 'Client') {
        $data = get_query_data('SELECT client_name FROM tbl_clients GROUP BY client_name order by created_at DESC');
        foreach ($data as $client) {
            $output .= '<option value="'.$client->client_name.'">'.$client->client_name.'</option>';
        }
        
    }    elseif ($access_level == 'AE') {
        $data = get_query_data('SELECT client_name FROM tbl_clients GROUP BY client_name order by created_at DESC');
        foreach ($data as $client) {
            $output .= '<option value="'.$client->client_name.'">'.$client->client_name.'</option>';
        }
        
    }

    // print_r($output);
    // exit();
    echo $output;
}

///////////// END client Lo ///////////////



public function qa_list()
    {
        $user_type       = $this->session->userdata('user_type_a1d_qa');
        $password_change = $this->session->userdata('password_change');
    // echo $password_change;
    // exit();
    if ($password_change == "0" ) {
        redirect('admin/change_password');
    }

    if ($user_type == '') {
        redirect('admin/login');
    }
    elseif($user_type != 'Administrator' && $user_type != 'QA Evaluator' && $user_type != 'QA Manager' && $user_type != 'LMS Manager')
    {
        redirect('admin/page_not_found');
    }
        // $apply = $this->input->post('apply');
        // if ($apply == 'Apply') {
        //     $from_date = $this->input->post('from_date');
        //     $to_date = $this->input->post('to_date');
        // }

        $search     = $this->input->post('search');
        $from_date  = $this->input->post('from_date');
        $to_date1   = $this->input->post('to_date');
        $center     = $this->input->post('center');
        $client     = $this->input->post('client');
        $state      = $this->input->post('state');
        $agents     = $this->input->post('agents');
        if($to_date1 == '')
        {
            $to_date = date('Y-m-d');
        }
        else{
            $to_date = $to_date1;
        }
            $data['agents'] = get_query_data('SELECT * FROM `tbl_users` WHERE status="Active" and user_type="CSR"');
          
        if($search == 'Search'){

            //Returned Code
            if ($agents=='all') {
               $agent_where = '';
            }else{
               $agent_where = "AND D.employee_id='".$agents."'"; 
            }

               if ($state=='all') {
               $state_where = '';
            }else{
               $state_where = "AND S.state='".$state."'"; 
            }  

             if ($center=='all') {
               $center_where = '';
            }else{
               $center_where = "AND U.center='".$center."'"; 
            }
             if ($client=='all') {
               $client_where = '';
            }else{
               $client_where = "AND S.client='".$client."'"; 
            }
            // echo 'SELECT *,D.created_at as creation_date FROM tbl_solar_lead_data as S JOIN tbl_disposition as D on D.id = S.disposition_id JOIN employee_data as U on U.ein = D.employee_id WHERE (D.disposition = "Returned") AND date(D.created_at) Between "'.$from_date.'" AND "'.$to_date.'" AND D.status = 1 '.$agent_where.' '.$state_where.' '.$center_where.' ORDER BY D.created_at DESC';
            // exit();


            $data['fetch_returned_leads'] = get_query_data('SELECT *,D.created_at as creation_date FROM tbl_solar_lead_data as S JOIN tbl_disposition as D on D.id = S.disposition_id JOIN employee_data as U on U.ein = D.employee_id WHERE (D.disposition != "Live Transfer" and D.disposition != "Posted" and D.disposition != "Re Opened") AND Evaluated_Result = "pending" AND  D.status = 1 AND date(D.created_at) Between "'.$from_date.'" AND "'.$to_date.'"  '.$agent_where.' '.$state_where.' '.$center_where.' '.$client_where.' ORDER BY D.created_at DESC ');

            $data['returned_leads_count'] = get_query_data('SELECT count(*) as cnt FROM tbl_solar_lead_data as S JOIN tbl_disposition as D on D.id = S.disposition_id JOIN employee_data as U on U.ein = D.employee_id WHERE (D.disposition != "Live Transfer" and D.disposition != "Posted" and D.disposition != "Re Opened") AND D.status = 1 AND date(D.created_at) Between "'.$from_date.'" AND "'.$to_date.'" '.$agent_where.' '.$state_where.' '.$center_where.' '.$client_where.'');

            $data['fetch_leads']          = get_query_data('SELECT *,D.created_at as creation_date FROM tbl_solar_lead_data as S JOIN tbl_disposition as D on D.id = S.disposition_id JOIN employee_data as U on U.ein = D.employee_id WHERE D.disposition = "Live Transfer" AND evaluated_status = "0" AND  D.status = 1 AND date(D.created_at) Between "'.$from_date.'" AND "'.$to_date.'"  '.$agent_where.' '.$state_where.' '.$center_where.' '.$client_where.' ORDER BY D.created_at DESC ');

            $data['leads_count']          = get_query_data('SELECT count(*) as cnt FROM tbl_solar_lead_data as S JOIN tbl_disposition as D on D.id = S.disposition_id JOIN employee_data as U on U.ein = D.employee_id WHERE D.disposition = "Live Transfer" AND D.status = 1 AND date(D.created_at) Between "'.$from_date.'" AND "'.$to_date.'" '.$agent_where.' '.$state_where.' '.$center_where.' '.$client_where.'');

           

        }
        else{

            $data['fetch_returned_leads'] = get_query_data('SELECT *,D.created_at as creation_date FROM tbl_solar_lead_data as S JOIN tbl_disposition as D on D.id = S.disposition_id JOIN employee_data as U on U.ein = D.employee_id WHERE (D.disposition != "Live Transfer" and D.disposition != "Posted" and D.disposition != "Re Opened") AND Evaluated_Result = "pending" AND  D.status = 1 AND date(D.created_at) = CURDATE()');

            $data['returned_leads_count'] = get_query_data('SELECT count(*) as cnt FROM tbl_solar_lead_data as S JOIN tbl_disposition as D on D.id = S.disposition_id JOIN employee_data as U on U.ein = D.employee_id WHERE (D.disposition != "Live Transfer" and D.disposition != "Posted" and D.disposition != "Re Opened") AND D.status = 1 AND date(D.created_at) = CURDATE()');
            

            $data['fetch_leads']          = get_query_data('SELECT *,D.created_at as creation_date FROM tbl_solar_lead_data as S JOIN tbl_disposition as D on D.id = S.disposition_id JOIN employee_data as U on U.ein = D.employee_id WHERE D.disposition = "Live Transfer" AND evaluated_status = "0" AND D.status = 1 AND date(D.created_at) = CURDATE() ORDER BY D.created_at DESC');


            $data['leads_count']          = get_query_data('SELECT count(*) as cnt FROM tbl_solar_lead_data as S JOIN tbl_disposition as D on D.id = S.disposition_id JOIN employee_data as U on U.ein = D.employee_id WHERE D.disposition = "Live Transfer" AND D.status = 1 AND date(D.created_at) = CURDATE()');

            

        }

        //$data = $this->common->qa_list_lib($from_date, $to_date);
        $data['title'] = "QA List";
        $data['view_module'] = "admin";
        $data['view_files'] = "qa_list";
        $this->load->module("templates");
        $this->templates->admin($data);
    }

    public function qa_clients_leads()
    {
        $user_type       = $this->session->userdata('user_type_a1d_qa');
        $password_change = $this->session->userdata('password_change');
       
        if ($password_change == "0" ) {
            redirect('admin/change_password');
        }

        if ($user_type == '') {
            redirect('admin/login');
        }
        elseif($user_type != 'Administrator' && $user_type != 'QA Evaluator' && $user_type != 'QA Manager' && $user_type != 'LMS Manager')
        {
            redirect('admin/page_not_found');
        }
            $search     = $this->input->post('search');
            $date = $this->input->post('datefilter');
            $result_explode = explode(' - ', $date);
                
             $from_date = trim($result_explode[0]);
             $to_date1 = trim($result_explode[1]);
            $client     = $this->input->post('client');
            $agents     = $this->input->post('agents');
            
            if($to_date1 == '')
            {
                $to_date = date('Y-m-d');
            }
            else{
                $to_date = $to_date1;
            }
            
            $data['agents'] = get_query_data('SELECT lo FROM `tbl_clients` WHERE status = 1 order by lo ASC');
              
            if($search == 'Search'){

                //Returned Code
                if ($agents=='all') {
                   $agent_where = '';
                }else{
                   $agent_where = "AND lo ='".$agents."'"; 
                }

                if ($client=='all') {
                   $client_where = '';
                }else{
                   $client_where = "AND campaign ='".$client."'"; 
                }

                $data['a1d_data'] = get_query_data("SELECT 
                                                        e.lo,
                                                        ROUND(AVG(qp.q1_avg), 2) AS q1_avg,
                                                        ROUND(AVG(qp.q2_avg), 2) AS q2_avg,
                                                        ROUND(AVG(qp.q3_avg), 2) AS q3_avg,
                                                        ROUND(AVG(qp.q4_avg), 2) AS q4_avg,
                                                        ROUND(AVG(qp.q5_avg), 2) AS q5_avg,
                                                        ROUND(AVG(qp.q6_avg), 2) AS q6_avg,
                                                        ROUND(AVG(qp.q7_avg), 2) AS q7_avg,
                                                        ROUND(AVG(qp.q8_avg), 2) AS q8_avg,
                                                        ROUND(AVG(qp.q9_avg), 2) AS q9_avg,
                                                        ROUND(AVG(qp.q10_avg), 2) AS q10_avg,
                                                        ROUND(AVG(qp.q11_avg), 2) AS q11_avg,
                                                        ROUND(AVG(qp.q12_avg), 2) AS q12_avg,
                                                        ROUND(AVG(qp.q13_avg), 2) AS q13_avg,
                                                        ROUND(AVG(qp.q14_avg), 2) AS q14_avg,
                                                        ROUND(AVG(qp.q15_avg), 2) AS q15_avg,
                                                        ROUND(AVG(qp.q16_avg), 2) AS q16_avg,
                                                        ROUND(AVG(qp.q17_avg), 2) AS q17_avg,
                                                        ROUND(AVG(qp.q18_avg), 2) AS q18_avg,
                                                        ROUND(AVG(e.obtain_marks), 2) AS avg_total_score,
                                                        ROUND(AVG(e.percentage), 2) AS avg_percentage
                                                    FROM tbl_a1d_evaluation e
                                                    LEFT JOIN (
                                                        SELECT 
                                                            phone,
                                                            DATE(created_at) AS eval_date,
                                                            AVG(CASE WHEN question_id = 1 THEN score_awarded END) AS q1_avg,
                                                            AVG(CASE WHEN question_id = 2 THEN score_awarded END) AS q2_avg,
                                                            AVG(CASE WHEN question_id = 3 THEN score_awarded END) AS q3_avg,
                                                            AVG(CASE WHEN question_id = 4 THEN score_awarded END) AS q4_avg,
                                                            AVG(CASE WHEN question_id = 5 THEN score_awarded END) AS q5_avg,
                                                            AVG(CASE WHEN question_id = 6 THEN score_awarded END) AS q6_avg,
                                                            AVG(CASE WHEN question_id = 7 THEN score_awarded END) AS q7_avg,
                                                            AVG(CASE WHEN question_id = 8 THEN score_awarded END) AS q8_avg,
                                                            AVG(CASE WHEN question_id = 9 THEN score_awarded END) AS q9_avg,
                                                            AVG(CASE WHEN question_id = 10 THEN score_awarded END) AS q10_avg,
                                                            AVG(CASE WHEN question_id = 11 THEN score_awarded END) AS q11_avg,
                                                            AVG(CASE WHEN question_id = 12 THEN score_awarded END) AS q12_avg,
                                                            AVG(CASE WHEN question_id = 13 THEN score_awarded END) AS q13_avg,
                                                            AVG(CASE WHEN question_id = 14 THEN score_awarded END) AS q14_avg,
                                                            AVG(CASE WHEN question_id = 15 THEN score_awarded END) AS q15_avg,
                                                            AVG(CASE WHEN question_id = 16 THEN score_awarded END) AS q16_avg,
                                                            AVG(CASE WHEN question_id = 17 THEN score_awarded END) AS q17_avg,
                                                            AVG(CASE WHEN question_id = 18 THEN score_awarded END) AS q18_avg
                                                        FROM tbl_qa_evaluation
                                                        WHERE question_id BETWEEN 1 AND 18
                                                          AND created_at BETWEEN '".$from_date." 00:00:00' AND '".$to_date." 23:59:59'
                                                        GROUP BY phone, DATE(created_at)
                                                    ) qp ON qp.phone = e.phone AND qp.eval_date = DATE(e.created_at)
                                                    WHERE e.created_at BETWEEN '".$from_date." 00:00:00' AND '".$to_date." 23:59:59'
                                                      ".$agent_where."
                                                      ".$client_where."
                                                    GROUP BY e.lo
                                                    ORDER BY e.lo ASC
                                                ");






               
                $data['query_for_download_data_by_date'] = "SELECT 
                                                        e.lo,
                                                        ROUND(AVG(qp.q1_avg), 2) AS q1_avg,
                                                        ROUND(AVG(qp.q2_avg), 2) AS q2_avg,
                                                        ROUND(AVG(qp.q3_avg), 2) AS q3_avg,
                                                        ROUND(AVG(qp.q4_avg), 2) AS q4_avg,
                                                        ROUND(AVG(qp.q5_avg), 2) AS q5_avg,
                                                        ROUND(AVG(qp.q6_avg), 2) AS q6_avg,
                                                        ROUND(AVG(qp.q7_avg), 2) AS q7_avg,
                                                        ROUND(AVG(qp.q8_avg), 2) AS q8_avg,
                                                        ROUND(AVG(qp.q9_avg), 2) AS q9_avg,
                                                        ROUND(AVG(qp.q10_avg), 2) AS q10_avg,
                                                        ROUND(AVG(qp.q11_avg), 2) AS q11_avg,
                                                        ROUND(AVG(qp.q12_avg), 2) AS q12_avg,
                                                        ROUND(AVG(qp.q13_avg), 2) AS q13_avg,
                                                        ROUND(AVG(qp.q14_avg), 2) AS q14_avg,
                                                        ROUND(AVG(qp.q15_avg), 2) AS q15_avg,
                                                        ROUND(AVG(qp.q16_avg), 2) AS q16_avg,
                                                        ROUND(AVG(qp.q17_avg), 2) AS q17_avg,
                                                        ROUND(AVG(qp.q18_avg), 2) AS q18_avg,
                                                        ROUND(AVG(e.obtain_marks), 2) AS avg_total_score,
                                                        ROUND(AVG(e.percentage), 2) AS avg_percentage
                                                    FROM tbl_a1d_evaluation e
                                                    LEFT JOIN (
                                                        SELECT 
                                                            phone,
                                                            DATE(created_at) AS eval_date,
                                                            AVG(CASE WHEN question_id = 1 THEN score_awarded END) AS q1_avg,
                                                            AVG(CASE WHEN question_id = 2 THEN score_awarded END) AS q2_avg,
                                                            AVG(CASE WHEN question_id = 3 THEN score_awarded END) AS q3_avg,
                                                            AVG(CASE WHEN question_id = 4 THEN score_awarded END) AS q4_avg,
                                                            AVG(CASE WHEN question_id = 5 THEN score_awarded END) AS q5_avg,
                                                            AVG(CASE WHEN question_id = 6 THEN score_awarded END) AS q6_avg,
                                                            AVG(CASE WHEN question_id = 7 THEN score_awarded END) AS q7_avg,
                                                            AVG(CASE WHEN question_id = 8 THEN score_awarded END) AS q8_avg,
                                                            AVG(CASE WHEN question_id = 9 THEN score_awarded END) AS q9_avg,
                                                            AVG(CASE WHEN question_id = 10 THEN score_awarded END) AS q10_avg,
                                                            AVG(CASE WHEN question_id = 11 THEN score_awarded END) AS q11_avg,
                                                            AVG(CASE WHEN question_id = 12 THEN score_awarded END) AS q12_avg,
                                                            AVG(CASE WHEN question_id = 13 THEN score_awarded END) AS q13_avg,
                                                            AVG(CASE WHEN question_id = 14 THEN score_awarded END) AS q14_avg,
                                                            AVG(CASE WHEN question_id = 15 THEN score_awarded END) AS q15_avg,
                                                            AVG(CASE WHEN question_id = 16 THEN score_awarded END) AS q16_avg,
                                                            AVG(CASE WHEN question_id = 17 THEN score_awarded END) AS q17_avg
                                                            AVG(CASE WHEN question_id = 18 THEN score_awarded END) AS q18_avg
                                                        FROM tbl_qa_evaluation
                                                        WHERE question_id BETWEEN 1 AND 18
                                                          AND created_at BETWEEN '".$from_date." 00:00:00' AND '".$to_date." 23:59:59'
                                                        GROUP BY phone, DATE(created_at)
                                                    ) qp ON qp.phone = e.phone AND qp.eval_date = DATE(e.created_at)
                                                    WHERE e.created_at BETWEEN '".$from_date." 00:00:00' AND '".$to_date." 23:59:59'
                                                      ".$agent_where."
                                                      ".$client_where."
                                                    GROUP BY e.lo
                                                    ORDER BY e.lo ASC
                                                ";

                $data['qa_questions']             = get_query_data('SELECT * from qa_questions where status = 1 ');




            }
            else{

                $data['qa_questions']             = get_query_data('SELECT * from qa_questions where status = 1');


                   
                $data['a1d_data']       = get_query_data("SELECT 
                                                        e.lo,
                                                        ROUND(AVG(qp.q1_avg), 2) AS q1_avg,
                                                        ROUND(AVG(qp.q2_avg), 2) AS q2_avg,
                                                        ROUND(AVG(qp.q3_avg), 2) AS q3_avg,
                                                        ROUND(AVG(qp.q4_avg), 2) AS q4_avg,
                                                        ROUND(AVG(qp.q5_avg), 2) AS q5_avg,
                                                        ROUND(AVG(qp.q6_avg), 2) AS q6_avg,
                                                        ROUND(AVG(qp.q7_avg), 2) AS q7_avg,
                                                        ROUND(AVG(qp.q8_avg), 2) AS q8_avg,
                                                        ROUND(AVG(qp.q9_avg), 2) AS q9_avg,
                                                        ROUND(AVG(qp.q10_avg), 2) AS q10_avg,
                                                        ROUND(AVG(qp.q11_avg), 2) AS q11_avg,
                                                        ROUND(AVG(qp.q12_avg), 2) AS q12_avg,
                                                        ROUND(AVG(qp.q13_avg), 2) AS q13_avg,
                                                        ROUND(AVG(qp.q14_avg), 2) AS q14_avg,
                                                        ROUND(AVG(qp.q15_avg), 2) AS q15_avg,
                                                        ROUND(AVG(qp.q16_avg), 2) AS q16_avg,
                                                        ROUND(AVG(qp.q17_avg), 2) AS q17_avg,
                                                        ROUND(AVG(qp.q18_avg), 2) AS q18_avg,
                                                        ROUND(AVG(e.obtain_marks), 2) AS avg_total_score,
                                                        ROUND(AVG(e.percentage), 2) AS avg_percentage
                                                    FROM tbl_a1d_evaluation e
                                                    LEFT JOIN (
                                                        SELECT 
                                                            phone,
                                                            DATE(created_at) AS eval_date,
                                                            AVG(CASE WHEN question_id = 1 THEN score_awarded END) AS q1_avg,
                                                            AVG(CASE WHEN question_id = 2 THEN score_awarded END) AS q2_avg,
                                                            AVG(CASE WHEN question_id = 3 THEN score_awarded END) AS q3_avg,
                                                            AVG(CASE WHEN question_id = 4 THEN score_awarded END) AS q4_avg,
                                                            AVG(CASE WHEN question_id = 5 THEN score_awarded END) AS q5_avg,
                                                            AVG(CASE WHEN question_id = 6 THEN score_awarded END) AS q6_avg,
                                                            AVG(CASE WHEN question_id = 7 THEN score_awarded END) AS q7_avg,
                                                            AVG(CASE WHEN question_id = 8 THEN score_awarded END) AS q8_avg,
                                                            AVG(CASE WHEN question_id = 9 THEN score_awarded END) AS q9_avg,
                                                            AVG(CASE WHEN question_id = 10 THEN score_awarded END) AS q10_avg,
                                                            AVG(CASE WHEN question_id = 11 THEN score_awarded END) AS q11_avg,
                                                            AVG(CASE WHEN question_id = 12 THEN score_awarded END) AS q12_avg,
                                                            AVG(CASE WHEN question_id = 13 THEN score_awarded END) AS q13_avg,
                                                            AVG(CASE WHEN question_id = 14 THEN score_awarded END) AS q14_avg,
                                                            AVG(CASE WHEN question_id = 15 THEN score_awarded END) AS q15_avg,
                                                            AVG(CASE WHEN question_id = 16 THEN score_awarded END) AS q16_avg,
                                                            AVG(CASE WHEN question_id = 17 THEN score_awarded END) AS q17_avg,
                                                            AVG(CASE WHEN question_id = 18 THEN score_awarded END) AS q18_avg
                                                        FROM tbl_qa_evaluation
                                                        WHERE question_id BETWEEN 1 AND 18
                                                          AND created_at BETWEEN '".$from_date." 00:00:00' AND '".$to_date." 23:59:59'
                                                        GROUP BY phone, DATE(created_at)
                                                    ) qp ON qp.phone = e.phone AND qp.eval_date = DATE(e.created_at)
                                                    WHERE  DATE(e.created_at) = CURDATE()
                                                    GROUP BY e.lo
                                                    ORDER BY e.lo ASC
                                                ");


                

               
                
                $data['query_for_download_data_by_date'] = "SELECT 
                                                        e.lo,
                                                        ROUND(AVG(qp.q1_avg), 2) AS q1_avg,
                                                        ROUND(AVG(qp.q2_avg), 2) AS q2_avg,
                                                        ROUND(AVG(qp.q3_avg), 2) AS q3_avg,
                                                        ROUND(AVG(qp.q4_avg), 2) AS q4_avg,
                                                        ROUND(AVG(qp.q5_avg), 2) AS q5_avg,
                                                        ROUND(AVG(qp.q6_avg), 2) AS q6_avg,
                                                        ROUND(AVG(qp.q7_avg), 2) AS q7_avg,
                                                        ROUND(AVG(qp.q8_avg), 2) AS q8_avg,
                                                        ROUND(AVG(qp.q9_avg), 2) AS q9_avg,
                                                        ROUND(AVG(qp.q10_avg), 2) AS q10_avg,
                                                        ROUND(AVG(qp.q11_avg), 2) AS q11_avg,
                                                        ROUND(AVG(qp.q12_avg), 2) AS q12_avg,
                                                        ROUND(AVG(qp.q13_avg), 2) AS q13_avg,
                                                        ROUND(AVG(qp.q14_avg), 2) AS q14_avg,
                                                        ROUND(AVG(qp.q15_avg), 2) AS q15_avg,
                                                        ROUND(AVG(qp.q16_avg), 2) AS q16_avg,
                                                        ROUND(AVG(qp.q17_avg), 2) AS q17_avg,
                                                        ROUND(AVG(qp.q18_avg), 2) AS q18_avg,
                                                        ROUND(AVG(e.obtain_marks), 2) AS avg_total_score,
                                                        ROUND(AVG(e.percentage), 2) AS avg_percentage
                                                    FROM tbl_a1d_evaluation e
                                                    LEFT JOIN (
                                                        SELECT 
                                                            phone,
                                                            DATE(created_at) AS eval_date,
                                                            AVG(CASE WHEN question_id = 1 THEN score_awarded END) AS q1_avg,
                                                            AVG(CASE WHEN question_id = 2 THEN score_awarded END) AS q2_avg,
                                                            AVG(CASE WHEN question_id = 3 THEN score_awarded END) AS q3_avg,
                                                            AVG(CASE WHEN question_id = 4 THEN score_awarded END) AS q4_avg,
                                                            AVG(CASE WHEN question_id = 5 THEN score_awarded END) AS q5_avg,
                                                            AVG(CASE WHEN question_id = 6 THEN score_awarded END) AS q6_avg,
                                                            AVG(CASE WHEN question_id = 7 THEN score_awarded END) AS q7_avg,
                                                            AVG(CASE WHEN question_id = 8 THEN score_awarded END) AS q8_avg,
                                                            AVG(CASE WHEN question_id = 9 THEN score_awarded END) AS q9_avg,
                                                            AVG(CASE WHEN question_id = 10 THEN score_awarded END) AS q10_avg,
                                                            AVG(CASE WHEN question_id = 11 THEN score_awarded END) AS q11_avg,
                                                            AVG(CASE WHEN question_id = 12 THEN score_awarded END) AS q12_avg,
                                                            AVG(CASE WHEN question_id = 13 THEN score_awarded END) AS q13_avg,
                                                            AVG(CASE WHEN question_id = 14 THEN score_awarded END) AS q14_avg,
                                                            AVG(CASE WHEN question_id = 15 THEN score_awarded END) AS q15_avg,
                                                            AVG(CASE WHEN question_id = 16 THEN score_awarded END) AS q16_avg,
                                                            AVG(CASE WHEN question_id = 17 THEN score_awarded END) AS q17_avg,
                                                            AVG(CASE WHEN question_id = 18 THEN score_awarded END) AS q18_avg
                                                        FROM tbl_qa_evaluation
                                                        WHERE question_id BETWEEN 1 AND 18
                                                          AND created_at BETWEEN '".$from_date." 00:00:00' AND '".$to_date." 23:59:59'
                                                        GROUP BY phone, DATE(created_at)
                                                    ) qp ON qp.phone = e.phone AND qp.eval_date = DATE(e.created_at)
                                                    WHERE  DATE(e.created_at) = CURDATE()
                                                    GROUP BY e.lo
                                                    ORDER BY e.lo ASC
                                                ";

            }

            //$data = $this->common->qa_list_lib($from_date, $to_date);
            $data['title']       = "QA Report";
            $data['view_module'] = "admin";
            $data['view_files']  = "qa_clients_leads";
            $this->load->module("templates");
            $this->templates->admin($data);
    }


    public function qa_reports()
    {
        $user_type       = $this->session->userdata('user_type_a1d_qa');
        $password_change = $this->session->userdata('password_change');
       
        if ($password_change == "0" ) {
            redirect('admin/change_password');
        }

        if ($user_type == '') {
            redirect('admin/login');
        }
        elseif($user_type != 'Administrator' && $user_type != 'QA Manager' && $user_type != 'LMS Manager')
        {
            redirect('admin/page_not_found');
        }
            $search     = $this->input->post('search');
            $date = $this->input->post('datefilter');
            $result_explode = explode(' - ', $date);
                
             $from_date = trim($result_explode[0]);
             $to_date1 = trim($result_explode[1]);
            $client     = $this->input->post('client');
            $agents     = $this->input->post('agents');
            
            if($to_date1 == '')
            {
                $to_date = date('Y-m-d');
            }
            else{
                $to_date = $to_date1;
            }
            
            $data['agents'] = get_query_data('SELECT lo FROM `tbl_clients` WHERE status = 1 order by lo ASC');
              
            if($search == 'Search'){

                //Returned Code
                if ($agents=='all') {
                   $agent_where = '';
                }else{
                   $agent_where = "AND lo='".$agents."'"; 
                }

                if ($client=='all') {
                   $client_where = '';
                }else{
                   $client_where = "AND campaign='".$client."'"; 
                }


                $data['a1d_data'] = get_query_data("
                                                    SELECT 
                                                        e.phone,
                                                        e.lo,
                                                        e.obtain_marks,
                                                        e.percentage,
                                                        e.grade,
                                                        emp.employee_name,

                                                        qp.q1_score,
                                                        qp.q2_score,
                                                        qp.q3_score,
                                                        qp.q4_score,
                                                        qp.q5_score,
                                                        qp.q6_score,
                                                        qp.q7_score,
                                                        qp.q8_score,
                                                        qp.q9_score,
                                                        qp.q10_score,
                                                        qp.q11_score,
                                                        qp.q12_score,
                                                        qp.q13_score,
                                                        qp.q14_score,
                                                        qp.q15_score,
                                                        qp.q16_score,
                                                        qp.q17_score,
                                                        qp.q18_score

                                                    FROM tbl_a1d_evaluation e

                                                    JOIN employee_data emp ON emp.ein = e.evaluator_id

                                                    LEFT JOIN (
                                                        SELECT 
                                                            phone,
                                                            DATE(created_at) AS eval_date,
                                                            MAX(CASE WHEN question_id = 1 THEN score_awarded END) AS q1_score,
                                                            MAX(CASE WHEN question_id = 2 THEN score_awarded END) AS q2_score,
                                                            MAX(CASE WHEN question_id = 3 THEN score_awarded END) AS q3_score,
                                                            MAX(CASE WHEN question_id = 4 THEN score_awarded END) AS q4_score,
                                                            MAX(CASE WHEN question_id = 5 THEN score_awarded END) AS q5_score,
                                                            MAX(CASE WHEN question_id = 6 THEN score_awarded END) AS q6_score,
                                                            MAX(CASE WHEN question_id = 7 THEN score_awarded END) AS q7_score,
                                                            MAX(CASE WHEN question_id = 8 THEN score_awarded END) AS q8_score,
                                                            MAX(CASE WHEN question_id = 9 THEN score_awarded END) AS q9_score,
                                                            MAX(CASE WHEN question_id = 10 THEN score_awarded END) AS q10_score,
                                                            MAX(CASE WHEN question_id = 11 THEN score_awarded END) AS q11_score,
                                                            MAX(CASE WHEN question_id = 12 THEN score_awarded END) AS q12_score,
                                                            MAX(CASE WHEN question_id = 13 THEN score_awarded END) AS q13_score,
                                                            MAX(CASE WHEN question_id = 14 THEN score_awarded END) AS q14_score,
                                                            MAX(CASE WHEN question_id = 15 THEN score_awarded END) AS q15_score,
                                                            MAX(CASE WHEN question_id = 16 THEN score_awarded END) AS q16_score,
                                                            MAX(CASE WHEN question_id = 17 THEN score_awarded END) AS q17_score,
                                                            MAX(CASE WHEN question_id = 18 THEN score_awarded END) AS q18_score
                                                        FROM tbl_qa_evaluation
                                                        WHERE question_id BETWEEN 1 AND 18
                                                          AND created_at BETWEEN '".$from_date." 00:00:00' AND '".$to_date." 23:59:59'
                                                        GROUP BY phone, DATE(created_at)
                                                    ) qp ON qp.phone = e.phone AND qp.eval_date = DATE(e.created_at)

                                                    WHERE DATE(e.created_at) BETWEEN '".$from_date."' AND '".$to_date."'
                                                      ".$agent_where."
                                                      ".$client_where."
                                                ");


                $data['qa_questions']             = get_query_data('SELECT * from qa_questions where status = 1');

                $data['avg_data'] = get_query_data("
                                                    SELECT 
                                                        ROUND(AVG(qp.q1_avg), 2) AS q1_avg,
                                                        ROUND(AVG(qp.q2_avg), 2) AS q2_avg,
                                                        ROUND(AVG(qp.q3_avg), 2) AS q3_avg,
                                                        ROUND(AVG(qp.q4_avg), 2) AS q4_avg,
                                                        ROUND(AVG(qp.q5_avg), 2) AS q5_avg,
                                                        ROUND(AVG(qp.q6_avg), 2) AS q6_avg,
                                                        ROUND(AVG(qp.q7_avg), 2) AS q7_avg,
                                                        ROUND(AVG(qp.q8_avg), 2) AS q8_avg,
                                                        ROUND(AVG(qp.q9_avg), 2) AS q9_avg,
                                                        ROUND(AVG(qp.q10_avg), 2) AS q10_avg,
                                                        ROUND(AVG(qp.q11_avg), 2) AS q11_avg,
                                                        ROUND(AVG(qp.q12_avg), 2) AS q12_avg,
                                                        ROUND(AVG(qp.q13_avg), 2) AS q13_avg,
                                                        ROUND(AVG(qp.q14_avg), 2) AS q14_avg,
                                                        ROUND(AVG(qp.q15_avg), 2) AS q15_avg,
                                                        ROUND(AVG(qp.q16_avg), 2) AS q16_avg,
                                                        ROUND(AVG(qp.q17_avg), 2) AS q17_avg,
                                                        ROUND(AVG(qp.q18_avg), 2) AS q18_avg,
                                                        
                                                        ROUND(AVG(e.obtain_marks), 2) AS avg_total_score,
                                                        ROUND(AVG(e.percentage), 2) AS avg_percentage

                                                    FROM tbl_a1d_evaluation e

                                                    LEFT JOIN (
                                                        SELECT 
                                                            phone,
                                                            DATE(created_at) AS eval_date,
                                                            AVG(CASE WHEN question_id = 1 THEN score_awarded END) AS q1_avg,
                                                            AVG(CASE WHEN question_id = 2 THEN score_awarded END) AS q2_avg,
                                                            AVG(CASE WHEN question_id = 3 THEN score_awarded END) AS q3_avg,
                                                            AVG(CASE WHEN question_id = 4 THEN score_awarded END) AS q4_avg,
                                                            AVG(CASE WHEN question_id = 5 THEN score_awarded END) AS q5_avg,
                                                            AVG(CASE WHEN question_id = 6 THEN score_awarded END) AS q6_avg,
                                                            AVG(CASE WHEN question_id = 7 THEN score_awarded END) AS q7_avg,
                                                            AVG(CASE WHEN question_id = 8 THEN score_awarded END) AS q8_avg,
                                                            AVG(CASE WHEN question_id = 9 THEN score_awarded END) AS q9_avg,
                                                            AVG(CASE WHEN question_id = 10 THEN score_awarded END) AS q10_avg,
                                                            AVG(CASE WHEN question_id = 11 THEN score_awarded END) AS q11_avg,
                                                            AVG(CASE WHEN question_id = 12 THEN score_awarded END) AS q12_avg,
                                                            AVG(CASE WHEN question_id = 13 THEN score_awarded END) AS q13_avg,
                                                            AVG(CASE WHEN question_id = 14 THEN score_awarded END) AS q14_avg,
                                                            AVG(CASE WHEN question_id = 15 THEN score_awarded END) AS q15_avg,
                                                            AVG(CASE WHEN question_id = 16 THEN score_awarded END) AS q16_avg,
                                                            AVG(CASE WHEN question_id = 17 THEN score_awarded END) AS q17_avg,
                                                            AVG(CASE WHEN question_id = 18 THEN score_awarded END) AS q18_avg
                                                        FROM tbl_qa_evaluation
                                                        WHERE question_id BETWEEN 1 AND 18
                                                          AND created_at BETWEEN '".$from_date." 00:00:00' AND '".$to_date." 23:59:59'
                                                        GROUP BY phone, DATE(created_at)
                                                    ) qp ON qp.phone = e.phone AND qp.eval_date = DATE(e.created_at)

                                                    WHERE e.created_at BETWEEN '".$from_date." 00:00:00' AND '".$to_date." 23:59:59'
                                                      ".$agent_where."
                                                      ".$client_where."
                                                ");

               

                $data['leads_count']    = get_query_data('SELECT count(*) as cnt FROM tbl_a1d_evaluation where date(created_at) Between "'.$from_date.'" AND "'.$to_date.'" ');

                $data['query_for_download_data_by_date'] = "
                                                    SELECT 
                                                        e.phone,
                                                        e.lo,
                                                        e.obtain_marks,
                                                        e.percentage,
                                                        e.grade,
                                                        emp.employee_name,

                                                        qp.q1_score,
                                                        qp.q2_score,
                                                        qp.q3_score,
                                                        qp.q4_score,
                                                        qp.q5_score,
                                                        qp.q6_score,
                                                        qp.q7_score,
                                                        qp.q8_score,
                                                        qp.q9_score,
                                                        qp.q10_score,
                                                        qp.q11_score,
                                                        qp.q12_score,
                                                        qp.q13_score,
                                                        qp.q14_score,
                                                        qp.q15_score,
                                                        qp.q16_score,
                                                        qp.q17_score,
                                                        qp.q18_score

                                                    FROM tbl_a1d_evaluation e

                                                    JOIN employee_data emp ON emp.ein = e.evaluator_id

                                                    LEFT JOIN (
                                                        SELECT 
                                                            phone,
                                                            DATE(created_at) AS eval_date,
                                                            MAX(CASE WHEN question_id = 1 THEN score_awarded END) AS q1_score,
                                                            MAX(CASE WHEN question_id = 2 THEN score_awarded END) AS q2_score,
                                                            MAX(CASE WHEN question_id = 3 THEN score_awarded END) AS q3_score,
                                                            MAX(CASE WHEN question_id = 4 THEN score_awarded END) AS q4_score,
                                                            MAX(CASE WHEN question_id = 5 THEN score_awarded END) AS q5_score,
                                                            MAX(CASE WHEN question_id = 6 THEN score_awarded END) AS q6_score,
                                                            MAX(CASE WHEN question_id = 7 THEN score_awarded END) AS q7_score,
                                                            MAX(CASE WHEN question_id = 8 THEN score_awarded END) AS q8_score,
                                                            MAX(CASE WHEN question_id = 9 THEN score_awarded END) AS q9_score,
                                                            MAX(CASE WHEN question_id = 10 THEN score_awarded END) AS q10_score,
                                                            MAX(CASE WHEN question_id = 11 THEN score_awarded END) AS q11_score,
                                                            MAX(CASE WHEN question_id = 12 THEN score_awarded END) AS q12_score,
                                                            MAX(CASE WHEN question_id = 13 THEN score_awarded END) AS q13_score,
                                                            MAX(CASE WHEN question_id = 14 THEN score_awarded END) AS q14_score,
                                                            MAX(CASE WHEN question_id = 15 THEN score_awarded END) AS q15_score,
                                                            MAX(CASE WHEN question_id = 16 THEN score_awarded END) AS q16_score,
                                                            MAX(CASE WHEN question_id = 17 THEN score_awarded END) AS q17_score,
                                                            MAX(CASE WHEN question_id = 18 THEN score_awarded END) AS q18_score
                                                        FROM tbl_qa_evaluation
                                                        WHERE question_id BETWEEN 1 AND 18
                                                          AND created_at BETWEEN '".$from_date." 00:00:00' AND '".$to_date." 23:59:59'
                                                        GROUP BY phone, DATE(created_at)
                                                    ) qp ON qp.phone = e.phone AND qp.eval_date = DATE(e.created_at)

                                                    WHERE DATE(e.created_at) BETWEEN '".$from_date."' AND '".$to_date."'
                                                      ".$agent_where."
                                                      ".$client_where."
                                                ";

                     $data['query_for_download_avg_data_by_date'] = "
                                                    SELECT 
                                                        ROUND(AVG(qp.q1_avg), 2) AS q1_avg,
                                                        ROUND(AVG(qp.q2_avg), 2) AS q2_avg,
                                                        ROUND(AVG(qp.q3_avg), 2) AS q3_avg,
                                                        ROUND(AVG(qp.q4_avg), 2) AS q4_avg,
                                                        ROUND(AVG(qp.q5_avg), 2) AS q5_avg,
                                                        ROUND(AVG(qp.q6_avg), 2) AS q6_avg,
                                                        ROUND(AVG(qp.q7_avg), 2) AS q7_avg,
                                                        ROUND(AVG(qp.q8_avg), 2) AS q8_avg,
                                                        ROUND(AVG(qp.q9_avg), 2) AS q9_avg,
                                                        ROUND(AVG(qp.q10_avg), 2) AS q10_avg,
                                                        ROUND(AVG(qp.q11_avg), 2) AS q11_avg,
                                                        ROUND(AVG(qp.q12_avg), 2) AS q12_avg,
                                                        ROUND(AVG(qp.q13_avg), 2) AS q13_avg,
                                                        ROUND(AVG(qp.q14_avg), 2) AS q14_avg,
                                                        ROUND(AVG(qp.q15_avg), 2) AS q15_avg,
                                                        ROUND(AVG(qp.q16_avg), 2) AS q16_avg,
                                                        ROUND(AVG(qp.q17_avg), 2) AS q17_avg,
                                                        ROUND(AVG(qp.q18_avg), 2) AS q18_avg,
                                                        
                                                        ROUND(AVG(e.obtain_marks), 2) AS avg_total_score,
                                                        ROUND(AVG(e.percentage), 2) AS avg_percentage

                                                    FROM tbl_a1d_evaluation e

                                                    LEFT JOIN (
                                                        SELECT 
                                                            phone,
                                                            DATE(created_at) AS eval_date,
                                                            AVG(CASE WHEN question_id = 1 THEN score_awarded END) AS q1_avg,
                                                            AVG(CASE WHEN question_id = 2 THEN score_awarded END) AS q2_avg,
                                                            AVG(CASE WHEN question_id = 3 THEN score_awarded END) AS q3_avg,
                                                            AVG(CASE WHEN question_id = 4 THEN score_awarded END) AS q4_avg,
                                                            AVG(CASE WHEN question_id = 5 THEN score_awarded END) AS q5_avg,
                                                            AVG(CASE WHEN question_id = 6 THEN score_awarded END) AS q6_avg,
                                                            AVG(CASE WHEN question_id = 7 THEN score_awarded END) AS q7_avg,
                                                            AVG(CASE WHEN question_id = 8 THEN score_awarded END) AS q8_avg,
                                                            AVG(CASE WHEN question_id = 9 THEN score_awarded END) AS q9_avg,
                                                            AVG(CASE WHEN question_id = 10 THEN score_awarded END) AS q10_avg,
                                                            AVG(CASE WHEN question_id = 11 THEN score_awarded END) AS q11_avg,
                                                            AVG(CASE WHEN question_id = 12 THEN score_awarded END) AS q12_avg,
                                                            AVG(CASE WHEN question_id = 13 THEN score_awarded END) AS q13_avg,
                                                            AVG(CASE WHEN question_id = 14 THEN score_awarded END) AS q14_avg,
                                                            AVG(CASE WHEN question_id = 15 THEN score_awarded END) AS q15_avg,
                                                            AVG(CASE WHEN question_id = 16 THEN score_awarded END) AS q16_avg,
                                                            AVG(CASE WHEN question_id = 17 THEN score_awarded END) AS q17_avg,
                                                            AVG(CASE WHEN question_id = 18 THEN score_awarded END) AS q18_avg
                                                        FROM tbl_qa_evaluation
                                                        WHERE question_id BETWEEN 1 AND 18
                                                          AND created_at BETWEEN '".$from_date." 00:00:00' AND '".$to_date." 23:59:59'
                                                        GROUP BY phone, DATE(created_at)
                                                    ) qp ON qp.phone = e.phone AND qp.eval_date = DATE(e.created_at)

                                                    WHERE e.created_at BETWEEN '".$from_date." 00:00:00' AND '".$to_date." 23:59:59'
                                                      ".$agent_where."
                                                      ".$client_where."
                                                ";
            }
            else{


               

                $data['qa_questions']             = get_query_data('SELECT * from qa_questions where status = 1');  




                //Fetching Data from AID Evaluation Table
                $data['a1d_data']             = get_query_data('SELECT 
                                                                        e.phone,
                                                                        e.lo,
                                                                        e.obtain_marks,
                                                                        e.percentage,
                                                                        e.grade,
                                                                        emp.employee_name,

                                                                        q1.score_awarded AS q1_score,
                                                                        q2.score_awarded AS q2_score,
                                                                        q3.score_awarded AS q3_score,
                                                                        q4.score_awarded AS q4_score,
                                                                        q5.score_awarded AS q5_score,
                                                                        q6.score_awarded AS q6_score,
                                                                        q7.score_awarded AS q7_score,
                                                                        q8.score_awarded AS q8_score,
                                                                        q9.score_awarded AS q9_score,
                                                                        q10.score_awarded AS q10_score,
                                                                        q11.score_awarded AS q11_score,
                                                                        q12.score_awarded AS q12_score,
                                                                        q13.score_awarded AS q13_score,
                                                                        q14.score_awarded AS q14_score,
                                                                        q15.score_awarded AS q15_score,
                                                                        q16.score_awarded AS q16_score,
                                                                        q17.score_awarded AS q17_score,
                                                                        q18.score_awarded AS q18_score

                                                                    FROM tbl_a1d_evaluation e

                                                                    JOIN employee_data emp ON emp.ein = e.evaluator_id

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 1
                                                                    ) q1 ON q1.phone = e.phone AND DATE(q1.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 2
                                                                    ) q2 ON q2.phone = e.phone AND DATE(q2.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 3
                                                                    ) q3 ON q3.phone = e.phone AND DATE(q3.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 4
                                                                    ) q4 ON q4.phone = e.phone AND DATE(q4.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 5
                                                                    ) q5 ON q5.phone = e.phone AND DATE(q5.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 6
                                                                    ) q6 ON q6.phone = e.phone AND DATE(q6.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 7
                                                                    ) q7 ON q7.phone = e.phone AND DATE(q7.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 8
                                                                    ) q8 ON q8.phone = e.phone AND DATE(q8.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 9
                                                                    ) q9 ON q9.phone = e.phone AND DATE(q9.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 10
                                                                    ) q10 ON q10.phone = e.phone AND DATE(q10.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 11
                                                                    ) q11 ON q11.phone = e.phone AND DATE(q11.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 12
                                                                    ) q12 ON q12.phone = e.phone AND DATE(q12.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 13
                                                                    ) q13 ON q13.phone = e.phone AND DATE(q13.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 14
                                                                    ) q14 ON q14.phone = e.phone AND DATE(q14.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 15
                                                                    ) q15 ON q15.phone = e.phone AND DATE(q15.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 16
                                                                    ) q16 ON q16.phone = e.phone AND DATE(q16.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 17
                                                                    ) q17 ON q17.phone = e.phone AND DATE(q17.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 18
                                                                    ) q18 ON q18.phone = e.phone AND DATE(q18.created_at) = DATE(e.created_at)


                                                                    WHERE DATE(e.created_at) = CURDATE()
                                                                    ORDER BY e.created_at DESC');    

                 //Fetching Data from AID Evaluation Table
                $data['avg_data']             = get_query_data('SELECT 
                                                                        ROUND(AVG(q1.score_awarded), 2) AS q1_avg,
                                                                        ROUND(AVG(q2.score_awarded), 2) AS q2_avg,
                                                                        ROUND(AVG(q3.score_awarded), 2) AS q3_avg,
                                                                        ROUND(AVG(q4.score_awarded), 2) AS q4_avg,
                                                                        ROUND(AVG(q5.score_awarded), 2) AS q5_avg,
                                                                        ROUND(AVG(q6.score_awarded), 2) AS q6_avg,
                                                                        ROUND(AVG(q7.score_awarded), 2) AS q7_avg,
                                                                        ROUND(AVG(q8.score_awarded), 2) AS q8_avg,
                                                                        ROUND(AVG(q9.score_awarded), 2) AS q9_avg,
                                                                        ROUND(AVG(q10.score_awarded), 2) AS q10_avg,
                                                                        ROUND(AVG(q11.score_awarded), 2) AS q11_avg,
                                                                        ROUND(AVG(q12.score_awarded), 2) AS q12_avg,
                                                                        ROUND(AVG(q13.score_awarded), 2) AS q13_avg,
                                                                        ROUND(AVG(q14.score_awarded), 2) AS q14_avg,
                                                                        ROUND(AVG(q15.score_awarded), 2) AS q15_avg,
                                                                        ROUND(AVG(q16.score_awarded), 2) AS q16_avg,
                                                                        ROUND(AVG(q17.score_awarded), 2) AS q17_avg,
                                                                        ROUND(AVG(q18.score_awarded), 2) AS q18_avg,
                                                                        
                                                                        ROUND(AVG(e.obtain_marks), 2) AS avg_total_score,
                                                                        ROUND(AVG(e.percentage), 2) AS avg_percentage

                                                                    FROM tbl_a1d_evaluation e

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 1
                                                                    ) q1 ON q1.phone = e.phone AND DATE(q1.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 2
                                                                    ) q2 ON q2.phone = e.phone AND DATE(q2.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 3
                                                                    ) q3 ON q3.phone = e.phone AND DATE(q3.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 4
                                                                    ) q4 ON q4.phone = e.phone AND DATE(q4.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 5
                                                                    ) q5 ON q5.phone = e.phone AND DATE(q5.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 6
                                                                    ) q6 ON q6.phone = e.phone AND DATE(q6.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 7
                                                                    ) q7 ON q7.phone = e.phone AND DATE(q7.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 8
                                                                    ) q8 ON q8.phone = e.phone AND DATE(q8.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 9
                                                                    ) q9 ON q9.phone = e.phone AND DATE(q9.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 10
                                                                    ) q10 ON q10.phone = e.phone AND DATE(q10.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 11
                                                                    ) q11 ON q11.phone = e.phone AND DATE(q11.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 12
                                                                    ) q12 ON q12.phone = e.phone AND DATE(q12.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 13
                                                                    ) q13 ON q13.phone = e.phone AND DATE(q13.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 14
                                                                    ) q14 ON q14.phone = e.phone AND DATE(q14.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 15
                                                                    ) q15 ON q15.phone = e.phone AND DATE(q15.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 16
                                                                    ) q16 ON q16.phone = e.phone AND DATE(q16.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 17
                                                                    ) q17 ON q17.phone = e.phone AND DATE(q17.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 18
                                                                    ) q18 ON q18.phone = e.phone AND DATE(q18.created_at) = DATE(e.created_at)


                                                                    WHERE DATE(e.created_at) = CURDATE()');    

                

                $data['leads_count']    = get_query_data('SELECT count(*) as cnt FROM tbl_a1d_evaluation where date(created_at) = CURDATE()');
                
                $data['query_for_download_data_by_date'] = 'SELECT 
                                                                        e.phone,
                                                                        e.lo,
                                                                        e.obtain_marks,
                                                                        e.percentage,
                                                                        e.grade,
                                                                        emp.employee_name,

                                                                        q1.score_awarded AS q1_score,
                                                                        q2.score_awarded AS q2_score,
                                                                        q3.score_awarded AS q3_score,
                                                                        q4.score_awarded AS q4_score,
                                                                        q5.score_awarded AS q5_score,
                                                                        q6.score_awarded AS q6_score,
                                                                        q7.score_awarded AS q7_score,
                                                                        q8.score_awarded AS q8_score,
                                                                        q9.score_awarded AS q9_score,
                                                                        q10.score_awarded AS q10_score,
                                                                        q11.score_awarded AS q11_score,
                                                                        q12.score_awarded AS q12_score,
                                                                        q13.score_awarded AS q13_score,
                                                                        q14.score_awarded AS q14_score,
                                                                        q15.score_awarded AS q15_score,
                                                                        q16.score_awarded AS q16_score,
                                                                        q17.score_awarded AS q17_score,
                                                                        q18.score_awarded AS q18_score

                                                                    FROM tbl_a1d_evaluation e

                                                                    JOIN employee_data emp ON emp.ein = e.evaluator_id

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 1
                                                                    ) q1 ON q1.phone = e.phone AND DATE(q1.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 2
                                                                    ) q2 ON q2.phone = e.phone AND DATE(q2.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 3
                                                                    ) q3 ON q3.phone = e.phone AND DATE(q3.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 4
                                                                    ) q4 ON q4.phone = e.phone AND DATE(q4.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 5
                                                                    ) q5 ON q5.phone = e.phone AND DATE(q5.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 6
                                                                    ) q6 ON q6.phone = e.phone AND DATE(q6.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 7
                                                                    ) q7 ON q7.phone = e.phone AND DATE(q7.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 8
                                                                    ) q8 ON q8.phone = e.phone AND DATE(q8.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 9
                                                                    ) q9 ON q9.phone = e.phone AND DATE(q9.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 10
                                                                    ) q10 ON q10.phone = e.phone AND DATE(q10.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 11
                                                                    ) q11 ON q11.phone = e.phone AND DATE(q11.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 12
                                                                    ) q12 ON q12.phone = e.phone AND DATE(q12.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 13
                                                                    ) q13 ON q13.phone = e.phone AND DATE(q13.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 14
                                                                    ) q14 ON q14.phone = e.phone AND DATE(q14.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 15
                                                                    ) q15 ON q15.phone = e.phone AND DATE(q15.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 16
                                                                    ) q16 ON q16.phone = e.phone AND DATE(q16.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 17
                                                                    ) q17 ON q17.phone = e.phone AND DATE(q17.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 18
                                                                    ) q18 ON q18.phone = e.phone AND DATE(q18.created_at) = DATE(e.created_at)


                                                                    WHERE DATE(e.created_at) = CURDATE()
                                                                    ORDER BY e.created_at DESC';

                $data['query_for_download_avg_data_by_date'] = 'SELECT 
                                                                        ROUND(AVG(q1.score_awarded), 2) AS q1_avg,
                                                                        ROUND(AVG(q2.score_awarded), 2) AS q2_avg,
                                                                        ROUND(AVG(q3.score_awarded), 2) AS q3_avg,
                                                                        ROUND(AVG(q4.score_awarded), 2) AS q4_avg,
                                                                        ROUND(AVG(q5.score_awarded), 2) AS q5_avg,
                                                                        ROUND(AVG(q6.score_awarded), 2) AS q6_avg,
                                                                        ROUND(AVG(q7.score_awarded), 2) AS q7_avg,
                                                                        ROUND(AVG(q8.score_awarded), 2) AS q8_avg,
                                                                        ROUND(AVG(q9.score_awarded), 2) AS q9_avg,
                                                                        ROUND(AVG(q10.score_awarded), 2) AS q10_avg,
                                                                        ROUND(AVG(q11.score_awarded), 2) AS q11_avg,
                                                                        ROUND(AVG(q12.score_awarded), 2) AS q12_avg,
                                                                        ROUND(AVG(q13.score_awarded), 2) AS q13_avg,
                                                                        ROUND(AVG(q14.score_awarded), 2) AS q14_avg,
                                                                        ROUND(AVG(q15.score_awarded), 2) AS q15_avg,
                                                                        ROUND(AVG(q16.score_awarded), 2) AS q16_avg,
                                                                        ROUND(AVG(q17.score_awarded), 2) AS q17_avg,
                                                                        ROUND(AVG(q18.score_awarded), 2) AS q18_avg,
                                                                        
                                                                        ROUND(AVG(e.obtain_marks), 2) AS avg_total_score,
                                                                        ROUND(AVG(e.percentage), 2) AS avg_percentage

                                                                    FROM tbl_a1d_evaluation e

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 1
                                                                    ) q1 ON q1.phone = e.phone AND DATE(q1.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 2
                                                                    ) q2 ON q2.phone = e.phone AND DATE(q2.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 3
                                                                    ) q3 ON q3.phone = e.phone AND DATE(q3.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 4
                                                                    ) q4 ON q4.phone = e.phone AND DATE(q4.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 5
                                                                    ) q5 ON q5.phone = e.phone AND DATE(q5.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 6
                                                                    ) q6 ON q6.phone = e.phone AND DATE(q6.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 7
                                                                    ) q7 ON q7.phone = e.phone AND DATE(q7.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 8
                                                                    ) q8 ON q8.phone = e.phone AND DATE(q8.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 9
                                                                    ) q9 ON q9.phone = e.phone AND DATE(q9.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 10
                                                                    ) q10 ON q10.phone = e.phone AND DATE(q10.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 11
                                                                    ) q11 ON q11.phone = e.phone AND DATE(q11.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 12
                                                                    ) q12 ON q12.phone = e.phone AND DATE(q12.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 13
                                                                    ) q13 ON q13.phone = e.phone AND DATE(q13.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 14
                                                                    ) q14 ON q14.phone = e.phone AND DATE(q14.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 15
                                                                    ) q15 ON q15.phone = e.phone AND DATE(q15.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 16
                                                                    ) q16 ON q16.phone = e.phone AND DATE(q16.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 17
                                                                    ) q17 ON q17.phone = e.phone AND DATE(q17.created_at) = DATE(e.created_at)

                                                                    LEFT JOIN (
                                                                        SELECT phone, score_awarded, created_at FROM tbl_qa_evaluation WHERE question_id = 18
                                                                    ) q18 ON q18.phone = e.phone AND DATE(q18.created_at) = DATE(e.created_at)


                                                                    WHERE DATE(e.created_at) = CURDATE()';
                
            }

            //$data = $this->common->qa_list_lib($from_date, $to_date);
            $data['title']       = "QA Client Leads";
            $data['view_module'] = "admin";
            $data['view_files']  = "qa_reports";
            $this->load->module("templates");
            $this->templates->admin($data);
    }



   




    public function evaluated_leads()
    {
        
              $user_type = $this->session->userdata('user_type_a1d_qa');
                $password_change = $this->session->userdata('password_change');

        if ($password_change == "0" ) {
            redirect('admin/change_password');
        }

        if ($user_type == '') {
            redirect('admin/login');
        }
        elseif($user_type != 'Administrator' && $user_type != 'QA Evaluator' && $user_type != 'QA Manager' && $user_type != 'LMS Manager')
        {
            redirect('admin/page_not_found');
        }
            $search     = $this->input->post('search');
            $from_date  = $this->input->post('from_date');
            $to_date1   = $this->input->post('to_date');
            $center     = $this->input->post('center');
            $client     = $this->input->post('client');
            $state      = $this->input->post('state');
            $agents     = $this->input->post('agents');
            
            if($to_date1 == '')
            {
                $to_date = date('Y-m-d');
            }
            else{
                $to_date = $to_date1;
            }
                $data['agents'] = get_query_data('SELECT * FROM `tbl_users` WHERE status="Active" and user_type="CSR"');
                //$data['agents'] = get_query_data('SELECT lo FROM `tbl_clients` WHERE 1');
              
            if($search == 'Search'){

                //Returned Code
                if ($agents=='all') {
                   $agent_where = '';
                }else{
                   $agent_where = "AND D.employee_id='".$agents."'"; 
                }
                
                 if ($client=='all') {
                   $client_where = '';
                }else{
                   $client_where = "AND S.client='".$client."'"; 
                }
             
                // $data['fetch_leads'] = get_query_data('SELECT R.lead_id,R.percentage, E.employee_name as agent_name, D.employee_id as agent_ein, E.center, S.first_name as c_firstname, S.last_name as c_lastname, S.phone, S.client,S.lo, D.created_at as lead_date, R.total_score, R.qa_lead_status, R.evaluator_id, R.created_at as evaluation_date 
                //                                        FROM `tbl_qa_result` as R 
                //                                        JOIN tbl_solar_lead_data as S on S.lead_id = R.lead_id 
                //                                        JOIN tbl_disposition as D on D.id = S.disposition_id 
                //                                        JOIN employee_data as E on E.ein = D.employee_id 
                //                                        where date(R.created_at) 
                //                                        Between "'.$from_date.'" AND "'.$to_date.'"  '.$agent_where.' '.$client_where.' ORDER BY R.created_at DESC');

                $data['fetch_leads'] = get_query_data('SELECT 
                                                                R.campaign,
                                                                R.phone,
                                                                R.percentage,
                                                                R.qa_lead_status,
                                                                R.created_at AS evaluation_date,
                                                                A.lo,
                                                                E.employee_name
                                                            FROM tbl_qa_result AS R
                                                            JOIN tbl_a1d_evaluation AS A 
                                                                ON A.phone = R.phone
                                                                AND DATE(A.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'"
                                                            JOIN employee_data AS E 
                                                                ON E.ein = R.evaluator_id
                                                            WHERE DATE(R.created_at) BETWEEN "'.$from_date.'" AND "'.$to_date.'" 
                                                              '.$agent_where.' 
                                                              '.$client_where.'
                                                            ORDER BY R.created_at DESC;
                                                            ');


                $data['leads_count'] = get_query_data('SELECT count(*) as cnt 
                                                        FROM `tbl_qa_result` as R 
                                                        where date(R.created_at) 
                                                        Between "'.$from_date.'" AND "'.$to_date.'" '.$agent_where.' '.$client_where.'');

            }
            else{
                

                $data['fetch_leads'] = get_query_data('SELECT R.campaign, R.phone, R.percentage, R.qa_lead_status, R.created_at AS evaluation_date, A.lo, E.employee_name FROM tbl_qa_result AS R JOIN tbl_a1d_evaluation AS A ON A.phone = R.phone AND A.created_at >= CURDATE() AND A.created_at < CURDATE() + INTERVAL 1 DAY JOIN employee_data AS E ON E.ein = R.evaluator_id WHERE R.created_at >= CURDATE() AND R.created_at < CURDATE() + INTERVAL 1 DAY ORDER BY R.created_at DESC');


                $data['leads_count'] = get_query_data('SELECT count(*) as cnt FROM `tbl_qa_result` as R where date(R.created_at) = CURDATE()');            

            }


            $data['title']       = "Evaluated Leads";
            $data['view_module'] = "admin";
            $data['view_files']  = "evaluated_leads";
            $this->load->module("templates");
            $this->templates->admin($data);
    }


    public function evaluate_lead($lead_id='')
    {
            $user_type = $this->session->userdata('user_type_a1d_qa');
              if ($user_type == '') {
                    redirect('admin/login');
                }
                elseif($user_type != 'Administrator' && $user_type != 'QA Evaluator' && $user_type != 'QA Manager' && $user_type != 'LMS Manager')
                {
                    redirect('admin/page_not_found');
                }

            //Add QA Lead
                // $phone = $this->input->post('search_phone');
                // echo $phone;
                // exit();

            
            $decode_lead_id = trim(decode_id($lead_id));

            $l_id    = 'tbl_solar_lead_data.phone = "'.$decode_lead_id.'"';

            

            $s_phone = $this->input->post('search_phone');

            if (!empty($s_phone)) {
                // echo "I am here";
                // exit();
                date_default_timezone_set('America/New_York');
                $today = date('Y-m-d');
                $this->db->where('phone', $s_phone);
                $this->db->like('created_at', $today); // Assuming there's a 'created_at' timestamp column
                $already_evaluated = $this->db->get('tbl_a1d_evaluation')->row();

                if ($already_evaluated) {
                    $this->session->set_flashdata('error_msg', 'This lead has already been evaluated today.');
                    redirect('admin/qa_list'); // Or wherever you want to redirect
                }
            }

            //Getting info from form
            $submit_evaluation  = $this->input->post('submit_QA');    
            
            
            if ($submit_evaluation === 'Submit QA Lead') {

                //Getting hidden values from Search
                // $l_camp  = $this->input->post('campaign');

                $phone = $this->input->post('phone');
                $campaign = $this->input->post('campaign');
                $lo      = $this->input->post('lo');
                // echo $phone;
                // echo $campaign;
                // exit();

                
                for ($i = 1; $i <= 18; $i++) {
                    $question_id = $this->input->post('question_' . $i); 
                    $score       = $this->input->post('answer_' . $i); 
                    $qa_remarks  = $this->input->post('remarks_' . $i);

                    // Handle checkbox (array) scores like Question 7
                    if (is_array($score)) {
                        $score = array_sum($score); 
                    }

                    // echo $phone;
                    // echo $campaign;
                    // exit();
                    
                    if (!empty($question_id)) {
                        $insert_marks = array(
                            'lead_id'       => $decode_lead_id,
                            'phone'         => $phone,
                            'campaign'      => $campaign, 
                            'question_id'   => $question_id,
                            'score_awarded' => $score ?? 0,
                            'qa_remarks'    => $qa_remarks ?? ''
                        );


                        
                        save_data('tbl_qa_evaluation', $insert_marks);
                    }
                }

                $this->form_validation->set_rules('obtain_marks', 'Obtain Marks', 'trim|required');
                $this->form_validation->set_rules('total_score', 'Total Score', 'trim|required');
                $this->form_validation->set_rules('avg_score', 'Percentage', 'trim|required');
                $this->form_validation->set_rules('score_rating', 'Score Rating', 'trim|required');
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
                $this->form_validation->set_rules('campaign', 'Campaign', 'trim|required');
                if ($this->form_validation->run() === true) {
                    $this->image_config('recordings');
                    $total_score  = $this->input->post('total_score');
                    $obtain_marks  = $this->input->post('obtain_marks');
                    $avg_score  = $this->input->post('avg_score');
                    $score_rating = $this->input->post('score_rating');
                    $grade = $this->input->post('grade');
                    $comments     = $this->input->post('comments');
                    $phone = $this->input->post('phone');
                    $campaign = $this->input->post('campaign');

                    if ($this->upload->do_upload('upload_recording')) {
                        $filename = $this->upload->data();
                        $new_name = $filename['file_name'];
                        $insert_eval['recording'] = $new_name;
                    } else {
                        $insert_eval['recording'] = ''; // or NULL
                    }

                    $insert_total_score = array(
                                'lead_id'       => $decode_lead_id,
                                'campaign'      => $campaign, 
                                'phone'         => $phone,
                                'evaluator_id'  => $this->session->userdata('ein'),
                                'obtain_marks'  => $obtain_marks,
                                'total_score'   => $total_score,
                                'percentage'    => $avg_score,
                                'qa_lead_status'=> $score_rating,
                                'qa_comment'    => $comments

                    );

                    //Sending data to tbl_a1d_evaluation
                    $insert_eval = array(
                        'phone'                => $phone,
                        'lo'                   => $lo,
                        'obtain_marks'         => $obtain_marks,
                        'total_score'          => $total_score,
                        'percentage'           => $avg_score,
                        'grade'                => $grade,
                        'evaluator_id'         => $this->session->userdata('ein'),
                        'campaign'             => $campaign,
                        'qa_comment'           => $comments
                    );

                    $new_name = $filename['file_name'];
                    $insert_eval['recording'] = 'recordings/' . $filename['file_name'];

                    $update_lead = array(
                            'evaluated_status'  => 1,
                            
                );
                    $update_mort = update_data_by_where('tbl_solar_lead_data', $update_lead, $l_id);

                    save_data('tbl_a1d_evaluation', $insert_eval);

                    $res = save_data('tbl_qa_result', $insert_total_score);
                    if ($res) {
                        $this->session->set_flashdata('success', 'Lead has been Evaluated!');
                            redirect('admin/qa_list');
                    }else{
                        $this->session->set_flashdata('error_msg', 'Evaluated Result Not Inserted because of some error. Please tryagain!');
                        redirect('admin/evaluate_lead/'.$lead_id.'');
                    }
                    
                } else {
                    $this->session->set_flashdata('error_msg', validation_errors());
                    redirect('admin/evaluate_lead/'.$lead_id.'');
                }
            }

            // END QA Lead
             
            $l_id    = 'S.lead_id = "'.$decode_lead_id.'"';
            $l_phone = 'S.phone = "'.$decode_lead_phone.'"';

            $data['lo_list']   = get_query_data('SELECT lo FROM tbl_clients where status = 1 order by lo ASC');
            $data['questions'] = get_query_data('SELECT * FROM qa_questions where status = 1');
            $data['lead_data'] = get_query_data('SELECT *,S.email as customer_email FROM tbl_solar_lead_data as S JOIN tbl_disposition as D on D.id = S.disposition_id JOIN employee_data as U on U.ein = D.employee_id WHERE (D.disposition = "Live Transfer" or D.disposition = "Posted") AND '.$l_id.' AND D.status = 1');
            
            //For search phone
            $submit_search = $this->input->post('submit_form_button');
            
            //Checking whether data submitted was from Search Form or QA Form
            if ($submit_search  === 'Submit Search Form') {
                $data['search_phone']  = $s_phone; 
                $data['campaign_name'] = "A1D-External";
            }else{
                $phone = $data['lead_data']->phone; //[0] was written here
                $data['campaign_name'] = "A1D-DM";
            }

            $data['title']       = "Evaluate Lead";
            $data['view_module'] = "admin";
            $data['view_files']  = "evaluate_lead";
            $this->load->module("templates");
            $this->templates->admin($data);
    }
        public function edit_evaluation($lead_id='', $phone='')
        {
             $user_type = $this->session->userdata('user_type_a1d_qa');
              if ($user_type == '') {
                redirect('admin/login');
                }
                elseif($user_type != 'Administrator' && $user_type != 'QA Manager' && $user_type != 'LMS Manager')
                {
                    redirect('admin/page_not_found');
                }
            
            //Getting info from Evaluated Leads
            $decode_lead_id = trim(decode_id($lead_id));
            
            $l_id = 'tbl_solar_lead_data.lead_id = "'.$decode_lead_id.'"';


            $submit_evaluation = $this->input->post('Update_QA');

            if ($submit_evaluation === 'Update QA Lead') {

                //Getting values for tbl_a1d_evaluation
               
                for ($i=1;$i<=18;$i++) {
                    $questionNumber     ='question_'.$i;
                    $scoreAwardedNumber ='answer_'.$i;
                    $questionRemarks    ='remarks_'.$i;
            
                    $question_id = $this->input->post($questionNumber);
                    $score       = $this->input->post($scoreAwardedNumber);
                    $qa_remarks  = $this->input->post($questionRemarks);
                    if (is_array($score)) {
                        $score = reset($score); // get first value
                    }
                    $score = (int) $score; // cast to integer
                
                    $update_marks = array(
                            'score_awarded' => $score,
                            'qa_remarks'    => $qa_remarks
                    );
                    
                    update_data_by_where('tbl_qa_evaluation', $update_marks, 'phone = "'.$decode_lead_id.'" and question_id='.$question_id.'');
                }

                $this->form_validation->set_rules('obtain_marks', 'Obtain Marks', 'trim|required');
                $this->form_validation->set_rules('total_score', 'Total Score', 'trim|required');
                $this->form_validation->set_rules('avg_score', 'Percentage', 'trim|required');
                $this->form_validation->set_rules('score_rating', 'Score Rating', 'trim|required');
                if ($this->form_validation->run() === true) {
                    // $total_score  = $this->input->post('total_score');
                    $this->image_config('recordings');
                    $score_rating = $this->input->post('score_rating');
                    $comments     = $this->input->post('comments');
                    $total_score  = $this->input->post('total_score');
                    $obtain_marks  = $this->input->post('obtain_marks');
                    $grade  = $this->input->post('grade');
                    $avg_score  = $this->input->post('avg_score');

                    $update_total_score = array(
                                'obtain_marks'         => $obtain_marks,
                                'total_score'          => $total_score,
                                'percentage'           => $avg_score,
                                'qa_lead_status'=> $score_rating,
                                'qa_comment'    => $comments

                    );
                    //Saving values in A1D Evaluation Table
                    $update_eval = array(
                        
                        'grade'         => $grade,
                        'obtain_marks'         => $obtain_marks,
                        'total_score'          => $total_score,
                        'percentage'           => $avg_score,
                        'qa_comment'           => $comments
                    );


                    if ($this->upload->do_upload('upload_recording')) {
                        $filename = $this->upload->data();
                        $new_name = $filename['file_name'];
                        $update_eval['recording'] = $new_name;
                    } else {
                        $update_eval['recording'] = ''; // or NULL
                    }


                   
                    
                    update_data_by_where('tbl_a1d_evaluation', $update_eval, 'phone = "'.$decode_lead_id.'"');

                    //Saving values in QA Results Table
                    $res = update_data_by_where('tbl_qa_result', $update_total_score, 'phone = "'.$decode_lead_id.'"');
                    
                    if ($res) {
                        $this->session->set_flashdata('error_msg', 'Evaluated Result Not updated because of error. Please tryagain!');
                        redirect('admin/evaluate_lead/'.$decode_lead_id.'');
                    } else{
                        $this->session->set_flashdata('success', 'Evaluation has been updated.');
                            redirect('admin/evaluated_leads');

                    }
                } else {
                    $this->session->set_flashdata('error_msg', validation_errors());
                    redirect('admin/evaluate_lead/'.$decode_lead_id.'');
                }
            }
            // END QA Lead

            $l_id = 'S.lead_id = "'.$decode_lead_id.'"';
            $l_phone = $decode_lead_id; //echo $l_phone;exit();
            
            $data['questions'] = get_query_data('SELECT * FROM qa_questions where status = 1');
            $data['scores']    = get_query_data("SELECT * FROM tbl_qa_evaluation WHERE status = 1");
            $scores1 = get_query_data("SELECT * FROM tbl_qa_evaluation WHERE phone = '$l_phone'");
            $data['scores1'] = $scores1;
            $qaRemarks7 = [];

            foreach ($scores1 as $row) {
                if ($row->question_id == 18 && !empty($row->qa_remarks)) {
                    $qaRemarks18 = array_map('trim', explode(', ', $row->qa_remarks));
                    break; // Stop loop after finding question_id 7
                }
            }

            $data['qaRemarks18'] = $qaRemarks18;
            $data['qa_result']     = get_query_data('SELECT * FROM tbl_a1d_evaluation where phone = "'.$l_phone.'"');


            $data['title']       = "Edit Evaluation";
            $data['view_module'] = "admin";
            $data['view_files']  = "edit_evaluation";
            $this->load->module("templates");
            $this->templates->admin($data);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        public function view_evaluation($lead_id)
        {
                 $user_type = $this->session->userdata('user_type_a1d_qa');
                  if ($user_type == '') {
                    redirect('admin/login');
                    }
                    elseif($user_type != 'Administrator' && $user_type != 'QA Manager' && $user_type != 'LMS Manager')
                    {
                        redirect('admin/page_not_found');
                    }
                
                //Getting info from Evaluated Leads
                $decode_lead_id = trim(decode_id($lead_id));
                // $decode_lead_id = trim($lead_id);

                
                
                $l_phone = $decode_lead_id; //echo $l_phone;exit();
                
                $data['questions'] = get_query_data('SELECT * FROM qa_questions where status = 1');
                $data['scores']    = get_query_data("SELECT * FROM tbl_qa_evaluation WHERE phone = '$l_phone'");
                $data['qa_result1']    = get_query_data("SELECT * FROM tbl_qa_result WHERE phone = '$l_phone'");
                $scores1 = get_query_data("SELECT * FROM tbl_qa_evaluation WHERE phone = '$l_phone'");
                $data['scores1'] = $scores1;
                $qaRemarks7 = [];

                foreach ($scores1 as $row) {
                    if ($row->question_id == 18 && !empty($row->qa_remarks)) {
                        $qaRemarks18 = array_map('trim', explode(', ', $row->qa_remarks));
                        break; // Stop loop after finding question_id 7
                    }
                }

                $data['qaRemarks18'] = $qaRemarks18;
                
                    $data['qa_result']     = get_query_data('SELECT * FROM tbl_a1d_evaluation where phone = "'.$l_phone.'"');


                $data['title']       = "View Evaluation";
                $data['view_module'] = "admin";
                $data['view_files']  = "view_evaluation";
                $this->load->module("templates");
                $this->templates->admin($data);
        }



////////////////////////////////////////////////////// QA Section ////////////////////////////////////////////////////////////////////







}