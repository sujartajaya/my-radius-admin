# Build image
$ docker buildx build -t my-radius-image-01 -f Dockerfile .

# Run images
docker run --rm -d --name my-radius-01 -p 1812-1813:1812-1813/udp my-radius-image-01

echo User-Name=dwimita3490@gmail.com,Framed-IP-Address=10.10.10.253 | radclient -x 172.16.0.12:3799 disconnect rahasia

//function to force disconnect a user
	function disconnect_user($username, $framed_ip, $nasaddr, $coaport, $sharedsecret) {
		$command = "sudo echo User-Name=$username,Framed-IP=$framed_ip|/usr/local/bin/radclient -x $nasaddr:$coaport disconnect $sharedsecret";
		exec($command);
	}

        //function to force disconnect all users
	function disconnect_all_users(){
		$sharedsecret = "yourradiussecret";
		$coaport = 1700;
		$nasaddr = "192.168.20.1";
		$r_who_online = "SELECT * FROM radacct WHERE (AcctStopTime is NULL) ORDER BY RadAcctId ASC";
		$who_online = $db->Execute($r_who_online);
		foreach($who_online as $u) {
			$command = "sudo echo User-Name=$u["UserName"],Framed-IP-Address=$u["Framed-IP"]|/usr/local/bin/radclient -x $nasaddr:$coaport disconnect $sharedsecret";
                        exec($command);
		}
	}

<!DOCTYPE html>
<html>
<body>

<?php
echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l") .  "<br>";

date_default_timezone_set("Asia/Makassar");
echo "Today is " . date("d M Y H:i:s") . "<br>";
$jam = date("d M Y H:i:s");

$date   = new DateTime(); //this returns the current date time
$result = $date->format('Y-m-d H:i:s');
echo $result . "<br>";
$waktu = $date->modify("+60 minutes"); // penambahan 60menit

$newtimestamp = strtotime('+60 minutes', strtotime($result));

echo date('Y-m-d H:i:s', $newtimestamp)."<br>";
$data = $waktu->format('Y-m-d H:i:s');
echo $data .  " terakhir<br>";
?>

</body>
</html>
