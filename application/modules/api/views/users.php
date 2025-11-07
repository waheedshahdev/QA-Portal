
            <div class="boxed">
                <!--CONTENT CONTAINER-->
                <!--===================================================-->
                <div id="content-container">
                    <div class="pageheader hidden-xs">
                        <h3><i class="fa fa-home"></i> All User's </h3>
                        <div class="breadcrumb-wrapper">
                            <span class="label">You are here:</span>
                            <ol class="breadcrumb">
                                <li> <a href="#"> Home </a> </li>
                                <li class="active"> all users </li>
                            </ol>
                        </div>
                    </div>
                    <!--Page content-->
                    <!--===================================================-->

                    <div id="page-content">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Add &amp; Remove User</h3>
                                </div>
                                <!-- Foo Table - Add & Remove Rows -->
                                <!--===================================================-->
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
                                <div class="panel-body">
                                        <div class="pad-btm form-inline">
                                            <div class="row">
                                                <div class="col-sm-6 text-xs-center">
                                                    <div class="form-group">
                                                        <button id="demo-btn-addrow" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Add User</button>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 text-xs-center text-right">
                                                    <div class="form-group">
                                                        <input id="demo-input-search2" type="text" placeholder="Search" class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <table id="demo-foo-addrow" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                                        <thead>
                                            <tr>
                                                <th data-sort-initial="true" data-toggle="true">EIN</th>
                                                <th>Username</th>
                                                <th data-hide="phone, tablet">Email</th>
                                                <th data-hide="phone, tablet">Access Level</th>
                                                <th data-hide="phone, tablet">User Type</th>
                                                <th data-hide="phone, tablet">Status</th>
                                                <th data-sort-ignore="true" class="min-width">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach ($user_data as $user):?>
                                            <tr>
                                                <td><?php echo $user->ein; ?></td>
                                                <td><?php echo $user->username; ?></td>
                                                <td><?php echo $user->email; ?></td>
                                                <td><?php echo $user->access_level; ?></td>
                                                <td><?php echo $user->user_type; ?></td>
                                                <td><?php echo $user->status; ?></td>
                                                <td>
                                                    <button class="btn btn-danger fa fa-trash"></button>
                                                    <button class="btn btn-danger fa fa-lock"></button>
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
                                </div>
                                <!--===================================================-->
                                <!-- End Foo Table - Add & Remove Rows -->
                            </div>
                        </div>
                    </div>
                    <!--===================================================-->
                    <!--End page content-->
                </div>
                <!--===================================================-->
                <!--END CONTENT CONTAINER-->


<!-- Add User Modal Here -->
<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">Add User</h4>
        </div>
        <div class="modal-body">

                  <form class="form-horizontal" action="<?php echo base_url();?>admin/add_user" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter Category Name" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">CNIC</label>
                  <div class="col-sm-10">
                    
                    <input type="text" name="cnic" class="form-control" id="cnic" placeholder="Enter Category Name">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" name="password" class="form-control" id="password" placeholder="Enter Password" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Confirm Password</label>
                  <div class="col-sm-10">
                    <input type="text" name="confirm_password" class="form-control" id="confirm_password" placeholder="Enter Password" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Access Level</label>
                  <div class="col-sm-10">

                    <select name="access_level" class="form-control" id="access_level" required="" style="height: 35px;">  
                        <option value="">Select One</option>
                        <option value="Agent">Agent</option>
                        <option value="Management">Management</option>
                        <option value="Support">Support</option>
                        <option value="Client">Client</option>
                    </select> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">User Type</label>
                  <div class="col-sm-10">
                    <select name="user_type" class="form-control" id="user_type" style="height: 35px;">  
                        <option value="">Select One</option>
                        <option value="CSR">CSR</option>
                        <option value="Administrator">Administrator</option>
                        <option value="LMS TeamLead">LMS TeamLead</option>
                        <option value="LMS Manager">LMS Manager</option>
                        <option value="HR">HR</option>
                    </select> 
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                    <select name="status" class="form-control" id="status" required="" style="height: 35px;">  
                        <option value="Active">Active</option>
                        <option value="Block">Block</option>
                    </select> 
                  </div>
                </div>
              </div>
              
              <div class="box-footer">
                
                <button type="submit" name="submit" value="Submit" class="btn btn-info pull-right">Submit</button>
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









            </div>