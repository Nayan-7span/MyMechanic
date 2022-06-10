<?php
session_start();
include 'partials/_dbconnect.php';
$delorder = "DELETE FROM `booking` WHERE `pay_status` = 'failed'";
$delorderresult = mysqli_query($conn, $delorder);
$alertsuccess = "";
$alerterror = "";
//Cancel Booking Code start 
if (isset($_GET['cancel'])) {
    $order_id = $_GET['cancel'];
    $cancelquery = "UPDATE `booking` SET `bk_status` = 'cancel' WHERE `bk_id` = $order_id";
    $cancelres = mysqli_query($conn, $cancelquery);
    if ($cancelquery) {
        $alertsuccess = "Service Canceled Successfully";
    } else {
        die(mysqli_error($conn));
    }
}
//Cancel Booking Code End

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="MYMECHANIC_CSS/style.css">
    <title>MyMechanic | Bookings</title>
</head>



<body>
    <!-- include navbar start -->
    <?php include 'partials\_navbar.php'; ?>
    <!-- include navbar End -->


    <?php
    $placed = "checked";
    $confirm = "";
    $complete = "";
    $cancel = "";

    $today = "checked";
    $all = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $bkstatus = $_POST['bkstatus'];
        $bktime = $_POST['bktime'];

        if ($bkstatus == "confirm") {
            $placed = "";
            $confirm = "checked";
            $complete = "";
            $cancel = "";
        }
        if ($bkstatus == "complete") {
            $placed = "";
            $confirm = "";
            $complete = "checked";
            $cancel = "";
        }
        if ($bkstatus == "cancel") {
            $placed = "";
            $confirm = "";
            $complete = "";
            $cancel = "checked";
        }
        if ($bktime == "all") {
            $today = "";
            $all = "checked";
        }
    }

    ?>

    <!-- Booking filter start------------------------------------------------------------------------------------- -->
    <div id="filter-div" class="my-1 mx-1 px-2 py-3 px-3 ">
        <form action="order.php" method="POST" style="width:100%;" class="d-flex flex-row">

            <div style="width:50%" class="d-flex justify-content-start">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" onchange="this.form.submit()" value="placed" class="btn-check" name="bkstatus" id="btnradio1" autocomplete="off" <?php echo $placed ?>>
                    <label class="btn btn-outline-primary border border-secondary" for="btnradio1"><strong><i class="bi bi-check-lg"></i> Placed</strong></label>

                    <input type="radio" onchange="this.form.submit()" value="confirm" class="btn-check" name="bkstatus" id="btnradio2" autocomplete="off" <?php echo $confirm ?>>
                    <label class="btn btn-outline-success border border-secondary" for="btnradio2"><strong><i class="bi bi-check-circle"></i> Confirmed</strong></label>

                    <input type="radio" onchange="this.form.submit()" value="complete" class="btn-check" name="bkstatus" id="btnradio3" autocomplete="off" <?php echo $complete ?>>
                    <label class="btn btn-outline-success border border-secondary" for="btnradio3"><strong><i class="bi bi-check-circle-fill"></i> Completed</strong></label>

                    <input type="radio" onchange="this.form.submit()" value="cancel" class="btn-check" name="bkstatus" id="btnradio4" autocomplete="off" <?php echo $cancel ?>>
                    <label class="btn btn-outline-danger border border-secondary" for="btnradio4"><strong><i class="bi bi-x-circle-fill"></i> Canceled | declined</strong></label>
                </div>
            </div>

            <div style="width:50%" class="d-flex justify-content-end">
                <div class="btn-group" role="group" class="d-flex justify-content-end" aria-label="Basic radio toggle button group">
                    <input type="radio" onchange="this.form.submit()" value="today" class="btn-check" name="bktime" id="btnradio5" autocomplete="off" <?php echo $today ?>>
                    <label class="btn btn-outline-success border border-secondary" for="btnradio5"><strong><i class="bi bi-funnel-fill"></i> Today</strong></label>

                    <input type="radio" onchange="this.form.submit()" value="all" class="btn-check" name="bktime" id="btnradio6" autocomplete="off" <?php echo $all ?>>
                    <label class="btn btn-outline-secondary border border-secondary" for="btnradio6"><strong><i class="bi bi-list"></i> All</strong></label>
                </div>
            </div>
        </form>
    </div>
    <!-- Booking filter start------------------------------------------------------------------------------------- -->



    <!-- Alert and messages start ---------------------------------------------------------------------- -->
    <?php
    if (isset($_GET['payment']) && $_GET['payment'] == "true") {
        echo '<div class="alert alert-success alert-dismissible fade show my-2 mx-2" role="alert">
                <i class="bi bi-check-circle-fill"> </i><strong>Success!! </strong>
            Service Payment Successfull.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    if (isset($_GET['payment']) && $_GET['payment'] == "fail") {
        echo '<div class="alert alert-danger alert-dismissible fade show my-2 mx-2" role="alert">
        <i class="bi bi-exclamation-triangle-fill" style="font-size:20px">  </i><strong>Sorry!! </strong> Payment failed try again to book service.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <?php
    if ($alerterror) {
        echo '<div class="alert alert-danger alert-dismissible fade show my-2 mx-2" role="alert">
            <strong>Sorry!</strong> ' . $alerterror . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    ?>
    <?php
    if ($alertsuccess) {
        echo '<div class="alert alert-success alert-dismissible fade show my-2 mx-2" role="alert">
                    <i class="bi bi-check-circle-fill"> </i><strong>Success!! </strong>' . $alertsuccess . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    ?>
    <!-- Alert and messages END ---------------------------------------------------------------------- -->





    <div class="service" style="min-height:500px; padding-top:100px;">
        <div class="my-container">
            <div class="text-center">
                <h4 class="my-2">Booking history</h4>
                <hr>
            </div>
            <div class="row" style="flex-direction:column">
                <?php
                $cr_id = $_SESSION['userid'];
                date_default_timezone_set('Asia/Kolkata');
                $today = date('Y-m-d', time());
                // Fetching Booking  data
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $bkstatus = $_POST['bkstatus'];
                    $bktime = $_POST['bktime'];


                    if ($bktime == 'today') {
                        if ($bkstatus == 'cancel') {
                            $bookdata = "SELECT *FROM `booking` WHERE (`cr_id` = $cr_id AND `bk_date`='$today') AND (`bk_status`= 'cancel' OR `bk_status`= 'decline')";
                        } else {
                            $bookdata = "SELECT *FROM `booking` WHERE `cr_id` = $cr_id AND `bk_status`= '$bkstatus' AND `bk_date`='$today' ";
                        }
                    } else {
                        if ($bkstatus == 'cancel') {
                            $bookdata = "SELECT *FROM `booking` WHERE `cr_id` = $cr_id AND (`bk_status`= 'cancel' OR `bk_status`= 'decline')";
                        } else {
                            $bookdata = "SELECT *FROM `booking` WHERE `cr_id` = $cr_id AND `bk_status`= '$bkstatus' ";
                        }
                    }
                } else {
                    $bookdata = "SELECT *FROM `booking` WHERE `cr_id` = $cr_id AND `bk_status` = 'placed' AND `bk_date` = '$today'";
                }
                $bookdatares = mysqli_query($conn, $bookdata);
                if (mysqli_num_rows($bookdatares) == 0) {
                    echo '<h5 style="color:red"> Oops!! Booking history is not available</h5>';
                }
                while ($bookrow = mysqli_fetch_assoc($bookdatares)) {
                    $bookgr = $bookrow['gr_id'];
                    $booksr = $bookrow['sr_id'];

                    $bookid = $bookrow['bk_id'];
                    $bookdate = $bookrow['bk_date'];
                    $booksrdate = $bookrow['sr_date'];
                    $bookcar = $bookrow['car_model'];
                    $bookcarno = $bookrow['car_no'];
                    $bookdes = $bookrow['sr_description'];
                    $bookstatus = $bookrow['bk_status'];
                    $paystatus = $bookrow['pay_status'];

                    //Service Details Start
                    $serdata = "SELECT *FROM `service` WHERE `s_id` = $booksr";
                    $serresult = mysqli_query($conn, $serdata);
                    $serrow = mysqli_fetch_assoc($serresult);
                    $serphoto = "data:image/jpg;base64," . base64_encode($serrow['s_image']);
                    //Service Details End

                    //Garage Details Start
                    $grvalid = false;
                    if ($bookgr == null) {
                        $grvalid = "once garage owner accept your service, after that you will able to see garage details here";
                    } else {
                        $grdata = "SELECT *FROM `garage_owner` WHERE `g_id` = $bookgr";
                        $grres = mysqli_query($conn, $grdata);
                        $grrow = mysqli_fetch_assoc($grres);
                    }
                    //Garage Details End

                    //Customer Data start
                    $crdata = "SELECT *FROM `customer` WHERE `c_id` = $cr_id";
                    $crres = mysqli_query($conn, $crdata);
                    $crrow = mysqli_fetch_assoc($crres);
                    //Customer Data End





                    echo '<div class="card mb-3 service-card" style="width: 650px;  min-width:100px; ">
                    <div class="row g-0 service-body-div">
                        <div class="col-md-5 ">
                            <div class="booking-img-div">
                                <img src="' . $serphoto . '" class="img-fluid rounded-start" alt="...">
                                <h6 class="mx-2 no-margin"><strong>' . $serrow['s_name'] . '</strong></h6>
                                <p class="mx-2 no-margin" style="color: #c71e2f;"><strong>Price :</strong> ' . $serrow['s_price'] . ' rs.</p>
                            </div>
                            <hr style="margin:4px;  color: #000000;">
                            <div id="garage-details">
                                <p class="small-text my-1 mx-2"><i class="bi bi-truck"></i><strong style="color: #c71e2f;"> Car Details:
                                    </strong>' . $bookcar . '</p>
                                <p class="small-text my-1 mx-2"><i class="bi bi-pip-fill"></i><strong style="color: #c71e2f;"> Vehicle
                                        No: </strong>' . $bookcarno . '</p>
                                <hr style="margin:4px;  color: #000000;">

                                <p class="small-text my-1 mx-2"><i class="bi bi-calendar-event-fill"></i><strong style="color: #c71e2f;">
                                        Booking Date: </strong>' . $bookdate . '</p>
                                <p class="small-text my-1 mx-2"><i class="bi bi-calendar-plus"></i><strong style="color: #c71e2f;">
                                        Service Date: </strong>' . $booksrdate . '</p>
                                <p class="small-text my-1 mx-2"><i class="bi bi-bookmark-check-fill"></i><strong style="color: #c71e2f;">
                                        Booking id: </strong>' . $bookid . '</p>

                                <p class="small-text my-1 mx-2"><i class="bi bi-check-circle-fill"></i><strong style="color: #c71e2f;">';
                    if ($bookstatus == "placed") {
                        echo ' Booking Status: </strong><button type="button" id="status-button-placed" class="btn btn-sm" disabled>' . $bookstatus . '</button>';
                    }
                    if ($bookstatus == "confirm" || $bookstatus == "complete") {
                        echo ' Booking Status: </strong><button type="button" id="status-button-confirm" class="btn btn-sm" disabled>' . $bookstatus . '</button>';
                    }
                    if ($bookstatus == "decline" || $bookstatus == "cancel") {
                        echo ' Booking Status: </strong><button type="button" id="status-button-cancel" class="btn btn-sm" disabled>' . $bookstatus . 'd</button>';
                    }
                    echo '</p>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <hr style="margin:4px;  color: #000000;">
                            <div class="sub-service-div">
                                <p class="small-text" style="color: rgb(0, 0, 0);"><strong>Garage Owner Deatails :</strong></p>';


                    if ($grvalid) {
                        echo '<p class="small-text mx-2" style="background-color: #ff00004d; padding:6px; border-radius:5px;"><i class="bi bi-exclamation-triangle" style="color:red"></i> ' . $grvalid . '</p>';
                    } else {
                        echo '<p class="small-text mx-2"><i class="bi bi-gear-fill"></i><strong style="color: #c71e2f;"> Garage
                                        Name: </strong> <a href="category.php?garageid=' . $bookgr . '">' . $grrow['g_name'] . '</a></p>
                                <p class="small-text mx-2"><i class="bi bi-person-fill"></i><strong style="color: #c71e2f;"> Owner:
                                    </strong>' . $grrow['g_owner_name'] . '</p>
                                <p class="small-text mx-2"><i class="bi bi-telephone-fill"></i><strong style="color: #c71e2f;">
                                        Phone: </strong>' . $grrow['g_phone'] . '</p>';
                    }


                    echo '</div>
                            <hr style="margin:0px;  color: #000000;">
                            <div class="sub-service-div">
                                <p class="small-text" style="color: rgb(0, 0, 0);"><strong>Customer Deatails :</strong></p>
                                <p class="small-text mx-2"><i class="bi bi-person-circle"></i><strong style="color: #c71e2f;">
                                        Customer Name: </strong>' . $crrow['c_name'] . '</p>
                                <p class="small-text mx-2"><i class="bi bi-phone-fill"></i><strong style="color: #c71e2f;"> Phone:
                                    </strong>' . $crrow['c_phone'] . '</p>
                            </div>
                            <hr style="margin:0px;  color: #000000;">
                            <div class="sub-service-div">
                                <div >
                                    <div class="form-floating mx-2 my-2">
                                        <textarea id="service-msg" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">' . $bookdes . '</textarea>
                                        <label for="floatingTextarea2">Service description</label>
                                    </div>
                                    <div class="d-flex justify-content-center">';
                    if ($bookstatus == "complete" || $bookstatus == "cancel" || $bookstatus == "decline") {
                        echo '<p></p>';
                    } else {
                        echo '<a href="order.php?cancel=' . $bookid . '"  style="width:120px" type="button" class="btn btn-danger my-2 btn-sm ">Cancel Service</a>';
                    }
                    echo  '</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                }

                ?>

            </div>
        </div>
    </div>






    <!-- Footer Start -->
    <?php include 'partials/_footer.php'; ?>
    <!-- Footer End -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="MYMECHANIC_JS/mechanic.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

</body>

</html>