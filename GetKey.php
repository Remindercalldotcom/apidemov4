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

echo "<h2>The Output:</h2>";

/* This is the username you use to login to the Remindercall website. It will be used to retrieve your API Key. */

$name = check_input($_POST['name']);

/* This is the password you use to login to the Remindercal website. Like the username, it is also used to retrieve your API Key. */

$pwd  = check_input($_POST['pwd']);

// Print your username on the page.
echo $name;
echo "<br>";

// This means that you request the key when you enter your username and password
$msg2 = '<request>
	<key action="get">
		<username>'.$name.'</username>
		<password>'.$pwd.'</password>
	</key>
</request>';


// If there are no errors then continue

if ($anyErr == "") {
// There are NO err
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
  
  echo "Your key is: ";
  // print the key on the page
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
