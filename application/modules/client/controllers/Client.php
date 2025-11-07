<?php
class Client extends MX_Controller 
{

function __construct() {
parent::__construct();

$this->load->model('mdl_client');
}

public function index()
{
    $user_type = $this->session->userdata('access_level_1');
    if($user_type == 'Client' || $user_type == 'AE')
    {

    $data['title'] = "Dashboard";
    $data['view_module'] = "client";
    $data['view_files'] = "index";
    $this->load->module("templates");
    $this->templates->admin($data);

    }
    elseif ($user_type == '') {
        redirect('client/login');
    }
    elseif ($user_type != 'Client') {
        redirect('client/page_not_found');
    }
}

public function page_not_found()
{

    $data['title'] = "404";
    $data['view_module'] = "client";
    $data['view_files'] = "page_not_found";
    $this->load->module("templates");
    $this->templates->admin($data);

}

public function login()
{


    $this->load->view('client/login');

}



public function logout()
{
    $this->session->sess_destroy();
      redirect('client/login', 'refresh');
}









   public function qa_clients_leads()
    {
        $user_type       = $this->session->userdata('user_type_a1d_qa');
        $access_level = $this->session->userdata('access_level_1');
        $password_change = $this->session->userdata('password_change');
       
        if ($password_change == "0" ) {
            redirect('admin/change_password');
        }

        if ($user_type == '') {
            redirect('admin/login');
        }
        elseif($user_type != 'Administrator' && $access_level != 'Client')
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
            $data['view_module'] = "client";
            $data['view_files']  = "qa_clients_leads";
            $this->load->module("templates");
            $this->templates->admin($data);
    }


    public function qa_reports()
    {
        $user_type       = $this->session->userdata('user_type_a1d_qa');
        $access_level = $this->session->userdata('access_level_1');
        $password_change = $this->session->userdata('password_change');
       
        if ($password_change == "0" ) {
            redirect('admin/change_password');
        }

        if ($user_type == '') {
            redirect('admin/login');
        }
        elseif($user_type != 'Administrator' && $access_level != 'Client' )
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
            $data['view_module'] = "client";
            $data['view_files']  = "qa_reports";
            $this->load->module("templates");
            $this->templates->admin($data);
    }








 public function view_evaluation($lead_id)
        {
                 $user_type = $this->session->userdata('user_type_a1d_qa');
                 $access_level = $this->session->userdata('access_level_1');
                  if ($user_type == '') {
                    redirect('admin/login');
                    }
                    elseif($user_type != 'Administrator' && $access_level != 'Client')
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
                $data['view_module'] = "client";
                $data['view_files']  = "view_evaluation";
                $this->load->module("templates");
                $this->templates->admin($data);
        }






public function download_qa_report()
{

$user_type = $this->session->userdata('access_level_1');;
    if($user_type == 'Administrator' || $user_type == 'Client')
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

$user_type = $this->session->userdata('access_level_1');;
    if($user_type == 'Administrator' || $user_type == 'Client')
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












}