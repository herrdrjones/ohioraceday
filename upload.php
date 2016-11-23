
<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
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
$DOB = array_search("DOB", $cNames);
$Age = array_search("Age", $cNames);
$Email = array_search("Email", $cNames);
$RaceName = array_search("Race Name", $cNames);
$BestDiv = array_search("Best Division (by chip time)", $cNames);
$DivPlace = array_search("Division Place (by chip time)", $cNames);
$FinishingTime = array_search("Finishing Time", $cNames);
$RaceStart = array_search("Race Start Date/Time", $cNames);
$PacePerMile = array_search("Pace per mile (by chip time)", $cNames);

echo "<table>";
for ($row = 1; $row < $rows - 1; $row++) {  
    echo "<tr><td>".$array[$row][$BibNo]."</td>";
    echo "<td>".$array[$row][$LastName].", ".$array[$row][$FirstName]."</td>";
    echo "<td>".$array[$row][$DOB]."</td>";
    echo "<td>".$array[$row][$FinishingTime]."</td></tr>";
  }
echo "</table>";

$dbUserName = "root";
$dbServer = "localhost";
$dbName = "ohioraceday";
//Check to see if results already exist
$connection = new mysqli($dbServer, $dbUserName, "", $dbName);
$query = "SELECT RaceName from RaceResults where RaceName='".str_replace("'", "''", $array[1][$RaceName])."';";
$results = $connection->query($query);
//If results exist, delete all rows in the DB
if($results->num_rows>0)
{
    $query = "DELETE from RaceResults where RaceName='".str_replace("'", "''", $array[1][$RaceName])."';";
    $connection->query($query);
    echo "Results Deleted";
}
$connection->close();

$connection = new mysqli($dbServer, $dbUserName, "", $dbName);

for ($row = 1; $row < $rows; $row++) {  
    if($array[$row][$FinishingTime] != "") {
    $BirthDate = explode("/", $array[$row][$DOB]);
    $RaceDate = explode(" ", $array[$row][$RaceStart]);
    $RaceDate2 = explode("/", $RaceDate[0]);
    $query = "Insert into RaceResults (BibNo, LastName, FirstName, Sex, DOB, Age, Email, RaceName, BestDiv, DivPlace, FinishingTime, RaceStart, PacePerMile) VALUES ";
    $query .= "(".$array[$row][$BibNo].", ";
    $query .= "'".$array[$row][$LastName]."', '";
    $query .=$array[$row][$FirstName]."', '";
    $query .=$array[$row][$Sex]."','";
    $query .=$BirthDate[2]."-".$BirthDate[0]."-".$BirthDate[1]."', '";
    $query .=$array[$row][$Age]."','";
    $query .=$array[$row][$Email]."','";
    $query .= str_replace("'", "''", $array[$row][$RaceName])."','";
    $query .=$array[$row][$BestDiv]."','";
    $query .=$array[$row][$DivPlace]."','";
    $query .=$array[$row][$FinishingTime]."','";
    $query .=$RaceDate2[2]."-".$RaceDate2[0]."-".$RaceDate2[1]."','";
    $query .=$array[$row][$PacePerMile]."')";
    //echo strtotime($array[$row][$RaceStart]);
    //echo strtotime("2009-01-10 18:38:02");
    //$mysqltime = date("Y-m-d H:i", $array[$row][$RaceTime]);
    //echo $mysqltime;
    //echo $query;
    //echo "\n";
    $connection->query($query);
    }
  }    $connection->close();
?>


