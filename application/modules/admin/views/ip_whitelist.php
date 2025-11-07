            <div class="boxed">
                <!--CONTENT CONTAINER-->
                <!--===================================================-->
                <div id="content-container">
                <div class="pageheader hidden-xs">
                  <h3><i class="fa fa-home"></i> IP Address </h3>
                    <div class="breadcrumb-wrapper">
                      <span class="label">You are here:</span>
                         <ol class="breadcrumb">
                            <li> <a href="#"> Home </a> </li>
                            <li class="active"> Add IP Address </li>
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

                                         <form class="form-horizontal form-bordered" action="<?php echo base_url('admin/ip_whitelist'); ?>" method="post" id="ip_form">
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
                                                    <label class="control-label">IP Name : </label>
                                                   
                                                     <br>
                                                       
                                                        <input type="text" name="ip_name" placeholder="Enter IP Name" value="" data-parsley-group="order" style="display: block;   width: 100%;  height: 34px;  padding: 6px 12px; font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff; background-image: none; border: 1px solid #ccc;"/>
                                                    </div>
                                                    <div class="col-sm-2 offset-sm-2">
                                                    <label class="control-label"> IP Address : </label><br>
                                                       
                                                        <input  name="ip_address" type="text" value="" placeholder="Enter IP Address" data-parsley-group="order" style="display: block;   width: 100%;  height: 34px;  padding: 6px 12px; font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff; background-image: none; border: 1px solid #ccc;" />
                                                    </div> 
                                                    
                                                    
                                                   
                                                    <div class="col-sm-1">
                                                    <label class="control-label"></label>
                                                         <button type="submit" style="margin-top: 41px;" class="btn btn-success" name="submit" value="Submit">
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
                                    
                                      <div class="card-tab">
                                        <div class="dt-responsive table-responsive1">
                                           <div class="row">
                                             <div class="col-sm-12">
                                                <table id="order-table" class="table table-striped table-bordered nowrap  xxx"
                                                    role="grid" aria-describedby="order-table_info">
                                                    <thead style="border-top: 1px solid #dee2e6;">
                                                        <tr role="row">
                                                            <th class="tthead min-w-30px">#</th>
                                                            <th class="tthead min-w-30px">Name</th>
                                                            <th class="tthead" style="text-align: left;">IP Address</th>
                                                            <th class="tthead" style="text-align: left;">Added By</th>
                                                            <th class="tthead" style="text-align: left;">Added on</th>
                                                            <th class="tthead" style="text-align: left;">Action</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody style="border-top: 1px solid #dee2e6;">
                                                      <?php

                                                                            $count = 1;
                                                                            foreach ($ip_address as $ip):
                                                                              
                                                                             
                                                                            ?> 
                                                        <tr role="row" class="even">
                                                            <td><?php echo $count++ ; ?>
                                                            </td>
                                                            <td><?php echo $ip->ip_name; ?></td>
                                                            <td><?php echo $ip->ip_address; ?></td>
                                                            <td style="text-align: left;"><?php echo $ip->employee_name; ?>
                                                            </td>
                                                          
                                                            <td><?php echo $ip->created_at; ?>
                                                            </td>
                                                            <td>
                                                    <!-- <button class="btn btn-danger fa fa-trash"></button> -->
                                                    <?php 
                                                        //echo $btn;
                                                     ?>
                                                <button name="edit" id="<?php echo $ip->id;?>" data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-sm fa fa-pencil edit_ip"></button><a href="<?php echo base_url('admin/delete_ip/'.$ip->id.''); ?>" class="btn btn-danger btn sm  fa fa-trash"></a>
                                                </td>
                                                            
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
<!-- Add User Modal Here -->
<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">Edit IP Address</h4>
        </div>
        <div class="modal-body">

                  <form class="form-horizontal" action="<?php echo base_url();?>admin/ip_whitelist" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">IP Name</label>
                  <div class="col-sm-10">
                    
                    <input type="text" name="ip_name" class="form-control" id="ip_name" placeholder="Enter IP Name" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">IP Address</label>
                  <div class="col-sm-10">
                    
                    <input type="text" name="ip_address" class="form-control" id="ip_address" placeholder="Enter IP Address">
                  </div>
                </div>

                


                 

                  <input type="hidden" name="id" class="form-control" id="id" value="">
        
                   
            
              </div>
              
              <div class="box-footer">
              
                <input type="submit" name="submit" id="submit_ip" value="Update IP" class="btn btn-success pull-right" style="margin-left: 10px;margin-top:25px;">
              </div>
            
            </form>
        
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<!-- End Add User Modal -->



                    <!--===================================================-->
                    <!--End page content-->
                </div>
                <!--===================================================-->
                <!--END CONTENT CONTAINER-->
                




            </div>




