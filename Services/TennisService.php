<?php

include_once("Model/MatchResult.php");

include_once("Model/MatchInformation.php");
include_once("Model/Player.php");

include_once("Services/FileReaderService.php");
include_once("Services/LineProcessorService.php");

class TennisService
{

    public function UpdateScore($currentMatchResult, $matchInformation){

        if($currentMatchResult==0) {
            $matchInformation->PlayerA->Score +=1;
        }
        else {
             $matchInformation->PlayerB->Score +=1;
        }
    }

    public function PrepareMatchResult() {
    
        $fileLocation="full_tournament.txt";
        $fileReaderService= new FileReaderService();
        $lineProcessorService= new LineProcessorService();
        $matchResults = array();

        $allLines = $fileReaderService->ReadFile($fileLocation);
                $matchInformation=new MatchInformation();
                foreach ($allLines as $line) {
                
                    if($line == "")
                    continue;

                    $lineType = $lineProcessorService->GetLineType($line);
                    
                    if($lineType == "match"){
                        $matchInformation =new MatchInformation();
                        $matchInformation->MatchId = $lineProcessorService->GetMatchDetail($line);
                      //  echo "Match Id -- {$matchInformation->MatchId} <br>";

                    } else if ($lineType == "player"){

                        $matchInformation->PlayerA = new Player();
                        $matchInformation->PlayerB = new Player();
                        
                        $names = $lineProcessorService->GetPlayerDetails($line);
                       
                        $matchInformation->PlayerA->PlayerName = $names->PlayerAName;
                        $matchInformation->PlayerB->PlayerName = $names->PlayerBName;

                     //   echo "{$matchInformation->PlayerA->PlayerName} vs {$matchInformation->PlayerB->PlayerName} <br>";


                    } else if ($lineType="result"){
                        self::UpdateScore($line,$matchInformation);

                        if($matchInformation->PlayerA->Score == 4 || $matchInformation->PlayerB->Score == 4){

                            $matchResult = new MatchResult();
                            $matchResult->MatchId = $matchInformation->MatchId;
                            $matchResult->PlayerAName = $matchInformation->PlayerA->PlayerName;
                            $matchResult->PlayerBName = $matchInformation->PlayerB->PlayerName;

                            if($matchInformation->PlayerA->Score == 4){

                                 $matchResult->WinnerPlayer = $matchResult->PlayerAName;
                               //  echo "PlayerAWin <br>";
                            }
                            

                            if($matchInformation->PlayerB->Score == 4){
                                
                                $matchResult->WinnerPlayer = $matchResult->PlayerBName;
                               // echo "PlayerBWin <br>";

                            }

                            array_push($matchResults,$matchResult);
                        
                            $matchInformation->PlayerA->Score = 0;
                            $matchInformation->PlayerB->Score = 0;
                        }

                       
                        //print_r($matchInformation);
                    }

                }

               return $matchResults;
    }
}