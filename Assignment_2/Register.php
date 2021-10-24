<link rel="stylesheet" href="CSSMainPage.css">
<HTML>
<body  class="Center" >

<div style="margin: -10%" class="Content">
<?php

//Check if information matches with existing
//Define variables for Registration form
$uName = $fName=$lName= $dateDOB =$dd = $mm = $yy = $gender= $address = $contact=$passwd=$passwdC =$email = "";

//Testing random ecrypted password
/*echo "Current Password is: ".$passwd;
try{
    echo password_hash($passwd, PASSWORD_DEFAULT, ['cost'=>5]);
} catch (Exception $e){
    echo "Password ecryption failed";
}
*/

$nonadult = false; // Status for non-adult user - limited booking function allowed

//All compulsory info must be filled out - Address is not compulsory
//Set compulsory parts' individual error messages to "" at start
$uNameErr=$fNameErr = $lNameErr = $ageErr = $genderErr=$contactErr= $pswErr= $pswCErr =$emailErr = $generalErr= "";

//Check if Previously received request to submit client info via form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //print_r($_POST);
    //Get info from form


    if(empty($_POST["UName"])){
        $uNameErr = "Username is required";
    }else{
        $uNameErr = "";
        $uName = $_POST["UName"];
    }

    if (empty($_POST["FName"])) {
        $fNameErr = "First Name is required";
    } else {
        $fName = $_POST["FName"];
        $fNameErr = "";
        //Check if name valid - only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $fName)) {
                $fNameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["LName"])) {
        $lNameErr = "Family Name is required";
    }else {
        $lNameErr = "";
        $lName = $_POST["LName"];

        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lName)) {
                $lNameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST['day'])||empty($_POST['month'])||empty($_POST['year'])) {
        $ageErr = "Please enter Date of Birth";
    } else {
        $ageErr = "";
        //Check of DOB is
        $dd = $_POST['day'];
        $mm = $_POST['month'];
        $yy = $_POST['year'];
        //$dateDOB = date("l, jS F Y ", mktime(0, 0, 0, $mm, $dd, $yy));
        $dateDOB = date('Y-m-d', mktime(0, 0, 0, $mm, $dd, $yy));

        $dateNow = date('Y-m-d');

        //Calculate age by counting date differences
        $DateDiff = date_diff(date_create($dateDOB), date_create($dateNow));
        $age = $DateDiff->format('%y');

        //Check if age is valid
        if($age< 10||$age>130){
            //If the registered user is under 18 - nonadult
            //They can still register but with limited booking function
            $ageErr = "Please enter a valid age";
        }if ($age <18){
            $nonadult = true;
        }
    }

    if (empty($_POST["Gender"])) {
        $genderErr = "Gender is required";
    } else {
        $genderErr = "";
        $gender = $_POST["Gender"];
    }

    if (empty($_POST["Contact"])) {
        $contactErr = "Contact Number is required";
    } else {
        //$contactErr = "";
        $contact = $_POST["Contact"];
    }

    if(empty($_POST["Password"])){
        $pswErr = "Please enter a valid password";
    }else {
        $pswErr = "";
        $passwd = $_POST["Password"];
    }

    if (empty($_POST["PasswordConfirm"])){
        $pswCErr = "Please enter the password again to confirm";
    }else {
        $pswCErr = "";
        $passwdC = $_POST["PasswordConfirm"];
        if ($passwd!=$passwdC){
            $pswCErr = "Password entered is different from the password above";
        }
    }

    if (empty($_POST["Email"])) {
        $email = "Email is required";
    } else {
        $emailErr = "";
        $email = $_POST["Email"];
    }

    //If all questions are answered/no error messages, data will be submitted to Database
    if(empty($uNameErr)&&empty($fNameErr) && empty($lNameErr) && empty($genderErr) && empty($emailErr) &&
        empty($ageErr) && empty($contactErr)&&empty($pswErr)&&empty($pswCErr)&& empty($generalErr)){

        //echo "Test:trying to connect to database <br/>";
        //Connect to database
$servername = "localhost";
$username = "11153984";
$password = "joN3YmvY";
$dbname = "db_11153984";

        $DBcon = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($DBcon->connect_error) {
            die("Connection failed: " . $DBcon->connect_error);
        }

        try {
            //Check if username exists in Database - check if username was already used
            // if not -add user info to database
            $sql = "SELECT loginName FROM Clients WHERE loginName = '$uName'";
            $result = $DBcon->query($sql);

            $FirstTimeRegister = true;
            while ($rows = $result->fetch_assoc()){
                $LoginName = $rows["loginName"];
                //echo "Test:trying to get result from database <br/>";
                if($LoginName==$uName) {
                    $generalErr = "Username was already registered <br/>";
                    $FirstTimeRegister = false;
                    //$_SESSION["username"] = $uName;
                }else {
                    //echo "<p>Username does not exist in Database";
                }
            }

            //$result->close();

            if($FirstTimeRegister){

                $sql = "INSERT INTO Clients VALUES  ('$uName', '$passwd', '$fName', '$lName', '$dateDOB', '$gender', '$contact', '$email') ;";
                $result = $DBcon->query($sql);
               ?>
			<div class="Center">
                <p >Registered successfully. Would you like to login? </p><br/>
                <button onclick="window.location.href = 'Login.php'">Login</button>&nbsp  &nbsp
			</div>
                <?php

            }

            //echo "Test:SQL completed - closing results <br/>";
            //$result->close();
            //$DBcon->close();


        }catch (Exception $e){
            echo "Ops something went wrong. <br/>";

        }catch (Error $error){
            echo "Unable to connect to database. <br/>".$error."<br/>";
        }
    }else{
        //echo "Please ensure all the questions are answered <br/>";

        //Check if first time directing to the page
        if($_POST["register"]=="Register"){//Form was clicked
            $generalErr = "* Not all questions are answered. <br> * Please make sure all the compulsory questions are answered. <br> ";
        }else{
            $generalErr = "";
        }

    }



    //Password safety
    //echo "Current Password is: ".$passwd;
    //echo password_hash($passwd, PASSWORD_DEFAULT, ['cost'=>10]);


} else {
        $generalErr = "";

}



    //Check if first time starting the test - $submitResults equals value "Start"
    //No need for validation check if page just got transferred
    //No need to reassign $submitResult value as when this form is submitted, value will be "submit"
    //if ($firstTimeRegister == "Register"){
        //echo "A form was submitted";
        //Detailed error messages will not be displayed if form was just submitted
        //$generalErr = "";

   // } else{
        //Validate detailed answers, First/Family names, Age, /residence place
        // and display relevant error info
