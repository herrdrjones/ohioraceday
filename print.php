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
                            <li class="nav"><a href="PrintRFID.php">Back</a></li>
                        </ul>
                    </div>        
                </div>
            </header> 
            <?php
            $bibstart = $_POST["bibstart"];
            $bibstop = $_POST["bibstop"];
            $line1 = $_POST["line1"];
            $line2 = $_POST["line2"];

            if (is_numeric($bibstart) && is_numeric($bibstop) && $bibstop >= $bibstart) {
                printTags($bibstart, $bibstop, $line1, $line2);
            } else {
                if(!is_numeric($bibstart) || !is_numeric($bibstop)){
                echo '<div class="col-md-3">';
                echo "<div class='alert alert-danger'>";
                echo "   <strong>Error!</strong> Starting and Ending bib numbers must be provided.</div>";
                }
                if($bibstop < $bibstart){
                     echo '<div class="col-md-3">';
                echo "<div class='alert alert-danger'>";
                echo "   <strong>Error!</strong> Starting bib number must be less than ending bib number.</div>"; 
                }
            }

            function printTags($bibstart, $bibstop, $line1, $line2) {
                $RFIDLabel = '${';
                $LabelNumber = $bibstart;
                //for($LabelNumber)
                for ($LabelNumber = $bibstart; $LabelNumber <= $bibstop + 1; $LabelNumber++) {
                    $RFIDLabel .= "\n^XA\n^RS8\n^FO25,135^A0N,65^FD";
                    if ($LabelNumber != $bibstart) {
                        //RFIDLabel += LabelNumber - 1 + "^FS\n^RFW,H^FD";
                        $RFIDLabel .= $LabelNumber - 1 . "^FS\n";
                        // RFIDLabel += "^FO600,25^A0N,50^FD" + lastName[0] + ",^FS\n";
                        // RFIDLabel += "^FO600,75^A0N,50^FD" + firstName[0] + "^FS\n";
                        $RFIDLabel .= "^FO90,25^A0N,65^FD" . $line1 . "^FS\n";
                        $RFIDLabel .= "^FO120,100^A0N,50^FD" . $line2 . "^FS\n";
                        $RFIDLabel .= "^RFW,H^FD";
                    } else {
                        $RFIDLabel .= "^FS\n^RFW,H^FD";
                    }

                    $RFIDNumber = $LabelNumber;
                    $RFIDLabel .= str_pad($RFIDNumber, 24, '0', STR_PAD_LEFT) . "^FS\n^XZ\n}$\n\${";
                    //if (LabelNumber % 100 == 0)
                    //{
                    //    RFIDLabel += "}$";
                    //    string fileName = "output" + fileNumber + ".txt";
                    //    File.WriteAllText(fileName, RFIDLabel);
                    //    Files.Add(fileName);
                    //    RFIDLabel = "${";
                    //    fileNumber++;
                    //}
                }
                $RFIDLabel .= "\n^XA\n^RS8\n^FO25,25^A0N,65^FD";
                $RFIDLabel .= $bibstop . "^FS\n^RFW,H^FD000000000000000000000000^FS\n^XY\n";
                $RFIDLabel .= "}$";

                //echo $RFIDLabel;

                $file = fopen("output.txt", "w");
                fwrite($file, $RFIDLabel);
                fclose($file);
                echo '<div class="col-md-3">';
                echo "<div class='alert alert-danger'>";
                echo "   <strong>Warning!</strong> This functionality is only available with Chrome</div>";
                echo '<div class="alert alert-warning">';
                echo "    <strong>Note:</strong> Headers and Footers need to be disabled before printing.";
                echo "</div>";
                echo '<iframe id="textfile" src="output.txt"></iframe>';
                echo '<button onclick="print()">Print</button>';
                echo "</div>";
            }
            ?>
            <!--<div class="col-md-3">
                <div class='alert alert-danger'>
                    <strong>Warning!</strong> This functionality is only available with Chrome</div>
                <div class="alert alert-warning">
                    <strong>Note:</strong> Headers and Footers need to be disabled before printing.
                </div>
                <iframe id="textfile" src="output.txt"></iframe>
                <button onclick="print()">Print</button>
            </div>-->
            <script type="text/javascript">
                function print() {
                    var iframe = document.getElementById('textfile');
                    iframe.contentWindow.print();
                }
            </script>
        </div>
    </body>
</html>


