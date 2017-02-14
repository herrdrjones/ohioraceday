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
            $RaceID = $_GET['raceid'];

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
            echo "<h3>".$row["RaceName"]."</h3>";
            echo "<hr/>";
            echo "<div class='alert alert-danger'>";
            echo "<strong>Warning!</strong> This will delete all results from this race</div>";
            echo "<a class='btn-lg btn-primary' href='deleterace.php?raceid=".$RaceID."'>Confirm Delete</a>";
            echo "&nbsp;&nbsp;&nbsp;";
            echo "<a class='btn-lg btn-primary' href='RaceOrder.php'>Cancel</a>";
            echo "</div>";
            ?>

        </div>
    </body>
</html>
