# TennisAssignment

## Prerequisite
1. Composer
2. Wamp/Xampp
3. PHP Unit for testing

Download Composer from  https://getcomposer.org/  
Download Wamp from https://www.wampserver.com/en/

## Setup
Download this repo to Wamp's www folder and start using Index page

To Setup PHPUnit, run following cmd in Project folder
> composer require --dev phpunit/phpunit ^9 

once setup is done then run following command to Execute Unit Tests
>  vendor\bin\phpunit UnitTest




## TennisAssignment Folder Structure 

### DTO
  Works as Data Transfer object between Services

### Model
  Works as Entities
    
### Services
  Bussiness logic / Common logic  

### UnitTest
  Unit tests for services
  
### UnitTest/DataBuilder
  Responsible for creating data for Unit test cases  
