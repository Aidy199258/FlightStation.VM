<HTML>
<link rel="stylesheet" href="CSSMainPage.css">
<body  class="CentreContent" >

<div id = "frameDiv" class="Frame" >


<?php
//Validate input and prompt users if no date other than current date was selected
//If no date was chosen, no extra result will be displayed as today's timetable already displayed

$Date = $prompt = "";

//Check if the Check button for select date was clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Date = $_POST["SelectedDate"];

    if($Date){//True if a date has been selected
        //echo "A date has been selected";
        //echo "Selected date is : ".$Date."<BR/>";

        //Get the Day of selected date
        $timestamp = strtotime($Date);
        $dayCode = date('w', $timestamp);


$servername = "localhost";
$username = "11153984";
$password = "joN3YmvY";
$dbname = "db_11153984";


// Create connection
        $DBcon = new mysqli($servername, $username, $password, $dbname);

// Check connection
        if ($DBcon->connect_error) {
            die("Connection failed: " . $DBcon->connect_error);
        }

        try{
       //$sql = "SELECT RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode FROM DairyFlatFlights WHERE DepartDOW = '$dayCode' ORDER BY DepartTime;";
        $sql = "SELECT * FROM DairyFlatFlights 
                INNER JOIN Week ON DairyFlatFlights.DepartDOW = Week.ID 
                INNER JOIN Destinations ON DairyFlatFlights.ArrivePort = Destinations.code
                INNER JOIN Aircraft ON DairyFlatFlights.AircraftCode = Aircraft.craftID
                where ID = '$dayCode'
                ORDER BY DepartTime ASC ;";
            $result = $DBcon->query($sql);
            //$row = $result->fetch_assoc();
            if($result ->num_rows>0){
              echo "<div class='center'><table> <tr> <th>Depart Port</th> <th>Arrive Port</th><th>Depart Time</th> <th>Aircraft Code</th></tr>";
       
                 while ($row =  $result->fetch_assoc()){
                    echo "<tr><th>"."Dairy Flat"."</th><th>".$row['airport']."</th><th>".$row['DepartTime']. "</th><th>".$row['model']."</th></tr>";

                }
                echo "</table></div>";

            }else{
                echo "No flight from Dairy Flat Airport today.";
            }

            $result->close();//Free the result
            ?>
            <a href = "Timetable.html">Return</a>
            <?php
        }catch (Exception $e){
            echo "Ops something went wrong. <br/>";

        }catch (Error $error){
            echo "Unable to connect to database. <br/>";
        }
        if ($DBcon->query($sql) == TRUE) {
            //echo "Timetable data was obtained";
        } else {
            echo "<br/>Error with following SQL request: <br/>" . $sql . "<br/>" . $DBcon->error;

        }

        $DBcon->close();//Close connection



    }else {

        ?>

        <script>
            document.body.style.backgroundImage = "url('/Images/Error.jpg')";
            var div = document.getElementById('frameDiv');
            div.style.backgroundColor = 'transparent';
        </script>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>

        <p style="margin-top: 10%">Please select a valid date.</p>
        <a href = "Timetable.html">Return</a>




        <?php
    }

        //$submitResult = $_POST["submit"];
        //echo "Submit button value is : ".$submitResult;
}else{
    //No date was selected and landed not through select date- show today's flight


$servername = "localhost";
$username = "11153984";
$password = "joN3YmvY";
$dbname = "db_11153984";



// Create connection
    $DBcon = new mysqli($servername, $username, $password, $dbname);

// Check connection
    if ($DBcon->connect_error) {
        die("Connection failed: " . $DBcon->connect_error);
    }

//Get the day of week for today
    $DoW = date('w');

    try{

        //$sql = "SELECT RouteCode, DepartDOW, DepartPort, ArrivePort, DepartTime, AircraftCode FROM DairyFlatFlights WHERE DepartDOW = '$dayCode' ORDER BY DepartTime;";
        $sql = "SELECT * FROM DairyFlatFlights 
                INNER JOIN Week ON DairyFlatFlights.DepartDOW = Week.ID 
                INNER JOIN Destinations ON DairyFlatFlights.ArrivePort = Destinations.code
                INNER JOIN Aircraft ON DairyFlatFlights.AircraftCode = Aircraft.craftID
                where ID = '$DoW'
                ORDER BY DepartTime ASC ;";
        $result = $DBcon->query($sql);
        //$row = $result->fetch_assoc();
        if($result ->num_rows>0){
         echo "<div class='center'><table> <tr> <th>Depart Port</th> <th>Arrive Port</th><th>Depart Time</th> <th>Aircraft Code</th></tr>";
       
            while ($row =  $result->fetch_assoc()){
                echo "<tr><th>"."Dairy Flat"."</th><th>".$row['airport']."</th><th>".$row['DepartTime']. "</th><th>".$row['model']."</th></tr>";

            }
            echo "</table></div>";

        }else{
            echo "No flight from Dairy Flat Airport today.";
        }

        $result->close();//Free the result

    }catch (Exception $e){
        echo "Ops something went wrong. <br/>";

    }catch (Error $error){
        echo "Unable to connect to database. <br/>";
    }
    if ($DBcon->query($sql) == TRUE) {
        //echo "Timetable data was obtained";
    } else {
        echo "Error with following SQL request: <br/>" . $sql . "<br/>" . $DBcon->error;
    }

    $DBcon->close();//Close connection
    ?>
    <br/>
    <br/>
    <button onclick="window.location.href = 'Timetable.html';">Back To Timetable Page</button>
</div>
</body>
</HTML>
    <?php
}
?>





