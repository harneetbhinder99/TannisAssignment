<?php
include_once("DTO/PlayerNames.php");

class LineProcessorService
{

    public function GetLineType($line){

        $type="";
        $matchIdSpecifier="Match";
        $PlayerDetailSpecifier="Person";

        if(strpos($line, $matchIdSpecifier) !== false){
         $type="match";
        } 
        else if(strpos($line, $PlayerDetailSpecifier) !== false){
            $type="player";
        } 
        else if($line=="1" || $line=="0") {
            $type="result";
        }
        return $type;
    }

    public function GetMatchDetail($line){

        $lineArray = explode(":", $line); 
        return self::customTrim($lineArray[1]);
    }

    public function GetPlayerDetails($line){

        $lineArray = explode("vs", $line); 
       
         $PlayerNames= new PlayerNames();
         $PlayerNames->PlayerAName= self::customTrim($lineArray[0]);
         $PlayerNames->PlayerBName= self::customTrim($lineArray[1]);

        return $PlayerNames;
    }

    private function customTrim($str){
        $str = preg_replace('/[^A-Za-z0-9. -]/', '', $str);
        return trim($str);
    }

}
