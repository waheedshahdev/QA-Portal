<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>A1D QA Portal</title>
        <link rel="shortcut icon" href="img/favicon.ico">
        <!--STYLESHEET-->
        <!--=================================================-->
        <!--Roboto Slab Font [ OPTIONAL ] -->

        <!--Bootstrap Stylesheet [ REQUIRED ]-->
        <link href="<?php echo base_url(); ?>adminfiles/assets/css/bootstrap.min.css" rel="stylesheet">
        <!--Jasmine Stylesheet [ REQUIRED ]-->
        <link href="<?php echo base_url(); ?>adminfiles/assets/css/style.css" rel="stylesheet">
        <!--Font Awesome [ OPTIONAL ]-->
        <link href="<?php echo base_url(); ?>adminfiles/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!--Switchery [ OPTIONAL ]-->
        <link href="<?php echo base_url(); ?>adminfiles/assets/plugins/switchery/switchery.min.css" rel="stylesheet">
        <!--Bootstrap Select [ OPTIONAL ]-->
        <link href="<?php echo base_url(); ?>adminfiles/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <!--ricksaw.js [ OPTIONAL ]-->
        <!-- <link href="<?php// echo base_url(); ?>adminfiles/assets/plugins/jquery-ricksaw-chart/css/rickshaw.css" rel="stylesheet"> -->
        <!--Bootstrap Validator [ OPTIONAL ]-->
        <link href="<?php echo base_url(); ?>adminfiles/assets/plugins/bootstrap-validator/bootstrapValidator.min.css" rel="stylesheet">
        <!--Demo [ DEMONSTRATION ]-->
        <link href="<?php echo base_url(); ?>adminfiles/assets/css/demo/jquery-steps.min.css" rel="stylesheet">
        <!--Summernote [ OPTIONAL ]-->
        <link href="<?php echo base_url(); ?>adminfiles/assets/plugins/summernote/summernote.min.css" rel="stylesheet">
        <!--Demo [ DEMONSTRATION ]-->
        <link href="<?php echo base_url(); ?>adminfiles/assets/css/demo/jasmine.css" rel="stylesheet">
        <!--SCRIPT-->
        <!--=================================================-->
        <!--Page Load Progress Bar [ OPTIONAL ]-->
        <link href="<?php echo base_url(); ?>adminfiles/assets/plugins/pace/pace.min.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/pace/pace.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
         <script src="https://cdnjs.com/libraries/Chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style type="text/css">
            .panel {
    padding: 0px 20px !important;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 2px !important;
}
.form-horizontal.form-bordered .form-group>div {
    padding: 10px;
}
 .blink_text {

    animation:2s blinker linear infinite;
    -webkit-animation:2s blinker linear infinite;
    -moz-animation:2s blinker linear infinite;

     color: white;
    }

    @-moz-keyframes blinker {  
     0% { opacity: 1.0; }
     50% { opacity: 0.0; }
     100% { opacity: 1.0; }
     }

    @-webkit-keyframes blinker {  
     0% { opacity: 1.0; }
     50% { opacity: 0.0; }
     100% { opacity: 1.0; }
     }

    @keyframes blinker {  
     0% { opacity: 1.0; }
     50% { opacity: 0.0; }
     100% { opacity: 1.0; }
     }

     .sidenav {
      height: 100%;
    width: 460px;
    position: fixed;
    top: 150px;
    right: 0;
   /* background-color: #168eb5;*/
    overflow-x: hidden;
    padding-top: 20px;
    z-index: 0;
        }


        </style>
    </head>
    <!--TIPS-->
    <!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
    <body>
        <div id="container" class="effect mainnav-sm navbar-fixed mainnav-fixed">
            <!--NAVBAR-->
            <!--===================================================-->
            <header id="navbar">
                <div id="navbar-container" class="boxed">
                    <!--Navbar Dropdown-->
                    <!--================================-->
                    <div class="navbar-content clearfix">
                        <ul class="nav navbar-top-links pull-left">
                            <li class="tgl-menu-btn">
                                <a class="mainnav-toggle" href="#"> <i class="fa fa-navicon fa-lg"></i> </a>
                            </li>
                            <?php 
                                
                                $access_level = $this->session->userdata('access_level_1');
                                if($access_level == 'Client' || $access_level == 'AE'){


                             ?>
                             
                            <?php 
                        }

                                $access_level = $this->session->userdata('access_level_1');
                                if($access_level == 'Client' ){


                             ?>

                              <li>
                                <a href="<?php echo base_url('client/qa_reports'); ?>">
                                    <i class="fa fa-list-ul"></i>
                                    <span class="menu-title">QA Evaluation</span>
                                    <i class="arrow"></i>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('client/qa_clients_leads'); ?>">
                                    <i class="fa fa-list-ul"></i>
                                    <span class="menu-title">QA Summary</span>
                                    <i class="arrow"></i>
                                </a>
                            </li> 

                            <?php 
                                }
                                $user_type = $this->session->userdata('user_type_a1d_qa');
                                if($user_type == 'Administrator' || $user_type == 'LMS TeamLead' || $user_type == 'LMS Manager'){


                             ?>
                            <li class="navlink active">
                                <a href="<?php echo base_url('admin'); ?>">
                                    <i class="fa fa-home"></i>
                                    <span class="menu-title"> Home </span>
                                </a>
                            </li>
                            <?php 
                                }
                                $user_type = $this->session->userdata('user_type_a1d_qa');
                                if($user_type == 'Administrator' || $user_type == 'LMS TeamLead' || $user_type == 'LMS Manager'){


                             ?>
                            
                        <?php } ?>
                            <!--Menu list item-->
                             <?php 
                                
                                $user_type = $this->session->userdata('user_type_a1d_qa');
                                if($user_type == 'Administrator' || $user_type == 'LMS TeamLead' || $user_type == 'LMS Manager' || $user_type == 'CSR'){


                             ?>
                            
                        <?php } ?>
                            <?php 
                                $user_type = $this->session->userdata('user_type_a1d_qa');
                                if($user_type == 'CSR'){


                             ?>
                            
                           
                            <!--Menu list item-->
                            <?php 
                                }
                                $user_type = $this->session->userdata('user_type_a1d_qa');
                                if($user_type == 'QA Manager'){

                             ?>

                              <li>
                                <a href="<?php echo base_url('admin/qa_reports'); ?>">
                                    <i class="fa fa-users"></i>
                                    <span class="menu-title">QA Evaluation</span>
                                    <i class="arrow"></i>
                                </a>
                            </li>
                            
                            <?php 
                                }
                                $user_type = $this->session->userdata('user_type_a1d_qa');
                                if($user_type == 'Administrator' || $user_type == 'QA Manager' || $user_type == 'QA Evaluator' || $user_type == 'LMS Manager'){


                             ?>

                             <li>
                                <a href="<?php echo base_url('admin/qa_list'); ?>">
                                    <i class="fa fa-users"></i>
                                    <span class="menu-title">QA List</span>
                                    <i class="arrow"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/evaluated_leads'); ?>">
                                    <i class="fa fa-users"></i>
                                    <span class="menu-title">Evaluated Leads</span>
                                    <i class="arrow"></i>
                                </a>
                            </li>
                           
                           
                            <?php 
                                }
                                $user_type = $this->session->userdata('user_type_a1d_qa');
                                if($user_type == 'Administrator' || $user_type == 'LMS Manager'){


                             ?>

                            <li>
                                <a href="<?php echo base_url('admin/qa_reports'); ?>">
                                    <i class="fa fa-users"></i>
                                    <span class="menu-title">QA Evaluation</span>
                                    <i class="arrow"></i>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('admin/qa_clients_leads'); ?>">
                                    <i class="fa fa-users"></i>
                                    <span class="menu-title">QA Summary</span>
                                    <i class="arrow"></i>
                                </a>
                            </li>

                           
                         

                           
                        <?php } if ($user_type == 'Administrator') {
                          ?>
                             
                            

                             <li>
                                <a href="<?php echo base_url('admin/ip_whitelist'); ?>">
                                    <i class="fa fa-users"></i>
                                    <span class="menu-title">Add IP</span>
                                    <i class="arrow"></i>
                                </a>
                            </li>
                            
                        <?php }
                        $center = $this->session->userdata('center');
                         if ($user_type == 'Administrator' || $user_type == 'LMS Manager' || $user_type == 'LMS TeamLead' && $center == 'FSC' ){ 
                            ?>
                            
                        <?php }
                         ?>

                        
                            
                        </ul>
                        <ul class="nav navbar-top-links pull-right" class="navvlink">
                            
                          
                            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                            <!--End notifications dropdown-->
                            <li id="dropdown-user" class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                    <span class="pull-right"> <img class="img-circle img-user media-object" src="<?php echo base_url(); ?>adminfiles/assets/img/av1.png" alt="Profile Picture"> </span>
                                    <div class="username hidden-xs"><?php echo $this->session->userdata('username'); ?></div>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right with-arrow">
                                    <!-- User dropdown menu -->
                                    <ul class="head-list">
                                        <!-- <li>
                                            <a href="#"> <i class="fa fa-user fa-fw"></i> Profile </a>
                                        </li>
                                        <li>
                                            <a href="#">  <i class="fa fa-envelope fa-fw"></i> Messages </a>
                                        </li> -->
                                        <?php 
                                            
                                            $user_type = $this->session->userdata('user_type_a1d_qa');
                                            if($user_type == 'Administrator' || $user_type == 'LMS TeamLead' || $user_type == 'LMS Manager'){


                                         ?>
                                        <li>
                                            <a href="<?php echo base_url('admin/change_password'); ?>">  <i class="fa fa-gear fa-fw"></i> Settings </a>
                                        </li>
                                    <?php } ?>
                                        <?php $access_level =  $this->session->userdata('access_level_1');
                                        $user_type = $this->session->userdata('user_type_a1d_qa');
                                        if($access_level == 'Client')
                                        {
                                            $url = base_url('client/logout');
                                        }
                                        elseif ($user_type != 'Client') {
                                            $url = base_url('admin/logout');
                                        }{

                                        }
                                        ?>
                                        <li>
                                            <a href="<?php echo $url; ?>"> <i class="fa fa-sign-out fa-fw"></i> Logout </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                            <!--End user dropdown-->
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End Navbar Dropdown-->
                </div>
            </header>
               
   

            


            

            <!--===================================================-->
            <!--ND NAVBAR-->
             <?php include('admin_sidebar.php') ?> 

            <?php if(isset($view_files))

            $this->load->view($view_module.'/'.$view_files);

            ?>


             <!-- FOOTER -->
            <!--===================================================-->
            <!-- <footer id="footer">
 
                <div class="show-fixed pull-right">

                </div>

                <p class="pad-lft">&#0169; 2020</p>
            </footer> -->
            <!--===================================================-->
            <!-- END FOOTER -->
            <!-- SCROLL TOP BUTTON -->
            <!--===================================================-->
            <button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
            <!--===================================================-->
        </div>
        <!--===================================================-->
        <!-- END OF CONTAINER -->
        <!--JAVASCRIPT-->
        <!--=================================================-->
        <!--jQuery [ REQUIRED ]-->
         <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
                <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->
        <script src="<?php echo base_url(); ?>adminfiles/assets/js/jquery-2.1.1.min.js"></script>
        <!--BootstrapJS [ RECOMMENDED ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">


    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js">
        <!--Fast Click [ OPTIONAL ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/fast-click/fastclick.min.js"></script>
        <!--Jquery Nano Scroller js [ REQUIRED ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/nanoscrollerjs/jquery.nanoscroller.min.js"></script>
        <!--Metismenu js [ REQUIRED ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/metismenu/metismenu.min.js"></script>
        <!--Jasmine Admin [ RECOMMENDED ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/js/scripts.js"></script>
        <!--Switchery [ OPTIONAL ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/switchery/switchery.min.js"></script>
        <!--Jquery Steps [ OPTIONAL ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/parsley/parsley.min.js"></script>
        <!--Jquery Steps [ OPTIONAL ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/jquery-steps/jquery-steps.min.js"></script>
        <!--Bootstrap Select [ OPTIONAL ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <!--Bootstrap Wizard [ OPTIONAL ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <!--Masked Input [ OPTIONAL ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/masked-input/bootstrap-inputmask.min.js"></script>
        <!--Bootstrap Validator [ OPTIONAL ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/bootstrap-validator/bootstrapValidator.min.js"></script>
    
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/moment/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/moment-range/moment-range.js"></script>
        <!--Flot Order Bars Chart [ OPTIONAL ]-->

        <!--ricksaw.js [ OPTIONAL ]-->

       <!--Summernote [ OPTIONAL ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/summernote/summernote.min.js"></script>
        <!--Fullscreen jQuery [ OPTIONAL ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/plugins/screenfull/screenfull.js"></script>
        <!--Form Wizard [ SAMPLE ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/js/demo/wizard.js"></script>
        <!--Form Wizard [ SAMPLE ]-->
        <script src="<?php echo base_url(); ?>adminfiles/assets/js/demo/form-wizard.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>


        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

        <script type="text/javascript">


                            /*jquery Code For Evaluate Lead code*/

 $(function() {

    //date_default_timezone_set('America/Los_Angeles');

    var start = moment();
    var end   = moment();

    function cb(start, end) {
        $('input[name="datefilter"]').html(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
    }

    $('input[name="datefilter"]').daterangepicker({



         locale: {
                format: 'YYYY-MM-DD',
                //separator: " to "

            },

        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);



    

    cb(start, end);

});
/////////////////////////////// Evaluate Lead code ////////////////////////////////////////////


    var scoreArray = $('.score');
    $('.score').change(function() {
        var score = 0;
        $(scoreArray).each(function() {
            score += parseInt($(this).val());
        });
        //score = score * 100 / 32;
        $('#netScore').val(score);

        // set score rating.
        if (parseFloat($('#netScore').val()) >= 95) {
            $('#netRate').val('Good');
        } else if (parseFloat($('#netScore').val()) > 85 && parseFloat($('#netScore').val()) <= 94) {
            $('#netRate').val('Average');
        } else if (parseFloat($('#netScore').val()) <= 85) {
            $('#netRate').val('Bad');
        }
    });

    // if checkbox has been checked.
    $('#check_verify').change(function() {
        if ($(this).prop('checked')) {
            $('#sLBtn').prop('disabled', false);
            $("#sLBtn").css('background', '#6495ed');
        } else {
            $('#sLBtn').prop('disabled', true);
            $("#sLBtn").css('background', '#aaaaaa');
        }
    });


///////////////////////////////END Evaluate Lead code ////////////////////////////////////////////
 


$(document).on('change','#client', function(){

  var client = $('#client').val();
  // alert(client);
  if(client !=''){
    $.ajax({
      url: '<?php echo base_url();?>admin/fetch_client_lo',
      method: 'post',
      data: {client:client},
      success:function(data){
      // alert(data);
       $('#show_lo_box').html(data);
       $('#lo_name').html(data);

      }

    })  

  }


});


$(document).on('change','#state_utility', function(){

  var state = $('#state_utility').val();
  // alert(state);
  if(state !=''){
    $.ajax({
      url: '<?php echo base_url();?>admin/fetch_utilities',
      method: 'post',
      data: {state:state},
      success:function(data){
      // alert(data);
       $('#show_utility_box').html(data);
       // $('#lo_name').html(data);

      }

    })  

  }


});

$(document).on('change','#client', function(){
$('#check_lo_input').hide();
  var client = $('#client').val();
  // alert(client);
  if(client !=''){
    $.ajax({
      url: '<?php echo base_url();?>admin/fetch_client_transfer_number',
      method: 'post',
      data: {client:client},
      success:function(data){
      // alert(data);
       $('#show_transfer').html(data);
       
       
      }

    })  

  }


});
$(document).on('change','#user_type', function(){

  var client = $('#user_type').val();
//alert(client);

  if(client !=''){
    $.ajax({
      url: '<?php echo base_url();?>admin/fetch_client_lo',
      method: 'post',
      data: {client:client},
      success:function(data){
      // alert(data);
       $('#show_lo_box').html(data);
       $('#lo_name').html(data);

      }

    })  

  }


});


$(document).on('change','.check_lo', function(){
    var lo = $('#lo').val();
    // alert(lo);

    if(lo == 'Other' || lo == 'other'){

       $('#check_lo_input').show();
    }
    else{
        $('#check_lo_input').hide();
    }



});
$(document).on('change','.check_utility', function(){
    var electric_company = $('#electric_company').val();
    // alert(electric_company);

    if(electric_company == 'Other' || electric_company == 'other'){

       $('#check_other_utility_input').show();
    }
    else{
        $('#check_other_utility_input').hide();
    }



});


//////////// Block Employee //////////////////
$(document).on('click','.block_employee', function(){

  var ein = $(this).attr('id');
// alert(ein);

  if(confirm('Are you sure you want to Block Employee?')){
    $.ajax({
      url: '<?php echo base_url();?>admin/block_employee',
      method: 'post',
      data: {ein:ein},
      success:function(data){
        
       location.reload();

      }

    })  

  }
  else{
    return false;
  }



});
//////////// END Block Employee //////////////////

//////////// Open Lead //////////////////
$(document).on('click','.open_lead', function(){

  var phone = $(this).attr('id');
// alert(ein);

  if(confirm('Are you sure you want to open this lead?')){
    $.ajax({
      url: '<?php echo base_url();?>admin/open_lead',
      method: 'post',
      data: {phone:phone},
      success:function(data){
        
       location.reload();

      }

    })  

  }
  else{
    return false;
  }



});
//////////// END Open Lead //////////////////

//////////// Block Employee //////////////////
$(document).on('click','.unblock_employee', function(){

  var ein = $(this).attr('id');
// alert(ein);

  if(confirm('Are you sure you want to Active Employee?')){
    $.ajax({
      url: '<?php echo base_url();?>admin/unblock_employee',
      method: 'post',
      data: {ein:ein},
      success:function(data){
        
       location.reload();

      }

    })  

  }
  else{
    return false;
  }



});
//////////// END Block Employee //////////////////

//////////// Add user DropDown //////////////////
$(document).on('change','#access_level', function(){

  var access_level = $('#access_level').val();

  if(access_level !=''){
    $.ajax({
      url: '<?php echo base_url();?>admin/fetch_access_level',
      method: 'post',
      data: {access_level:access_level},
      success:function(data){
        
       $('#user_type').html(data);

      }

    })  

  }


});

///////////// END add User DropDown ////////////
//////////// Assign Data to Agents ////////////



/////////// END assign Data /////////////////

//////////// Assign Data to Agents ////////////
 
 $(document).on('click','#change_disposotion_by_agent',function(){
  
  if(confirm("Are you sure you want to Change Disposition?"))
  {

   var id = [];
   var data_file_id = [];
   var disposition_status = $('#disposition_status').val();
   $('#get_checkbox_value_from_agent:checked').each(function(i){
    data_file_id[i] = $(this).data('data_file_id');
    
   });
     // alert(data_file_id);
   if(data_file_id.length === 0) //tell you if the array is empty
   {
    alert("Please Select atleast one checkbox");
   }
   else
   {
    $.ajax({
     url:'<?php echo base_url() . 'admin/change_disposition_by_agent'; ?>',
     method:'POST',
     data:{data_file_id:data_file_id,disposition_status:disposition_status},
     success:function()
     {
      alert('Assigned Successfully');
      location.reload();
     }
     
    });
   }
   
  }
  else
  {
   return false;
  }
 });
 


$(document).ready(function(){

 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search == '')
  {
   $('#search_result').html('<h5>Enter Zip To Search</h5>');
  }
  else
  {
   $('#search_result').html('');
        $.ajax({
           url:"<?php echo base_url(). 'admin/fetch_candidate_search'?>",
           method:"POST",
           data:{search:search},
           dataType: 'text',
           success:function(data)
           {
            $('#search_result').html(data);
           }
          });

  }
 });
});

 /////////////////////////////////////////////////////////////////////////////////////////////////////////////


 $(document).ready(function(){

 $('.zip_client').click(function(){
   var client= $(this).attr('id');
   //alert(client);
  
   $('#search_zips').html('');
        $.ajax({
           url:"<?php echo base_url(). 'admin/fetch_zips'?>",
           method:"POST",
           data:{client:client},
           dataType: 'text',
           success:function(data)
           {
            $('#search_zips').html(data);
           }
          });

  
 });
});

 /////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

    $(document).on('click', '.edit_user', function() {

            var id = $(this).attr('id');

            // alert(id);

            $.ajax({
                url: "<?php echo base_url(). 'admin/fetch_user'?>",
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {

                        id = value.id;
                        ein = value.ein;
                        username = value.username;
                        cnic = value.cnic;
                        email = value.email;
                        access_level = value.access_level;
                        user_type = value.user_type;
                        center = value.center;
                        agent_status = value.agent_status;
                        lo_name = value.lo_name;
                        team_id = value.team_id;
                        password= value.password;
                        center= value.center;

                    })
                   

                    $('#id').val(id);
                    $('#ein').val(ein);
                    $('#username').val(username);
                    $('#cnic').val(cnic);
                    $('#email').val(email);
                    $('#access_level').val(access_level);
                    $('#user_type').val(user_type);
                    $('#center').val(center);
                    $('#agent_status').val(agent_status);
                    $('#lo_name').val(lo_name);
                    $('#team_lead').val(team_id);
                    $('#center').val(center);

                    $('#submit_user').val('Update User');
                    $('#myModal').modal('show');

                }

            })

        });

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

    $(document).on('click', '.edit_ip', function() {

            var id = $(this).attr('id');

            // alert(id);

            $.ajax({
                url: "<?php echo base_url(). 'admin/fetch_ip'?>",
                method: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {

                        id = value.id;
                        
                        ip_name = value.ip_name;
                        ip_address = value.ip_address;
                        

                    })
                   

                    $('#id').val(id);
                   
                    $('#ip_name').val(ip_name);
                    $('#ip_address').val(ip_address);
                   
                   

                }

            })

        });

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // sub zips
       var tbl_zip;
    $(document).ready(function(){ 

      tbl_zip = $('#zips_table').DataTable({  
           "processing":true,  
           "serverSide":true,  
           "order":[],  
           "ajax":{  
                url:"<?php echo base_url() . 'admin/zip_datatable'; ?>",  
                type:"POST"  
           },  
           "columnDefs":[  
                {  
                     "targets":[0, 3, 5],  
                     "orderable":false,  
                },  
           ],  
      });  
 });
    // end sub zips
/////////// END assign Data /////////////////
// lead Search Code here










         $(function () {

        $("#btnClick").click(function () {

            var selected = new Array();
            // alert(selected);

            $("#order-table input[type=checkbox]:checked").each(function () {

                selected.push(this.value);

            });

               alert(selected);

             if (selected.length > 0) {

                  $.ajax({
                    url: '<?php echo base_url(). 'admin/downlod_specific_leads'?>',
                    method: 'post',
                    data: {
                        selected: selected
                    },
                    success: function(data) {
                        alert(data);
                      //  window.location.reload();
                        //$('#search_dnc_div').reload();
                        //$('#search_dnc_frm')[0].reset();
                       // $("#mydiv2").load(location.href + " #mydiv2>*", "");


                    }

                })


            //     alert("Selected values: " + selected.join(","));

             }

        });

    });



// end lead search Code

        </script>
        <script type="text/javascript">
    function dis(){
        if ($('#disp').val()=='Others') {

            $("#other_dispo").show();
             
           // alert("others");
        }else{
            $("#other_dispo").hide();

           // alert("not others");
        }
    }
</script>
    </body>
</html>