<?php
session_start();
?>
<?php
// including database 
include 'partials\_dbconnect.php';
// including database 

$alerterror = false;
$alertsuccess = false;
if(isset($_GET['crmail']) ){
 $email = $_GET['crmail'];
}
if(isset($_GET['grmail']) ){
 $email = $_GET['grmail'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_GET['crmail'])) {
		$password = $_POST['password'];
		$confirmpassword = $_POST['confirmpassword'];

		$passwordvalid = false;

		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@[^\w]@', $password);
		if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
			$passwordvalid = true;
		}

		$sql1 = "SELECT c_email FROM `customer` WHERE `c_email` = '$email' ";
		$result1 = mysqli_query($conn, $sql1);
		$num1 = mysqli_fetch_array($result1);
		if ($num1 > 0) {

			if ($password == $confirmpassword && $passwordvalid == false) {

				$hashpassword = password_hash($password, PASSWORD_DEFAULT);
				$sql2 = "UPDATE customer set c_password='$hashpassword' where c_email='$email'";
				$result2 = mysqli_query($conn, $sql2);
				if ($result2) {
					$alertsuccess = "Password reset successfull!!";
				}
			} else {
				$alerterror = "Password not match or  Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
			}
		}
	}

	if (isset($_GET['grmail'])) {
		$password = $_POST['password'];
		$confirmpassword = $_POST['confirmpassword'];

		$passwordvalid = false;

		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@[^\w]@', $password);
		if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
			$passwordvalid = true;
		}

		$sql1 = "SELECT g_email FROM `garage_owner` WHERE `g_email` = '$email' ";
		$result1 = mysqli_query($conn, $sql1);
		$num1 = mysqli_fetch_array($result1);
		if ($num1 > 0) {

			if ($password == $confirmpassword && $passwordvalid == false) {

				$hashpassword = password_hash($password, PASSWORD_DEFAULT);
				$sql2 = "UPDATE garage_owner set g_password='$hashpassword' where g_email='$email'";
				$result2 = mysqli_query($conn, $sql2);
				if ($result2) {
					$alertsuccess = "Password reset successfull!!";
				}
			} else {
				$alerterror = "Password not match or  Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
			}
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
	<title>Mymechanic | Reset Password</title>
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
	$respath ="";
	if(isset($_GET['crmail'])){
		$respath = "Reset_password.php?crmail=".$email;
	}
	else{
		$respath = "Reset_password.php?grmail=".$email;
	}
	
	?>
	<div class="form-container">
		<div class="field-container">
			<form method="POST" action="<?php echo $respath; ?>" class="customer-form" enctype="multipart/form-data">
				<h2 class="form-field" style="font-weight: bold; color:white; text-align:center">Reset Password <i class="bi bi-card-checklist"></i></h2>
				<hr style="height:4px; background-color: Red;">


				<div class="form-field mb-3">
					<p style="font-weight: bold; color:white">Enter New Password:</p>
					<input type="password" maxlength="30" class="form-control" id="password" name="password" required="required" />
				</div>
				<div class="form-field mb-3 ">
					<p style="font-weight: bold; color:white">Confirm New Password:</p>
					<input type="password" maxlength="30" class="form-control" id="confirmpassword" name="confirmpassword" required="required" />
				</div>
				<hr style="height:4px; background-color: white;">
				<div class="button-container">
					<button class="customer-submit mb-1" type="submit">Update Password</button>
					<button class="customer-submit mb-1" type="reset">Reset</button>
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