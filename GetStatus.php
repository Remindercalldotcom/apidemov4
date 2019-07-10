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

$key = check_input($_POST['key']);

/* This is the unique ID you provided for this message.  Use it to get the status and message responses. */

$UniqueIDcall  = check_input($_POST['UniqueIDcall']);

/* This is the unique ID you provided for this call.  Use it to get the status and call responses. */

$UniqueIDtext  = check_input($_POST['UniqueIDtext']);

// Print your key value to the page.
echo $key;
echo "<br>";

// This means that you request the status for a text message.  For calls use <call> UniqueID </call>
$msg2 = '<request>
	<key>'.$key.'</key>
  <status>
    <call>'.$UniqueIDcall.'</call>
		<text>'.$UniqueIDtext.'</text>
	</status>
</request>';


// If there are no errors then continue

if ($anyErr == "") {
// There are NO errors
  $curl = curl_init();
  // You can also set the URL you want to communicate with by doing this:
  // $curl = curl_init('http://localhost/echoservice');
   
  // We POST the data
  curl_setopt($curl, CURLOPT_POST, 1);
  // Set the url path we want to call
  curl_setopt($curl, CURLOPT_URL, 'https://api.remindercall.net/v3.4/dispatch.xml');  
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
