<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 


<?php

/*
Author: Spencer Halmos 
Updated:6/29/2018
This example gets the status back from a text message delivered earlier.  Please note I have not added any error trapping here, so use at your own risk.*/

echo "<h2>The Output:</h2>";

/* This is your API Key. */

$key = check_input($_POST['key3']);

/* This is the unique ID you provided for this message.  Use it to get the status and message responses. User-defined identification. Up to 32 characters. */

$id  = check_input($_POST['ID3']);

//Delivery timestamp. 24-hour time, including UTC offset. Format: YYYY-MM-DD HH:MM
$delivery  = check_input($_POST['date3']);

//The name associated with the address this email should be sent from.
$namefrom  = check_input($_POST['from']);

//The name associated with the address this email should be sent to.
$nameto  = check_input($_POST['nameto']);

//The address this email should be sent to.
$email  = check_input($_POST['email']);

//The subject line for this email.
$subject  = check_input($_POST['subject']);

//A timestamp for an appointment associated with this event. Same format as <delivery>.
$event  = check_input($_POST['event']);

//If the template you're using has a place to put freeform text after the message body, this will be used in that spot.
$append  = check_input($_POST['append']);

//If the template you're using has a confirm link in it, this provides the text and URL for that confirmation link.
$confirm  = check_input($_POST['confirm']);

//The ID of the message template from your account which you would like to use for this message. -1 is a generic template that can be used by any user.
$template  = check_input($_POST['template']);

//If the template you're using has a spot for your personal/business name, this will be used there.
$myname  = check_input($_POST['myname']);

//If the template you're using has a spot for your street address, this will be used there.
$myaddress  = check_input($_POST['myaddress']);

//If the template you're using has a spot for your phone number, this will be used there.
$myphone  = check_input($_POST['myphone']);



// Print your key value to the page.
echo $key;
echo "<br>";

// This means that you request the status for a text message.  For calls use <call> UniqueID </call>
// IMPORTANT: I am forcing this to Pacific standard time (-07) for delivery. You need to manage time zones properly.

$msg2 = '<request>
	<key>'.$key.'</key>
<email action="create">
  <id>'.$id.'</id>
  <delivery>'.$delivery.'-07</delivery>
  <from>
    <name>'.$namefrom.'</name>
  </from>
  <to>
    <name>'.$nameto.'</name>
    <email>'.$email.'</email>
  </to>
  <subject>'.$subject.'</subject>
  '.$eventField.'
  '.$appendField.'
  <confirm href="http://my.domain.com/some/confirm/uri">'.$confirm.'</confirm>
  <template id="-1">
    <value field="myName">'.$myname.'</value>
    <value field="myAddress">'.$myaddress.'</value>
    <value field="myPhone">'.$myphone.'</value>
  </template>
</email>
</request>';

// Allows event to be optional
if ($event = null) {
    $eventField = "";
}else {
    $eventField ='<event>'.$event.'</event>';
}

// Allows append to be optional
if ($append = null) {
    $appendField = "";
}else {
    $appendField ='<append>'.$append.'</append>';
}

/*
<request>
  <key>f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b</key>
<email action="create">
  <id>testem1234</id>
  <delivery>2019-07-11 12:30-07</delivery>
  <from>
    <name>Test Practice</name>
  </from>
  <to>
    <name>Test Patient</name>
    <email>ethan@remindercall.com</email>
  </to>
  <subject>Your Appointment with Test Practice</subject>
  <event>2019-07-12 12:30-07</event>
  <append>Custom text to append after the body of the email</append>
  <confirm href="http://my.domain.com/some/confirm/uri">Confirm Your Appointment</confirm>
  <template id="-1">
    <value field="myName">Name Here</value>
    <value field="myAddress">123 Some St.</value>
    <value field="myPhone"></value>
  </template>
</email>
</request>
*/
// If there are no errors then continue

if ($anyErr == "") {
// There are NO errors
  $curl = curl_init();
  // You can also set the URL you want to communicate with by doing this:
  // $curl = curl_init('http://localhost/echoservice');
   
  // We POST the data
  curl_setopt($curl, CURLOPT_POST, 1);
  // Set the url path we want to call
  curl_setopt($curl, CURLOPT_URL, 'https://api.remindercall.net/v4/dispatch.xml');  
  // Make it so the data coming back is put into a string
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  // Insert the data
  curl_setopt($curl, CURLOPT_POSTFIELDS, $msg2);
   
  // You can also bunch the above commands into an array if you choose using: curl_setopt_array
   
  // Send the request
  $result = curl_exec($curl);
  // Free up the resources $curl is using
  curl_close($curl);
  
  echo "Your results are: ";
  // print the response on the page
  echo $result;

} else {
    //There ARE errors
    echo "There ARE errors";
    echo "<br>";
    echo $nameErr;

    echo "<br>";
    echo $msg2;
    echo "<br>";
    echo strlen($pwd);
}
?>
</body>
</html>

<?php
function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
