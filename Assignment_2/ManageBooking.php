<html>
<head><title>Booking Management</title></head>

<link rel="stylesheet" href="CSSMainPage.css">
<body class="CentreContent">
<?php
//print_r($_POST);
session_start();
$servername = "localhost";
$username = "11153984";
$password = "joN3YmvY";
$dbname = "db_11153984";

//Testing
$_SESSION['loginID'] = "TEST";

$loginID = $_SESSION['loginID'];
if(isset($_SESSION['loginID']) ){
    //echo 'User has logged in<br/>';

    // Create connection
    $DBcon = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($DBcon->connect_error) {
        die("Connection failed: " . $DBcon->connect_error);
    }


    //Get booking info from database
    try{
        $sql = "SELECT * FROM Flights WHERE username = '$loginID';";
        $result = $DBcon->query($sql);
        if($result ->num_rows>0) {

            echo "<h4>All Bookings</h4>";
            echo "<div class='CentreContent' style='margin-left: 40%'>";
            echo "<table> <tr> <th>Flight Reference</th> <th>Total Costs</th></tr>";

            while ($row = $result->fetch_assoc()) {
                $reference = $row['Reference'];
                $cost = $row['totalCost'];
                echo "<tr><th>" . $reference. "</th><th>" . $cost . "</th></tr>";

            }
            echo "</table></div><br/>";
        } echo "No booking yet. Time to make some booking :) <br/>";
    }catch (Exception $e){
            echo "Ops something went wrong. <br/>";

        }catch (Error $error){
            echo "Unable to connect to database. <br/>";
        }


    ?>

<?php


}else echo "User not logged in <br/>";


//$return = $_POST["ReturnOption"];//true for return, false for one way
//$ticket = $_POST["Passengers"];
//$DepartDate = $_POST["SelectedDate"];

?>

<!--<p>You have selected --><?//=$ticket?><!-- ticket(s) for the following flight: </p><br/>-->
<!--<form name="BookingForm" action="ManageBooking.php" method="post">-->
<!--    <button name = "ConfirmButton" value="ConfirmBooking" >Book</button>-->
<!--</form>-->

<button onclick="window.location.href = 'Booking.html';">Back To Booking Page</button>

<?php
////Get price of flight selected
//$routeID = $routePrice = 0;
//
//if ($return){
//    $cost = $routePrice * 2;
//}else $cost = $routePrice;
//
//?>
<?php
//if ($_POST["ConfirmButton"] == "ConfirmBooking"){
//    $sqlRandom = "select substring(MD5(RAND()),1,20);"; //SQL for generate random reference code
//    echo "Confirmed booking";
//}
//
//
//?>

</body>
</html>