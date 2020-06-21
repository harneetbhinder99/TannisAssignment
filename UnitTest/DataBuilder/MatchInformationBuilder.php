<?php

class MatchInformationBuilder
{
    private static $matchinformation;
    function __construct() {

        self::$matchinformation= new Matchinformation();
        self::$matchinformation->PlayerA = new Player();
        self::$matchinformation->PlayerB = new Player();

    }
    public function WithMatchId($id)
    {
        self::$matchinformation->MatchId = $id;
    }
    
    public function WithPlayerNames($playerAName,$playerBName)
    {

        self::$matchinformation->PlayerA->PlayerName=$playerAName;
        self::$matchinformation->PlayerA->PlayerName=$playerBName;
    }

    public function WithPlayerScores($playerAScore,$playerBScore)
    {
        self::$matchinformation->PlayerA->Score=$playerAScore;
        self::$matchinformation->PlayerB->Score=$playerAScore;
    }

    public function Build(){
        return self::$matchinformation;
    }
}