<?php

$db = parse_ini_file("config-file.ini");
$dbUserName = $db['user'];
$dbServer = $db['host'];
$dbName = $db['name'];
$dbPassword = $db['pass'];
$RaceID = $_GET['raceid'];


deletePDF($dbUserName, $dbServer, $dbName, $dbPassword, $RaceID);
// Create connection
$conn = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "delete from `raceday_ohioraceday`.`races` where RaceID =" . $RaceID . ";";
$conn->query($sql);
$sql = "delete from `raceday_ohioraceday`.`raceresults` where RaceID =" . $RaceID . ";";
$conn->query($sql);
$conn->close();

header("Location: RaceOrder.php");



function deletePDF($dbUserName, $dbServer, $dbName, $dbPassword, $raceID) {
    // Create connection
    $conn = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * from `raceday_ohioraceday`.`races` where RaceID = " . $raceID;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    unlink($row["FileLocation"]);

    $sql = "UPDATE `raceday_ohioraceday`.`races` SET PDF = 0, FileLocation = '', PDFName = '' where RaceID =" . $raceID . ";";
    $conn->query($sql);
}
?>

