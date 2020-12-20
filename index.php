 <?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO analytics (ip, location, city) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $ip, $location, $city);


if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {
    $ipadd = $_SERVER['HTTP_CLIENT_IP'];
  }

elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
    $ipadd = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }

else
  {
    $ipadd = $_SERVER['REMOTE_ADDR'];
  }

$ipdat = @json_decode(file_get_contents( 
    "http://www.geoplugin.net/json.gp?ip=" . $ipadd)); 

$ip = $ipadd;
$location = $ipdat->geoplugin_countryName;
$city = $ipdat->geoplugin_city;
$stmt->execute();


$stmt->close();
$conn->close();

?> 


<?php

$mysqli = new mysqli("localhost", "", "", "");
if($mysqli->connect_error) {
  exit('Error connecting to database');
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset("utf8mb4");

$stmt = $mysqli->prepare("SELECT link FROM links WHERE id = ?");
$lin = '1';
$stmt->bind_param("s", $lin);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows === 0) exit('No rows');
$stmt->bind_result($link);
$stmt->fetch();
?>


<script type="text/javascript">
    var lasturl = "<?php echo $link; $stmt->close();?>";
    if(lasturl === ""){
        console.log('Option canceled');
    }
    else{
        window.location = lasturl;
    }
</script>
<script>(function(s,u,z,p){s.src=u,s.setAttribute('data-zone',z),s.setAttribute('class','clicker'),p.appendChild(s);})(document.createElement('script'),'https://iclickcdn.com/tag.min.js',3662116,document.body||document.documentElement)</script>

