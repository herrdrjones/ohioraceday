<!DOCTYPE html>
<html>
    <head>
        <title>Confirm Delete</title>
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
                            <li class="nav"><a href="RaceOrder.php">Back</a></li>
                        </ul>
                    </div>        
                </div>
            </header> 
            <?php
            $db = parse_ini_file("config-file.ini");
            $dbUserName = $db['user'];
            $dbServer = $db['host'];
            $dbName = $db['name'];
            $dbPassword = $db['pass'];
            $RaceID = $_POST["RaceID"];
            $action = $_POST["edit"];
            if($action == "CSV"){
            
            //print_r($_POST);

            // Create connection
            $conn = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "select * from `raceday_ohioraceday`.`races` where RaceID =" . $RaceID . ";";
            $result = $conn->query($sql);

            $row = $result->fetch_assoc();
            echo "<div class='col-md-3 col-md-offset-1'>";
            echo "<h3>" . $row["RaceName"] . "</h3>";
            ?>
             <div class="col-md-6 col-md-offset-1">    
                <form action="uploadcsv.php" method="post" enctype="multipart/form-data">
                    <table class="table">
                        <tr><td class="text-right">Select csv to upload:</td>
                            <td><input type="file" name="fileToUpload" id="fileToUpload" accept=".csv, .pdf"></td>
                            <td><input type='hidden' name='RaceID' value='<?php echo $RaceID; ?>'/>
                                <input type="submit" value="Upload" name="edit"></td>
                    </table>
                </form>
            </div>  
            <?php
            }
            else{
                uploadcsv($dbServer, $dbUserName, $dbPassword, $dbName, $RaceID);
            }
            function uploadcsv($dbServer, $dbUserName, $dbPassword, $dbName, $RaceID){
                
            }
            ?>
        </div>
    </body>
</html>


