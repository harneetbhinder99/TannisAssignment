<?php

class HtmlOutputService
{

   function GetMatchScoreOutput($matchScoreResult)
    {
        echo $matchScoreResult->WinnerPlayerName ." defeated ". $matchScoreResult->LoserPlayerName;
        echo "<br>";

        echo $matchScoreResult->WinerSet ." Sets to ". $matchScoreResult->LoserSet;
        echo "<br>";
    }
    function GetGamesForPlayerResultOutput($matchScoreResult)
    {
        echo "<br>";
        echo "Games Player  ".$_GET["playerName"];
        echo "<br>";
        echo $queryGamesForPlayerResult->PlayerWins ." ".$queryGamesForPlayerResult->PlayerLoose;
    }
}