<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "mymechanic";

$conn = mysqli_connect($server,$username,$password,$database);

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		// ADDING PAYMENT DETAILS IN TO DATABASE START
		$bk_id = $_POST['ORDERID'];	
		$pay_id = $_POST['TXNID'];
		$pay_bank = $_POST['GATEWAYNAME'];
		$pay_mode = $_POST['PAYMENTMODE'];
		$banktrxid= $_POST['BANKTXNID'];
		$pay_amount = $_POST['TXNAMOUNT'];
		$pay_date = $_POST['TXNDATE'];


		$crquery = "SELECT *FROM `booking` WHERE `bk_id` = $bk_id";
		$crresult = mysqli_query($conn,$crquery);
		$crrow = mysqli_fetch_assoc($crresult);
		$cr_id = $crrow['cr_id'];
		
		



		$payquery = "INSERT INTO `payment` (`bk_id`, `cr_id`, `pay_id`, `pay_bank`, `pay_mode`, `banktrxid`, `pay_amount`, `pay_date`) VALUES ('$bk_id', '$cr_id', '$pay_id', '$pay_bank', '$pay_mode', '$banktrxid', '$pay_amount', '$pay_date')";
		$payresult = mysqli_query($conn,$payquery);
		if($payresult){
			$paymentquery = "UPDATE `booking` SET `pay_status` = 'done' WHERE `booking`.`bk_id` = $bk_id";
			$paymentresult = mysqli_query($conn,$paymentquery);
			header('location: http://localhost/final-project/MyMechanic/order.php?payment=true');
		}
		else{
			die(mysqli_errno($conn));
		}
		// ADDING PAYMENT DETAILS IN TO DATABASE END
		
	}
	else {
		header('location: http://localhost/final-project/MyMechanic/order.php?payment=fail');
	}
	
}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>