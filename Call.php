<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
echo "<h2>Your Input:</h2>";

/*Author: Spencer Halmos 
Updated:6/29/2018
This example sends a voice call using the Remindercall.com API.  Please note I have not added any error trapping here, so use at your own risk. */

// we declare these variables
$nameErr = $emailErr = $genderErr = $messageErr = $groupingErr = $anyErr = "";
$msg4 = "";

/* Your message would not be able to be sent without a $key2 field. */
$key2 = check_input($_POST['key2']);

/* The caller id is the phone number of the reminder. The number must be 10 characters. You CANNOT have the caller id be the same as the reciever or else it will go to voicemail. You CANNOT have the caller id the same as anyone you have saved on the reciever's phone, to prevent any confusion between who is calling. */
$callerid = check_input($_POST['callerid']);

/*The $id field is very important and it is required.  It must be a unique ID that you keep track of within your own system.  You cannot have two ID's that are identical or you will get an error returned.

As an example: If you are trying to send reminders from a calendar, use the appointment ID which would be unique to each appointment.  This way you can use this ID value later to check on the status of the outgoing message.

This ID value can be any string value up to 32 characters.  So a number like 55555555 is fine or even "A5-643J@!!" will work too.*/
$id2 = check_input($_POST['ID2']);

/* Delivery is when you want your message delivered with both date and time.  It's in the format of "YYYY-MM-DD HH:MM-TZ"  where the -TZ is your timezone offset.  Pacific right now is -07.  You will need to account for this.  If you are trying to send a message from Califrnia at 2:30 PM your value here will look like: "2018-07-04 15:30-07".  Note in my example code below I append a -07 onto whatever value is put in the timecode field.  If you have users in multiple time zones you will need to keep track of this to make sure you deliver when they expect delivery.  Keep in mind Remindercall.com restricts calls and text messages to between 8:00 AM and 9:00 PM in your local timezone unless you get a special waiver from them.

Also important: The time must be within the last 8 hours.  If you put a time that is more than 8 hours in the past it will automatically fail for being 8 hours past target delivery time.  I recommend making your first few attempts be 5 minutes or so in the future so you can watch it appear on your Remindercall.com dashboard before delivery.*/
$delivery2  = check_input($_POST['date2']);

/* The phone number is 10 digits only. Strip out all spaces, parenthesis, etc.  any other format than this will cause an error*/
$phone2 = check_input($_POST['phone2']);

/* Grouping is optional, but nice to have if you are looking at the Remindercall.com dashboard.  It is listed on the dash next to the name.  It basicly tells you how the data got to the system.  Otherwise you would be guessing if the call or text was a one-off input on the remindercall.com website.*/
$grouping2  = check_input($_POST['group2']);

/* Name is optional but highly recommended.  It can be a First, Last or "First Last". It is again going to make your experience viewing the dashboard more user-friendly*/
$name3 = check_input($_POST['name3']);

/*There is a limit to the length of this message, but I don't know what it is.  It's some crazy super long string that you will never hit.  Regardless..this is the content of the message you will be sending to generate Text To Speech (TTS).

Punctuation, Spelling, spacing between words all matter.  If you can't spell right or don't put a space between first and last names, the TTS will sound funny.*/
$message2  = check_input($_POST['message2']);
  
/*Priority: Valid values of 0, 1 or 2.  you can prioritize the order of your calls within your own group if you need to.  Rarely uses, I would leave this value as default*/
$priority = check_input($_POST['priority']);

/*Retries: the only valid values are 0 through 3.  This is the number of times a call will be tried if it fails the first time.  It will make a second attempt 60 minutes after the first attempt.  Default value is 3, so it will make a total of 4 calls if it hits a busy signal or does not connect.  Unless you have a reason to change this value, just leave it unset so it will make 3 retry attempts.*/
$retries = check_input($_POST['retries']);

/*This is a wav file you can play before the Text To Speech starts to play.  You have to record a file on the remindercall.com website and know it's name EXACTLY.  Capitalization and spacing matters.  It will look in the default folder for the user account associated with the key you are using.
So if you recorded a file on Remindercall.com and renamed it to "My File.wav" then you need to specify that exactly, otherwise it will skip over it. */
$preamble = check_input($_POST['preamble']);

/* Same as the preamble, but this is the wav file that plays AFTER your Text To Speech. The typical user may start off with a greeing in their own voice, then add some customized TTS content and finish off with "thank you, have a nice day" in your own voice again.

These are optional but make for a nice touch.*/
$postscript = check_input($_POST['postscript']);

// Reminder Call
// You request to create a call using your key.
	$msg4 = '<request>
  <key>'.$key2.'</key>
  <call action="create">
    <id>'.$id2.'</id>
    <callerid>'.$callerid.'</callerid>
    <delivery>'.$delivery2.'-07</delivery>
    <number>'.$phone2.'</number>
    <priority>'.$priority.'</priority>
    <grouping>'.$grouping2.'</grouping>
    <name>'.$name3.'</name>
    <retries>'.$retries.'</retries> 
    <preamble type="text">'.$preamble.'</preamble>
    <postscript type="id">'.$postscript.'</postscript>
    <message>'.$message2.'</message>
  </call>
</request>';

    echo "<br>";
    echo $msg4;
    echo "<br>";

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
  curl_setopt($curl, CURLOPT_POSTFIELDS, $msg4);
   
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