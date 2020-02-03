<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate athlete object
include_once '../objects/athlete.php';
 
$database = new Database();
$db = $database->getConnection();
 
$athlete = new athlete($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->RaceID) &&
    !empty($data->FName) &&
    !empty($data->LName) &&
    !empty($data->DOB)
){
 
    // set athlete property values
    $athlete->RaceID = $data->RaceID;
    $athlete->BibNumber = $data->BibNumber;
    $athlete->AthleteType = $data->AthleteType;
    $athlete->FName = $data->FName;
    $athlete->LName = $data->LName;
    $athlete->DOB = $data->DOB;
    $athlete->Sex = $data->Sex;
    $athlete->City = $data->City;
    $athlete->St = $data->St;
    $athlete->StreetAddress = $data->StreetAddress;
    $athlete->ZipCode = $data->ZipCode;
    $athlete->Phone = $data->Phone;
    $athlete->Email = $data->Email;
    $athlete->PreRegistered = $data->PreRegistered;
    $athlete->TShirtSize = $data->TShirtSize;
    $athlete->WonPrize = $data->WonPrize;
    $athlete->TeamID = $data->TeamID;
    $athlete->Class = $data->Class;
    $athlete->Disqualified = $data->Disqualified;
    $athlete->DNF = $data->DNF;
    $athlete->DNS = $data->DNS;
    $athlete->WebID = $data->WebID;
    $athlete->Notes = $data->Notes;
    $athlete->AnnouncerNotes = $data->AnnouncerNotes;
    $athlete->ChipStartDateTime = $data->ChipStartDateTime;
    $athlete->RunSignUp_ID = $data->RunSignUp_ID;
    $athlete->AthleteIDNo = $data->AthleteIDNo;
    $athlete->RaceRoster_ID = $data->RaceRoster_ID;
 
    // create the athlete
    if($athlete->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "athlete was created."));
    }
 
    // if unable to create the athlete, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create athlete."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create athlete. Data is incomplete."));
}
?>