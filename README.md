# Simple VIN decoder for PHP 7.1+ based on ISO-3779

[![Gitter](https://badges.gitter.im/sunrise-php/support.png)](https://gitter.im/sunrise-php/support)
[![Build Status](https://api.travis-ci.org/sunrise-php/vin.svg?branch=master)](https://travis-ci.org/sunrise-php/vin)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sunrise-php/vin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sunrise-php/vin/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/sunrise-php/vin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/sunrise-php/vin/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/sunrise/vin/v/stable?format=flat)](https://packagist.org/packages/sunrise/vin)
[![Total Downloads](https://poser.pugx.org/sunrise/vin/downloads?format=flat)](https://packagist.org/packages/sunrise/vin)
[![License](https://poser.pugx.org/sunrise/vin/license?format=flat)](https://packagist.org/packages/sunrise/vin)

## Installation

```bash
composer require sunrise/vin
```

## How to use

```php
use Sunrise\Vin\Vin;

try {
    $vin = new Vin('wvwzzz1kz6w612305');
} catch (\InvalidArgumentException $e) {
    // It's not a valid VIN
}

$vin->getVin(); // returns "WVWZZZ1KZ6W612305"
$vin->getWmi(); // returns "WVW"
$vin->getVds(); // returns "ZZZ1KZ"
$vin->getVis(); // returns "6W612305"
$vin->getRegion(); // returns "Europe"
$vin->getCountry(); // returns "Germany"
$vin->getManufacturer(); // returns "Volkswagen"
$vin->getModelYear(); // returns "2006"
```

## Api documentation

https://phpdoc.fenric.ru/

## Useful links

* https://en.wikipedia.org/wiki/Vehicle_identification_number
* https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)
* https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)/World_Manufacturer_Identifier_(WMI)
