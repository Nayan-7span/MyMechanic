<?php
$selfpath = $_SERVER['PHP_SELF'];
if(isset($_GET['applybooking'])){

  //booking data start
  $service_date = $_POST['servicedate'];
  $srcity = $_POST['srcity'];
  $service_time = $_POST['servicetime'];
  $carcompany = $_POST['carcompany'];
  $carmodel = $_POST['carmodel'];
  $carfuel = $_POST['carfuel'];
  $carnumber =$_POST['carnumber'];
  $servicedes =$_POST['servicedes'];
  $cardetails = $carcompany.",".$carmodel.",".$carfuel;
  $servicedatetime = $service_date." ".$service_time;
  //booking data finish

  
  //other data start
  $crid = $_SESSION['userid'];
  $service_id =  $_GET['applybooking'];
  //other data End
  
  //who provide ther service 
  $serquery = "SELECT *FROM `service` WHERE `s_id` = '$service_id'";
  $serresult = mysqli_query($conn,$serquery);
  $serrow = mysqli_fetch_assoc($serresult);
  $ser_by = $serrow['s_by'];
  $ser_price = $serrow['s_price'];
  //who provide ther service 
  
  
  if($ser_by == 'mymechanic'){
    $bookquery = "INSERT INTO `booking` (`cr_id`, `sr_id`, `gr_id`, `bk_date`, `sr_date`,`sr_city`, `car_model`, `car_no`,`sr_by`,`sr_description`,`bk_status`) VALUES ('$crid', '$service_id', null, current_timestamp(), '$servicedatetime','$srcity','$cardetails', '$carnumber','$ser_by','$servicedes','placed')";
  }else{
    $bookquery = "INSERT INTO `booking` (`cr_id`, `sr_id`, `gr_id`, `bk_date`, `sr_date`,`sr_city`, `car_model`, `car_no`,`sr_by`,`sr_description`,`bk_status`) VALUES ('$crid', '$service_id', '$ser_by', current_timestamp(), '$servicedatetime','$srcity', '$cardetails', '$carnumber','$ser_by','$servicedes','placed')";
  }

  $bookqueryresult = mysqli_query($conn,$bookquery);
  if($bookqueryresult){
    $orderquery = "SELECT  *FROM `booking` WHERE `cr_id` = '$crid' AND `sr_id` = '$service_id' AND `sr_date` = '$servicedatetime'";
    $orderres = mysqli_query($conn,$orderquery);
    $orderrow = mysqli_fetch_assoc($orderres);
    $booking_id = $orderrow['bk_id'];
    
    echo '
    <button class="btn btn-danger mx-1" style="display:none;" id="clickme2" data-bs-toggle="modal" data-bs-target="#booksuccess">Logout</button>
    <script>
    window.onload = function() {
        document.getElementById("clickme2").click();
    }
    </script>
    
    <div class="modal fade" id="booksuccess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div style="border-radius: 25px; background-color: white" class="modal-content">
      <div class="modal-header">
        <h4></h4>
      </div>
      <form method="post" action="partials/PaytmKit/pgRedirect.php">
      <div class="modal-body">
       <h2 style="text-align: center"><i class="bi bi-wallet2" style="font-size: 40px; color:black;"></i> <strong>Service Payment</strong></h2>
       <h4 style="text-align: center; color:#dc3545;"><strong>Rs. '.$ser_price.'</strong></h4>
      
       <input id="ORDER_ID" tabindex="1" style="display:none;" maxlength="20" size="20"	name="ORDER_ID" autocomplete="off" value="'.$booking_id.'">
       <input id="CUST_ID" tabindex="2" style="display:none;" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="'.$crid.'">
       <input id="INDUSTRY_TYPE_ID" tabindex="4" style="display:none;" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
       <input id="CHANNEL_ID" tabindex="4" style="display:none;" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
       <input title="TXN_AMOUNT" tabindex="10" style="display:none;" type="text" name="TXN_AMOUNT" value="'.$ser_price.'">
      
       </div>
      <div style="margin:auto" class="modal-footer">
      <button type="submit" class="btn btn-primary">Pay Now</button>
      <a href="index.php" class="btn btn-danger">Cancel Booking</a>
      </div>
      </form>
      </div>
      </div>
    </div>
    </div>';

  }
  else{
    die(mysqli_error($conn));
  }


}














