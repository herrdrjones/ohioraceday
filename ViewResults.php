<?php
$dbUserName = "raceday_ohio";
$dbServer = "localhost";
$dbName = "raceday_ohioraceday";
$dbPassword = "dead2013frog";
//Get list of races
$connection = new mysqli($dbServer, $dbUserName, $dbPassword);
    $query = "select distinct `raceresults`.`RaceName` FROM `raceday_ohioraceday`.`raceresults` order by RaceStart;";
$results = $connection->query($query);
if($results->num_rows > 0)
{
    echo "<table>";
    while($singleRow = $results->fetch_assoc())
    {
        //echo "<tr><td>".$singleRow["RaceName"]."</td></tr>";
        echo '<tr><td> <a href="/dev/DisplayResults.php?race='.$singleRow["RaceName"].'">'.$singleRow["RaceName"].'</a> </td></tr>';
    }
    echo "</table>";
}
else
    echo "Problem";
?>


