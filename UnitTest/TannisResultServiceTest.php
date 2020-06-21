<?php
require_once("Services\TennisService.php");
require_once("UnitTest\DataBuilder\MatchInformationBuilder.php");
use PHPUnit\Framework\TestCase;

class TennisResultServiceTest extends TestCase
{

    public function test_UpdateScore_Should_Update_PlayerAScore_When_Zero_Passed()
    {
        // Arrange
            $matchInformationBuilder = new MatchInformationBuilder();
            $matchInformationBuilder->WithPlayerScores(1,2);
            $sut = new TennisService();
            $matchInformation = $matchInformationBuilder->Build();

        // Act
        $sut->UpdateScore(0,$matchInformation);
        
        // Assert
        $this->assertSame($matchInformation->PlayerA->Score, 2);
    }

    public function test_UpdateScore_Should_Update_PlayerBScore_When_One_Passed()
    {
         // Arrange
            $matchInformationBuilder = new MatchInformationBuilder();
            $matchInformationBuilder->WithPlayerScores(2,2);
            $sut = new TennisService();
            $matchInformation = $matchInformationBuilder->Build();

        // Act
        $sut->UpdateScore(2,$matchInformation);
        
        // Assert
        $this->assertSame($matchInformation->PlayerB->Score, 3);
    }
}