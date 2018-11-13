
### SENDING SMS USING GLOBE POCKET WIFI WITH PHP

## Requirements
- PHP
- Pocket wifi
- Load

## Example
```
<?php
include("Sms.php");

//host, username, and password of the pocket wifi
$sms = new Sms("192.168.8.1", "admin", "admin");


//number, message
$res = $sms->send("8080", "test");

```

## Note
This might not work on all device
in my case the device i use is "E5330Bs-2"


