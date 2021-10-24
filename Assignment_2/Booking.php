<link rel="stylesheet" href="CSSMainPage.css">
<HTML>
<body  class="Center" >

<?php
session_start();


$departDate = $returnDate = $prompt = "";
$noFlightInfo = true;
$servername = "localhost";
$username = "11153984";
$password = "joN3YmvY";
$dbname = "db_11153984";

//If any form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $departDate = $_POST["DepartDate"];
    $returnDate = $_POST["ReturnDate"];

    $departSite = $_POST["DptAirport"];
    $arriveSite = $_POST["ArvAirport"];

    $DepartFlightCode=$_POST["OptionDepart"];
    $ReturnFlightCode=$_POST["OptionReturn"];

    //echo "departSite : ".$departSite."<br/>";


    //var_dump($_POST);
    //Boolean for showing error page
    $errorPage = false;


    //Check if page was transferred from Booking.html page
    //Verify dates selected - HTML only allows empty value, date of today - 1 year later
    //$departDate is compulsory for booking
    if(!empty($departDate) && $departSite!=$arriveSite){
        //echo "page was transferred from Booking.html page <br/>";

        //Default return flight as false
        $showReturnOption = false;

        $DDate = $_POST["DepartDate"];
        //Get the Day of selected date
        $timestamp = strtotime($DDate);
        $dayCode = date('w', $timestamp);



        // Create connection
        $DBcon = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($DBcon->connect_error) {
            die("Connection failed: " . $DBcon->connect_error);
        }

        try{
            $sql = "SELECT * FROM TimetableFull 
                    WHERE DepartDOW = ".$dayCode." AND DepartPort = '$departSite' AND ArrivePort = '$arriveSite' ORDER BY DepartTime ASC;";

            $result = $DBcon->query($sql);
            //$result = $sql->get_result();
            //$row = $result->fetch_assoc();
            //echo "Test get all results: </br>";
            //var_dump($row);
            echo "<form name ='BookingForm' action='Booking.php' method='post'>";

            if($result ->num_rows>0){
                $noFlightInfo = false;
                echo "<div class='center'> <h4>Depart date: ".$departDate."</h4>";

                echo "<table> <tr> <th>Depart Port</th> <th>Arrive Port</th><th>Depart Time</th> <th>Aircraft Code</th><th>Select Flight</th></tr>";

                while ($row = $result->fetch_assoc()){
                    $flightCode = $row['RouteCode'];
                    echo "<tr><th>".$row['DepartPortName']."</th><th>".$row['ArrivePortName']."</th><th>".$row['DepartTime']. "</th><th>".$row['model']."</th><th><input type='radio' name = 'OptionDepart' value='$flightCode'></th></tr>";

                }
                echo "</table>";
                $showReturnOption = true;

            }else{
                echo "<div style='left: 40%'><p>No flight from selected departure airport on selected date.</p></div><br/>";
                $showReturnOption = false;
            }

            //If there was no valid departure flight
            //User will be prompt to go back to Booking page
            if (!$showReturnOption){
                ?>
                <a class="center" href = "Booking.html">Return</a><br/>
                <?php

                //While there are departure flights available
                //Check flights if return date was selected
            }
            else if(!empty($returnDate) && $showReturnOption){

                //echo "Return date: ".$returnDate."<br/>";
                //$showReturnOption = false;//Back to default value

                //Get the Day of selected return date
                $Rtimestamp = strtotime($returnDate);
                $RdayCode = date('w', $Rtimestamp);

                $sql = "SELECT * FROM TimetableFull 
                    WHERE DepartDOW = '$RdayCode' AND DepartPort = '$arriveSite' AND ArrivePort = '$departSite' ORDER BY DepartTime ASC;";

                $result = $DBcon->query($sql);
                if($result ->num_rows>0){
                    $noFlightInfo = false;

                    echo "<br/><h4>Depart date: ".$returnDate."</h4>";
                    //echo "<form name ='BookingArriveForm' action='Booking.php' method='post'>";
                    echo "<table> <tr> <th>Depart Port</th> <th>Arrive Port</th><th>Depart Time</th> <th>Aircraft Code</th><th>Select Flight</th></tr>";

                    while ($row =  $result->fetch_assoc()){
                        $flightCode = $row['RouteCode'];
                        echo "<tr><th>".$row['DepartPortName']."</th><th>".$row['ArrivePortName']."</th><th>".$row['DepartTime']. "</th><th>".$row['model']."</th><th><input type='radio' name = 'OptionReturn' value='$flightCode'></th></tr>";

                    }
                    echo "</table><br/>";
                    //echo "</form></div>";

                    $showReturnOption = true;

                }else{
                    echo "<br/>No flight from selected arrival airport on selected date.<br/>";
                    $showReturnOption = false;
                }



            }
            else{
                echo "<h4>No return flight chosen to display</h4><Br/>";

            }

            if (!$noFlightInfo){
                ?> <input  style="margin-left: 30%" type="submit" name = "BookFlight" value="Book">&nbsp &nbsp
                </div></form>

                <?php
            }


            $result->close();//Free the result

            //? ><a href = "Booking.html">Return</a><br/><?php

        }catch (Exception $e){
            echo "Ops something went wrong. <br/>";

        }catch (Error $error){
            echo "Unable to connect to database. <br/>";
        }


        if ($DBcon->query($sql) == TRUE) {
            //echo "Timetable data was obtained.<br/>";
        } else {
            echo "<br/>Error with following SQL request: <br/>" . $sql . "<br/>" . $DBcon->error;

        }

        $DBcon->close();//Close connection




    }else {
        //echo "page was not transferred from Booking.html page <br/>";


        // If page was submitted from current page - hence no depart date
        // Check if Depart and Return flight were selected

        if(empty($_POST["OptionDepart"])&&empty($_POST["OptionReturn"])){
            // No depart/return flight selected - error page
            $errorPage = true;

        }else {
            //Page was submitted from current page for flight selection

            //Testing booking
            $_SESSION['loginID'] = "TEST";
            if(!empty($_SESSION['loginID']) ){
                //echo 'User has logged in<br/>';
                // Create connection
                $DBcon = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($DBcon->connect_error) {
                    die("Connection failed: " . $DBcon->connect_error);
                }

                try{
                    //echo "DepartFlightCode is ".$DepartFlightCode."<br/>";
                    $sqlCostDepart = "SELECT Price FROM Prices WHERE Prices.RouteID = '$DepartFlightCode';";
                    $result = $DBcon->query($sqlCostDepart);

                    if($result ->num_rows>0){

                        while ($row = $result->fetch_assoc()){
                            $CostDepart = $row['Price'];
                            echo "Cost for Departure Flight is: ".$CostDepart."<br/>";
                        }
                        $_SESSION['DepartFlightCode']=$DepartFlightCode;
                    }

                    $sqlCostReturn = "SELECT Price FROM Prices WHERE Prices.RouteID =".$ReturnFlightCode;
                    $result = $DBcon->query($sqlCostReturn);

                    if($result ->num_rows>0){

                        while ($row = $result->fetch_assoc()){
                            $CostReturn = $row['Price'];
                            echo "Cost for Return Flight is: ".$CostReturn."<br/>";
                        }
                        $_SESSION['ReturnFlightCode']=$ReturnFlightCode;
                    }
                    $Cost = $CostDepart + $CostReturn;
                    echo "Total flight cost: ".$Cost."<br/>";


                    ?>
<!--                    <h4>Confirm booking? </h4>-->
<!--                    <form name = "ConfirmBookingForm" method="post" >-->
<!--                        <input type="button" name= "confirmBookingButton" onclick="window.location.href = 'Booking.php';">Confirm Booking</input><br/>-->
<!--                    </form>-->
                    <?php
                    $Reference =generateReference();
                    $loginID = $_SESSION['loginID'];
                    $sqlAddFlight = "INSERT INTO Flights VALUE ('$Reference', '$loginID', '$Cost') ;";

                    $result = $DBcon->query($sqlAddFlight);
                    echo "Flight has been added to system. <br/> Your reference number is ".$Reference."<br/>";


                }catch (Exception $e){
                    echo "Ops something went wrong. <br/>";
                }catch (Error $error){
                    echo "Unable to connect to database. <br/>";
                }


            }
            else {
                ?><h4>User not logged in. Please login first.</h4>
                <button onclick="window.location.href = 'Login.php'">Login</button>
                <br/>
                <?php
            }




        }

        if ($errorPage){
            $errorimg = "https://sncs-webdev.australiasoutheast.cloudapp.azure.com/site1015/159339/Assignment_2/Images/Error.jpg";
            ?>
            <html>
            <style>
                .errorPage {
                    background: url( "<?php echo $errorimg; ?>") repeat center center fixed;
                    position: relative;
                    margin: -40%;
                }

            </style>
            <br/>
            <br/>
            <div class="errorPage CentreContent">
                <div style="margin-top: 10%">
                    <p class="center" >Please enter/select valid flight information.</p>
                    <a class="center" href = "Booking.html">Return</a><br/>
                </div>
                <br/>
                <br/>
                <br/>
                <br/>
            </div>
            </html>

            <?php
        }else{
            ?>
            <button onclick="window.location.href = 'Booking.html';">Return</button>

        <?php }


    }


}else{
    //If no form was submitted, user can direct back to booking page
    ?>
    <button style="margin-left: 35%" onclick="window.location.href = 'Booking.html';">Return</button>

    <?php
}

//Generate 10 character flight reference including number and letters
function generateReference() {
    $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($char);
    $reference = '';
    for ($i = 0; $i < 10; $i++) {
        $reference .= $char[rand(0, $charLength - 1)];
    }
    return $reference;
}
?>


</body>
</HTML>