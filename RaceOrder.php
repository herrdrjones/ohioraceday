<?php
$dbUserName = "raceday_ohio";
$dbServer = "localhost";
$dbName = "raceday_ohioraceday";
$dbPassword = "dead2013frog";

// Create connection
$conn = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * FROM `raceday_ohioraceday`.`races` order by left(RaceStart, 4) desc, RaceStart, SortOrder;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo "<table><tr><td>Race</td><td>Race Date</td><td>Sort Order</td></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["RaceName"]."</td><td>".$row["RaceStart"]."</td><td>".$row["SortOrder"]."</td></tr>";
        //echo "Bib #: " .$row["BibNo"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]." ".$row["FinishingTime"]. "<br>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

?>

