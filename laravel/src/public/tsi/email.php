<?php
$pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

$emailcek = "sadasjkasd.@haskj@jlasdjlaks.com";
if (preg_match($pattern, $emailcek)) {
     echo "The email address '$emailcek' is valid.\n";
} else {
    echo "The email address '$emailcek' is invalid.\n";
}
print "<br>";

$emailArray = explode("@", "foo@yahoo.com");

if (checkdnsrr(array_pop($emailArray), "MX")) {
    print "valid email domain";
} else {
    print "invalid email domain";
}