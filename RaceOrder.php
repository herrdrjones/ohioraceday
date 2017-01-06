<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //var_dump($_POST);
    $RaceID = $_POST['RaceID'];
    $Sort = $_POST['Sort'];
    
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

    $sql = "update `raceday_ohioraceday`.`races` set SortOrder =".$Sort." where RaceID =".$RaceID.";";
    $conn->query($sql);
    $conn->close();
    
    loadTable();
}
else
{
    loadTable();
}
function loadTable()
{
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
        /*count the number of races on a date*/
        $sql = "select count(*) as count from `raceday_ohioraceday`.`races` where RaceStart = '".$row["RaceStart"]."';";
        $count = $conn->query($sql);
        $row2 = $count->fetch_assoc();
        $rowCount = $row2["count"];
        
        echo "<tr><form action='RaceOrder.php' method='post'><input type='hidden' name='RaceID' value='".$row["RaceID"]."'/><td>"
                .$row["RaceName"]."</td><td>".$row["RaceStart"]."</td><td>".$row["SortOrder"]
                ."</td>";
                if($rowCount > 1){
                echo "<td><select name='Sort'><option value=''>Select...</option>";
                for($i=1;$i<=$rowCount;)
                {
                    if($i == $row["SortOrder"])
                        echo "<option value='".$i."'selected='selected'>".$i."</option>";
                    else
                       echo "<option value='".$i."'>".$i."</option>"; 
                       $i = $i + 1;
                }
                
                echo "</select></td><td><input type='submit' value='Save' name='submit'></td></form>";
                }
                echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
}
?>




