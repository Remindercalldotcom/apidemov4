# apidemov4
This is an updated version of the API Demo that uses our XML API to send reminders and get the status back for SMS and calls. Using the API is fairly easy. You can use the Webhook as a means of instant updates as an alternative to requesting message statuses one at a time.

The demo page lets you:
  1. Retrieve your key using your Remindercall.com username/password.
  2. Send texts.
  3. Send voice calls.
  4. Send Emails.
  5. Get the status of a texts or calls.
  6. Manage your purchased DID numbers.

The sample page of this is here: http://www.snapnotify.net/example/apidemov4.php

This example also demonstrates Number Management, which is used to manage your purchased phone numbers used to send text messages.  You can have any amount of purchased numbers which are used in the "number from" field of the text section.   Although you can only use one number at a time, you may choose to have a pool of numbers so you can deploy SMS more rapidly if you have a large volume to deliver, or you can spread the numbers out geographically so the SMS will originate in an area code near the recipients area code.  If you don't assign a "from number" and you have a pool of numbers, the API will pick a number at random from your pool.

The Numbers Management page lets you search for phone numbers available by area code, purchase phone numbers, release a number you may have already purchased and list the phone numbers that you own.

A working example page of this is here: http://www.snapnotify.net/example/numbermanagement.php

More information along with the Request and Response details are here: https://secure.remindercall.com/developers/api/xml/

Request sample code and more information by calling the office at 888-858-6673 or Email us at support@remindercall.com.

Happy Testing!
