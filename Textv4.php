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
This example sends a text message using the Remindercall.com API.  Please note I have not added any error trapping here, so use at your own risk.*/
echo "<h2>Your Input:</h2>";

// We declare these varables and set them all to an empty string
$nameErr = $emailErr = $genderErr = $messageErr = $groupingErr = $anyErr = "";
$comment = $msg3 = "";

/* Your message would not be able to be sent without a $key field. */
$key = check_input($_POST['key']);

/*The $id field is very important and it is required.  It must be a unique ID that you keep track of within your own system.  You cannot have two ID's that are identical or you will get an error returned.

As an example: If you are trying to send reminders from a calendar, use the appointment ID which would be unique to each appointment.  This way you can use this ID value later to check on the status of the outgoing message.

This ID value can be any string value up to 32 characters.  So a number like 55555555 is fine or even "A5-643J@!!" will work too.*/
$id = check_input($_POST['ID']);

// User-defined reference ID. Could be e.g. an appointment or patient ID.
$reference = check_input($_POST['reference']);

/* The phone number is 10 digits only. This will be the number that the message is being sent to. Strip out all spaces, parenthesis, etc.  any other format than this will cause an error*/
$numberto = check_input($_POST['numberto']);

/* The phone number is 10 digits only. This will be the number that the message will be sent from. Strip out all spaces, parenthesis, etc.  any other format than this will cause an error*/
$numberfrom = check_input($_POST['numberfrom']);

/* Delivery is when you want your message delivered with both date and time.  It's in the format of "YYYY-MM-DD HH:MM-TZ"  where the -TZ is your timezone offset.  Pacific right now is -07.  You will need to account for this.  If you are trying to send a message from Califrnia at 2:30 PM your value here will look like: "2018-07-04 15:30-07".  Note in my example code below I append a -07 onto whatever value is put in the timecode field.  If you have users in multiple time zones you will need to keep track of this to make sure you deliver when they expect delivery.  Keep in mind Remindercall.com restricts calls and text messages to between 8:00 AM and 9:00 PM in your local timezone unless you get a special waiver from them.

Also important: The time must be within the last 8 hours.  If you put a time that is more than 8 hours in the past it will automatically fail for being 8 hours past target delivery time.  I recommend making your first few attempts be 5 minutes or so in the future so you can watch it appear on your Remindercall.com dashboard before delivery.*/
$delivery  = check_input($_POST['date']);

// Timestamp of appointment time associated with this message. Format: YYYY-MM-DD HH:MM
$appointment = check_input($_POST['appointment']);

/* Grouping is optional, but nice to have if you are looking at the Remindercall.com dashboard.  It is listed on the dash next to the name.  It basicly tells you how the data got to the system.  Otherwise you would be guessing if the call or text was a one-off input on the remindercall.com website.*/
$grouping  = check_input($_POST['group']);

/* Name is optional but highly recommended.  It can be a First, Last or "First Last". It is again going to make your experience viewing the dashboard more user-friendly*/
$name2 = check_input($_POST['name2']);

/* This is limited to 160 characters just like a normal SMS.  If you send more, it will get truncated to 160 anyways so you should do your math and send multiple messages if you go over 160.*/
$body = check_input($_POST['body']);


//Reminder Text
//This is what you pass to the Reminder Services API to send a text
// Replace what's between <key>YOUR_KEY_HERE</key> with your key to send a message.
//Optional fields that are blank cannot include field names
//Example: if $reference is blank you cannot pass <reference>'.$reference.'</reference>
	$msg3 = '<request>
  <key>'.$key.'</key> 
  <message action="create">
    <id>'.$id.'</id>
    <reference>'.$reference.'</reference>
    <numberto>'.$numberto.'</numberto>
    '.$numberfromField.'
    <delivery>'.$delivery.'-07</delivery>
    <body>'.$body.'</body>
    <name>'.$name2.'</name>
    '.$appointmentField.'
    <grouping>'.$grouping.'</grouping>
  </message>
</request>';


// Allows Numberfrom to be optional
if ($numberfrom = null) {
    $numberfromField = "";
}else {
    $numberfromField ='<numberfrom>'.$numberfrom.'</numberfrom>';
}

// Allows Appointments to be optional
if ($appointment = null) {
    $appointmentField = "";
}else {
    $appointmentField ='<appointment>'.$appointment.'</appointment>';
}

	echo "<br>";
	echo $msg3;
	echo "<br>";

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
  curl_setopt($curl, CURLOPT_POSTFIELDS, $msg3);
   
  // You can also bunch the above commands into an array if you choose using: curl_setopt_array
   
  // Send the request
  $result = curl_exec($curl);
  // Free up the resources $curl is using
  curl_close($curl);
  
  echo $result;

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