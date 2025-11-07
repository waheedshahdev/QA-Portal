<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    
    <title>Sound Effects</title>
    <!-- Loading third party fonts -->
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>demofiles/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Loading main css file -->
    <link rel="stylesheet" href="<?php echo base_url();?>demofiles/css/style.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--[if lt IE 9]>
    <script src="js/ie-support/html5.js"></script>
    <script src="js/ie-support/respond.js"></script>
    <![endif]-->

  </head>

  <body class="header-collapse">
    
    <div id="site-content">
      <header class="site-header">
        <div class="container">
          <a href="index.html" id="branding">
            <!-- <img src="dummy/logo.png" alt="Site Title"> -->
          <div class="row catagorie text-center">
            <h5 style="color: #fd5927;">SOUND EFFECTS</h5>
          </div>
            <small class="site-description" style="color:white;">Sound Effects Slogan</small>
          </a> <!-- #branding -->
          
          <nav class="main-navigation">
            <button type="button" class="toggle-menu"><i class="fa fa-bars"></i></button>
            <ul class="menu">
              <li class="menu-item current-menu-item"><a href="index.html">Home</a></li>
              <li class="menu-item"><div class="dropdown">
               <a href="<?php echo base_url();?>demo/animals">Free Sound Effects</a>
                <div class="dropdown-content" id="formset">
                  <a class="menu-item" href="<?php echo base_url();?>demo/animals">Free Sound Effects Categories</a>
                          <a class="menu-item" href="about.html">Free SFX Packs</a>  
                </div>
              </div></li>
              <li class="menu-item"><a href="about.html">Royalty Free Music </a></li>
              <li class="menu-item"><div class="dropdown">
               <a href="about.html">About</a>
                <div class="dropdown-content" id="formset">
                  <a class="menu-item" href="#">Licensing</a>
                          <a class="menu-item" href="#">About Us</a>  
                          <a class="menu-item" href="#">Equipment Used</a>  
                          <a class="menu-item" href="#">FAQ</a>  
                          <a class="menu-item" href="#">Forum</a>  
                          <a class="menu-item" href="#">Contact</a>  
                          <a class="menu-item" href="#">Contribute</a>  
                </div>
              </div></li>
              <li class="menu-item"><a href="about.html">Credit / Share Us</a></li>
              <li class="menu-item"><a href="about.html">Blog</a></li>
              <li class="menu-item"><a href="gallery.html">Gallery</a></li>
              <li class="menu-item"><a href="download.html">Download</a></li>
              <li class="menu-item"><a href="blog.html">Blog</a></li>
              <li class="menu-item"><a href="contact.html">Contact</a></li>
            </ul> <!-- .menu -->
          </nav> <!-- .main-navigation -->
          <div class="mobile-menu"></div>
        </div>
      </header> <!-- .site-header -->
      
      

      <?php if(isset($view_files))

          $this->load->view($view_module.'/'.$view_files);

       ?>

      
      <!-- .main-content -->

      <footer class="site-footer">
        <div class="container">
          <!-- <img src="dummy/logo-footer.png" alt="Site Name"> -->
          
            <h5 style="color: #fd5927; ">SOUND EFFECTS</h5>
        
          
          <address>
            <p>Islamabad. Rawalpindi, <br><a href="">(+92) 300 0000000</a> <br> <a href="">info@bandname.com</a></p> 
          </address> 
          
          <form action="#" class="newsletter-form">
            <input type="email" placeholder="Enter your email to join newsletter...">
            <input type="submit" class="button cut-corner" value="Subscribe">
          </form> <!-- .newsletter-form -->
          
          <div class="social-links">
            <a href="#"><i class="fa fa-facebook-square"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-pinterest"></i></a>
          </div> <!-- .social-links -->
          
          <p class="copy">Copyright 2018 Sound Effects. All right reserved</p>
        </div>
      </footer> <!-- .site-footer -->

    </div> <!-- #site-content -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="<?php echo base_url();?>demofiles/js/jquery-1.11.1.min.js"></script>   
    <script src="<?php echo base_url();?>demofiles/js/plugins.js"></script>
    <script src="<?php echo base_url();?>demofiles/js/app.js"></script>

    
  </body>

</html>