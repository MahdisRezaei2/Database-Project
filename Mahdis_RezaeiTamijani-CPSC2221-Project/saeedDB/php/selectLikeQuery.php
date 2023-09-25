<!doctype html>
<!-- (C) Mahdis Rezaei Tamijani -->
<html>
<head>
    <title>Display Records of a table</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>

    <?php
    $servername = "localhost";
    $dbname = "RealStateDB";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p style='color:green'>Connection Was Successful</p>";
    } catch (PDOException $err) {
        echo "<p style='color:red'> Connection Failed: " . $err->getMessage() . "</p>\r\n";
    }

    try {
        $sql = "SELECT  Person_ID,First_Name,Last_Name,Province,Occupation, Phone_Number,Street, Apartment_Number , City FROM People WHERE First_Name LIKE '$_POST[fname]%'";

        $stmnt = $conn->prepare($sql);   // read about prepared statement here: https://www.w3schools.com/php/php_mysql_prepared_statements.asp

        $stmnt->execute();

        $row = $stmnt->fetch();  // fetches the first row of the table
        if ($row) {
            echo '<table>';
            echo '<tr> <th>Person_ID</th> <th>First_Name</th> <th>Last_Name</th> <th>Province</th> <th>Occupation</th> <th>Phone_Number</th> <th>Street</th> <th>Apartment_Number</th> <th>City</th></tr>';
            do {
                echo "<tr><td>$row[Person_ID]</td><td>$row[First_Name]</td><td>$row[Last_Name]</td><td>$row[Province]</td><td>$row[Occupation]</td><td>$row[Phone_Number]</td><td>$row[Street]</td><td>$row[Apartment_Number]</td><td>$row[City]</td></tr>";
            } while ($row = $stmnt->fetch());
            echo '</table>';
        } else {
            echo "<p> No Record Found!</p>";
        }
    } catch (PDOException $err) {
        echo "<p style='color:red'>Record Retrieval Failed: " . $err->getMessage() . "</p>\r\n";
    }
    // Close the connection
    unset($conn);

    echo "<a href='../index.html'>Back to the Homepage</a>";

    ?>
</body>

</html>