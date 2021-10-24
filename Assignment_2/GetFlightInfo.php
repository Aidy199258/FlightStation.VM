<?php

//Get flight duration (hr), 0.25hr extra for flight speed differences
//$distance = $cruisekn = NULL;
//$time = $distance/$cruisekn + 0.5;

?>
<?php
//Validate input and prompt users if no date other than current date was selected
//If no date was chosen, no extra result will be displayed as today's timetable already displayed
$Date = $prompt = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Date = $_POST["SelectedDate"];


    if($Date){
        echo "A date has been selected";
        echo "Selected date is : ".$Date;
        //Analyse the date value to pull data from database


    }else {
        $errorimg = "/Images/Error.jpg";
        ?>
       <html>
            <style>
                .errorPage {
                    background: url( "<?php echo $errorimg; ?>") repeat center center fixed;
                    position: relative;
                    left: 40%;
                    Top: 50%;
                }

            </style>
            <br/>
            <br/>
            <br/>
            <br/>
            <body class="errorPage">
            <p>Please select a valid date.</p>
            <a href = "Timetable.html">Return</a></body>
       </html>


            <?php
    }

    //$submitResult = $_POST["submit"];
    //echo "Submit button value is : ".$submitResult;
}
?>


