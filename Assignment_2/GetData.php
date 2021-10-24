<?php
//Get Data value and assign to Variables
print_r($_POST);

$day= $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];

print "<h2>Your date of birth is $day-$month-$year</h2>";

$dateString = date("l, jS F Y ", mktime(0, 0, 0, $day,$month,$year));

print "<h2>Your date of birth is " . $dateString . "</h2>";

