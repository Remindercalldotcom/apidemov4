<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<title>Release</title>
<?php

/*
Author: Spencer Halmos 
Updated:6/24/2019
This example sends a text message using the Remindercall.com API.  Please note I have not added any error trapping here, so use at your own risk.*/
echo "<h2>Your Input:</h2>";

/* Your message would not be able to be sent without a $key field. */
$key = check_input($_POST['key']);

// This variable is set to be the Number that you entered on the Number Management page in the Release section.
$release = check_input($_POST['release']);

//Reminder Text
//This is what you pass to the Reminder Services API to send a text
// Replace what's between <key>YOUR_KEY_HERE</key> with your key to send a message.
	$msg3 = '<request>
  <key>'.$key.'</key>
  <numbers action="release">'.$release.'</numbers>
</request>';

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