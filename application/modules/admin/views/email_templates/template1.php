<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>

<!-- header -->
<table style="background: #f5f5f5;border-collapse: collapse;width:100%;">
    
</table>


          


 <table style="border-collapse: collapse;width:100%; border-left: 1px solid lightgray;border-right: 1px solid lightgray;">
    <tr>
        <th style="text-align: left;width:7%;padding-left: 20px;padding-top:15px;">
         <!--  <h3 style="margin-top:5px;margin: 5px 0;font-weight: normal;"><strong style="color: gray;">From: </strong><?php //echo $result[0]->username; ?></strong> <span><a href="">(<?php echo $result[0]->email; ?>)</h3> -->
        </th>
    
    </tr>
</table>



<!-- date column -->

<table style="width: 100%; padding-bottom: 15px; border-left: 1px solid lightgray;border-right: 1px solid lightgray;">
    <tr>
        <th style="text-align: left;padding-left: 20px;padding-top: 25px;">
          <h4 style="text-align: left;font-weight: normal;color: black; margin: 0; padding-right: 15px; text-align: justify;"><?php echo $submission_notification;
            ?>
          <br><br>
          <br><br>
          </h4>
        </th>
    </tr>
</table>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" style="text-align: left;">First Name</th>
      <th scope="col" style="text-align: left;"><?php echo $data_found[0]->first_name; ?></th>
      
    </tr>
  </thead>
  <tbody>
    
    <tr>
      <th scope="col" style="text-align: left;">Last Name</th>
      <th scope="col" style="text-align: left;"><?php echo $data_found[0]->last_name; ?></th>
      
    </tr>
    <tr>
      <th scope="col" style="text-align: left;">Number</th>
      <th scope="col" style="text-align: left;"><?php echo $data_found[0]->phone; ?></th>
      
    </tr>

    <tr>
      <th scope="col" style="text-align: left;">Email</th>
      <th scope="col" style="text-align: left;"><?php echo $data_found[0]->client_email; ?></th>
      
    </tr>
     <tr>
      <th scope="col" style="text-align: left;">Address</th>
      <th scope="col" style="text-align: left;"><?php echo $data_found[0]->address; ?></th>
      
    </tr>
     <tr>
      <th scope="col" style="text-align: left;">City</th>
      <th scope="col" style="text-align: left;"><?php echo $data_found[0]->city; ?></th>
      
    </tr>
     <tr>
      <th scope="col" style="text-align: left;">State</th>
      <th scope="col" style="text-align: left;"><?php echo $data_found[0]->state; ?></th>
      
    </tr>
     <tr>
      <th scope="col" style="text-align: left;">Zip</th>
      <th scope="col" style="text-align: left;"><?php echo $data_found[0]->zip_code; ?></th>
      
    </tr>
 
    <tr>
      <th scope="col" style="text-align: left;">Debt Amount</th>
      <th scope="col" style="text-align: left;"><?php echo $data_found[0]->debt; ?></th>
      
    </tr>

    <tr>
      <th scope="col" style="text-align: left;">BankRuptcy</th>
      <th scope="col" style="text-align: left;"><?php echo $data_found[0]->bank_ruptcy; ?></th>
      
    </tr>
    
   
  </tbody>
</table>


<!-- footer -->



<table class="text-right" style="float: right;width: 100%;background: lightgray;">
  <tr>
    <th>
      <h5 style="color: #005b9d;margin: 10px;"><span style="color: red;">All rights reserved 2023.</span> FirstStep Communications LLC
      </h5>
    </th>
  </tr>
</table>


<hr style="margin-top: -2px;margin-bottom: 0;">

</div>


  
</body>
</html>