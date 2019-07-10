<!DOCTYPE HTML>
<html>
<body>
<!--
Author: Spencer Halmos 
Updated:6/29/2018
This example is the interface page to start using the Remindercall.com API.  Please note I have not added any error trapping here, so use at your own risk.
-->
<!-- Company Name -->
<title>API Demo v4</title>
<b>Request sample code by calling the office at 888-858-6673</b>

<!-- Retreiving your API key from ReminderCall.com -->
<h2>Get Your API Key!</h2>
<form action="GetKey.php" method="post">
<!-- ReminderCall account username -->
<input type="text" name="name" placeholder="UserName" /><br>
<!-- ReminderCall account password -->
<input type="password" name="pwd" placeholder="PWD" /><br>
<!-- If you entered the information correctly, then you should receive a long series of 
numbers and letters as your key. -->
<input type="submit" value="Get That Key!">
</form>

<!-- Text Message Setup -->
<h2>Text Info</h2>
<form action="Textv4.php" method="post">
<!-- API Key -->
<input type="text" name="key" placeholder="API Key"/><br>
<!-- First Name -->
<input type="text" name="name2" placeholder="First and Last Name"/>(Optional)<br>
<!-- Randomized ID -->
<input type="text" name="ID" placeholder="ID"/><br>
<!-- Reference -->
<input type="text" name="reference" placeholder="Reference"/><br>
<!-- Date and Time you want text -->
<input type="text" name="date" placeholder="Delivery Date/Time"/>Format:YYYY-MM-DD HH:MM"<br>
<!-- Timestamp of appointment time associated with this message. -->
<input type="text" name="appointment" placeholder="Timestamp of appointment"/>(Optional)<br>
<!-- Phone Number you want to send to -->
<input type="text" name="numberto" placeholder="Phone Number Received"/>10 digits ONLY<br>
<!-- Phone Number you want to be sent from -->
<input type="text" name="numberfrom" placeholder="Phone Number Sent"/>10 digits ONLY (Optional)<br>
<!-- Grouping -->
<input type="text" name="group" placeholder="Grouping"/>(Optional)<br>
<!-- Message -->
<textarea name="body" placeholder="Message" rows="5" cols="40"/></textarea><br>
<!-- Submit Button -->
<input type="submit" value="Submit">
</form>

<!-- Phone Call Setup -->
<h2>Call Info</h2>
<form action="Call.php" method="post">
<!-- API Key -->
<input type="text" name="key2" placeholder="API Key"><br>
<!-- First Name -->
<input type="text" name="name3" placeholder="First and Last Name">(Optional)<br>
<!-- Randomized ID -->
<input type="text" name="ID2" placeholder="ID"><br>
<!-- Date and Time you want call -->
<input type="text" name="date2" placeholder="Delivery Date/Time">Format:YYYY-MM-DD HH:MM<br>
<!-- Phone Number -->
<input type="text" name="phone2" placeholder="Phone Number (10 digits)"><br>
<!-- CallerID -->
<input type="text" name="callerid" placeholder="CallerID"><br>
<!-- Prioritiy 0-2 -->
<input type="text" name="Priority" placeholder="Priority">(Optional)<br>
<!-- Retries 0-3 -->
<input type="text" name ="retries" placeholder="Retries">0-3<br>
<!-- Grouping -->
<input type="text" name="group2" placeholder="Grouping">(Optional)<br>
<!-- Preamble -->
<input type="text" name="preamble" placeholder="Preamble">(Optional)<br>
<!-- Protoscript -->
<input type="text" name="postscript" placeholder="Postscript">(Optional)<br>
<!-- Message -->
<textarea name="message2" placeholder="Message" rows="5" cols="40"></textarea><br>
<!-- Submit Button -->
<input type="submit" value="Submit">
</form>


<!-- Email Setup -->
<h2>Email Info</h2>
<form action="Email.php" method="post">
<!-- API Key -->
<input type="text" name="key3" placeholder="Key"><br>
<!-- Randomized ID -->
<input type="text" name="ID3" placeholder="ID"><br>
<!-- Date and Time you want Email -->
<input type="text" name="date3" placeholder="Delivery Date/Time">Format:YYYY-MM-DD HH:MM<br>
<!-- Name of the receiver -->
<input type="text" name="nameto" placeholder="Name To">(Optional)<br>
<!-- Name of the sender -->
<input type="text" name="from" placeholder="Name From">(Optional)<br>
<!-- Email Address -->
<input type="text" name="email" placeholder="Email To">Example@example.com<br>
<!-- Subject Name -->
<input type="text" name="subject" placeholder="Subject"><br>
<!-- Event Name -->
<input type="text" name ="event" placeholder="Event">(Optional)<br>
<!-- Append -->
<input type="text" name="append" placeholder="Append">(Optional)<br>
<!-- Confirm -->
<input type="text" name="confirm" placeholder="Confirm">(Optional)<br>
<!-- Template[id] -->
<input type="text" name="template" placeholder="Template">(Optional For Now)<br>
<!-- My Name Field -->
<input type="text" name="myname" placeholder="My Name Field">(Optional)<br>
<!-- My Address Field -->
<input type="text" name="myaddress" placeholder="My Address Field">(Optional)<br>
<!-- My Phone Field -->
<input type="text" name="myphone" placeholder="My Phone Field">(Optional)<br>
<!-- Submit Button -->
<input type="submit" value="Submit">
</form>


<!-- Get the Status of a text message -->
<h2>Get Status</h2>
<form action="GetStatus.php" method="post">
<!-- API Key -->
<input type="text" name="key" placeholder="API Key"/><br>
<!-- UniqueID For text -->
<input type="text" name="UniqueIDtext" placeholder="Text ID" />Enter YOUR unique id from a text message.<br>
<!-- UniqueID For call -->
<input type="text" name="UniqueIDcall" placeholder="Call ID" />Enter YOUR unique id from a voice call.<br>
<!-- If you entered the information correctly, then you should receive the message status on the next page. -->
<input type="submit" value="Get The Status">
</form>

</body>
</html>
