<?php
include('db.php');
function createRandomPassword() {
	$chars = "abcdefghijkmnopqrstuvwxyz023456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= 7) {
		$num = rand() % 33;
		$tmp = substr($chars, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}
$confirmation = createRandomPassword();
$fname=$_POST['fname'];
$qty=$_POST['qty'];
$lname=$_POST['lname'];
$busnum=$_POST['busnum'];
$setnum=$_POST['setnum'];
$date=$_POST['date'];
$contact=$_POST['contact'];
$address=$_POST['address'];
$sqli = "SELECT * FROM route WHERE id='$busnum'";
$result = $conn->query($sqli);
//$result = mysql_query("SELECT * FROM route WHERE id='$busnum'");
while($row = $result->fetch_assoc())
	{
	$price=$row['price'];
	}
	$payable=$qty*$price;
$sql = mysqli_query($conn, "INSERT INTO customer (fname, lname, address, contact, bus, transactionum, payable, setnumber)
VALUES ('$fname', '$lname', '$address', '$contact', '$busnum', '$confirmation','$payable','$setnum')");
$sql1 = mysqli_query($conn, "INSERT INTO reserve (date, bus, seat_reserve, transactionnum, seat)
VALUES ('$date', '$busnum', '$qty', '$confirmation','$setnum')");
header("location: print.php?id=$confirmation&setnum=$setnum");
?>