

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
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<section class="panel" style="padding: 20px;">
<!--                                     <div class="panel-heading">
                                        <h3 class="panel-title">Form </h3>
                                    </div> -->
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

                                    	<form role="form" action="<?php echo base_url(); ?>admin/change_password" method="post">
                                    		<div class="form-group">
                                    			<label for="inputUsernameEmail">Old Password</label>
                                    			<input type="password" name="old_password" id="old_password" class="form-control" id="inputUsernameEmail" placeholder="Enter Your Old Password">
                                    		</div>
                                    		<div class="form-group">
                                    			<label for="inputPassword">New Password</label>
                                    			<input type="password" name="new_password" id="new_password" class="form-control" id="inputPassword" placeholder="Enter your New Password">
                                    		</div>

                                    		<div class="form-group">
                                    			<label for="inputPassword">Confirm New Password</label>
                                    			<input type="password" name="confirm_password" id="confirm_password" class="form-control" id="inputPassword" placeholder="Confirm Your New Password">
                                    		</div>
                                    		<div class="pull-left pad-btm">
                                    <!-- <div class="checkbox">
                                        <label class="form-checkbox form-icon form-text">
                                            <input type="checkbox"> Remember Me
                                        </label>
                                    </div> -->
                                </div>
                                <button type="submit" name="submit" value="Change Password" class="btn btn btn-info pull-right">
                                	Submit
                                </button>
                            </form>



                            <!--/ END Form Wizard -->
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
