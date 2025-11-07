            <div class="boxed">
                <!--CONTENT CONTAINER-->
                <!--===================================================-->
                <div id="content-container">
                <div class="pageheader hidden-xs">
                  <h3><i class="fa fa-home"></i> Evaluate Lead </h3>
                    <div class="breadcrumb-wrapper">
                      <span class="label">You are here:</span>
                         <ol class="breadcrumb">
                            <li> <a href="#"> Home </a> </li>
                            <li class="active"> Evaluate Lead </li>
                         </ol>
                    </div>
                </div>
                    <!--Page content-->
                    <!--===================================================-->

                    <div id="page-content">
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
                                        
                        
                                       <!--/ END Form Wizard -->

                                         <form class="form-horizontal form-bordered" action="<?php echo base_url('admin/evaluated_leads'); ?>" method="post" id="registrationForm">
                                            <!-- Wizard Container 1 -->
                                            <div class="wizard-container">
                                                <!-- <div class="form-group">
                                                    <div class="col-md-12">
                                                        <h4 class="text-primary"> <i class="fa fa-user"></i>Lead List </h4>
                                                        <p class="text-muted">  Daily Leads Table...</p>
                                                    </div>
                                                </div> -->
                                                <div class="form-group">
                                                    <div class="col-sm-2 offset-sm-2">
                                                    <label class="control-label"> From Date : </label>
                                                   
                                                     <br>
                                                        <!-- <input type="date" name="from_date" value="<?php //$date=date('Y-m-d'); echo date('Y-m-d',strtotime($date .' -1 day')); ?>" data-parsley-range="[1, 10]" data-parsley-group="order" style="display: block;   width: 100%;  height: 34px;  padding: 6px 12px; font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff; background-image: none; border: 1px solid #ccc;"/> -->
                                                        <input type="date" name="from_date" value="<?php $date=date('Y-m-d'); echo date('Y-m-d'); ?>" data-parsley-group="order" style="display: block;   width: 100%;  height: 34px;  padding: 6px 12px; font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff; background-image: none; border: 1px solid #ccc;"/>
                                                    </div>
                                                    <div class="col-sm-2 offset-sm-2">
                                                    <label class="control-label"> To Date : </label><br>
                                                        <!-- <input  name="to_date" type="date" value="<?php //$date=date('Y-m-d'); echo date('Y-m-d',strtotime($date .' -1 day'));  ?>" placeholder="Type Phone Number" data-parsley-range="[1, 10]" data-parsley-group="order" style="display: block;   width: 100%;  height: 34px;  padding: 6px 12px; font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff; background-image: none; border: 1px solid #ccc;" /> -->
                                                        <input  name="to_date" type="date" value="<?php $date=date('Y-m-d'); echo date('Y-m-d');  ?>" placeholder="Type Phone Number" data-parsley-group="order" style="display: block;   width: 100%;  height: 34px;  padding: 6px 12px; font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff; background-image: none; border: 1px solid #ccc;" />
                                                    </div> 
                                                    
                                                    <div class="col-sm-1 offset-sm-1">
                                                    <label class="control-label"> Client : </label>
                                                          <select class="form-control"  name="client">
                                                            <option value="all">All</option>
                                                            <?php foreach ($clients as $value):?>
                                                                <option value="<?php echo $value->client_name; ?>"><?php echo $value->client_name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2 offset-sm-2">
                                                    <label class="control-label"> State : </label>
                                                         <select class="form-control" id="source" name="state" data-tf-id="587" data-tf-value="">
                                                            <option value="all" data-tf-id="589">All</option>
                                                            <option value="AL" data-tf-id="592">AL</option>
                                                            <option value="AK" data-tf-id="595">AK</option>
                                                            <option value="AZ" data-tf-id="598">AZ</option>
                                                            <option value="AR" data-tf-id="601">AR</option>
                                                            <option value="CA" data-tf-id="604">CA</option>
                                                            <option value="CO" data-tf-id="607">CO</option>
                                                            <option value="CT" data-tf-id="610">CT</option>
                                                            <option value="DE" data-tf-id="613">DE</option>
                                                            <option value="DC" data-tf-id="616">DC</option>
                                                            <option value="FL" data-tf-id="619">FL</option>
                                                            <option value="GA" data-tf-id="622">GA</option>
                                                            <option value="HI" data-tf-id="625">HI</option>
                                                            <option value="ID" data-tf-id="628">ID</option>
                                                            <option value="IL" data-tf-id="631">IL</option>
                                                            <option value="IN" data-tf-id="634">IN</option>
                                                            <option value="IA" data-tf-id="637">IA</option>
                                                            <option value="KS" data-tf-id="640">KS</option>
                                                            <option value="KY" data-tf-id="643">KY</option>
                                                            <option value="LA" data-tf-id="646">LA</option>
                                                            <option value="ME" data-tf-id="649">ME</option>
                                                            <option value="MD" data-tf-id="652">MD</option>
                                                            <option value="MA" data-tf-id="655">MA</option>
                                                            <option value="MI" data-tf-id="658">MI</option>
                                                            <option value="MN" data-tf-id="661">MN</option>
                                                            <option value="MS" data-tf-id="664">MS</option>
                                                            <option value="MO" data-tf-id="667">MO</option>
                                                            <option value="MT" data-tf-id="670">MT</option>
                                                            <option value="NE" data-tf-id="673">NE</option>
                                                            <option value="NV" data-tf-id="676">NV</option>
                                                            <option value="NH" data-tf-id="679">NH</option>
                                                            <option value="NJ" data-tf-id="682">NJ</option>
                                                            <option value="NM" data-tf-id="685">NM</option>
                                                            <option value="NY" data-tf-id="688">NY</option>
                                                            <option value="NC" data-tf-id="691">NC</option>
                                                            <option value="ND" data-tf-id="694">ND</option>
                                                            <option value="OH" data-tf-id="697">OH</option>
                                                            <option value="OK" data-tf-id="700">OK</option>
                                                            <option value="OR" data-tf-id="703">OR</option>
                                                            <option value="PA" data-tf-id="706">PA</option>
                                                            <option value="RI" data-tf-id="709">RI</option>
                                                            <option value="SC" data-tf-id="712">SC</option>
                                                            <option value="SD" data-tf-id="715">SD</option>
                                                            <option value="TN" data-tf-id="718">TN</option>
                                                            <option value="TX" data-tf-id="721">TX</option>
                                                            <option value="UT" data-tf-id="724">UT</option>
                                                            <option value="VT" data-tf-id="727">VT</option>
                                                            <option value="VA" data-tf-id="730">VA</option>
                                                            <option value="WA" data-tf-id="733">WA</option>
                                                            <option value="WV" data-tf-id="736">WV</option>
                                                            <option value="WI" data-tf-id="739">WI</option>
                                                            <option value="WY" data-tf-id="742">WY</option>
                                                        </select>
                                                    </div>
                                                        <div class="col-sm-2 offset-sm-2">
                                                    <label class="control-label"> Agents : </label>
                                                          <select class="form-control"  name="agents">
                                                            <option value="all">All</option>
                                                            <?php foreach ($agents as $key => $value) {

                                                                ?>
                                                                <option value="<?php echo $value->ein; ?>"><?php echo $value->username; ?></option>
                                                                <?php
                                                                # code...
                                                            } ?>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-1">
                                                    <label class="control-label"></label>
                                                         <button type="submit" style="margin-top: 41px;" class="btn btn-success" name="search" value="Search">
                                                    Submit
                                                    </button>
                                                    </div>
                                                    <!-- <div class="col-sm-4">
                                                    <label class="control-label"> Last Name : </label>
                                                        <input class="form-control" name="name" type="text" placeholder="Type your Last Name" data-parsley-range="[1, 10]" data-parsley-group="order"  />
                                                    </div> -->
                                                </div>
                                               
                                                
                                            </div>



                                        </form>

                                       <!-- Wizard Container 2 -->
                                

                                    </div>
                                </section>
                            </div>
                        </div>
               
            
        <div id="page-content">
            <div class="row" style="margin-top: 50px; padding: 20px;">
                <div class="col-md-12">
                    <section class="panel" style="padding: 20px;">
                         <div class="panel-body np">
                            <div class="panel-body">
                                <div class="table1">
                                    <h4>Total Leads: <?php echo $lead_count[0]->cnt; ?></h4>
                                      <div class="card-tab">
                                        <div class="dt-responsive table-responsive1">
                                           <div class="row">
                                             <div class="col-sm-12">
                                                <table id="order-table" class="table table-striped table-bordered nowrap  xxx"
                                                    role="grid" aria-describedby="order-table_info">
                                                    <thead style="border-top: 1px solid #dee2e6;font-size: 11px;padding: 0px !important;">
                                                        <tr role="row">
                                                            <th class="tthead min-w-30px">#</th>
                                                            <th class="tthead">Phone</th>
                                                        
                                                            <th class="tthead">Campaign</th>
                                                            <th class="tthead">LO</th>
                                                            <th class="tthead">Percentage</th>
                                                            <?php 
                                                                $user_type = $this->session->userdata('user_type_a1d_qa');
                                                                        if($user_type == 'Administrator' || $user_type == 'LMS Manager' || $user_type == 'QA Manager')
                                                                        {  ?>
                                                                            <th class="tthead">QA Status</th>
                                                                            <th class="tthead">Evaluator</th>
                                                                            <th class="tthead">Action</th>

                                                                <?php }
                                                                 ?>
                                                            
                                                            <th class="tthead">Evaluation Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="border-top: 1px solid #dee2e6;font-size: 11px;padding: 0px !important;">
                                                      <?php

                                                                            $count = 1;
                                                                            foreach ($fetch_leads as $leads):
                                                                          
                                                                            
                                                                                 $evaluation = $leads->qa_lead_status;
                                                                                
                                                                                $evaluate_lead = base_url('admin/evaluate_lead/'.encode_id($leads->phone).'');
                                                                                $edit_evaluation = base_url('admin/edit_evaluation/'.encode_id($leads->phone).'');
                                                                             

                                                                                if ($evaluation == 'pending' || empty($evaluation)) {
                                                                                    $e_color = '#e4b700';
                                                                                    $e_text = 'Pending';
                                                                                } elseif ($evaluation == 'Bad' || $evaluation == 'Poor') {
                                                                                    $e_color = 'red';
                                                                                    $e_text = 'Bad';
                                                                                } else {
                                                                                    $e_color = '#0ace0a';
                                                                                    $e_text = $evaluation;
                                                                                }

                                                                                if ($evaluation == 'pending') {
                                                                                    // edit Button and Evaluation button
                                                                                    $e_button = $evaluate_lead;
                                                                                    $e_button_text = 'Evaluate';
                                                                                } else {
                                                                                    // edit Button and Evaluation button
                                                                                    $e_button = $edit_evaluation;
                                                                                    $e_button_text = 'Edit Evaluation';

                                                                                }
                                                                            ?> 
                                                        <tr role="row" class="even">
                                                            <td><?php echo $count++ ; ?>
                                                            </td>
                                                            <!--<td><a href="<?php //echo base_url("admin/view_evaluation".$leads->phone.""); ?>"></a></td>-->
                                                            <td>
                                                                <a href="<?php echo base_url('admin/view_evaluation/' . encode_id($leads->phone)); ?>">
                                                                    <?php echo $leads->phone; ?>
                                                                </a>
                                                            </td>
                                                            </td>
                                                            
                                                            
                                                            <td><?php echo $leads->campaign; ?>
                                                            </td>
                                                            <td><?php echo $leads->lo; ?>
                                                            </td>
                                                            <td><?php echo $leads->percentage; ?></td>
                                                            

                                                            <?php 
                                                        $user_type = $this->session->userdata('user_type_a1d_qa');
                                                                if($user_type == 'Administrator' || $user_type == 'LMS Manager' || $user_type == 'QA Manager')
                                                                {  ?>
                                                                <td>
                                                                <span style="color: <?php echo $e_color;?>"><?php echo $e_text;?></span>
                                                                </td>
                                                                <td><?php echo $leads->employee_name; ?></td>
                                                                
                                                                <td><a href="<?php echo $e_button; ?>">
                                                                        <?php echo $e_button_text; ?></a>
                                                                </td>

                                                        <?php }
                                                         ?>
                                                            <td><?php echo $leads->evaluation_date; ?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                                </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>


            </div>




                    <!--===================================================-->
                    <!--End page content-->
                </div>
                <!--===================================================-->
                <!--END CONTENT CONTAINER-->
                




            </div>




