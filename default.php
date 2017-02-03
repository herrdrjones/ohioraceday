<?php ?>

<!DOCTYPE html>
<html>
    <head>
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
                        <button class="btn btn-success navbar-toggle" 
                                data-toggle="collapse"
                                data-target=".navbar-collapse"><span class="glyphicon glyphicon-chevron-down"></span></button>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="nav active"><a href=".">Upload Results</a></li>
                            <li class="nav"><a href="RaceOrder.php">Race Order</a></li>
                            <li class="nav"><a href="ViewResults.php">Results</a></li>
                        </ul>
                    </div>        
                </div>
            </header>  
            <div class="col-md-6 col-md-offset-1">    
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <table class="table">
                        <tr><td class="text-right"">Select csv to upload:</td>
                            <td><input type="file" name="fileToUpload" id="fileToUpload" accept=".csv, .pdf"></td>
                            <td><input type="submit" value="Upload" name="submit"></td>
                    </table>
                </form>
            </div>      
        </div>
    </body>

</html>


