<?php
$dbUserName = "root";
$dbServer = "localhost";
$dbName = "ohioraceday";
//Get list of races
$connection = new mysqli($dbServer, $dbUserName, "", $dbName);
    $query = "select distinct RaceName from raceresults order by RaceStart;";
$results = $connection->query($query);
if($results->num_rows > 0)
{
    echo "<table>";
    while($singleRow = $results->fetch_assoc())
    {
        //echo "<tr><td>".$singleRow["RaceName"]."</td></tr>";
        echo '<tr><td> <a href="/ohioraceday/DisplayResults.php?race='.$singleRow["RaceName"].'">'.$singleRow["RaceName"].'</a> </td></tr>';
    }
    echo "</table>";
}
?>


