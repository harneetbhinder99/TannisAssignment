<?php

class FileReaderService
{

    public function ReadFile($path)
    {
        $strArray=array();

        $file = fopen($path,"r");
        while(! feof($file))
           array_push($strArray,fgets($file));  

        fclose($file);

        return $strArray;
    }

}