<?php

include_once('../javascript/rest/Argon2.php');



var_dump(Argon2::generatePWD());

date_default_timezone_set('Europe/Paris');

$date = new DateTime();

var_dump(date_format($date,'y-m-d H:i:s'));



?>