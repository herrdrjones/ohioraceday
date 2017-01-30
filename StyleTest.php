<!DOCTYPE html>
<html lang="en">
<head>
  <title>Results Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<?php
$race = 10;


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

$sql = "SELECT * from `raceday_ohioraceday`.`races` where RaceID = ".$race;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo "<div class='col-md-6 col-md-offset-3'>";
echo "<H2>".$row["RaceName"]."</H2>";
echo "</div><br/>";


$sql = "SELECT OverallPlace, BibNo, FirstName, LastName, Sex, AthleteType, Age, FinishingTime, PacePerMile FROM raceresults where RaceID = ".$race." order by OverallPlace;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo "<div class='col-md-6 col-md-offset-3'>";
    echo "<H3>Overall</H3><br/>";
    echo "<table class='table table-striped'><thead><tr><th>Place</th><th>Bib #</th><th>Name</th><th>Time</th><th>Pace</th><th>Type</th><th>Age(Sex)</th></tr></thead>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["OverallPlace"]."</td><td>".$row["BibNo"]."</td><td>".$row["LastName"].", ".$row["FirstName"]."</td><td>".$row["FinishingTime"]."</td><td>".$row["PacePerMile"]."</td><td>".$row["AthleteType"]."</td><td>".$row["Age"]." (".substr($row["Sex"], 0, 1).")</td></tr>";
        //echo "Bib #: " .$row["BibNo"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]." ".$row["FinishingTime"]. "<br>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "0 results";
}

$sql = "SELECT DISTINCT BestDiv FROM raceresults where RaceID = ".$race." AND BestDiv LIKE 'Overall%' order by BestDiv;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc())
    {
        $DivQuery = "SELECT DivPlace, BibNo, FirstName, LastName, FinishingTime FROM raceresults where RaceID = ".$race." and BestDiv ='".$row["BestDiv"]."' ORDER BY DivPlace";
    
        $result2 = $conn->query($DivQuery);
        echo "<div class='col-md-4 col-md-offset-1'>";
        if($result2->num_rows >0)
        {
            echo "<H3>".$row["BestDiv"]."</H3><br/>";
            echo "<table class='table table-striped'><thead><tr><th>Division Place</th><th>Bib #</th><th>Name</th><th>Time</th></tr></thead>";
        
            while($row2 = $result2->fetch_assoc()) {
        echo "<tr><td>".$row2["DivPlace"]."</td><td>".$row2["BibNo"]."</td><td>".$row2["LastName"].", ".$row2["FirstName"].'</td><td>'.$row2["FinishingTime"]."</td></tr>";
        //echo "Bib #: " .$row["BibNo"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]." ".$row["FinishingTime"]. "<br>";
    }
    echo "</table>";
        }
        echo "</div>";
    }
}

$sql = "SELECT DISTINCT BestDiv FROM raceresults where RaceID = ".$race." AND BestDiv NOT LIKE 'Overall%' AND BestDiv LIKE '%Master%' order by BestDiv DESC;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc())
    {
        $DivQuery = "SELECT DivPlace, BibNo, FirstName, LastName, FinishingTime FROM raceresults where RaceID = ".$race." and BestDiv ='".$row["BestDiv"]."' ORDER BY DivPlace";
    
        $result2 = $conn->query($DivQuery);
        echo "<div class='col-md-4 col-md-offset-1'>";
        if($result2->num_rows >0)
        {
            echo "<H3>".$row["BestDiv"]."</H3><br/>";
            echo "<table class='table table-striped'><thead><tr><th>Division Place</th><th>Bib #</th><th>Name</th><th>Time</th></tr></thead>";
        
            while($row2 = $result2->fetch_assoc()) {
        echo "<tr><td>".$row2["DivPlace"]."</td><td>".$row2["BibNo"]."</td><td>".$row2["LastName"].", ".$row2["FirstName"].'</td><td>'.$row2["FinishingTime"]."</td></tr>";
        //echo "Bib #: " .$row["BibNo"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]." ".$row["FinishingTime"]. "<br>";
    }
    echo "</table>";
        }
        echo "</div>";
    }
}

$sql = "SELECT DISTINCT BestDiv FROM raceresults where RaceID = ".$race." AND BestDiv NOT LIKE 'Overall%' and BestDiv NOT LIKE '%Master%' order by BestDiv;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc())
    {
        $DivQuery = "SELECT DivPlace, BibNo, FirstName, LastName, FinishingTime FROM raceresults where RaceID = ".$race." and BestDiv ='".$row["BestDiv"]."' ORDER BY DivPlace";
    
        $result2 = $conn->query($DivQuery);
        echo "<div class='col-md-4 col-md-offset-1'>";
        if($result2->num_rows >0)
        {
            echo "<H3>".$row["BestDiv"]."</H3><br/>";
            echo "<table class='table table-striped'><thead><tr><th>Division Place</th><th>Bib #</th><th>Name</th><th>Time</th></tr></thead>";
        
            while($row2 = $result2->fetch_assoc()) {
        echo "<tr><td>".$row2["DivPlace"]."</td><td>".$row2["BibNo"]."</td><td>".$row2["LastName"].", ".$row2["FirstName"].'</td><td>'.$row2["FinishingTime"]."</td></tr>";
        //echo "Bib #: " .$row["BibNo"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]." ".$row["FinishingTime"]. "<br>";
    }
    echo "</table>";
        }
        echo "</div>";
    }
}
$conn->close();




?>