# Build image
$ docker buildx build -t my-radius-image-01 -f Dockerfile .

# Run images
docker run --rm -d --name my-radius-01 -p 1812-1813:1812-1813/udp my-radius-image-01

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
