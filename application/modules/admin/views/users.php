
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
                                                        <button id="demo-btn-addrow" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add User</button>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 text-xs-center text-right">
                                                    <!-- <div class="form-group">
                                                        <input id="demo-input-search2" type="text" placeholder="Search" class="form-control" autocomplete="off">
                                                    </div> -->
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
                                                <th data-hide="phone, tablet">Center</th>
                                                <th data-hide="phone, tablet">Team</th>
                                                <th data-sort-ignore="true" class="min-width">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach ($user_data as $user):
                                              $team_id = $user->team_id;

                                            $get_team_name = select_columns('employee_name','employee_data', 'ein='.$team_id.'');
                                            if(empty($get_team_name))
                                            {
                                                $team_name = 'Not Assign';
                                            }
                                            else{
                                              $team_name = $get_team_name[0]->employee_name;
                                            }
                                            $status = $user->status;
                                            if($status == 'Active'){
                                                $label = '<label class="label label-success">Active</label>';
                                                $btn = '<button class="btn btn-danger fa fa-lock block_employee" id="'.$user->ein.'"></button>';
                                            }
                                            elseif ($status == 'Block') {
                                              $label = '<label class="label label-danger">Block</label>';
                                              $btn = '<button class="btn btn-success fa fa-unlock unblock_employee" id="'.$user->ein.'"></button>';
                                            }



                                            ?>
                                            <tr>
                                                <td><?php echo $user->ein; ?></td>
                                                <td><?php echo $user->username; ?></td>
                                                <td><?php echo $user->email; ?></td>
                                                <td><?php echo $user->access_level; ?></td>
                                                <td><?php echo $user->user_type; ?></td>
                                                <td  style="font-size: 100% !important;"><?php echo $label; ?></td>
                                                <td><?php echo $user->center; ?></td>
                                                <td><?php echo $team_name; ?></td>
                                                <td>
                                                    <!-- <button class="btn btn-danger fa fa-trash"></button> -->
                                                    <?php 
                                                        echo $btn;
                                                     ?>
                                                <button name="edit" id="<?php echo $user->id;?>" class="btn btn-warning btn-sm fa fa-pencil edit_user"></button><a href="<?php echo base_url('admin/delete_user/'.$user->id.''); ?>" class="btn btn-danger btn sm  fa fa-trash"></a>
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
                    
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">CNIC</label>
                  <div class="col-sm-10">
                    
                    <input type="text" name="cnic" class="form-control" id="cnic" placeholder="Enter CNIC">
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
                    <input type="password" name="password" class="form-control" id="password" autocomplete="off" placeholder="Enter Password">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Confirm Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Enter Password">
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
                        <option value="AE">AE</option>
                    </select> 
                  </div>
                </div>   

                  <input type="hidden" name="id" class="form-control" id="id" value="">
        
                    <input type="hidden" name="ein" class="form-control" id="ein">
                 

                  <div class="form-group">
                  <label class="col-sm-2 control-label">Team</label>
                  <div class="col-sm-10">
                    <span style="color: red;">Do not Select Team if the user is TeamLead.</span>
                    <select name="team_lead" class="form-control" id="team_lead" style="height: 35px;">  
                        
                        <option value="">Select Team Lead</option>

                         <?php foreach ($user_team as $user => $value)
                         {
                         ?>
                            <option value="<?php echo $value->ein;?>"><?php echo $value->username;?></option>
                        <?php
                         } 

                        ?>
                   
                    </select> 

                  </div>


                </div>              
                <div class="form-group">
                  <label class="col-sm-2 control-label">User Type</label>
                  <div class="col-sm-10">

                    <select name="user_type" onchange="chec_lo()" class="form-control" id="user_type"  style="height: 35px;">  
                        <option value="">Select One</option>
                        <?php foreach ($clients as $key => $value) {
                          ?>
                        <option  value="<?php echo $value->client_name; ?>"><?php echo $value->client_name; ?></option>
                          <?php
                        } ?>
                   
                    </select> 
                  </div>
                </div>  

<!-- <div class="form-group">
                  <label class="col-sm-2 control-label">User Type</label>
                  <div class="col-sm-10">
                    <select name="user_type" onchange="chec_lo()" class="form-control" id="user_type" style="height: 35px;">  
                        
                    </select> 
                  </div>
                </div>
 -->


                <div class="form-group">
                  <label class="col-sm-2 control-label">AE</label>
                  <div class="col-sm-10">
                    <span style="color: red;">Do not Select AE if User is Client.</span>
                    <select name="lo_name" class="form-control" id="lo" style="height: 35px;">  
                      <!--   <option value="">Select One</option>
                        <?php //foreach ($lo as $key => $value) {
                        //  ?>
                       // <option value="<?php //echo $value->lo; ?>"><?php //echo $value->lo; ?></option>
                          <?php
                       // } ?> -->
                   
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
                </div><div class="form-group">
                  <label class="col-sm-2 control-label">Center</label>
                  <div class="col-sm-10">
                   <select class="form-control" name="center" id="center">
                                                           
                                                            <option value="FSC">FSC</option>
                                                            <option value="TLH">TLH</option>
                                                            <option value="ITS">ITS</option>
                                                            <option value="IDS">IDS</option>
                                                        </select>
                  </div>
                </div>
              </div>
              
              <div class="box-footer">
              
                <input type="submit" name="submit" id="submit_user" value="Submit" class="btn btn-success pull-right" style="margin-left: 10px;margin-top:25px;">
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
            <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
            <script type="text/javascript">
              function chec_lo() {
                var client = $('#user_type').val();
                //alert(client);

  if(client !=''){
    $.ajax({
      url: '<?php echo base_url();?>admin/fetch_lo',
      method: 'post',
      data: {client:client},
      success:function(data){
        //alert(data);
       $('#lo').html(data);

      }

    })  

  }
              }
            </script>