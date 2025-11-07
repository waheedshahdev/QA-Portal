

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
            <?php foreach ($data_found as $data) {
                # code...
            } ?>
                                        <form class="form-horizontal form-bordered" action="<?php echo base_url('admin/add_new_lead'); ?>" method="post" id="registrationForm">
                                            <!-- Wizard Container 1 -->
                                            <div class="wizard-container">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <h4 class="text-primary"> <i class="fa fa-user"></i> Personal Details </h4>
                                                        <p class="text-muted"> Enter Your Personal Details...</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">
                                                    <label class="control-label"> First Name : </label>
                                                        <input class="form-control" name="first_name" type="text" placeholder="Type your First Name" data-parsley-range="[1, 10]" data-parsley-group="order" value="<?php echo $data->first_name; ?>"  />
                                                    </div>
                                                    <div class="col-sm-4">
                                                    <label class="control-label"> Middle Name : </label>
                                                        <input class="form-control" name="middle_name" type="text" placeholder="Type your Middle Name" data-parsley-range="[1, 10]" data-parsley-group="order" value="<?php echo $data->middle_name; ?>"  />
                                                    </div>
                                                    <div class="col-sm-4">
                                                    <label class="control-label"> Last Name : </label>
                                                        <input class="form-control" name="last_name" type="text" placeholder="Type your Last Name" data-parsley-range="[1, 10]" data-parsley-group="order" value="<?php echo $data->last_name; ?>"   />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-3">
                                                    <label class="control-label"> Street Address : </label>
                                                        <input class="form-control" name="address" type="text" placeholder="Type your Address" data-parsley-range="[1, 100]" data-parsley-group="order" value="<?php echo $data->address; ?>"   />
                                                    </div>
                                                    <div class="col-sm-3">
                                                    <label class="control-label"> City : </label>
                                                        <input class="form-control" name="city" type="text" placeholder="Type your City" data-parsley-range="[1, 10]" data-parsley-group="order" value="<?php echo $data->address; ?>"   />
                                                    </div>
                                                    <div class="col-sm-3">
                                                    <label style="margin-bottom: 15px;padding-top: 7px;">State: </label>
                                                        <select class="form-control" id="source" name="state">
                                                            <?php
                                                            if (isset($data->state)) {echo "<option value=".$data->state." selected>".$data->state."</option>";}
                                                                           
                                                            ?>
                                                            <option value="">Select State</option>
                                                            <option value="AL">AL</option>
                                                            <option value="AK">AK</option>
                                                            <option value="AZ">AZ</option>
                                                            <option value="AR">AR</option>
                                                            <option value="CA">CA</option>
                                                            <option value="CO">CO</option>
                                                            <option value="CT">CT</option>
                                                            <option value="DE">DE</option>
                                                            <option value="DC">DC</option>
                                                            <option value="FL">FL</option>
                                                            <option value="GA">GA</option>
                                                            <option value="HI">HI</option>
                                                            <option value="ID">ID</option>
                                                            <option value="IL">IL</option>
                                                            <option value="IN">IN</option>
                                                            <option value="IA">IA</option>
                                                            <option value="KS">KS</option>
                                                            <option value="KY">KY</option>
                                                            <option value="LA">LA</option>
                                                            <option value="ME">ME</option>
                                                            <option value="MD">MD</option>
                                                            <option value="MA">MA</option>
                                                            <option value="MI">MI</option>
                                                            <option value="MN">MN</option>
                                                            <option value="MS">MS</option>
                                                            <option value="MO">MO</option>
                                                            <option value="MT">MT</option>
                                                            <option value="NE">NE</option>
                                                            <option value="NV">NV</option>
                                                            <option value="NH">NH</option>
                                                            <option value="NJ">NJ</option>
                                                            <option value="NM">NM</option>
                                                            <option value="NY">NY</option>
                                                            <option value="NC">NC</option>
                                                            <option value="ND">ND</option>
                                                            <option value="OH">OH</option>
                                                            <option value="OK">OK</option>
                                                            <option value="OR">OR</option>
                                                            <option value="PA">PA</option>
                                                            <option value="RI">RI</option>
                                                            <option value="SC">SC</option>
                                                            <option value="SD">SD</option>
                                                            <option value="TN">TN</option>
                                                            <option value="TX">TX</option>
                                                            <option value="UT">UT</option>
                                                            <option value="VT">VT</option>
                                                            <option value="VA">VA</option>
                                                            <option value="WA">WA</option>
                                                            <option value="WV">WV</option>
                                                            <option value="WI">WI</option>
                                                            <option value="WY">WY</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                    <label class="control-label"> Zip : </label>
                                                        <input class="form-control" name="zip_code" type="number" placeholder="Type your Zip" data-parsley-range="[1, 10]" data-parsley-group="order" value="<?php echo $data->zip_code; ?>"   />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    
                                                    

                                                </div>
                                            </div>

                                            <!-- Wizard Container 2 -->
                                            <div class="wizard-container">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <h4 class="text-primary"> <i class="fa fa-sign-in"></i> Contact Information </h4>
                                                        <p class="text-muted"> Contact Information About Applicant... </p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Home Phone #:</label>
                                                            <input type="text" placeholder="9999999999" data-mask="9999999999" class="form-control" name="phone" data-parsley-group="order" value="<?php echo $data->phone; ?>"   />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Mobile Phone #:</label>
                                                            <input type="text" name="mobile_phone" placeholder="999999999999" data-mask="9999999999" class="form-control" data-parsley-group="order" value="<?php echo $data->mobile_phone; ?>"  />
                                                        </div>
                                                        <div class="col-md-4">
                                                        <label class="control-label" style="padding-top: 0;margin-bottom: 5px;"> Email Address : </label>
                                                            <input class="form-control" name="email" type="email" placeholder="Type your Email" data-parsley-group="order" value="<?php echo $data->email; ?>"   />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Wizard Container 3 -->
                                            <div class="wizard-container">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <h4 class="text-primary"> <i class="fa fa-book"></i> Financial Informations </h4>
                                                        <p class="text-muted"> Financial Information About Applicant... </p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label> House Type: </label>
                                                            <select name="house_type" class="form-control" data-parsley-group="payment" data-parsley-required>
                                                                <?php
                                                            if (isset($data->house_type)) {echo "<option value=".$data->house_type." selected>".$data->house_type."</option>";}
                                                                           
                                                            ?>
                                                                <option value="">Select One</option>
                                                                <option value="Single Family">Single Family</option>
                                                                <option value="Mobile Home">Mobile Home</option>
                                                                <option value="Manufactured House">Manufactured House</option>
                                                                <option value="Condominium">Condominium</option>
                                                                <option value="Appartment">Appartment</option>
                                                                <option value="Farm">Farm</option>
                                                                <option value="Other">Other</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label> Electricity Bill: </label>
                                                            <select name="electricity_bill" class="form-control" data-parsley-group="payment" data-parsley-required required="">
                                                                <?php
                                                            if (isset($data->electricity_bill)) {echo "<option value=".$data->electricity_bill." selected>".$data->electricity_bill."</option>";}
                                                                           
                                                            ?>
                                                                <option value=""> Please Select One</option>
                                                                <option value="Less than $100">Less than $100</option>
                                                                <option value="$100-$125">$100-$125</option>
                                                                <option value="$125-$150">$125-$150</option>
                                                                <option value="$150-$200">$150-$200</option>
                                                                <option value="Above $200">Above $200</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label" style="padding-top: 0;margin-bottom: 5px;"> Electric Company: </label>
                                                            <input class="form-control" name="electric_company" type="text" placeholder="Type your Electric Company" data-parsley-range="[1, 10]" data-parsley-group="order" value="<?php echo $data->electric_company; ?>"  />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label> Discounts: </label>
                                                            <select name="discounts" class="form-control" data-parsley-group="payment" data-parsley-required>
                                                                    <?php
                                                            if (isset($data->discounts)) {echo "<option value=".$data->discounts." selected>".$data->discounts."</option>";}
                                                                           
                                                            ?>
                                                                <option value="">Select One</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label> Credit Rating: </label>
                                                            <select name="credit_rating" class="form-control" data-parsley-group="payment" data-parsley-required required="">
                                                                <?php
                                                            if (isset($data->credit_rating)) {echo "<option value=".$data->credit_rating." selected>".$data->credit_rating."</option>";}
                                                                           
                                                            ?>
                                                                <option value="">Select One</option>
                                                                <option value="Fair">Fair</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Excellent">Excellent</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label> Income: </label>
                                                            <select name="income" class="form-control" data-parsley-group="payment" data-parsley-required required=""> 
                                                                <?php
                                                            if (isset($data->income)) {echo "<option value=".$data->income." selected>".$data->income."</option>";}
                                                                           
                                                            ?>
                                                                <option value="">Select One</option>
                                                                <option value="Below $45000">Below $45000</option>
                                                                <option value="Above $45000">Above $45000</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label> Shading: </label>
                                                            <select name="shading" class="form-control" data-parsley-group="payment" data-parsley-required required="">
                                                                <?php
                                                            if (isset($data->shading)) {echo "<option value=".$data->shading." selected>".$data->shading."</option>";}
                                                                           
                                                            ?>
                                                                <option value="">Select One</option>
                                                                <option value="None">None</option>
                                                                <option value="Partial less than 50%">Partial less than 50%</option>
                                                                <option value="More than 50%">More than 50%</option>
                                                                <option value="Full">Full</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <!--/ Wizard Container 3 -->


                                            <!-- Wizard Container 3 -->
                                            <div class="wizard-container">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <h4 class="text-primary"> <i class="fa fa-book"></i> Clients Informations </h4>
                                                        <p class="text-muted"> Clients Information... </p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label> Client: </label>
                                                            <select name="client" class="form-control client_lo" data-parsley-group="payment" data-parsley-required id="client" >
                                                         
                                                                <option value="">Please Select Client</option>
                                                               <?php foreach ($clients as $client):?>
                                                                <option value="<?php echo $client->client_name; ?>"><?php echo $client->client_name; ?></option>
                                                               <?php endforeach; ?> 
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label> LO: </label>
                                                          
                                                                <select name="lo" class="form-control" data-parsley-group="payment" id="lo" data-parsley-required required="">

                                                                </select>
                                                            
                                                            
                                                          

                                                            
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <label> Disposition: </label>
                                                            <select name="disposition" class="form-control" data-parsley-group="payment" data-parsley-required required="">
                                                               
                                                                <option value="">Select Disposition</option>
                                                                <option value="Callback">Callback</option>
                                                                <option value="Not Interested">Not Interested</option>
                                                                <option value="Live Transfer">Live Transfer</option>
                                                                <option value="DNC">DNC</option>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                


                                            </div>
                                            <!--/ Wizard Container 3 -->



                                            <div class="panel-footer">
                                            <div class="form-group">
                                                <div class="col-md-12 text-right">
                                                    <button type="submit" class="btn btn-info btn-lg" name="transfer" value="Save">
                                                    Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

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
