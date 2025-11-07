<!--MAIN NAVIGATION-->
                <!--===================================================-->
                <nav id="mainnav-container">
                    <!--Brand logo & name-->
                    <!--================================-->
                    <div class="navbar-header">
                        <a href="index.php" class="navbar-brand">
                            <i class="fa fa-forumbee brand-icon"></i>
                            <div class="brand-title">
                                <span class="brand-text">A1D QA</span>
                            </div>
                        </a>
                    </div>
                    <!--================================-->
                    <!--End brand logo & name-->
                    <div id="mainnav">
                        <!--Menu-->
                        <!--================================-->
                        <div id="mainnav-menu-wrap">
                            <div class="nano">
                                <div class="nano-content">
                                    <ul id="mainnav-menu" class="list-group">
                                        <!--Category name-->
                                        <li class="list-header">Navigation</li>
                                        <!--Menu list item-->
                                        <?php 
                                
                                            $user_type = $this->session->userdata('user_type_1');
                                            if($user_type == 'Administrator' || $user_type == 'LMS TeamLead' || $user_type == 'LMS Manager'){


                                         ?>
                                        <li> <a href="<?php echo base_url('admin'); ?>"> <i class="fa fa-home"></i> <span class="menu-title"> Home </span> </a> </li>
                                        <!--Category name-->
                                    <?php } ?>
                                        

                                        <li class="list-header">Leads</li>
                                        <!--Menu list item-->
                                        <?php 
                                
                                            $user_type = $this->session->userdata('user_type_1');
                                            if($user_type == 'Administrator' || $user_type == 'LMS TeamLead' || $user_type == 'LMS Manager'){


                                         ?>
                                        
                                        <?php } if($user_type == 'Administrator' || $user_type == 'LMS TeamLead' || $user_type == 'LMS Manager' || $user_type == 'CSR'){ ?>
                                       
                                        <?php 
                                    }
                                            $user_type = $this->session->userdata('user_type_1');
                                            if($user_type == 'CSR'){


                                         ?>
                                        
                                        <?php 
                                            }
                                            $user_type = $this->session->userdata('user_type_1');
                                            if($user_type == 'Administrator' || $user_type == 'LMS TeamLead' || $user_type == 'LMS Manager'){


                                         ?>
                                        <li>
                                            <a href="<?php echo base_url('admin/lead_list'); ?>">
                                            <i class="fa fa-list-ul"></i>
                                            <span class="menu-title">
                                            Lead List
                                            </span>
                                            </a>
                                        </li>
                                        <?php } if ($user_type == 'Administrator') {
                                        ?>
                                       
                                        <?php } 
                                        $access_level = $this->session->userdata('access_level_1');
                                        if ($access_level == 'Client' || $access_level == 'AE'){?>
                                            <!-- <li>
                                            <a href="<?php //echo base_url('client/lead_list'); ?>">
                                            <i class="fa fa-list-ul"></i>
                                            <span class="menu-title">
                                            Lead List
                                            </span>
                                            </a>
                                        </li> -->
                                        <?php } ?>


                                    </ul>
                                    <!--Widget-->
                                    <!--================================-->
                                    <!--================================-->
                                    <!--End widget-->
                                </div>
                            </div>
                        </div>
                        <!--================================-->
                        <!--End menu-->
                    </div>
                </nav>
                <!--===================================================-->
                <!--END MAIN NAVIGATION-->