//}



//Check validity of info submitted -Error prompt will show if missing some sections


//$errorMsg="";
//if(empty($uName)||empty($fName)||$lName==""||$passwd==""||$email==""){
    //$errorMsg = "Please ensure the form has been filled out ";
//}

?>
    <div style="margin-left: 18%">
    <p>Thank you for choosing to become a registered user. </p>
    <p>Please fill out the following form.</p>
    <p>Sections with "*" are required fields.</p>
    <p style="color: #b60303"><?php echo $generalErr?></p>

    <?php //echo $errorMsg."<br/>"?>
    </div>
    <br/>

<form style="margin-left: 18%" name = "RegisterForm" action="Register.php" method="post">
    Username: <input class="TextBox" type="text" name="UName" size="25"><span class="error">*<?php echo $uNameErr;?></span><br/>
    First Name: <input class="TextBox" type="text" name="FName" size="25"><span class="error">*<?php echo $fNameErr;?></span><br/>
    Family Name: <input class="TextBox" type="text" name="LName" size="25"><span class="error">*<?php echo $lNameErr;?></span><br/>
    Date of Birth:
    <select name=day id=day><option selected value="">Select Day</option>
    <?php
        for ($day = 1; $day<= 31; ++$day) {
            print "\t<option value=\"$day\">$day</option>\n";
        }
        ?>
    </select>
    <tr><td valign="middle" colspan=2>Month
            <select name=month>
                <option SELECTED value="">Select Month</option>
                <?php
                for ($month = 1; $month<= 12; ++$month) {
                    print "\t<option value=\"$month\">$month</option>\n";
                }
                ?>
            </select>

    <tr><td valign="middle" colspan=2>Year
            <select name=year>
                <option SELECTED value="">Select Year</option>

                <?php
                for ($year = 2005; $year >= 1900; --$year) {
                    print "\t<option value=\"$year\">$year</option>\n";
                }
                ?></select><span class="error">*<?php echo $ageErr;?></span><br/>
    Gender:
    <input type="radio" name="Gender" value="M">Male
    <input type="radio" name="Gender" value="F">Female
    <span class="error">*<?php echo $genderErr;?></span><br/>
    Address: <input class="TextBox" style="width: 60%" type = "text" name="Address"><br/>
    Contact Number: <input class="TextBox" type="number" name="Contact"><span class="error">*<?php echo $contactErr;?></span><br/>
    Email: <input class="TextBox" type="email" name="Email" size="25"><span class="error">*<?php echo $emailErr;?></span><br/>
    Password:  <input class="TextBox" type="password" name="Password" size="25"><span class="error">*<?php echo $pswErr;?></span><br/>
    Password:  <input class="TextBox" type="password" name="PasswordConfirm" size="25"><span class="error">*<?php echo $pswCErr;?></span><br/>

    <br/>
    <input  style="margin-left: 15%" type="submit" name = "register" value="Register">&nbsp &nbsp
    <input type="reset" >&nbsp &nbsp
    <input type="button" value="Return" onClick="document.location.href='Booking.html'" /><br/>



</form>
</div>

</body>
</HTML>
