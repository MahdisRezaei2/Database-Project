<!doctype html>
<!-- (C) Mahdis Rezaei Tamijani -->
<html>
<head>
	<title>Insert Data Into a Database</title>
	<link rel="stylesheet" href="../css/style.css" />
</head>
<body>

<?php
$servername ="localhost";
$dbname = "RealStateDB";
$username = "root";
$password = "";

/* Try MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password).
If the connection was tried and it was successful the code between braces after try is executed, if any error happened while running the code in try-block, 
the code in catch-block is executed. */
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Sets the error mode of PHP engine to Exception to display all the errors
	echo "<p style='color:green'>Connection Was Successful</p>";
}
catch (PDOException $err) {
	echo "<p style='color:red'>Connection Failed: " . $err->getMessage() . "</p>\r\n";
}

try {
	$sql="INSERT INTO People (Person_ID, Occupation, Phone_Number, First_Name, Last_Name,Street,Apartment_Number,Province,City ) VALUES (:personid, :oc, :pn, :fn, :ln, :str, :apn, :pv, :cy);";   // all the variable names must start with a colon (:)
	$stmnt = $conn->prepare($sql);    // read about prepared statement here: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
	$stmnt->bindParam(':personid', $_POST['personID']);   // stdId in $_POST['stdId'] in the exact name of the input element in HTML. if any typo, your code does not work   
	$stmnt->bindParam(':oc', $_POST['OC']);   // note the single quotes, If you forget to put single quotes, your code does not work.
	$stmnt->bindParam(':pn', $_POST['pnumber']);
	$stmnt->bindParam(':fn', $_POST['fname']);
	$stmnt->bindParam(':ln', $_POST['lname']);
	$stmnt->bindParam(':str', $_POST['street']);
	$stmnt->bindParam(':apn', $_POST['apnumber']);
	$stmnt->bindParam(':pv', $_POST['province']);
	$stmnt->bindParam(':cy', $_POST['city']);

	$stmnt->execute();

	echo "<p style='color:green'>Data Inserted Into Table Successfully</p>";
}
catch (PDOException $err ) {
	echo "<p style='color:red'>Data Insertion Failed: " . $err->getMessage() . "</p>\r\n";
}
// Close the connection
unset($conn);

echo "<a href='../insertData.html'>Insert More Values</a> <br />";

echo "<a href='../index.html'>Back to the Homepage</a>";

?>

</body>
</html>