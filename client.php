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
$connection=mysql_connect("localhost", "root", ""); // Establishing Connection with Server
$db=mysql_select_db("mydbaa", $connection); // Selecting Database from Server
if (isset($_POST)) { // Fetching variables of the form which travels in URL
    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $origin=$_POST["origin"];
    $destination=$_POST["destination"];
    $capacity=$_POST["capacity"];
    if ($username != '' || $email != '' || $password != '' || $origin != '' || $destination != '' || $capacity != '') {
//Insert Query of SQL
        $query=mysql_query("insert into client(username, email,password,origin,destination,capacity) values ('{$username}','{$email}', '{$password}','{$origin}', '{$destination}','{$capacity}')");
        echo "<br/><br/><span>Data Inserted successfully...!!</span>";
    } else {
        echo "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>";
    }
}
mysql_close($connection); // Closing Connection with Server


echo "<table style='border: solid 1px black;'>";
echo "<tr><th>User Name</th><th>Email</th><th>Password</th><th>Origin From</th><th>Destination To</th><th>Capacity</th></tr>";

class TableRows extends RecursiveIteratorIterator
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
    $stmt=$conn->prepare("SELECT username,email,password,origin,destination,capacity FROM client");
    $stmt->execute();

    // set the resulting array to associative
    $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn=null;
echo "</table>";

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';  //mailtrap SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'c5a5e08b4d7dc4';   //username
    $mail->Password = '4d2c411ab98d7e';   //password
    $mail->Port = 465;                    //smtp port

    $mail->setFrom('noreply@artisansweb.net', 'Share Ride Cabs');
    $mail->addAddress('peterwathithi8@gmail.com', 'Share Ride Cabs');

    $mail->isHTML(true);

    $mail->Subject = 'Share Ride Cabs ';
    $mail->Body    = 'ShareRide, <p>This is a confirmation mail sent from Share Ride Cabs to confirm your Log in</p><br>Thanks<br>
<p>Follow the link and choose the driver who has the same area stationed with your origin and choose the type of vehicle depending on the capacity of your choice</p>
    <a href="http://localhost:63342/htdocs/finalproject/server.php">click here</a>';

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>

