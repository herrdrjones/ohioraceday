<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="CSS/ORD.css" rel="stylesheet" type="text/css"/>
        <TITLE>Results</TITLE>
    </head>
    <body class="body">
        <div id="page">

            <header class="container">  
                <div id="menu" class="navbar navbar-default navbar-fixed-top">
                    <div class="navbar-header">
                        <button class="pull-left btn btn-success navbar-toggle" 
                                data-toggle="collapse"
                                data-target=".navbar-collapse"><span class="glyphicon glyphicon-chevron-down"></span></button>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="nav"><a href=".">Upload Results</a></li>
                            <li class="nav"><a href="RaceOrder.php">Race Admin</a></li>
                            <li class="nav active"><a href="ViewResults.php">Results</a></li>
                            <li class="nav"><a href="NewRace.php">New Race</a></li>
                        </ul>
                    </div>        
                </div>
            </header>  

<link href="CSS/ORD.css" rel="stylesheet" type="text/css"/>
<?php
$db = parse_ini_file("config-file.ini");
$dbUserName = $db['user'];
$dbServer = $db['host'];
$dbName = $db['name'];
$dbPassword = $db['pass'];
//Get list of races
$connection = new mysqli($dbServer, $dbUserName, $dbPassword);
    $query = "select `races`.`RaceName`, `races`.`RaceID`, `races`.`PDF`, `races`.`DBResults`, `races`.`FileLocation` FROM `raceday_ohioraceday`.`races`"
                ."order by left(RaceStart, 4) desc, RaceStart desc, SortOrder;";
$results = $connection->query($query);
if($results->num_rows > 0)
{
    echo "<table class='col-md-6 col-md-offset-1'>";
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
        if($singleRow["PDF"] == 0 && $singleRow["DBResults"] == 0)
        {
            echo '<tr><td>'.$singleRow["RaceName"].' (Coming Soon)';
        }
        if($singleRow["PDF"] == 1 && $singleRow["DBResults"] == 0)
        {
            echo '<tr><td> <a class="resultsLink" href="../'.$singleRow["FileLocation"].'">'.$singleRow["RaceName"].'</a>';
        }
        if($singleRow["DBResults"] == 1){
        echo '<tr><td> <a class="resultsLink" href="./DisplayResults.php?race='.$singleRow["RaceID"].'">'.$singleRow["RaceName"].'</a>';
        if($singleRow["PDF"] == 1){
            echo ' '.'<a class="resultsLink" href="../'.$singleRow["FileLocation"].'">[PDF]</a>';
        }        
        echo '</td></tr>';
        }
        
        $previousRow = substr($singleRow["RaceName"], 0, 8);
        
        //echo var_dump($previousRow);
    }
    echo "</table>";
}
else
    echo "Problem";
?>
        </div>
    </body>
</html>

