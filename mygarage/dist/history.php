<?php
// admin adding php code start
session_start();
$alerterror = false;
$alertsuccess = false;
include 'partials/_dbconnect.php';


//Accepting Booking code start
if (isset($_GET['complete']) || isset($_GET['decline'])) {
    $gr_id = $_SESSION['userid'];

    if (isset($_GET['complete'])) {
        $bk_id = $_GET['complete'];
        $bk_message = "Service completed successfully!!";
        $accquery = "UPDATE `booking` SET `gr_id` = $gr_id ,`bk_status` = 'complete' WHERE `bk_id` = $bk_id";
        $accquery2 = "UPDATE `payment` SET `gr_id` = $gr_id WHERE `bk_id` = $bk_id";
        $accres = mysqli_query($conn, $accquery);
        $accres2 = mysqli_query($conn, $accquery2);
    }
    if (isset($_GET['decline'])) {
        $bk_id = $_GET['decline'];
        $bk_message = "Service declined successfully!!";
        $accquery = "UPDATE `booking` SET `gr_id` = $gr_id ,`bk_status` = 'decline' WHERE `bk_id` = $bk_id";
        $accres = mysqli_query($conn, $accquery);
    }

    if ($accres) {
        $alertsuccess = $bk_message;
    } else {
        die(mysqli_errno($conn));
    }
}



