<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/race.php';
 
// instantiate database and athlete object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$race = new Race($db);
 
// read athletes will be here
// query athletes
$stmt = $race->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // athletes array
    $races_arr=array();
    $races_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $race_item=array(

            "ID" => $ID,
            "RaceName" => $RaceName,
            "RaceDate" => $RaceDate,
            "Distance" => $Distance,
            "RaceDirector" => $RaceDirector,
            "RaceDirectorPhone" => $RaceDirectorPhone,
            "RaceDirectorEmail" => $RaceDirectorEmail,
            "StreetAddress" => $StreetAddress,
            "City" => $City,
            "[State]" => $St,
            "ZipCode" => $ZipCode,
            "Laps" => $Laps,
            "TrackRace" => $TrackRace,
            "StartDateTime" => $StartDateTime,
            "Notes" => $Notes,
            "WebID" => $WebID,
            "RegistrationFee" => $RegistrationFee,
            "ShowOnEventCalendar" => $ShowOnEventCalendar,
            "RegistrationNotes" => $RegistrationNotes,
            "WebsiteNotes" => $WebsiteNotes,
            "TeamScoring" => $TeamScoring,
            "Members" => $Members,
            "Displacers" => $Displacers,
            "IsLapRace" => $IsLapRace,
            "TieBreaker" => $TieBreaker,
            "HyTekRaceNo" => $HyTekRaceNo,
            "HyTekRoundNo" => $HyTekRoundNo,
            "HyTekSectionNo" => $HyTekSectionNo,
            "RunSignUp_RaceID" => $RunSignUp_RaceID,
            "RunSignUp_URL" => $RunSignUp_URL,
            "RunSignUp_EventID" => $RunSignUp_EventID,
            "RunSignUp_EmailAccount" => $RunSignUp_EmailAccount,
            "RunSignUp_Password" => $RunSignUp_Password,
            "RunSignUp_TimeZone" => $RunSignUp_TimeZone,
            "Country" => $Country,
            "ResultsByChipTime" => $ResultsByChipTime,
            "TFRRS_MeetUsername" => $TFRRS_MeetUsername,
            "TFRRS_MeetPassword" => $TFRRS_MeetPassword,
            "TFRRS_MeetID" => $TFRRS_MeetID,
            "TFRRS_MeetName" => $TFRRS_MeetName,
            "TFRRS_MeetDateBegin" => $TFRRS_MeetDateBegin,
            "TFRRS_MeetDateEnd" => $TFRRS_MeetDateEnd,
            "TFRRS_MeetSport" => $TFRRS_MeetSport,
            "TFRRS_MeetVenue" => $TFRRS_MeetVenue,
            "TFRRS_MeetHost" => $TFRRS_MeetHost,
            "TFRRS_MeetReferee" => $TFRRS_MeetReferee,
            "TFRRS_MeetTimer" => $TFRRS_MeetTimer,
            "TFRRS_MeetStarter" => $TFRRS_MeetStarter,
            "TFRRS_MeetURL" => $TFRRS_MeetURL,
            "TFRRS_MeetURLNonCollegiate" => $TFRRS_MeetURLNonCollegiate,
            "TFRRS_RaceCourseConditions" => $TFRRS_RaceCourseConditions,
            "TFRRS_RaceWeather" => $TFRRS_RaceWeather,
            "TFRRS_RaceTemperature" => $TFRRS_RaceTemperature,
            "TFRRS_RaceWindSpeed" => $TFRRS_RaceWindSpeed,
            "RaceRoster_RaceID" => $RaceRoster_RaceID,
            "RaceRoster_URL" => $RaceRoster_URL,
            "RaceRoster_SubEventID" => $RaceRoster_SubEventID,
            "RaceRoster_EmailAccount" => $RaceRoster_EmailAccount,
            "RaceRoster_Password" => $RaceRoster_Password,
            "ArrowURL" => $ArrowURL,
            "ArrowId" => $ArrowId,
            "[DivisionsDate]" => $DivisionsDate,
            "[IAAFRoundTimesUp]" => $IAAFRoundTimesUp
        );
 
        array_push($races_arr["records"], $race_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show athletes data in json format
    echo json_encode($races_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no athletes found
    echo json_encode(
        array("message" => "No Races found.")
    );
}

?>
