<?php
$race = $_GET['race'];
$first = $_GET['first'];
$last = $_GET['last'];
echo $race;
echo "<br/>";
echo $last.", ".$first;

$db = parse_ini_file("config-file.ini");
$dbUserName = $db['user'];
$dbServer = $db['host'];
$dbName = $db['name'];
$dbPassword = $db['pass'];

// Create connection
$conn = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT OverallPlace, BibNo, FirstName, LastName, Sex, Age, FinishingTime, PacePerMile FROM raceresults where RaceName = '".str_replace("'", "''", $race)
        ."' and LastName = '".$last."' and FirstName ='".$first."';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo "<table><tr><td>Place</td><td>Bib #</td><td>Name</td><td>Age</td><td>Sex</td><td width='30%'>Time</td><td>Pace</td></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td align='center'>".$row["OverallPlace"]."</td><td>".$row["BibNo"]."</td><td>".$row["FirstName"]." ".$row["LastName"]."</td><td>".$row["Age"]."</td><td>".$row["Sex"]."</td><td>".$row["FinishingTime"]."</td><td>".$row["PacePerMile"]."</td></tr>";
        //echo "Bib #: " .$row["BibNo"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]." ".$row["FinishingTime"]. "<br>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>
