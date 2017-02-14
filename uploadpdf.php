<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="CSS/ORD.css" rel="stylesheet" type="text/css"/>
        <TITLE>Upload PDF</TITLE>
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
                            <li class="nav active"><a href="RaceOrder.php">Back</a></li>
                        </ul>
                    </div>        
                </div>
            </header>  

            <link href="CSS/ORD.css" rel="stylesheet" type="text/css"/>

            <?php
            $raceID = $_POST["RaceID"];
            $action = $_POST["edit"];

            $db = parse_ini_file("config-file.ini");
            $dbUserName = $db['user'];
            $dbServer = $db['host'];
            $dbName = $db['name'];
            $dbPassword = $db['pass'];

            if ($action == "PDF") {
                editPDF($dbUserName, $dbServer, $dbName, $dbPassword, $raceID);
            }
            if ($action == "Add") {
                addPDF($dbUserName, $dbServer, $dbName, $dbPassword, $raceID);
            }
            if ($action == "Delete") {
                deletePDF($dbUserName, $dbServer, $dbName, $dbPassword, $raceID);
            }

            function editPDF($dbUserName, $dbServer, $dbName, $dbPassword, $raceID) {
                // Create connection
                $conn = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
// Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * from `raceday_ohioraceday`.`races` where RaceID = " . $raceID;
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo "<div class='col-md-4'>";
                echo "<table class='table'><tr>";
                echo "<td>" . $row["RaceName"] . "</td>";
                if ($row["PDF"] != 0) {
                    echo "<td>" . $row["PDFName"] . "</td>";
                }
                echo "<form action='uploadpdf.php' method='post' enctype='multipart/form-data'><input type='hidden' name='RaceID' value='" . $row["RaceID"] . "'/>";
                if ($row["PDF"] == 0) {
                    echo '<td><input type="file" name="fileToUpload" id="fileToUpload" accept=".pdf"></td>';
                    echo "<td><input type='submit' value='Add' name='edit'></td>";
                } else {
                    echo "<td><input type='submit' value='Delete' name='edit'></td>";
                }
                echo "</tr></form></table></div>";
            }

            function addPDF($dbUserName, $dbServer, $dbName, $dbPassword, $raceID) {
                // Create connection
                $conn = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT left(`races`.`RaceStart`, 4) as Year FROM `raceday_ohioraceday`.`races` where RaceID =".$raceID;
                $results = $conn->query($sql);
                $row = $results->fetch_assoc();
               
                $target_dir = "../Results/".$row["Year"]."/";
                $target_file = $target_dir.$_FILES["fileToUpload"]["name"];
                if ($target_dir != $target_file) {
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                $target_file = $target_dir.$_FILES["fileToUpload"]["name"];
                                $query = "UPDATE `raceday_ohioraceday`.`races` SET PDF = 1, FileLocation = '".$target_file."', PDFName = '"
                                        .$_FILES["fileToUpload"]["name"]."' where RaceID =".$raceID.";";
                                $results = $conn->query($query);
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }
                editPDF($dbUserName, $dbServer, $dbName, $dbPassword, $raceID);
            }
            
            function deletePDF($dbUserName, $dbServer, $dbName, $dbPassword, $raceID){
                 // Create connection
                $conn = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * from `raceday_ohioraceday`.`races` where RaceID = ".$raceID;
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                unlink($row["FileLocation"]);
                
                $sql = "UPDATE `raceday_ohioraceday`.`races` SET PDF = 0, FileLocation = '', PDFName = '' where RaceID =".$raceID.";";
                $conn->query($sql);
                editPDF($dbUserName, $dbServer, $dbName, $dbPassword, $raceID);
            }
                ?>

