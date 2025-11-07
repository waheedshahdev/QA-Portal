

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
                            <li class="active"> <?php echo $title; ?> </li>
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




               
                     <div class="row" style="margin-top:50px">

                
                        <div class="col-sm-12 grid-margin stretch-card">
                            <?php echo form_open("admin/edit_evaluation/".$this->uri->segment(3)."",  array('class'=>'new_lead', 'id' => 'new_lead', 'novalidate' => 'novalidate', 'enctype' => 'multipart/form-data' ));?>
                            <div class="card panel">
                                    <div class="card-body">
                                        <input type="hidden" name="phone" value="<?= $lead_data[0]->phone ?>">
                                        <!---------------------- For Search Phone ------------------------>
                                            <input type="hidden" name="search_phone" value="<?= $scores[0]->phone; ?>">
                                            <input type="hidden" name="campaign" value="<?= $campaign_name ?>">
                                            <?php if($campaign_name == 'MTG') {?>
                                                <input type="hidden" name="search_phone" value="<?= $search_phone ?>">
                                            <?php } ?>

                                        <!---------------------------------------------------------------->
                                        <?php
                                            if ($questions) {
                                                $questionNumber=1;

                                                    foreach ($questions as $value) {

                                                    if($questionNumber==1){
                                            ?>
                                                        
                                            <?php
                                                    }
                                                    else if($questionNumber==2){
                                            ?>
                                                        
                                            <?php
                                                    }
                                                    else if($questionNumber==6){
                                            ?>
                                                        
                                            <?php    
                                                    }
                                                    else if($questionNumber==8){
                                            ?>
                                                       
                                            <?php
                                                    }
                                                    else if($questionNumber==12){
                                            ?>
                                                        
                                            <?php
                                                    }
                                                    else if($questionNumber==16){
                                            ?>
                                                       
                                            <?php
                                                    }
                                        ?>



                                        <?php
                                            $scoresByQuestionId = [];
                                            foreach ($scores1 as $score) {
                                                $scoresByQuestionId[$score->question_id] = $score->score_awarded;
                                            }
                                            ?>


                                    <div class="form-group row align-items-center">
                                            <div class="form-row">
                                                <label for="exampleInputUsername2" class="col-sm col-form-label"><?php echo $value->qa_question_id; ?>. <b><?php echo $value->qa_question; ?></b>:</label>
                                            </div>
                                            <div class="form-row">
                                                <!--------------------------- Question 1 -------------------------------------->
                                                <?php if ($questionNumber == 1): ?>
                                                    <!-- Flex container -->
                                                  <div class="container">
                                                    <div class="row">
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-8">
                                                            <input type="hidden" name="question_1" value="<?= $value->qa_question_id ?>">

                                                            <div class="col-sm-2 form-check form-check-inline">
                                                                <label class="ms-4">
                                                                    <input type="radio" name="answer_1" value="3" 
                                                                        <?php if ($scoresByQuestionId[1] == '3') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> Yes
                                                                </label>
                                                            </div>

                                                            <div class="col-sm-2 form-check form-check-inline">
                                                                <label class="ms-4">
                                                                    <input type="radio" name="answer_1" value="0" 
                                                                        <?php if ($scoresByQuestionId[1] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No
                                                                </label>
                                                            </div>

                                                            <div class="col-sm-2 form-check form-check-inline">
                                                                <label class="ms-4">
                                                                    <input type="radio" name="answer_1" value="N/A" 
                                                                        <?php if ($scoresByQuestionId[1] == 'N/A') echo 'checked="checked"'; ?> disabled  onchange="updateScores()"> N/A
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <!-- Right side: score input -->
                                                        <div class="col-sm-4">
                                                                <input type="hidden" readonly class="individual-score" name="indivdual_1" id="score_1" value="0">
                                                            </div>
                                                    </div>
                                                </div>

                                                <?php endif; ?>
                                                
                                                <!--------------------------- Question 2 -------------------------------------->
                                                <?php if($questionNumber == 2){ ?>
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                    <div class="row">
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-8">
                                                       
                                                            <input type="hidden" name="question_2" value="<?= $value->qa_question_id ?>">
                                                            <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_2" value="2" <?php if ($scoresByQuestionId[2] == '2') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_2" value="0" <?php if ($scoresByQuestionId[2] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_2" value="N/A" <?php if ($scoresByQuestionId[2] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()"  > N/A
                                                            </label>
                                                        </div>
                                                    </div>
                                                        <!-- Right side: score input -->
                                                        <div class="col-sm-4">
                                                            <input type="hidden" readonly class="individual-score" id="score_2" value="0">
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
                                                                <input type="radio" name="answer_3" value="3" <?php if ($scoresByQuestionId[3] == '3') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_3" value="0" <?php if ($scoresByQuestionId[3] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_3" value="N/A" <?php if ($scoresByQuestionId[3] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()"  > N/A
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
                                                                <input type="radio" name="answer_4" value="3" <?php if ($scoresByQuestionId[4] == '3') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_4" value="0" <?php if ($scoresByQuestionId[4] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_4" value="N/A" <?php if ($scoresByQuestionId[4] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()" > N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                        <div >
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
                                                                        <input type="radio" name="answer_5" value="3"
                                                                            <?php if ($scoresByQuestionId[5] == '3') echo 'checked="checked"'; ?> disabled
                                                                            onchange="updateScores()"> Yes
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_5" value="0"
                                                                            <?php if ($scoresByQuestionId[5] == '0') echo 'checked="checked"'; ?> disabled
                                                                            onchange="updateScores()"> No
                                                                    </label>
                                                                </div>

                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_5" value="N/A"
                                                                            <?php if ($scoresByQuestionId[5] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()" > N/A
                                                                    </label>
                                                                </div>

                                                                <!-- Hidden individual score input -->
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
                                                                <input type="radio" name="answer_6" value="3" <?php if ($scoresByQuestionId[6] == '3') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_6" value="0" <?php if ($scoresByQuestionId[6] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_6" value="N/A" <?php if ($scoresByQuestionId[6] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()" > N/A
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!-- Right side: score input -->
                                                </div>
                                                    <div class="col-sm-4">
                                                        <input type="hidden" readonly class="individual-score" id="score_6" value="0">
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <!--------------------------- Question 7 -------------------------------------->
                                                <?php if($questionNumber == 7){ ?>
                                                    <input type="hidden" name="question_7" value="<?= $value->qa_question_id ?>">
                                                    <!-- Flex container -->
                                                    <div class="container">
                                                        <div class="row">
                                                            <!-- Left side: checkbox options -->
                                                            <div class="col-sm-8">
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_7" value="5" <?php if ($scoresByQuestionId[7] == '5') echo 'checked="checked"'; ?> disabled onchange="updateScores()" > Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_7" value="0" <?php if ($scoresByQuestionId[7] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_7" value="N/A" <?php if ($scoresByQuestionId[7] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()"  > N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                    </div>
                                                        <div class="col-sm-4">
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
                                                            <!-- Left side: checkbox options -->
                                                            <div class="col-sm-8">
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_8" value="5" <?php if ($scoresByQuestionId[8] == '5') echo 'checked="checked"'; ?> disabled onchange="updateScores()" > Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_8" value="0" <?php if ($scoresByQuestionId[8] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_8" value="N/A" <?php if ($scoresByQuestionId[8] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()"  > N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                    </div>
                                                        <div class="col-sm-4">
                                                            <input type="hidden" readonly class="individual-score" id="score_8" value="0">
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
                                                                <!-- Left side: checkbox options -->
                                                                <div class="col-sm-8">
                                                            <!-- Left side: radio options -->
                                                            <div class="col-sm-2 form-check form-check-inline">
                                                                <label class="ms-4">
                                                                    <input type="radio" name="answer_9" value="10" <?php if ($scoresByQuestionId[9] == '10') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> Yes
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-2 form-check form-check-inline">
                                                                <label class="ms-4">
                                                                    <input type="radio" name="answer_9" value="0" <?php if ($scoresByQuestionId[9] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-2 form-check form-check-inline">
                                                                <label class="ms-4">
                                                                    <input type="radio" name="answer_9" value="N/A" <?php if ($scoresByQuestionId[9] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()"  > N/A
                                                                </label>
                                                            </div>
                                                            <!-- Right side: score input -->
                                                            <div>
                                                                <input type="hidden" readonly class="individual-score" id="score_9" value="0">
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
                                                            <!-- Left side: checkbox options -->
                                                            <div class="col-sm-8">
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_10" value="3" <?php if ($scoresByQuestionId[10] == '3') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_10" value="0" <?php if ($scoresByQuestionId[10] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_10" value="N/A" <?php if ($scoresByQuestionId[10] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()"  > N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                        <div>
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
                                                                        <input type="radio" name="answer_11" value="15"
                                                                            <?php if ($scoresByQuestionId[11] == '15') echo 'checked="checked"'; ?> disabled
                                                                            onchange="updateScores()"> Yes
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_11" value="0"
                                                                            <?php if ($scoresByQuestionId[11] == '0') echo 'checked="checked"'; ?> disabled
                                                                            onchange="updateScores()"> No
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_11" value="N/A"
                                                                            <?php if ($scoresByQuestionId[11] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()" > N/A
                                                                    </label>
                                                                </div>

                                                                <!-- Hidden Score Field -->
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
                                                                <input type="radio" name="answer_12" value="15" <?php if ($scoresByQuestionId[12] == '15') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> Yes                                        
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_12" value="0" <?php if ($scoresByQuestionId[12] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No                                      
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_12" value="N/A" <?php if ($scoresByQuestionId[12] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()" >N/A                                   
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                    </div>
                                                        <div class="col-sm-4">
                                                            <input type="hidden" readonly class="individual-score" id="score_12" value="0">
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
                                                                <input type="radio" name="answer_13" value="3" <?php if ($scoresByQuestionId[13] == '3') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_13" value="0" <?php if ($scoresByQuestionId[13] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-4 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_13" value="N/A" <?php if ($scoresByQuestionId[13] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()"  > N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                        <div>
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
                                                                <input type="radio" name="answer_14" value="15" <?php if ($scoresByQuestionId[14] == '15') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> Yes                               
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_14" value="0" <?php if ($scoresByQuestionId[14] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No                               
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_14" value="N/A" <?php if ($scoresByQuestionId[14] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()" >N/A
                                                            </label>
                                                        </div>
                                                        <!-- Right side: score input -->
                                                    </div>
                                                        <div class="col-sm-4">
                                                        <input type="hidden" readonly class="individual-score" id="score_14" value="0">
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
                                                                        <input type="radio" name="answer_15" value="2" 
                                                                            <?php if ($scoresByQuestionId[15] == '2') echo 'checked="checked"'; ?> disabled 
                                                                            onchange="updateScores()"> Yes
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_15" value="0" 
                                                                            <?php if ($scoresByQuestionId[15] == '0') echo 'checked="checked"'; ?>  disabled
                                                                            onchange="updateScores()"> No
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_15" value="N/A" 
                                                                            <?php if ($scoresByQuestionId[15] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()" > N/A
                                                                    </label>
                                                                </div>
                                                                <!-- Right side: hidden score input -->
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
                                                                        <input type="radio" name="answer_16" value="2" 
                                                                            <?php if ($scoresByQuestionId[16] == '2') echo 'checked="checked"'; ?> disabled 
                                                                            onchange="updateScores()"> Yes
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_16" value="0" 
                                                                            <?php if ($scoresByQuestionId[16] == '0') echo 'checked="checked"'; ?> disabled 
                                                                            onchange="updateScores()"> No
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-2 form-check form-check-inline">
                                                                    <label class="ms-4">
                                                                        <input type="radio" name="answer_16" value="N/A" 
                                                                            <?php if ($scoresByQuestionId[16] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()" > N/A
                                                                    </label>
                                                                </div>
                                                                <!-- Right side: hidden score input -->
                                                                <div>
                                                                    <input type="hidden" readonly class="individual-score" id="score_16" value="0">
                                                                </div>
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
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_17" value="4" <?php if ($scoresByQuestionId[17] == '4') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_17" value="0" <?php if ($scoresByQuestionId[17] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_17" value="N/A" <?php if ($scoresByQuestionId[17] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> N/A
                                                            </label>
                                                        </div>
                                                    </div>
                                                        <!-- Right side: score input -->
                                                        <div class="col-sm-4">
                                                            <input type="hidden" readonly class="individual-score" id="score_17" value="0">
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
                                                        <!-- Left side: radio options -->
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_18" value="4" <?php if ($scoresByQuestionId[18] == '4') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> Yes
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_18" value="0" <?php if ($scoresByQuestionId[18] == '0') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> No
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 form-check form-check-inline">
                                                            <label class="ms-4">
                                                                <input type="radio" name="answer_18" value="N/A" <?php if ($scoresByQuestionId[18] == 'N/A') echo 'checked="checked"'; ?> disabled onchange="updateScores()"> N/A
                                                            </label>
                                                        </div>
                                                    </div>
                                                        <!-- Right side: score input -->
                                                        <div class="col-sm-4">
                                                            <input type="hidden" readonly class="individual-score" id="score_18" value="0">
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
                                                    Play Audio:</label>
                                                <div class="col-sm-1">
                                                    
                                                    <audio controls>
                                                      <source src="<?php echo base_url($qa_result[0]->recording); ?>" type="audio/mp3">
                                                    Your browser does not support the audio element.
                                                    </audio>
                                                

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
                                                    <input type="text" id="netScore" name="obtain_marks" value="<?php if(!empty($qa_result)){ echo $qa_result[0]->obtain_marks;} else{ echo '100';} ?>" class="form-control form-control-solid clschk"
                                                        style="border-color: black;" readonly>
                                                    <input type="hidden" id="total_score" name="total_score" value="<?php if(!empty($qa_result)){ echo $qa_result[0]->total_score;} else{ echo '100';} ?>" class="form-control form-control-solid clschk"
                                                        style="border-color: black;" readonly>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" readonly class="form-control form-control-solid" id="netRate" name="score_rating" value="<?php if(!empty($qa_result)){ echo $qa_result[0]->qa_lead_status;} else{ echo 'Good';} ?>"
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
                                                    <input type="text" id="averageScore" name="avg_score" value="<?php if(!empty($qa_result)){ echo $qa_result[0]->percentage;} else{ echo '100';} ?>" class="form-control form-control-solid clschk"
                                                        style="border-color: black;" readonly>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="form-row">
                                                <label for="exampleInputUsername2" class="col-sm-6 col-form-label">
                                                    Grade:</label>
                                                <div class="col-sm-1">
                                                </div>
                                                <div class="col-sm-1">
                                                    <input type="text" id="gradeAwarded" name="grade" value="<?php if(!empty($qa_result)){ echo $qa_result[0]->grade;} else{ echo 'A+';} ?>" class="form-control form-control-solid clschk"
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
                                                        style="border-color: black;" readonly><?php if(!empty($qa_result)){ echo $qa_result[0]->qa_comment;} ?></textarea>
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
