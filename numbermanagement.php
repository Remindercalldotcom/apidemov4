<!DOCTYPE HTML>
<html>
<body>
<!--
Author: Spencer Halmos 
Updated:6/24/2019
This example is the interface page to start using the Remindercall.com API.  Please note I have not added any error trapping here, so use at your own risk.
-->
<!-- Page Name -->
<title>Numbers Management</title>
<b>Request sample code by calling the office at 888-858-6673</b>

<!-- Retreiving your API key from ReminderCall.com -->
<h2>Get Your API Key!</h2>
<form action="GetKey.php" method="post">
<!-- ReminderCall account username -->
<input type="text" name="name" placeholder="UserName" /><br>
<!-- ReminderCall account password -->
<input type="password" name="pwd" placeholder="PWD" /><br>
<!-- If you entered the information correctly, then you should receive a long series of numbers and letters as your key. -->
<input type="submit" value="Get That Key!">
</form>

<!-- Number Search Setup -->
<h2>Number Search</h2>
<form action="numbersearch.php" method="post">
<!-- API Key -->
<input type="text" name="key" placeholder="API Key"/><br>
<!-- Enter Area Code -->
<input type="text" name="numbers" placeholder="Area Code" />First 3 Numbers.<br>
<!-- Submit Button -->
<input type="submit" value="Search">
</form>

<!-- Number Purchase Setup -->
<h2>Number Purchase</h2>
<form action="numberpurchase.php" method="post">
<!-- API Key -->
<input type="text" name="key" placeholder="API Key"/><br>
<!-- Purchase Number -->
<input type="text" name="purchase" placeholder="ID" />Enter the ID. Do Not enter the number.<br>
<!-- Submit Button -->
<input type="submit" value="Purchase">
</form>

<!-- Number Release Setup -->
<h2>Number Release</h2>
<p>Used to remove a number you have purchased from your Number List.</p>
<form action="numberrelease.php" method="post">
<!-- API Key -->
<input type="text" name="key" placeholder="API Key"/><br>
 <!-- Number Release -->
<input type="text" name="release" placeholder="Number" />Number you would like to release<br>
<!-- Submit Button -->
<input type="submit" value="Release">
</form>

<!-- List of your purchased numbers setup -->
<h2>Number List</h2>
<form action="numberlist.php" method="post">
<!-- API Key -->
<input type="text" name="key" placeholder="API Key"/><br>
<!-- Submit Button -->
<input type="submit" value="List">
</form>

</body>
</html>
