<?php

include_once("Services/TennisService.php");
include_once("Services/TennisResultService.php");
include_once("Services/HtmlOutputService.php");
include_once("DTO/QueryGamesForPlayerResult.php");

 
error_reporting(E_ERROR | E_PARSE);

$response;
try {
    $type="";
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $type = $_GET["type"];
     }
     else
     {
         echo "invalid Request Type";
         return;
     }

    
    $TennisService= new TennisService();
    $TennisResultService= new TennisResultService();
    $htmlOutputService= new HtmlOutputService();

    $matchResults =  $TennisService->PrepareMatchResult();

    switch (strtolower($type)) 
        {
            case "all"://All
                {
                
                $matchScoreResult = $TennisResultService->GetMatchScore($_GET["mid"], $matchResults); 
                $htmlOutputService->GetMatchScoreOutput($matchScoreResult);

                $queryGamesForPlayerResult =  $TennisResultService->QueryGamesForPlayer($_GET["playerName"], $matchResults);
                $htmlOutputService->GetGamesForPlayerResultOutput($queryGamesForPlayerResult);

                break;

                }

            case "q1"://All
               {
                    $matchScoreResult = $TennisResultService->GetMatchScore($_GET["mid"], $matchResults);
                    $htmlOutputService->GetMatchScoreOutput($matchScoreResult); 
               }
            case "q2"://All
               {
                    $queryGamesForPlayerResult =  $TennisResultService->QueryGamesForPlayer($_GET["playerName"], $matchResults);
                    $htmlOutputService->GetGamesForPlayerResultOutput($queryGamesForPlayerResult);
               }
            default:
                {
                echo "Invalid Request;<br> <br> Pass type:<br> all - everything <br> q1 - Score Match <br> q2 - Query games for player";
                break;
                }
        }

} catch (Exception $exception) {
    $Message = $exception->getMessage();
};


