<!DOCTYPE html>
<html>
    <head>
        <title>Upload Results</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="CSS/ORD.css" rel="stylesheet" type="text/css"/>
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
                            <li class="nav"><a href=".">Back</a></li>
                            <li class="nav"><a href="RaceOrder.php">Race Order</a></li>
                            <li class="nav"><a href="ViewResults.php">Results</a></li>
                        </ul>
                    </div>        
                </div>
            </header>  
<?php
echo "<div class='col-md-6 col-md-offset-1'>";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if($target_dir != $target_file)
{
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
$array = array_map('str_getcsv', file($target_file));
$columns = count($array[0]);
$rows = count($array);

$columnNames = $array[0];
$cNames = array_map('trim', $columnNames);


$listColumns = "";
foreach($cNames as $column)
{
    $listColumns .= $column."\t";
}

$BibNo = array_search("Bib #", $cNames);
$LastName = array_search("Last Name", $cNames);
$FirstName = array_search("First Name", $cNames);
$Sex = array_search("Sex", $cNames);
$AthleteType = array_search("Athlete Type", $cNames);
$DOB = array_search("DOB", $cNames);
$Age = array_search("Age", $cNames);
$Email = array_search("Email", $cNames);
$RaceName = array_search("Race Name", $cNames);
$OverallPlace = array_search("Overall Place (by chip time)", $cNames);
$BestDiv = array_search("Best Division (by chip time)", $cNames);
$DivPlace = array_search("Division Place (by chip time)", $cNames);
$FinishingTime = array_search("Finishing Time", $cNames);
$RaceStart = array_search("Race Start Date/Time", $cNames);
$PacePerMile = array_search("Pace per mile (by chip time)", $cNames);
$RaceID = -1;
/*echo "<table>";
for ($row = 1; $row < $rows - 1; $row++) {  
    echo "<tr><td>".$array[$row][$BibNo]."</td>";
    echo "<td>".$array[$row][$LastName].", ".$array[$row][$FirstName]."</td>";
    echo "<td>".$array[$row][$DOB]."</td>";
    echo "<td>".$array[$row][$FinishingTime]."</td></tr>";
  }
echo "</table>";*/
if ($BibNo === 0)
{
$db = parse_ini_file("config-file.ini");
$dbUserName = $db['user'];
$dbServer = $db['server'];
$dbName = $db['name'];
$dbPassword = $db['pass'];
//Check to see if results already exist
$connection = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
$query = "SELECT * from `raceday_ohioraceday`.`races` where RaceName ='".str_replace("'", "''", $array[1][$RaceName])."';";
//$query = "SELECT `raceresults`.`RaceName` FROM `raceday_ohioraceday`.`raceresults` where RaceName ='".str_replace("'", "''", $array[1][$RaceName])."';";

$results = $connection->query($query);
//If results exist, delete all rows in the DB

if($results->num_rows>0)
{
    $row = $results->fetch_assoc();
    $RaceID = $row["RaceID"];
    $query = "DELETE FROM `raceresults` WHERE `RaceID` = ".$RaceID.";";
    if ($connection->query($query) === TRUE) {
    }   else {
    echo "Error: " . $query . "<br>" . $connection->error;
}
    echo "<br/>Previous Results Deleted";
}
else
{
    $nbrow = "";
    $rownumber = 0;
    while($nbrow == "")
    {
        $rownumber++;
        $nbrow = $array[$rownumber][$RaceStart];
    }
    $RaceDate = explode(" ", $array[$rownumber][$RaceStart]);
    $RaceDate2 = explode("/", $RaceDate[0]);
    $query = "INSERT INTO `races`(`RaceName`,`RaceStart`) VALUES ";
    $query .= "('".str_replace("'", "''", $array[1][$RaceName])."','";
    $query .=$RaceDate2[2]."-".$RaceDate2[0]."-".$RaceDate2[1]."')";
    if ($connection->query($query) === TRUE) {
    }   else {
    echo "Error: " . $query . "<br>" . $connection->error;
}
    $query = "SELECT RaceID from `raceday_ohioraceday`.`races` where RaceName ='".str_replace("'", "''", $array[1][$RaceName])."';";
    $results = $connection->query($query);
    $row = $results->fetch_assoc();
    $RaceID = $row["RaceID"];
}
$connection->close();

$connection = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
$rowCount = 0;
for ($row = 1; $row < $rows; $row++) {  
    if($array[$row][$FinishingTime] != "") {
    $BirthDate = explode("/", $array[$row][$DOB]);
    $query = "INSERT INTO `raceresults`(`BibNo`, `LastName`, `FirstName`, `Sex`, `DOB`, `Age`, `AthleteType`,`Email`, `RaceID`, `OverallPlace`,`BestDiv`, `DivPlace`, `FinishingTime`, `PacePerMile`) VALUES ";
    $query .= "(".$array[$row][$BibNo].", ";
    $query .= "'".str_replace("'", "''" ,$array[$row][$LastName])."', '";
    $query .=str_replace("'", "''", $array[$row][$FirstName])."', '";
    $query .=$array[$row][$Sex]."','";
    $query .=$BirthDate[2]."-".$BirthDate[0]."-".$BirthDate[1]."', '";
    $query .=$array[$row][$Age]."','";
    $query .=$array[$row][$AthleteType]."','";
    $query .=$array[$row][$Email]."',";
    $query .= $RaceID.",'";
    $query .=$array[$row][$OverallPlace]."','";
    $query .=$array[$row][$BestDiv]."','";
    $query .=$array[$row][$DivPlace]."','";
    $query .=$array[$row][$FinishingTime]."','";
    $query .=$array[$row][$PacePerMile]."')";
    //echo strtotime($array[$row][$RaceStart]);
    //echo strtotime("2009-01-10 18:38:02");
    //$mysqltime = date("Y-m-d H:i", $array[$row][$RaceTime]);
    //echo $mysqltime;
    if ($connection->query($query) === TRUE) {
        $rowCount++;
    }   else {
    echo "Error: " . $query . "<br>" . $connection->error;
}
    //echo $query;
    //echo "\n";
    //$connection->query($query);
    }
  }    $connection->close();
  echo "<br/>";
  if ($rowCount != 0){
      echo $rowCount." Finishers added to database.";
  }
  else{
      echo "No Finishers were found in file: ".basename( $_FILES["fileToUpload"]["name"]);
  }
  
}
 else {
    echo "Not a valid ART CSV file!";
 }
}
 else {
     echo "No file attached";
     echo "<br/>";
     //echo '<a href="./">Return</a>';
}
echo '</div>';
?>
        </body>
        </hmtl>

