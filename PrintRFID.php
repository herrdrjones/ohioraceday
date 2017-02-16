<!DOCTYPE html>
<html>
    <head>
        <title>Print RFID Tags</title>
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
                            <li class="nav"><a href="RaceOrder.php">Race Admin</a></li>
                            <li class="nav"><a href="ViewResults.php">Results</a></li>
                            <li class="nav"><a href="NewRace.php">New Race</a></li>
                            <li class="nav active"><a href="PrintRFID.php">Tags</a></li>
                        </ul>
                    </div>        
                </div>
            </header> 
            <div class="col-md-3">
                <form action="print.php" method="post">
                <table class="table">
                        <tr>
                            <td>Starting Bib #</td>
                            <td><input style="width:18%;text-align: center;" type="text" name="bibstart"></td>
                        </tr>
                        <tr>
                            <td>Ending Bib #</td>
                            <td><input style="width:18%;text-align: center;" type="text" name="bibstop"></td>
                        </tr>
                        <tr>
                            <td>Line 1</td>
                            <td><input style="width:90%;text-align: center;" type="text" name="line1" value="www.ohioraceday.com"></td>
                        </tr>
                        <tr>
                            <td>Line 2</td>
                            <td><input style="width:90%;text-align: center;" type="text" name="line2" value="DO NOT BEND OR REMOVE"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Generate" name="print"</td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php
                
            ?>

        </div>
    </body>
</html>

