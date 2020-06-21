<?php
require_once("Services\TennisService.php");
require_once("UnitTest\DataBuilder\MatchInformationBuilder.php");
use PHPUnit\Framework\TestCase;

class LineProcessorServiceTest extends TestCase
{

     /**
     * @dataProvider validLineDataProvider
     */
    public function test_GetLineType_Should_Return_Valid_Type_When_Valid_Line_Passed($line, $expectResult)
    {
        // Arrange
        $sut = new LineProcessorService();

        // Act
       $lineType = $sut->GetLineType($line);
        
        // Assert
        $this->assertSame($lineType, $expectResult);
    }


    /**
     * @dataProvider invalidLineDataProvider
     */
    public function test_GetLineType_Should_Return_Blank_When_invalid_Line_Passed($line)
    {
        // Arrange
        $sut = new LineProcessorService();

        // Act
       $lineType = $sut->GetLineType($line);
        
        // Assert
        $this->assertEmpty($lineType);
    }


    public function validLineDataProvider()
    {
        return [
            ["Match: 01", "match"],
            ["Person A vs Person B", "player"],
            ["1", "result"],
            ["0", "result"]
        ];
    }

     public function invalidLineDataProvider()
    {
        return [
            [""],
            ["-1"],
            ["2"],
            ["100"]
        ];
    }
}