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
    <title>Admin | Payment</title>
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
                <h3 class="mt-4"><i class="bi bi-cash-coin"></i> Payment </h3>
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
                            <form action="payment.php" method="POST">
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
                            <table id="datatablesSimple7">
                                <thead>
                                    <tr class="table-dark">
                                        <th>booking_id</th>
                                        <th>Cusotmer_id</th>
                                        <th>Payment_id</th>
                                        <th>Payment_Mode</th>
                                        <th>Payment_Bank</th>
                                        <th>Bank_trx_id</th>
                                        <th>Amount</th>
                                        <th>Payment_date</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>booking_id</th>
                                        <th>Cusotmer_id</th>
                                        <th>Payment_id</th>
                                        <th>Payment_Mode</th>
                                        <th>Payment_Bank</th>
                                        <th>Bank_trx_id</th>
                                        <th>Amount</th>
                                        <th>Payment_date</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        $paydataQuery = "SELECT *FROM `payment`";
                                        $paydatares = mysqli_query($conn, $paydataQuery);

                                    if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['btnradio'] == "today") {
                                        $today = date('Y-m-d', time());                                       
                                            while ($paydatarow = mysqli_fetch_assoc($paydatares)) {
                                                $paydate = substr($paydatarow['pay_date'],0,10);                                               
                                                if ($paydate == $today) {
                                                    echo '<tr class="table-info">
                                                <td>' . $paydatarow['bk_id'] . '</td>
                                                <td>' . $paydatarow['cr_id'] . '</td>
                                                <td>' . $paydatarow['pay_id'] . '</td>
                                                <td>' . $paydatarow['pay_mode'] . '</td>
                                                <td>' . $paydatarow['pay_bank'] . '</td>
                                                <td>' . $paydatarow['banktrxid'] . '</td>
                                                <td>' . $paydatarow['pay_amount'] . '</td>
                                                <td>' . $paydatarow['pay_date'] . '</td>                                                                              
                                                </tr>';
                                                }
                                            }
                                        
                                    } else {

                                        while ($paydatarow = mysqli_fetch_assoc($paydatares)) {
                                            echo '<tr class="table-secondary">
                                            <td>' . $paydatarow['bk_id'] . '</td>
                                            <td>' . $paydatarow['cr_id'] . '</td>
                                            <td>' . $paydatarow['pay_id'] . '</td>
                                            <td>' . $paydatarow['pay_mode'] . '</td>
                                            <td>' . $paydatarow['pay_bank'] . '</td>
                                            <td>' . $paydatarow['banktrxid'] . '</td>
                                            <td>' . $paydatarow['pay_amount'] . '</td>
                                            <td>' . $paydatarow['pay_date'] . '</td>                                                                              
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