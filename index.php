<?php

include_once("Services/TannisService.php");
include_once("Services/TannisResultService.php");
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

    
    $tannisService= new TannisService();
    $tannisResultService= new TannisResultService();
    $htmlOutputService= new HtmlOutputService();

    $matchResults =  $tannisService->PrepareMatchResult();

    switch (strtolower($type)) 
        {
            case "all"://All
                {
                
                $matchScoreResult = $tannisResultService->GetMatchScore($_GET["mid"], $matchResults); 
                $htmlOutputService->GetMatchScoreOutput($matchScoreResult);

                $queryGamesForPlayerResult =  $tannisResultService->QueryGamesForPlayer($_GET["playerName"], $matchResults);
                $htmlOutputService->GetGamesForPlayerResultOutput($queryGamesForPlayerResult);

                break;

                }

            case "q1"://All
               {
                    $matchScoreResult = $tannisResultService->GetMatchScore($_GET["mid"], $matchResults);
                    $htmlOutputService->GetMatchScoreOutput($matchScoreResult); 
               }
            case "q2"://All
               {
                    $queryGamesForPlayerResult =  $tannisResultService->QueryGamesForPlayer($_GET["playerName"], $matchResults);
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


