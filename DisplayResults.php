<?php
$race = $_GET['race'];
echo $race;
echo "<br/>";

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

$sql = "SELECT OverallPlace, BibNo, FirstName, LastName, Sex, Age, FinishingTime, PacePerMile FROM raceresults where RaceName = '".str_replace("'", "''", $race)."' order by OverallPlace;";
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

$sql = "SELECT DISTINCT BestDiv FROM raceresults where RaceName = '".str_replace("'", "''", $race)."' AND BestDiv LIKE 'Overall%' order by BestDiv;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc())
    {
        $DivQuery = "SELECT DivPlace, BibNo, FirstName, LastName, FinishingTime FROM raceresults where RaceName = '".str_replace("'", "''", $race)."' and BestDiv ='".$row["BestDiv"]."' ORDER BY DivPlace";
    
        $result2 = $conn->query($DivQuery);
        if($result2->num_rows >0)
        {
            echo $row["BestDiv"]."<br/>";
            echo "<table><tr><td>Division Place</td><td>Bib #</td><td>Name</td><td>Time</td></tr>";
        
            while($row2 = $result2->fetch_assoc()) {
        echo "<tr><td>".$row2["DivPlace"]."</td><td>".$row2["BibNo"]."</td><td>".$row2["FirstName"]." ".$row2["LastName"].'</td><td align="right">'.$row2["FinishingTime"]."</td></tr>";
        //echo "Bib #: " .$row["BibNo"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]." ".$row["FinishingTime"]. "<br>";
    }
    echo "</table>";
        }
    }
}

$sql = "SELECT DISTINCT BestDiv FROM raceresults where RaceName = '".str_replace("'", "''", $race)."' AND BestDiv NOT LIKE 'Overall%' order by BestDiv;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc())
    {
        $DivQuery = "SELECT DivPlace, BibNo, FirstName, LastName, FinishingTime FROM raceresults where RaceName = '".str_replace("'", "''", $race)."' and BestDiv ='".$row["BestDiv"]."' ORDER BY DivPlace";
    
        $result2 = $conn->query($DivQuery);
        if($result2->num_rows >0)
        {
            echo $row["BestDiv"]."<br/>";
            echo "<table><tr><td>Division Place</td><td>Bib #</td><td>Name</td><td>Time</td></tr>";
        
            while($row2 = $result2->fetch_assoc()) {
        echo "<tr><td>".$row2["DivPlace"]."</td><td>".$row2["BibNo"]."</td><td>".$row2["FirstName"]." ".$row2["LastName"].'</td><td align="right">'.$row2["FinishingTime"]."</td></tr>";
        //echo "Bib #: " .$row["BibNo"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]." ".$row["FinishingTime"]. "<br>";
    }
    echo "</table>";
        }
    }
}
$conn->close();
?>