//Accepting Booking code start


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Service History</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/mycss.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- including head start  -->
    <?php include 'partials/head.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>
    <!-- including head start  -->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h3 class="mt-4"><i class="bi bi-card-checklist"></i> Service History </h3>
                <hr>
                <!-- Alert messages  -->
                <?php
                if ($alerterror)
                    echo '<div class="alert alert-danger alert-dismissible fade show" style="width:98%" role="alert">
                    <strong>Sorry!</strong> ' . $alerterror . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                ?>
                <?php
                if ($alertsuccess)
                    echo '<div class="alert alert-success alert-dismissible fade show mx-2" role="alert">
                    <i class="bi bi-check-circle-fill"> </i><strong>Success!! </strong>' . $alertsuccess . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                ?>
                <!-- Alert messages  -->



                <!-- category table start  -->
                <div id="Admin">
                    <div class="card mb-4">
                        <div class="card-header" style="background-color:#f3f3f3; color:#c71e2f;">
                            <form action="history.php" method="POST">
                                <i class='fas fa-table me-1'></i>

                                <?php
                                $decline = "";
                                $complete = "checked";
                                $message = "<strong>completed services</strong>";
                                if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['btnradio'] == "decline") {
                                    $complete = "";
                                    $decline = "checked";
                                    $message = "<strong>declined services</strong>";
                                }

                                echo $message;
                                ?>

                                <div class="btn-group" class="mx-2" style="float: right;" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" onchange="this.form.submit()" value="complete" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" <?php echo $complete ?>>
                                    <label class="btn btn-outline-success border border-secondary" for="btnradio1"><strong>Completed</strong></label>

                                    <input type="radio" onchange="this.form.submit()" value="decline" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" <?php echo $decline ?>>
                                    <label class="btn btn-outline-danger border border-secondary" for="btnradio2"><strong> Declined</strong></label>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple7">
                                <thead>
                                    <tr class="table-dark">
                                        <th>booking_details</th>
                                        <th>Service_details</th>
                                        <th>Customer_details</th>
                                        <th>Service_description</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>booking_details</th>
                                        <th>Service_details</th>
                                        <th>Customer_details</th>
                                        <th>Satatus</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $garage_id = $_SESSION['userid'];
                                    if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['btnradio'] == "decline") {
                                        $acceptbook = "SELECT *FROM `booking` WHERE `gr_id` = $garage_id AND `bk_status` = 'decline' ";
                                        $row_color = "table-danger";
                                    } else {
                                        $acceptbook = "SELECT *FROM `booking` WHERE `gr_id`= $garage_id AND `bk_status` = 'complete' ";
                                        $row_color = "table-info";
                                    }

                                    $bookresult = mysqli_query($conn, $acceptbook);


                                    while ($bookrow = mysqli_fetch_assoc($bookresult)) {
                                        //Fetching Customer Data
                                        $cr_id = $bookrow['cr_id'];
                                        $custquery = "SELECT *FROM `customer` where `c_id` = $cr_id ";
                                        $custres = mysqli_query($conn, $custquery);
                                        $custrow = mysqli_fetch_assoc($custres);

                                        //Fetching service Data
                                        $sr_id = $bookrow['sr_id'];
                                        $serquery = "SELECT *FROM `service` where `s_id` = $sr_id ";
                                        $serres = mysqli_query($conn, $serquery);
                                        $serrow = mysqli_fetch_assoc($serres);

                                        //Displaying all service tasks start
                                        date_default_timezone_set('Asia/Kolkata');
                                        $today = date('Y-m-d', time());
                                        $serdate = substr($bookrow['sr_date'], 0, 10);

                                            echo '<tr class="' . $row_color . '">
                                        <td>
                                            <p class="small-text my-1 mx-2"><i class="bi bi-bookmark-check-fill"></i><strong style="color: #c71e2f;"> Booking id:</strong> ' . $bookrow['bk_id'] . '</p>
                                            <p class="small-text my-1 mx-2"><i class="bi bi-calendar-event-fill"></i><strong style="color: #c71e2f;"> Booking Date:</strong> ' . $bookrow['bk_date'] . '</p>
                                            <p class="small-text my-1 mx-2"><i class="bi bi-calendar-event"></i><strong style="color: #c71e2f;"> Service Date/time:</strong> ' . $bookrow['sr_date'] . '</p>
                                            <p class="small-text my-1 mx-2"><i class="bi bi-geo-alt-fill"></i><strong style="color: #c71e2f;"> Service City:</strong> Ahmedabad</p>
                                        </td>

                                        <td>
                                            <p class="small-text my-1 mx-2"><i class="bi bi-gear-fill"></i><strong style="color: #c71e2f;"> Service Name: </strong><a href=""> ' . $serrow['s_name'] . '</a></p>
                                            <p class="small-text my-1 mx-2"><i class="bi bi-cash-stack"></i><strong style="color: #c71e2f;"> Price:</strong> ' . $serrow['s_price'] . '</p>
                                            <p class="small-text my-1 mx-2"><i class="bi bi-truck"></i><strong style="color: #c71e2f;"> Car Details:</strong> ' . $bookrow['car_model'] . '</p>
                                            <p class="small-text my-1 mx-2"><i class="bi bi-pip-fill"></i><strong style="color: #c71e2f;"> Vehicle No: </strong> ' . $bookrow['car_no'] . '</p>

                                        </td>

                                        <td>
                                            <p class="small-text my-1 mx-2"><i class="bi bi-person-circle"></i><strong style="color: #c71e2f;"> Customer Name: </strong> ' . $custrow['c_name'] . '</p>
                                            <p class="small-text my-1 mx-2"><i class="bi bi-phone-fill"></i><strong style="color: #c71e2f;"> Phone:</strong> ' . $custrow['c_phone'] . '</p>

                                        </td>

                                        <td style="max-width:100px">
                                            <p class="small-text">' . $bookrow['sr_description'] . '</p>
                                        </td>

                                        <td style="max-width:100px">';
                                        if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['btnradio'] == "decline") {

                                            echo '<button href="" type="button"  class="btn btn-danger  px-3 btn-sm my-1" disabled><i class="bi bi-x-circle"></i> declined</button>';
                                        }else{
                                            echo '<button href="" type="button" class="btn btn-success  btn-sm px-1" disabled><i class="bi bi-check-circle"></i> Completed</button>';
                                        }
                                            echo '</td>

                                        </tr>';
                                        
                                        //Displaying all service tasks END

                                    }
                                    ?>






                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- category table End  -->


            </div>
        </main>
    </div>


    <!-- including foot start  -->
    <?php include 'partials/foot.php'; ?>
    <!-- including foot start  -->

</body>

</html>