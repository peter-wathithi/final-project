<html>
<link rel="stylesheet" type="text/css" href="stylesheet/booking.css">
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<body>

</form
</body>
</html>
<?php
echo "</table>";
echo "<h1>List of Drivers Availble At the moment </h1>";
echo "<P>Pick a driver from your origin area and communicate via Email</P>";
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>First_name</th><th>Last_name</th><th>Email</th><th>Driver_id</th><th>Password</th><th>Vehicle</th><th>Area</th></tr>";
echo "<tbody class='mytable'></tbody>";
class TableRowss extends RecursiveIteratorIterator
{
    function __construct ($it)
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current ()
    {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current() . "</td>";
    }

    function beginChildren ()
    {
        echo "<tr>";
    }

    function endChildren ()
    {
        echo "</tr>" . "\n";
    }
}


$servername="localhost";
$username="root";
$password="";
$dbname="mydbaa";

try {
    $conn=new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt=$conn->prepare("SELECT first_name, last_name,email,driver_id,password,vehicle,area FROM form_element");
    $stmt->execute();

    // set the resulting array to associative
    $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach (new TableRowss(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn=null;
