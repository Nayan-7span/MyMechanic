<?php
session_start();
?>
<?php
// including database 
include 'partials\_dbconnect.php';
// including database 

$alerterror = false;
$alertsuccess = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (isset($_GET['crreset'])) {
		$email = $_POST['email'];
		$sql1 = "SELECT *FROM `customer` WHERE `c_email` = '$email' ";
		$result1 = mysqli_query($conn, $sql1);
		$emailcount = mysqli_num_rows($result1);
		if ($emailcount) {
			$userdata = mysqli_fetch_array($result1);
			$username = $userdata['c_name'];
			$email = $userdata['c_email'];

			include 'phpmailer\indexmail.php';
		} else {
			$alerterror = "Mail is not not registerd!!";
		}
	}else{
		$email = $_POST['email'];
		$sql1 = "SELECT *FROM `garage_owner` WHERE `g_email` = '$email' ";
		$result1 = mysqli_query($conn, $sql1);
		$emailcount = mysqli_num_rows($result1);
		if ($emailcount) {
			$userdata = mysqli_fetch_array($result1);
			$username = $userdata['g_name'];
			$email = $userdata['g_email'];

			include 'phpmailer\indexmail.php';
		} else {
			$alerterror = "Mail is not not registerd!!";
		}
	}
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="MYMECHANIC_CSS/style.css">
	<title>Mymechanic | Forgot Password</title>
</head>

<body>
	<!-- include navbar start -->
	<?php include 'partials\_navbar.php'; ?>
	<!-- include navbar End -->
	<?php
	if ($alerterror)
		echo '<div class="alert alert-danger alert-dismissible fade show my-2 mx-2" role="alert">
<i class="bi bi-exclamation-triangle-fill" style="font-size:20px">  </i><strong>Sorry!! </strong>' . $alerterror . '
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
	?>
	<?php
	if ($alertsuccess)
		echo '<div class="alert alert-success alert-dismissible fade show my-2 mx-2" role="alert">
<i class="bi bi-check-circle-fill" style="font-size:20px">  </i><strong>Success!! </strong>' . $alertsuccess . '
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
	?>
	<!-- customer form html start  -->
	<?php
	$forpath = "";
	if (isset($_GET['crreset'])) {
		$forpath = "Forget_password.php?crreset";
	} else {
		$forpath = "Forget_password.php";
	}

	?>
	<div class="form-container">
		<div class="field-container">
			<form method="POST" action="<?php echo $forpath; ?>" class="customer-form" enctype="multipart/form-data">
				<h2 class="form-field" style="font-weight: bold; color:white; text-align:center"> Forget Password <i class="bi bi-card-checklist"></i></h2>
				<hr style="height:4px; background-color: Red;">


				<div class="form-field-merge mb-3">
					<div class="mx-2" style="width:100%">
						<p style="font-weight: bold; color:white">Email:</p>
						<input type="email" maxlength="50" class="form-control mx-1" id="email" oninvalid="this.setCustomValidity('Enter Valid Email it contains \'@\' or \'.\' ')" onchange="this.setCustomValidity('')" pattern=".+@gmail\.com" name="email" placeholder="Ex.abc@gmail.com" required="required" />
					</div>

				</div>
				<hr style="height:2px; background-color: white;">
				<div class="button-container">
					<button class="customer-submit mb-1" type="submit">Sent Email</button>
				</div>
			</form>
		</div>
	</div>
	<!-- customer form html End  -->

	<!-- Footer End -->
	<?php include 'partials/_footer.php'; ?>
	<!-- Footer End -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="MYMECHANIC_JS/mechanic.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>