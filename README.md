# Simple VIN decoder for PHP 7.2+ based on ISO-3779

[![Build Status](https://api.travis-ci.com/sunrise-php/vin.svg?branch=master)](https://travis-ci.com/sunrise-php/vin)
[![CodeFactor](https://www.codefactor.io/repository/github/sunrise-php/vin/badge)](https://www.codefactor.io/repository/github/sunrise-php/vin)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sunrise-php/vin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sunrise-php/vin/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/sunrise-php/vin/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Latest Stable Version](https://poser.pugx.org/sunrise/vin/v/stable?format=flat)](https://packagist.org/packages/sunrise/vin)
[![Total Downloads](https://poser.pugx.org/sunrise/vin/downloads?format=flat)](https://packagist.org/packages/sunrise/vin)
[![License](https://poser.pugx.org/sunrise/vin/license?format=flat)](https://packagist.org/packages/sunrise/vin)

## Installation

```
composer require sunrise/vin
```

## How to use

```php
try
{
    $vin = new \Sunrise\Vin\Vin('wvwzzz1kz6w612305');
}
catch (\InvalidArgumentException $e)
{
    // It's not a valid VIN
}

$vin->getVin(); // returns "WVWZZZ1KZ6W612305"
$vin->getWmi(); // returns "WVW"
$vin->getVds(); // returns "ZZZ1KZ"
$vin->getVis(); // returns "6W612305"
$vin->getRegion(); // returns "Europe"
$vin->getCountry(); // returns "Germany"
$vin->getManufacturer(); // returns "Volkswagen"
```

## Api documentation

https://phpdoc.fenric.ru/

## Useful links

https://en.wikipedia.org/wiki/Vehicle_identification_number<br>
https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)<br>
https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)/World_Manufacturer_Identifier_(WMI)
