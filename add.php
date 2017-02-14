<?php

//print_r($_POST);

$db = parse_ini_file("config-file.ini");
$dbUserName = $db['user'];
$dbServer = $db['host'];
$dbName = $db['name'];
$dbPassword = $db['pass'];

$raceName = $_POST["rname"];
$raceDate = $_POST["rdate"];

$raceName = $raceName." - ".date('F j  Y', strtotime($raceDate));
//echo $raceName;
//echo date('Y-m-d',strtotime($raceDate));
// Create connection
$conn = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `raceday_ohioraceday`.`races` (RaceName, RaceStart) VALUES ('".str_replace("'", "''", $raceName)."','".date('Y-m-d',strtotime($raceDate))."');";
$conn->query($sql);

header("Location: RaceOrder.php");
?>
