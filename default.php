<?php
/*$myfile = fopen("output.txt", "w") or die ("Unable to open file!");
$txt = "Welcome to\r\n";
fwrite($myfile, $txt);
$txt = "Ohio Race Day";
fwrite($myfile, $txt);
fclose($myfile);
echo(var_dump($txt));*/

function printT($text = "bull")
{
    echo $text;
}

printT("Hello");
printT();
?>

