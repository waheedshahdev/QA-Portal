

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
                                        <form class="form-horizontal form-bordered" action="<?php echo base_url('admin/lead_list'); ?>" method="post" id="registrationForm">
                                            <!-- Wizard Container 1 -->
                                            <div class="wizard-container">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <h4 class="text-primary"> <i class="fa fa-user"></i>Lead List </h4>
                                                        <p class="text-muted">  Daily Leads Table...</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4 offset-sm-2">
                                                    <label class="control-label"> From Date : </label>
                                                        <input class="form-control" name="from_date" type="date" placeholder="Type Phone Number" data-parsley-range="[1, 10]" data-parsley-group="order"  />
                                                    </div>
                                                    <div class="col-sm-4 offset-sm-2">
                                                    <label class="control-label"> To Date : </label>
                                                        <input class="form-control" name="to_date" type="date" placeholder="Type Phone Number" data-parsley-range="[1, 10]" data-parsley-group="order"  />
                                                    </div>
                                                    <div class="col-sm-2">
                                                    <label class="control-label"></label>
                                                         <button type="submit" style="margin-top: 41px;" class="btn btn-info" name="search" value="Search">
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
                                        
                                    <?php if($fetch_leads != ''){ ?>
                                    	<h4 style="float: right;">Total Leads: <?php echo $leads_count[0]->cnt ?> </h4>
                                    <table id="demo-foo-addrow" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer Name</th>
                                                <th data-hide="phone, tablet">Phone</th>
                                                <th data-hide="phone, tablet">Client</th>
                                                <th data-hide="phone, tablet">Lo</th>
                                                <th data-hide="phone, tablet">Disposition</th>
                                                <th data-hide="phone, tablet">created_at</th>
                                                <th data-sort-ignore="true" class="min-width">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                          		$count = 0;
                                          		foreach ($fetch_leads as $result):
                                          		
                                          		$customer_name = $result->first_name.' '.$result->middle_name.' '.$result->last_name;
                                          		// $customer_name = $result->first_name.' '.$result->middle_name.' '.$result->last_name;
                                          		$count++;
                                          	?>
                                            <tr>
                                            	<td><?php echo $count; ?></td>
                                            	<td><?php echo $result->username; ?></td>
                                                <td><?php echo $customer_name; ?></td>
                                                <td><?php echo $result->client; ?></td>
                                                <td><?php echo $result->lo; ?></td>
                                                <td><?php echo $result->disposition; ?></td>
                                                <td><?php echo $result->created_at; ?></td>
                                                <td>
                                                    
                                                    <!-- <button ></button> -->
                                                    <a href="<?php echo base_url('admin/edit_lead/'.$result->lead_id.'');?>" class="btn btn-info fa fa-pencil"></a>
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
                                	<center><h3>Sales Not Found yet!</h3></center>
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
  