if(isset($_GET['booking'])){
  $s_id = $_GET['booking'];

    echo '
    <button class="btn btn-danger mx-1" style="display:none;" id="clickme" data-bs-toggle="modal" data-bs-target="#booking">Logout</button>
    <script>
    window.onload = function() {
        document.getElementById("clickme").click();
    }
    </script>
    
    <div class="modal fade" id="booking" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
    <div style="border-radius: 25px; background-color: white" class="modal-content">
    <form action="'.$selfpath.'?applybooking='.$s_id.'&cat_id=' . $catid . '" method="POST">
    <div class="modal-header">
    <h4>Enter Booking Details</h4>

      <select class="form-select" style="width:30%; margin-right:0px; background-color:#0086ff; border:none; color:white;" name="srcity" aria-label="Default select example">
      
      <option value="Select City" selected>-- Select City --</option>';
      $custcity = "SELECT *FROM `city`";
      $custcityres = mysqli_query($conn,$custcity);         
      while($custcityrow = mysqli_fetch_assoc($custcityres)){
      echo '<option value="'.$custcityrow['city_name'].'">'.$custcityrow['city_name'].'</option>';
      }

    echo '</select>

      </div>
      <div class="modal-body">

      <div class="form-field-merge" style="display:flex; flex-direction:row; flex-wrap:wrap">
                <div class="mx-2" style="width:190px">
                <h6 style="margin-bottom: 0px; font-size: 14px; color: #bb2d3b;">Car Company :</h6>
                <input type="text" class="form-control"  name="carcompany" required="required" />
                </div>
                <div class="mx-2" style="width:190px">
                <h6 style="margin-bottom: 0px; font-size: 14px; color: #bb2d3b;">Car Model :</h6>
				        <input type="text" class="form-control" name="carmodel" required="required" />
                </div>
                <div class="mx-2" style="width:190px">
                <h6 style="margin-bottom: 0px; font-size: 14px; color: #bb2d3b;">Fuel type :</h6>
			        	<select class="form-select" name="carfuel" aria-label="Default select example">
                <option selected>Diesel</option>
                <option value="Patrol">Patrol</option>
                <option value="CNG">CNG</option>
                <option value="Charging">Charging</option>
                </select>
			    </div>
		</div>

        <div class="form-field-merge my-4" style="display:flex; flex-direction:row; flex-wrap:wrap">
                <div class="mx-2" style="width:190px">
                <h6 style="margin-bottom: 0px; font-size: 14px; color: #bb2d3b;">Vehicle No :</h6>
                <input type="text" class="form-control"  name="carnumber" required="required" />
                </div>
              <div class="mx-2" style="width:190px;">
              <h6 style="margin-bottom: 0px; font-size: 14px; color: #bb2d3b;">Wnen will you come with car?</h6>
              <input type="date" class="form-control"  name="servicedate" required="required" />
              </div>
              <div class="mx-2" style="width:190px;">
              <h6 style="margin-bottom: 0px; font-size: 14px; color: #bb2d3b;">Service Time :</h6>
				      <input type="time" class="form-control" name="servicetime" required="required" />
              </div>
		</div>
          <h6 style="margin-bottom: 0px; font-size: 14px; color: #bb2d3b;">Describe your service requairment in few words</h6>
          <textarea class="form-control"  maxlength="150" name="servicedes" required="required"></textarea>
      </div>
      <div  class="modal-footer d-flex justify-content-center">
      <button type="submit" class="btn btn-primary">Confirm</a>
      <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
      </form>

      </div>
    </div>
  </div>
</div>
</div>';
}
