

            <div class="boxed">
                <!--CONTENT CONTAINER-->
                <!--===================================================-->
                <div id="content-container">
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div class="pageheader hidden-xs">
                        <!-- <h3><i class="fa fa-home"></i><?php echo $title; ?> </h3>
                        <div class="breadcrumb-wrapper">
                            <span class="label">You are here:</span>
                            <ol class="breadcrumb">
                                <li> <a href="#"> Home </a> </li>
                                <li class="active"><?php echo $title; ?> </li>
                            </ol>
                        </div> -->
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->
                    <!--Page content-->
                    <!--===================================================-->
                    <div id="pagecontent">
                        <div class="row">
                            <div class="col-md-12">
                                    
                                <section class="panel" style="padding: 20px;">
                                    <div class="panel-body np">
                                        <!-- START Form Wizard -->
                                                      <?php 
                                     if($this->session->flashdata("error_msg") != ''){?>
                                     <div class="alert alert-danger">
                                         <button class="close" data-dismiss="alert"></button>
                                         <?php echo $this->session->flashdata("error_msg");?>
                                     </div>
                                  <?php
                                    }
                                  ?>
                                  <?php 
                                     if($this->session->flashdata("success") != ''){?>
                                     <div class="alert alert-success">
                                         <button class="close" data-dismiss="alert"></button>
                                         <?php echo $this->session->flashdata("success");?>
                                     </div>
                                  <?php
                                    }
                                  ?>
                                        <form class="form-horizontal form-bordered" action="<?php echo base_url('admin/qa_clients_leads'); ?>" method="post" id="registrationForm">
                                            <!-- Wizard Container 1 -->
                                            <div class="wizard-container">
                                                <div class="form-group">
                                                    <div class="col-sm-2 offset-sm-2">
                                                        <label class="control-label">Date Range : </label>
                                                        <input id="datefilter" name="datefilter" placeholder="Select Date Range" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                                    </div>
                                                    <div class="col-sm-1 offset-sm-1">
                                                    <label class="control-label"> Client : </label>
                                                          <select class="form-control"  name="client">
                                                            <option value="all">All</option>
                                                            <option value="A1D-DM">A1D-DM</option>
                                                        </select>
                                                    </div>
                                                    
                                                        <div class="col-sm-2 offset-sm-2">
                                                    <label class="control-label"> DS : </label>
                                                        <select class="form-control"  name="agents">
                                                            <option value="all">All</option>
                                                            <?php foreach ($agents as $key => $value) {?>
                                                                <option value="<?php echo $value->lo; ?>"><?php echo $value->lo; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-1">
                                                    <label class="control-label"></label>
                                                         <button type="submit" style="margin-top: 41px;" class="btn btn-success" name="search" value="Search">
                                                        Submit
                                                    </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ END Form Wizard -->

                                        <?php $user_type = $this->session->userdata('user_type_a1d_qa');
                                            if($user_type == 'Administrator' || $user_type == 'LMS Manager'){?>
                                                <div id="page-content">
                                            <div class="row">
                                        <div style="float: right;">
                                        
                                        <!-- Download Button (Standalone) -->
                                        <form action="<?php echo base_url('admin/download_qa_report'); ?>" method="post" style="margin-top: 41px;">
                                            <input type="hidden" name="get_download_query" value="<?php if(isset($query_for_download_data_by_date)){echo encode_id($query_for_download_data_by_date);} ?>">
                                            
                                            <!--<?php //echo $query_for_download_data_by_date ?>-->
                                            <button type="submit" class="btn btn-success" name="download" value="Download">
                                                Download
                                            </button>
                                        </form>
                                        </div>
                                        </div>
                                        </div>
                                         <?php } ?>
                                          
                                      
                                                                                    <!-- Wizard Container 2 -->
                                    <div class="panel-body">
                                        <?php if ($a1d_data != '') { ?>

                                            <?php 
                                                $count = 0;
                                                foreach ($service_count as $service_count):
                                            ?>
                                                <h4 class="m-2" style="float: right;">
                                                    <?php echo $service_count->service_required; ?>: <?php echo $service_count->service_required_cnt ?>
                                                </h4>
                                            <?php endforeach; ?>

                                            <h4 class="m-2" style="float: right;">Total Leads: <?php echo $leads_count[0]->cnt ?> </h4>

                                            <table id="myTable" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                                                <thead style="font-size: 11px;padding: 0px !important;">
                                                    <tr>
                                                        <th>#</th>
                                                        <th class="text-center">DS</th>
                                                        <?php
                                                        foreach ($qa_questions as $result):
                                                            $question = $result->qa_question;
                                                            ?>
                                                        <th data-hide="phone, tablet" title="<?= htmlspecialchars($question) ?>" class="text-center">Q. <?php echo $result->qa_question_id; ?></th>
                                                        <?php endforeach; ?>

                                                        <th data-hide="phone, tablet" class="text-center">Total Score</th>
                                                        <th data-hide="phone, tablet" class="text-center">Percentage</th>
                                                        <th data-hide="phone, tablet" class="text-center">Grade</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="fs-8" style="font-size: 11px; padding: 0px !important;">

                                                   
                                                    <?php 
                                                        $count = 0;
                                                        foreach ($a1d_data as $result):

                                                            
                                                            $count++;

                                                            // Masking Phone Number
                                                            $phone = $result->phone;
                                                            $avg_percentage = $result->avg_percentage;

                                                            if ($avg_percentage >= 97) {
                                                                $avg_grade = 'A+';
                                                                $avg_color = '#4CAF50'; // dark green
                                                            } elseif ($avg_percentage >= 93) {
                                                                $avg_grade = 'A';
                                                                $avg_color = '#66BB6A'; // green
                                                            } elseif ($avg_percentage >= 87) {
                                                                $avg_grade = 'B+';
                                                                $avg_color = '#9CCC65'; // light green
                                                            } elseif ($avg_percentage >= 83) {
                                                                $avg_grade = 'B';
                                                                $avg_color = '#FFEB3B'; // yellow
                                                            } elseif ($avg_percentage >= 77) {
                                                                $avg_grade = 'C+';
                                                                $avg_color = '#FFC107'; // amber
                                                            } elseif ($avg_percentage >= 73) {
                                                                $avg_grade = 'C';
                                                                $avg_color = '#FF9800'; // orange
                                                            } elseif ($avg_percentage >= 67) {
                                                                $avg_grade = 'D+';
                                                                $avg_color = '#FF7043'; // deep orange
                                                            } elseif ($avg_percentage >= 60) {
                                                                $avg_grade = 'D';
                                                                $avg_color = '#F44336'; // red
                                                            } else {
                                                                $avg_grade = 'F';
                                                                $avg_color = '#B71C1C'; // dark red
                                                            }

                                                                                

                                                            
                                                            // Handling file name
                                                            

                                                            // Evaluation Status
                                                            
                                                    ?>
                                                    <tr>
                                                        <td style="padding: 0px !important;"><?php echo $count; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->lo; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q1_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q2_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q3_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q4_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q5_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q6_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q7_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q8_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q9_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q10_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q11_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q12_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q13_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q14_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q15_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q16_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q17_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->q18_avg; ?></td>
                                                        
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->avg_total_score; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;background-color: <?php echo $avg_color;?>"><?php echo $result->avg_percentage; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;background-color: <?php echo $avg_color;?>"><?php echo $avg_grade; ?></td>
                                                        

                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>

                                        <?php } ?>
                                    </div>



                                    <div class="panel-body">
                                        <?php if ($a1d_data_1 != '') { ?>

                                            <?php 
                                                $count = 0;
                                                foreach ($service_count as $service_count):
                                            ?>
                                                <h4 class="m-2" style="float: right;">
                                                    <?php echo $service_count->service_required; ?>: <?php echo $service_count->service_required_cnt ?>
                                                </h4>
                                            <?php endforeach; ?>

                                            

                                            <table id="myTable" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <!--<th class="text-center">Phone</th>-->
                                                        <th class="text-center">DS</th>
                                                        <!-- <th class="text-center">Call Opening</th>
                                                        <th data-hide="phone, tablet" class="text-center">Need Identification</th>
                                                        <th data-hide="phone, tablet" class="text-center">Product Service</th>
                                                        <th data-hide="phone, tablet" class="text-center">Compliance Process</th>
                                                        <th data-hide="phone, tablet" class="text-center">Customer Call</th>
                                                        <th data-hide="phone, tablet" class="text-center">Call Close</th>
                                                        <th data-hide="phone, tablet" class="text-center">Total Score</th> -->
                                                        <th data-hide="phone, tablet" class="text-center">Total Leads</th>
                                                        <!-- <th data-hide="phone, tablet" class="text-center">Campaign</th> -->
                                                        <th data-hide="phone, tablet" class="text-center">Percentage</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="fs-8" style="font-size: 11px; padding: 0px !important;">
                                                    <?php 
                                                        $count = 0;
                                                        foreach ($a1d_data_1 as $result):

                                                            $customer_name = $result->first_name . ' ' . $result->middle_name . ' ' . $result->last_name;
                                                            $count++;

                                                            // Masking Phone Number
                                                            $phone = $result->phone;
                                                            
                                                            $percentage = $result->percent_score;


                                                            if ($percentage >= 50 && $percentage < 85)
                                                             {
                                                                $e_color = '#FFFF00';
                                                              } elseif ($percentage < 50)
                                                               {
                                                                    $e_color = 'red';
                                                                } else 
                                                                {
                                                                 $e_color = '#00B050';
                                                                   }

                                                           

                                                          
                                                    ?>
                                                    <tr>
                                                        <td style="padding: 0px !important;"><?php echo $count; ?></td>
                                                        <!--<td class="text-center" style="padding: 0px !important;"><?php //echo $result->phone; ?></td>-->
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->lo; ?></td>
                                                        <!-- <td class="text-center" style="padding: 0px !important;"><?php// echo $result->call_open_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php //echo $result->need_iden_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php //echo $result->prod_serv_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php //echo $result->comp_proc_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php// echo $result->customer_call_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php //echo $result->call_clo_avg; ?></td>
                                                        <td class="text-center" style="padding: 0px !important;"><?php //echo $result->total_sum; ?></td> -->
                                                        <td class="text-center" style="padding: 0px !important;"><?php echo $result->evaluations_count; ?></td>
                                                        <!-- <td class="text-center" style="padding: 0px !important;"><?php echo $result->campaign; ?></td> -->
                                                        <td class="text-center" style="padding: 0px !important;background-color: <?php echo $e_color;?>"><?php echo $result->percent_score; ?></td>
                                                        

                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>

                                        <?php } ?>
                                    </div>


                                </section>
                            </div>
                        </div>
                    </div>



                                        
            <!-- FOOTER -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var table = document.getElementById("pagecontent");

    // Disable text selection
    table.addEventListener("selectstart", function (e) {
      e.preventDefault();
      return false;
    });

    // Disable right-click context menu
    table.addEventListener("contextmenu", function (e) {
      e.preventDefault();
      return false;
    });
  });


   document.addEventListener("DOMContentLoaded", function () {
    var table = document.getElementById("order-table");

    // Disable text selection
    table.addEventListener("selectstart", function (e) {
      e.preventDefault();
      return false;
    });

    // Disable right-click context menu
    table.addEventListener("contextmenu", function (e) {
      e.preventDefault();
      return false;
    });
  });
</script>