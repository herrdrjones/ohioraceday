<TITLE>Search</TITLE>
<link href="CSS/ORD.css" rel="stylesheet" type="text/css"/>
<!DOCTYPE html>
<html>
<body>

<form action="search.php" method="post" enctype="multipart/form-data">
    Enter Search Name:
    <input type="text" name="first">
    <input type="text" name="last">
    <input type="submit" value="Search" name="submit">
</form>

</body>
</html>


<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $dbUserName = "raceday_ohio";
        $dbServer = "localhost";
        $dbName = "raceday_ohioraceday";
        $dbPassword = "dead2013frog";



        // Create connection
        $conn = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "select RaceName, LastName, FirstName from raceday_ohioraceday.raceresults where FirstName like '%".$_POST['first']."%' and LastName like '%"
                .$_POST['last']."%' order by RaceStart;";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
    // output data of each row
    echo "<table>";
    while($row = $result->fetch_assoc()) {

        //echo "<tr><td align='center'>".$row["FirstName"]."</td><td>".$row["LastName"]."</td><td>".$row["RaceName"]."</td></tr>";
        echo '<tr><td> <a class="resultsLink" href="./ResultsDetails.php?race='.$row["RaceName"].'&first='.$row["FirstName"].'&last='.$row["LastName"].'">'
                .$row["LastName"].", ".$row["FirstName"]." - ".$row["RaceName"].'</a> </td></tr>';
        //echo "Bib #: " .$row["BibNo"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]." ".$row["FinishingTime"]. "<br>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
    }
?>
