<?php
// admin adding php code start
session_start();
$alerterror = false;
$alertsuccess = false;
include 'partials/_dbconnect.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Booking</title>
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
                <h3 class="mt-4"><i class="bi bi-cash-coin"></i> Bookings </h3>
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
                        <div class="card-header" style="background-color:#f3f3f3;">
                            <form action="order.php" method="POST">
                            <i class="fas fa-table me-1"></i> 
                                        
                            <?php
                            $all = "checked";
                            $today ="";
                            if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['btnradio'] == "today"){
                                $today = "checked";
                                $all = "";
                            }
                            

                            ?>
                            Payment Table
                                <div class="btn-group" class="mx-2" style="float: right;" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" onchange="this.form.submit()" value="today" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" <?php echo $today ?>>
                                    <label class="btn btn-outline-success border border-secondary" for="btnradio1"><strong>Today</strong></label>

                                    <input type="radio" onchange="this.form.submit()" value="all" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" <?php echo $all ?>>
                                    <label class="btn btn-outline-secondary border border-secondary" for="btnradio2"><strong>All</strong></label>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple8">
                                <thead>
                                    <tr class="table-dark">
                                        <th>booking_id</th>
                                        <th>Booking_date</th> 
                                        <th>Cusotmer_id</th>
                                        <th>Service_id</th>
                                        <th>Garage_id</th>
                                        <th>Service_date</th>
                                        <th>Service_city</th>
                                        <th>Car_model</th>
                                        <th>Car_no</th>
                                        <th>service_By</th>
                                        <th>Booking_status</th>
                                        <th>Pay_status</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <th>booking_id</th>
                                        <th>Cusotmer_id</th>
                                        <th>Booking_date</th>
                                        <th>Service_id</th>
                                        <th>Garage_id</th>
                                        <th>Service_date</th>
                                        <th>Service_city</th>
                                        <th>Car_model</th>
                                        <th>Car_no</th>
                                        <th>service_By</th>
                                        <th>Booking_status</th>
                                        <th>Pay_status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        $paydataQuery = "SELECT *FROM `booking`";
                                        $paydatares = mysqli_query($conn, $paydataQuery);

                                    if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['btnradio'] == "today") {
                                        $today = date('Y-m-d', time());                                       
                                            while ($paydatarow = mysqli_fetch_assoc($paydatares)) {
                                                $bookdate = substr($paydatarow['bk_date'],0,10);                                               
                                                if ($bookdate == $today) {
                                                    echo '<tr class="table-info">
                                                <td>' . $paydatarow['bk_id'] . '</td>
                                                <td>' . $paydatarow['bk_date'] . '</td>
                                                <td>' . $paydatarow['cr_id'] . '</td>
                                                <td>' . $paydatarow['sr_id'] . '</td>
                                                <td>' . $paydatarow['gr_id'] . '</td>
                                                <td>' . $paydatarow['sr_date'] . '</td>
                                                <td>' . $paydatarow['sr_city'] . '</td>
                                                <td>' . $paydatarow['car_model'] . '</td>                                                                              
                                                <td>' . $paydatarow['car_no'] . '</td>                                                                              
                                                <td>' . $paydatarow['sr_by'] . '</td>                                                                              
                                                <td>' . $paydatarow['bk_status'] . '</td>                                                                              
                                                <td>' . $paydatarow['pay_status'] . '</td>                                                                              
                                                </tr>';
                                                }
                                            }
                                        
                                    } else {

                                        while ($paydatarow = mysqli_fetch_assoc($paydatares)) {
                                            echo '<tr class="table-secondary">
                                                <td>' . $paydatarow['bk_id'] . '</td>
                                                <td>' . $paydatarow['bk_date'] . '</td>
                                                <td>' . $paydatarow['cr_id'] . '</td>
                                                <td>' . $paydatarow['sr_id'] . '</td>
                                                <td>' . $paydatarow['gr_id'] . '</td>
                                                <td>' . $paydatarow['sr_date'] . '</td>
                                                <td>' . $paydatarow['sr_city'] . '</td>
                                                <td>' . $paydatarow['car_model'] . '</td>                                                                              
                                                <td>' . $paydatarow['car_no'] . '</td>                                                                              
                                                <td>' . $paydatarow['sr_by'] . '</td>                                                                              
                                                <td>' . $paydatarow['bk_status'] . '</td>                                                                              
                                                <td>' . $paydatarow['pay_status'] . '</td>                                                                              
                                                </tr>';
                                        }
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