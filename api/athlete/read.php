<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/athlete.php';
 
// instantiate database and athlete object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$athlete = new Athlete($db);
 
// read athletes will be here
// query athletes
$stmt = $athlete->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // athletes array
    $athletes_arr=array();
    $athletes_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $athlete_item=array(
            "ID" => $ID,
            "RaceID" => $RaceID,
            "BibNumber" => $BibNumber,
            "AthleteType" => $AthleteType,
            "FName" => $FName,
            "LName" => $LName,
            "DOB" => $DOB,
            "Sex" => $Sex,
            "City" => $City,
            "[State]" => $St,
            "StreetAddress" => $StreetAddress,
            "ZipCode" => $ZipCode,
            "Phone" => $Phone,
            "Email" => $Email,
            "PreRegistered" => $PreRegistered,
            "TShirtSize" => $TShirtSize,
            "WonPrize" => $WonPrize,
            "TeamID" => $TeamID,
            "Class" => $Class,
            "Disqualified" => $Disqualified,
            "DNF" => $DNF,
            "DNS" => $DNS,
            "WebID" => $WebID,
            "Notes" => $Notes,
            "AnnouncerNotes" => $AnnouncerNotes,
            "ChipStartDateTime" => $ChipStartDateTime,
            "RunSignUp_ID" => $RunSignUp_ID,
            "AthleteIDNo" => $AthleteIDNo,
            "RaceRoster_ID" => $RaceRoster_ID
        );
 
        array_push($athletes_arr["records"], $athlete_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show athletes data in json format
    echo json_encode($athletes_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no athletes found
    echo json_encode(
        array("message" => "No Athletes found.")
    );
}

?>