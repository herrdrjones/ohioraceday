<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add A New Race</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="CSS/ORD.css" rel="stylesheet" type="text/css"/>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
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
                            <li class="nav active"><a href="NewRace.php">New Race</a></li>
                        </ul>
                    </div>        
                </div>
            </header>   
        </div>
     <form action="add.php" method="post" enctype="multipart/form-data">
     <div class="col-md-3">
         <table class="table">
             
             <tr><td class="pull-right" style="border-top:none;">
                     Race Name:</td><td style="border-top:none;"><input type="text" name="rname">
                 </td></tr>
             <tr><td class="pull-right" style="border-top:none;">
         Date: </td><td style="border-top:none;"><input type="text" id="datepicker" name="rdate"></p>
                 </td>
                 <td style="border-top:none;"><input type="submit" value="Add" name="add"></td></tr>
         </table>
</form>
     </div> 

 

    <?php


?>
 </body>
</html>

