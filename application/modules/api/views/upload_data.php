

            <div class="boxed">
                <!--CONTENT CONTAINER-->
                <!--===================================================-->
                <div id="content-container">
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div class="pageheader hidden-xs">
                        <h3><i class="fa fa-home"></i><?php echo $title; ?> </h3>
                        <div class="breadcrumb-wrapper">
                            <span class="label">You are here:</span>
                            <ol class="breadcrumb">
                                <li> <a href="#"> Home </a> </li>
                                <li class="active"><?php echo $title; ?> </li>
                            </ol>
                        </div>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->
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
                                        <form class="form-horizontal form-bordered" action="<?php echo base_url();?>admin/upload_file" method="post" enctype="multipart/form-data" id="registrationForm">
                                            <!-- Wizard Container 1 -->
                                            <div class="wizard-container">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <h4 class="text-primary"> <i class="fa fa-user"></i> Upload Data </h4>
                                                        <p class="text-muted">  Upload Data through Excel File...</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4 offset-sm-2">
                                                    <label class="control-label"> Enter Phone Number : </label>
                                                       

                                                        <input type="file" name="select_file" class="form-control" id="select_file" placeholder="Enter Category Name" required="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                    <label class="control-label"></label>
                                                         <button type="submit" style="margin-top: 41px;" class="btn btn-info" name="submit" value="Submit">
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
                                        <!--/ END Form Wizard -->
                                                                                    <!-- Wizard Container 2 -->
                                    <div class="panel-body">
                                        
                                        <?php if($uploaded_table != ''){ ?>
                                    <table id="demo-foo-addrow" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                                        <thead>
                                            <tr>
                                                
                                                <th class="w-1">No.</th>
                                                <th data-hide="phone, tablet">File Name</th>
                                                <th data-hide="phone, tablet">Total Record</th>
                                                <th data-hide="phone, tablet">Total Record Accepted</th>
                                                <th data-hide="phone, tablet">Uploaded by</th>
                                                <th data-hide="phone, tablet">Created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                        $count = 1;
                        foreach ($uploaded_table as $uploaded_data):?>
                        <tr>
                          <td><span class="text-muted"><?php echo $count++; ?></span></td>
                          <td><a href="invoice.html" class="text-inherit"><?php echo $uploaded_data->file_name; ?></a></td>
                          <td>
                            <?php echo $uploaded_data->total_record; ?>
                          </td>
                          <td>
                            <?php echo $uploaded_data->total_accepted_record; ?>
                          </td>
                          <td>
                            <?php echo $uploaded_data->username; ?>
                          </td>
                          <td>
                            <?php echo $uploaded_data->created_at; ?>
                          </td>

                        </tr>
                      <?php endforeach; ?>
                                        
                                           
                                        </tbody>
                                        <!-- <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="text-right">
                                                        <ul class="pagination"></ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot> -->
                                    </table>
                                <?php } else{ ?>
                                  <center><h3>Please Search through Phone Number</h3></center>
                                  <?php } ?>
                                </div>




                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <!--===================================================-->
                    <!--End page content-->
                </div>
                <!--===================================================-->
                <!--END CONTENT CONTAINER-->

            </div>
            <!-- FOOTER -->
  