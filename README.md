# Sunrise VIN

[![Build Status](https://api.travis-ci.com/sunrise-php/vin.svg?branch=master)](https://travis-ci.com/sunrise-php/vin)
[![CodeFactor](https://www.codefactor.io/repository/github/sunrise-php/vin/badge)](https://www.codefactor.io/repository/github/sunrise-php/vin)
[![Latest Stable Version](https://poser.pugx.org/sunrise/vin/v/stable)](https://packagist.org/packages/sunrise/vin)
[![Total Downloads](https://poser.pugx.org/sunrise/vin/downloads)](https://packagist.org/packages/sunrise/vin)
[![License](https://poser.pugx.org/sunrise/vin/license)](https://packagist.org/packages/sunrise/vin)

## Awards

[![SymfonyInsight](https://insight.symfony.com/projects/62616a9e-4984-4320-9759-42238630d43a/big.svg)](https://insight.symfony.com/projects/62616a9e-4984-4320-9759-42238630d43a)

## Installation

```
composer require sunrise/vin
```

## Usage

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

## Useful links

https://en.wikipedia.org/wiki/Vehicle_identification_number<br>
https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)<br>
https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)/World_Manufacturer_Identifier_(WMI)
