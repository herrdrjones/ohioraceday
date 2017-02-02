<TITLE>Results</TITLE>
<link href="CSS/ORD.css" rel="stylesheet" type="text/css"/>
<?php
$dbUserName = "raceday_ohio";
$dbServer = "localhost";
$dbName = "raceday_ohioraceday";
$dbPassword = "dead2013frog";
//Get list of races
$connection = new mysqli($dbServer, $dbUserName, $dbPassword);
    $query = "select `races`.`RaceName`, `races`.`RaceID` FROM `raceday_ohioraceday`.`races` order by left(RaceStart, 4) desc, RaceStart desc, SortOrder;";
$results = $connection->query($query);
if($results->num_rows > 0)
{
    echo "<table>";
    $previousRow = "none";
    while($singleRow = $results->fetch_assoc())
    {
        
        //echo "<tr><td>".$singleRow["RaceName"]."</td></tr>";
        if(substr($singleRow["RaceName"], 0, 8) == $previousRow){
            //echo "<tr><td><hr/></td></tr>";    
        }
        else{
            echo "<tr><td></td></tr>";
            echo "<tr><td></td></tr>";
        }
        echo '<tr><td> <a class="resultsLink" href="./StyleTest.php?race='.$singleRow["RaceID"].'">'.$singleRow["RaceName"].'</a> </td></tr>';
        
        $previousRow = substr($singleRow["RaceName"], 0, 8);
        
        //echo var_dump($previousRow);
    }
    echo "</table>";
}
else
    echo "Problem";
?>


