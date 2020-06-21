<?php
include_once("DTO/QueryGamesForPlayerResult.php");
include_once("DTO/MatchScoreResult.php");

class TennisResultService
{

    public function GetMatchScore($matchId, $matches){

         $playerAWinSetCount=0;
        $playerBWinSetCount=0;

        $playerAWinCount=0;
        $playerBWinCount=0;

        $mts=self::GetMatchsByMatchId($matchId, $matches);
        foreach ($mts as $key => $match) {
            
            if($match->WinnerPlayer == $match->PlayerAName)
            {
                $playerAWinCount++;
            }

             if($match->WinnerPlayer == $match->PlayerBName)
            {
                $playerBWinCount++;
            }
            if(($playerAWinCount >= 5 || $playerBWinCount >= 5) && abs($playerBWinCount-$playerAWinCount)>=2){

                if($playerAWinCount > $playerBWinCount){
                    $playerAWinSetCount++;
                }
                else{
                    $playerBWinSetCount++;
                }


                $playerAWinCount=0;
                $playerBWinCount=0;
            }

        }

        $result= new MatchScoreResult();

        if($playerAWinSetCount > $playerBWinSetCount)
        {
            $result->WinerSet = $playerAWinSetCount;
            $result->LoserSet = $playerBWinSetCount;
            $result->WinnerPlayerName = $matches[0]->PlayerAName;
            $result->LoserPlayerName = $matches[0]->PlayerBName;
        }else{
            $result->WinerSet = $playerBWinSetCount;
            $result->LoserSet = $playerAWinSetCount;
             $result->WinnerPlayerName = $matches[0]->PlayerBName;
            $result->LoserPlayerName = $matches[0]->PlayerAName;
        }
       return $result;
    }
    


    public  function  QueryGamesForPlayer($playerName, $matches){
            $playerWinCount=0;
          
           $mts=self::GetMatchsByPlayerName($playerName, $matches);
            foreach ($mts as $key => $match) {
            if($match->WinnerPlayer == $playerName){
                 $playerWinCount++;
            }    
            }
        $result=new QueryGamesForPlayerResult();
        $result->PlayerWins = $playerWinCount;
        $result->PlayerLoose = count($mts)-$playerWinCount;

       return $result;

    }


    
    public function GetMatchsByPlayerName($playerName, $matches)
    {
        $ouptMatch=array();
        foreach ($matches as $key => $var) {
           if($var->PlayerAName == $playerName || $var->PlayerBName == $playerName){
                array_push($ouptMatch,$var);
           }
        }
        return $ouptMatch;
    }


    public function GetMatchsByMatchId($matchId, $matches)
    {
        $ouptMatch=array();
       
        foreach ($matches as $key => $var) {
           if($var->MatchId == $matchId){
                array_push($ouptMatch,$var);
           }
           
        }
        return $ouptMatch;
    }

}