<?php
class Api extends MX_Controller 
{

function __construct() {
parent::__construct();

$this->load->model('mdl_api');
}

public function index()
{

   
    $data['title'] = "Dashboard";
    $data['view_module'] = "admin";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->admin($data);
}




public function client_api(){
    $token_id = '32tunbgyeiytGYUTW86G^Fj^vYRWHhuj358bHGRCTIOYT';
    $client = 'EL';
    $token = post('token');
    $client_id = post('client_id');
    
    $first_name = post('first_name');
    $last_name = post('last_name');
    $phone = post('phone');
    // $mobile_phone = post('mobile_phone');
    $email = post('email');
    $address = post('address');
    $city = post('city');
    $state = post('state');
    $zip_code = post('zip_code');

    $county = post('county');
    $country = post('country');
    $trusted_form_cert_id = post('trusted_form_cert_id');
    $ip_address = post('ip_address');
    $post_response = post('post_response');
    $created_on = post('created_on');
    $source_url = post('source_url');
    $strategy = post('strategy');
    $DataType = post('DataType');

    $get_agent_id = get_query_data('SELECT ein FROM tbl_users where status = "Active" AND user_type = "CSR" AND agent_status = "Available" ORDER BY rand() LIMIT 1');

    $agent_id = $get_agent_id[0]->ein;
    if($agent_id != '')
    {
        $assign_to_agent = $agent_id;
    }   
    else{
        $assign_to_agent = 1;
    } 


    if($token != $token_id)
    {
         echo e_response('Something wrong with Token. Please check it or contact to FSC.');   
    }else{
        if($client_id != $client)
        {
            echo e_response('Something wrong with Client ID.'); 
        }
        else{
                if( if_empty($token) || if_empty($phone) || if_empty($first_name) || if_empty($client_id)){
        echo e_response('phone number, first_name, client ID fields are required.');
    }else{
        $where = "phone='".$phone."' AND client_id='".$client_id."'";
        $data = select_column_name_by_where('phone','tbl_file_data', $where);

        if($data == true){
            echo e_response('Phone Number already Exists');
        }else{
            $data = array(
                    'client_id' => $client_id,
                    'uploaded_file_id' => 9999,
                    'source_of_data' => 'API',
                    'first_name' => $first_name,
                    'middle_name' => $middle_name,
                    'last_name' => $last_name,
                    'phone' => $phone,
                    'email' => $email,
                    'address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'zip_code' => $zip_code,
                    'county' => $county,
                    'country' => $country,
                    'trusted_form_cert_id' => $trusted_form_cert_id,
                    'ip_address' => $ip_address,
                    'post_response' => $post_response,
                    'created_on' => $created_on,
                    'source_url' => $source_url,
                    'strategy' => $strategy,
                    'DataType' => $DataType,
                    'assign_to' => $assign_to_agent
               

                );
            $result = save_data('tbl_file_data',$data);
            if($result){

                 echo json_encode(array('status' => 'success',
                                 'errorCode' => 0,
                                 'message' => 'Successfully Submitted.',
                                 'data' => $result));
            }
            else{
                echo json_encode(array('status' => 'error',
                                 'errorCode' => 1,
                                 'message' => 'Something went Wrong! Data Not Added.',
                                 'data' => $result));
            }
        }
    }

        }
    


}


}



public function report_card()
{

    // Allow all domains
        header("Access-Control-Allow-Origin: *");
        
        // Additional headers for handling preflight requests and other settings
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        $request = json_decode(file_get_contents('php://input'), true);
        $token = "80258891-inyn-3833-zj5e-6720775fb292";
         $start_date = $request['startDatec'];
         $end_date = $request['endDatec'];
         $api_key = $request['api_key'];


         if ($api_key != $token) {



            $sampleData = [
            [
                'error' => 'Something wrong with Token. Please check it or contact to FSC.',
            ],
        ];

            

             echo json_encode($sampleData);
         } else {


                  if ($start_date != '' && $end_date !='') {
                    $date_filter = 'date(created_at) Between "'.$start_date.'" AND "'.$end_date.'"';
                    
                     }else
                     {
                         $date_filter = 'date(created_at) = CURDATE()';
                     }

                     $sales_count = get_query_data('SELECT SUM(actual_leads) as total_leads, SUM(lead_count) as leads FROM `tbl_reports` where disposition = "Live Transfer" AND '.$date_filter.' ');

                     $total_sales = $sales_count[0]->leads;

                     if ($total_sales == "") {
                          $total_sales = 00;
                     } 
                     

                     
                
                
                  

                    $sampleData = [
                        [
                            'A1DSales' => $total_sales,
                        ],
                        
                    ];

                    echo json_encode($sampleData);


         }
         

       

         

}


public function top_agents()
{

    // Allow all domains
        header("Access-Control-Allow-Origin: *");
        
        // Additional headers for handling preflight requests and other settings
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        $request = json_decode(file_get_contents('php://input'), true);
        $token = "80258891-inyn-3833-zj5e-6720775fb292";
         $start_date = $request['startDatec'];
         $end_date = $request['endDatec'];
         $api_key = $request['api_key'];


         if ($api_key != $token) {



            $sampleData = [
            [
                'error' => 'Something wrong with Token. Please check it or contact to FSC.',
            ],
        ];

            

             echo json_encode($sampleData);
         } else {


                  if ($start_date != '' && $end_date !='') {
                    $date_filter = 'date(created_at) Between "'.$start_date.'" AND "'.$end_date.'"';
                    
                     }else
                     {
                         $date_filter = 'date(created_at) = CURDATE()';
                     }

                     $top_agents = get_query_data('SELECT COUNT(actual_leads) as total_leads, E.employee_name FROM `tbl_reports` as R JOIN employee_data as E on E.ein = R.agent_id where disposition = "Live Transfer" AND '.$date_filter.' GROUP BY agent_id order by total_leads DESC');

                     // $agent_sales = $top_agents[0]->total_leads;
                     // $employee_name = $top_agents[0]->employee_name;

                    $agentData = [];

                    foreach ($top_agents as $agent) {
                        $agentData[] = [
                            'AgentName' => $agent->employee_name,
                            'AgentSales' => $agent->total_leads,
                        ];
                    }

                    echo json_encode($agentData);


         }
         

       

         

}

public function hour_info()
{

    // Allow all domains
        header("Access-Control-Allow-Origin: *");
        
        // Additional headers for handling preflight requests and other settings
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        $request = json_decode(file_get_contents('php://input'), true);
        $token = "80258891-inyn-3833-zj5e-6720775fb292";
         $start_date = $request['startDatec'];
         $end_date = $request['endDatec'];
         $api_key = $request['api_key'];


         if ($api_key != $token) {



            $sampleData = [
            [
                'error' => 'Something wrong with Token. Please check it or contact to FSC.',
            ],
        ];

            

             echo json_encode($sampleData);
         } else {


                  if ($start_date != '' && $end_date !='') {
                    $date_filter = 'date(created_at) Between "'.$start_date.'" AND "'.$end_date.'"';
                    
                     }else
                     {
                         $date_filter = 'date(created_at) = CURDATE()';
                     }

                     $hour_stats = get_query_data('SELECT HOUR(created_at) as FromHour, COUNT(actual_leads) as total_leads FROM `tbl_reports` where disposition = "Live Transfer" AND '.$date_filter.' GROUP BY HOUR(created_at)');

                     // $agent_sales = $top_agents[0]->total_leads;
                     // $employee_name = $top_agents[0]->employee_name;

                    $hourData = [];

                    foreach ($hour_stats as $hour) {
                        $hourData[] = [
                            'Hour' => $hour->FromHour,
                            'lead_count' => $hour->total_leads,
                        ];
                    }

                    echo json_encode($hourData);


         }
         

       

         

}

public function states_info()
{

    // Allow all domains
        header("Access-Control-Allow-Origin: *");
        
        // Additional headers for handling preflight requests and other settings
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        $request = json_decode(file_get_contents('php://input'), true);
        $token = "80258891-inyn-3833-zj5e-6720775fb292";
         $start_date = $request['startDatec'];
         $end_date = $request['endDatec'];
         $api_key = $request['api_key'];


         if ($api_key != $token) {



            $sampleData = [
            [
                'error' => 'Something wrong with Token. Please check it or contact to FSC.',
            ],
        ];

            

             echo json_encode($sampleData);
         } else {


                  if ($start_date != '' && $end_date !='') {
                    $date_filter = 'date(created_at) Between "'.$start_date.'" AND "'.$end_date.'"';
                    
                     }else
                     {
                         $date_filter = 'date(created_at) = CURDATE()';
                     }

                     $top_states = get_query_data('SELECT COUNT(actual_leads) as total_leads, states FROM `tbl_reports` where disposition = "Live Transfer"  AND '.$date_filter.' GROUP BY states order by total_leads DESC');

                     // $agent_sales = $top_agents[0]->total_leads;
                     // $employee_name = $top_agents[0]->employee_name;

                    $statesData = [];

                    foreach ($top_states as $states) {
                        $statesData[] = [
                            'State' => $states->states,
                            'lead_count' => $states->total_leads,
                        ];
                    }

                    echo json_encode($statesData);


         }
         

       

         

}



public function top_clients()
{

    // Allow all domains
        header("Access-Control-Allow-Origin: *");
        
        // Additional headers for handling preflight requests and other settings
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        $request = json_decode(file_get_contents('php://input'), true);
        $token = "80258891-inyn-3833-zj5e-6720775fb292";
         $start_date = $request['startDatec'];
         $end_date = $request['endDatec'];
         $api_key = $request['api_key'];


         if ($api_key != $token) {



            $sampleData = [
            [
                'error' => 'Something wrong with Token. Please check it or contact to FSC.',
            ],
        ];

            

             echo json_encode($sampleData);
         } else {


                  if ($start_date != '' && $end_date !='') {
                    $date_filter = 'date(created_at) Between "'.$start_date.'" AND "'.$end_date.'"';
                    
                     }else
                     {
                         $date_filter = 'date(created_at) = CURDATE()';
                     }

                     
                     $top_clients = get_query_data('SELECT COUNT(actual_leads) as total_leads, client_name FROM `tbl_reports` where disposition = "Live Transfer"  AND '.$date_filter.' GROUP BY client_name');

                     // $agent_sales = $top_agents[0]->total_leads;
                     // $employee_name = $top_agents[0]->employee_name;

                    $clientData = [];

                    foreach ($top_clients as $clients) {
                        $clientData[] = [
                            'Client' => $clients->client_name,
                            'lead_count' => $clients->total_leads,
                        ];
                    }

                    echo json_encode($clientData);


         }
         

       

         

}



public function returns()
{

    // Allow all domains
        header("Access-Control-Allow-Origin: *");
        
        // Additional headers for handling preflight requests and other settings
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        $request = json_decode(file_get_contents('php://input'), true);
        $token = "80258891-inyn-3833-zj5e-6720775fb292";
         $start_date = $request['startDatec'];
         $end_date = $request['endDatec'];
         $api_key = $request['api_key'];


         if ($api_key != $token) {



            $sampleData = [
            [
                'error' => 'Something wrong with Token. Please check it or contact to FSC.',
            ],
        ];

            

             echo json_encode($sampleData);
         } else {


                  if ($start_date != '' && $end_date !='') {
                    $date_filter = 'date(created_at) Between "'.$start_date.'" AND "'.$end_date.'"';
                    
                     }else
                     {
                         $date_filter = 'date(created_at) = CURDATE()';
                     }

                     
                     $returns = get_query_data('SELECT SUM(actual_leads) as total_leads FROM `tbl_reports` where disposition = "Returned" AND '.$date_filter.' order by total_leads DESC');

                     // $agent_sales = $top_agents[0]->total_leads;
                     // $employee_name = $top_agents[0]->employee_name;

                    $returnData = [];

                    foreach ($returns as $returns) {
                        $returnData[] = [
                            
                            'lead_count' => $returns->total_leads,
                        ];
                    }

                    echo json_encode($returnData);


         }
         

       

         

}











































}