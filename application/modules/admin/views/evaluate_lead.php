  <div class="boxed">
                <!--CONTENT CONTAINER-->
                <!--===================================================-->
                <div id="content-container">
                <div class="pageheader hidden-xs">
                  <h3><i class="fa fa-home"></i> <?php echo $title; ?></h3>
                    <div class="breadcrumb-wrapper">
                      <span class="label">You are here:</span>
                         <ol class="breadcrumb">
                            <li> <a href="#"> Home </a> </li>
                            <li class="active"> <?php echo $title; ?></li>
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
                                                                                    <!-- Wizard Container 2 -->
                                   




                                    </div>
                                </section>
                            </div>
                        </div>




               
                    <div class="row" style="margin-top: 50px">
                          <div class="col-sm-12 grid-margin stretch-card">
                                <?php echo form_open("admin/evaluate_lead/".$this->uri->segment(3)."",  array('class'=>'evaluate_lead', 'id' => 'evaluate_lead', 'novalidate' => 'novalidate', 'enctype' => 'multipart/form-data' ));?>
                                <div class="card panel">
                                    <div class="card-body">
                                        

                                        <!--------- Checking whether LO is empty or not ------->
                                        <?php if (empty($lead_data[0]->lo)) { ?>
                                            <!-------- If LO is empty, show dropdown (required field) ----------->
                                            <select name="lo" class="mb-3" required>
                                                <option value="">Select Agent</option>
                                                <?php foreach ($lo_list as $loo) { ?>
                                                    <option value="<?= $loo->lo ?>"><?= $loo->lo ?></option>
                                                <?php } ?>
                                            </select>
                                        <?php } else { ?>
                                            <input type="text" name="lo" value="<?= $lead_data[0]->lo ?>" readonly>
                                        <?php } ?>

                                        <!---------------------- For Search Phone ------------------------>

                                            <input type="hidden" name="campaign" value="<?= $campaign_name ?>">
                                            <?php if($campaign_name == 'A1D-External') {?>
                                                <input type="hidden" name="phone" value="<?= $search_phone ?>">
                                            <?php }else{ ?>
                                             <input type="hidden" name="phone" value="<?= $lead_data[0]->phone ?>">
                                            <?php } ?>

                                        <!---------------------------------------------------------------->
                                        <?php
                                            
                                            
                                            if ($questions) {
                                                $questionNumber=1;

                                                    foreach ($questions as $value) {

                                                    if($questionNumber==1){
                                            ?>
                                                        <!-- <h5 class="fs-3">Call Openings & Professionalism</h5>
                                                        <hr> -->
                                            <?php
                                                    }
                                                    else if($questionNumber==2){
                                            ?>
                                                       <!--  <h5 class="fs-3">Needs Identification & Rapport Building</h5>
                                                        <hr> -->
                                            <?php
                                                    }
                                                    else if($questionNumber==6){
                                            ?>
                                                        <!-- <h5 class="fs-3">Product / Service Knowledge</h5>
                                                        <hr> -->
                                            <?php    
                                                    }
                                                    else if($questionNumber==8){
                                            ?>
                                                      <!--   <h5 class="fs-3">Compliance & Process Adherence</h5>
                                                        <hr> -->
                                            <?php
                                                    }
                                                    else if($questionNumber==12){
                                            ?>
                                                       <!--  <h5 class="fs-3">Customer Engagement & Call Handling</h5>
                                                        <hr> -->
                                            <?php
                                                    }
                                                    else if($questionNumber==16){
                                            ?>
                                                        <!-- <h5 class="fs-3">Call Closing</h5>
                                                        <hr> -->
                                            <?php
                                                    }
                                        ?>
                                        
                                        <div class="form-group row align-items-center">
                                            <div class="form-row">
                                                <label for="exampleInputUsername2" class="col-sm col-form-label"><?php echo $value->qa_question_id; ?>. <b><?php echo $value->qa_question; ?></b>:</label>
                                            </div>
                                            
                                            <div class="form-row">
                                                
                                                <!--------------------------- Question 1 -------------------------------------->
                                                <?php if($questionNumber == 1){ ?>
                                                    <input type="hidden" name="question_1" value="<?= $value->qa_question_id ?>">

                                                    <!-- Flex container -->
                                                    <div class="container">
                                                        <div class="row">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-8">
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_1" value="3" onchange="updateScores()"> Yes
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_1" value="0" onchange="updateScores()"> No
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_1" value="N/A" onchange="updateScores()"> N/A
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <!-- Right side: score input -->
                                                            <div class="col-sm-4">
                                                                <input type="hidden" readonly class="individual-score" name="indivdual_1" id="score_1" value="0">
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                                <!--------------------------- Question 2 -------------------------------------->
                                                    <?php if($questionNumber == 2){ ?>
                                                        <input type="hidden" name="question_2" value="<?= $value->qa_question_id ?>">

                                                        <!-- Flex container -->
                                                        <div class="container">
                                                        <div class="row">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-8">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-2 form-check form-check-inline">
                                                                <label class="ms-4">
                                                                    <input type="radio" name="answer_2" value="2" onchange="updateScores()"> Yes
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-2 form-check form-check-inline">
                                                                <label class="ms-4">
                                                                    <input type="radio" name="answer_2" value="0" onchange="updateScores()"> No
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-2 form-check form-check-inline">
                                                                <label class="ms-4">
                                                                    <input type="radio" name="answer_2" value="N/A" onchange="updateScores()"  > N/A
                                                                </label>
                                                            </div>
                                                            <!-- Right side: score input -->
                                                            <di>
                                                                <input type="hidden" readonly class="individual-score" id="score_2" value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                    <?php } ?>
                                                    <!--------------------------- Question 3 -------------------------------------->
                                                    <?php if($questionNumber == 3){ ?>
                                                        <input type="hidden" name="question_3" value="<?= $value->qa_question_id ?>">
                                                        <!-- Flex container -->
                                                        <div class="container">
                                                        <div class="row">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-8">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-2 form-check form-check-inline">
                                                                <label class="ms-4">
                                                                    <input type="radio" name="answer_3" value="3" onchange="updateScores()"> Yes
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-2 form-check form-check-inline">
                                                                <label class="ms-4">
                                                                    <input type="radio" name="answer_3" value="0" onchange="updateScores()"> No
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-2 form-check form-check-inline">
                                                                <label class="ms-4">
                                                                    <input type="radio" name="answer_3" value="N/A" onchange="updateScores()"  > N/A
                                                                </label>
                                                            </div>
                                                            <!-- Right side: score input -->
                                                            <div >
                                                                <input type="hidden" readonly class="individual-score" id="score_3" value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <?php } ?>
                                                    <!--------------------------- Question 4 -------------------------------------->
                                                        <?php if($questionNumber == 4){ ?>
                                                            <input type="hidden" name="question_4" value="<?= $value->qa_question_id ?>">
                                                            <!-- Flex container -->
                                                            <div class="container">
                                                        <div class="row">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-8">
                                                                <!-- Left side: radio options -->
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_4" value="3" onchange="updateScores()"> Yes
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_4" value="0" onchange="updateScores()"> No
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_4" value="N/A" onchange="updateScores()"  > N/A
                                                                    </label>
                                                                </div>
                                                                <!-- Right side: score input -->
                                                                <div>
                                                                    <input type="hidden" readonly class="individual-score" id="score_4" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <?php } ?>
                                                        <!--------------------------- Question 5 -------------------------------------->
                                                        <?php if($questionNumber == 5){ ?>
                                                        <input type="hidden" name="question_5" value="<?= $value->qa_question_id ?>">
                                                        <!-- Flex container -->
                                                        <div class="container">
                                                            <div class="row">
                                                                <!-- Left side: radio options -->
                                                                <div class="col-sm-8">
                                                                    <div class="col-sm-2 form-check form-check-inline">
                                                                        <label class="ms-4">
                                                                            <input type="radio" name="answer_5" value="3" onchange="updateScores()"> Yes
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-sm-2 form-check form-check-inline">
                                                                        <label class="ms-4">
                                                                            <input type="radio" name="answer_5" value="0" onchange="updateScores()"> No
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-sm-2 form-check form-check-inline">
                                                                        <label class="ms-4">
                                                                            <input type="radio" name="answer_5" value="N/A" onchange="updateScores()" > N/A
                                                                        </label>
                                                                    </div>

                                                                    <!-- Hidden score input -->
                                                                    <div>
                                                                        <input type="hidden" readonly class="individual-score" id="score_5" value="0">
                                                                    </div>
                                                                </div>

                                                              
                                                            </div>
                                                        </div>

                                                    <?php } ?>
                                                
                                                <!--------------------------- Question 6 -------------------------------------->
                                                <?php if($questionNumber == 6){ ?>
                                                    <input type="hidden" name="question_6" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                            <div class="row">
                                                                <!-- Left side: radio options -->
                                                                <div class="col-sm-8">
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_6" value="3" onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_6" value="0" onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_6" value="N/A" onchange="updateScores()" > N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                        <div >
                                                            <input type="hidden" readonly class="individual-score" id="score_6" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php } ?>
                                                <!--------------------------- Question 7 -------------------------------------->
                                                <?php if($questionNumber == 7){ ?>
                                                    <input type="hidden" name="question_7" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                            <div class="row">
                                                                <!-- Left side: radio options -->
                                                                <div class="col-sm-8">
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_7" value="5" onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_7" value="0" onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_7" value="N/A" onchange="updateScores()" > N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                        <div >
                                                            <input type="hidden" readonly class="individual-score" id="score_7" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                                <?php } ?>
                                                <!--------------------------- Question 8 -------------------------------------->
                                                <?php if($questionNumber == 8){ ?>
                                                    <input type="hidden" name="question_8" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                            <div class="row">
                                                                <!-- Left side: radio options -->
                                                                <div class="col-sm-8">
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_8" value="5" onchange="updateScores()" class="toggle-question-9"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_8" value="0" onchange="updateScores()" class="toggle-question-9"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_8" value="N/A" class="toggle-question-9" onchange="updateScores()" > N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                        <div>
                                                            <input type="hidden" readonly class="individual-score" id="score_8" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php } ?>
                                                <!--------------------------- Question 9 -------------------------------------->
                                                <?php if($questionNumber == 9){ ?>
                                                    <input type="hidden" name="question_9" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                            <div class="row">
                                                                <!-- Left side: radio options -->
                                                                <div class="col-sm-8">
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_9" value="10" onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_9" value="0" onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_9" value="N/A" onchange="updateScores()" > N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                        <div >
                                                            <input type="hidden" readonly class="individual-score" id="score_6" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php } ?>
                                                <!--------------------------- Question 10 -------------------------------------->
                                                <?php if($questionNumber == 10){ ?>
                                                    <input type="hidden" name="question_10" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                            <div class="row">
                                                                <!-- Left side: radio options -->
                                                                <div class="col-sm-8">
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_10" value="3" onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_10" value="0" onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_10" value="N/A"  onchange="updateScores()" > N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                        <div >
                                                            <input type="hidden" readonly class="individual-score" id="score_10" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php } ?>
                                                <!--------------------------- Question 11 -------------------------------------->
                                                <?php if($questionNumber == 11){ ?>
                                                    <input type="hidden" name="question_11" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                        <div class="row">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-8">
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_11" value="15" onchange="updateScores()"> Yes
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_11" value="0" onchange="updateScores()"> No
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_11" value="N/A" onchange="updateScores()" > N/A
                                                                    </label>
                                                                </div>

                                                                <!-- Hidden score input -->
                                                                <div>
                                                                    <input type="hidden" readonly class="individual-score" id="score_11" value="0">
                                                                </div>
                                                            </div>

                                                            
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                                <!--------------------------- Question 12 -------------------------------------->
                                                <?php if($questionNumber == 12){ ?>
                                                    <input type="hidden" name="question_12" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                        <div class="row">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-8">
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_12" value="15" onchange="updateScores()"> yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_12" value="0" onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_12" value="N/A" onchange="updateScores()" > N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                        <div >
                                                            <input type="hidden" readonly class="individual-score" id="score_12" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php } ?>
                                                <!--------------------------- Question 13 -------------------------------------->
                                                <?php if($questionNumber == 13){ ?>
                                                    <input type="hidden" name="question_13" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                        <div class="row">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-8">
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_13" value="3" onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_13" value="0" onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_13" value="N/A" onchange="updateScores()" > N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                        <div >
                                                            <input type="hidden" readonly class="individual-score" id="score_13" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                                <?php } ?>
                                                <!--------------------------- Question 14 -------------------------------------->
                                                <?php if($questionNumber == 14){ ?>
                                                    <input type="hidden" name="question_14" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                        <div class="row">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-8">
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_14" value="15" onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_14" value="0" onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_14" value="N/A"  onchange="updateScores()" >N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                        <div>
                                                           <input type="hidden" readonly class="individual-score" id="score_14" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php } ?>
                                                <!--------------------------- Question 15 -------------------------------------->
                                                <?php if($questionNumber == 15){ ?>
                                                    <input type="hidden" name="question_15" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                        <div class="row">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-8">
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_15" value="2" onchange="updateScores()"> Yes
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_15" value="0" onchange="updateScores()"> No
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_15" value="N/A" onchange="updateScores()" > N/A
                                                                    </label>
                                                                </div>

                                                                <!-- Hidden score input -->
                                                                <div>
                                                                    <input type="hidden" readonly class="individual-score" id="score_15" value="0">
                                                                </div>
                                                            </div>

                                                           
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                                <!--------------------------- Question 16 -------------------------------------->
                                                <?php if($questionNumber == 16){ ?>
                                                    <input type="hidden" name="question_16" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                        <div class="row">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-8">
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_16" value="2"  onchange="updateScores()"> Yes
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_16" value="0"  onchange="updateScores()"> No
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_16" value="N/A"  onchange="updateScores()"> N/A
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <!-- Right side: score input -->
                                                            <div class="col-sm-4">
                                                                <input type="hidden" readonly class="individual-score" name="indivdual_16" id="score_16" value="0">
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                                <!--------------------------- Question 17 -------------------------------------->
                                                <?php if($questionNumber == 17){ ?>
                                                    <input type="hidden" name="question_17" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                        <div class="row">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-8">
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_17" value="4" onchange="updateScores()"> Yes
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_17" value="0" onchange="updateScores()"> No
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_17" value="N/A" onchange="updateScores()"> N/A
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <!-- Right side: score input -->
                                                            <div class="col-sm-4">
                                                                <input type="hidden" readonly class="individual-score" name="indivdual_17" id="score_17" value="0">
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php } ?>

                                                <!--------------------------- Question 18 -------------------------------------->
                                                <?php if($questionNumber == 18){ ?>
                                                    <input type="hidden" name="question_18" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                        <div class="row">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-8">
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_18" value="4" onchange="updateScores()"> Yes
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_18" value="0" onchange="updateScores()"> No
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_18" value="N/A" onchange="updateScores()"> N/A
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <!-- Right side: score input -->
                                                            <div class="col-sm-4">
                                                                <input type="hidden" readonly class="individual-score" name="indivdual_18" id="score_18" value="0">
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php } ?>

                                                

                                            </div>

                                        </div>
                                        <?php
                                            $questionNumber++;
                                            }                   
                                        }
                                        ?>
                                        <hr>
                                        <div class="form-group row align-items-center">
                                            <div class="form-row">
                                                <label for="exampleInputUsername2" class="col-sm-6 col-form-label">
                                                    Upload Recordings:</label>
                                                <div class="col-sm-1">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="file" id="upload_recording" name="upload_recording"  class="form-control form-control-solid"
                                                        style="border-color: black;" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="form-row">
                                                <label for="exampleInputUsername2" class="col-sm-6 col-form-label">
                                                    Total Score:</label>
                                                <div class="col-sm-1">
                                                </div>
                                                <div class="col-sm-1">
                                                    <input type="text" id="netScore" name="obtain_marks" value="100" class="form-control form-control-solid clschk"
                                                        style="border-color: black;" readonly>
                                                    <input type="hidden" id="total_score" name="total_score" value="100" class="form-control form-control-solid clschk"
                                                        style="border-color: black;" readonly>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" readonly class="form-control form-control-solid" id="netRate" name="score_rating" value="Good"
                                                        style="border-color: black;" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="form-row">
                                                <label for="exampleInputUsername2" class="col-sm-6 col-form-label">
                                                    Percentage:</label>
                                                <div class="col-sm-1">
                                                </div>
                                                <div class="col-sm-1">
                                                    <input type="text" id="averageScore" name="avg_score" value="100" class="form-control form-control-solid clschk"
                                                        style="border-color: black;" readonly>
                                                    
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <label for="exampleInputUsername2" class="col-sm-6 col-form-label">
                                                    Grade:</label>
                                                <div class="col-sm-1">
                                                </div>
                                                <div class="col-sm-1">
                                                    <input type="text" id="gradeAwarded" name="grade" value="A+" class="form-control form-control-solid clschk"
                                                        style="border-color: black;" readonly>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="form-row">
                                                <label for="exampleInputUsername2" class="col-sm-6 col-form-label">
                                                    Comments:</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control form-control-solid"
                                                        id="comments" rows="5" name="comments" 
                                                        style="border-color: black;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="form-row">
                                                <label for="exampleInputUsername2" class="col-sm-6 col-form-label">
                                                </label>
                                                <div class="col-sm-1">
                                                </div>
                                                <div class="col-sm-4">
                                                </div>
                                                <div class="col-sm-1 text-center">
                                                    <input class="form-check-input chkbx" type="checkbox" id="check_verify" name="check_verify">
                                                </div>
                                            </div>
                                        </div>
                                            <input type="submit" name="submit_QA" value="Submit QA Lead"  class="btn btn-primary float-end mt-5 mb-3">
                                    </div>
                                </div>
                                <?php echo form_close();?>
                           </div>
                          
                    </div>
                </div>









                    <!--===================================================-->
                    <!--End page content-->
                </div>
                <!--===================================================-->
                <!--END CONTENT CONTAINER-->
                




            </div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<script>
    const questionMaxScores = {
        1: 3, 2: 2, 3: 3, 4: 3, 5: 3,
        6: 3, 7: 5, 8: 5, 9: 10, 10: 3,
        11: 15, 12: 15, 13: 3, 14: 15, 15: 2,
        16: 2, 17: 4, 18: 4
    };

    function updateScores() {
        let totalScore = 0;
        let maxPossibleScore = 0;

       
       

        for (let i = 1; i <= 18; i++) {
            const selected = document.querySelector(`input[name="answer_${i}"]:checked`);
            let score = 0;

           

            if (selected) {
               
                if (selected.value !== "N/A") {
                    const val = parseFloat(selected.value);
                    if (!isNaN(val)) {
                        score = val;
                        totalScore += score;
                        maxPossibleScore += questionMaxScores[i] || 0;
                        
                    }
                } 
            } 

            const scoreField = document.getElementById(`score_${i}`);
            if (scoreField) {
                scoreField.value = score.toFixed(1);
               
            }
        }

        const percentage = maxPossibleScore > 0 ? (totalScore / maxPossibleScore) * 100 : 0;

       

        // Update UI fields
        const netScoreField = document.getElementById('netScore');
        const avgScoreField = document.getElementById('averageScore');
        const totalScoreField = document.getElementById('total_score');
        const rateField = document.getElementById('netRate');
        const gradeField = document.getElementById('gradeAwarded');

        if (netScoreField) netScoreField.value = totalScore.toFixed(1);
        if (avgScoreField) avgScoreField.value = percentage.toFixed(2);
        if (totalScoreField) totalScoreField.value = maxPossibleScore.toFixed(1);

        // Determine rating
        let rating = 'Poor';
        if (percentage >= 85) rating = 'Excellent';
        else if (percentage >= 50) rating = 'Good';
        if (rateField) rateField.value = rating;

        
        // Handle Question 18 checkboxes
        // const checkedQ18 = document.querySelectorAll('input.ans_18:checked');
        // const remarks18 = [];
        // checkedQ18.forEach(cb => {
        //     remarks18.push(cb.value.trim());
        // });

        // const remarksField = document.getElementById('remarks_18');
        // if (remarksField) {
        //     remarksField.value = remarks18.join(', ');
        // }

        
        // Determine grade
        let grade = 'F';
        
            if (percentage >= 97) grade = 'A+';
            else if (percentage >= 93) grade = 'A';
            else if (percentage >= 87) grade = 'B+';
            else if (percentage >= 83) grade = 'B';
            else if (percentage >= 77) grade = 'C+';
            else if (percentage >= 73) grade = 'C';
            else if (percentage >= 67) grade = 'D+';
            else if (percentage >= 60) grade = 'D';
        

        if (gradeField) gradeField.value = grade;
    }

    // Attach listeners when DOM is ready
    document.addEventListener("DOMContentLoaded", function () {
        const allInputs = document.querySelectorAll('input[type="radio"], input.ans_18');
        allInputs.forEach(input => {
            input.addEventListener('change', updateScores);
        });

        updateScores(); // Initial calculation
    });
</script>


<!-- Optional: Form Validation (unchanged) -->
<script>
    $(document).ready(function () {
        $.validator.addClassRules({
            clschk: {
                cRequired: true
            }
        });

        $.validator.addMethod("cRequired", $.validator.methods.required, "Field cannot be empty");

        $('#evaluate_lead').validate();
    });
</script>
