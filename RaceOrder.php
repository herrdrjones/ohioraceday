<!DOCTYPE html>
<html>
    <head>
        <title>Race Admin</title>
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
                            <li class="nav"><a href=".">Upload Results</a></li>
                            <li class="nav active"><a href="RaceOrder.php">Race Admin</a></li>
                            <li class="nav"><a href="ViewResults.php">Results</a></li>
                            <li class="nav"><a href="NewRace.php">New Race</a></li>
                        </ul>
                    </div>        
                </div>
            </header>  
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['delete'])) {
                    deleteRace();
                } else {
                    if (isset($_POST['Sort'])) {
                        updateSort();
                    }
                }
            } else {
                loadTable();
            }

            function loadTable() {
                $db = parse_ini_file("config-file.ini");
                $dbUserName = $db['user'];
                $dbServer = $db['host'];
                $dbName = $db['name'];
                $dbPassword = $db['pass'];

// Create connection
                $conn = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
// Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "select * FROM `raceday_ohioraceday`.`races` order by left(RaceStart, 4) desc, RaceStart desc, SortOrder;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    echo "<div class='col-md-10 col-md-offset-1'>";
                    echo "<table class='table table-striped'><thead><tr><th>Race</th><th>Race Date</th><th>Sort Order</th>";
                    echo "<th></th><th></th><th></th><th>PDF File Name</th></tr></thead>";
                    while ($row = $result->fetch_assoc()) {
                        /* count the number of races on a date */
                        $sql = "select count(*) as count from `raceday_ohioraceday`.`races` where RaceStart = '" . $row["RaceStart"] . "';";
                        $count = $conn->query($sql);
                        $row2 = $count->fetch_assoc();
                        $rowCount = $row2["count"];

                        echo "<tr><form action='RaceOrder.php' method='post'><input type='hidden' name='RaceID' value='" . $row["RaceID"] . "'/><td>"
                        . $row["RaceName"] . "</td><td>" . date('m/d/Y', strtotime($row["RaceStart"])) . "</td><td>" . $row["SortOrder"]
                        . "</td>";
                        if ($rowCount > 1) {
                            echo "<td><select style='width:40px;' name='Sort'><option value=''>Select...</option>";
                            for ($i = 1; $i <= $rowCount;) {
                                if ($i == $row["SortOrder"])
                                    echo "<option value='" . $i . "'selected='selected'>" . $i . "</option>";
                                else
                                    echo "<option value='" . $i . "'>" . $i . "</option>";
                                $i = $i + 1;
                            }

                            echo "</select></td><td><input class='btn-xs btn-info' type='submit' value='Save' name='submit'></td>";
                        }
                        else {
                            echo"<td></td><td></td>";
                        }
                        echo "</form>";
                        echo '<td><a class="btn-sm btn-danger" href="cfmdelete.php?raceid=' . $row["RaceID"] . '">Delete</a></td>';
                        if ($row["PDF"] == 1) {
                            echo "<td>" . $row["PDFName"] . "</td>";
                        } else {
                            echo "<td></td>";
                        }
                        echo "<form action='uploadpdf.php' method='post'><input type='hidden' name='RaceID' value='" . $row["RaceID"] . "'/>";
                        echo "<td><input class='btn-xs btn-primary' type='submit' value='PDF' name='edit'></td>";
                        echo "</form><form action='uploadcsv.php' method='post'><input type='hidden' name='RaceID' value='" . $row["RaceID"] . "'/>";
                        echo "<td><input class='btn-xs btn-primary' type='submit' value='CSV' name='edit'></td>";
                        echo "</form>";
                        echo "</tr>";
                    }
                    echo "</table></div>";
                } else {
                    echo "0 results";
                }
                $conn->close();
            }

            function updateSort() {
                $RaceID = $_POST['RaceID'];
                $Sort = $_POST['Sort'];

                $db = parse_ini_file("config-file.ini");
                $dbUserName = $db['user'];
                $dbServer = $db['host'];
                $dbName = $db['name'];
                $dbPassword = $db['pass'];
                // Create connection
                $conn = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "update `raceday_ohioraceday`.`races` set SortOrder =" . $Sort . " where RaceID =" . $RaceID . ";";
                $conn->query($sql);
                $conn->close();

                loadTable();
            }

            function deleteRace() {
                $RaceID = $_POST['RaceID'];
                echo $RaceID;
                $db = parse_ini_file("config-file.ini");
                $dbUserName = $db['user'];
                $dbServer = $db['host'];
                $dbName = $db['name'];
                $dbPassword = $db['pass'];
                // Create connection
                $conn = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "delete from `raceday_ohioraceday`.`races` where RaceID =" . $RaceID . ";";
                $conn->query($sql);
                $sql = "delete from `raceday_ohioraceday`.`raceresults` where RaceID =" . $RaceID . ";";
                $conn->query($sql);
                $conn->close();

                loadTable();
            }
            ?>
        </div>
    </body>
</html>



