<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title;?>
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- Left col -->

     <section class="content">
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
      <div class="row">

        <section class="col-lg-12 connectedSortable">
        
          <div class="box box-success">
          
            <div class="box-header">
              <!-- start search -->
             

            <!-- end search -->
              <h3 class="box-title"><?php echo $title;?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php foreach ($profile_data as $values) {
                # code...
              }?>
              <form class="form-horizontal" action="<?php echo base_url();?>admin/update_profile" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id" value="<?php echo $values->id;?>">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Category Name" required="" value="<?php echo $values->name;?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" required="" value="<?php echo $values->email;?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" name="password" class="form-control" id="password" placeholder="Enter Password" required="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">User Type</label>
                  <div class="col-sm-10">
                    <!-- <input type="text" name="password" class="form-control" id="password" placeholder="Enter Category Name" required="" value="<?php echo md5($values->password);?>"> -->
                    <select name="user_type" class="form-control" id="user_type" required="">  
                        <option value="Admin">Admin</option>
                    </select> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Category Name" required="" value="<?php echo $values->phone;?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                    <select name="status" class="form-control" id="status" required="">  
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
      
          </div>
          <!-- /.box (chat box) -->
        </section>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
      
        <!-- right col -->
      </div>
    </section>
    <!-- /.content -->
  </div>