<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/mycss.css" rel="stylesheet" />
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
                <h1 class="mt-4">Dashboard</h1>
                <hr>
                <!-- today statistics start  -->
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        <h3><i class="bi bi-bar-chart-fill"></i> Total statistics</h3>
                    </li>
                </ol>
                <section class="statistic statistic2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item statistic__item--red">
                                    <?php
                                    $sql1 = "SELECT *FROM `customer`";
                                    $result1 = mysqli_query($conn, $sql1);
                                    $num1 = mysqli_num_rows($result1);

                                    ?>
                                    <h2 class="number"><?php echo $num1 ?></h2>
                                    <span class="desc">total Customers</span>
                                    <div class="icon">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item statistic__item--orange">
                                    <?php
                                    $sql2 = "SELECT *FROM `garage_owner`";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $num2 = mysqli_num_rows($result2);
                                    ?>
                                    <h2 class="number"><?php echo $num2 ?></h2>
                                    <span class="desc">Toal Garages</span>
                                    <div class="icon">
                                        <i class="bi bi-tools"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item statistic__item--green">
                                    <?php
                                    $sql3 = "SELECT *FROM `service`";
                                    $result3 = mysqli_query($conn, $sql3);
                                    $num3 = mysqli_num_rows($result3);
                                    ?>
                                    <h2 class="number"><?php echo $num3 ?></h2>
                                    <span class="desc">Total Services</span>
                                    <div class="icon">
                                    <i class="bi bi-gear-fill"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item statistic__item--blue">
                                    <?php
                                    $sql4 = "SELECT SUM(pay_amount) AS `total_sum` FROM `payment` WHERE `gr_id` IS NOT NULL";
                                    $result4 = mysqli_query($conn, $sql4);
                                    $sumrow = mysqli_fetch_assoc($result4)
                                    ?>
                                    <h2 class="number"><?php echo $sumrow['total_sum'] ?> &#8377</h2>
                                    <span class="desc">Total Revenue</span>
                                    <div class="icon">
                                        <i class="bi bi-bar-chart-fill"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
                <!-- Total statistics End  -->

                <!-- today statistics start  -->
                <hr>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        <h3><i class="bi bi-bar-chart"></i> Other statistics</h3>
                    </li>
                </ol>
                <section class="statistic statistic2">
                    <div class="container">
                        <div class="row">
                        <div class="col-md-6 col-lg-3">
                        <div class="statistic__item statistic__item--grey">
                            <h1><i class="bi bi-person-plus-fill todayi" id="todayi1"></i></h1>
                            <?php
                            date_default_timezone_set('Asia/Kolkata');
                           $date = date('Y-m-d', time());
                            $sql4 = "SELECT *FROM `customer` WHERE `c_registrationdate` = '$date' ";
                            $result4 = mysqli_query($conn, $sql4);
                            $num4 = mysqli_num_rows($result4);
                            ?>
                            <h2 class="todaystath1"><?php echo $num4 ?></h2>
                            <span class="todaystatp">Customers Joined Today</span>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item statistic__item--grey">
                            <h1><i class="bi bi-tools todayi" id="todayi2"></i></h1>
                            <?php
                            date_default_timezone_set('Asia/Kolkata');
                           $date = date('Y-m-d', time());
                            $sql5 = "SELECT *FROM `garage_owner` WHERE `g_registrationdate` = '$date' ";
                            $result5 = mysqli_query($conn, $sql5);
                            $num5 = mysqli_num_rows($result5);
                            ?>
                            <h2 class="todaystath1"><?php echo $num5 ?></h2>
                            <span class="todaystatp">Garages Joined Today</span>
                        </div>
                    </div> 

                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item statistic__item--grey">
                            <h1><i class="bi bi-slash-circle-fill todayi" id="todayi2" style="color:red"></i></h1>
                            <?php
                            date_default_timezone_set('Asia/Kolkata');
                           $date = date('Y-m-d', time());
                            $sql5 = "SELECT *FROM `garages` WHERE `gr_status` = 'disapproved' ";
                            $result5 = mysqli_query($conn, $sql5);
                            $num5 = mysqli_num_rows($result5);
                            ?>
                            <h2 class="todaystath1"><?php echo $num5 ?></h2>
                            <span class="todaystatp">Disapproved Garage</span>
                        </div>
                    </div>        
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item statistic__item--grey">
                            <h1><i class="bi bi-check-circle-fill todayi" id="todayi2" style="color:green"></i></h1>
                            <?php
                            date_default_timezone_set('Asia/Kolkata');
                           $date = date('Y-m-d', time());
                            $sql5 = "SELECT *FROM `garages` WHERE `gr_status` = 'approved' ";
                            $result5 = mysqli_query($conn, $sql5);
                            $num5 = mysqli_num_rows($result5);
                            ?>
                            <h2 class="todaystath1"><?php echo $num5 ?></h2>
                            <span class="todaystatp"> Approved Garage</span>
                        </div>
                    </div>        
                </section>
                <!-- today statistics end  -->

                <!-- today statistics start  -->
                <hr>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        <h3><i class="bi bi-bar-chart"></i> This Month Service statistics</h3>
                    </li>
                </ol>
                <section class="statistic statistic2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item statistic__item--grey">
                                    <h1><i class="bi bi-patch-question-fill todayi" style="color:red" id="todayi1"></i></h1>
                                    <?php
                                    date_default_timezone_set('Asia/Kolkata');
                                    $month = date('m', time());
                                    $year = date('Y', time());
                                    $sql4 = "SELECT *FROM `booking` WHERE  `bk_status`= 'placed' AND (`sr_date` BETWEEN '$year-$month-01' AND '$year-$month-30')";
                                    $result4 = mysqli_query($conn, $sql4);
                                    $num4 = mysqli_num_rows($result4);
                                    ?>
                                    <h2 class="todaystath1"><?php echo $num4 ?></h2>
                                    <span class="todaystatp">Service Panding</span>
                                </div>
                            </div>

                

                            
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item statistic__item--grey">
                                    <h1><i class="bi bi-check-circle-fill todayi" style="color:green" id="todayi2"></i></h1>
                                    <?php
                                    date_default_timezone_set('Asia/Kolkata');
                                    $month = date('m', time());
                                    $year = date('Y', time());
                                    
                                    $sql5 = "SELECT *FROM `booking` WHERE `bk_status`= 'complete' AND (`sr_date` BETWEEN '$year-$month-01' AND '$year-$month-30')";
                                    $result5 = mysqli_query($conn, $sql5);
                                    $num5 = mysqli_num_rows($result5);
                                    ?>
                                    <h2 class="todaystath1"><?php echo $num5 ?></h2>
                                    <span class="todaystatp">Services Complete</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item statistic__item--grey">
                                    <h1><i class="bi bi-x-circle-fill todayi" style="color:red" id="todayi2"></i></h1>
                                    <?php
                                    date_default_timezone_set('Asia/Kolkata');
                                    $month = date('m', time());
                                    $year = date('Y', time());
                                    
                                    $sql5 = "SELECT *FROM `booking` WHERE  `bk_status`= 'decline' AND (`sr_date` BETWEEN '$year-$month-01' AND '$year-$month-30')";
                                    $result5 = mysqli_query($conn, $sql5);
                                    $num5 = mysqli_num_rows($result5);
                                    ?>
                                    <h2 class="todaystath1"><?php echo $num5 ?></h2>
                                    <span class="todaystatp">Services Declined</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item statistic__item--grey">
                                <h1><i class="bi bi-bar-chart-fill todayi" style="color:#00a0cc" id="todayi2"></i></h1>
                                    <?php
                                    date_default_timezone_set('Asia/Kolkata');
                                    $month = date('m', time());
                                    $year = date('Y', time());
                                    
                                    $sql6 = "SELECT SUM(pay_amount) as `thisrev` FROM `payment` WHERE `gr_id` IS NOT NULL AND (`pay_date` BETWEEN '$year-$month-01' AND '$year-$month-30')";
                                    $result6 = mysqli_query($conn, $sql6);
                                    $revrow = mysqli_fetch_assoc($result6)
                                    ?>
                                    <h2 class="todaystath1"><?php echo $revrow['thisrev'] ?> &#8377</h2>
                                    <span class="todaystatp">Revenue This Month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- today statistics end  -->


                
            </div>
        </main>
    </div>

    <!-- including foot start  -->
    <?php include 'partials/foot.php'; ?>
    <!-- including foot start  -->
</body>

</html>