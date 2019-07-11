<?php
## In order for the webhook to work you need to contact Reminder Services, Inc and tell them what URL this php file is residing at.  They will make sure any responses for a specific user account gets sent there.
## The following line opens a log file to put inbound posts. "a" is for append to file
$fh = fopen("./log_sms.txt", "a");
## If there's an error (can't open above file to append to), exit this routine
if(false === $fh) exit("Error opening log file log_sms.txt\n");
## $post is the data that is returned via the webhook.
$post = file_get_contents('php://input');
## $_GET['type'] 
## TYPE: Tells you the response type.  It's either a status or message
## $_GET['id'] 
## ID: assigned by you
## Do something cool here with the data you are getting back.  In this case we just write it to a log file.
fwrite($fh, date('Y-m-d H:i:s').' '.$_SERVER['REQUEST_URI']."; POST: {$post}\n");

## example of what will be written to log file:
## 2018-08-01 11:35:43 /spencer/smswebhook.php?type=message&id=224; POST: This is my reply from phone
##
## Note in the response above you get a type=message and an id=224.  These are returned in the post.
fclose($fh);
echo "OK\n";
Echo $post;
?>