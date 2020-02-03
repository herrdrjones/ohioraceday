<?php
class Athlete{
 
    // database connection and table name
    private $conn;
    private $table_name = "athlete";
 
    // object properties
    public $ID;
    public $RaceID;
    public $BibNumber;
    public $AthleteType;
    public $FName;
    public $LName;
    public $DOB;
    public $Sex;
    public $City;
    public $St;
    public $StreetAddress;
    public $ZipCode;
    public $Phone;
    public $Email;
    public $PreRegistered;
    public $TShirtSize;
    public $WonPrize;
    public $TeamID;
    public $Class;
    public $Disqualified;
    public $DNF;
    public $DNS;
    public $WebID;
    public $Notes;
    public $AnnouncerNotes;
    public $ChipStartDateTime;
    public $RunSignUp_ID;
    public $AthleteIDNo;
    public $RaceRoster_ID;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
    function read(){
    
        // select all query
        $query = "SELECT
                    ID,
                    RaceID,
                    BibNumber,
                    AthleteType,
                    FName,
                    LName,
                    DOB,
                    Sex,
                    City,
                    `[State]` as St,
                    StreetAddress,
                    ZipCode,
                    Phone,
                    Email,
                    PreRegistered,
                    TShirtSize,
                    WonPrize,
                    TeamID,
                    Class,
                    Disqualified,
                    DNF,
                    DNS,
                    WebID,
                    Notes,
                    AnnouncerNotes,
                    ChipStartDateTime,
                    RunSignUp_ID,
                    AthleteIDNo,
                    RaceRoster_ID
                FROM
                    " . $this->table_name. " limit 10";
        echo $query;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO ".$this->table_name." (
            `RaceID`,
            `BibNumber`,
            `AthleteType`,
            `FName`,
            `LName`,
            `DOB`,
            `Sex`,
            `City`,
            `[State]`,
            `StreetAddress`,
            `ZipCode`,
            `Phone`,
            `Email`,
            `PreRegistered`,
            `TShirtSize`,
            `WonPrize`,
            `TeamID`,
            `Class`,
            `Disqualified`,
            `DNF`,
            `DNS`,
            `WebID`,
            `Notes`,
            `AnnouncerNotes`,
            `ChipStartDateTime`,
            `RunSignUp_ID`,
            `AthleteIDNo`,
            `RaceRoster_ID`)
            VALUES
            (:RaceID,
            :BibNumber,
            :AthleteType,
            :FName,
            :LName,
            :DOB,
            :Sex,
            :City,
            :St,
            :StreetAddress,
            :ZipCode,
            :Phone,
            :Email,
            :PreRegistered,
            :TShirtSize,
            :WonPrize,
            :TeamID,
            :Class,
            :Disqualified,
            :DNF,
            :DNS,
            :WebID,
            :Notes,
            :AnnouncerNotes,
            :ChipStartDateTime,
            :RunSignUp_ID,
            :AthleteIDNo,
            :RaceRoster_ID)";
        /*$query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    RaceID=:RaceID, BibNumber=:BibNUmber, AthleteType=:AthleteType, FName=:FName, LName=:LName, DOB=:DOB,
                    Sex=:Sex, City=:City, StreetAddress=:StreetAddres, ZipCode=:ZipCode, Phone=:Phone,
                    Email=:Email, PreRegistered=:PreRegistered, TShirtSize=:TShirtSize, WonPrize=:WonPrize, TeamID=:TeamID,
                    Class=:Class, Disqualified=:Disqualified, DNF=:DNF, DNS=:DNS, WebID:WebID, Notes:Notes,
                    AnnouncerNotes=:AnnouncerNotes, ChipStartDateTime=:ChipStartDateTime, RunSignUp_ID=:RunSignUp_ID,
                    AthleteIDNo=:AthleteIDNo, RaceRoster_ID=:RaceRoster_ID";*/
        //echo $query;
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->RaceID=htmlspecialchars(strip_tags($this->RaceID));
        $this->BibNumber=htmlspecialchars(strip_tags($this->BibNumber));
        $this->AthleteType=htmlspecialchars(strip_tags($this->AthleteType));
        $this->FName=htmlspecialchars(strip_tags($this->FName));
        $this->LName=htmlspecialchars(strip_tags($this->LName));
        $this->DOB=htmlspecialchars(strip_tags($this->DOB));
        $this->Sex=htmlspecialchars(strip_tags($this->Sex));
        $this->City=htmlspecialchars(strip_tags($this->City));
        $this->St=htmlspecialchars(strip_tags($this->St));
        $this->StreetAddress=htmlspecialchars(strip_tags($this->StreetAddress));
        $this->ZipCode=htmlspecialchars(strip_tags($this->ZipCode));
        $this->Phone=htmlspecialchars(strip_tags($this->Phone));
        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->PreRegistered=htmlspecialchars(strip_tags($this->PreRegistered));
        $this->TShirtSize=htmlspecialchars(strip_tags($this->TShirtSize));
        $this->WonPrize=htmlspecialchars(strip_tags($this->WonPrize));
        $this->TeamID=htmlspecialchars(strip_tags($this->TeamID));
        $this->Class=htmlspecialchars(strip_tags($this->Class));
        $this->Disqualified=htmlspecialchars(strip_tags($this->Disqualified));
        $this->DNF=htmlspecialchars(strip_tags($this->DNF));
        $this->DNS=htmlspecialchars(strip_tags($this->DNS));
        $this->WebID=htmlspecialchars(strip_tags($this->WebID));
        $this->Notes=htmlspecialchars(strip_tags($this->Notes));
        $this->AnnouncerNotes=htmlspecialchars(strip_tags($this->AnnouncerNotes));
        $this->ChipStartDateTime=htmlspecialchars(strip_tags($this->ChipStartDateTime));
        $this->RunSignUp_ID=htmlspecialchars(strip_tags($this->RunSignUp_ID));
        $this->AthleteIDNo=htmlspecialchars(strip_tags($this->AthleteIDNo));
        $this->RaceRoster_ID=htmlspecialchars(strip_tags($this->RaceRoster_ID));
    
        // bind values

        $stmt->bindParam(":RaceID", $this->RaceID);
        $stmt->bindParam(":BibNumber", $this->BibNumber);
        $stmt->bindParam(":AthleteType", $this->AthleteType);
        $stmt->bindParam(":FName", $this->FName);
        $stmt->bindParam(":LName", $this->LName);
        $stmt->bindParam(":DOB", $this->DOB);
        $stmt->bindParam(":Sex", $this->Sex);
        $stmt->bindParam(":City", $this->City);
        $stmt->bindParam(":St", $this->St);
        $stmt->bindParam(":StreetAddress", $this->StreetAddress);
        $stmt->bindParam(":ZipCode", $this->ZipCode);
        $stmt->bindParam(":Phone", $this->Phone);
        $stmt->bindParam(":Email", $this->Email);
        $stmt->bindParam(":PreRegistered", $this->PreRegistered);
        $stmt->bindParam(":TShirtSize", $this->TShirtSize);
        $stmt->bindParam(":WonPrize", $this->WonPrize);
        $stmt->bindParam(":TeamID", $this->TeamID);
        $stmt->bindParam(":Class", $this->Class);
        $stmt->bindParam(":Disqualified", $this->Disqualified);
        $stmt->bindParam(":DNF", $this->DNF);
        $stmt->bindParam(":DNS", $this->DNS);
        $stmt->bindParam(":WebID", $this->WebID);
        $stmt->bindParam(":Notes", $this->Notes);
        $stmt->bindParam(":AnnouncerNotes", $this->AnnouncerNotes);
        $stmt->bindParam(":ChipStartDateTime", $this->ChipStartDateTime);
        $stmt->bindParam(":RunSignUp_ID", $this->RunSignUp_ID);
        $stmt->bindParam(":AthleteIDNo", $this->AthleteIDNo);
        $stmt->bindParam(":RaceRoster_ID", $this->RaceRoster_ID);


        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}
?>