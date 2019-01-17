<?php
$connection=mysql_connect("localhost", "root", ""); // Establishing Connection with Server
$db=mysql_select_db("mydbaa", $connection); // Selecting Database from Server
if (isset($_POST)) { // Fetching variables of the form which travels in URL
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $email=$_POST["email"];
    $id=$_POST["id"];
    $pass=$_POST["pass"];
    $vehicle=$_POST["vehicle"];
    $area=$_POST["area"];
    if ($fname != '' || $lname != '' || $email != '' || $id != '' || $pass != '' || $vehicle != '' || $area != '') {
//Insert Query of SQL
        $query=mysql_query("insert into form_element(first_name, last_name, email,driver_id ,password,vehicle,area) values ('{$fname}','{$lname}','{$email}', '{$id}', '{$pass}','{$vehicle}','{$area}')");
        echo "<br/><br/><span>Data Inserted successfully...!!</span>";
    } else {
        echo "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>";
    }
}
mysql_close($connection); // Closing Connection with Server



echo "<table style='border: solid 1px black;'>";
echo "<tr><th>First_name</th><th>Last_name</th><th>Email</th><th>Driver_id</th><th>Password</th><th>Vehicle</th><th>Area</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydbaa";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT first_name, last_name,email,driver_id,password,vehicle,area FROM form_element");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>



