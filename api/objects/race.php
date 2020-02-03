<?php
class Race{
 
    // database connection and table name
    private $conn;
    private $table_name = "race";
 
    // object properties
    public $ID;
    public $RaceName;
    public $RaceDate;
    public $Distance;
    public $RaceDirector;
    public $RaceDirectorPhone;
    public $RaceDirectorEmail;
    public $StreetAddress;
    public $City;
    public $St;
    public $ZipCode;
    public $Laps;
    public $TrackRace;
    public $StartDateTime;
    public $Notes;
    public $WebID;
    public $RegistrationFee;
    public $ShowOnEventCalendar;
    public $RegistrationNotes;
    public $WebsiteNotes;
    public $TeamScoring;
    public $Members;
    public $Displacers;
    public $IsLapRace;
    public $TieBreaker;
    public $HyTekRaceNo;
    public $HyTekRoundNo;
    public $HyTekSectionNo;
    public $RunSignUp_RaceID;
    public $RunSignUp_URL;
    public $RunSignUp_EventID;
    public $RunSignUp_EmailAccount;
    public $RunSignUp_Password;
    public $RunSignUp_TimeZone;
    public $Country;
    public $ResultsByChipTime;
    public $TFRRS_MeetUsername;
    public $TFRRS_MeetPassword;
    public $TFRRS_MeetID;
    public $TFRRS_MeetName;
    public $TFRRS_MeetDateBegin;
    public $TFRRS_MeetDateEnd;
    public $TFRRS_MeetSport;
    public $TFRRS_MeetVenue;
    public $TFRRS_MeetHost;
    public $TFRRS_MeetReferee;
    public $TFRRS_MeetTimer;
    public $TFRRS_MeetStarter;
    public $TFRRS_MeetURL;
    public $TFRRS_MeetURLNonCollegiate;
    public $TFRRS_RaceCourseConditions;
    public $TFRRS_RaceWeather;
    public $TFRRS_RaceTemperature;
    public $TFRRS_RaceWindSpeed;
    public $RaceRoster_RaceID;
    public $RaceRoster_URL;
    public $RaceRoster_SubEventID;
    public $RaceRoster_EmailAccount;
    public $RaceRoster_Password;
    public $ArrowURL;
    public $ArrowId;
    public $DivisionsDate;
    public $IAAFRoundTimesUp;
    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function read(){
    
        // select all query
        $query = "SELECT
                    ID,
                    RaceName,
                    RaceDate,
                    Distance,
                    RaceDirector,
                    RaceDirectorPhone,
                    RaceDirectorEmail,
                    StreetAddress,
                    City,
                    `[State]` as St,
                    ZipCode,
                    Laps,
                    TrackRace,
                    StartDateTime,
                    Notes,
                    WebID,
                    RegistrationFee,
                    ShowOnEventCalendar,
                    RegistrationNotes,
                    WebsiteNotes,
                    TeamScoring,
                    Members,
                    Displacers,
                    IsLapRace,
                    TieBreaker,
                    HyTekRaceNo,
                    HyTekRoundNo,
                    HyTekSectionNo,
                    RunSignUp_RaceID,
                    RunSignUp_URL,
                    RunSignUp_EventID,
                    RunSignUp_EmailAccount,
                    RunSignUp_Password,
                    RunSignUp_TimeZone,
                    Country,
                    ResultsByChipTime,
                    TFRRS_MeetUsername,
                    TFRRS_MeetPassword,
                    TFRRS_MeetID,
                    TFRRS_MeetName,
                    TFRRS_MeetDateBegin,
                    TFRRS_MeetDateEnd,
                    TFRRS_MeetSport,
                    TFRRS_MeetVenue,
                    TFRRS_MeetHost,
                    TFRRS_MeetReferee,
                    TFRRS_MeetTimer,
                    TFRRS_MeetStarter,
                    TFRRS_MeetURL,
                    TFRRS_MeetURLNonCollegiate,
                    TFRRS_RaceCourseConditions,
                    TFRRS_RaceWeather,
                    TFRRS_RaceTemperature,
                    TFRRS_RaceWindSpeed,
                    RaceRoster_RaceID,
                    RaceRoster_URL,
                    RaceRoster_SubEventID,
                    RaceRoster_EmailAccount,
                    RaceRoster_Password,
                    ArrowURL,
                    ArrowId,
                    `[DivisionsDate]` as DivisionsDate,
                    `[IAAFRoundTimesUp]` as IAAFRoundTimesUp
                FROM
                    " . $this->table_name. " limit 10";
        //echo $query;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}
    ?>