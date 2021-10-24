<?php
session_start();
$hideLoginForm = false;
$invalidInfo =$failedLogin =false;
//Database connection info
$servername = "localhost";
$username = "11153984";
$password = "joN3YmvY";
$dbname = "db_11153984";
?>


<html>
<head><title>Login</title></head>
<body>
<link rel="stylesheet" href="CSSMainPage.css">
<body class="CentreContent">

<?php
//var_dump($_POST);
//User clicked logout button
if (!empty($_POST["logoutButton"])){
    echo "Testing <br/>";

    $_SESSION['loginID']=null;
    $hideLoginForm = false;//Will show login form as if first login
    $invalidInfo =$failedLogin =false;//Error message won't show
    session_destroy();


}
//If no user logged in & Page was directed from login form page
else if ($_POST!=null && empty($_SESSION['loginID']) ){

    //Username not case-sensitive
    $loginName = strtolower($_POST["username"]);
    //$pass = strtolower($_POST["password"]);
    $pass = $_POST["password"];

    //Check if username and password info were entered
    if(!empty($pass) && !empty($loginName)){

        //Testing client login info
        //var_dump($_POST);
        //echo "loginName:".$loginName."<br/>";
        //echo "LoginPassword".$pass."<br/>";

        // Create connection
        $DBcon = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($DBcon->connect_error) {
            die("Connection failed: " . $DBcon->connect_error);
        }


        try {
            //Check if entered username matching username exist in database
            $sql = "SELECT password FROM Clients WHERE loginName = '$loginName'";
            $result = $DBcon->query($sql);

            while ($rows = $result->fetch_assoc()){
                $LoginPassword = $rows["password"];

                if($pass==$LoginPassword) {
                    //echo "testing login success";
                    //$_SESSION["username"] = $loginName;
                    //$_SESSION['loginID'] = $_SESSION["username"];
                    $_SESSION['loginID'] =$loginName;
                    $failedLogin = false; //User logged in successfully
                    $hideLoginForm = true;//No need for login form
                    //echo "_SESSION['loginID'] is now ".$_SESSION['loginID']."<br/>";
                } else {
                    $failedLogin = true;//User failed to log in
                    $hideLoginForm = false;//To display login form again
                    echo "<p>Login does not match Database info!";
                }
            }
            $result->close();
        }catch (Exception $e){
            echo "Ops something went wrong. <br/>";

        }catch (Error $error){
            echo "Unable to connect to database. <br/>".$error."<br/>";
        }
    }else{//Other situation directed to the page
        echo "Please enter valid username and password <br/>";
        $invalidInfo = true;//User entered non-Null login info
        $hideLoginForm = false;//To display login form

    }



}
else {
    //echo "Other scenario directing to Login.php <br/>";
}

//Check if user already logged in - no need to log in again
if (!empty( $_SESSION['loginID']) ) {
    echo "Logged in successfully <br/>";
    $hideLoginForm = true;
    ?>
    <br/>
    <button onclick="window.location.href = 'ManageBooking.php';">Manage Booking</button>
    <button onclick="window.location.href = 'Booking.html';">Back To Booking</button>
    <form name = "LogOutForm" value = "LogOut" method="post">
        <input type="button" name="logoutButton" value = "Log Out" onclick="window.location.href = 'Login.php';"/>
    </form>


<?php
    //If flight info already selected (at least 1 depart flight selected)
    if(!empty($_SESSION['DepartFlightCode'])){
        echo "Show booking info: ".$_SESSION['DepartFlightCode']." <br/>";
        //Show booking info

        //Confirm to Add flight info to database

    }//Nothing else to display if no flight info recorded
    else {//echo "No booking info <br/>";}

    //If login form/info was submitted
}
}
//$showLoginForm
if(!$hideLoginForm){
    //User first time login or other condition that login failed

    if($failedLogin){//User tried logging in but no matching data
        ?><h3>No matching username/password from the system. Please try again: </h3><?php
    }else if ($invalidInfo){
        ?><h3>Username/Password cannot be empty. Please try again: </h3><?php
    }

    ?>
    <h3>Please enter registered login details: </h3>
    <form method=post>
        User name: <input type=text name=username /><br/>
        Password: <input type=password name=password /><br/>
        <br/>
        <input type=submit name=submit value=Login />
        <input type="button" value="Return" onClick="document.location.href='Booking.html'" /><br/>

    </form>
    <?php
}



?>

